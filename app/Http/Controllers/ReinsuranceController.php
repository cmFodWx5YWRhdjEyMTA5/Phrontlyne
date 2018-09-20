<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\Reinsurance;
use Phrontlyne\Models\TreatyBordeux;
use Phrontlyne\Models\PendingReinsurances;
use Phrontlyne\Http\Requests;
use Phrontlyne\Models\Reinsurers;
use Phrontlyne\Models\Bank;
use Phrontlyne\Models\FacApportionments;
use Phrontlyne\Models\FacPayments;
use Phrontlyne\Models\ProportionalArrangement;
use Phrontlyne\Models\Bill;
use Phrontlyne\Models\Claim;
use Phrontlyne\Models\AuthorityList;
use Phrontlyne\Models\MotorDetails;
use Phrontlyne\Models\EngineeringDetails;
use Phrontlyne\Models\BondDetails;
use Phrontlyne\Models\FireDetails;
use Phrontlyne\Models\MarineDetails;
use Phrontlyne\Models\AccidentDetails;
use Phrontlyne\Models\LiabilityDetails;
use Phrontlyne\Http\Controllers\Controller;
use Input;
use Response;
use Carbon\Carbon;
use Auth;
use Activity;
use Mail;


class ReinsuranceController extends Controller
{
     public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('role:System Admin|Reinsurance Officer|Reinsurance Manager|Manager');
    }
    
    public function index()
    {
        $reinsurances = Reinsurance::where('company_offer','>',0)->where('status','Pending to be Ceded')->where('flag','In Force')->orderby('record_date','desc')->paginate(30);
        
        $pendingcount = Reinsurance::where('company_offer','>',0)->where('status','Pending to be Ceded')->where('flag','In Force')->orderby('record_date','desc')->count();
        $cededcount = Reinsurance::where('company_offer','>',0)->where('status','<>','Pending to be Ceded')->orderby('record_date','desc')->count();

        return view('reinsurance.index', compact('reinsurances','pendingcount','cededcount'));
    }

     public function cededbusiness()
    {
        $reinsurances = Reinsurance::where('company_offer','>',0)->where('status','<>','Pending to be Ceded')->orderby('record_date','desc')->paginate(30);

        $pendingcount = Reinsurance::where('company_offer','>',0)->where('status','Pending to be Ceded')->where('flag','In Force')->orderby('record_date','desc')->count();
        $cededcount = Reinsurance::where('company_offer','>',0)->where('status','<>','Pending to be Ceded')->orderby('record_date','desc')->count();

        return view('reinsurance.index', compact('reinsurances','pendingcount','cededcount'));
    }

    public function treatybusinesses()
    {
        $reinsurances = TreatyBordeux::orderby('record_date','desc')->paginate(30);

        return view('reinsurance.treaty', compact('reinsurances'));
    }

     public function disposed()
    {
        $reinsurances = Reinsurance::orderby('client_name','asc')->where('status','Disposed')->paginate(30);

        return view('reinsurance.index', compact('reinsurances'));
    }

    public function viewcession($id)
    {
        $banks     = Bank::orderby('name','asc')->get();
        $cessions = Reinsurance::where('cession_number',$id)->first();
        $reinsurers = Reinsurers::orderby('name','asc')->get();
        $apportionments = FacApportionments::where('cession_number',$id)->get();
        $payments = FacApportionments::where('cession_number',$id)->get();
        $bills = Bill::where('policy_number',$cessions->policy_number)->get();
        $claims   = Claim::where('reference_number',$cessions->policy_number)->get();

        return view('reinsurance.cession', compact('cessions','reinsurers','apportionments','banks','bills','claims'));
    }


    public function viewcessiontreaty($id)
    {
        $banks     = Bank::orderby('name','asc')->get();
        $cessions = TreatyBordeux::where('cession_number',$id)->first();
        $reinsurers = Reinsurers::orderby('name','asc')->get();
        $apportionments = FacApportionments::where('cession_number',$id)->get();
        $payments = FacApportionments::where('cession_number',$id)->get();
        $bills = Bill::where('policy_number',$cessions->policy_number)->get();

        return view('reinsurance.cession', compact('cessions','reinsurers','apportionments','banks','bills'));
    }

    public function printarrangement($id)
    {

         $cessions = Reinsurance::where('cession_number',$id)->first();
        return view('reinsurance.arrangementslip', compact('cessions'));
    }


     public function printfaccover($id)
    {

         $cessions = Reinsurance::where('cession_number',$id)->first();
         $apportionments = FacApportionments::where('cession_number',$id)->get();
        return view('reinsurance.cover', compact('cessions','apportionments'));
    }

     public function printfacslip($id)
    {

        $apportionments = FacApportionments::find($id);
         $cessions = Reinsurance::where('cession_number',$apportionments->cession_number)->first();


         switch($cessions->business_class) 
    {
      
         case 'Motor Insurance':
             $fetchrecord = MotorDetails::where('policy_number',$cessions->policy_number)->where('vehicle_registration_number',$cessions->item_id)->first();
            break;

     case 'Bond Insurance':
             $fetchrecord = BondDetails::where('policy_number','=',$cessions->policy_number)->first();
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('policy_number','=',$cessions->policy_number)->first();
            break;

        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('policy_number','=',$cessions->policy_number)->first();
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('policy_number','=',$cessions->policy_number)->first();

        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('policy_number','=',$cessions->policy_number)->first();
            break;
        }
         
        return view('reinsurance.facslip', compact('cessions','apportionments','fetchrecord'));
    }

     public function printpaymentslip($id)
    {

        $payments = FacPayments::where('id',$id)->get();
        
        $cessions = Reinsurance::where('cession_number',$payments[0]->cession_number)->first();

        return view('reinsurance.paymentslip', compact('cessions','payments'));
    }


    public function printRequisition($id)
    {
        $requisition = FacPayments::where('id',$id)->first();
        $cession     = Reinsurance::where('cession_number',$requisition->cession_number)->first();

        $authoritylist = AuthorityList::where('type','FAC Requisition')->get();

        return view('reinsurance.requisition', compact('cession','requisition','authoritylist'));
        
    }


    public function sendApprovalRequest()
    {

        $email = Input::get("approver");
        $amount = Input::get("amount");
        $reinsurer = Input::get("reinsurer");
        $netpremium = Input::get("netpremium");
        $commission = Input::get("commission");
        $currency = Input::get("currency");
        $url = Input::get("url");

         Mail::send('email.requisition', array('currency' => $currency, 'url' => $url, 'amount'=>$amount,'reinsurer'=>$reinsurer,'netpremium'=> $netpremium,'commission' => $commission)  , function ($message) use ($email) 
        { 
            $message->from('reinsurance@phoenixinsurancegh.com', 'Phrontlyne');
                        
            $message->to($email)->subject('FAC Requisition Approval Request'); 
                
        }); 


         return Response::json(['OK'=>'OK']);

    }

    public function approveRequisition()
    {     
          

             $affectedRows = FacPayments::where('id',Input::get("ID"))
                    ->update(array(
                                   'checked_by' => Auth::user()->getNameOrUsername(),
                                   'checked_on' => Carbon::now()));

    

            if($affectedRows > 0)
            {
            
                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


     public function approveRequisitionFinance()
    {     
          

             $affectedRows = FacPayments::where('id',Input::get("ID"))
                    ->update(array(
                                   'approved_by' => Auth::user()->getNameOrUsername(),
                                   'approved_on' => Carbon::now()));

    

            if($affectedRows > 0)
            {
            
                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

    }


    public function printReceipts($id)
    {

        $requisition = FacPayments::where('id',$id)->first();
        $cession = Reinsurance::where('cession_number',$requisition->cession_number)->first();
        return view('reinsurance.receipt', compact('cession','requisition'));

    }





    public function pending()
    {
        $reinsurances = PendingReinsurances::paginate(30);

        return view('reinsurance.pending', compact('reinsurances'));
    }


     public function getSearchResults(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $reinsurances = Reinsurance::where('fullname', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orWhere('item_id', 'like', "%$search%")
             ->orWhere('status', 'like', "%$search%")
            ->orWhere('business_class', 'like', "%$search%")
            ->orWhere('cession_number', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

         $pendingcount = Reinsurance::where('company_offer','>',0)->where('status','Pending to be Ceded')->where('flag','In Force')->orderby('record_date','desc')->count();
        $cededcount = Reinsurance::where('company_offer','>',0)->where('status','<>','Pending to be Ceded')->orderby('record_date','desc')->count();


        return View('reinsurance.index',compact('reinsurances','pendingcount','cededcount'));
  
    }


    public function getSearchResultsTreaty(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $reinsurances = TreatyBordeux::where('fullname', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orWhere('item_id', 'like', "%$search%")
             ->orWhere('status', 'like', "%$search%")
            ->orWhere('business_class', 'like', "%$search%")
            ->orWhere('cession_number', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


        return View('reinsurance.treaty',compact('reinsurances'));
  
    }


     public function makePayment()
   {
            
            $payer_id  = Input::get("payer_id");
            $payment_type = Input::get("payment_type");
            $payment_date = Carbon::createFromFormat('d/m/Y', Input::get("payment_date"));
            $payment_description = Input::get("payment_description");
            $reference_name = Input::get("reference_name");
            $reference_number = Input::get("cash_receipt_number");

            //dd(Input::get('payment_date'));
           
             $affectedRows = FacPayments::where('pv_number', '=', $payer_id)
            ->update(array(
                           'payment_mode' =>  $payment_type,
                           'cheque_date' => $payment_date, 
                           'description' => $payment_description, 
                           'bank' => $reference_name, 
                           'cheque_number' =>  $reference_number, 
                           'receipt_number' =>  uniqid(10), 
                           'status' =>  'Paid',
                           'released' =>  'Yes',  
                           'updated_by'=> Auth::user()->getNameOrUsername(),
                          'updated_on'=>Carbon::now()));

            if($affectedRows > 0)
            {
                Activity::log([
              'contentId'   =>  $payer_id,
              'contentType' => 'User',
              'action'      => 'Update',
              'description' => 'Updated PV details of '.$payer_id,
              'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
              ]);
        
             
              return redirect()
            ->back()
            ->with('success','Payment has been mapped to PV successfully!');
            }
            else
            {
               return redirect()
            ->back()
            ->with('error','Error occured in mapping!');
            }

   }




    public function doapportionment()
    {


        $computeval = Reinsurance::where('cession_number',Input::get("cession_number"))->first();

        $getsavedapportions = FacApportionments::where('cession_number',Input::get("cession_number"))->get();
       
        
        $processedapportions = 0;
        foreach ($getsavedapportions as $apportion => $oldapportion) 
        {
            $processedapportions += $oldapportion->rate;
        }


        $fac_rate = $computeval->facultative_percentage;
        $net_premium = $computeval->net_premium;
        $apportioned_rate = Input::get("reinsurer_rate");

        $apportionedamount = ($apportioned_rate/$fac_rate) * $net_premium;

        $total_apportions = $processedapportions + $apportioned_rate;

        $surplus =  $fac_rate - $total_apportions;

        $apportionment                  = new FacApportionments;
        $apportionment->cession_number  = Input::get("cession_number");
        $apportionment->reinsurer       = Input::get("reinsurer");
        $apportionment->rate            = Input::get("reinsurer_rate");
        $apportionment->amount          = $apportionedamount;
        $apportionment->created_on      = Carbon::now();
        $apportionment->created_by      = Auth::user()->getNameOrUsername();
      
        if($total_apportions > $fac_rate)
        {
            
            $added_response = array('Surplus'=>'Surplus');
            return  Response::json($added_response);

        }

        else
        {

        if($apportionment->save())
            {

                $affectedRows = Reinsurance::where('cession_number', Input::get("cession_number"))->update(array('status' => 'Ceded'));

                $added_response = array('OK'=>'OK','SurplusRate' => $surplus);
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }

        }

    }

    public function excludePolicy()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Reinsurance::where('id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }


    public function getReinsurerPremium()
   {

          try
    {
            $cession_number = Input::get('cession_number');
            $reinsurer      = Input::get('reinsurer');
            $vouchers =FacApportionments::where('cession_number',$cession_number)->where('reinsurer',$reinsurer)->first();
             $data = Array(
                'pv_amount' => $vouchers->amount
                // 'payer_id'=>$vouchers->pv_number,
                // 'payee_name'=>$vouchers->payee_name,
                // 'payment_description'=>$vouchers->description
                //'postal_address'=>$vouchers->postal_address,
                //'gender'=>$user->gender
                
            );
            return  Response::json($data);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }

   }



    public function getRequisitionDetails()
   {

          try
    {
            $id             = Input::get('id');
         
            $requisitions   = FacPayments::find($id);
             $data = Array(
                 'payment_amount' => $requisitions->pv_amount,
                 'payer_id'=>$requisitions->pv_number,
                 'payer_name'=>$requisitions->pv_payee_name,
                 'payment_description'=>$requisitions->description
                 
                
            );
            return  Response::json($data);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }

   }


    public function dopayments()
    {
        $voucher                  = new FacPayments;
        $voucher->cession_number  = Input::get('cession_number');  
        $voucher->pv_number       = uniqid(5);  
        $voucher->pv_payee_name   = Input::get('pv_payee_name');  
        $voucher->payment_mode    = Input::get('pv_payment_mode');
        $voucher->cheque_number   = Input::get('pv_cheque_number');  
        $voucher->pv_date         = Carbon::createFromFormat('d/m/Y', Input::get("pv_date"));
        $voucher->currency        = Input::get('pv_currency');
        $voucher->description     = Input::get('pv_description');
        $voucher->pv_amount       = Input::get("pv_amount");
        $voucher->status          = 'Unpaid';
        $voucher->created_by      = Auth::user()->getNameOrUsername();
        $voucher->created_on      = Carbon::now(); 
        
        if($voucher->save())

            {
              $affectedRows = Reinsurance::where('cession_number', Input::get("cession_number"))->update(array('status' => 'Requistion sent to finance'));
              $added_response = array('OK'=>'OK');
              return  Response::json($added_response);
            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }
    }


    public function deleteRequisition()
    {

          if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = FacPayments::where('id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }


    }

    public function updateArrangement()
    {

        $ID = Input::get("cessionid");
         $oldcession_number = Input::get("cession_number");

        // dd($ID);

        $transaction = Reinsurance::where('id',$ID)->first(); 



        $suminsured = $transaction->sum_insured;
        $premium = $transaction->premium;
        $year = Carbon::parse($transaction->period_from)->year;

          

        $policy_product = $transaction->business_class; 
        $phicrate = Input::get("phic_percentage");
        $commissionrate = Input::get("comm_on_facultative");
        $reinsurer = Input::get("reinsurer");
        $transactionid    = $transaction->cession_number;


         //dd($phicrate);

        $arrangements = ProportionalArrangement::where('year',$year)->where('product_type',$policy_product)->first();

        //dd($arrangements);

        if($suminsured >= $arrangements->company_retention)
        {    
            
        $retention = $arrangements->company_retention;
        $layer1 =  $arrangements->layer1;
        $layer2 =  $arrangements->layer2;
        $layer3 =  $arrangements->company_retention;

        //dd($arrangements);

        try
            {
                $premiumrate = 100;


                $retentionrate = ($retention / $suminsured) * 100;
                $retentionpremium = ($retentionrate / 100) * $premium;

                $surplus1 = $suminsured - $retention;
               
                if ($surplus1 >= $layer1)
                {
                    $surplus1value = $layer1;
                    $surplus1rate = ($surplus1value / $suminsured) * 100;
                    $surplus1premium = ($surplus1rate / 100) * $premium;
                }

                if ($surplus1 <= $layer1)
                {
                    $surplus1value = $surplus1;
                    $surplus1rate = ($surplus1value / $suminsured) * 100;
                    $surplus1premium = ($surplus1rate / 100) * $premium;
                }



                $surplus2 = $suminsured - $retention -  $surplus1value;

                //dd($suminsured,$retention,$surplus1value);

                if ($surplus2 >= $layer2)
                {
                    $surplus2value = $layer2;
                    $surplus2rate = ($surplus2value / $suminsured) * 100;
                    $surplus2premium = ($surplus2rate / 100) * $premium;
                }

                if ($surplus2 <= $layer2)
                {
                    $surplus2value = $surplus2;
                    $surplus2rate = ($surplus2value / $suminsured) * 100;
                    $surplus2premium = ($surplus2rate / 100) * $premium;
                }

             

                //Offer Compute
                $offer = ($suminsured - ($retention + $surplus1value + $surplus2value));
                $offerrate = ($offer / $suminsured) * 100;
                $offerpremium = ($offerrate / 100) * $premium;


                //PHIC Compute

                if($phicrate == 0)
                {
                    $phicpremium=0;
                    $PHIC =0;
                }   
                else
                {
                 $phicpremium = ($phicrate / $offerrate) * $offerpremium;
                 $PHIC = ($phicrate * $offer /$offerrate );
                }  

                //FAC Compute
                 $facrate = $offerrate - $phicrate;
                 $facultative = $offer - $PHIC;
                 $facpremium = $offerpremium - $phicpremium;

                //Commission Compute
                 $commission = $facpremium * ($commissionrate / 100);
               
                //Netpremium
                 $netpremium =  $facpremium - $commission;


                

                $facbusiness = new Reinsurance;
                $facbusiness->policy_number     =  $transaction->policy_number;
                $facbusiness->business_class    =  $transaction->business_class;
                $facbusiness->fullname          =  $transaction->fullname;
                $facbusiness->cover_type        =  $transaction->cover_type;
                $facbusiness->currency          =  $transaction->currency; 
                $facbusiness->period_from       =  $transaction->period_from;
                $facbusiness->period_to         =  $transaction->period_to;
                $facbusiness->item_id           =  $transaction->item_id;
                $facbusiness->exchange_rate     =  $transaction->exchange_rate;
                $facbusiness->premium_type      =  $transaction->premium_type;
                $facbusiness->document_number   =  $transaction->document_number;

                $facbusiness->rate              = $premiumrate;
                $facbusiness->sum_insured       = $suminsured;
                $facbusiness->company_retention = $retention;
                $facbusiness->first_surplus     = $surplus1value;
                $facbusiness->second_surplus    = $surplus2value;
                $facbusiness->company_offer     = $offer;
                $facbusiness->company_share     = $PHIC;
                $facbusiness->facultaive_offer  = $facultative;
                $facbusiness->reinsurer_broker  = $reinsurer;
                $facbusiness->comments          = '';


                $facbusiness->premium_percentage        = $premiumrate;
                $facbusiness->retention_percentage      = $retentionrate;
                $facbusiness->first_suplus_percentage   = $surplus1rate;
                $facbusiness->second_suplus_percentage  = $surplus2rate;
                $facbusiness->comp_offer_percentage     = $offerrate;
                $facbusiness->phic_percentage           = $phicrate;
                $facbusiness->facultative_percentage    = $facrate;

                $facbusiness->premium                   = $premium;
                $facbusiness->retention_on_prem         = $retentionpremium;
                $facbusiness->first_sup_on_prem         = $surplus1premium;
                $facbusiness->second_sup_on_prem        = $surplus2premium;
                $facbusiness->offer_on_prem             = $offerpremium;
                $facbusiness->phic_on_prem              = $phicpremium;
                $facbusiness->facultative_on_prem       = $facpremium;
                $facbusiness->facultative_comm          = $commission;
                $facbusiness->comm_on_facultative       = $commissionrate;
                $facbusiness->net_premium               = $netpremium;

                $facbusiness->cession_number            = $transactionid;
                $facbusiness->record_date               = Carbon::now();
                $facbusiness->created_by                = Auth::user()->getNameOrUsername();
                $facbusiness->approved_by               = '';
                $facbusiness->approved_on               = '';
                $facbusiness->processed_by              = '';
                $facbusiness->processed_on              = '';
                $facbusiness->treaty_year               = $year;
                $facbusiness->legal_cession             = $transaction->cession_number;
                $facbusiness->status                    = 'Pending to be Ceded';
                

                if($facbusiness->save())
                                    {    

                                  $affectedRows = Reinsurance::where('id', '=', $ID)->delete();
                                
                                    return redirect()
                                    ->route('view-cession',$transactionid)
                                    ->with('success','Arrangement has successfully been created!');

                                    }

                                    else
                                      {
                                         return redirect()
                                        ->back()
                                        ->with('error','Arrangement failed to create!');
                                      }

     
            }

            catch(\Exception $e) 
            {
                echo 'hihi'.$e;
            }

        }

        else
        {



        }

    }



    public function deleteApportionment()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = FacApportionments::where('id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }

    public function deletePayment()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = FacPayments::where('id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }



public function getapportionment()
{

    try
    {

            $cession_number = Input::get("cession_number");
            $items = FacApportionments::where('cession_number',$cession_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}

public function getPayments()
{

    try
    {

            $cession_number = Input::get("cession_number");
            $items = FacPayments::where('cession_number',$cession_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}



 public function getPVReinsurer()
{

    try
    {

            $cession_number = Input::get("cession_number");
            $items = FacApportionments::where('cession_number',$cession_number)->get();
            return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}



    public function dispose()
    {
       
         
            $transactionid = Input::get("ID");

            $affectedRows = Reinsurance::where('id', '=', $transactionid)->update(array('status' => 'Disposed'));

            if($affectedRows > 0)
            {
                //SEND EMAIL 
                //SEND SMS

                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }
    }

    
}
