<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\Company; 
use Phrontlyne\Models\PolicyDocument; 
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;

class CompanyController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $companydetails =  Company::paginate(30);
        return view('company.index',compact('companydetails'));
    }

    public function getItems()
    {
        $companydetails =  Company::paginate(1);
        return view('company.items',compact('companydetails'));
    }

  
    public function getDocuments()
    {   

        $documents = PolicyDocument::get();
         return view('document.policy',compact('documents'));
    }

   
}
