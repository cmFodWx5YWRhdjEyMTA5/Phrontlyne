<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\Bank;
use Phrontlyne\Models\BankAccount;
use Phrontlyne\Models\BankDeposites;
use Phrontlyne\Models\BankPayments;
use Phrontlyne\Models\Customer;
use Phrontlyne\Models\PaymentType;
use Phrontlyne\Http\Requests;
use Phrontlyne\Models\Currency;
use Phrontlyne\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;


class BankController extends Controller
{

     public function getbanks()
    {

    $banks = Bank::paginate(15);
    return view('banking.banks', compact('banks'));
    }

    public function getBankAccount()
    {
    $banks=Bank::get();
    $currencies=Currency::all();
    $bank_accounts = BankAccount::paginate(30);
    return view('banking.bankaccounts', compact('bank_accounts','currencies','banks'));
    }

    
     public function getPayments()
    {

    $customers = Customer::where('status','Active')->orderBy('fullname', 'ASC')->get();
    $account_name=BankAccount::get();
    $receiptmodes=PaymentType::get();
    $payments = BankPayments::paginate(30);
    return view('banking.payments', compact('payments','account_name','receiptmodes','customers'));
    
    }

     public function getDeposites()
    {
    $customers = Customer::where('status','Active')->orderBy('fullname', 'ASC')->get();
    $account_name=BankAccount::get();
    $receiptmodes=PaymentType::get();
    $deposites = BankDeposites::paginate(30);
    return view('banking.deposites', compact('deposites','account_name','receiptmodes','customers'));
    }


    public function getTransfers()
    {
    $banks = Bank::paginate(30);
    return view('banking.transfers', compact('banks'));
    }


    public function doDeposite(Request $request)
    {

          $bankaccount = new BankDeposites;
           $bankaccount->bank_name  = $request->input('transactiontype');
           $bankaccount->account_name = $request->input('trasactionamount');
           $bankaccount->account_number = $request->input('narration');
           $bankaccount->currency = $request->input('receiptmode');
           $bankaccount->created_by = Auth::user()->getNameOrUsername();
           $bankaccount->created_on = Carbon::now();
          
           $bankaccount->save(); 
            return redirect()
            ->route('banking.bankaccounts')
            ->with('info','Bank Account has successfully been created!');

    }


    public function createBank(Request $request)
    {

            $this->validate($request, [
            
            'bank_name'=>'required|unique:banks|min:3',
            ]); 


           $bank = new Bank;
           $bank->bank_name  = $request->input('bank_name');
           $bank->swift_number = $request->input('swift_number');
           $bank->created_by = Auth::user()->getNameOrUsername();
           $bank->created_on = Carbon::now();
          
           $bank->save(); 
            return redirect()
            ->route('banking.banks')
            ->with('info','Bank has successfully been created!');

    }

    public function createAccount(Request $request)
    {
          $this->validate($request, [
            'account_number'=> 'required|unique:bank_accounts|min:3',
            'bank_name'=> 'required',
            'currency'=> 'required',
            
            ]); 


           $bankaccount = new BankAccount;
           $bankaccount->bank_name  = $request->input('bank_name');
           $bankaccount->account_name = $request->input('account_name');
           $bankaccount->account_number = $request->input('account_number');
           $bankaccount->currency = $request->input('currency');
           $bankaccount->created_by = Auth::user()->getNameOrUsername();
           $bankaccount->created_on = Carbon::now();
          
           $bankaccount->save(); 
            return redirect()
            ->route('banking.bankaccounts')
            ->with('info','Bank Account has successfully been created!');
        
    }

   public function deleteBank()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Bank::where('id', '=', $ID)->delete();

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

   public function deleteBankAccount()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = BankAccount::where('id', '=', $ID)->delete();

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
