<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\User;
use Phrontlyne\Models\Agent;
use Phrontlyne\Models\Gender;
use Phrontlyne\Models\SalesChannel;
use Phrontlyne\Models\AgencyTypes;
use Phrontlyne\Models\Profession;
use Phrontlyne\Http\Requests;
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

class AgentController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users =  User::all();
        $gender =  Gender::get();
        $sale_channels = SalesChannel::get();
        $accounttypes = AgencyTypes::orderBy('type', 'ASC')->get(); 
        $professions = Profession::get();
        $agents = Agent::where('agentname','<>','')->orderBy('agentname','asc')->paginate(30);
        return view('agents.index',compact('agents','users','gender','sale_channels','accounttypes','professions'));
    }

    public function getAgents()
    {
        $users =  User::all();
        $gender =  Gender::get();
        $sale_channels = SalesChannel::get();
        $accounttypes = AgencyTypes::orderBy('type', 'ASC')->get(); 
        $professions = Profession::get();
        $agents = Agent::where('contract_type','Agent')->orderBy('agentname','asc')->paginate(30);
        return view('agents.index',compact('agents','users','gender','sale_channels','accounttypes','professions'));
    }

    public function getBrokers()
    {
        $users =  User::all();
        $gender =  Gender::get();
        $sale_channels = SalesChannel::get();
        $accounttypes = AgencyTypes::orderBy('type', 'ASC')->get(); 
        $professions = Profession::get();
        $agents = Agent::where('contract_type','Broker')->orderBy('agentname','asc')->paginate(30);
        return view('agents.index',compact('agents','users','gender','sale_channels','accounttypes','professions'));
    }

     public function getBanks()
    {
        $users =  User::all();
        $gender =  Gender::get();
        $sale_channels = SalesChannel::get();
        $accounttypes = AgencyTypes::orderBy('type', 'ASC')->get(); 
        $professions = Profession::get();
        $agents = Agent::where('contract_type','Bancassurance')->orderBy('agentname','asc')->paginate(30);
        return view('agents.index',compact('agents','users','gender','sale_channels','accounttypes','professions'));
    }





        public function createAgent(Request $request)
    {
        

        try
        {

            $this->validate($request, [
            'fullname'=> 'required|min:3',
            'postal_address'=> 'required|min:3',
            'mobile_number'=>'required|min:10',
            'account_manager'=>'required',
            ]); 

            $genaccountnumber = uniqid();


            
           $agent = new Agent;
           $agent->agentcode  = $genaccountnumber;
           $agent->agentname = ucwords(strtolower($request->input('fullname')));
           $agent->account_manager = $request->input('account_manager');
           $agent->address = $request->input('postal_address');
           $agent->r_address = $request->input('residential_address');
           $agent->email = $request->input('email');
           $agent->gender = $request->input('gender');
           $agent->phone_number = $request->input('mobile_number');
           $agent->date_of_birth = Carbon::createFromFormat('d/m/Y', Input::get("date_of_birth"));
           $agent->license_date = Carbon::createFromFormat('d/m/Y', Input::get("license_date"));
           $agent->appointment_date = Carbon::createFromFormat('d/m/Y', Input::get("appointment_date"));
           $agent->license_number = $request->input('license_number');
           $agent->agenttype = $request->input('account_type');
           $agent->contract_type  = $request->input('account_type');
           $agent->flag  = 'Inactive';
           $agent->created_on=Carbon::now();
           $agent->created_by=Auth::user()->getNameOrUsername();
          
           

           //dd($customer);
           
           if($agent->save())
          {

            return redirect()
            ->route('agency-profile',$genaccountnumber)
            ->with('success','Agent has successfully been created!... Pending activation of account');
          }

          else
          {
            return redirect()
            ->route('agent-list-all')
            ->with('error','Account failed to create!');
          }

}

catch (\Exception $e) {
           
           echo $e->getMessage();
            // return redirect()
            // ->route('active-customer')
            // ->with('error','Account failed to create!');
          
        }

    }



    public function updateAgent()
    {

      try {
        
          

            $account_number = Input::get("account_number");
            $fullname = Input::get("fullname");
            $account_manager = Input::get("account_manager");
            $residential_address = Input::get("residential_address");
            $postal_address = Input::get("postal_address");
            $email = Input::get("email");
            $mobile_number = Input::get("mobile_number");
           
            $date_of_birth = Carbon::createFromFormat('d/m/Y', Input::get("date_of_birth"));
           $license_date = Carbon::createFromFormat('d/m/Y', Input::get("license_date"));
           $appointment_date = Carbon::createFromFormat('d/m/Y', Input::get("appointment_date"));
           $license_number = Input::get('license_number');
            $sales_channel = Input::get('sales_channel');
            $gender = Input::get('gender');




             $affectedRows = Agent::where('agentcode', $account_number)
            ->update(array(
                           
                           'agentname' =>  $fullname,
                           'account_manager' =>  $account_manager,
                           'r_address' => $residential_address, 
                           'address' => $postal_address, 
                           'email' => $email, 
                           'phone_number' =>  $mobile_number, 
                           
                           'date_of_birth'=>$date_of_birth,
                           'license_number'=>$license_number,
                           'license_date'=>$license_date,
                           'appointment_date' => $appointment_date,
                           'gender'=> $gender,
                           'updated_by'=> Auth::user()->getNameOrUsername(),
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
            ->route('agency-profile',$account_number)
           ->with('success','Agent has successfully been created!... Pending activation of account');
            }
            else
            {
               return redirect()
            ->route('agent-list-all')
            ->with('error','Account failed to create!');
            }
          }


    catch (\Exception $e) {
           
           echo $e->getMessage();
            
        }
           

    }




    

    public function getAgency()
  {
      
    $id = Input::get('id');
    $agents = Agent::find($id);
    $data = Array(
        'agentcode'   =>$agents->agent_code,
        'agentname'        =>$agents->agent_name,
    );
        return Response::json($data);
  }

   public function loadAgent()
    {
        try
        {
                $search = Input::get("search");
                $agents = Agent::where('agentname','like', "%$search%")->orWhere('agentcode','like', "%$search%")->get();
                return  Response::json($agents);        
        }

        catch (\Exception $e) 
        {
               echo $e->getMessage();
            
        }
    }


    public function searchagent(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

         $users =  User::all();
        $gender =  Gender::get();
        $sale_channels = SalesChannel::get();
        $accounttypes = AgencyTypes::orderBy('type', 'ASC')->get(); 
        $professions = Profession::get();

        $search = $request->get('search');
       
        $agents = Agent::where('agentname', 'like', "%$search%")
            ->orWhere('agentcode', 'like', "%$search%")
            ->orWhere('contract_type', 'like', "%$search%")
            ->orderBy('agentname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

      return view('agents.index',compact('agents','users','gender','sale_channels','accounttypes','professions'));
  
    }




      public function activateAgent()
    {
       
         
            $userid = Input::get("ID");

            $affectedRows = Agent::where('id', '=', $userid)->update(array('flag' => 'Active'));

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



    public function deactivateAgent()
    {
       
         
            $userid = Input::get("ID");

            $affectedRows = Agent::where('id', '=', $userid)->update(array('flag' => 'Deactive'));

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

    public function deleteAgent()
    {
       
         
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Agent::where('id', '=', $ID)->delete();

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



     public function fetchAgent()
    {

    $user_id = Input::get('id');
    $user = Agent::find($user_id);
    $data = Array(
        'account_number'=>$user->agentcode,
        'account_type'=>$user->contract_type,
        'fullname'=>$user->agentname,
        'postal_address'=>$user->address,
        'email'=>$user->email,
        'mobile_number'=>$user->phone_number,
        'account_manager'=>$user->created_by,

        'license_number'=>$user->license_number,
        'appointment_date'=>$user->appointment_date->format('d/m/Y'),
        'date_of_birth'=>$user->date_of_birth->format('d/m/Y'),
        'license_date'=>$user->license_date->format('d/m/Y'),
        
        'gender'=>$user->gender
        //'image'=>$user->image
    );
    return Response::json($data);
    } 



   
}
