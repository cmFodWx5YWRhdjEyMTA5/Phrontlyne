<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\PaymentType;
use Phrontlyne\Models\ReceiptType;
use Phrontlyne\Models\BankAccount;
use Phrontlyne\Models\PendingBills;
use Phrontlyne\Models\Bill;
use Phrontlyne\Models\BillMaster;
use Phrontlyne\Models\Serials;
use Phrontlyne\Models\Policy;
use Phrontlyne\Models\Customer;
use Phrontlyne\Models\Payments;
use Phrontlyne\Models\User;
use Phrontlyne\Models\CommissionProcessed;
use Phrontlyne\Models\CommissionSummary;
use Phrontlyne\Models\Currency;
use Phrontlyne\Models\ProformaInvoice;
use Phrontlyne\Models\PolicyProductType;
use Phrontlyne\Models\Taxes;
use Phrontlyne\Models\StickerReturn;
use Phrontlyne\Models\MotorDetails;
use NumberToWords\NumberToWords;
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use Auth;
use Input;
use Response;
use Carbon\Carbon;
use Activity;
use PDF;
use DB;
use DateTime;
use Phrontlyne\Notifications\InvoicePaid;
use Notification;

use Smsgh;
use BasicAuth;
use ApiHost;
use MessagingApi;
use Message;

require 'Smsgh/Api.php';


class InvoiceController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendInvoices()
    {
       //Notification::send($ticket->subscribedUsers()->get(), new TicketCreated($entry));
    }


public function issuedStickers()
    {

        $users = User::get();
        $issuedstickers = StickerReturn::paginate(50);

        return view('invoices.sticker_issued',compact('issuedstickers','users'));

    }


    public function returnStickers()
    {

        $users = User::get();
        $returnstickers = MotorDetails::orderby('created_on','desc')->paginate(30);

        return view('invoices.sticker_returns',compact('returnstickers','users'));

    }



public function createSticker(Request $request)
    {
      //dd($request->input('date_of_issue'));
        
        foreach (range($request->input('sticker_to'), $request->input('sticker_from')) as $number) 
      {
      //echo $number;
        //dd($number);
           $invoice = new StickerReturn;
           $invoice->sticker_range  = $request->input('sticker_from').' - '.$request->input('sticker_to');
           $invoice->sticker_number  = $number;
           $invoice->issued_to = $request->input('assigned_to');
           //$invoice->issued_on = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('date_of_issue'));
           $invoice->created_by = Auth::user()->getNameOrUsername();
           $invoice->created_on = Carbon::now();
           $invoice->save(); 

      
      }
           

            return redirect()
            ->route('sticker-returns')
            ->with('info','Sticker has successfully been created!');
    }



    public function getInvoices()
    {
        $paymenttypes = PaymentType::all();
        $bankaccounts = BankAccount::all();


        //$bills        =  BillMaster::with('payments')->orderBy('created_on','desc')->paginate(30);
        
        $bills        =  Bill::where('payment_status','Unpaid')->where('flag','In Force')->orderBy('created_on','desc')->paginate(30);
        
        return View('invoices.invoice',compact('paymenttypes','bankaccounts','bills'));  
    }


    public function getInvoicesProcessed()
    {
        $paymenttypes = PaymentType::all();
        $bankaccounts = BankAccount::all();


        $bills        =  BillMaster::with('payments')->orderBy('created_on','desc')->paginate(30);
        
        //dd($bills);
        //$bills        =  Bill::where('payment_status','Unpaid')->orderBy('created_on','desc')->paginate(30);
        
        return View('invoices.debtmanagement',compact('paymenttypes','bankaccounts','bills'));  
    }




    public function getProcessedInvoices()
    {
        $paymenttypes = PaymentType::all();
        $bankaccounts = BankAccount::all();
        $payments          =  Payments::orderBy('created_on','desc')->paginate(30);
        return View('invoices.payment',compact('paymenttypes','bankaccounts','payments'));  
    }




     public function getCommissions()
    {
       
        $bills =  Payments::where('commission_status','Pending')->orderBy('created_on','desc')->paginate(30);
        return View('commission.index',compact('bills'));
        
    }



    public function processCommssion($id)
    {

      $mysticker =0;
      $mytax    = 0;

      $stickercharge =  Taxes::where('tax','Sticker')->first();
      $tax_rate =  Taxes::where('tax','Broker Tax')->first();

      $mysticker =  $stickercharge->rate;
      $mytax     =  $tax_rate->rate;

      $payment = Payments::where('id',$id)->first();

     
      $bills = Bill::where('invoice_number',$payment->invoice_number)->get();
      // dd($stickercharge);
       return View('commission.compute',compact('bills','mysticker','mytax','payment'));

    }


    public function doCommissionPaid()
    {       
        
        $billid = Input::get("ID");
        $commssionamount = Input::get("amountpaid");


            $affectedRows = Bill::where('id', '=', $billid)->update(array('commission' => 'Paid','commission_amount' => $commssionamount ));

            if($affectedRows > 0)
            {

                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }


    }

    public function printProforma($id)
    {

    $bills=ProformaInvoice::where('id' ,'=', $id)->first();
    return view('invoices.quick_print', compact('bills'));


    }

    public function loadProformaInvoices()
    {

    $customers =  Customer::where('created_by',Auth::user()->getNameOrUsername())->get();
    $producttypes = PolicyProductType::orderby('type','asc')->get();
    $currencies   = Currency::all();
    $users =  User::all();

    $bills =  ProformaInvoice::orderBy('created_on','desc')->paginate(30);
    return view('invoices.quick_invoices', compact('customers','bills','producttypes','currencies','users'));
    }


    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y', $date);
        return $time->format('Y-m-d');
    }

    public function generateInoviceNumber()
    {
    $number = Serials::where('name','=','proforma')->first();
    $number = $number->counter;
    $account = str_pad($number,7, '0', STR_PAD_LEFT);
    $myaccount= 'PRO'.$account;

    Serials::where('name','=','proforma')->increment('counter',1);
    return  $myaccount;
    }

    public function createProforma(Request $request)
    {
         $time = explode(" - ", $request->input('insurance_period'));
         $invoicenumberval = $this->generateInoviceNumber(10);

           $invoice = new ProformaInvoice;
           $invoice->invoice_number  = $invoicenumberval;
           $invoice->account_name  = $request->input('account_holder');
           $invoice->business_class = $request->input('business_class');
           $invoice->account_manager = $request->input('account_manager');
           $invoice->currency = $request->input('currency');
           $invoice->sum_insured = $request->input('sum_insured');
           $invoice->gross_premium = $request->input('gross_premium');
           $invoice->status = $request->input('status');
           $invoice->description = $request->input('description');
           $invoice->insurance_period_from  = $this->change_date_format($time[0]);
           $invoice->insurance_period_to    = $this->change_date_format($time[1]);
           $invoice->created_by = Auth::user()->getNameOrUsername();
           $invoice->created_on = Carbon::now();
          
           $invoice->save(); 
            return redirect()
            ->route('/quick-invoices')
            ->with('info','Invoice has successfully been created!');
    }



     public function printInvoice($id)
   {

    $customerid = Bill::where('id' ,'=', $id)->first();
    $customers  = Customer::where('id' ,'=', $customerid->account_number)->first();
    $bills      = Bill::where('policy_number' , $customerid->policy_number)->get();

    $numberToWords = new NumberToWords();
    $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
    $amountinwords =  $currencyTransformer->toWords($bills->sum('amount') *100, $customerid->currency);


    return view('invoices.print', compact('customers','bills','amountinwords'));

    }


     public function printReceipt($id)
   {
    $bills      = Payments::where('id',$id)->first();

    $numberToWords = new NumberToWords();
    $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
    $amountinwords =  $currencyTransformer->toWords($bills->amount_paid * 100, $bills->currency);

    //dd($amountinwords);

    return view('invoices.receipt', compact('bills','amountinwords'));

    }



    public function printtoPDF($id)
    {
        $customerid = PendingBills::where('id' ,'=', $id)->pluck('account_number');
        $customers =  Customer::where('id' ,'=', $customerid)->first();
        $bills=Bill::where('id' ,'=', $id)->where('status', 'Unpaid')->orderBy('created_on', 'ASC')->first();

        $pdf = PDF::loadView('invoices.print', compact('customers','bills'));
        return $pdf->download('invoice.pdf');

    }

     public function getdebts()
    {
        $bills=PendingBills::where('status', 'Unpaid')->paginate(30);
        return View('invoices.debtmanagement',compact('bills'));
    }


     public function getinsurerreports()
    {

        return View('invoices.insurer');
    }

    public function getpayments()
    {
    	$paymenttypes = PaymentType::all();
    	$bankaccounts = BankAccount::all();
        $payments = Payments::paginate();
        return View('invoices.payment',compact('paymenttypes','bankaccounts','payments'));
    }

      public function dosendInvoices()
    {
    
        return View('invoices.sendinvoices');
    }



     public function createAccount(Request $request)
    {
    	  $this->validate($request, [
            'account_number'=> 'required|unique:bank_accounts|min:3',
            'bank_name'=> 'required',
            'currency'=> 'required',
            
            ]); 


           $bankaccount = new BankAccount;
           $bankaccount->bank_name  = $request->input('bank_name');
           $bankaccount->account_name = $request->input('account_name');
           $bankaccount->account_number = $request->input('account_number');
           $bankaccount->currency = $request->input('currency');
           $bankaccount->created_by = Auth::user()->getNameOrUsername();
           $bankaccount->created_on = Carbon::now();
          
           $bankaccount->save(); 
            return redirect()
            ->route('bank-accounts')
            ->with('info','Bank Account has successfully been created!');
    	
    }



    public function makePayment($id)
    {

        $paymenttypes = PaymentType::all();
        $receipttypes = ReceiptType::all();

        $billindex = Bill::where('id',$id)->first();
        $customer = Customer::where('account_number',$billindex->account_number)->first();
        $bills = Bill::where('invoice_number',$billindex->invoice_number)->get();


        //dd($bills);
        return view('invoices.pay',compact('bills','paymenttypes','billindex','receipttypes','customer'));


    }

    public function searchInvoice(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $paymenttypes = PaymentType::all();
        $bankaccounts = BankAccount::all();
        
        $bills        =  BillMaster::where('fullname', 'like', "%$search%")
            ->orWhere('invoice_number', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


       return View('invoices.invoice',compact('paymenttypes','bankaccounts','bills'));
  
    }

    public function searchPayment(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

       
        $payments        =  Payments::where('insured', 'like', "%$search%")
            ->orWhere('invoice_number', 'like', "%$search%")
            ->orWhere('receipt_number', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


       return View('invoices.payment',compact('payments'));
  
    }

    public function searchCommission(Request $request)
    {
      

       
        $search = $request->get('search');

     
        $stickercharge =  Taxes::where('tax','Sticker')->pluck('rate');
        $broker_tax_rate =  Taxes::where('tax','Broker tax')->pluck('rate');

        $time   = explode(" - ", Input::get('commission_period')); 
        

        if(!$search=="")
        {
           $bills        =  Payments::where('insured', 'like', "%$search%")
            ->orWhere('invoice_number', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orWhere('agency', 'like', "%$search%")
            ->orWhere('policy_product', 'like', "%$search%")
             ->orWhere('branch', 'like', "$search%")
            ->orderBy('created_on','desc')
            ->paginate(30)
            ->appends(Input::except('page'));
        }
        else
        {
            $from = Carbon::parse($time[0])->format('Y-m-d');
            $to = Carbon::parse($time[1])->format('Y-m-d');

            //dd($from);

            $bills = Payments::whereBetween('created_on',array($from,$to))
            ->orderBy('created_on','desc')
            ->paginate(30)
            ->appends(Input::except('page'));
        }


       return View('commission.index',compact('bills','stickercharge','broker_tax_rate'));
  
    }

   



public function generatePin()
{
    $number = Serials::where('name','=','receipt')->first();
    $number = $number->counter;
    $account = str_pad($number,7, '0', STR_PAD_LEFT);
    $myaccount= 'RPT'.$account;

    Serials::where('name','=','receipt')->increment('counter',1);
    return  $myaccount;

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





    public function processCommissionBulk(Request $request)
    {


    $receiptnumber    =   $request->input('receipt_number');
    $receipt = Payments::where('receipt_number',$receiptnumber)->first();
   
    $commssionid = uniqid(10);
    


        $input = $request->all();

        //dd(count($input['item']));
        for($i=0; $i<= count($input['item']); $i++) {

            if(empty($input['item'][$i])) continue;

          //dd($input);
          $data = [ 
           'serial'           => $commssionid,
           'insured_name'     => $receipt->insured,
           'policy_number'    => $receipt->policy_number,
           'receipt_number'   => $receipt->receipt_number,
           'invoice_number'   => $receipt->invoice_number,
           'agent_number'     => $receipt->agency,
           'agent_name'       => $receipt->agency,
           'transaction_type' => $receipt->transaction_type,
           'branch'           => $receipt->branch,
           'collection_mode'  => $receipt->collection_mode,
           'policy_product'   => $receipt->policy_product,
           'exchange_rate'    => $receipt->exchange_rate,
           'receipt_date'     => $receipt->receipt_date,
           'currency'         => $receipt->currency,
           'reference_number' => $input['item'][$i],
           'commission_rate'  => $input['commission_rate'][$i],
           'amount_payable'   => $input['amount_payable'][$i],
           'amount_paid'      => $input['amount_paid'][$i],
           'sticker_charge'   => $input['sticker_charge'][$i],
           'gross_commission' => $input['gross_commission'][$i],
           'tax'              => $input['tax_charged'][$i],
           'net_commission'   => $input['net_commission'][$i],
           'created_on'       => Carbon::now(),
           'created_by'       => Auth::user()->getNameOrUsername()
          ];
            
            //dd($data);
            CommissionProcessed::create($data);
          }

          return redirect()
          ->route('/commission')
          ->with('success','Receipt for commission successfully processed');


    }



     public function processCommissionBulkMaster(Request $request)
    {

      $receipt_checked = $request->input('item');
    //dd($salary_checked);
      
    if(is_array($receipt_checked))
    {
      foreach($receipt_checked as $receipt_checked)
      {

        $receipt = Payments::where('id',$receipt_checked)->first();
         $commssionid = uniqid(10);

         $mysticker =  Taxes::where('tax','Sticker')->pluck('rate');
         $mytax =  Taxes::where('tax','Broker tax')->pluck('rate');

         $mygrosscommssion = 0.00;
         $stickercharge = 0.00;
         $taxcharged =  0.00;
  

          //dd($mysticker[0]);

          if($receipt->policy_product == 'Motor Insurance')
           {
             $stickercharge = ($receipt->amount_payable * ((($receipt->amount_paid/$receipt->amount_payable)  / $receipt->amount_payable ) * $mysticker[0]));
           }
          else
          {
                $stickercharge = 0;
          }


          if($receipt->policy_product == 'Motor Insurance')
            {
             $mygrosscommssion = ((($receipt->amount_payable * ($receipt->amount_paid/$receipt->amount_payable)) - (($receipt->amount_payable * ($receipt->amount_paid/$receipt->amount_payable)  / $receipt->amount_payable ) * $mysticker[0]))* $receipt->commission_rate/100); 

             }
              else
               {
                ($mygrosscommssion = $receipt->amount_payable * ($receipt->amount_paid/$receipt->amount_payable)) * $receipt->commission_rate/100;
               }

          if($receipt->policy_product == 'Motor Insurance')
            { 
              $taxcharged =  (((($receipt->amount_payable * ($receipt->amount_paid/$receipt->amount_payable)) - (($receipt->amount_payable * ($receipt->amount_paid/$receipt->amount_payable)  / $receipt->amount_payable ) * $mysticker[0]))* $receipt->commission_rate/100 ) * $mytax[0]/100); 
            }
              else
            { 
              $taxcharged = (($receipt->amount_payable * ($receipt->amount_paid/$receipt->amount_payable)) * $receipt->commission_rate/100) * $mytax/100; 
            }
              




           $commission        = new CommissionProcessed; 
           $commission->serial = $commssionid;
           $commission->insured_name     = $receipt->insured;
           $commission->policy_number    = $receipt->policy_number;
           $commission->receipt_number   = $receipt->receipt_number;
           $commission->invoice_number   = $receipt->invoice_number;
           $commission->agent_number     = $receipt->agency;
           $commission->agent_name       = $receipt->agency;
           $commission->transaction_type = $receipt->transaction_type;
           $commission->branch           = $receipt->branch;
           $commission->collection_mode  = $receipt->collection_mode;
           $commission->policy_product   = $receipt->policy_product;
           $commission->exchange_rate    = $receipt->exchange_rate;
           $commission->receipt_date     = $receipt->receipt_date;
           $commission->currency         = $receipt->currency;
           $commission->reference_number = $receipt->reference_number;
           $commission->commission_rate  = $receipt->commission_rate;
           $commission->amount_payable   = $receipt->amount_payable;
           $commission->amount_paid      = $receipt->amount_paid;
           $commission->sticker_charge   = $stickercharge;
           $commission->reference_number = $receipt->id;
           $commission->gross_commission = $mygrosscommssion;
           $commission->tax              = $taxcharged;
           $commission->net_commission   = $mygrosscommssion - $taxcharged;
           $commission->created_on       = Carbon::now();
           $commission->created_by       = Auth::user()->getNameOrUsername();
           
           if($commission->save())
           {


            $affectedRows = Payments::where('id', $receipt_checked)->update(array('commission_status' => 'Processed'));
           }
            
            //dd($data);
           
          }

        }


          return redirect()
          ->route('/commission')
          ->with('success','Receipt for commission successfully processed');


    }



    public function getProcessedCommssions()
    {

      $commissions = CommissionSummary::paginate(30);
      return view('commission.processed',compact('commissions'));
    }

     public function printCommissionAdvice($id)
    {

      $selectedcommission = CommissionProcessed::where('id',$id)->first();

      $commissions = CommissionSummary::where('agent_name',$selectedcommission->agent_name)->where('currency',$selectedcommission->currency)->get();
      return view('commission.paymentadvice',compact('commissions','selectedcommission'));
    }



    public function doPayment(Request $request)
    {

        //dd($request->all());

          if($request->input('amountreceived') != 0)

      {
        $receiptnumber = uniqid();
        //dd($receiptnumber);

        $id = $request->input('billid');
        $billdetails = Bill::where('id',$id)->first();
        //$contactnumber = Customer::where('account_number',$billdetails)

        

        $payments                   = new Payments();
        $payments->receipt_type     = $request->input('receipt_type');
        $payments->receipt_number   = $receiptnumber;
        $payments->invoice_number   = $billdetails->invoice_number;
        $payments->receipt_date     = Carbon::now();
        $payments->currency         = $billdetails->currency;
        $payments->amount_payable   = $request->input('payable');
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
        $payments->flag             = 'Active';
        $payments->policy_number    = $billdetails->policy_number;
        $payments->agency           = $billdetails->agency;
        $payments->policy_product   = $billdetails->policy_product;
        $payments->account_number   = $billdetails->account_number;
        $payments->insured          = $billdetails->fullname;
        $payments->exchange_rate    = $billdetails->exchange_rate;
        $payments->commission_rate  = $billdetails->commission_rate;
        
        //dd($payments);
        if($payments->save())
        {

            $affectedRows = Bill::where('invoice_number', $billdetails->invoice_number)
            ->update(array(
                           'payment_status' => 'Paid'
                           ));

            $sms = 'Dear Cherished Customer, a premium of '.$billdetails->currency.$request->input('amountreceived').' has been paid on your Policy. Thank You. Phoenix Insurance: Wisdom!';
            $this->SendSMS($sms,'0541448708');


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
       else
    {

        return redirect()
            ->back()
            ->with('error','Error processing payments!');
    }
    
    }


    public function SendSMS($content,$phone)
    {

    $messages = $content;

    // Here we assume the user is using the combination of his clientId and clientSecret as credentials
    $auth = new BasicAuth("ciiihqvu", "vjhfjgrv");

    // instance of ApiHost
    $apiHost = new ApiHost($auth);
    $enableConsoleLog = TRUE;
    $messagingApi = new MessagingApi($apiHost, $enableConsoleLog);

  
    try 
    {
        // Default Approach
        $mesg = new Message();
        $mesg->setContent($messages);
        $mesg->setTo($phone);
        $mesg->setFrom("Phoenix");
        $mesg->setRegisteredDelivery(true);

        $messageResponse = $messagingApi->sendMessage($mesg);

        //$response_code = SMS::where('id', '=', $message->id)->update(array('status' => 'Sent'));

    
    } 
    catch (Exception $ex) 
    {
        //echo $ex->getTraceAsString();
    }
}


    public function fetchInvoiceDetails()
    {
      //dd($opd_id);
    $id = Input::get('id');
    $user = Bill::find($id);
    $data = Array(
        'payer_id'          =>$user->account_number,
        'payer_name'        =>$user->insured_name,
        'amount'            =>$user->amount,
        'payable'           =>$user->amount,
        'reference_number'  =>$user->invoice_number,
        'policy_number'     =>$user->policy_number,
       
    );
        return Response::json($data);
    }



}
