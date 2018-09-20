<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\User;
use Phrontlyne\Models\Customer;
use Phrontlyne\Models\SalesChannel;
use Phrontlyne\Models\SalesType;
use Phrontlyne\Models\PolicyType;
use Phrontlyne\Models\Serials;
use Phrontlyne\Models\PolicyProductType;
use Phrontlyne\Models\VehicleModel;
use Phrontlyne\Models\VehicleMake;
use Phrontlyne\Models\VehicleType;
use Phrontlyne\Models\PolicyStatus;
use Phrontlyne\Models\VehicleUse;
use Phrontlyne\Models\SelectStatus;
use Phrontlyne\Models\Currency;
use Phrontlyne\Models\AdminFees;
use Phrontlyne\Models\FireRoofed;
use Phrontlyne\Models\FireWalled;
use Phrontlyne\Models\FireRisk;
use Phrontlyne\Models\FireDetails;
use Phrontlyne\Models\ExchangeRate;
use Phrontlyne\Models\CollectionMode;
use Phrontlyne\Models\Policy;
use Phrontlyne\Models\MotorDetails;
use Phrontlyne\Models\PolicySerials;
use Phrontlyne\Models\Bill;
use Phrontlyne\Models\Payments;
use Phrontlyne\Models\ProcessedPolicy;
use Phrontlyne\Models\TravelDetails;
use Phrontlyne\Models\Country;
use Phrontlyne\Models\Beneficiary;
use Phrontlyne\Models\MaritalStatus;
use Phrontlyne\Models\BondTemplate;
use Phrontlyne\Models\Accident;
use Phrontlyne\Models\Agent;
use Phrontlyne\Models\NCD;
use Phrontlyne\Models\Loadings;
use Phrontlyne\Models\FleetDiscount;
use Phrontlyne\Models\BuyBackExcess;
use Phrontlyne\Models\BondTypes;
use Phrontlyne\Models\PendingBills;
use Phrontlyne\Models\ClaimProcessed;
use Phrontlyne\Models\HealthPlans;
use Phrontlyne\Models\LifePlans;
use Phrontlyne\Models\MediaFiles;
use Phrontlyne\Models\MotorRenewal;
use Phrontlyne\Models\HealthDetail;
use Phrontlyne\Models\LifeDetail;
use Phrontlyne\Models\Branch;
use Phrontlyne\Models\PolicyClauses;
use Phrontlyne\Models\CertificateWording;
use Phrontlyne\Models\PaymentType;
use Phrontlyne\Models\NatureofAcccident;
use Phrontlyne\Models\NatureofWork;
use Phrontlyne\Models\CommissionRate;
use Phrontlyne\Models\BondDetails;
use Phrontlyne\Models\NonMotorRenewal;
use Phrontlyne\Models\UnderwriterLimits;
use Phrontlyne\Models\MortgageCompanies;
use Phrontlyne\Models\PropertyType;
use Phrontlyne\Models\EngineeringDetails;
use Phrontlyne\Models\AccidentDetails;
use Phrontlyne\Models\AttachDocuments;
use Phrontlyne\Models\MarineDetails;
use Phrontlyne\Models\MarineRisktypes;
use Phrontlyne\Models\AccidentRiskType;
use Phrontlyne\Models\LiabilityRiskTypes;
use Phrontlyne\Models\LiabilityDetails;
use Phrontlyne\Models\EngineeringRisktypes;
use Phrontlyne\Models\BusinessStatus;
use Phrontlyne\Models\Insurers;
use Phrontlyne\Models\FireDetailItems;
use Phrontlyne\Models\UnitOfMeasure;
use Phrontlyne\Models\NonProportionalArrangement;
use Phrontlyne\Models\ProportionalArrangement;
use Phrontlyne\Models\Reinsurance;
use Phrontlyne\Models\TreatyBordeux;
use Phrontlyne\Models\PolicyRating;
use Phrontlyne\Models\FirePerilApply;
use Phrontlyne\Models\Reinsurers;
use Phrontlyne\Models\WhatsAppRenewals;
use Phrontlyne\Models\StickerReturn;
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use NumberToWords\NumberToWords;
use DB;
use Auth;
use Activity;
use Input;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Excel;
use PDF;
use Cache;
use Dompdf\Dompdf;
use Validator;

class PolicyController extends Controller
{
    
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('role:System Admin|Underwriting Officer|Underwriting Manager|Reinsurance Officer|Reinsurance Manager|Claims Manager|Claim Officer|Manager');
    }




    public function startnewpolicy()
    {
     
     $customers = Customer::orderby('created_on','desc')->paginate(30);
    
    return view('policy.search', compact('customers'));

  
    }


    public function getEndDate()
    {

        if(Input::get("policy_product")=='Fire Insurance')
        {
        $periodfrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));;
        $period_to  = $periodfrom->addYear(1);
        }
        else
        {
        $periodfrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));;
        $period_to  = $periodfrom->addYear(1)->subDays(1);
        }

        $ini   = array('OK'=>'OK','period_to'=>$period_to->format('d/m/Y'));
        return  Response::json($ini);


    }
    public function index()
    {

        
          $policies =  Policy::sortable()->orderby('created_on','desc')->paginate(30);
    
        return View('policy.index',compact('policies'));
    }

    public function endorsePolicy()
    {
        $policies =  Policy::sortable()->orderby('created_on','desc')->paginate(30);
        return View('policy.endorsement',compact('policies'));
    }

    public function queryPolicy()
    {
        $policies =  Policy::sortable()->orderby('created_on','desc')->paginate(30);
        return View('policy.query',compact('policies'));
    }

    public function expired()
    {
        $motorcount = 0;
        $nonmotorcount = 0;

        $policies = Policy::where('insurance_period_to','<=',Carbon::now())->orderby('created_on','desc')->paginate(30);
        return View('policy.expired',compact('policies','nonmotorcount','motorcount'));
    }


    public function getBulkRenewals()
    {

        return view('renewals.bulk');
    }

    public function getWhatsappMessagestoSend()
    {

      $policies = WhatsAppRenewals::where('status','Unsent')->paginate(30);
      return view('renewals.whatsapp',compact('policies'));
    }

    public function updateWhatsAppStatus()
    {


         $id = Input::get("id");
        
            $affectedRows = WhatsAppRenewals::where('id', $id)->update(array('status' => 'Sent'));

          

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





    public function findExpiredVehicle(Request $request)
    {
       
    }

    public function findExpiredVehiclebyDate(Request $request)
    {
        
    }


     public function getVehicleCount()
    {

          if(Input::get("vehicle_registration_number"))
            {
                    $ID = Input::get("vehicle_registration_number");
                    $affectedRows = MotorDetails::where('vehicle_registration_number', $ID)->count();

                    $stocklevel = $affectedRows;

                if($stocklevel == 1)
                {
                    $ini   = array('OK'=>'OK');
                    return  Response::json($ini);
                }
            
                 else
                {
                    $ini   = array('No Data' => $ID);
                    return  Response::json($ini);
                }
            }
                else
               {
                    $ini   = array('No Data'=>'No Data');
                    return  Response::json($ini);
                }
    }


    public function getStickerCount()
    {

          if(Input::get("sticker_number"))
            {
                    $ID = Input::get("sticker_number");
                    $affectedRows = StickerReturn::where('sticker_number', $ID)->where('status','Unused')->count();

                    $stocklevel = $affectedRows;

                if($stocklevel == 1)
                {
                    $ini   = array('OK'=>'OK');
                    return  Response::json($ini);
                }
            
                 else
                {
                    $ini   = array('No Data' => $ID);
                    return  Response::json($ini);
                }
            }
                else
               {
                    $ini   = array('No Data'=>'No Data');
                    return  Response::json($ini);
                }
    }




    public function getNonMotorCommission()
    {
        $product   = Input::get("policy_product");
        $contract  = Input::get("agency");
         $cover  = Input::get("cover");

        $commission = CommissionRate::where('product', $product)->where('contract',$contract)->where('cover',$cover)->first();

        $added_response = array('commission'=> $commission->rate);
        return  Response::json($added_response);
    }

    public function bondtest($id)
    {


      $template = BondTemplate::where('id',5)->first();
      return view('document.advance',compact('template'));
    }

     public function cbtemplates($id)
    {

      
      $template = BondTemplate::where('id',4)->first();
      return view('document.bidbond',compact('template'));
    }


    public function excludePolicy()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Policy::where('id', '=', $ID)->delete();

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

    public function lockPolicy()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Policy::where('id', '=', $ID)->update(array('status' => 'Locked'));

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

   


   public function approvePolicy()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");


            $masterpolicynumber = $this->generateMasterPolicyNumber(Input::get("policy_product"),Input::get("cover_type"),Input::get("risk_type"),Input::get("policy_branch"),Input::get("policy_sales_type"));
            
            $affectedRows = Policy::where('policy_number', '=', $ID)->update(array('master_policy_number'=> $masterpolicynumber,'policy_status' => 'In Force','approved_by' => Auth::user()->getNameOrUsername(),'approved_on' => Carbon::now()));
            $affectedRows2 = Reinsurance::where('policy_number', '=', $ID)->update(array('master_policy_number'=> $masterpolicynumber,'flag' => 'In Force'));
            
            $getinvoicenumber = Bill::where('policy_number', $ID)->first();
            $affectedRows3 = Bill::where('policy_number', '=', $ID)->update(array('master_policy_number'=> $masterpolicynumber,'flag' => 'In Force','invoice_number'=>$getinvoicenumber->invoice_number));

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

    public function suspendPolicy()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Policy::where('id', '=', $ID)->update(array('status' => 'Suspended'));

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

   public function cancelPolicy()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Policy::where('id', '=', $ID)->update(array('status' => 'Cancelled'));

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

   public function loadncd()
   {

     try
    {

            $vehicle_use = Input::get("vehicle_use");
            $use_types = NCD::where('use',$vehicle_use)->get();
            return  Response::json($use_types);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }

   }

    public function loadrisk()
   {

     try
    {

            $vehicle_use = Input::get("vehicle_use");
            $risk_types =VehicleUse::where('use',$vehicle_use)->distinct()->get(['risk']);
            return  Response::json($risk_types);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }


   public function loadIntermediary()
   {

     try
    {

            $contracttype = Input::get("policy_sales_type");

            if($contracttype == 'Coinsurance' || $contracttype == 'Reinsurance Inward')
            {
                $contarct = Reinsurers::orderby('agentname','asc')->get(['agentcode','agentname']);
                return  Response::json($contarct);
            }

            else {
                # code...
                $contarct =Agent::where('contract_type',$contracttype)->where('flag','Active')->orderby('agentname','asc')->distinct()->get(['agentcode','agentname']);
            return  Response::json($contarct);
            }
            
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }

   public function loadRiskNumber()
   {

     try
    {

            $policynumber = Input::get("policy_number");
            $policyrisk =FireDetails::where('policy_number',$policynumber)->orderby('risk_number','asc')->distinct()->get(['risk_number']);
            return  Response::json($policyrisk);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }


   public function loadvehiclemodels()
   {

     try
    {

            $vehicle_make = Input::get("vehicle_make");
            $models =VehicleModel::where('type',$vehicle_make)->distinct()->get(['model']);
            return  Response::json($models);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }

    public function loadinsurer()
   {

     try
    {

            $policytype = Input::get("policy_type");
            $insurer =Insurers::where('type',$policytype)->orderBy('name','asc')->get();
            return  Response::json($insurer);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }

    public function loadproduct()
   {

     try
    {

            $policytype = Input::get("policy_type");
            $productfetched =PolicyProductType::where('group',$policytype)->orderBy('type','asc')->get();
            return  Response::json($productfetched);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }


   public function claimViewPolicy($id)
    {

    
    $policydetails   =  Policy::where('policy_number' ,'=', $id)->get()->first();
    $images          =  AttachDocuments::where('reference_number' ,'=', $policydetails->account_number)->get();
    $balancesheet    =  Bill::where('policy_number' ,'=', $policydetails->ref_number)->get()->last();
    $bills           =  Bill::where('policy_number' ,'=', $policydetails->ref_number)->get();
    //$claims        =  ClaimProcessed::where('policy_number' ,'=', $policydetails->ref_number)->get();
    $customers       =  Customer::where('account_number', $policydetails->account_number)->first();


    switch($policydetails->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policydetails->ref_number)->first();
            $vehicles  = MotorDetails::where('ref_number','=',$policydetails->ref_number)->orderby('vehicle_registration_number','asc')->get();
            break;
        case 'Travel Insurance':
             $fetchrecord = TravelDetails::where('ref_number','=',$policydetails->ref_number)->first();
            break;
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policydetails->ref_number)->first();
            break;

        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('ref_number','=',$policydetails->ref_number)->first();
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('ref_number','=',$policydetails->ref_number)->first();
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('ref_number','=',$policydetails->ref_number)->first();
            break;

        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('ref_number','=',$policydetails->ref_number)->first();
            break;

        case 'Health Insurance':
             $fetchrecord = HealthDetail::where('ref_number','=',$policydetails->ref_number)->first();
            break;

        case 'Life Insurance':
             $fetchrecord = LifeDetail::where('ref_number','=',$policydetails->ref_number)->first();
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('ref_number','=',$policydetails->ref_number)->first();
            break;

        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('ref_number','=',$policydetails->ref_number)->first();
            break;

      }

      
    return view('policy.view', compact('policydetails','vehicles','images','balancesheet','bills','claims','fetchrecord','customers'));
    }



      public function viewPolicy($id)
    {

    
    $policydetails   =  Policy::where('policy_number', $id)->get()->first();
    $images          =  AttachDocuments::where('policy_number' ,'=', $policydetails->policy_number)->get();
    $balancesheet    =  Bill::where('policy_number' ,'=', $policydetails->policy_number)->get()->last();
    $bills           =  Bill::where('policy_number' ,'=', $policydetails->policy_number)->get();
    $receipts        =  Payments::where('policy_number' ,'=', $policydetails->policy_number)->get();
    $claims          =  ClaimProcessed::where('policy_number' ,'=', $policydetails->policy_number)->get();
    $customers       =  Customer::where('account_number' , $policydetails->account_number)->first();
    $reinsurances    =  Reinsurance::where('policy_number',$id)->orderby('item_id','desc')->get();
    $protectedlimit  =  UnderwriterLimits::where('level', Auth::user()->getRole())->where('product',$policydetails->policy_product)->first();
    
    if (substr($customers->mobile_number, 0, 1) == '0')
                          {
                              $phone = substr($customers->mobile_number, 1);
                              $phone = '+233' . $phone;
                            }
                        

   

    switch($policydetails->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('policy_number','=',$policydetails->policy_number)->first();
            $vehicles  = MotorDetails::where('policy_number','=',$policydetails->policy_number)->orderby('vehicle_registration_number','asc')->get();
            //$renewals        =  MotorRenewal::where('POLICY_NUM' ,'=', $policydetails->policy_number)->get(); 
            break;
       
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policydetails->ref_number)->first();
            break;

        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('policy_number','=',$policydetails->policy_number)->first();
             $objects  = FireDetails::where('policy_number','=',$policydetails->policy_number)->orderby('created_on','asc')->get();
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('policy_number','=',$policydetails->policy_number)->first();
             $objects  = BondDetails::where('policy_number','=',$policydetails->policy_number)->orderby('created_on','asc')->get();
            break;

        case 'Marine Insurance':

             $fetchrecord = MarineDetails::where('policy_number','=',$policydetails->policy_number)->first();
             $objects     = MarineDetails::where('policy_number','=',$policydetails->policy_number)->orderby('created_on','asc')->get();
            break;

        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('policy_number','=',$policydetails->policy_number)->first();
             $objects     = EngineeringDetails::where('policy_number','=',$policydetails->policy_number)->orderby('created_on','asc')->get();
            break;

     

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('policy_number','=',$policydetails->policy_number)->first();
            break;

        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('policy_number','=',$policydetails->policy_number)->first();
             $objects     = AccidentDetails::where('policy_number','=',$policydetails->policy_number)->orderby('created_on','asc')->get();
            break;



      }

       //dd($fetchrecord);
    return view('policy.view', compact('phone','policydetails','protectedlimit','reinsurances','receipts','claims','objects','vehicles','images','balancesheet','bills','claims','fetchrecord','customers'));
    }


     public function printPolicy($id)
    {


    $policydetails   =  Policy::where('id', $id)->first();

    //dd($id);
    $balancesheet    =  Bill::where('policy_number', $policydetails->policy_number)->get();
    $bills           =  Bill::where('reference_number' , $policydetails->ref_number)->first();
    $customers       =  Customer::where('account_number' ,'=', $policydetails->account_number)->first();

     //dd($bills);
    $numberToWords = new NumberToWords();
    $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
    $amountinwords =  $currencyTransformer->toWords($bills->sum_insured *100, 'GHS');

    if($policydetails->policy_product == 'Motor Insurance') 
    {
            $fetchrecord  = MotorDetails::where('ref_number',$policydetails->ref_number)->first();
            $certificate =  CertificateWording::where('vehicleuse',$fetchrecord->vehicle_use)->where('riskline',$fetchrecord->vehicle_risk)->first();
            return view('policy.motor_certificate', compact('policydetails','balancesheet','bills','claims','fetchrecord','customers','certificate'));

    }


    
    elseif($policydetails->policy_product == 'Bond Insurance')
    {
       

        $templates = BondTemplate::all();
        $risk = BondDetails::where('policy_number',$policydetails->policy_number)->first();

        //dd($risk);
        $suminsured    = $bills->sum_insured;
        $amountinwords = $amountinwords;
        $policy        = $policydetails;
        
        //dd($policy);
        return view('document.bond_template', compact('policy','customers','suminsured','amountinwords','risk','templates','bond_number'));
           
          


    }



    else
    {
        echo 'Nothing to show';
    }

    
    }



    public function saveBondTemplate(Request $request)
    
    {
       
      
        
        $template                  = new BondTemplate;
        $template->name            = Input::get('template_name');
        $template->description     = Input::get('template_description');  
        $template->content         = Input::get('bond_template');  
        $template->created_by      = Auth::user()->getNameOrUsername();
        $template->created_on      = Carbon::now(); 
        
        if($template->save())

            {
    
                return redirect()
            ->back()
            ->with('success','Template has successfully been saved!');
            
            }
            else
            {
               return redirect()
            ->back()
            ->with('error','Template failed to save!');
            }

      }



    public function printRenewalNotices($id)
    {
    
    $policydetails   =  Policy::where('id' ,'=', $id)->get()->first();
    $exchanges       =  ExchangeRate::all();
    $customers       =  Customer::where('account_number' ,'=', $policydetails->account_number)->get()->first();

    //dd($policydetails);
    switch($policydetails->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('policy_number','=',$policydetails->policy_number)->get();
            return view('policy.motor_renewal_notice', compact('policydetails','balancesheet','bills','claims','fetchrecord','customers','certificate','exchanges'));
            break;


         case 'Fire Insurance':
            $fetchrecord  = FireDetails::all()->where('policy_number',$policydetails->policy_number)->groupby('risk_number');
            $mastergroup = FireDetails::where('policy_number',$policydetails->policy_number)->get();
            $fees    = AdminFees::where('type','Sticker Fee')->first();
           // dd($fetchrecord);
            return view('policy.fire_schedule', compact('policydetails','fetchrecord','customers','mastergroup','fees'));
             break;


          case 'Bond Insurance':
            $fetchrecord  = BondDetails::where('policy_number',$policydetails->policy_number)->get();
            return view('policy.bond_schedule', compact('policydetails','fetchrecord','customers'));
             break;

    }
  }

     public function printSchedules($id)
    {


    $policydetails   =  Policy::where('id' ,'=', $id)->get()->first();

    $debitreference  = Bill::where('reference_number',$policydetails->ref_number)->first();
    $debitid = $debitreference->id;
 
    $customers       =  Customer::where('account_number' ,'=', $policydetails->account_number)->get()->first();
    $protectedlimit  =  UnderwriterLimits::where('level', Auth::user()->getRole())->where('product',$policydetails->policy_product)->first();

    //dd($policydetails);
    switch($policydetails->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('policy_number','=',$policydetails->policy_number)->get();
            return view('policy.motor_schedule', compact('policydetails','balancesheet','bills','claims','fetchrecord','customers','certificate','debitid','protectedlimit','debitreference'));
            break;


         case 'Fire Insurance':
            $fetchrecord  = FireDetails::all()->where('policy_number',$policydetails->policy_number)->groupby(['risk_number']);
            $mastergroup = FireDetails::where('policy_number',$policydetails->policy_number)->get();
            $fees    = AdminFees::where('type','Sticker Fee')->first();
           // dd($fetchrecord);
            return view('policy.fire_schedule', compact('policydetails','fetchrecord','customers','mastergroup','fees','debitid','protectedlimit'));
             break;


          case 'Bond Insurance':
            $fetchrecord  = BondDetails::where('policy_number',$policydetails->policy_number)->get();
            return view('policy.bond_schedule', compact('policydetails','fetchrecord','customers','debitid','protectedlimit'));
             break;


           case 'Engineering Insurance':
            $fetchrecord  = EngineeringDetails::where('policy_number',$policydetails->policy_number)->get();
            return view('policy.engineering_schedule', compact('policydetails','fetchrecord','customers','debitid','protectedlimit'));
             break;

           case 'Marine Insurance':
            $fetchrecord  = MarineDetails::where('policy_number',$policydetails->policy_number)->get();
            return view('policy.marine_schedule', compact('policydetails','fetchrecord','customers','debitid','protectedlimit'));
             break;


            case 'General Accident Insurance':
            $fetchrecord  = AccidentDetails::all()->where('policy_number',$policydetails->policy_number)->groupby(['risk_number','item_number']);
            $mastergroup = AccidentDetails::where('policy_number',$policydetails->policy_number)->get();
             //dd($fetchrecord);
            return view('policy.accident_schedule', compact('policydetails','fetchrecord','customers','mastergroup','debitid','protectedlimit'));
             break;

            
            case 'Liability Insurance':
            $fetchrecord  = LiabilityDetails::all()->where('policy_number',$policydetails->policy_number)->groupby(['risk_number','item_number']);
             $mastergroup = LiabilityDetails::where('policy_number',$policydetails->policy_number)->get();

          
            return view('policy.liability_schedule', compact('policydetails','fetchrecord','customers','mastergroup','debitid','protectedlimit'));
             break;


 //dd($fetchrecord);

      //dd($certificate);

    
    }

  }


    public function downloadschedule($type)
    {


        $data = Customer::get()->toArray();
        return Excel::create('ListOfCustomers', function($excel) use ($data) {
            $excel->sheet('List', function($sheet) use ($data)
            {
               
                $sheet->protect('jason');
                $sheet->fromArray($data);
                $sheet->setAutoSize(true);
                // Set font
                $sheet->setStyle(array(
                'font' => array(
                    'name'      =>  'Calibri',
                    'size'      =>  10,
                    'bold'      =>  false
                    )
                ));

            });
        })->download($type);
        

    }


     public function doMotorFleetRenewal(Request $request)
  {
    $vehicle_selected = $request->input('vehicle');
    $policy_number = $request->input('policy_number');
    $invoicenumberval = $this->generateInoviceNumber(10);
    


     $time = explode(" - ", $request->input('insurance_period'));
     $affectedRows = Policy::where('policy_number',  $policy_number)
            ->update(array(
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

    if(is_array($vehicle_selected))
    {
      foreach($vehicle_selected as $vehicle_selected)
      {


       
        $transactionid    = uniqid(20);
        $affectedRows = MotorDetails::where('id',  $vehicle_selected)
            ->update(array(
                           'period_from' => $this->change_date_format($time[0]), 
                           'period_to' =>$this->change_date_format($time[1])));

        $vehicledetail = MotorDetails::where('id',$vehicle_selected)->first();

        

         
        $billdetail    = Policy::where('policy_number',$vehicledetail->policy_number)->first();

        
        

        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $billdetail->account_number;
        $bill->fullname                     = $billdetail->fullname; 
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = $billdetail->policy_sales_type;
        $bill->transaction_type             = 'Renewal Premium';
        $bill->campaign                     = $billdetail->policy_sales_channel;
        $bill->branch                       = $billdetail->policy_branch;
        $bill->policy_number                = $billdetail->policy_number;
        $bill->policy_product               = $billdetail->policy_product;
        $bill->currency                     = $billdetail->policy_currency;
        $bill->amount                       = $vehicledetail->premium_charged; 
        $bill->commission_rate              = 12.5; 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->insurance_period_from        = $this->change_date_format($time[0]);
        $bill->insurance_period_to          = $this->change_date_format($time[1]);
        $bill->sum_insured                  = $vehicledetail->vehicle_value;
        $bill->cover_type                   = $vehicledetail->vehicle_cover;  
        $bill->policy_number                = $policy_number; 
         $bill->flag                        = 'Active'; 
        $bill->reg_number                   = strtoupper($vehicledetail->vehicle_registration_number);
        $bill->agency                       = $billdetail->agency;
        $bill->amount_in_words              = 'NA';
        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();
        $bill->save();

        $this->processestreaty_fac($transactionid);
      
      }

    }

     return redirect()
            ->route('view-policy',$policy_number)
            ->with('success','All selected vehicles successfully renewed and debits generated!');
  }






    public function fleetuploadcompute(Request $request)
    {

        $rules = array(
        'file' => 'required',
        
    );

    $validator = Validator::make(Input::all(), $rules);
    // process the form
    if ($validator->fails()) 
    {

       return redirect()
            ->route('online-policies/new')
            ->with('info','Fleet processing failed, Please verify all fields are correctly filled !');
    }
    else 
    {
  try {
             
        $file = Input::file('file');

        $mypolicy = Policy::where('id',Input::get("policy_number_id"))->first();

        Excel::load($file, function($reader) {
        $results = $reader->get()->toArray();
            
        foreach ($results as $key => $value) {

        //$policynumberval = Input::get('policy_number');
        //$policyref  = $this->generatePolicyNumber(Input::get('policy_product'));
        //$invoicenumberval = $this->generateInoviceNumber(10);
        //$time = explode(" - ", Input::get('insurance_period'));



        $policy                         = new Policy;
        $policy->account_number         = $mypolicy->account_number;
        $policy->fullname               = $mypolicy->fullname;  
        $policy->policy_number          = $mypolicy->policy_number;
        $policy->policy_source          = $mypolicy->policy_source;
        $policy->master_policy_number   = $mypolicy->master_policy_number;
        $policy->itemid                 = $value['vehicle_registration_number'];
        $policy->policy_product         = $mypolicy->policy_product;
        $policy->insurance_period_from  = $mypolicy->insurance_period_from;
        $policy->insurance_period_to    = $mypolicy->insurance_period_to;
        $policy->transaction_date       = $mypolicy->transaction_date;
        $policy->acceptance_date        = $mypolicy->acceptance_date;
        $policy->first_issue_date       = $mypolicy->first_issue_date;
        $policy->policy_sales_type      = $mypolicy->policy_sales_type;
        $policy->policy_sales_channel   = $mypolicy->policy_sales_channel;
        $policy->ref_number             = //uniqid();
        $policy->policy_currency        = $mypolicy->policy_currency;
        $policy->policy_status          = $mypolicy->policy_status;
        $policy->policy_branch          = $mypolicy->policy_branch;
        $policy->agency                 = $mypolicy->agency;
        $policy->coverage               = $value['preferedcover'];
        $policy->policy_clause          = $mypolicy->policy_clause;
        $policy->policy_interest        = $mypolicy->policy_interest;
        $policy->policy_upper_text      = $mypolicy->policy_upper_text;
        $policy->policy_lower_text      = $mypolicy->policy_lower_text;
        $policy->policy_end_text        = $mypolicy->policy_end_text;
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();
        $policy->save();





        //  //Motor Details
        // $motor                              = new MotorDetails;
        // $motor->policy_number               = $mypolicy->policy_number;
        // $motor->vehicle_cover               = $value['preferedcover'];    
        // $motor->vehicle_currency            = $value['currency'];  
        // $motor->vehicle_value               = $value['vehicle_value'];
        // $motor->vehicle_buy_back_excess     = $value['vehicle_buy_back_excess'];  
        // $motor->vehicle_tppdl_standard      = Input::get("vehicle_tppdl_standard"); 
        // $motor->vehicle_tppdl_value         = $value['vehicle_tppdl_value'];
        // $motor->vehicle_body_type           = $value['vehicle_body_type'];
        // $motor->vehicle_model               = $value['vehicle_model'];
        // $motor->vehicle_make                = $value['vehicle_make'];
        // $motor->vehicle_use                 = $value['vehicle_use'];
        // $motor->vehicle_make_year           = $value['vehicle_make_year'];
        // $motor->vehicle_seating_capacity    = $value['vehicle_seating_capacity'];
        // $motor->vehicle_cubic_capacity      = $value['vehicle_cubic_capacity'];
        // $motor->vehicle_registration_number = strtoupper($value['vehicle_registration_number']); 
        // $motor->vehicle_chassis_number      = $value['vehicle_chassis_number'];
        // $motor->vehicle_engine_number       = $value['vehicle_chassis_number'];
        // $motor->vehicle_interest_status     = Input::get("vehicle_interest_status");
        // $motor->vehicle_interest_name       = Input::get("vehicle_interest_name");
        // $motor->ref_number                  = $transactionid;
        // $motor->vehicle_risk                = $value['vehicle_risk'];
        // $motor->vehicle_ncd                 = $value['vehicle_ncd'];
        // $motor->vehicle_fleet_discount      = $value['vehicle_fleet_discount'];
        // $motor->created_by                  = Auth::user()->getNameOrUsername();
        // $motor->created_on                  = Carbon::now();
        // $motor->agency_code                 = Input::get("agency");
        // $motor->annual_premium              = Input::get("gross_premium");
        // $motor->premium_due                 = Input::get("netpremium");
        // $motor->vehicle_currency            = Input::get("policy_currency");
        // $motor->period_from                 = $datefrom;
        // $motor->period_to                   = $dateto;
        // $motor->vehicle_colour              = Input::get("vehicle_colour");
        // $motor->vehicle_register_date       = Input::get("vehicle_register_date");
        // $motor->vehicle_tonnage_capacity    = Input::get("vehicle_tonnage_capacity");
        // $motor->vehicle_mileage_number      = Input::get("vehicle_mileage_number");
        // $motor->vehicle_trailer_number      = Input::get("vehicle_trailer_number");
        // $motor->vehicle_log_book            = Input::get("vehicle_log_book");
        // $motor->vehicle_model_description   = Input::get("vehicle_model_description");
        // $motor->vehicle_purchase_price      = Input::get("vehicle_purchase_price");
        // $motor->vehicle_lta_upload          = Carbon::createFromFormat('d/m/Y', Input::get("vehicle_lta_upload"));
        // $motor->vehicle_lta_transmission    = Carbon::createFromFormat('d/m/Y', Input::get("vehicle_lta_transmission"));
        // $motor->sticker_number              = Input::get("sticker_number");
        // $motor->certificate_number          = Input::get("certificate_number");
        // $motor->brown_card_number           = Input::get("brown_card_number");
        // $motor->base_premium                = Input::get("tpbasic");
        // $motor->own_damage_premium          = Input::get("owndamage");
        // $motor->cc_age                      = Input::get("ccage");
        // $motor->office_premium              = Input::get("officepremium");
        // $motor->ncd_charge                  = Input::get("ncd");
        // $motor->fleet_charge                = Input::get("fleet");
        // $motor->loading_applied             = Input::get("loading");
        // $motor->contributions               = Input::get("contribution");
        // $motor->netpremium                  = Input::get("netpremium");
        // $motor->excess_bought               = Input::get("execessbought");
        // $motor->excess_charge_rate          = Input::get("excess_charge_rate");
        // $motor->save();
        //Invoice Generation


        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = Input::get("customer_number");
        $bill->fullname                     = Input::get("fullname"); 
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = Input::get("policy_sales_type");
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = Input::get("policy_sales_channel");
        $bill->branch                       = Input::get("policy_branch");
        $bill->policy_number                = Input::get("policy_number");
        $bill->policy_product               = Input::get("policy_product");
        $bill->currency                     = Input::get("policy_currency");
        $bill->sum_insured                  = $value['vehicle_value'];
        $bill->amount                       = $value['premium_payable'];
        $bill->commission_rate              = $value['commission_rate'];
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->insurance_period_from        = $this->change_date_format($time[0]);
        $bill->insurance_period_to          = $this->change_date_format($time[1]);
        $bill->cover_type                   = Input::get("preferedcover");  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = strtoupper(Input::get("vehicle_registration_number"));
        $bill->agency                       = Input::get("agency");
        $bill->amount_in_words              = $amountinwords;
        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();
        $bill->save();

    }
        });

           
            return redirect()
            ->route('online-policies')
            ->with('info','Policy has successfully been uploaded!');



        } 
        catch (\Exception $e) {
           
           echo $e->getMessage();
            
        }
    } 
} 





      public function newpolicywithcustomer($id)
    {
      
    $noclaimdiscount = NCD::all();
    $fleetdiscount = FleetDiscount::all();
    $vehiclemodels =  VehicleModel::all();
    $saleschannel = SalesChannel::all();
    $salestype    = SalesType::all();
    $insurers     = Insurers::orderby('name','asc')->get();
    $policytypes  = PolicyType::all();
    $intermediary = Agent::orderby('AGENTNAME','ASC')->get();
    $vehiclemakes = VehicleMake::all();
    $vehicletypes = VehicleType::all();
    $vehicleuses  = VehicleUse::distinct()->get(['risk']);
    $beneficiaries= Beneficiary::all();
    $selectstatus = SelectStatus::all();
    $roofed       = FireRoofed::all();
    $walled       = FireWalled::all();
    $selectstatus = SelectStatus::all();
    $currencies   = Currency::all();
    $firerisks    = FireRisk::all();
    $collectionmodes = CollectionMode::all();
    $customers    = Customer::where('account_number',$id)->first();
    $countries    = Country::all();
    $maritalstatus= MaritalStatus::all();
    $bondtypes    = BondTypes::all();
    $natureofwork = NatureofWork::all();
    $natureofaccident = NatureofAcccident::all();
    $mortagecompanies = MortgageCompanies::all();
    $propertytypes    = PropertyType::where('category','Risk')->orderby('type','asc')->get();
    $propertyitemtypes    = PropertyType::where('category','Item')->get();
    $marinetypes      = MarineRisktypes::all();
    $engineeringrisktypes    = EngineeringRisktypes::all();
    $accidenttypes     = AccidentRiskType::all();
    $liabilitytypes    = LiabilityRiskTypes::all();
    $producttypes = PolicyProductType::orderby('type','asc')->get();
    $healthplans  = HealthPlans::all();
    $lifeplans  = LifePlans::all();
    $business_statuses = BusinessStatus::all();
    $clausetypes = PolicyClauses::get();
    $paymentstatus = PaymentType::get();
    $branches = Branch::get();
    $policystatus = PolicyStatus::get();
    $year = range( date("Y") , 1990 );
    $policyratings = policyrating::all();
    $limitsofmeasures = UnitOfMeasure::all();
    $users = User::all();
    $stickers = StickerReturn::where('issued_to',Auth::user()->getNameOrUsername())->where('status','Unused')->get();

    //dd($clausetypes);

    return view('policy.new', compact('intermediary','users','stickers','propertyitemtypes','limitsofmeasures','policyratings','policystatus','paymentstatus','branches','clausetypes','business_statuses','lifeplans','healthplans','liabilitytypes','accidenttypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','natureofwork','natureofaccident','bondtypes','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);
    }


    public function newquotation()
    {
    $noclaimdiscount  = NCD::all();
    $fleetdiscount    = FleetDiscount::all();
    $vehiclemodels    = VehicleModel::all();
    $saleschannel     = SalesChannel::all();
    $salestype        = SalesType::all();
    $insurers         = Insurers::orderby('name','asc')->get();
    $policytypes      = PolicyType::all();
    $intermediary     = User::orderby('username','asc')->get();
    $vehiclemakes     = VehicleMake::all();
    $vehicletypes     = VehicleType::all();
    $vehicleuses      = VehicleUse::distinct()->get(['risk']);
    $beneficiaries    = Beneficiary::all();
    $selectstatus     = SelectStatus::all();
    $roofed           = FireRoofed::all();
    $walled           = FireWalled::all();
    $selectstatus     = SelectStatus::all();
    $currencies       = Currency::all();
    $firerisks        = FireRisk::all();
    $collectionmodes  = CollectionMode::all();
    $customers        = Customer::all();
    $countries        = Country::all();
    $maritalstatus    = MaritalStatus::all();
    $bondtypes        = BondTypes::all();
    $natureofwork     = NatureofWork::all();
    $natureofaccident = NatureofAcccident::all();
    $mortagecompanies = MortgageCompanies::all();
    $propertytypes    = PropertyType::all();
    $marinetypes      = MarineRisktypes::all();
    $engineeringrisktypes    = EngineeringRisktypes::all();
    $accidenttypes    = AccidentRiskType::all();
    $liabilitytypes   = LiabilityRiskTypes::all();
    $producttypes     = PolicyProductType::orderby('type','asc')->get();
    $healthplans      = HealthPlans::all();
    $lifeplans        = LifePlans::all();
    $year             = range( date("Y") , 1990 );

    return view('policy.quotation', compact('intermediary','lifeplans','healthplans','liabilitytypes','accidenttypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','natureofwork','natureofaccident','bondtypes','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);

    }



    
    
    public function generatePolicyNumber()
    
    {

     $generated = uniqid(5);

     $added_response = array('policy_number' => $generated);
     return  Response::json($added_response);

       
    }


    public function generateMasterPolicyNumber($policytype,$covertype,$certificate,$branch_name,$source)
    
    {

     $branchcode = Branch::where('branch_name',$branch_name)->first();
     $number = PolicySerials::where('policy_product',$policytype)->where('cover_type',$covertype)->where('certificate',$certificate)->first();
     $count = $number->count;
     $policyprefix = $number->prefix;
     
     $mybranch = $branchcode->branch_prefix;
     $policynumber = str_pad($count+1,7, '0', STR_PAD_LEFT);
     $policyyear = date('y');
     $occurance = '00';

     $prefixsource = 'D';

     if($source == 'Coinsurance')
     {
        $prefixsource = 'C';
     }
     elseif($source == 'Reinsurance Inward')
     {
        $prefixsource = 'R';
     }
     else
     {
        $prefixsource = 'D';
     }

    //Source|Policy type|Branch Prefix|Serial|Year|Occurance
     
    $generated = $prefixsource.$policyprefix.'-'.$mybranch.'-'.$policynumber.'-'.$policyyear.$occurance;

    PolicySerials::where('policy_product',$policytype)->where('cover_type',$covertype)->where('certificate',$certificate)->increment('count',1);

    return $generated;      
    }


    public function generateEndorsementNumber()
    
    {

     $number = PolicySerials::where('policy_product','Motor Insurance')->where('cover_type','Individual')->first();
     $count = $number->counter;
     $prefix = $number->prefix;
     $policynumber = str_pad($count+1,7, '0', STR_PAD_LEFT);
     //$generated = $prefix.$policynumber;
     $generated = uniqid(5);
     $added_response = array('endorsement_number' => $generated);
     return  Response::json($added_response);      
    }



     public function addBondDetails()
    {

        $time = explode(" - ", Input::get("insurance_period"));

        $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        $date = Carbon::now();
        $year = ($date->isLeapYear() ? 366 : 365);

        $year = $year - 1;
        $days = $dateto->diffInDays($datefrom);

        $premium = Input::get("bond_sum_insured")*Input::get("bond_rate")/100;

        $risk                            = new BondDetails;
        $risk->bond_risk_type            = Input::get("bond_risk_type");
        $risk->bond_interest             = Input::get("bond_interest");
        $risk->bond_interest_address     = Input::get("bond_interest_address");
        $risk->contract_sum              = Input::get("contract_sum");
        $risk->bond_sum_insured          = Input::get("bond_sum_insured");
        $risk->bond_rate                 = Input::get("bond_rate");
        $risk->premium_payable           = $premium;
        $risk->premium_due               = $premium * ($days/$year);
        $risk->bond_contract_description = Input::get("bond_contract_description");
        $risk->ref_number                = Input::get("reference_number");
        $risk->policy_number             = Input::get("policy_number");
     
        $risk->created_on      = Carbon::now();
        $risk->created_by      = Auth::user()->getNameOrUsername();
      


        if($risk->save())
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

     public function addMarineDetails()
    {

         //Marine Details

        $time = explode(" - ", Input::get("insurance_period"));

        $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        $date = Carbon::now();
        $year = ($date->isLeapYear() ? 366 : 365);

        $year = $year - 1;
        $days = $dateto->diffInDays($datefrom);

        $premium = Input::get("marine_sum_insured")*Input::get("marine_rate")/100;



        $marine                                   = new MarineDetails;
        $marine->policy_number                    = Input::get("policy_number");
        $marine->marine_risk_type                 = Input::get("marine_risk_type");
        $marine->marine_sum_insured               = Input::get("marine_sum_insured");
        $marine->marine_rate                      = Input::get("marine_rate");
        $marine->premium_payable           = $premium;
        $marine->premium_due               = $premium * ($days/$year);
        $marine->marine_interest                  = Input::get("marine_interest");
        $marine->marine_vessel                    = Input::get("marine_vessel");
        $marine->marine_insurance_condition       = Input::get("marine_insurance_condition");
        $marine->marine_valuation                 = Input::get("marine_valuation");
        $marine->marine_means_of_conveyance       = Input::get("marine_means_of_conveyance");
        $marine->marine_voyage                    = Input::get("marine_voyage");
        $marine->marine_condition                 = Input::get("marine_condition"); 
        $marine->voyage_date                      = $this->change_date_format(Input::get("voyage_date"));
        $marine->departure_date                   = $this->change_date_format(Input::get("departure_date"));
        $marine->created_on                       = Carbon::now();
        $marine->created_by                       = Auth::user()->getNameOrUsername();
        $marine->ref_number                       = uniqid(10); 



        if($marine->save())
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




    public function addFireLoadings()
    {

        $peril                         = new FirePerilApply;
        $peril->policy_number          = Input::get("policy_number");
        $peril->fire_peril             = Input::get("fire_peril");
        $peril->peril_rate             = Input::get("peril_rate");
        $peril->created_on              = Carbon::now();
        $peril->created_by              = Auth::user()->getNameOrUsername();
      


        if($peril->save())
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



   public function addEngineeringDetails()
   {


        $time = explode(" - ", Input::get("insurance_period"));

         $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        $date = Carbon::now();
        $year = ($date->isLeapYear() ? 366 : 365);

        $year = $year - 1;
        $days = $dateto->diffInDays($datefrom);

        $premium = Input::get("car_contract_sum")*Input::get("car_contract_rate")/100;

        $engineering                                   = new EngineeringDetails;
        $engineering->risk_type                        = Input::get("car_risk_type");
        $engineering->policy_number                    = Input::get("policy_number");
        $engineering->car_parties                      = Input::get("car_parties");
        $engineering->car_nature_of_business           = Input::get("car_nature_of_business");
        $engineering->car_contract_description         = Input::get("car_contract_description");
        $engineering->car_contract_sum                 = Input::get("car_contract_sum");
        $engineering->car_contract_rate                = Input::get("car_contract_rate");
        $engineering->car_contract_premium             = $premium;
        $engineering->car_premium_payable              = $premium * ($days/$year);
        $engineering->car_deductible                   = Input::get("car_deductible");
        $engineering->car_endorsements                 = Input::get("car_endorsements");
        $engineering->created_on                       = Carbon::now();
        $engineering->created_by                       = Auth::user()->getNameOrUsername();
        $engineering->ref_number                       = uniqid(10);

        if($engineering->save())
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


   public function addAccidentDetails()
   {
        $time = explode(" - ", Input::get("insurance_period"));

         $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        $date = Carbon::now();
        $year = ($date->isLeapYear() ? 366 : 365);

        $year = $year - 1;
        $days = $dateto->diffInDays($datefrom);

        $premium = Input::get("accident_si")*Input::get("accident_rate")/100;
        
        $discount = $premium * Input::get("accident_sd_rate")/100;

        $netpremium = $premium - $discount;

        $accident                                   = new AccidentDetails;
        $accident->policy_number                    = Input::get("policy_number");
        $accident->account_number                   = Input::get("account_number");
        $accident->risk_number                      = Input::get("accident_risk_number");
        $accident->item_number                      = Input::get("accident_item_number");
        $accident->risk_type                        = Input::get("accident_risk_type");
        $accident->unit                             = Input::get("accident_unit");
        $accident->currency                         = Input::get("currency");
        $accident->sum_insured                      = Input::get("accident_si");
        $accident->rate                             = Input::get("accident_rate");
        $accident->schedule                         = Input::get("accident_schedule");
        $accident->beneficiary                      = Input::get("accident_beneficiary");
        $accident->risk_description                 = Input::get("accident_risk_description");
        $accident->item_description                 = Input::get("accident_item_description");
        $accident->gross_premium                    = $premium;
        $accident->net_premium                      = $netpremium;
        $accident->discount_premium                 = $discount;
        $accident->premium_due                      = $netpremium * ($days/$year);
        
        $accident->created_on                       = Carbon::now();
        $accident->created_by                       = Auth::user()->getNameOrUsername();
        $accident->reference_number                 = uniqid(10);
        $accident->discount                         = Input::get("accident_sd_rate");



        if($accident->save())
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


   public function addLiabilityDetails()
   {

        $time = explode(" - ", Input::get("insurance_period"));

         $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        $date = Carbon::now();
        $year = ($date->isLeapYear() ? 366 : 365);

        $year = $year - 1;
        $days = $dateto->diffInDays($datefrom);

        $premium = Input::get("liability_si")*Input::get("liability_rate")/100;
        
        $discount = $premium * Input::get("liability_sd_rate")/100;

        $netpremium = $premium - $discount;

        $liability                                   = new LiabilityDetails;
        $liability->policy_number                    = Input::get("policy_number");
        $liability->account_number                   = Input::get("account_number");
        $liability->risk_number                      = Input::get("liability_risk_number");
        $liability->item_number                      = Input::get("liability_item_number");
        $liability->risk_type                        = Input::get("liability_risk_type");
        $liability->unit                             = Input::get("liability_unit");
        $liability->risk_description                 = Input::get("liability_risk_description");
        $liability->item_description                 = Input::get("liability_item_description");
        $liability->currency                         = Input::get("currency");
        $liability->sum_insured                      = Input::get("liability_si");
        $liability->rate                             = Input::get("liability_rate");
        $liability->schedule                         = Input::get("liability_schedule");
        $liability->beneficiary                      = Input::get("liability_beneficiary");
        
        $liability->gross_premium                    = $premium;
        $liability->net_premium                      = $netpremium;
        $liability->discount_premium                 = $discount;
        $liability->premium_due                      = $netpremium * ($days/$year);
        
        $liability->created_on                       = Carbon::now();
        $liability->created_by                       = Auth::user()->getNameOrUsername();
        $liability->reference_number                 = uniqid(10);
        $liability->discount                         = Input::get("liability_sd_rate");


        if($liability->save())
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

     public function addProperty()
    {

        $time = explode(" - ", Input::get("insurance_period"));

         $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        $date = Carbon::now();
        $year = ($date->isLeapYear() ? 366 : 365);

        $year = $year - 1;
        $days = $dateto->diffInDays($datefrom);

        $premium = Input::get("item_value") * Input::get("fire_rate")/100;

        $collapsevalue = Input::get("item_value") * Input::get("collapserate")/100;
        $lta = Input::get("lta");
        $fireexdiscount = Input::get("fire_extinguisher");
        $firehydis = Input::get("fire_hydrant");

        $lta_val = $premium * $lta/100;
        $fire_ex_val = ($premium - $lta_val) * $fireexdiscount/100;
        $fire_hy_val = ($premium - $lta_val - $fire_ex_val) * $firehydis/100;
        $annual_premium = $premium - $lta_val - $fire_ex_val -  $fire_hy_val;




        $risk                         = new FireDetails;
        $risk->policy_number          = Input::get("policy_number");
        $risk->fire_risk_covered      = Input::get("fire_risk_covered");
        $risk->property_type          = Input::get("property_type");
        $risk->risk_number            = Input::get("property_number");
        $risk->item_number            = Input::get("item_number");
        $risk->item_value             = Input::get("item_value");
        $risk->rate                   = Input::get("fire_rate");
        $risk->unit_number            = Input::get("unit_number");
        $risk->property_address       = Input::get("property_address");
        $risk->property_description   = Input::get("property_description");
        $risk->longitude_x            = Input::get("longitude_x");
        $risk->longitude_y            = Input::get("longitude_y");
        $risk->survey_number          = Input::get("survey_number");

        $risk->long_term_discount     = Input::get("lta");
        $risk->fire_extinguisher      = Input::get("fire_extinguisher");
        $risk->fire_hydrant           = Input::get("fire_hydrant");
        $risk->staff_discount         = Input::get("staff_discount");
        $risk->collapse               = Input::get("collapserate");
        
        $risk->actual_premium         = $premium;
        $risk->annual_premium         = $annual_premium;
        $risk->premium_payable        = $annual_premium * $days/$year;
        $risk->no_of_days             = $days;
        $risk->long_term_value        = $lta_val;
        $risk->fire_ex_value          = $fire_ex_val;
        $risk->fire_hy_value         =  $fire_hy_val;
        
        //$risk->flood_rate             = Input::get("survey_number");
        // $risk->earth_quake            = Input::get("survey_number");
        
        $risk->survey_date            = Input::get("survey_date");
        $risk->property_content       = Input::get("property_content");
     
        $risk->created_on      = Carbon::now();
        $risk->created_by      = Auth::user()->getNameOrUsername();
      


        if($risk->save())
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



    public function addMotorSchedule()
    {


        $disablepolicy         = Policy::where('policy_number',Input::get("policy_number"))->delete();
        //$disablepolicy         = MotorDetails::where('policy_number',Input::get("vehicle_registration_number"))->delete();
        $disablebill           = Bill::where('policy_number',Input::get("policy_number"))->delete();
        $disablereinsurance    = Reinsurance::where('policy_number', Input::get("policy_number"))->delete();


        $policynumberval  = Input::get("policy_number"); 
        $invoicenumberval = $this->generateInoviceNumber(10);
        $transactionid    = uniqid(20);

        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
        $amountinwords =  $currencyTransformer->toWords(Input::get("gross_premium")*100, Input::get("policy_currency"));

         $exchanges       =  ExchangeRate::where('type',Input::get("policy_currency"))->first();

        //dd($request->input('policy_interest'));

        if(Input::get("policy_clause")){$policy_clause = implode(", ", Input::get("policy_clause"));} else {$policy_clause = null;}
        if(Input::get("policy_interest")){$policy_interest =  implode(", ", Input::get("policy_interest"));} else {$policy_interest = null;}
        

        //dd(Input::get("insurance_period"));
        $policy_number    = Input::get("policy_number"); 
        $time = explode(" - ", Input::get("insurance_period"));

        $masterpolicynumber = 'This a draft schedule';//$this->generateMasterPolicyNumber(Input::get("policy_product"),Input::get("vehicle_use"),Input::get("vehicle_risk"),Input::get("policy_branch"),Input::get("policy_sales_type"));

        $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        
                //Policy Details
        $policy                         = new Policy;
        $policy->account_number         = Input::get("customer_number");
        $policy->fullname               = Input::get("fullname");  
        $policy->policy_number          = Input::get("policy_number");
        $policy->policy_source          = Input::get("policy_sales_type");
        $policy->master_policy_number   = $masterpolicynumber;  
        $policy->itemid                 = strtoupper(Input::get("vehicle_registration_number")); 
        $policy->policy_product         = Input::get("policy_product"); 
        $policy->insurance_period_from  = $datefrom;
        $policy->insurance_period_to    = $dateto;
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y', Input::get("transaction_date"));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y', Input::get("acceptance_date"));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', Input::get("issue_date"));
        $policy->policy_sales_type      = Input::get("policy_sales_type");
        $policy->policy_sales_channel   = Input::get("policy_sales_channel");
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = Input::get("policy_currency");
        $policy->policy_status          = Input::get("policy_status");
        $policy->policy_branch          = Input::get("policy_branch");
        $policy->agency                 = Input::get("agency");
        $policy->coverage               = Input::get("preferedcover");
        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;
        $policy->policy_upper_text      = Input::get("policy_upper_text");
        $policy->policy_lower_text      = Input::get("policy_lower_text");
        $policy->policy_end_text        = Input::get("policy_end_text");
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->managed_by             = Input::get("account_manager");
        $policy->created_on             = Carbon::now();


        //Motor Details
        $motor                              = new MotorDetails;
        $motor->policy_number               = Input::get("policy_number");
        $motor->vehicle_cover               = Input::get("preferedcover");  
        $motor->vehicle_currency            = Input::get("policy_currency");
        $motor->vehicle_value               = Input::get("vehicle_value");
        $motor->vehicle_buy_back_excess     = Input::get("vehicle_buy_back_excess"); 
        $motor->vehicle_tppdl_standard      = Input::get("vehicle_tppdl_standard"); 
        $motor->vehicle_tppdl_value         = Input::get("vehicle_tppdl_value");
        $motor->vehicle_body_type           = Input::get("vehicle_body_type");
        $motor->vehicle_model               = Input::get("vehicle_model");
        $motor->vehicle_make                = Input::get("vehicle_make");
        $motor->vehicle_use                 = Input::get("vehicle_use");
        $motor->vehicle_make_year           = Input::get("vehicle_make_year");
        $motor->vehicle_seating_capacity    = Input::get("vehicle_seating_capacity");
        $motor->vehicle_cubic_capacity      = Input::get("vehicle_cubic_capacity");
        $motor->vehicle_registration_number = strtoupper(Input::get("vehicle_registration_number")); 
        $motor->vehicle_chassis_number      = Input::get("vehicle_chassis_number");
        $motor->vehicle_engine_number       = Input::get("vehicle_engine_number");
        $motor->vehicle_interest_status     = Input::get("vehicle_interest_status");
        $motor->vehicle_interest_name       = Input::get("vehicle_interest_name");
        $motor->owner_details               = Input::get("vehicle_owner_name");

        $motor->ref_number                  = $transactionid;
        $motor->vehicle_risk                = Input::get("vehicle_risk");
        $motor->vehicle_ncd                 = Input::get("vehicle_ncd");
        $motor->vehicle_fleet_discount      = Input::get("vehicle_fleet_discount");
        $motor->created_by                  = Auth::user()->getNameOrUsername();
        $motor->created_on                  = Carbon::now();
        $motor->agency_code                 = Input::get("agency");
        $motor->annual_premium              = Input::get("gross_premium");
        $motor->premium_due                 = Input::get("netpremium");
        $motor->vehicle_currency            = Input::get("policy_currency");
        $motor->period_from                 = $datefrom;
        $motor->period_to                   = $dateto;
        $motor->vehicle_colour              = Input::get("vehicle_colour");
        $motor->vehicle_register_date       = Input::get("vehicle_register_date");
        $motor->vehicle_tonnage_capacity    = Input::get("vehicle_tonnage_capacity");
        $motor->vehicle_mileage_number      = Input::get("vehicle_mileage_number");
        $motor->vehicle_trailer_number      = Input::get("vehicle_trailer_number");
        $motor->vehicle_log_book            = Input::get("vehicle_log_book");
        $motor->vehicle_model_description   = Input::get("vehicle_model_description");
        $motor->vehicle_purchase_price      = Input::get("vehicle_purchase_price");
        $motor->vehicle_lta_upload          = Carbon::createFromFormat('d/m/Y', Input::get("vehicle_lta_upload"));
        $motor->vehicle_lta_transmission    = Carbon::createFromFormat('d/m/Y', Input::get("vehicle_lta_transmission"));
        $motor->sticker_number              = Input::get("sticker_number");
        $motor->certificate_number          = Input::get("certificate_number");
        $motor->brown_card_number           = Input::get("brown_card_number");
        $motor->base_premium                = Input::get("tpbasic");
        $motor->own_damage_premium          = Input::get("owndamage");
        $motor->cc_age                      = Input::get("ccage");
        $motor->office_premium              = Input::get("officepremium");
        $motor->ncd_charge                  = Input::get("ncd");
        $motor->fleet_charge                = Input::get("fleet");
        $motor->loading_applied             = Input::get("loading");
        $motor->contributions               = Input::get("contribution");
        $motor->netpremium                  = Input::get("netpremium");
        $motor->excess_bought               = Input::get("execessbought");
        $motor->excess_charge_rate          = Input::get("excess_charge_rate");


        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = Input::get("customer_number");
        $bill->fullname                     = Input::get("fullname"); 
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = Input::get("policy_sales_type");
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = Input::get("policy_sales_channel");
        $bill->branch                       = Input::get("policy_branch");
        $bill->policy_number                = Input::get("policy_number");
        $bill->policy_product               = Input::get("policy_product");
        $bill->currency                     = Input::get("policy_currency");
        $bill->amount                       = Input::get("netpremium"); 
        $bill->commission_rate              = Input::get("commission_rate"); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';
        $bill->flag                         = 'Draft';   
        $bill->insurance_period_from        = $datefrom;
        $bill->insurance_period_to          = $dateto;
        $bill->sum_insured                  = Input::get("vehicle_value");
        $bill->cover_type                   = Input::get("preferedcover");  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = strtoupper(Input::get("vehicle_registration_number"));
        $bill->agency                       = Input::get("agency");
        $bill->amount_in_words              = $amountinwords;
        $bill->exchange_rate                = $exchanges->rate;
        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



        if($motor->save() && $policy->save() && $bill->save())
            {
            
             $this->processestreaty_fac($transactionid);

               $affectedRows = StickerReturn::where('sticker_number' , Input::get("sticker_number"))
            ->update(array(
                           
                           'reference_number' =>  Input::get("vehicle_registration_number"),
                           'reference_name' =>  Input::get("fullname"),
                           'insurance_period' => $datefrom.' - '.$dateto, 
                           'status' => 'Used', 
                           'issued_by'=> Auth::user()->getNameOrUsername(),
                           'issued_on'=>Carbon::now()));


                
             $policydetails   =  Policy::where('policy_number' , Input::get("policy_number"))->get()->first();

             $myid = $policydetails->id;
             $added_response = array('OK'=>'OK','ReferenceNumber'=>$myid);
             return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }
    


    }


     public function addMotorScheduleFleet()
    {


        //$disablepolicy         = Policy::where('policy_number',Input::get("policy_number"))->delete();
        //$disablepolicy         = MotorDetails::where('policy_number',Input::get("vehicle_registration_number"))->delete();
        //$disablebill           = Bill::where('policy_number',Input::get("policy_number"))->delete();
        //$disablereinsurance    = Reinsurance::where('policy_number', Input::get("policy_number"))->delete();


        $policynumberval  = Input::get("policy_number"); 
        $invoicenumberval = $this->generateInoviceNumber(10);
        $transactionid    = uniqid(20);

        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
        $amountinwords =  $currencyTransformer->toWords(Input::get("gross_premium")*100, Input::get("policy_currency"));

         $exchanges       =  ExchangeRate::where('type',Input::get("policy_currency"))->first();

        //dd($request->input('policy_interest'));

        if(Input::get("policy_clause")){$policy_clause = implode(", ", Input::get("policy_clause"));} else {$policy_clause = null;}
        if(Input::get("policy_interest")){$policy_interest =  implode(", ", Input::get("policy_interest"));} else {$policy_interest = null;}
        

        //dd(Input::get("insurance_period"));
        $policy_number    = Input::get("policy_number"); 
        $time = explode(" - ", Input::get("insurance_period"));

        $masterpolicynumber = 'This a draft schedule';//$this->generateMasterPolicyNumber(Input::get("policy_product"),Input::get("vehicle_use"),Input::get("vehicle_risk"),Input::get("policy_branch"),Input::get("policy_sales_type"));

        $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        
                //Policy Details
        $policy                         = new Policy;
        $policy->account_number         = Input::get("customer_number");
        $policy->fullname               = Input::get("fullname");  
        $policy->policy_number          = Input::get("policy_number");
        $policy->policy_source          = Input::get("policy_sales_type");
        $policy->master_policy_number   = $masterpolicynumber;  
        $policy->itemid                 = strtoupper(Input::get("vehicle_registration_number")); 
        $policy->policy_product         = Input::get("policy_product"); 
        $policy->insurance_period_from  = $datefrom;
        $policy->insurance_period_to    = $dateto;
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y', Input::get("transaction_date"));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y', Input::get("acceptance_date"));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', Input::get("issue_date"));
        $policy->policy_sales_type      = Input::get("policy_sales_type");
        $policy->policy_sales_channel   = Input::get("policy_sales_channel");
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = Input::get("policy_currency");
        $policy->policy_status          = Input::get("policy_status");
        $policy->policy_branch          = Input::get("policy_branch");
        $policy->agency                 = Input::get("agency");
        $policy->coverage               = Input::get("preferedcover");
        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;
        $policy->policy_upper_text      = Input::get("policy_upper_text");
        $policy->policy_lower_text      = Input::get("policy_lower_text");
        $policy->policy_end_text        = Input::get("policy_end_text");
        $policy->managed_by             = Input::get("account_manager");
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Motor Details
        $motor                              = new MotorDetails;
        $motor->policy_number               = Input::get("policy_number");
        $motor->vehicle_cover               = Input::get("preferedcover");  
        $motor->vehicle_currency            = Input::get("policy_currency");
        $motor->vehicle_value               = Input::get("vehicle_value");
        $motor->vehicle_buy_back_excess     = Input::get("vehicle_buy_back_excess"); 
        $motor->vehicle_tppdl_standard      = Input::get("vehicle_tppdl_standard"); 
        $motor->vehicle_tppdl_value         = Input::get("vehicle_tppdl_value");
        $motor->vehicle_body_type           = Input::get("vehicle_body_type");
        $motor->vehicle_model               = Input::get("vehicle_model");
        $motor->vehicle_make                = Input::get("vehicle_make");
        $motor->vehicle_use                 = Input::get("vehicle_use");
        $motor->vehicle_make_year           = Input::get("vehicle_make_year");
        $motor->vehicle_seating_capacity    = Input::get("vehicle_seating_capacity");
        $motor->vehicle_cubic_capacity      = Input::get("vehicle_cubic_capacity");
        $motor->vehicle_registration_number = strtoupper(Input::get("vehicle_registration_number")); 
        $motor->vehicle_chassis_number      = Input::get("vehicle_chassis_number");
        $motor->vehicle_engine_number       = Input::get("vehicle_engine_number");
        $motor->vehicle_interest_status     = Input::get("vehicle_interest_status");
        $motor->vehicle_interest_name       = Input::get("vehicle_interest_name");
        $motor->ref_number                  = $transactionid;
        $motor->vehicle_risk                = Input::get("vehicle_risk");
        $motor->vehicle_ncd                 = Input::get("vehicle_ncd");
        $motor->vehicle_fleet_discount      = Input::get("vehicle_fleet_discount");
        $motor->created_by                  = Auth::user()->getNameOrUsername();
        $motor->created_on                  = Carbon::now();
        $motor->agency_code                 = Input::get("agency");
        $motor->annual_premium              = Input::get("gross_premium");
        $motor->premium_due                 = Input::get("netpremium");
        $motor->vehicle_currency            = Input::get("policy_currency");
        $motor->period_from                 = $datefrom;
        $motor->period_to                   = $dateto;
        $motor->vehicle_colour              = Input::get("vehicle_colour");
        $motor->vehicle_register_date       = Input::get("vehicle_register_date");
        $motor->vehicle_tonnage_capacity    = Input::get("vehicle_tonnage_capacity");
        $motor->vehicle_mileage_number      = Input::get("vehicle_mileage_number");
        $motor->vehicle_trailer_number      = Input::get("vehicle_trailer_number");

        $motor->vehicle_log_book            = Input::get("vehicle_log_book");
        $motor->vehicle_model_description   = Input::get("vehicle_model_description");
        $motor->vehicle_purchase_price      = Input::get("vehicle_purchase_price");

        $motor->vehicle_lta_upload          = Carbon::createFromFormat('d/m/Y', Input::get("vehicle_lta_upload"));
        $motor->vehicle_lta_transmission    = Carbon::createFromFormat('d/m/Y', Input::get("vehicle_lta_transmission"));

        $motor->sticker_number              = Input::get("sticker_number");
        $motor->certificate_number          = Input::get("certificate_number");
        $motor->brown_card_number           = Input::get("brown_card_number");

        $motor->base_premium                = Input::get("tpbasic");
        $motor->own_damage_premium          = Input::get("owndamage");
        $motor->cc_age                      = Input::get("ccage");
        $motor->office_premium              = Input::get("officepremium");
        $motor->ncd_charge                  = Input::get("ncd");
        $motor->fleet_charge                = Input::get("fleet");
        $motor->loading_applied             = Input::get("loading");
        $motor->contributions               = Input::get("contribution");
        $motor->netpremium                  = Input::get("netpremium");

        $motor->excess_bought               = Input::get("execessbought");
        $motor->excess_charge_rate          = Input::get("excess_charge_rate");


        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = Input::get("customer_number");
        $bill->fullname                     = Input::get("fullname"); 
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = Input::get("policy_sales_type");
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = Input::get("policy_sales_channel");
        $bill->branch                       = Input::get("policy_branch");
        $bill->policy_number                = Input::get("policy_number");
        $bill->policy_product               = Input::get("policy_product");
        $bill->currency                     = Input::get("policy_currency");
        $bill->amount                       = Input::get("netpremium"); 
        $bill->commission_rate              = Input::get("commission_rate"); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';
        $bill->flag                         = 'Draft';   
        $bill->insurance_period_from        = $datefrom;
        $bill->insurance_period_to          = $dateto;
        $bill->sum_insured                  = Input::get("vehicle_value");
        $bill->cover_type                   = Input::get("preferedcover");  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = strtoupper(Input::get("vehicle_registration_number"));
        $bill->agency                       = Input::get("agency");
        $bill->amount_in_words              = $amountinwords;
        $bill->exchange_rate                = $exchanges->rate;
        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



        if($motor->save() && $policy->save() && $bill->save())
            {
            
             $this->processestreaty_fac($transactionid);
                
             $policydetails   =  Policy::where('policy_number' , Input::get("policy_number"))->get()->first();

             $myid = $policydetails->id;
             $added_response = array('OK'=>'OK','ReferenceNumber'=>$myid);
             return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }
    


    }




    public function saveNonMotorPolicy()
    {

       

        $disablepolicy         = Policy::where('policy_number',Input::get("policy_number"))->delete();
        $disablebill           = Bill::where('policy_number',Input::get("policy_number"))->delete();
        $disablereinsurance    = Reinsurance::where('policy_number', Input::get("policy_number"))->delete();

        $policynumberval  = Input::get("policy_number"); 
        $invoicenumberval = $this->generateInoviceNumber(10);
        $transactionid    = uniqid(20);


        $exchanges       =  ExchangeRate::where('type',Input::get("policy_currency"))->first();

        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
        $amountinwords =  $currencyTransformer->toWords(Input::get("gross_premium")*100, Input::get("policy_currency"));


        //dd($request->input('policy_interest'));

        if(Input::get("policy_clause")){$policy_clause = implode(", ", Input::get("policy_clause"));} else {$policy_clause = null;}
        if(Input::get("policy_interest")){$policy_interest =  implode(", ", Input::get("policy_interest"));} else {$policy_interest = null;}
        

        //dd(Input::get("insurance_period"));
        $policy_number    = Input::get("policy_number"); 
        $time = explode(" - ", Input::get("insurance_period"));

        $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
        $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

        $masterpolicynumber = 'This a draft schedule';//$this->generateMasterPolicyNumber(Input::get("policy_product"),Input::get("preferedcover"),'NA',Input::get("policy_branch"),Input::get("policy_sales_type"));

        
                //Policy Details
        $policy                         = new Policy;
        $policy->account_number         = Input::get("customer_number");
        $policy->fullname               = Input::get("fullname");  
        $policy->policy_number          = Input::get("policy_number");  
        $policy->policy_source          = Input::get("policy_sales_type");  
        $policy->master_policy_number   = $masterpolicynumber;  
        $policy->itemid                 = $transactionid; 
        $policy->policy_product         = Input::get("policy_product"); 
        $policy->insurance_period_from  = $datefrom;
        $policy->insurance_period_to    = $dateto;
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y', Input::get("transaction_date"));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y', Input::get("acceptance_date"));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', Input::get("issue_date"));
        $policy->policy_sales_type      = Input::get("policy_sales_type");
        $policy->policy_sales_channel   = Input::get("policy_sales_channel");
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = Input::get("policy_currency");
        $policy->policy_status          = Input::get("policy_status");
        $policy->policy_branch          = Input::get("policy_branch");
        $policy->agency                 = Input::get("agency");
        $policy->coverage               = Input::get("preferedcover");
        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;
        $policy->policy_upper_text      = Input::get("policy_upper_text");
        $policy->policy_lower_text      = Input::get("policy_lower_text");
        $policy->policy_end_text        = Input::get("policy_end_text");
        $policy->managed_by             = Input::get("account_manager");
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = Input::get("customer_number");
        $bill->fullname                     = Input::get("fullname"); 
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = Input::get("policy_sales_type");
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = Input::get("policy_sales_channel");
        $bill->branch                       = Input::get("policy_branch");
        $bill->policy_number                = Input::get("policy_number");
        $bill->policy_product               = Input::get("policy_product");
        $bill->currency                     = Input::get("policy_currency");
        $bill->amount                       = Input::get("gross_premium"); 
        $bill->commission_rate              = Input::get("commission_rate"); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->flag                         = 'Draft';   
        $bill->insurance_period_from        = $datefrom;
        $bill->insurance_period_to          = $dateto;
        $bill->sum_insured                  = Input::get("sum_insured");
        $bill->cover_type                   = Input::get("preferedcover");  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = $transactionid;
        $bill->exchange_rate                = $exchanges->rate;
        $bill->agency                       = Input::get("agency");
        $bill->amount_in_words              = $amountinwords;
        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();

         


        if($policy->save() &&  $bill->save())
            {
                $this->processestreaty_fac($transactionid);



               $policydetails   =  Policy::where('policy_number' , Input::get("policy_number"))->get()->first();

             $myid = $policydetails->id;
             $added_response = array('OK'=>'OK','ReferenceNumber'=>$myid);
             return  Response::json($added_response);

            }
            else
            {
                $added_response = array('No Data'=>'No Data');
                return  Response::json($added_response);
            }



    }



       public function deleteFirePeril()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = FirePerilApply::where('id', '=', $ID)->delete();

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

       public function deleteProperty()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = FireDetails::where('id', '=', $ID)->delete();

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


        public function deleteMarineSchedule()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = MarineDetails::where('id', '=', $ID)->delete();

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


       public function deleteEngineeringSchedule()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = EngineeringDetails::where('id', '=', $ID)->delete();

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


        public function deleteAccidentSchedule()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = AccidentDetails::where('id', '=', $ID)->delete();

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


  public function deleteLiabilitySchedule()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = LiabilityDetails::where('id', '=', $ID)->delete();

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


        public function deleteMotorSchedule()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = MotorDetails::where('id', '=', $ID)->delete();

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


    public function deleteBondSchedule()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = BondDetails::where('id', '=', $ID)->delete();

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



public function getProperty()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = FireDetails::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getFirePeril()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = FirePerilApply::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getMarineSchedule()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = MarineDetails::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}

public function getMotorSchedule()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = MotorDetails::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getLiabilitySchedule()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = LiabilityDetails::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}


public function getAccidentSchedule()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = AccidentDetails::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}





public function getEngineeringSchedule()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = EngineeringDetails::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}




public function getBondSchedule()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = BondDetails::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}



 public function addPropertyItem()
    {

        $risk                         = new FireDetailItems;
        $risk->policy_number          = Input::get("policy_number");
        $risk->item_type               = Input::get("item_type");
        $risk->property_number        = Input::get("item_property_number");
        $risk->item_number            = Input::get("item_number");
        $risk->item_description       = Input::get("item_description");

     
        $risk->created_on      = Carbon::now();
        $risk->created_by      = Auth::user()->getNameOrUsername();
      


        if($risk->save())
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


       public function deletePropertyItem()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = FireDetailItems::where('id', '=', $ID)->delete();

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



public function getPropertyItem()
{

    try
    {

            $policy_number = Input::get("policy_number");
            $items = FireDetailItems::where('policy_number',$policy_number)->get();
              return  Response::json($items);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }
}

   

    public function generateInoviceNumber()
    {
    $number = Serials::where('name','=','invoice')->first();
    $number = $number->counter;
    $account = str_pad($number,7, '0', STR_PAD_LEFT);
    $myaccount = DB::select('call gen_debit_number("01","999","997")');
    $myaccount = $myaccount[0]->MYID;
    
    return  $myaccount;
    }




    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y', $date);
        return $time->format('Y-m-d');
    }


    public function getSearchResults(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $policies = Policy::sortable()->where('policy_product', 'like', "%$search%")
            ->orWhere('itemid', 'like', "%$search%")
            ->orWhere('fullname', 'like', "%$search%")
            ->orWhere('created_by', 'like', "%$search%")
            ->orWhere('account_number', 'like', "%$search%")
            ->orWhere('master_policy_number', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orderBy('account_number')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


        return View('policy.index',compact('policies'));
  
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

 

      public function editPolicy($id)
    {

    $noclaimdiscount   = NCD::all();
    $fleetdiscount     = FleetDiscount::all();
    $vehiclemodels     = VehicleModel::all();
    $saleschannel      = SalesChannel::all();
    $salestype         = SalesType::all();
    $insurers          = Insurers::orderby('name','asc')->get();
    $policytypes       = PolicyType::all();
    $intermediary      = User::orderby('username','ASC')->get();
    $vehiclemakes      = VehicleMake::all();
    $vehicletypes      = VehicleType::all();
    $vehicleuses       = VehicleUse::distinct()->get(['risk']);
    $beneficiaries     = Beneficiary::all();
    $selectstatus      = SelectStatus::all();
    $roofed            = FireRoofed::all();
    $walled            = FireWalled::all();
    $selectstatus      = SelectStatus::all();
    $currencies        = Currency::all();
    $firerisks         = FireRisk::all();
    $collectionmodes   = CollectionMode::all();
    $customers         = Customer::all();
    $countries         = Country::all();
    $maritalstatus     = MaritalStatus::all();
    $bondtypes         = BondTypes::all();
    $natureofwork      = NatureofWork::all();
    $natureofaccident  = NatureofAcccident::all();
    $mortagecompanies  = MortgageCompanies::all();
    $propertytypes    = PropertyType::where('category','Risk')->get();
    $propertyitemtypes    = PropertyType::where('category','Item')->get();
    $marinetypes       = MarineRisktypes::all();
    $engineeringrisktypes  = EngineeringRisktypes::all();
    $accidenttypes         = AccidentRiskType::all();
    $liabilitytypes        = LiabilityRiskTypes::all();
    $producttypes          = PolicyProductType::orderby('type','asc')->get();
    $year                  = range( date("Y") , 1990 );
    $healthplans           = HealthPlans::all();
    $lifeplans             = LifePlans::all();
    $policy                = Policy::find($id);
    $business_statuses     = BusinessStatus::all();
    $clausetypes           = PolicyClauses::get();
    $paymentstatus         = PaymentType::get();
    $branches              = Branch::get();
    $policystatus          = PolicyStatus::get();
    $policyratings         = policyrating::all();
    $limitsofmeasures = UnitOfMeasure::all();

    //dd($policy->policy_number);
    $bills  = Bill::where('policy_number',$policy->policy_number)->get();

    
    

    switch($policy->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policy->ref_number)->first() ?: new MotorDetails;
            break;
       
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policy->ref_number)->first() ?: new Accident;
            break;
        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('ref_number','=',$policy->ref_number)->first() ?: new FireDetails;
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('policy_number','=',$policy->policy_number)->first() ?: new BondDetails;
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('ref_number','=',$policy->ref_number)->first() ?: new MarineDetails;
            break;


        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('policy_number','=',$policy->policy_number)->first() ?: new EngineeringDetails;
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('reference_number','=',$policy->ref_number)->first() ?: new LiabilityDetails;
            break;


        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('ref_number','=',$policy->ref_number)->first() ?: new AccidentDetails;
            break;



      }




    return view('policy.edit', compact('policy','policyratings','limitsofmeasures','propertyitemtypes','bills','policystatus','paymentstatus','clausetypes','business_statuses','lifeplans','branches','healthplans','fetchrecord','intermediary','liabilitytypes','accidenttypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','natureofwork','natureofaccident','bondtypes','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);
   
    } 


          public function appendPolicy($id)
    {

    $noclaimdiscount   = NCD::all();
    $fleetdiscount     = FleetDiscount::all();
    $vehiclemodels     = VehicleModel::all();
    $saleschannel      = SalesChannel::all();
    $salestype         = SalesType::all();
    $insurers          = Insurers::orderby('name','asc')->get();
    $policytypes       = PolicyType::all();
    $intermediary      = User::orderby('username','ASC')->get();
    $vehiclemakes      = VehicleMake::all();
    $vehicletypes      = VehicleType::all();
    $vehicleuses       = VehicleUse::distinct()->get(['risk']);
    $beneficiaries     = Beneficiary::all();
    $selectstatus      = SelectStatus::all();
    $roofed            = FireRoofed::all();
    $walled            = FireWalled::all();
    $selectstatus      = SelectStatus::all();
    $currencies        = Currency::all();
    $firerisks         = FireRisk::all();
    $collectionmodes   = CollectionMode::all();
    $customers         = Customer::all();
    $countries         = Country::all();
    $maritalstatus     = MaritalStatus::all();
    $bondtypes         = BondTypes::all();
    $natureofwork      = NatureofWork::all();
    $natureofaccident  = NatureofAcccident::all();
    $mortagecompanies  = MortgageCompanies::all();
    $propertytypes    = PropertyType::where('category','Risk')->get();
    $propertyitemtypes    = PropertyType::where('category','Item')->get();
    $marinetypes       = MarineRisktypes::all();
    $engineeringrisktypes  = EngineeringRisktypes::all();
    $accidenttypes         = AccidentRiskType::all();
    $liabilitytypes        = LiabilityRiskTypes::all();
    $producttypes          = PolicyProductType::orderby('type','asc')->get();
    $year                  = range( date("Y") , 1990 );
    $healthplans           = HealthPlans::all();
    $lifeplans             = LifePlans::all();
    $policy                = Policy::find($id);
    $business_statuses     = BusinessStatus::all();
    $clausetypes           = PolicyClauses::get();
    $paymentstatus         = PaymentType::get();
    $branches              = Branch::get();
    $policystatus          = PolicyStatus::get();
    $policyratings         = policyrating::all();
    $limitsofmeasures = UnitOfMeasure::all();

    //dd($policy->policy_number);
    $bills  = Bill::where('policy_number',$policy->policy_number)->get();

    
    

    switch($policy->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policy->ref_number)->first() ?: new MotorDetails;
            break;
       
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policy->ref_number)->first() ?: new Accident;
            break;
        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('ref_number','=',$policy->ref_number)->first() ?: new FireDetails;
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('policy_number','=',$policy->policy_number)->first() ?: new BondDetails;
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('ref_number','=',$policy->ref_number)->first() ?: new MarineDetails;
            break;


        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('policy_number','=',$policy->policy_number)->first() ?: new EngineeringDetails;
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('ref_number','=',$policy->ref_number)->first() ?: new LiabilityDetails;
            break;


        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('ref_number','=',$policy->ref_number)->first() ?: new AccidentDetails;
            break;



      }




    return view('policy.append', compact('policy','policyratings','limitsofmeasures','propertyitemtypes','bills','policystatus','paymentstatus','clausetypes','business_statuses','lifeplans','branches','healthplans','fetchrecord','intermediary','liabilitytypes','accidenttypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','natureofwork','natureofaccident','bondtypes','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);
   
    } 


          public function doqueryPolicy($id)
    {

    $noclaimdiscount   = NCD::all();
    $fleetdiscount     = FleetDiscount::all();
    $vehiclemodels     = VehicleModel::all();
    $saleschannel      = SalesChannel::all();
    $salestype         = SalesType::all();
    $insurers          = Insurers::orderby('name','asc')->get();
    $policytypes       = PolicyType::all();
    $intermediary      = User::orderby('username','ASC')->get();
    $vehiclemakes      = VehicleMake::all();
    $vehicletypes      = VehicleType::all();
    $vehicleuses       = VehicleUse::distinct()->get(['risk']);
    $beneficiaries     = Beneficiary::all();
    $selectstatus      = SelectStatus::all();
    $roofed            = FireRoofed::all();
    $walled            = FireWalled::all();
    $selectstatus      = SelectStatus::all();
    $currencies        = Currency::all();
    $firerisks         = FireRisk::all();
    $collectionmodes   = CollectionMode::all();
    $customers         = Customer::all();
    $countries         = Country::all();
    $maritalstatus     = MaritalStatus::all();
    $bondtypes         = BondTypes::all();
    $natureofwork      = NatureofWork::all();
    $natureofaccident  = NatureofAcccident::all();
    $mortagecompanies  = MortgageCompanies::all();
    $propertytypes    = PropertyType::where('category','Risk')->get();
    $propertyitemtypes    = PropertyType::where('category','Item')->get();
    $marinetypes       = MarineRisktypes::all();
    $engineeringrisktypes  = EngineeringRisktypes::all();
    $accidenttypes         = AccidentRiskType::all();
    $liabilitytypes        = LiabilityRiskTypes::all();
    $producttypes          = PolicyProductType::orderby('type','asc')->get();
    $year                  = range( date("Y") , 1990 );
    $healthplans           = HealthPlans::all();
    $lifeplans             = LifePlans::all();
    $policy                = Policy::find($id);
    $business_statuses = BusinessStatus::all();
    $clausetypes = PolicyClauses::get();
    $paymentstatus = PaymentType::get();
    $branches = Branch::get();
    $policystatus = PolicyStatus::get();
    $policyratings = policyrating::all();
    $limitsofmeasures = UnitOfMeasure::all();


    //dd($policy->policy_number);
    $bills  = Bill::where('policy_number',$policy->policy_number)->get();

    
    

    switch($policy->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policy->ref_number)->first() ?: new MotorDetails;
            break;
       
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policy->ref_number)->first() ?: new Accident;
            break;
        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('ref_number','=',$policy->ref_number)->first() ?: new FireDetails;
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('policy_number','=',$policy->policy_number)->first() ?: new BondDetails;
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('ref_number','=',$policy->ref_number)->first() ?: new MarineDetails;
            break;


        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('policy_number','=',$policy->policy_number)->first() ?: new EngineeringDetails;
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('policy_number','=',$policy->policy_number)->first() ?: new LiabilityDetails;
            break;


        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('policy_number','=',$policy->policy_number)->first() ?: new AccidentDetails;
            break;



      }


    return view('policy.viewquery', compact('policy','limitsofmeasures','policyratings','propertyitemtypes','bills','policystatus','paymentstatus','clausetypes','business_statuses','lifeplans','branches','healthplans','fetchrecord','intermediary','liabilitytypes','accidenttypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','natureofwork','natureofaccident','bondtypes','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);
   
    } 

    public function Renew($id)
    {

    $noclaimdiscount   = NCD::all();
    $fleetdiscount     = FleetDiscount::all();
    $vehiclemodels     = VehicleModel::all();
    $saleschannel      = SalesChannel::all();
    $salestype         = SalesType::all();
    $insurers          = Insurers::orderby('name','asc')->get();
    $policytypes       = PolicyType::all();
    $intermediary      = User::orderby('username','ASC')->get();
    $vehiclemakes      = VehicleMake::all();
    $vehicletypes      = VehicleType::all();
    $vehicleuses       = VehicleUse::distinct()->get(['risk']);
    $beneficiaries     = Beneficiary::all();
    $selectstatus      = SelectStatus::all();
    $roofed            = FireRoofed::all();
    $walled            = FireWalled::all();
    $selectstatus      = SelectStatus::all();
    $currencies        = Currency::all();
    $firerisks         = FireRisk::all();
    $collectionmodes   = CollectionMode::all();
    $customers         = Customer::all();
    $countries         = Country::all();
    $maritalstatus     = MaritalStatus::all();
    $bondtypes         = BondTypes::all();
    $natureofwork      = NatureofWork::all();
    $natureofaccident  = NatureofAcccident::all();
    $mortagecompanies  = MortgageCompanies::all();
    $propertytypes    = PropertyType::where('category','Risk')->get();
    $propertyitemtypes    = PropertyType::where('category','Item')->get();
    $marinetypes       = MarineRisktypes::all();
    $engineeringrisktypes  = EngineeringRisktypes::all();
    $accidenttypes         = AccidentRiskType::all();
    $liabilitytypes        = LiabilityRiskTypes::all();
    $producttypes          = PolicyProductType::orderby('type','asc')->get();
    $year                  = range( date("Y") , 1990 );
    $healthplans           = HealthPlans::all();
    $lifeplans             = LifePlans::all();
    $policy                = Policy::find($id);
    $business_statuses = BusinessStatus::all();
    $clausetypes = PolicyClauses::get();
    $paymentstatus = PaymentType::get();
    $branches = Branch::get();
    $policystatus = PolicyStatus::get();
    $policyratings = policyrating::all();
    $limitsofmeasures = UnitOfMeasure::all();

    //dd($policy->policy_number);
    $bills  = Bill::where('policy_number',$policy->policy_number)->get();

    
    

    switch($policy->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policy->ref_number)->first() ?: new MotorDetails;
            break;
       
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policy->ref_number)->first() ?: new Accident;
            break;
        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('ref_number','=',$policy->ref_number)->first() ?: new FireDetails;
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('policy_number','=',$policy->policy_number)->first() ?: new BondDetails;
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('ref_number','=',$policy->ref_number)->first() ?: new MarineDetails;
            break;


        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('policy_number','=',$policy->policy_number)->first() ?: new EngineeringDetails;
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('ref_number','=',$policy->ref_number)->first() ?: new LiabilityDetails;
            break;


        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('ref_number','=',$policy->ref_number)->first() ?: new AccidentDetails;
            break;



      }
    //dd($year);
   return view('policy.renew', compact('policy','limitsofmeasures','policyratings','propertyitemtypes','bills','policystatus','paymentstatus','clausetypes','business_statuses','lifeplans','branches','healthplans','fetchrecord','intermediary','liabilitytypes','accidenttypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','natureofwork','natureofaccident','bondtypes','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);
   
    
    } 

    public function computeMotorPremium()
    {


          $vehiclerisk          = Input::get('vehicle_risk');
          $vehicleuse           = Input::get('vehicle_use');
          $vehiclecover         = Input::get('preferedcover');
          $contract               = Input::get('policy_sales_type');

          $buybackexcessstatus  = Input::get('vehicle_buy_back_excess');
          $suminsured           = Input::get('vehicle_value');
          $seatnumber           = Input::get('vehicle_seating_capacity');
          $vehiclebuildyear     = Input::get('vehicle_make_year');
          $vehicletppdl         = Input::get('vehicle_tppdl_value');
          $vehiclevoluntaryexcess = 0;
          $execessbought          =0;
          $vehicelcubiccapacity = Input::get('vehicle_cubic_capacity');
          $ncd_rate             = Input::get('vehicle_ncd');
          $fleet_rate           = Input::get('vehicle_fleet_discount');
          $vehiclecurrency      = Input::get('vehicle_currency');
          $vehicle_buy_back_excess      = Input::get('vehicle_buy_back_excess');


          $commission      = CommissionRate::where('product','Motor Insurance')->where('cover', $vehiclecover)->where('contract',$contract)->first();
          $mycommission = $commission->rate;
          //dd($mycommission);

        $loading = Loadings::where('cover', $vehiclecover)
        ->where('use',$vehicleuse)
        ->where('risk',$vehiclerisk)
        ->get()
        ->first();

          $excess = BuyBackExcess::where('cover',$vehiclecover)
        ->where('use',$vehicleuse)
        ->where('risk',$vehiclerisk)
        ->get()
        ->first();



         
          //loadings
          $cover                = $loading->cover;
          $use                  = $loading->use;
          $risk                 = $loading->risk;
          $basic_premium        = $loading->basic_premium;
          $addition_perils      = $loading->addition_perils;
          $eco_perils           = $loading->eco_perils;
          $emergency_treatment  = $loading->emergency_treatment;
          $pa_benefit           = $loading->pa_benefit;
          $tppdl                = $loading->tppdl;
          $ncd                  = $loading->ncd;
          $nic                  = $loading->nic;
          $nhis                 = $loading->nhis;
          $nrsc                 = $loading->nrsc;
          $rate                 = $loading->rate;
          $tppdl_rate           = $loading->tppdl_rate;
          $seat_limit           = $loading->seat_limit;
          $seat_charge_rate     = $loading->seat_charge;
          $brown_card           = $loading->brown_card;
          $tpi                  = $loading->tpi;
          $tpi_limit            = $loading->tpi_limit;
          $extra_tppdl          = $loading->extra_tppdl;

          $tpicharge            = $loading->tpi_limit * $loading->tpi;
          $tppdlcharge          = $loading->tppdl * $loading->tppdl_rate;


         
        


          //compute Age Charge
          $vehicelyear = Carbon::createFromDate($vehiclebuildyear)->age;
          if($vehicelyear > 10 ) { $vehiceage_charge_rate = 0.07500; } 
          else if($vehicelyear > 5 & $vehicelyear <= 10 ) { $vehiceage_charge_rate = 0.05000; } 
          else { $vehiceage_charge_rate = 0.0; }
          $vehicleyearcharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) * $vehiceage_charge_rate;

           //compute Cubic Capacity Charge
          if($vehicelcubiccapacity > 2000 ) { $cubiccapacity_charge_rate = 0.10000; } 
          else if($vehicelcubiccapacity > 1600 & $vehicelyear <= 2000 ) { $cubiccapacity_charge_rate = 0.05000; } 
          else { $cubiccapacity_charge_rate = 0.0; }
          $vehiclecubiccharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) * $cubiccapacity_charge_rate;

          //compute Driving Experience Charge
          $drivingexperience = 0;

          //Compute Seat charge
          
          $seatchargeamount         = ($seatnumber - $seat_limit) * $seat_charge_rate;

          //Emergency Treatment
          $emergencytreatmentcharge = $emergency_treatment * $seatnumber ;

          //compute Basic premium
          $owndamagebasic = ($suminsured * ($rate / 100)) ;
           $basicpremiumcharge      = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) + $vehiclecubiccharge + $vehicleyearcharge;
          
           $basicpremiumcharge_init = $tpicharge + $tppdlcharge;

            if($buybackexcessstatus=='No')
          {
            $execessbought = 0;
            $excess_charge_rate = 0;
          }

          else if($buybackexcessstatus=='Yes')
          {
          //compute Excess
          $buy_back_yes         = $excess->yes;
          $excess_charge_rate   = $excess->charge;
          $execessbought        = ($owndamagebasic  * ($buy_back_yes/100));
         }
         else
         {
             if($vehiclecover == 'Third Party')
          {
             $execessbought = 0;
          }
         }


           


          //compute extra tppdl
           $extratppdl              = ($vehicletppdl - $tppdl) * $extra_tppdl ;


          //compute voluntary excess
           $voluntaryexcesscharge   = ($vehiclevoluntaryexcess/100) * $basicpremiumcharge ;


           //Compute NCD
           $ncdamount               = $basicpremiumcharge * $ncd_rate;

           //Premium less ncd
           $premium_less_ncd        = $basicpremiumcharge - $ncdamount;

           //Compute Fleet Discount
           $fleetdiscountamount     =  $premium_less_ncd *  ($fleet_rate /100) ;

           //Office Premium 
           $officepremiumcharge     =  $basicpremiumcharge;

           //Premium less ncd and fleet
           $premium_less_ncd_fleet  = $premium_less_ncd - $fleetdiscountamount;

           //Annual Premium Payable
           if($vehiclecover == 'Third Party')
           {
            $payableanually = $premium_less_ncd_fleet + $seatchargeamount + $extratppdl + $drivingexperience + $pa_benefit + $eco_perils + $nic + $nhis + $addition_perils + $brown_card;
           }
           else
           {
           $payableanually  = $premium_less_ncd_fleet + $execessbought +  $drivingexperience + $pa_benefit + $eco_perils + $seatchargeamount + $extratppdl - $voluntaryexcesscharge + $addition_perils + $nic + $nhis +  $nrsc + $brown_card;
           }
           //dd($payableanually);

           $mytpbasic   = $basicpremiumcharge_init;
           $myowndamage = $owndamagebasic;
           $myoffice    = $officepremiumcharge;
           $myncd       = $ncdamount;
           $myfleet     = $fleetdiscountamount;
           $myccage     = $vehiclecubiccharge + $vehicleyearcharge;
           $mygross     = $premium_less_ncd_fleet;
           $myloading   = $execessbought +  $drivingexperience + $seatchargeamount + $pa_benefit + $addition_perils + $eco_perils + $extratppdl - $voluntaryexcesscharge;

           $mycontributions =  $nic + $nhis  + $brown_card;



           $time = explode(" - ", Input::get("insurance_period"));

             $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
             $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

            $date = Carbon::now();
            $year = ($date->isLeapYear() ? 366 : 365);

            $year = $year - 1;
            $days = $dateto->diffInDays($datefrom);

           
            $premium_payable  = $payableanually * $days/$year;


            $added_response = array('Premium'=> $premium_payable,'execessbought'=>$execessbought,'excess_charge_rate'=>$excess_charge_rate,'suminsured'=>$suminsured,'gross_premium'=>$payableanually,'contribution' => $mycontributions , 'loading' => $myloading , 'netpremium' =>$mygross  , 'ncd' => $myncd, 'fleet' => $myfleet , 'ccage' => $myccage , 'commission' =>  $mycommission,'officepremium' => $myoffice, 'tpbasic' => $mytpbasic, 'owndamage' => $myowndamage);
            return  Response::json($added_response);
            //echo $mycommission;

    }



public function recomputeMotorPremium()
    {


          $vehiclerisk          = Input::get('vehicle_risk');
          $vehicleuse           = Input::get('vehicle_use');
          $vehiclecover         = Input::get('preferedcover');
          $contract               = Input::get('policy_sales_type');

          $buybackexcessstatus  = Input::get('vehicle_buy_back_excess');
          $suminsured           = Input::get('vehicle_value');
          $seatnumber           = Input::get('vehicle_seating_capacity');
          $vehiclebuildyear     = Input::get('vehicle_make_year');
          $vehicletppdl         = Input::get('vehicle_tppdl_value');
          $vehiclevoluntaryexcess = 0;
          $execessbought          = 0;
          $vehicelcubiccapacity = Input::get('vehicle_cubic_capacity');
          $ncd_rate             = Input::get('vehicle_ncd');
          $fleet_rate           = Input::get('vehicle_fleet_discount');
          $vehiclecurrency      = Input::get('vehicle_currency');
          $vehicle_buy_back_excess      = Input::get('vehicle_buy_back_excess');


          $ccage_edit           = Input::get('ccage_edit');
          $tpbasic_edit         = Input::get('tpbasic_edit');
          $owndamage_edit       = Input::get('owndamage_edit');

 


          $commission      = CommissionRate::where('product','Motor Insurance')->where('cover', $vehiclecover)->where('contract',$contract)->first();
          $mycommission = $commission->rate;
          //dd($mycommission);

        $loading = Loadings::where('cover', $vehiclecover)
        ->where('use',$vehicleuse)
        ->where('risk',$vehiclerisk)
        ->get()
        ->first();

          $excess = BuyBackExcess::where('cover',$vehiclecover)
        ->where('use',$vehicleuse)
        ->where('risk',$vehiclerisk)
        ->get()
        ->first();



         
          //loadings
          $cover                = $loading->cover;
          $use                  = $loading->use;
          $risk                 = $loading->risk;
          $basic_premium        = $loading->basic_premium;
          $addition_perils      = $loading->addition_perils;
          $eco_perils           = $loading->eco_perils;
          $emergency_treatment  = $loading->emergency_treatment;
          $pa_benefit           = $loading->pa_benefit;
          $tppdl                = $loading->tppdl;
          $ncd                  = $loading->ncd;
          $nic                  = $loading->nic;
          $nhis                 = $loading->nhis;
          $nrsc                 = $loading->nrsc;
          $rate                 = $loading->rate;
          $tppdl_rate           = $loading->tppdl_rate;
          $seat_limit           = $loading->seat_limit;
          $seat_charge_rate     = $loading->seat_charge;
          $brown_card           = $loading->brown_card;
          $tpi                  = $loading->tpi;
          $tpi_limit            = $loading->tpi_limit;
          $extra_tppdl          = $loading->extra_tppdl;

          $tpicharge            = $loading->tpi_limit * $loading->tpi;
          $tppdlcharge          = $loading->tppdl * $loading->tppdl_rate;


         
        


          // //compute Age Charge
          // $vehicelyear = Carbon::createFromDate($vehiclebuildyear)->age;
          // if($vehicelyear > 10 ) { $vehiceage_charge_rate = 0.07500; } 
          // else if($vehicelyear > 5 & $vehicelyear <= 10 ) { $vehiceage_charge_rate = 0.05000; } 
          // else { $vehiceage_charge_rate = 0.0; }
          // $vehicleyearcharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) * $vehiceage_charge_rate;

          //  //compute Cubic Capacity Charge
          // if($vehicelcubiccapacity > 2000 ) { $cubiccapacity_charge_rate = 0.10000; } 
          // else if($vehicelcubiccapacity > 1600 & $vehicelyear <= 2000 ) { $cubiccapacity_charge_rate = 0.05000; } 
          // else { $cubiccapacity_charge_rate = 0.0; }
          // $vehiclecubiccharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) * $cubiccapacity_charge_rate;

          //compute Driving Experience Charge
          $drivingexperience = 0;

          //Compute Seat charge
          
          $seatchargeamount   = ($seatnumber - $seat_limit) * $seat_charge_rate;

          //Emergency Treatment
          $emergencytreatmentcharge = $emergency_treatment * $seatnumber ;

          //compute Basic premium
          $owndamagebasic = $owndamage_edit; //($suminsured * ($rate / 100)) ;
          $basicpremiumcharge  = $tpbasic_edit; //(($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) + $vehiclecubiccharge + $vehicleyearcharge;
          
           $basicpremiumcharge_init = $tpicharge + $tppdlcharge;

            if($buybackexcessstatus=='No')
          {
            $execessbought = 0;
            $excess_charge_rate = 0;
          }

          else if($buybackexcessstatus=='Yes')
          {
          //compute Excess
          $buy_back_yes         = $excess->yes;
          $excess_charge_rate   = $excess->charge;
          $execessbought        = ($owndamagebasic  * ($buy_back_yes/100));
         }
         else
         {
             if($vehiclecover == 'Third Party')
          {
             $execessbought = 0;
          }
         }

          //compute extra tppdl
           $extratppdl              = ($vehicletppdl - $tppdl) * $extra_tppdl ;
          //compute voluntary excess
           $voluntaryexcesscharge   = ($vehiclevoluntaryexcess/100) * $basicpremiumcharge ;
           //Compute NCD
           $ncdamount               = $basicpremiumcharge * $ncd_rate;
           //Premium less ncd
           $premium_less_ncd        = $basicpremiumcharge - $ncdamount;
           //Compute Fleet Discount
           $fleetdiscountamount     =  $premium_less_ncd *  ($fleet_rate /100) ;
           //Office Premium 
           $officepremiumcharge     =  $basicpremiumcharge + $owndamage_edit + $ccage_edit;
           //Premium less ncd and fleet
           $premium_less_ncd_fleet  = $premium_less_ncd - $fleetdiscountamount;
           //Annual Premium Payable
           if($vehiclecover == 'Third Party')
           {
            $payableanually = $premium_less_ncd_fleet + $seatchargeamount + $extratppdl + $drivingexperience + $pa_benefit + $eco_perils + $nic + $nhis + $addition_perils + $brown_card;
           }
           else
           {
           $payableanually  = $premium_less_ncd_fleet + $execessbought +  $drivingexperience + $pa_benefit + $eco_perils + $seatchargeamount + $extratppdl - $voluntaryexcesscharge + $addition_perils + $nic + $nhis +  $nrsc + $brown_card;
           }
           //dd($payableanually);
           $mytpbasic   = $basicpremiumcharge_init;
           $myowndamage = $owndamagebasic;
           $myoffice    = $officepremiumcharge;
           $myncd       = $ncdamount;
           $myfleet     = $fleetdiscountamount;
           $myccage     = $ccage_edit;
           $mygross     = $premium_less_ncd_fleet;
           $myloading   = $execessbought +  $drivingexperience + $seatchargeamount + $pa_benefit + $addition_perils + $eco_perils + $extratppdl - $voluntaryexcesscharge;

           $mycontributions =  $nic + $nhis  + $brown_card;



           $time = explode(" - ", Input::get("insurance_period"));

             $datefrom = Carbon::createFromFormat('d/m/Y', Input::get("commence_date"));
             $dateto    = Carbon::createFromFormat('d/m/Y', Input::get("expiry_date"));

            $date = Carbon::now();
            $year = ($date->isLeapYear() ? 366 : 365);

            $year = $year - 1;
            $days = $dateto->diffInDays($datefrom);

           
            $premium_payable  = $payableanually * $days/$year;


            $added_response = array('Premium'=> $premium_payable,'execessbought'=>$execessbought,'excess_charge_rate'=>$excess_charge_rate,'suminsured'=>$suminsured,'gross_premium'=>$payableanually,'contribution' => $mycontributions , 'loading' => $myloading , 'netpremium' =>$mygross  , 'ncd' => $myncd, 'fleet' => $myfleet , 'ccage' => $myccage , 'commission' =>  $mycommission,'officepremium' => $myoffice, 'tpbasic' => $mytpbasic, 'owndamage' => $myowndamage);
            return  Response::json($added_response);
            //echo $mycommission;

    }



     public function getFirePremium()
    {

            $policy_number = Input::get('policy_number');
            $suminsured = 0;
            $premium    = 0;


            switch(Input::get('policy_product')) 
        {
        
        case 'Fire Insurance':
              $policyvalues = FireDetails::where('policy_number',$policy_number)->get();
              foreach($policyvalues as $rates)
              {
                $suminsured += $rates->item_value;
                $premium    += $rates->premium_payable;
              }
            break;

       case 'Bond Insurance':
             $policyvalues = BondDetails::where('policy_number',$policy_number)->get();
              foreach($policyvalues as $rates)
              {
                $suminsured += $rates->bond_sum_insured;
                $premium    += $rates->premium_due;
              }
            break;

        case 'Marine Insurance':
             $policyvalues = MarineDetails::where('policy_number',$policy_number)->get();
              foreach($policyvalues as $rates)
              {
                $suminsured += $rates->marine_sum_insured;
                $premium    += $rates->premium_due;
              }
            break;


        case 'Engineering Insurance':
             $policyvalues = EngineeringDetails::where('policy_number',$policy_number)->get();
              foreach($policyvalues as $rates)
              {
                $suminsured += $rates->car_contract_sum;
                $premium    += $rates->car_premium_payable;
              }
            break;

        case 'Liability Insurance':
             $policyvalues = LiabilityDetails::where('policy_number',$policy_number)->get();
              foreach($policyvalues as $rates)
              {
                $suminsured += $rates->sum_insured;
                $premium    += $rates->premium_due;
              }
            break;


        case 'General Accident Insurance':
             $policyvalues = AccidentDetails::where('policy_number',$policy_number)->get();
              foreach($policyvalues as $rates)
              {
                $suminsured += $rates->sum_insured;
                $premium    += $rates->premium_due;
              }
            break;



      }



            $added_response = array('myfiresuminsured' => $suminsured,'myfirepremium' => $premium);
            return  Response::json($added_response);
            //echo $mycommission;

    }



    function getNCD($ncd_status,$vehicleuse,$vehiclerisk)
    {
             if ($ncd_status == 'NONE' && $vehicleuse == 'Private') 
            {
                $ncd_rate = (0.250 * 100); 
            }
            else if ($ncd_status == '1st Year' && $vehicleuse == 'Private')
             {
                $ncd_rate =(0.300 * 100);
             }
            else if ($ncd_status == '2nd Year' && $vehicleuse == 'Private') 
            {
                $ncd_rate = (0.350 * 100);
            } 
            else if ($ncd_status == '3rd Year' && $vehicleuse == 'Private') 
            {
                $ncd_rate = (0.450 * 100);
            } 
            else if ($ncd_status == '4th Year' && $vehicleuse == 'Private') 
            {
                $ncd_rate = (0.500 * 100);
            }
            else if ($ncd_status == '5th Year' && $vehicleuse == 'Private') 
            {
                $ncd_rate = (0.500 * 100);
            }
            else if ($ncd_status == 'NONE' && $vehicleuse == 'Commercial') 
            {
                $ncd_rate = (0.15 * 100);
            }
            else if ($ncd_status == '1st Year' && $vehicleuse == 'Commercial') 
            {
                $ncd_rate = (0.200 * 100);
            } 
            else if ($ncd_status == '2nd Year' && $vehicleuse == 'Commercial') 
            {
                $ncd_rate = (0.250 * 100);
            } 
            else if ($ncd_status == '3rd Year and Above' && $vehicleuse == 'Commercial') 
            {
                $ncd_rate = (0.250 * 100);
            } 
             elseif ($vehiclerisk == 'MOTOR CYCLE')
             {
                 $ncd_rate = (0.100 * 100);
             } 
            else $ncd_rate = 0; 

            return $ncd_rate;
    }

    public function computeRenewalPremium()
    {

        $id = Input::get('registration');

        $getvehicle = MotorDetails::where('vehicle_registration_number',$id)->first();

        $vehicleuse             = $getvehicle->vehicle_use;
        $vehiclerisk            = $getvehicle->vehicle_risk;
        $vehiclecover           = $getvehicle->vehicle_cover;
        $buybackexcessstatus    = $getvehicle->vehicle_buy_back_excess;

        $suminsured             = $getvehicle->vehicle_value;
        

        $basic_rate             = 5;
        

        $seatnumber             = $getvehicle->vehicle_seating_capacity;
        $vehiclebuildyear       = $getvehicle->vehicle_make_year;
        $vehicletppdl           = $getvehicle->vehicle_tppdl_value;
        $vehiclevoluntaryexcess = 0;
        
        $vehicelcubiccapacity   = $getvehicle->vehicle_cubic_capacity;
        $ncd_status             = $getvehicle->vehicle_ncd;
        $ncd_rate               = 0;
        $fleet_rate             = $getvehicle->vehicle_fleet_discount;
        $vehiclecurrency        = $getvehicle->vehicle_currency;
        
        //$vehicle_buy_back_excess  = $getvehicle->EXCESS_STATUS;
        //if((`masterfinalquote2`.`RISKTYPE` = 'MOTOR CYCLE'),(0.100 * 100),`masterfinalquote2`.`NCD`
        
           
        //$ncd_rate = $this->getNCD($ncd_status,$vehicleuse,$vehiclerisk);
        

        //dd($ncd_rate);

        $loading = Loadings::where('cover',$vehiclecover )
        ->where('use',$vehicleuse)
        ->where('risk',$vehiclerisk)
        ->get()
        ->first();

          $excess = BuyBackExcess::where('cover', $vehiclecover)
        ->where('use',$vehicleuse)
        ->where('risk',$vehiclerisk)
        ->get()
        ->first();

         if($vehiclecover == 'Third party')
          {
             $execessbought = 0;
          }
          else if($buybackexcessstatus=='Excess Is Applicable')
          {
            $execessbought = 0;
          }

          else
          {
          //compute Excess
          $buy_back_yes         = $excess->yes;
          $excess_charge_rate   = $excess->charge;
          $execessbought        = (($suminsured * ($basic_rate / 100)) * ($buy_back_yes/100));
        }

          //dd($execessbought);


            

         
          //loadings
          $cover                = $loading->cover;
          $use                  = $loading->use;
          $risk                 = $loading->risk;
          $basic_premium        = $loading->basic_premium;
          $addition_perils      = $loading->addition_perils;
          $eco_perils           = $loading->eco_perils;
          $emergency_treatment  = $loading->emergency_treatment;
          $pa_benefit           = $loading->pa_benefit;
          $tppdl                = $loading->tppdl;
          $ncd                  = $loading->ncd;
          $nic                  = $loading->nic;
          $nhis                 = $loading->nhis;
          $nrsc                 = $loading->nrsc;
          $rate                 = $loading->rate;
          $tppdl_rate           = $loading->tppdl_rate;
          $seat_limit           = $loading->seat_limit;
          $seat_charge_rate     = $loading->seat_charge;
          $brown_card           = $loading->brown_card;
          $tpi                  = $loading->tpi;
          $tpi_limit            = $loading->tpi_limit;
          $extra_tppdl          = $loading->extra_tppdl;

          $tpicharge            = $loading->tpi_limit * $loading->tpi;
          $tppdlcharge          = $loading->tppdl * $loading->tppdl_rate;



     


          //compute Age Charge
          $vehicelyear = Carbon::createFromDate($vehiclebuildyear)->age;
          if($vehicelyear > 10 ) { $vehiceage_charge_rate = 0.07500; } 
          else if($vehicelyear > 5 & $vehicelyear <= 10 ) { $vehiceage_charge_rate = 0.05000; } 
          else { $vehiceage_charge_rate = 0.0; }
          $vehicleyearcharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) * $vehiceage_charge_rate;

           //compute Cubic Capacity Charge
          if($vehicelcubiccapacity > 2000 ) { $cubiccapacity_charge_rate = 0.10000; } 
          else if($vehicelcubiccapacity > 1600 & $vehicelyear <= 2000 ) { $cubiccapacity_charge_rate = 0.05000; } 
          else { $cubiccapacity_charge_rate = 0.0; }
          $vehiclecubiccharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) * $cubiccapacity_charge_rate;

          //compute Driving Experience Charge
          $drivingexperience = 0;

          $ccageload = $vehiclecubiccharge + $vehicleyearcharge;
          //Compute Seat charge
          
          $seatchargeamount = ($seatnumber - $seat_limit) * $seat_charge_rate;

          //Emergency Treatment
          $emergencytreatmentcharge = $emergency_treatment * $seatnumber ;

          //compute Basic premium
           $basicpremiumcharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) + $vehiclecubiccharge + $vehicleyearcharge;
           $basicpremiumcharge_init = $tpicharge + $tppdlcharge;


          //compute extra tppdl
           $extratppdl = ($vehicletppdl - $tppdl) * $extra_tppdl ;


          //compute voluntary excess
           $voluntaryexcesscharge = ($vehiclevoluntaryexcess/100) * $basicpremiumcharge ;


           //Compute NCD
           $ncdamount = $basicpremiumcharge * $ncd_rate/100;

           //Premium less ncd
           $premium_less_ncd = $basicpremiumcharge - $ncdamount;

           //Compute Fleet Discount
           $fleetdiscountamount =  $premium_less_ncd *  ($fleet_rate /100) ;

           //Office Premium 
           $officepremiumcharge =  $basicpremiumcharge;

           //Premium less ncd and fleet
           $premium_less_ncd_fleet = $premium_less_ncd - $fleetdiscountamount;

           //dd($premium_less_ncd_fleet);

           //Annual Premium Payable
           if($vehiclecover == 'Third party')
           {
            $payableanually = ($premium_less_ncd - $fleetdiscountamount)  + $seatchargeamount + $extratppdl + $drivingexperience + $pa_benefit + $eco_perils + $nic + $nhis + $addition_perils + $brown_card;
           }


           else
           {
            $payableanually = (($premium_less_ncd - $fleetdiscountamount) +  $execessbought + $drivingexperience + $pa_benefit +  $eco_perils +  $seatchargeamount  + 0 - 0 + $addition_perils + $nic +$nhis + $nrsc + $brown_card);
           //$payableanually = $premium_less_ncd_fleet + $execessbought +  $drivingexperience + $pa_benefit + $eco_perils + $seatchargeamount + $extratppdl - $voluntaryexcesscharge + $addition_perils + $nic + $nhis +  $nrsc + $brown_card;
           
           }
           //dd($payableanually);
            $added_response = array('Premium'=>$payableanually);
            return  Response::json($added_response);

    }




    public function processestreaty_facbulk()
    {

     //  Bill::get(); 

       Bill::where('sum_insured','>=',40000)->chunk(200, function ($transactions)
    { 
        
   
       //dd($transactions);
        foreach ($transactions as $bill) 
      {
      
        $transaction = Bill::where('id',$bill->id)->first(); 


        $suminsured = $transaction->sum_insured;
        $premium = $transaction->amount;
        $year = $transaction->insurance_period_from->format('Y');
        $policy_product = $transaction->policy_product; 
        $phicrate = 0;
        $commissionrate = 30;
        $transactionid  = 'RE'.uniqid(20);


        //dd($year);
        $arrangements = ProportionalArrangement::where('year',$year)->where('product_type',$policy_product)->first();


        //dd($arrangement);

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

                $facbusiness = new TreatyBordeux;
                $facbusiness->policy_number     =  $transaction->policy_number;
                $facbusiness->business_class    =  $transaction->policy_product;
                $facbusiness->fullname          =  $transaction->fullname;
                $facbusiness->cover_type        =  $transaction->cover_type;
                $facbusiness->currency          =  $transaction->currency; 
                $facbusiness->period_from       =  $transaction->insurance_period_from;
                $facbusiness->period_to         =  $transaction->insurance_period_to;
                $facbusiness->item_id           =  $transaction->reg_number;
                $facbusiness->exchange_rate     =  $transaction->exchange_rate;
                $facbusiness->premium_type      =  $transaction->transaction_type;
                $facbusiness->document_number   =  $transaction->invoice_number;

                $facbusiness->rate              = $transaction->exchange_rate;
                $facbusiness->sum_insured       = $suminsured;
                $facbusiness->company_retention = $retention;
                $facbusiness->first_surplus     = $surplus1value;
                $facbusiness->second_surplus    = $surplus2value;
                $facbusiness->company_offer     = $offer;
                $facbusiness->company_share     = $PHIC;
                $facbusiness->facultaive_offer  = $facultative;
                $facbusiness->reinsurer_broker  = '';
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
                $facbusiness->legal_cession             = $transaction->reference_number;
                $facbusiness->status                    = 'Pending to be Ceded';
                $facbusiness->save();

     
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
          sleep(2);

           });
    }

    public function processestreaty_fac($reference_number)
    {



        $transaction = Bill::where('reference_number',$reference_number)->first(); 



        $suminsured = $transaction->sum_insured;
        $premium = $transaction->amount;
        $year = $transaction->insurance_period_from->year;
        $policy_product = $transaction->policy_product; 
        $phicrate = 0;
        $commissionrate = 30;
        $transactionid    = 'RE'.uniqid(20);



        $arrangements = ProportionalArrangement::where('year',$year)->where('product_type',$policy_product)->first();

        //dd($suminsured);

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
                $facbusiness->business_class    =  $transaction->policy_product;
                $facbusiness->fullname          =  $transaction->fullname;
                $facbusiness->cover_type        =  $transaction->cover_type;
                $facbusiness->currency          =  $transaction->currency; 
                $facbusiness->period_from       =  $transaction->insurance_period_from;
                $facbusiness->period_to         =  $transaction->insurance_period_to;
                $facbusiness->item_id           =  $transaction->reg_number;
                $facbusiness->exchange_rate     =  $transaction->exchange_rate;
                $facbusiness->premium_type      =  $transaction->transaction_type;
                $facbusiness->document_number   =  $transaction->invoice_number;

                $facbusiness->rate              = $transaction->exchange_rate;
                $facbusiness->sum_insured       = $suminsured;
                $facbusiness->company_retention = $retention;
                $facbusiness->first_surplus     = $surplus1value;
                $facbusiness->second_surplus    = $surplus2value;
                $facbusiness->company_offer     = $offer;
                $facbusiness->company_share     = $PHIC;
                $facbusiness->facultaive_offer  = $facultative;
                $facbusiness->reinsurer_broker  = '';
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
                $facbusiness->legal_cession             = $transaction->reference_number;
                $facbusiness->status                    = 'Pending to be Ceded';
                $facbusiness->save();

     
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

    public function createPolicy(Request $request)
    {
          
        $policynumberval  = $request->input('policy_number');
        
        $invoicenumberval = $this->generateInoviceNumber(10);
        $transactionid    = uniqid(20);

        $account = Customer::where('account_number',$request->input('customer_number'))->first();

        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
        $amountinwords =  $currencyTransformer->toWords($request->input('gross_premium')*100, $request->input('policy_currency'));


        //dd($request->input('policy_interest'));

        if($request->input('policy_clause')){$policy_clause = implode(", ", $request->input('policy_clause'));} else {$policy_clause = null;}
        if($request->input('policy_interest')){$policy_interest =  implode(", ", $request->input('policy_interest'));} else {$policy_interest = null;}

        if($request->input('policy_product')=='Motor Insurance')
        {

         $v = Validator::make($request->all(), [
        'vehicle_registration_number' => 'required|unique:motor_details_new|max:100|min:5'
        ]);
        
        $policy_number    = $this->generatePolicyNumber($request->input('policy_product'),'Individual');
        $time = explode(" - ", $request->input('insurance_period'));

        
        //Policy Details
        $policy                         = new Policy;
        $policy->account_number         = $request->input('customer_number');
        $policy->fullname               = $request->input('fullname');  
        $policy->policy_number          = $policy_number;
        $policy->itemid                 = strtoupper($request->input('vehicle_registration_number')); 
        $policy->policy_product         = $request->input('policy_product'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('transaction_date'));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('acceptance_date'));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', $request->input('issue_date'));
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = $request->input('policy_currency');
        $policy->policy_status          = $request->input('policy_status');
        $policy->policy_branch          = $request->input('policy_branch');
        $policy->agency                 = $request->input('agency');
        $policy->coverage               = $request->input('preferedcover');
        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;
        $policy->policy_upper_text      =  $request->input('policy_upper_text');
        $policy->policy_lower_text      =  $request->input('policy_lower_text');
        $policy->policy_end_text        =  $request->input('policy_end_text');
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Motor Details
        $motor                              = new MotorDetails;
        $motor->policy_number               = $policy_number;
        $motor->vehicle_cover               = $request->input('preferedcover');  
        $motor->vehicle_currency            = $request->input('vehicle_currency');
        $motor->vehicle_value               = $request->input('vehicle_value');
        $motor->vehicle_buy_back_excess     = $request->input('vehicle_buy_back_excess'); 
        $motor->vehicle_tppdl_standard      = $request->input('vehicle_tppdl_standard'); 
        $motor->vehicle_tppdl_value         = $request->input('vehicle_tppdl_value');
        $motor->vehicle_body_type           = $request->input('vehicle_body_type');
        $motor->vehicle_model               = $request->input('vehicle_model');
        $motor->vehicle_make                = $request->input('vehicle_make');
        $motor->vehicle_use                 = $request->input('vehicle_use');
        $motor->vehicle_make_year           = $request->input('vehicle_make_year');
        $motor->vehicle_seating_capacity    = $request->input('vehicle_seating_capacity');
        $motor->vehicle_cubic_capacity      = $request->input('vehicle_cubic_capacity');
        $motor->vehicle_registration_number = strtoupper($request->input('vehicle_registration_number')); 
        $motor->vehicle_chassis_number      = $request->input('vehicle_chassis_number');
        $motor->vehicle_engine_number       = $request->input('vehicle_engine_number');
        $motor->vehicle_interest_status     = $request->input('vehicle_interest_status');
        $motor->vehicle_interest_name       = $request->input('vehicle_interest_name');
        $motor->ref_number                  = $transactionid;
        $motor->vehicle_risk                = $request->input('vehicle_risk');
        $motor->vehicle_ncd                 = $request->input('vehicle_ncd');
        $motor->vehicle_fleet_discount      = $request->input('vehicle_fleet_discount');
        $motor->created_by                  = Auth::user()->getNameOrUsername();
        $motor->created_on                  = Carbon::now();
        $motor->agency_code                 = $request->input('agency');
        $motor->vehicle_premium_charged     = $request->input('gross_premium');
        $motor->vehicle_currency            = $request->input('policy_currency');
        $motor->period_from                 = $this->change_date_format($time[0]);
        $motor->period_to                   = $this->change_date_format($time[1]);
        $motor->vehicle_colour              = $request->input('vehicle_colour');
        $motor->vehicle_register_date       = $request->input('vehicle_register_date');
        $motor->vehicle_tonnage_capacity    = $request->input('vehicle_tonnage_capacity');
        $motor->vehicle_mileage_number      = $request->input('vehicle_mileage_number');
        $motor->vehicle_trailer_number      = $request->input('vehicle_trailer_number');
        $motor->base_premium                = $request->input('tpbasic');
        $motor->own_damage_premium          = $request->input('owndamage');
        $motor->cc_age                      = $request->input('ccage');
        $motor->office_premium              = $request->input('officepremium');
        $motor->ncd_charge                  = $request->input('ncd');
        $motor->fleet_charge                = $request->input('fleet');
        $motor->loading_applied             = $request->input('loading');
        $motor->contributions               = $request->input('contribution');
        $motor->netpremium                  = $request->input('netpremium');


        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->fullname                     = $request->input('fullname'); 
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = $request->input('policy_sales_type');
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = $request->input('policy_sales_channel');
        $bill->branch                       = $request->input('policy_branch');
        $bill->policy_number                = $request->input('policy_number');
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('policy_currency');
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->insurance_period_from        = $this->change_date_format($time[0]);
        $bill->insurance_period_to          = $this->change_date_format($time[1]);
        $bill->sum_insured                  = $request->input('vehicle_value');
        $bill->cover_type                   = $request->input('preferedcover');  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = strtoupper($request->input('vehicle_registration_number'));
        $bill->agency                       = $request->input('agency');
        $bill->amount_in_words              = $amountinwords;
        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($motor->save())  
                                { 


                                    if($bill->save())
                                    {    

                                    $this->processestreaty_fac($transactionid);             
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policy_number.' - '.$request->input('billed_to').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);
                                
                                    return redirect()
                                    ->route('view-policy',$policy_number)
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Invoice failed to create!');
                                      }


                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Motor details failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy details failed to create!');
          }
      }

  //Fire Policy
   
 if($request->input('policy_product')=='Fire Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        if($request->input('policy_clause')){$policy_clause = implode(", ", $request->input('policy_clause'));} else {$policy_clause = null;}
        if($request->input('policy_interest')){$policy_interest =  implode(", ", $request->input('policy_interest'));} else {$policy_interest = null;}

         $policy_number    = $request->input('policy_number');
        //Policy Details
       $policy                         = new Policy;
        $policy->account_number         = $request->input('customer_number'); 
        $policy->fullname               = $request->input('fullname');   
        $policy->policy_number          = $request->input('policy_number');
        $policy->itemid                 = $transactionid; 
        $policy->policy_product         = $request->input('policy_product'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('transaction_date'));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('acceptance_date'));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', $request->input('issue_date'));


        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');

        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = $request->input('policy_currency');
        $policy->policy_status          = $request->input('policy_status');
        $policy->policy_branch          = $request->input('policy_branch');
        $policy->agency                 = $request->input('agency');
        $policy->coverage               = $request->input('fire_risk_covered');
        
        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;

        $policy->policy_upper_text      =  $request->input('policy_upper_text');
        $policy->policy_lower_text      =  $request->input('policy_lower_text');
        $policy->policy_end_text        =  $request->input('policy_end_text');

        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->fullname                     = $request->input('fullname');  
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = $request->input('policy_sales_type');
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = $request->input('policy_sales_channel');
        $bill->branch                       = $request->input('policy_branch');
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('policy_currency');
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status                       = 'Unpaid';   
        $bill->insurance_period_from      = $this->change_date_format($time[0]);
        $bill->insurance_period_to        = $this->change_date_format($time[1]);
        $bill->sum_insured               = $request->input('fire_building_cost');

        $bill->cover_type                   = $request->input('fire_risk_covered');  
        $bill->policy_number                = $request->input('policy_number');
        $bill->reg_number                   = $request->input('building_number');
        $bill->agency                       = $request->input('agency');
        $bill->amount_in_words              = $amountinwords;

        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            

                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);
                                
                                    return redirect()
                                     ->route('view-policy',$policy_number)
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }

    
//Marine Insurance

if($request->input('policy_product')=='Marine Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        if($request->input('policy_clause')){$policy_clause = implode(", ", $request->input('policy_clause'));} else {$policy_clause = null;}
        if($request->input('policy_interest')){$policy_interest =  implode(", ", $request->input('policy_interest'));} else {$policy_interest = null;}

        $policy_number = $request->input('policy_number');
        //Policy Details
       $policy                         = new Policy;
        $policy->account_number         = $request->input('customer_number');  
        $policy->fullname               = $request->input('fullname');  
        $policy->policy_number          = $request->input('policy_number');
        $policy->itemid                 = $request->input('marine_vessel'); 
        $policy->policy_product         = $request->input('policy_product'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('transaction_date'));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('acceptance_date'));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', $request->input('issue_date'));
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = $request->input('policy_currency');
        $policy->policy_status          = $request->input('policy_status');
        $policy->policy_branch          = $request->input('policy_branch');
        $policy->agency                 = $request->input('agency');

        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;

        $policy->policy_upper_text      =  $request->input('policy_upper_text');
        $policy->policy_lower_text      =  $request->input('policy_lower_text');
        $policy->policy_end_text        =  $request->input('policy_end_text');
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


       
        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->fullname                     = $request->input('fullname');  
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = $request->input('policy_sales_type');
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = $request->input('policy_sales_channel');
        $bill->branch                       = $request->input('policy_branch');
        $bill->policy_number                = $request->input('policy_number');
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('policy_currency');
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->insurance_period_from        = $this->change_date_format($time[0]);
        $bill->insurance_period_to          = $this->change_date_format($time[1]);
        $bill->sum_insured                  = $request->input('marine_sum_insured');

        $bill->cover_type                   = $request->input('marine_risk_type');  
        $bill->policy_number                = $request->input('policy_number'); 
        $bill->reg_number                   = $request->input('marine_vessel');
        $bill->agency                       = $request->input('agency');
        $bill->amount_in_words              = $amountinwords;

        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();





         if($policy->save())
          {


                        

                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);
                                
                                    return redirect()
                                     ->route('view-policy',$policy_number)
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }

          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }


      //Engineering Insurance

      if($request->input('policy_product')=='Engineering Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        if($request->input('policy_clause')){$policy_clause = implode(", ", $request->input('policy_clause'));} else {$policy_clause = null;}
        if($request->input('policy_interest')){$policy_interest =  implode(", ", $request->input('policy_interest'));} else {$policy_interest = null;}

       $policy_number    = $request->input('policy_number');
        //Policy Details
       $policy                         = new Policy;
        $policy->account_number         = $request->input('customer_number');  
        $policy->fullname               = $request->input('fullname');  
        $policy->policy_number          = $policy_number;
        $policy->itemid                 = $transactionid; 
        $policy->policy_product         = $request->input('policy_product'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('transaction_date'));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('acceptance_date'));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', $request->input('issue_date'));
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = $request->input('policy_currency');
        $policy->policy_status          = $request->input('policy_status');
        $policy->policy_branch          = $request->input('policy_branch');
        $policy->agency                 = $request->input('agency');
        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;
        $policy->policy_upper_text      =  $request->input('policy_upper_text');
        $policy->policy_lower_text      =  $request->input('policy_lower_text');
        $policy->policy_end_text        =  $request->input('policy_end_text');
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->fullname                     = $request->input('fullname');  
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = $request->input('policy_sales_type');
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = $request->input('policy_sales_channel');
        $bill->branch                       = $request->input('policy_branch');
        $bill->policy_number                = $request->input('policy_number');
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('policy_currency');
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->insurance_period_from        = $this->change_date_format($time[0]);
        $bill->insurance_period_to          = $this->change_date_format($time[1]);
        $bill->sum_insured                  = $request->input('car_contract_sum');

        $bill->cover_type                   = $request->input('car_risk_type');  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = $transactionid;
        $bill->agency                       = $request->input('agency');
        $bill->amount_in_words              = $amountinwords;

        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();


         if($policy->save())
          {


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);

                                    return redirect()
                                     ->route('view-policy',$policy_number)
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }

          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }


        if($request->input('policy_product')=='Liability Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        if($request->input('policy_clause')){$policy_clause = implode(", ", $request->input('policy_clause'));} else {$policy_clause = null;}
        if($request->input('policy_interest')){$policy_interest =  implode(", ", $request->input('policy_interest'));} else {$policy_interest = null;}

        $policy_number    = $this->generatePolicyNumber($request->input('policy_product'),$request->input('liability_risk_type'));
        //Policy Details
       $policy                         = new Policy;
        $policy->account_number         = $request->input('customer_number');  
        $policy->fullname               = $request->input('fullname');  
        $policy->policy_number          = $policy_number;
        $policy->itemid                 = $transactionid; 
        $policy->policy_product         = $request->input('policy_product'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('transaction_date'));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('acceptance_date'));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', $request->input('issue_date'));
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = $request->input('policy_currency');
        $policy->policy_status          = $request->input('policy_status');
        $policy->policy_branch          = $request->input('policy_branch');
        $policy->agency                = $request->input('agency');

        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;

        $policy->policy_upper_text      =  $request->input('policy_upper_text');
        $policy->policy_lower_text      =  $request->input('policy_lower_text');
        $policy->policy_end_text        =  $request->input('policy_end_text');


        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Fire Details
        $liability                                   = new LiabilityDetails;
        $liability->liability_risk_type              = $request->input('liability_risk_type');  
        $liability->liability_schedule               = $request->input('liability_schedule');
        $liability->liability_beneficiary            = $request->input('liability_beneficiary');
        $liability->liability_si                     = $request->input('liability_si');
        $liability->created_on                       = Carbon::now();
        $liability->created_by                       = Auth::user()->getNameOrUsername();
        $liability->ref_number                       = $transactionid;

        //Invoice Generation

        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->fullname               = $request->input('fullname');  
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = $request->input('policy_sales_type');
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = $request->input('policy_sales_channel');
        $bill->branch                       = $request->input('policy_branch');
        $bill->policy_number                = $request->input('policy_number');
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('policy_currency');
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->insurance_period_from        = $this->change_date_format($time[0]);
        $bill->insurance_period_to          = $this->change_date_format($time[1]);
        $bill->sum_insured                  = $request->input('liability_si');

        $bill->cover_type                   = $request->input('liability_risk_type');  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = $transactionid;
        $bill->agency                       = $request->input('agency');
        $bill->amount_in_words              = $amountinwords;

        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();




         if($policy->save())
          {


                            if($liability->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);

                                    return redirect()
                                    ->route('view-policy',$policy_number)
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }









//Bond Insurance

if($request->input('policy_product')=='Bond Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        if($request->input('policy_clause')){$policy_clause = implode(", ", $request->input('policy_clause'));} else {$policy_clause = null;}
        if($request->input('policy_interest')){$policy_interest =  implode(", ", $request->input('policy_interest'));} else {$policy_interest = null;}

        $policy_number    = $policy_number    = $request->input('policy_number');
        //Policy Details
       $policy                         = new Policy;
        $policy->account_number         = $request->input('customer_number');
        $policy->fullname               = $request->input('fullname');    
        $policy->policy_number          = $policy_number;
        $policy->itemid                 = $transactionid; 
        $policy->policy_product         = $request->input('policy_product'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('transaction_date'));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('acceptance_date'));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', $request->input('issue_date'));
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = $request->input('policy_currency');
        $policy->policy_status          = $request->input('policy_status');
        $policy->policy_branch          = $request->input('policy_branch');
        $policy->agency                 = $request->input('agency');
        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;
        $policy->policy_upper_text      =  $request->input('policy_upper_text');
        $policy->policy_lower_text      =  $request->input('policy_lower_text');
        $policy->policy_end_text        =  $request->input('policy_end_text');
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();




   
         $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->fullname               = $request->input('fullname');  
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = $request->input('policy_sales_type');
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = $request->input('policy_sales_channel');
        $bill->branch                       = $request->input('policy_branch');
        $bill->policy_number                = $request->input('policy_number');
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('policy_currency');
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->insurance_period_from        = $this->change_date_format($time[0]);
        $bill->insurance_period_to          = $this->change_date_format($time[1]);
        $bill->sum_insured                  = $request->input('bond_sum_insured');

        $bill->cover_type                   = $request->input('bond_risk_type');  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = $transactionid;
        $bill->agency                       = $request->input('agency');
        $bill->amount_in_words              = $amountinwords;

        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            
                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);


                                   
                                    return redirect()
                                    ->route('view-policy',$policy_number)
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }

          }

          else
          {


             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }
    

//General Accident
if($request->input('policy_product')=='General Accident Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));


            if($request->input('policy_clause')){$policy_clause = implode(", ", $request->input('policy_clause'));} else {$policy_clause = null;}
        if($request->input('policy_interest')){$policy_interest =  implode(", ", $request->input('policy_interest'));} else {$policy_interest = null;}

             $policy_number    = $request->input('policy_number');
        //Policy Details
       $policy                          = new Policy;
        $policy->account_number         = $request->input('customer_number');  
        $policy->fullname               = $request->input('fullname');  
        $policy->policy_number          = $policy_number;
        $policy->itemid                 = $transactionid; 
        $policy->policy_product         = $request->input('policy_product'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->transaction_date       = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('transaction_date'));
        $policy->acceptance_date        = Carbon::createFromFormat('d/m/Y H:i:s', $request->input('acceptance_date'));
        $policy->first_issue_date       = Carbon::createFromFormat('d/m/Y', $request->input('issue_date'));
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = $request->input('policy_currency');
        $policy->policy_status          = $request->input('policy_status');
        $policy->policy_branch          = $request->input('policy_branch');
        $policy->agency                = $request->input('agency');
        $policy->policy_clause          = $policy_clause;
        $policy->policy_interest        = $policy_interest;
        $policy->policy_upper_text      =  $request->input('policy_upper_text');
        $policy->policy_lower_text      =  $request->input('policy_lower_text');
        $policy->policy_end_text        =  $request->input('policy_end_text');
        $policy->approved_by            = 'N/A';
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->fullname               = $request->input('fullname');  
        $bill->type                         = 'Debit'; 
        $bill->invoice_date                 = Carbon::now();
        $bill->invoice_source               = $request->input('policy_sales_type');
        $bill->transaction_type             = 'First Premium';
        $bill->campaign                     = $request->input('policy_sales_channel');
        $bill->branch                       = $request->input('policy_branch');
        $bill->policy_number                = $request->input('policy_number');
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('policy_currency');
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->reference_number             = $transactionid; 
        $bill->payment_status               = 'Unpaid';   
        $bill->insurance_period_from        = $this->change_date_format($time[0]);
        $bill->insurance_period_to          = $this->change_date_format($time[1]);
        $bill->sum_insured                  = $request->input('general_accident_sum_insured');
        $bill->cover_type                   = $request->input('accident_risk_type');  
        $bill->policy_number                = $policy_number; 
        $bill->reg_number                   = $transactionid;
        $bill->agency                       = $request->input('agency');
        $bill->amount_in_words              = $amountinwords;

        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();


         if($policy->save())
          {

                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);
                                
                                    return redirect()
                                    ->route('view-policy',$policy_number)
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }

          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }





      if($request->input('policy_product')=='Personal Accident Insurance')

        {
        
        $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $request->input('policy_number');
        $policy->ref_number             = $transactionid;
        $policy->policy_currency        = $request->input('policy_currency');
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //PA Details
        $accident                                   = new Accident;
        $accident->pa_sum_insured                   = $request->input('pa_sum_insured');  
        $accident->pa_height                        = $request->input('pa_height');
        $accident->pa_weight                        = $request->input('pa_weight');
        $accident->marital_status                   = $request->input('marital_status'); 
        $accident->nature_of_work                   = $request->input('nature_of_work'); 
        $accident->pa_accident_received             = $request->input('pa_accident_received');
        $accident->pa_nature_of_accident            = $request->input('pa_nature_of_accident');
        $accident->accident_duration                = $request->input('accident_duration');
        $accident->accident_period                  = $request->input('accident_period');
        $accident->pa_activities                    = $request->input('pa_activities');
        $accident->pa_special_term_status           = $request->input('pa_special_term_status');
        $accident->pa_cancelled_insurance_status    = $request->input('pa_cancelled_insurance_status');
        $accident->pa_increased_premium_status      = $request->input('pa_increased_premium_status');
        $accident->pa_benefit_details               = $request->input('pa_benefit_details');
        $accident->ref_number                       = $transactionid; 

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $request->input('policy_number');
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('policy_currency');
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->reference_number             = $transactionid; 
        $bill->status                       = 'Unpaid';   
        $bill->paid_amount                  = 0; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();


         if($policy->save())
          {


                            if($accident->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);


                                
                                    return redirect()
                                    ->route('view-policy',$policy_number)
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }

      else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }

    
}




public function updatePolicy(Request $request)
{

             
       //dd(Input::get('detailid'));

        if($request->input('policy_product')=='Motor Insurance')
        {
        

        $time = explode(" - ", $request->input('insurance_period'));


         $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = MotorDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'preferedcover'              =>  $request->input('preferedcover'),
                           'vehicle_currency'           =>  $request->input('vehicle_currency'),
                           'vehicle_value'              =>  $request->input('vehicle_value'),
                           'vehicle_buy_back_excess'    =>  $request->input('vehicle_buy_back_excess'),
                           'vehicle_tppdl_standard'     =>  $request->input('vehicle_tppdl_standard'),
                           'vehicle_tppdl_value'        =>  $request->input('vehicle_tppdl_value'),
                           'vehicle_body_type'          =>  $request->input('vehicle_body_type'),
                           'vehicle_model'              =>  $request->input('vehicle_model'),
                           'vehicle_make'               =>  $request->input('vehicle_make'),
                           'vehicle_use'                =>  $request->input('vehicle_use'),
                           'vehicle_make_year'          =>  $request->input('vehicle_make_year'),
                           'vehicle_seating_capacity'   =>  $request->input('vehicle_seating_capacity'),
                           'vehicle_cubic_capacity'     =>  $request->input('vehicle_cubic_capacity'),
                           'vehicle_registration_number' =>  $request->input('vehicle_registration_number'),
                           'vehicle_chassis_number'     =>  $request->input('vehicle_chassis_number'),
                           'vehicle_interest_status'    =>  $request->input('vehicle_interest_status'),
                           'vehicle_interest_name'      =>  $request->input('vehicle_interest_name'),

                           'vehicle_declined_status'    =>  $request->input('vehicle_declined_status'),
                           'vehicle_declined_reason'    =>  $request->input('vehicle_declined_reason'),
                           'vehicle_cancelled_status'   =>  $request->input('vehicle_cancelled_status'),
                           'vehicle_cancelled_reason'   =>  $request->input('vehicle_cancelled_reason'),

                           'vehicle_risk'               =>  $request->input('vehicle_risk'),
                           'vehicle_ncd'                =>  $request->input('vehicle_ncd'),
                           'vehicle_fleet_discount'     =>  $request->input('vehicle_fleet_discount')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
        
        

      
        }

  //Fire Policy
   
 if($request->input('policy_product')=='Fire Insurance')
        {
   
             $time = explode(" - ", $request->input('insurance_period'));


         $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = FireDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'fire_risk_covered'              =>  $request->input('fire_risk_covered'),
                           'fire_building_cost'             =>  $request->input('fire_building_cost'),
                           'fire_deductible'                =>  $request->input('fire_deductible'),
                           'fire_personal_property_coverage'=>  $request->input('fire_personal_property_coverage'),
                           'fire_temporary_rental_cost'     =>  $request->input('fire_temporary_rental_cost'),
                           'fire_building_address'          =>  $request->input('fire_building_address'),
                           'fire_property_type'             =>  $request->input('fire_property_type'),
                           'walled_with'                    =>  $request->input('walled_with'),
                           'roofed_with'                    =>  $request->input('roofed_with'),
                           'fire_mortgage_status'           =>  $request->input('fire_mortgage_status'),
                           'fire_mortgage_company'          =>  $request->input('fire_mortgage_company'),
                           'property_content'               =>  $request->input('property_content')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }   

      }
    
//Marine Insurance

if($request->input('policy_product')=='Marine Insurance')
        {
    


         $time = explode(" - ", $request->input('insurance_period'));
         $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = FireDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'marine_risk_type'           =>  $request->input('marine_risk_type'),
                           'marine_sum_insured'         =>  $request->input('marine_sum_insured'),
                           'marine_bill_landing'        =>  $request->input('marine_bill_landing'),
                           'marine_interest'            =>  $request->input('marine_interest'),
                           'marine_vessel'              =>  $request->input('marine_vessel'),
                           'marine_insurance_condition' =>  $request->input('marine_insurance_condition'),
                           'marine_valuation'           =>  $request->input('marine_valuation'),
                           'marine_means_of_conveyance' =>  $request->input('marine_means_of_conveyance'),
                           'marine_voyage'              =>  $request->input('marine_voyage'),
                           'marine_condition'           =>  $request->input('marine_condition')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }   

   
      }


      //Engineering Insurance

if($request->input('policy_product')=='Engineering Insurance')
{
        
       
         $time = explode(" - ", $request->input('insurance_period'));
         $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = EngineeringDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'car_risk_type'           =>  $request->input('car_risk_type'),
                           'car_parties'             =>  $request->input('car_parties'),
                           'car_nature_of_business'  =>  $request->input('car_nature_of_business'),
                           'car_contract_description'=>  $request->input('car_contract_description'),
                           'car_contract_sum'        =>  $request->input('car_contract_sum'),
                           'car_deductible'          =>  $request->input('car_deductible'),
                           'car_endorsements'        =>  $request->input('car_endorsements')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }   
       
}


if($request->input('policy_product')=='Liability Insurance')
{
        
        $time = explode(" - ", $request->input('insurance_period'));
        $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = LiabilityDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'liability_risk_type'        =>  $request->input('liability_risk_type'),
                           'liability_schedule'         =>  $request->input('liability_schedule'),
                           'liability_schedule'         =>  $request->input('liability_schedule'),
                           'liability_beneficiary'      =>  $request->input('liability_beneficiary')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }   
        
     
}


if($request->input('policy_product')=='Health Insurance')
        {
    
        $time = explode(" - ", $request->input('insurance_period'));
        $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'        =>   $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from' =>   $this->change_date_format($time[0]), 
                           'insurance_period_to'   =>   $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = HealthDetail::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'health_type'            =>  $request->input('health_type'),
                           'health_plan_details'    =>  $request->input('health_plan_details'),
                           'health_plan_limits'     =>  $request->input('health_plan_limits')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
     
      }



if($request->input('policy_product')=='Life Insurance')
    {
    
        $time = explode(" - ", $request->input('insurance_period'));
        $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = LifeDetail::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'life_type'              =>  $request->input('life_type'),
                           'life_cover_amount'      =>  $request->input('life_cover_amount'),
                           'life_monthly_premium'   =>  $request->input('life_monthly_premium'),
                           'life_plan_details'      =>  $request->input('life_plan_details'),
                           'life_plan_limits'       =>  $request->input('life_plan_limits')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
            }
            else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
   

    }



//Bond Insurance

if($request->input('policy_product')=='Bond Insurance')
        {

            //dd($request->input('policyid'));
        $time = explode(" - ", $request->input('insurance_period'));
        $affectedRows = Policy::where('id','=', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'policy_number'          => $request->input('policy_number'),
                           'policy_currency'        => $request->input('policy_currency'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = BondDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'bond_risk_type'                 => $request->input('bond_risk_type'),
                           'bond_interest'                  => $request->input('bond_interest'),
                           'bond_interest_address'          => $request->input('bond_interest_address'),
                           'contract_sum'                   => $request->input('contract_sum'),
                           'bond_sum_insured'               => $request->input('bond_sum_insured'),
                           'bond_contract_description'      => $request->input('bond_contract_description')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','2. Policy failed to update!');
                        }
            
            }
             else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','1. Policy failed to update!');
                        }

       
      }
    

//General Accident
if($request->input('policy_product')=='General Accident Insurance')
    {
        
            $time = explode(" - ", $request->input('insurance_period'));
            $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = AccidentDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'accident_risk_type'             =>  $request->input('accident_risk_type'),
                           'general_accident_sum_insured'   =>  $request->input('general_accident_sum_insured'),
                           'general_accident_deductible'    =>  $request->input('general_accident_deductible'),
                           'accident_description'           =>  $request->input('accident_description'),
                           'accident_beneficiaries'         =>  $request->input('accident_beneficiaries'),
                           'accident_clause_limit'          =>  $request->input('accident_clause_limit')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
            }
             else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
    }


// Travel Poloicy

    if($request->input('policy_product')=='Travel Insurance')
    {
    
            $time = explode(" - ", $request->input('insurance_period'));
            $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = TravelDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'destination_country'             =>  implode($request->input('destination_country'), ', '),
                           'departure_date'                  =>  $request->input('departure_date'),
                           'arrival_date'                    =>  $request->input('arrival_date'),
                           'passport_number'                 =>  $request->input('passport_number'),
                           'issuing_country'                 =>  $request->input('issuing_country'),
                           'citizenship'                     =>  $request->input('citizenship'),
                           'beneficiary_name'                =>  $request->input('beneficiary_name'),
                           'beneficiary_relationship'        =>  $request->input('beneficiary_relationship'),
                           'beneficiary_contact'             =>  $request->input('beneficiary_contact'),
                           'travel_reason'                   =>  $request->input('travel_reason')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
            }
            else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
        
      }


      if($request->input('policy_product')=='Personal Accident Insurance')

        {
        
        $time = explode(" - ", $request->input('insurance_period'));
            $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'policy_number' =>  $request->input('policy_number'),
                           'policy_currency'        =>  $request->input('policy_currency'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = Accident::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'pa_sum_insured'             =>  $request->input('pa_sum_insured'),
                           'pa_height'                  =>  $request->input('pa_height'),
                           'pa_weight'                  =>  $request->input('pa_weight'),
                           'marital_status'             =>  $request->input('marital_status'),
                           'nature_of_work'             =>  $request->input('nature_of_work'),
                           'pa_accident_received'       =>  $request->input('pa_accident_received'),
                           'pa_nature_of_accident'      =>  $request->input('pa_nature_of_accident'),
                           'accident_duration'          =>  $request->input('accident_duration'),
                           'accident_period'            =>  $request->input('accident_period'),
                           'pa_activities'              =>  $request->input('pa_activities'),
                           'pa_special_term_status'     =>  $request->input('pa_special_term_status'),
                           'pa_cancelled_insurance_status' =>  $request->input('pa_cancelled_insurance_status'),
                           'pa_increased_premium_status'   =>  $request->input('pa_increased_premium_status'),
                           'pa_benefit_details'            =>  $request->input('pa_benefit_details')));

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
            }
            else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
       
       

        }



}


public function renewPolicy(Request $request)
{


        $invoicenumberval = $this->generateInoviceNumber(10);
        $policyref = $request->input('refid');

        if($request->input('policy_product')=='Motor Insurance')
        {
        

        $time = explode(" - ", $request->input('insurance_period'));


         $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'policy_currency' =>  $request->input('policy_currency'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = MotorDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'preferedcover'              =>  $request->input('preferedcover'),
                           'vehicle_currency'           =>  $request->input('vehicle_currency'),
                           'vehicle_value'              =>  $request->input('vehicle_value'),
                           'vehicle_buy_back_excess'    =>  $request->input('vehicle_buy_back_excess'),
                           'vehicle_tppdl_standard'     =>  $request->input('vehicle_tppdl_standard'),
                           'vehicle_tppdl_value'        =>  $request->input('vehicle_tppdl_value'),
                           'vehicle_body_type'          =>  $request->input('vehicle_body_type'),
                           'vehicle_model'              =>  $request->input('vehicle_model'),
                           'vehicle_make'               =>  $request->input('vehicle_make'),
                           'vehicle_use'                =>  $request->input('vehicle_use'),
                           'vehicle_make_year'          =>  $request->input('vehicle_make_year'),
                           'vehicle_seating_capacity'   =>  $request->input('vehicle_seating_capacity'),
                           'vehicle_cubic_capacity'     =>  $request->input('vehicle_cubic_capacity'),
                           'vehicle_registration_number' =>  $request->input('vehicle_registration_number'),
                           'vehicle_chassis_number'     =>  $request->input('vehicle_chassis_number'),
                           'vehicle_interest_status'    =>  $request->input('vehicle_interest_status'),
                           'vehicle_interest_name'      =>  $request->input('vehicle_interest_name'),

                           'vehicle_declined_status'    =>  $request->input('vehicle_declined_status'),
                           'vehicle_declined_reason'    =>  $request->input('vehicle_declined_reason'),
                           'vehicle_cancelled_status'   =>  $request->input('vehicle_cancelled_status'),
                           'vehicle_cancelled_reason'   =>  $request->input('vehicle_cancelled_reason'),

                           'vehicle_risk'               =>  $request->input('vehicle_risk'),
                           'vehicle_ncd'                =>  $request->input('vehicle_ncd'),
                           'vehicle_fleet_discount'     =>  $request->input('vehicle_fleet_discount')));

                                $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();


                        if($affected > 0)
                        {
                              


                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy renew successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Motor Policy failed to renew!');
                        }
            
                }
               else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }
        
        

      
        }

  //Fire Policy
   
 if($request->input('policy_product')=='Fire Insurance')
        {
   
             $time = explode(" - ", $request->input('insurance_period'));


         $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = FireDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'fire_risk_covered'              =>  $request->input('fire_risk_covered'),
                           'fire_building_cost'             =>  $request->input('fire_building_cost'),
                           'fire_deductible'                =>  $request->input('fire_deductible'),
                           'fire_personal_property_coverage'=>  $request->input('fire_personal_property_coverage'),
                           'fire_temporary_rental_cost'     =>  $request->input('fire_temporary_rental_cost'),
                           'fire_building_address'          =>  $request->input('fire_building_address'),
                           'fire_property_type'             =>  $request->input('fire_property_type'),
                           'walled_with'                    =>  $request->input('walled_with'),
                           'roofed_with'                    =>  $request->input('roofed_with'),
                           'fire_mortgage_status'           =>  $request->input('fire_mortgage_status'),
                           'fire_mortgage_company'          =>  $request->input('fire_mortgage_company'),
                           'property_content'               =>  $request->input('property_content')));

                                $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }   

      }
    
//Marine Insurance

if($request->input('policy_product')=='Marine Insurance')
        {
    


         $time = explode(" - ", $request->input('insurance_period'));
         $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = FireDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'marine_risk_type'           =>  $request->input('marine_risk_type'),
                           'marine_sum_insured'         =>  $request->input('marine_sum_insured'),
                           'marine_bill_landing'        =>  $request->input('marine_bill_landing'),
                           'marine_interest'            =>  $request->input('marine_interest'),
                           'marine_vessel'              =>  $request->input('marine_vessel'),
                           'marine_insurance_condition' =>  $request->input('marine_insurance_condition'),
                           'marine_valuation'           =>  $request->input('marine_valuation'),
                           'marine_means_of_conveyance' =>  $request->input('marine_means_of_conveyance'),
                           'marine_voyage'              =>  $request->input('marine_voyage'),
                           'marine_condition'           =>  $request->input('marine_condition')));

                               $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                } 
                else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }  

   
      }


      //Engineering Insurance

if($request->input('policy_product')=='Engineering Insurance')
{
        
       
         $time = explode(" - ", $request->input('insurance_period'));
         $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = EngineeringDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'car_risk_type'           =>  $request->input('car_risk_type'),
                           'car_parties'             =>  $request->input('car_parties'),
                           'car_nature_of_business'  =>  $request->input('car_nature_of_business'),
                           'car_contract_description'=>  $request->input('car_contract_description'),
                           'car_contract_sum'        =>  $request->input('car_contract_sum'),
                           'car_deductible'          =>  $request->input('car_deductible'),
                           'car_endorsements'        =>  $request->input('car_endorsements')));

                                $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();
                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                } 
                else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }  
       
}


if($request->input('policy_product')=='Liability Insurance')
{
        
        $time = explode(" - ", $request->input('insurance_period'));
        $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer' =>  $request->input('policy_insurer'),
                           'insurance_period_from' => $this->change_date_format($time[0]), 
                           'insurance_period_to' =>$this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = LiabilityDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'liability_risk_type'        =>  $request->input('liability_risk_type'),
                           'liability_schedule'         =>  $request->input('liability_schedule'),
                           'liability_schedule'         =>  $request->input('liability_schedule'),
                           'liability_beneficiary'      =>  $request->input('liability_beneficiary')));

                              $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        } 
        
     
}


if($request->input('policy_product')=='Health Insurance')
        {
    
        $time = explode(" - ", $request->input('insurance_period'));
        $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'        =>   $request->input('policy_insurer'),
                           'insurance_period_from' =>   $this->change_date_format($time[0]), 
                           'insurance_period_to'   =>   $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = HealthDetail::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'health_type'            =>  $request->input('health_type'),
                           'health_plan_details'    =>  $request->input('health_plan_details'),
                           'health_plan_limits'     =>  $request->input('health_plan_limits')));

                                $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();
                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
                }
                else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }
     
      }



if($request->input('policy_product')=='Life Insurance')
    {
    
        $time = explode(" - ", $request->input('insurance_period'));
        $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = LifeDetail::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'life_type'              =>  $request->input('life_type'),
                           'life_cover_amount'      =>  $request->input('life_cover_amount'),
                           'life_monthly_premium'   =>  $request->input('life_monthly_premium'),
                           'life_plan_details'      =>  $request->input('life_plan_details'),
                           'life_plan_limits'       =>  $request->input('life_plan_limits')));

                               $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
            }
            else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }
   

    }



//Bond Insurance

if($request->input('policy_product')=='Bond Insurance')
        {

        $time = explode(" - ", $request->input('insurance_period'));
        $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = BondDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'bond_risk_type'                 =>  $request->input('bond_risk_type'),
                           'bond_interest'                  =>  $request->input('bond_interest'),
                           'bond_interest_address'          =>  $request->input('bond_interest_address'),
                           'contract_sum'                   =>  $request->input('contract_sum'),
                           'bond_sum_insured'               =>  $request->input('bond_sum_insured'),
                           'bond_contract_description'      =>  $request->input('bond_contract_description')));

                                $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();
                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }


            
            }

          else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }

       
      }
    

//General Accident
if($request->input('policy_product')=='General Accident Insurance')
    {
        
            $time = explode(" - ", $request->input('insurance_period'));
            $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = AccidentDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'accident_risk_type'             =>  $request->input('accident_risk_type'),
                           'general_accident_sum_insured'   =>  $request->input('general_accident_sum_insured'),
                           'general_accident_deductible'    =>  $request->input('general_accident_deductible'),
                           'accident_description'           =>  $request->input('accident_description'),
                           'accident_beneficiaries'         =>  $request->input('accident_beneficiaries'),
                           'accident_clause_limit'          =>  $request->input('accident_clause_limit')));

                               $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
            }
            else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }
    }


// Travel Poloicy

    if($request->input('policy_product')=='Travel Insurance')
    {
    
            $time = explode(" - ", $request->input('insurance_period'));
            $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));
            
            if($affectedRows > 0)
            {
                $affected = TravelDetails::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'destination_country'             =>  implode($request->input('destination_country'), ', '),
                           'departure_date'                  =>  $request->input('departure_date'),
                           'arrival_date'                    =>  $request->input('arrival_date'),
                           'passport_number'                 =>  $request->input('passport_number'),
                           'issuing_country'                 =>  $request->input('issuing_country'),
                           'citizenship'                     =>  $request->input('citizenship'),
                           'beneficiary_name'                =>  $request->input('beneficiary_name'),
                           'beneficiary_relationship'        =>  $request->input('beneficiary_relationship'),
                           'beneficiary_contact'             =>  $request->input('beneficiary_contact'),
                           'travel_reason'                   =>  $request->input('travel_reason')));

                                $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();

                          //dd($affected);
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
            }
            else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }
        
      }


      if($request->input('policy_product')=='Personal Accident Insurance')

        {
        
        $time = explode(" - ", $request->input('insurance_period'));
            $affectedRows = Policy::where('id', $request->input('policyid'))
            ->update(array(

                           'policy_insurer'         => $request->input('policy_insurer'),
                           'insurance_period_from'  => $this->change_date_format($time[0]), 
                           'insurance_period_to'    => $this->change_date_format($time[1])));

            if($affectedRows > 0)
            {
                $affected = Accident::where('id',$request->input('detailid'))
            ->update(array(
                           
                           'pa_sum_insured'             =>  $request->input('pa_sum_insured'),
                           'pa_height'                  =>  $request->input('pa_height'),
                           'pa_weight'                  =>  $request->input('pa_weight'),
                           'marital_status'             =>  $request->input('marital_status'),
                           'nature_of_work'             =>  $request->input('nature_of_work'),
                           'pa_accident_received'       =>  $request->input('pa_accident_received'),
                           'pa_nature_of_accident'      =>  $request->input('pa_nature_of_accident'),
                           'accident_duration'          =>  $request->input('accident_duration'),
                           'accident_period'            =>  $request->input('accident_period'),
                           'pa_activities'              =>  $request->input('pa_activities'),
                           'pa_special_term_status'     =>  $request->input('pa_special_term_status'),
                           'pa_cancelled_insurance_status' =>  $request->input('pa_cancelled_insurance_status'),
                           'pa_increased_premium_status'   =>  $request->input('pa_increased_premium_status'),
                           'pa_benefit_details'            =>  $request->input('pa_benefit_details')));


                                $bill                               = new Bill;
                                $bill->invoice_number               = $invoicenumberval;
                                $bill->account_number               = $request->input('customer_number');
                                $bill->account_name                 = $request->input('billed_to'); 
                                $bill->policy_number                = $request->input('policy_number');
                                $bill->policy_product               = $request->input('policy_product');
                                $bill->currency                     = $request->input('policy_currency');
                                $bill->amount                       = $request->input('gross_premium'); 
                                $bill->commission_rate              = $request->input('commission_rate'); 
                                $bill->note                         = $request->input('collection_mode'); 
                                $bill->reference_number             = $policyref; 
                                $bill->status                       = 'Unpaid';   
                                $bill->paid_amount                  = 0; 
                                $bill->created_by                   = Auth::user()->getNameOrUsername();
                                $bill->created_on                   = Carbon::now();
                                $bill->save();

                          
                        if($affected > 0)
                        {
                            return redirect()
                                        ->route('online-policies')
                                        ->with('success','Policy updated successfully!');

                        }

                        else
                        {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to update!');
                        }
            
            }

            else
                        {
                                         return redirect()
                                        ->route('invoice')
                                        ->with('info','Policy renewed!');
                        }
       
       

        }

}


}

