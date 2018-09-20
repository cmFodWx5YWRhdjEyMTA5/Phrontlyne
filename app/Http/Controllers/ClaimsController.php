<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\User;
use Phrontlyne\Models\Customer;
use Phrontlyne\Models\ClaimStatus;
use Phrontlyne\Models\SelectStatus;
use Phrontlyne\Models\Currency;
use Phrontlyne\Models\Insurers;
use Phrontlyne\Models\ProcessedPolicy;
use Phrontlyne\Models\LossCause;
use Phrontlyne\Models\Claim;
use Phrontlyne\Models\ClaimProcessed;
use Phrontlyne\Models\Policy;
use Phrontlyne\Models\MotorDetails;
use Phrontlyne\Models\Image;
use Phrontlyne\Models\LossAdjustors;
use Phrontlyne\Models\LossAdjustments;
use Phrontlyne\Models\Claimant;
use Phrontlyne\Models\Bill;
use Phrontlyne\Models\FireDetails;
use Phrontlyne\Models\BondDetails;
use Phrontlyne\Models\PolicySerials;
use Phrontlyne\Models\MarineDetails;
use Phrontlyne\Models\LiabilityDetails;
use Phrontlyne\Models\EngineeringDetails;
use Phrontlyne\Models\AccidentDetails;
use Phrontlyne\Models\LiabilityReport;
use Phrontlyne\Models\Reinsurance;
use Phrontlyne\Models\ClaimantType;
use Phrontlyne\Models\NamedDriver;
use Phrontlyne\Models\PaymentVoucher;
use Phrontlyne\Models\TreatyBordeux;
use Phrontlyne\Models\LiabilityMemo;
use Phrontlyne\Models\BuyBackExcess;
use Phrontlyne\Models\PaymentType;
use Phrontlyne\Models\ProportionalArrangement;
use Phrontlyne\Models\Agent;
use Phrontlyne\Models\AuthorityList;
use Phrontlyne\Http\Requests;

use Phrontlyne\Http\Controllers\Controller;
use DB;
use Auth;
use Activity;
use Input;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use DateTime;

class ClaimsController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('role:System Admin|Claims Manager|Manager|Claims Officer');
    }


    public function startnewclaim()
    {

       $policies =  Policy::where('policy_status' ,'<>', 'Draft')->orderby('created_on','desc')->paginate(30);
       return view('claims.search', compact('policies'));

    }


    public function index()
    {

         $claims          = Claim::orderby('created_on','desc')->paginate(30);
        return View('claims.index',compact('claims'));
    }

     public function claimprofile($id)
    {
        
         $claims          = Claim::where('id',$id)->get()->first();
        $images          = AttachDocuments::where('accountnumber', $claims->claim_number )->get();
        return View('claims.view',compact('claims','images'));
    }


    public function viewPolicy($id)
    {
        
         $claims          = Claim::where('id',$id)->get()->first();
        $images          = AttachDocuments::where('accountnumber', $claims->claim_number )->get();
        return View('claims.view',compact('claims','images'));
    }



    public function loadRiskNumber()
   {

     try
    {

            $policynumber = Input::get("policy_number");
            $policyrisk =FireDetails::where('policy_number',$policynumber)->orderBy('name','asc')->get();
            return  Response::json($policyrisk);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }



      public function getSearchResultsPolicy(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $policies = Policy::where('policy_product', 'like', "%$search%")
            ->orWhere('itemid', 'like', "%$search%")
            ->orWhere('fullname', 'like', "%$search%")
            ->orWhere('account_number', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orWhere('master_policy_number', 'like', "%$search%")
            ->orderBy('account_number')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


        return View('claims.search',compact('policies'));
  
    }


  
    public function createClaim($id)
    {
   
    $policies        = Policy::where('id',$id)->first();
    $bills           = Bill::where('policy_number',$policies->policy_number)->get();
    $insured         = Customer::where('account_number',$policies->account_number)->first();
    //$vehicledetails  = MotorDetails::where('vehicle_registration_number',$policies[0]->itemid)->first();

    //dd($vehicledetails);
    $status_of_claim = ClaimStatus::get();
    $intermediary    = User::orderby('username','ASC')->get();
    $loss_causes     = LossCause::get();
    $lossadjustors   = LossAdjustors::get();
    $images          = Image::where('reference_number',$policies->item_id)->get();
    $cessions        = Reinsurance::where('item_id',$policies->item_id)->get();
    $claimanttypes   = ClaimantType::all();
    //$claimant        = Claimant::where('item_id',$policies->item_id)->get();



     switch($policies->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policies->ref_number)->first();
            $vehicles  = MotorDetails::where('ref_number','=',$policies->ref_number)->orderby('vehicle_registration_number','asc')->get();
            break;
        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('policy_number','=',$policies->policy_number)->first();
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('policy_number','=',$policies->policy_number)->first();
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('policy_number','=',$policies->policy_number)->first();
            break;

        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('policy_number','=',$policies->policy_number)->first();
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('policy_number','=',$policies->policy_number)->first();

        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('policy_number','=',$policies->policy_number)->first();
            break;

      }


    return view('claims.new', compact('intermediary','fetchrecord','claimanttypes','cessions','insured','vehicledetails','images','status_of_claim','loss_causes','policies','bills','lossadjustors'));
    }

    public function editClaim($id)
    {


    //$claimreference = $id;


   
    $claimdetails    = Claim::where('claim_id',$id)->first();
    $policies        = Policy::where('policy_number',$claimdetails->reference_number)->first();
    $bills           = Bill::where('policy_number',$claimdetails->reference_number)->get();
    $insured         = Customer::where('account_number',$policies->account_number)->first();


    //dd($bills);

    $status_of_claims = ClaimStatus::get();
    $intermediary    = User::orderby('username','ASC')->get();
    $loss_causes     = LossCause::get();
    $lossadjustors   = LossAdjustors::get();
    $images          = Image::where('reference_number',$claimdetails->claim_id)->get();
    $cessions        = Reinsurance::where('item_id',$claimdetails->item_id)->get() ?: new Reinsurance;
    $cessionstreaty  = TreatyBordeux::where('item_id',$claimdetails->item_id)->get() ?: new TreatyBordeux;
    $liabiltyreport  = LiabilityReport::where('claim_number',$claimdetails->claim_id)->first() ?: new LiabilityReport;
    $liabiltymemo    = LiabilityMemo::where('claim_number',$claimdetails->claim_id)->first() ?: new LiabilityMemo;
    $claimanttypes   = ClaimantType::all();

    $paymenttypes   = PaymentType::get();

    $year = $claimdetails->period_from->format('Y');
    $arrangements = ProportionalArrangement::where('year',$year)->where('product_type',$claimdetails->policy_product)->first();

    //dd($cessions);

    $grossreserve = LossAdjustments::where('claim_id',$claimdetails->claim_id)->get();
    $grosspayments= PaymentVoucher::where('claim_number',$claimdetails->claim_id)->get();
    $netpayments = PaymentVoucher::where('claim_number',$claimdetails->claim_id)->where('status','Paid')->get();
   

    $totalpaid = 0;
    $totalunpaid = 0;




    foreach ($grosspayments as $unpaid => $unpaidamount) 
    {
        $totalunpaid += $unpaidamount->amount;
    }

    foreach ($netpayments as $paid => $paidamount) 
    {
        $totalpaid += $paidamount->amount;
    }
    
    //dd($totalpaid);
     $excess_charge_rate = 0;

     switch($policies->policy_product) 
    {
      

        case 'Motor Insurance':
            
            $fetchrecord        = MotorDetails::where('ref_number','=',$policies->ref_number)->first();
            $vehicles           = MotorDetails::where('ref_number','=',$policies->ref_number)->orderby('vehicle_registration_number','asc')->get();
            $excess             = BuyBackExcess::where('cover',$fetchrecord->vehicle_cover)->where('use',$fetchrecord->vehicle_use)->where('risk',$fetchrecord->vehicle_risk)->get()->first();

         if($fetchrecord->vehicle_buy_back_excess=='No')
          {
        
            $excess_charge_rate = 0;
          }

          else if($fetchrecord->vehicle_buy_back_excess=='Yes')
          {
          //compute Excess

          $excess_charge_rate   = $excess->yes;
         
         }
         else
         {
          
             $excess_charge_rate = 0;
          
         } 
            break;



        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('policy_number','=',$policies->policy_number)->first();
             $objects = FireDetails::where('policy_number','=',$policies->policy_number)->get();
            break;

     case 'Bond Insurance':
             $fetchrecord = BondDetails::where('policy_number','=',$policies->policy_number)->first();
             $objects = BondDetails::where('policy_number','=',$policies->policy_number)->get();
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('policy_number','=',$policies->policy_number)->first();
             $objects = MarineDetails::where('policy_number','=',$policies->policy_number)->get();
            break;

        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('policy_number','=',$policies->policy_number)->first();
             $objects = EngineeringDetails::where('policy_number','=',$policies->policy_number)->get();
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('policy_number','=',$policies->policy_number)->first();
             $objects = LiabilityDetails::where('policy_number','=',$policies->policy_number)->get();

        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('policy_number','=',$policies->policy_number)->first();
             $objects = AccidentDetails::where('policy_number','=',$policies->policy_number)->get();
            break;
      }
   
     return view('claims.edit', compact('intermediary','objects','totalpaid','excess_charge_rate','totalunpaid','grossreserve','cessionstreaty','paymenttypes','arrangements','liabiltymemo','liabiltyreport','claimanttypes','cessions','claimdetails','fetchrecord','insured','vehicledetails','images','status_of_claims','loss_causes','policies','bills','lossadjustors'));
   

    }


    public function getSearchResults(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $claims = ClaimProcessed::where('insured_name', 'like', "%$search%")
            ->orWhere('claim_id', 'like', "%$search%")
            ->orWhere('item_id', 'like', "%$search%")
            ->orWhere('handler', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orderBy('insured_name')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


        return View('claims.index',compact('claims'));
  
    }



    public function addAdjustments()
    {

        $reserve                  = new LossAdjustments;
        $reserve->claim_id        = Input::get("claim_number");
        $reserve->adjustor_type   = Input::get("adjustor_type");
        $reserve->loss_estimate   = Input::get("loss_estimate");
        $reserve->loss_approved   = Input::get("loss_approved");
        $reserve->loss_location   = Input::get("location_of_loss");
        $reserve->loss_description   = Input::get("loss_description");
        $reserve->loss_nature   = Input::get("nature_of_loss");
        $reserve->uuid           = Input::get("csrf_token()");
        $reserve->created_by      = Auth::user()->getNameOrUsername();
        $reserve->created_on      = Carbon::now();
      


        if($reserve->save())
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

    public function getAdjustments()
{

    try
    {

            $claim_id = Input::get("claim_id");
            $items = LossAdjustments::where('claim_id',$claim_id)->get();
            return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}



     public function deleteAdjustments()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = LossAdjustments::where('id', '=', $ID)->delete();

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


    
    

    public function generateClaimNumber()
    
    {

    // $number = PolicySerials::where('policy_product','Motor Insurance')->where('cover_type','Individual')->first();
     //$count = $number->counter;
     //$prefix = $number->prefix;
     //$policynumber = str_pad($count+1,7, '0', STR_PAD_LEFT);

     //$generated = $prefix.$policynumber;
     $generated = uniqid();

     $added_response = array('claim_number' => $generated);
     return  Response::json($added_response);      
    }




    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }

    public function addClaimDetails()
    {
       //$affectedRows = Claim::where('claim_number', '=', $ID)->delete();
        //$claimnumber = $this->generateClaimNumber();
        //Policy Details
        $generatedid =  uniqid();
        $claim                          = new Claim;
        $claim->claim_id                = $generatedid;
        $claim->policy_number           = Input::get("policy_number");  
        $claim->reference_number        = Input::get("reference_number");   
        $claim->insured_name            = Input::get("insured"); 
        $claim->item_id                 = Input::get("loss_id");   
        $claim->status                  = Input::get("status_of_claim");
        $claim->insured_id              = Input::get("insured");
        $claim->branch                  = Input::get("branch");
        $claim->agency                  = Input::get("agency");
        $claim->risk_type               = Input::get("risktype");
        $claim->cover_type              = Input::get("coverage");
        $claim->policy_product          = Input::get("policy_product");
        $claim->loss_date               = $this->change_date_format(Input::get("loss_date"));
        $claim->date_notified           = Carbon::createFromFormat('d/m/Y', Input::get("notification_date"));
        $claim->date_transacted         = Carbon::createFromFormat('d/m/Y', Input::get("status_change_date"));
        $claim->date_settled            = Carbon::createFromFormat('d/m/Y', Input::get("settlement_date"));
        $claim->handler                 = Input::get("claim_handler");

        $claim->cause_of_loss           = Input::get("loss_cause");
        $claim->loss_description        = Input::get("loss_description"); 
        $claim->location_of_loss        = Input::get("location_of_loss");
        $claim->loss_amount             = Input::get("loss_amount"); 
        $claim->excess_amount           = Input::get("excess_amount");
        $claim->depreciation_amount     = Input::get("depreciation_amount");
        $claim->salvage_amount          = Input::get("salvage_amount");
        $claim->survey_tow_amount       = Input::get("survey_tow_amount");


        $claim->related_claim_number    = Input::get("related_claim_number");
        $claim->contact_number          = Input::get("contact_number"); 
        $claim->currency                = Input::get("claim_currency");
        $claim->reserve_estimated       = Input::get("reserve_estimated"); 
        $claim->reserve_approved        = Input::get("reserve_approved");
        $claim->reserve_paid            = Input::get("reserve_paid"); 

        $claim->period_from            = Input::get("period_from");
        $claim->period_to              = Input::get("period_to");
        
        $claim->created_by              = Auth::user()->getNameOrUsername();
        $claim->created_on              = Carbon::now(); 
        
      

       if($claim->save())
            {
                $myclaimid = $generatedid;
                $added_response = array('OK'=>'OK','claimid'=>$myclaimid);
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }
      }


    public function updateClaimDetails()
    {
        $affectedRows = Claim::where('claim_id', '=', Input::get("claim_number"))->delete();

        $claim                          = new Claim;
        $claim->claim_id                = Input::get("claim_number");
        $claim->policy_number           = Input::get("policy_number");  
        $claim->reference_number        = Input::get("reference_number");   
        $claim->insured_name            = Input::get("insured"); 
        $claim->item_id                 = Input::get("loss_id");   
        $claim->status                  = Input::get("status_of_claim");
        $claim->insured_id              = Input::get("insured");
        $claim->branch                  = Input::get("branch");
        $claim->agency                  = Input::get("agency");
        $claim->risk_type               = Input::get("risktype");
        $claim->cover_type              = Input::get("coverage");
        $claim->policy_product          = Input::get("policy_product");
        $claim->loss_date               = $this->change_date_format(Input::get("loss_date"));
        $claim->date_notified           = Carbon::createFromFormat('d/m/Y', Input::get("notification_date"));
        $claim->date_transacted         = Carbon::createFromFormat('d/m/Y', Input::get("status_change_date"));
        $claim->date_settled            = Carbon::createFromFormat('d/m/Y', Input::get("settlement_date"));
        $claim->handler                 = Input::get("claim_handler");

        $claim->cause_of_loss           = Input::get("loss_cause");
        $claim->loss_description        = Input::get("loss_description"); 
        $claim->location_of_loss        = Input::get("location_of_loss");
        $claim->loss_amount             = Input::get("loss_amount"); 
        $claim->excess_amount           = Input::get("excess_amount");
        $claim->depreciation_amount     = Input::get("depreciation_amount");
        $claim->salvage_amount          = Input::get("salvage_amount");
        $claim->survey_tow_amount       = Input::get("survey_tow_amount");


        $claim->related_claim_number    = Input::get("related_claim_number");
        $claim->contact_number          = Input::get("contact_number"); 
        $claim->currency                = Input::get("claim_currency");
        $claim->reserve_estimated       = Input::get("reserve_estimated"); 
        $claim->reserve_approved        = Input::get("reserve_approved");
        $claim->reserve_paid            = Input::get("reserve_paid"); 

        $claim->period_from            = Input::get("period_from");
        $claim->period_to              = Input::get("period_to");
        
        $claim->created_by              = Auth::user()->getNameOrUsername();
        $claim->created_on              = Carbon::now(); 
        
      

       if($claim->save())
            {
                //$myclaimid = $generatedid;
                $added_response = array('OK'=>'OK');
                return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }
      }


      public function addDriver()
    {
       
       
        //Policy Details
        $driver                      = new NamedDriver;
        $driver->claim_id            = Input::get('claim_number');  
        $driver->driver_name         = Input::get('driver_name');  
        $driver->years_of_experience = Input::get('years_of_experience');  
        $driver->date_of_birth       = Input::get('date_of_birth');  
        $driver->gender              = Input::get('gender');  
        $driver->marital_status      = Input::get('marital_status');  
        $driver->license_number      = Input::get('license_number');
        $driver->dip                 = Input::get('dip');  
        $driver->created_by          = Auth::user()->getNameOrUsername();
        $driver->created_on          = Carbon::now(); 
        
        if($driver->save())

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


 public function addLiabilityReport()
    {
       
        $ID = Input::get("claim_number");
        $affectedRows = LiabilityReport::where('claim_number', '=', $ID)->delete();
       
        //Policy Details
        $report                      = new LiabilityReport;
        $report->claim_number        = Input::get('claim_number');  
        $report->liability_report     = Input::get('liability_report');  
        $report->created_by          = Auth::user()->getNameOrUsername();
        $report->created_on          = Carbon::now(); 
        
        if($report->save())

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


       public function saveLiabilityReport(Request $request)
    
    {
       
        $ID = Input::get("current_claim");
        $affectedRows = LiabilityReport::where('claim_number', '=', $ID)->delete();
       
        //dd($request->all());
        //Policy Details
        
        $report                      = new LiabilityReport;
        $report->claim_number        = Input::get('current_claim');  
        $report->liability_report    = Input::get('liability_report');  
        $report->created_by          = Auth::user()->getNameOrUsername();
        $report->created_on          = Carbon::now(); 
        
        if($report->save())

            {
    
                return redirect()
            ->back()
            ->with('success','Report has successfully been updated!');
            
            }
            else
            {
               return redirect()
            ->back()
            ->with('error','Report failed to update!');
            }

      }


       public function saveLiabilityMemo(Request $request)
    
    {
       
        $ID = Input::get("current_claim_memo");
        $affectedRows = LiabilityMemo::where('claim_number', '=', $ID)->delete();
       
        //dd($request->all());
        //Policy Details
        
        $report                      = new LiabilityMemo;
        $report->claim_number        = Input::get('current_claim_memo');  
        $report->memo    = Input::get('liability_memo');  
        $report->created_by          = Auth::user()->getNameOrUsername();
        $report->created_on          = Carbon::now(); 
        
        if($report->save())

            {
    
                return redirect()
            ->back()
            ->with('success','Memo has successfully been updated!');
            
            }
            else
            {
               return redirect()
            ->back()
            ->with('error','Memo failed to update!');
            }

      }



 public function addClaimant()
    {
       
       
        //Policy Details

        $claimant                               = new Claimant;
        $claimant->claim_number                 = Input::get('claim_number');  
        $claimant->policy_number                = Input::get('policy_number');  
        $claimant->claimant_type                = Input::get('claimant_type');  
        $claimant->claimant_number              = uniqid(10);  
        $claimant->claimant_name                = Input::get('claimant_name');  
        $claimant->claimant_address             = Input::get('claimant_address');  
        $claimant->claimant_phone_number        = Input::get('claimant_phone_number');  
        $claimant->claimant_registration_number = Input::get('claimant_registration_number');
        //$claimant->claimant_notification_date   = Carbon::createFromFormat('d/m/Y', Input::get("claimant_notification_date"));
        //$claimant->claimant_status_date         = Carbon::createFromFormat('d/m/Y', Input::get("claimant_status_date"));
        //$claimant->claimant_agreed_date         = Carbon::createFromFormat('d/m/Y', Input::get("claimant_agreed_date"));
        //$claimant->claimant_offer_date          = Carbon::createFromFormat('d/m/Y', Input::get("claimant_offer_date"));
        $claimant->claimant_status              = Input::get('claimant_status');
        $claimant->claimant_status_cause        = Input::get('claimant_status_cause');  
        $claimant->created_by                   = Auth::user()->getNameOrUsername();
        $claimant->created_on                   = Carbon::now(); 
        
        if($claimant->save())

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

   public function getDrivers()
{

    try
    {

            $claim_id = Input::get("claim_number");
            $items = NamedDriver::where('claim_id',$claim_id)->get();
            return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}

 public function getClaimant()
{

    try
    {

            $claim_id = Input::get("claim_number");
            $items = Claimant::where('claim_number',$claim_id)->get();
            return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}



     public function deleteDriver()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = NamedDriver::where('id', '=', $ID)->delete();

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


   public function deleteClaimant()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Claimant::where('id', '=', $ID)->delete();

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


public function deletePV()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PaymentVoucher::where('id', '=', $ID)->delete();

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


   public function deleteClaim()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Claim::where('id', '=', $ID)->delete();

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



      public function updateClaim(Request $request)
    {

      try {

             $affectedRows = Claim::where('claim_number','=' , $request->input('claimid'))
            ->update(array(
                           
                           'status_of_claim' =>  $request->input('status_of_claim'),
                           'insurer_reference_id' =>  $request->input('insurer_reference_id'),
                           'loss_date' => $this->change_date_format($request->input('loss_date')), 
                           'submit_broker_date' => $this->change_date_format($request->input('submit_broker_date')), 
                           'submit_insurer_date' => $this->change_date_format($request->input('submit_insurer_date')), 
                           'settlement_date' =>  $this->change_date_format($request->input('settlement_date')), 
                           'location_of_loss'=>$request->input('location_of_loss'),
                           'loss_amount'=>$request->input('loss_amount'),
                           'excess_amount' => $request->input('excess_amount'),
                           'insurer_contact_name'=> $request->input('insurer_contact_name'),
                           'insurer_contact_email'=>$request->input('insurer_contact_email'),
                           'insurer_contact_phone'=>$request->input('insurer_contact_phone'),
                           'loss_cause'=> $request->input('loss_cause'),
                           'loss_description' => $request->input('loss_description'),
                           'updated_by'=> Auth::user()->getNameOrUsername(),
                           'updated_on'=>Carbon::now()));

            if($affectedRows > 0)
            {
                Activity::log([
          'contentId'   =>  $request->input('policy_number'),
          'contentType' => 'User',
          'action'      => 'Update',
          'description' => 'Updated claims details of '.$request->input('policy_number'),
          'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
          ]);
        
             
              return redirect()
            ->route('claims')
            ->with('success','Claim has successfully been updated!');
            }
            else
            {
               return redirect()
            ->route('claims')
            ->with('error','Claim failed to update!');
            }
          }


    catch (\Exception $e) {
           
           echo $e->getMessage();
            
        }
           

    }


    public function addPaymentVoucher()
    {

        $voucher                  = new PaymentVoucher;
        $voucher->claim_number    = Input::get('claim_number');  
        $voucher->pv_number       = uniqid(5);  
        $voucher->payee_name      = Input::get('pv_payee_name');  
        $voucher->payment_mode    = Input::get('pv_payment_mode');
        $voucher->pv_payment_source    = Input::get('pv_payment_source');   
        $voucher->cheque_number   = Input::get('pv_cheque_number');  
        $voucher->pv_date         = Carbon::createFromFormat('d/m/Y', Input::get("pv_cheque_date"));
        $voucher->description     = Input::get('pv_description');  
        $voucher->currency        = Input::get('pv_currency');
        $voucher->amount          = Input::get("pv_amount");
        $voucher->created_by      = Auth::user()->getNameOrUsername();
        $voucher->created_on      = Carbon::now(); 
        
        if($voucher->save())

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


    public function loadPVClaimant()
    {

          try
    {

            $claim_number = Input::get("claim_number");
            $claimant =Claimant::where('claim_number',$claim_number)->orderby('claimant_name','asc')->distinct()->get(['claimant_name']);
            return  Response::json($claimant);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }



    }

   public function loadPaymentVoucher()
   {

          try
    {

            $claim_number = Input::get("claim_number");
            $vouchers =PaymentVoucher::where('claim_number',$claim_number)->orderby('payee_name','asc')->get();
            return  Response::json($vouchers);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }

   }


   public function getPaymentVoucher()
   {

          try
    {
            $id = Input::get('id');
            $vouchers =PaymentVoucher::find($id);
             $data = Array(
                'payment_amount' => $vouchers->amount,
                'payer_id'=>$vouchers->pv_number,
                'payee_name'=>$vouchers->payee_name,
                'payment_description'=>$vouchers->description
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


    public function getClaimantDetails()
   {

          try
    {
            $id = Input::get('id');
            $details =Customer::where('account_number',$id)->first();
             $data = Array(
                'fullname' => $details->fullname,
                'postal_address'=>$details->postal_address,
                'mobile_number'=>$details->mobile_number
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



   

    public function facingSheet($id)
    {

    $claimdetails    = Claim::find($id);
    $policies        = Policy::where('master_policy_number',$claimdetails->policy_number)->first();

    //dd();
    $bills           = Bill::where('policy_number',$policies->policy_number)->get();
    $insured         = Customer::where('account_number',$policies->account_number)->first();
    $status_of_claim = ClaimStatus::get();
    $intermediary    = User::orderby('username','ASC')->get();
    $loss_causes     = LossCause::get();
    $lossadjustors   = LossAdjustors::get();
    $images          = Image::where('reference_number',$claimdetails->claim_id)->get();
    $cessions        = Reinsurance::where('item_id',$claimdetails->item_id)->get();
    $payments        = PaymentVoucher::where('claim_number',$claimdetails->claim_id)->get();
    $reserves        = LossAdjustments::where('claim_id',$claimdetails->claim_id)->get();
    $liabilitymemo   = LiabilityMemo::where('claim_number',$claimdetails->claim_id)->first() ?: new LiabilityMemo;
    $myclaimants     = LossAdjustments::where('claim_id',$claimdetails->claim_id)->get();

    $vehicledetails = MotorDetails::where('vehicle_registration_number',$claimdetails->item_id)->first();




    $grossreserve = LossAdjustments::where('claim_id',$claimdetails->claim_id)->get();
    $grosspayments= PaymentVoucher::where('claim_number',$claimdetails->claim_id)->get();
    $netpayments = PaymentVoucher::where('claim_number',$claimdetails->claim_id)->where('status','Paid')->get();
   

    $totalreserves = 0;
    $totalpaid = 0;
    $totalunpaid = 0;

    $reinsuranceapportions = 0;

    



    foreach ($grossreserve as $reserveamount => $totalreserveamount) 
    {
        $totalreserves += $totalreserveamount->loss_approved;
    }


    foreach ($grosspayments as $unpaid => $unpaidamount) 
    {
        $totalunpaid += $unpaidamount->amount;
    }

    foreach ($netpayments as $paid => $paidamount) 
    {
        $totalpaid += $paidamount->amount;
    }
    


    if($claimdetails->policy_product=='Motor Insurance')
    {

        return view('claims.motorfacing',compact('claimdetails','policies','insured','payments','vehicledetails','totalreserves','totalpaid','totalunpaid','liabilitymemo','reserves','myclaimants'));

    }

    else
    {

        return view('claims.nonmotorfacing',compact('claimdetails','policies','insured','payments','vehicledetails','totalreserves','totalpaid','totalunpaid','liabilitymemo','reserves','myclaimants'));
    }

    }


    public function printVoucherSlip($id)
    {


        $payments = PaymentVoucher::where('id',$id)->first();
        $claimdetails = Claim::where('claim_id',$payments->claim_number)->first();
        $authoritylist = AuthorityList::where('type','Claim Payment Voucher')->get();

        if($payments->status =='Unpaid')
        {
             return view('claims.paymentvouchers',compact('payments','claimdetails','authoritylist'));
        }
       
        else
        {
            return view('claims.receipt',compact('payments','claimdetails','authoritylist'));
        }

       

    }


      public function reprintCounterPV()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = PaymentVoucher::where('id', '=', $ID)->increment('reprint' ,1);

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



   public function makePayment()
   {
            
            $payer_id  = Input::get("payer_id");
            $payment_type = Input::get("payment_type");
            $payment_date = Carbon::createFromFormat('d/m/Y', Input::get("payment_date"));
            $payment_description = Input::get("payment_description");
            $reference_name = Input::get("reference_name");
            $reference_number = Input::get("cash_receipt_number");

            //dd(Input::get('payment_date'));
           
             $affectedRows = PaymentVoucher::where('pv_number', '=', $payer_id)
            ->update(array(
                           'payment_mode' =>  $payment_type,
                           'cheque_date' => $payment_date, 
                           'description' => $payment_description, 
                           'reference_name' => $reference_name, 
                           'cheque_number' =>  $reference_number, 
                           'receipt_number' =>  uniqid(10), 
                           'status' =>  'Paid',
                           'Released' =>  'Yes',  
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


    public function printDischarge($id)
    {

        $claim = PaymentVoucher::where('id',$id)->first();

        //dd($claim);
        $lossdetail = Claim::where('claim_id',$claim->claim_number)->first();
        return view('claims.discharge',compact('claim','lossdetail'));

    }

     public function sendApprovalRequest()
    {

        $email = Input::get("approver");
        $amount = Input::get("amount");
        $reinsurer = Input::get("reinsurer");
        $currency = Input::get("currency");
        $url = Input::get("url");

         Mail::send('email.claimpv', array('currency' => $currency, 'url' => $url, 'amount'=>$amount,'reinsurer'=>$reinsurer)  , function ($message) use ($email) 
        { 
            $message->from('claims@phoenixinsurancegh.com', 'Phrontlyne');
                        
            $message->to($email)->subject('Claim PV Approval Request'); 
                
        }); 


         return Response::json(['OK'=>'OK']);

    }

     public function approveRequisition()
    {     
          

             $affectedRows = PaymentVoucher::where('id',Input::get("ID"))
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
          

             $affectedRows = PaymentVoucher::where('id',Input::get("ID"))
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



    public function printSettlement()
    {

      
    }

    public function printAcknowledgement()
    {

      
    }

    

}
