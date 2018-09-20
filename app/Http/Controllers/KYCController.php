<?php

namespace Phrontlyne\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Phrontlyne\Models\Customer;
use Phrontlyne\Models\Prescription;
use Phrontlyne\Models\Consultation;
use Phrontlyne\Models\Bill;
use Phrontlyne\Models\SalesChannel;
use Phrontlyne\Models\Gender;
use Phrontlyne\Models\AccountType;
use Phrontlyne\Models\IdentificationType;
use Phrontlyne\Models\Serials;
use Phrontlyne\Models\Agent;
use Phrontlyne\Models\CustomerBalanceSheet;
use Phrontlyne\Models\ProcessedPolicy;
use Phrontlyne\Models\Policy;
use Phrontlyne\Models\AttachDocuments;
use Phrontlyne\Models\ClaimProcessed;
use Phrontlyne\Models\Profession;
use Phrontlyne\Http\Requests;
use Phrontlyne\Models\User;
use Phrontlyne\Http\Controllers\Controller;
use Input;
use Response;
use Activity;
use Auth;
use Phrontlyne\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

use Image;
use Carbon\Carbon;
use Cache;
use DateTime;




class KYCController extends Controller
{

    

  public function __construct()
    {
        $this->middleware('auth');
    }
 
   public function getProfile($id)
   {

  
   
    $policies      = Policy::where('account_number',$id)->get();
    $bills         = Bill::where('account_number',$id)->get();
    $customers     = Customer::where('account_number', $id)->first();
    $claims        =  ClaimProcessed::where('insured_id' , $id)->get();
    $images        =  AttachDocuments::where('reference_number', $id)->get();
    return view('customer.view', compact('customers','images','bills','policies','claims'));

   }

      public function getAgencyPolicies($id)
   {


    $policies       =  Policy::where('agency',$id)->orderby('fullname','asc')->get();
    $bills          =  Bill::where('agency',$id)->get();
    $customers      =  Agent::where('agentcode',$id)->first();
    $claims         =  ClaimProcessed::where('agency' ,$id)->get();
    $images         =  AttachDocuments::where('reference_number', '0')->get();
    
    return view('agents.profile', compact('customers','images','bills','policies','claims'));

   }


    public function loadCustomer()
    {
        try
        {
                $search = Input::get("search");
                $jobs = Customer::where('NAME','like', "%$search%")->get();
                return  Response::json($jobs);        
        }

        catch (\Exception $e) 
        {
               echo $e->getMessage();
            
        }
    }



   public function getTimeline()
   {
     $accounttype = DB::table('account_types')->orderBy('type', 'ASC')->get(); 
     return view('customer.timeline');

   }
     
    public function activeCustomer()
    {
     
    $users =  User::all();
    $gender =  Gender::get();
    $identificationtypes = IdentificationType::get();
    $sale_channels = SalesChannel::get();
    $accounttype = AccountType::orderBy('type', 'ASC')->get(); 
    $professions = Profession::get();
     $customers = Customer::sortable()->orderby('created_on','desc')->paginate(30);
    
    return view('customer.index', compact('customers','professions','identificationtypes','accounttype','users','gender','sale_channels'));

   
   
  
    }

     public function inactiveCustomer()
    {
     
    $users =  User::all();
    $gender =  Gender::get();
    $identificationtypes = IdentificationType::get();
    $sale_channels = SalesChannel::get();
    $accounttype = AccountType::orderBy('type', 'ASC')->get(); 
    $professions = Profession::get();
    $customers =  Customer::where('status','Deactive')->paginate(30);
    return view('customer.inactive', compact('customers','professions','identificationtypes','accounttype','users','gender','sale_channels'));
  
    }


    
  
public function getSearchResults(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $users =  User::all();
        $gender =  Gender::get();
        $identificationtypes = IdentificationType::get();
        $sale_channels = SalesChannel::get();
        $professions = Profession::get();
        $accounttype = AccountType::orderBy('type', 'ASC')->get(); 


         $customers = Customer::sortable()->where('fullname', 'like', "%$search%")
             ->orWhere('mobile_number', 'like', "%$search%")
             ->orWhere('created_by', 'like', "%$search%")
             ->orderBy('fullname')
             ->paginate(30)
             ->appends(['search' => $search])
         ;



      return view('customer.index', compact('customers','professions','identificationtypes','accounttype','users','gender','sale_channels'));
  
    }


    public function findToCreatePolicy(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $users =  User::all();
        $gender =  Gender::get();
        $identificationtypes = IdentificationType::get();
        $sale_channels = SalesChannel::get();
        $accounttype = AccountType::orderBy('type', 'ASC')->get(); 


         $customers = Customer::where('fullname', 'like', "%$search%")
             ->orWhere('mobile_number', 'like', "%$search%")
             ->orWhere('created_by', 'like', "%$search%")
             ->orderBy('fullname')
             ->paginate(30)
             ->appends(['search' => $search])
         ;



      return view('policy.search', compact('customers','accounttype','identificationtypes','users','gender','sale_channels'));
  
    }

function generateCustomerID()
{
    // $number = Serials::where('name','=','customer')->first();
    // $number = $number->counter;
    // $account = str_pad($number,5, '0', STR_PAD_LEFT);
    // $myaccount= 'C'.$account;

    $myaccount = DB::select('call gen_client_id("01")');
    $myaccount = uniqid();

    //dd($myaccount);
    return  $myaccount;

}

 public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y', $date);
        return $time->format('Y-m-d');
    }

    
    public function postNewCustomer(Request $request)
    {
        

        try
        {

            $this->validate($request, [
            //'fullname'=> 'required|min:3',
            'postal_address'=> 'required|min:3',
            'mobile_number'=>'required|min:10',
            ]); 


            $selectedaccount = $request->input('account_type');
           if($selectedaccount == 'Individual')
           {
            $insured = $request->input('firstname').' '.$request->input('surname').' '.$request->input('othername');
           } 
           else
           {
             $insured = $request->input('companyname');
           }
           
           $genaccountnumber = $this->generateCustomerID();


            
           $customer = new Customer;
      	   $customer->account_number  = $genaccountnumber;
           $customer->fullname = ucwords(strtolower($insured));
           $customer->account_manager = $request->input('account_manager');
           $customer->postal_address = $request->input('postal_address');
           $customer->residential_address = $request->input('residential_address');
           $customer->email = $request->input('email');
           $customer->mobile_number = $request->input('mobile_number');
           $customer->date_of_birth = $this->change_date_format($request->input('date_of_birth'));
           $customer->field_of_activity = $request->input('field_of_activity');

           $customer->gender = $request->input('gender');
           $customer->sales_channel = $request->input('sales_channel');
           $customer->account_type = $request->input('account_type');
           $customer->status = $request->input('Active');
           $customer->created_on=Carbon::now();
           $customer->created_by=Auth::user()->getNameOrUsername();
           $customer->branch = Auth::user()->getBranch();
           
           

           //dd($customer);
           
           if($customer->save())
          {

            return redirect()
            ->route('online-policies/new',$genaccountnumber)
            ->with('success','Customer has successfully been created!... You can begin to create a policy');
          }

          else
          {
            return redirect()
            ->route('active-customer')
            ->with('error','Account failed to create!');
          }

}

    catch (\Exception $e) {
           
           echo $e->getMessage();
             //return redirect()
             //->route('active-customer')
             //->with('error','Account failed to create!');
          
        }

    }



public function updateCustomer()
    {

      try {
        
          

            $account_number = Input::get("account_number");
            $fullname = Input::get("fullname");
            $account_manager = Input::get("account_manager");
            $residential_address = Input::get("residential_address");
            $postal_address = Input::get("postal_address");
            $email = Input::get("email");
            $mobile_number = Input::get("mobile_number");
            $field_of_activity = Input::get("field_of_activity");
            $date_of_birth = $this->change_date_format(Input::get('date_of_birth'));
            $sales_channel = Input::get('sales_channel');
            $gender = Input::get('gender');




             $affectedRows = Customer::where('account_number', '=', $account_number)
            ->update(array(
                           
                           'fullname' =>  $fullname,
                           'account_manager' =>  $account_manager,
                           'residential_address' => $residential_address, 
                           'postal_address' => $postal_address, 
                           'email' => $email, 
                           'mobile_number' =>  $mobile_number, 
                           'field_of_activity'=>$field_of_activity,
                           'date_of_birth'=>$date_of_birth,
                           'sales_channel' => $sales_channel,
                           'gender'=> $gender,
                           
                          'updated_on'=>Carbon::now()));

            if($affectedRows > 0)
            {
                Activity::log([
              'contentId'   =>  $account_number,
              'contentType' => 'User',
              'action'      => 'Update',
              'description' => 'Updated details of '.$fullname,
              'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
              ]);
        
             
              return redirect()
            ->route('active-customer')
            ->with('success','Customer has successfully been updated!');
            }
            else
            {
               return redirect()
            ->route('active-customer')
            ->with('error','Customer failed to update!');
            }
          }


    catch (\Exception $e) {
           
           echo $e->getMessage();
            
        }
           

    }



   



    public function editCustomer()
    {

    $user_id = Input::get('id');
    $user = Customer::find($user_id);
    $data = Array(
        'account_number'=>$user->account_number,
        'account_type'=>$user->account_type,
        'fullname'=>$user->fullname,
        'residential_address'=>$user->residential_address,
        'postal_address'=>$user->postal_address,
        'date_of_birth'=>$user->date_of_birth->format('d/m/Y'),
        'email'=>$user->email,
        'field_of_activity'=>$user->field_of_activity,
        'image'=>$user->image,
        'mobile_number'=>$user->mobile_number,
        'account_manager'=>$user->account_manager,
        'sales_channel'=>$user->sales_channel,
        'gender'=>$user->gender
        //'image'=>$user->image
    );
    return Response::json($data);
    } 

   
  public function getCustomer()
  {
      
    $id =  Input::get('id');
    $user = Customer::where('ID',$id)->first();
    $data = Array(
        'account_number'   =>$user->ID,
        'fullname'        =>$user->NAME,
    );
        return Response::json($data);
  }

  public function activateCustomer()
    {
       
         
            $userid = Input::get("ID");

            $affectedRows = Customer::where('id', '=', $userid)->update(array('status' => 'Active'));

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



    public function deactivateCustomer()
    {
       
         
            $userid = Input::get("ID");

            $affectedRows = Customer::where('id', '=', $userid)->update(array('status' => 'Deactive'));

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

    public function deleteCustomer()
    {
       
         
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Customer::where('id', '=', $ID)->delete();

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


    



}
