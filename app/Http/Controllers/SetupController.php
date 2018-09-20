<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;

use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;

use Phrontlyne\Models\VehicleModel;
use Phrontlyne\Models\VehicleMake;
use Phrontlyne\Models\Insurers;
use Phrontlyne\Models\PolicyProductType;
use Phrontlyne\Models\Currency;
use Phrontlyne\Models\Beneficiary;
use Phrontlyne\Models\MortgageCompanies;
use Phrontlyne\Models\PropertyType;

class SetupController extends Controller
{

    public function __construct()
    {

        $this->middleware('role:System Admin');
    }

     public function __construct()
    {
        $this->middleware('auth');
    }


         public function index()
        {

          return view('setup.index');

        }

        public function addNewMake(Request $request)
        {


         

        }


         public function addNewModel(Request $request)
        {

          $vehiclemakemodel = new VehicleModel;
          $vehiclemakemodel->type  = $request->input('vehicle_make');
          $vehiclemakemodel->model = $request->input('vehicle_model');
          if($vehiclemakemodel->save())
          {
             $vehiclemake = new VehicleMake;
            $vehiclemake->type  = $request->input('vehicle_make');
            $vehiclemake->save(); 
            return redirect()
            ->route('setup')
            ->with('info','Item successfully been created!');

          }



        }

         public function addNewInsurer(Request $request)
        {
          $insuers = new Insurers;
          $insuers->name  = $request->input('insurer');
          $insuers->type = $request->input('insurer_type');
          $insuers->save(); 
            return redirect()
            ->route('setup')
            ->with('info','Item successfully been created!');
        }

         public function addNewCurrency(Request $request)
        {
          $currency = new Currency;
          $currency->type = $request->input('currency');
          $currency->save(); 
            return redirect()
            ->route('setup')
            ->with('info','Item successfully been created!');

        }

        public function addNewProduct(Request $request)
        {

          $policytype = new PolicyProductType;
          $policytype->type = $request->input('policytype');
          $policytype->group = $request->input('policygroup');
          $policytype->save(); 
            return redirect()
            ->route('setup')
            ->with('info','Item successfully been created!');

        }

        public function addNewPropertype(Request $request)
        {
          $propertytype = new PropertyType;
          $propertytype->type = $request->input('propertytype');
          $propertytype->save(); 
            return redirect()
            ->route('setup')
            ->with('info','Item successfully been created!');

        }

          public function addNewMortgageCompany(Request $request)
        {
          $mortgage = new MortgageCompanies;
          $mortgage->name = $request->input('mortgage_compaany');
          $mortgage->save(); 
            return redirect()
            ->route('setup')
            ->with('info','Item successfully been created!');

        }

        public function addNewBeneficiary(Request $request)
        {
          $beneficiary = new Beneficiary;
          $beneficiary->type = $request->input('beneficiary_type');
          $beneficiary->save(); 
            return redirect()
            ->route('setup')
            ->with('info','Item successfully been created!');

        }



}
