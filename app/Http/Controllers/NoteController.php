<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\PolicyTemplate;
use Phrontlyne\Models\Policy;
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use Carbon\Carbon;

class NoteController extends Controller
{
    
     public function documents()
    {
        $documents = PolicyTemplate::paginate(30);
    	return view('document.index', compact('documents'));
    }

     public function new()
    {
        
        return view('document.new');
    }

     public function savedocument(Request $request)
    {
          $this->validate($request, [
            'file_name' => 'required'
        ]);

        $result           = $request->input('report');
        $docs             = new PolicyTemplate;
        $docs->file_name   = $request->input('file_name');
        $docs->content    = $request->input('report');
        $docs->save();
        
         return redirect()
            ->route('published-documents')
            ->with('info','Document successfully saved!');
       
    }


    public function bondtransit($id)
    {

    	$policy = Policy::where('id',$id)->first();

    	return view('document.transit',compact('policy'))
    }


    
    

   
}
