<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\Bill;
use Phrontlyne\Models\Customer;
use Phrontlyne\Models\Prescription;
use Phrontlyne\Models\Consultation;
use Phrontlyne\Models\Payments;
use Phrontlyne\Models\BalanceSheet;
use Phrontlyne\Models\StickerReturn;
use Phrontlyne\Http\Requests;
use DB;
use Phrontlyne\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Input;
use Response;
use Carbon\Carbon;
use Auth;
use PDF;



class BillController extends Controller
{
     public function __construct()
    {

        $this->middleware('role:Broker|System Admin');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patientEnquiry()
    {

        return view('errors.503');
    }


    public function registeredstickers()
    {

        $registeredstickers = StickerReturn::paginate(30);

        return view('sticker_issued',compact('registeredstickers'));

    }




    public function getPatientBill($id)
   {

    $patientid=Bill::where('visit_id' ,'=', $id)->pluck('patient_id');

    $patients =  Customer::where('patient_id' ,'=', $patientid)->get();

    $balances=BalanceSheet::where('patient_id' ,'=', $patientid)->get();
    //dd($balances);
    $bills=Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
    $receiptmodes=DB::table('receipt_mode')->get();
    return view('billing.invoice', compact('patients','bills','receiptmodes','balances'));
}

 public function printBill($id)
   {

    $patientid=Bill::where('visit_id' ,'=', $id)->pluck('patient_id');
    $patients =  Customer::where('patient_id' ,'=', $patientid)->get();
    $bills=Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
    return view('billing.print', compact('patients','bills'));

    }

    public function emailBill($id)
   {

    $patientid=Bill::where('visit_id' ,'=', $id)->pluck('patient_id');
    $patients =  Customer::where('patient_id' ,'=', $patientid)->get();
    $bills=Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
    return view('billing.invoice', compact('patients','bills'));

    }


public function index()
   {

    $bills=Bill::where('note', 'Unpaid')->orderBy('date', 'DESC')->paginate(30);
    $receiptmodes=DB::table('receipt_mode')->get();
      
    return view('billing.index', compact('bills','receiptmodes'));

    }

    public function downloadpendinginvoices(Request $request)
    {
        $bills=Bill::where('note', 'Unpaid')->orderBy('date', 'DESC')->get();
        $receiptmodes=DB::table('receipt_mode')->get();

       // $items = DB::table("items")->get();
        view()->share('bills',$bills);

        if($request->has('download')){
            $pdf = PDF::loadView('billing.index');
            return $pdf->download('billing.index');
        }

        return view('billing.index', compact('bills','receiptmodes'));
    }


public function dashboard()
   {

    $bills=Bill::orderBy('date', 'DESC')->paginate(30);
      
    return view('billing.dashboard', compact('bills'));

    }


    public function getBillitems(Request $request)
    {
    try
    {

            $opd_number = Input::get("opd_number");
            $bills=Bill::where('visit_id' , $opd_number)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
            return  Response::json($bills);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
    }

    public function fetchbilldetails()
    {
      //dd($opd_id);
    $id = Input::get('id');
    $user = Bill::find($id);
    $data = Array(
        'patient_id'=>$user->patient_id,
        'visit_id'=>$user->visit_id,
        'fullname'=>$user->fullname,
      
    );
        return Response::json($data);
    }

    function generatePin($number) 
      {
        $alpha = array();
    for ($u = 65; $u <= 90; $u++) {
        // Uppercase Char
        array_push($alpha, chr($u));
    }

  

    // Get random alpha character
    $rand_alpha_key = array_rand($alpha);
    $rand_alpha = $alpha[$rand_alpha_key];

    // Add the other missing integers
    $rand = array($rand_alpha);
    for ($c = 0; $c < $number - 1; $c++) {
        array_push($rand, mt_rand(0, 9));
        shuffle($rand);
    }

    return implode('', $rand);
    }



    public function generateReceiptNumber()
    {
    //$number = Serials::where('name','=','receipt')->first();
    ///$number = $number->counter;
   // $account = str_pad($number,7, '0', STR_PAD_LEFT);
    $myaccount = DB::select('call gen_receipt_number("01","999","997")');
    $myaccount = $myaccount[0]->MYID;
    
    return  $myaccount;
    }


    public function doPayment(Request $request)
    {

        dd($request->all());

        $receiptnumber = $this->generateReceiptNumber();

        $id = $request->input('billid');
        $billdetails = Bill::where('id',$id)->first();

        $payments = new Payments();
        $payments->receipt_type     = $request->input('receipt_type');
        $payments->receipt_number   = $receiptnumber;
        $payments->invoice_number   = $billdetails->invoice_number;
        $payments->receipt_date     = Carbon::now();
        $payments->currency         = $billdetails->currency;
        $payments->amount_payable   = $billdetails->sum('amount');
        $payments->amount_paid      = $request->input('amountreceived');
        $payments->collection_mode  = $request->input('paymentmethod');
        $payments->reference_number = $request->input('referencenumber');
        $payments->paid_by          = $request->input('fullname_paid');
        $payments->branch           = $billdetails->branch;
        $payments->cover_type       = $billdetails->cover_type;
        $payments->transaction_type = $billdetails->transaction_type;
        $payments->created_on       = Carbon::now();
        $payments->created_by       = Auth::user()->getNameOrUsername();
        $payments->amount_in_words  = 'NA';
        $payments->policy_number    = $billdetails->policy_number;
        $payments->agency           = $billdetails->agency;
        $payments->policy_product   = $billdetails->policy_product;
        $payments->account_number   = $billdetails->account_number;
        $payments->exchange_rate    = $billdetails->exchange_rate;
        
        if($payments->save())
        {

            $affectedRows = Bill::where('invoice_number', $billdetails->invoice_number)
            ->update(array(
                           'payment_status' => 'Paid'
                           ));


            if($affectedRows > 0)
            {
             return redirect()
            ->route('invoice')
            ->with('info','Payment has successfully been processed!');
            }

            else
            {
                 return redirect()
            ->route('invoice')
            ->with('error','Error processing payments!');
            }

        }

        else
        {

              return redirect()
            ->route('invoice')
            ->with('error','Error processing payments!');

        } 
    
    }

    public function getSearchResults(Request $request)
    {
    
     
   

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');
        $receiptmodes=DB::table('receipt_mode')->get();
        $bills = Bill::where('note', 'Unpaid')->where('fullname', 'like', "%$search%")
            ->orWhere('patient_id', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

            return view('billing.index', compact('bills','receiptmodes'));
    
    }

    public function doEnquiry(Request $request)
    {
    
     
   

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');
        $receiptmodes=DB::table('receipt_mode')->get();
        $bills = Bill::where('note', 'Unpaid')->where('fullname', 'like', "%$search%")
            ->orWhere('patient_id', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

            return view('billing.index', compact('bills','receiptmodes'));
    
    }




}
