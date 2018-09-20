<?php

namespace Phrontlyne\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Phrontlyne\Models\User;
use Phrontlyne\Models\Company; 
use Activity;
use Phrontlyne\Models\Branch; 
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;
use Phrontlyne\Models\Role; 
use Input;
use Response;
use Hash;



class AuthController extends Controller
{
    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    //protected $redirectTo = '/';




 public function getUserEdit($id)
    {

            $company = Company::get()->first();
            $user = User::where('id',$id)->first();
            $branches = Branch::orderby('branch_name','asc')->get();
            $roles = Role::get();
            return view('auth.edituser',compact('user','roles','company','branches'));

    }
    
     public function getSignup()
    {
         $roles=Role::orderby('name','asc')->get();
         $branches = Branch::orderby('branch_name','asc')->get();
         return view('auth.signup',compact('roles','branches'));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
                'email'=> 'required|email|max:255',
                'username'=> 'required|max:100',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                'fullname'=> 'required|min:3',
                'location'=> 'required|min:2',
                'usertype'=> 'required|min:2',
            ]);

         
            
            $affectedRows = User::where('id', $request->input('userid'))->update(array('password' =>  bcrypt($request->input('password')),'username'=> $request->input('username'),'email'=> $request->input('email'),'location'=> $request->input('location') , 'usertype' => $request->input('usertype'), 'fullname' => $request->input('fullname')));

            if($affectedRows > 0)
            {
               
                return redirect()
            ->route('manage-users')
            ->with('info','Password has successfully been updated!, User can now sign in');
            }
            else
            {
                return redirect()
            ->route('manage-users')
            ->with('Warning','User details failed to update');
            }

    }
   

    public function postSignup(Request $request)
    {
        $this->validate($request, [
                'email'=> 'required|unique:users|email|max:255',
                'username'=> 'required|unique:users|alpha_dash|max:20',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                'fullname'=> 'required|min:3',
                'location'=> 'required|min:2',
                'usertype'=> 'required|min:2',
            ]);

        $assigned_role = $request->input('usertype');

        $user = new User;
        $user->email = strtolower($request->input('email'));
        $user->username = strtolower($request->input('username'));
        $user->password = bcrypt($request->input('password'));
        $user->fullname = $request->input('fullname');
        $user->location = $request->input('location');
        $user->usertype = $request->input('usertype');
        if($user->save())
        {

        $role = Role::where('name','=', $assigned_role)->first();
        $user->attachRole($role);

        return redirect()
            ->route('auth.signup')
            ->with('info','Account has successfully been created!, User can now sign in');
        }
        else
        {
        return redirect()
            ->route('auth.signup')
            ->with('Warning','Account failed to create');
        }
    }



    public function getSignin()
    {
        return view('auth.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
               
                'username'=> 'required',
                'password'=> 'required',
                
            ]);

         $remember_me = $request->has('remember') ? true : false; 

        if(!Auth::attempt($request->only(['username','password']),$remember_me))
        {
            return redirect()
                    ->back()
                    ->with('error','Invalid Username/Password combination. Please try again');
        }

            if(Auth::user()->created_at != Auth::user()->updated_at)
            {
            
                if(Auth::user()->usertype == 'Tab')
                {
                    return redirect()
                    ->route('register-start')
                    ->with('info','You are now signed in');

                }
                else
                {

                     Activity::log([
                      'contentId'   =>  Auth::user()->getNameOrUsername(),
                      'contentType' => 'User',
                      'action'      => 'Login',
                      'description' => 'User details '.Auth::user()->getNameOrUsername(),
                      'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                      ]);

                    return redirect()
                    ->route('dashboard')
                    ->with('info','You are now signed in');


                     
                }

          

            }

            else
            {
            return redirect()
            ->route('reset-password-notice')
            ->with('info','First time login, Please reset your passowrd!!!');
         }
    }

     public function resetnotice()
    {
         $company = Company::get()->first();
        return view('auth.notice',compact('company'));
    }
    
    public function deleteUser()
    {

            $userid = Input::get("ID");

            $affectedRows = User::where('id', '=', $userid)->delete();

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



     public function getUsers()
    {

        $users =  User::paginate(30);
       return view('auth.user', compact('users'));
    }

    public function getSignOut()
    {
        Auth::logout();
        return redirect()
            ->route('auth.signin')
            ->with('info','Please sign in');

    }


}
