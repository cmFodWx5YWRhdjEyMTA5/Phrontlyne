<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\Image;
use Phrontlyne\Models\AttachDocuments;
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Response;
use Carbon\carbon;
use Auth;


class ImageController extends Controller
{
    public function postUpload(Request $request)
    {

         try
        {
        

        $image = new Image();
        $this->validate($request, [
            'image' => 'required',
            'filename' => 'required'
        ]);

       // dd(Input::get('selectedid'));
    
        $image->policy_number=Input::get('selectedid');
        $image->filename = Input::get('filename');
        $image->reference_number = Input::get('selectedcustomer');

        if($request->hasFile('image')) {
            $file = Input::file('image');

            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
           
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $image->mime = $file->getClientOriginalExtension();
            $image->filePath = $name;
            $image->created_by=Auth::user()->getNameOrUsername();
           $file = $file->move(public_path().'/uploads/images', $name);
            //Image::make($image->getRealPath())->resize(200, 200)->save($name); 
        }

        $image->save();
        return redirect()
            ->back()
            ->with('info','Document has successfully been uploaded!');
        }

    catch (\Exception $e) {
           
           echo $e->getMessage();
            // return redirect()
            // ->route('account.manage')
            // ->with('info','No document was added!',$e->getMessage());
        }
    }



    public function claimsUpload(Request $request)
    {

         try
        {
        

        $image = new Image();
        $this->validate($request, [
            'image' => 'required',
            'filename' => 'required'
        ]);

       // dd(Input::get('selectedid'));
    
        $image->policy_number = Input::get('policy_number');
        $image->filename      = Input::get('filename');
        $image->reference_number = Input::get('item_id');

        if($request->hasFile('image')) {
            $file = Input::file('image');

            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
           
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $image->mime = $file->getClientOriginalExtension();
            $image->filePath = $name;
            $image->created_by=Auth::user()->getNameOrUsername();
           $file = $file->move(public_path().'/uploads/images', $name);
            //Image::make($image->getRealPath())->resize(200, 200)->save($name); 
        }

        $image->save();
        return redirect()
            ->back()
            ->with('info','Document has successfully been uploaded!');
        }

    catch (\Exception $e) {
           
           echo $e->getMessage();
            // return redirect()
            // ->route('account.manage')
            // ->with('info','No document was added!',$e->getMessage());
        }
    }


     public function deleteImage()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Image::where('id', '=', $ID)->delete();

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
