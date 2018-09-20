<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use Phrontlyne\Models\Customer;
use Phrontlyne\Models\Currency;
use Phrontlyne\Models\Insurers;
use Phrontlyne\Models\PolicyProductType;
use Phrontlyne\Models\FileFormat;
use Phrontlyne\Models\User;
use Input;
use Response;
use Auth;
use Validator;
use Activity;
use Redirect;
use Excel;
use JasperPHP\JasperPHP;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function statsreports()
    {
        return view('reporting.overview');
    }

     public function reportsmain()
    {
        return view('reporting.index');
    }

    //Policy

     public function endingPolicy()
    {
        return view('reporting.policies.ending');
    }

    public function cancelledPolicy()
    {
        return view('reporting.policies.cancelled');
    }
    
    public function installmentPolicy()
    {
        return view('reporting.policies.installments');
    }

     public function renewalPolicy()
    {
        return view('reporting.policies.renewal');
    }

     public function activePolicy()
    {
        return view('reporting.policies.active');
    }
    
         public function registeredPolicy()
    {
        return view('reporting.policies.registered');
    }

          public function salesSummary()
    {
        return view('reporting.sales.summary');
    }

     public function salesMain()
    {
        return view('reporting.sales.main');
    }
 
    public function salesCommission()
    {

    $customers    = Customer::all();
    $insurers     = Insurers::where('name','<>','null')->orderby('name','asc')->get();
    $producttypes = PolicyProductType::where('type','<>','null')->orderby('type','asc')->get();
    $intermediary = User::orderby('username','ASC')->get();
    $currencies   = Currency::all();
    $fileformats   = FileFormat::all();

        return view('reporting.sales.commission',compact('customers','insurers','fileformats','producttypes','intermediary','currencies'));
    }
 
    public function salesMoneyflow()
    {
        return view('reporting.sales.moneyflow');
    }

      public function generatedInvoices()
    {
        return view('reporting.customer.generatedinvoice');
    }

      public function installmentsUnpaid()
    {
        return view('reporting.customer.installmentsunpaid');
    }

     public function overPaid()
    {
        return view('reporting.customer.overpaid');
    }
 
    public function customerPayments()
    {
        return view('reporting.customer.payment');
    }

    public function receivableDetails()
    {
        return view('reporting.customer.receivabledetails');
    }

    public function receivableSummary()
    {
        return view('reporting.customer.receivablesummary');
    }

    public function customersUnpaid()
    {
        return view('reporting.customer.unpaid');
    }



    public function printsalesCommission(Request $request)
    {

        $customer_number = $request->input('customer_number');
        $policy_insurer = $request->input('policy_insurer');  
        $policy_product = $request->input('policy_product');  
        $account_manager = $request->input('account_manager');  
        $vehicle_currency = $request->input('vehicle_currency');  
        $fileformat = $request->input('fileformat');    
        //dd($policy_product);

        $policy_product =  '"' .$policy_product. '"';
        $policy_insurer =  '"' .$policy_insurer. '"';
        $account_manager = '"' .$account_manager.'"';

        $database = \Config::get('database.connections.mysql');
        $output = public_path() . '/reports/'.time().'_commssion_report';
        
        $ext = $fileformat;
        $realPath = public_path() . '/reports';
        $jasperPHP = new JasperPHP;
        $jasperPHP->process(
            public_path() . '/reports/commssion_report.jasper', 
            $output, 
            array($ext),
            array("customerval" => $customer_number,"businessclass" => $policy_product,"insurer" => $policy_insurer,"currencyval" => $vehicle_currency,"salesagentval" => $account_manager,"realPath"=>$realPath),
            $database,
            false,
            false
        )->execute();

        // foreach($output as $parameter_description)
        //     echo $parameter_description;
 
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.time().'_commssion_report.'.$ext);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($output.'.'.$ext));
        flush();
        readfile($output.'.'.$ext);
        unlink($output.'.'.$ext); // deletes the temporary file
        
        return Redirect::to('/reports');
    }
 
 

 
    
}
