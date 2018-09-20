<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use Phrontlyne\Models\Customer;
use Phrontlyne\Models\Event;
use Phrontlyne\Models\Bill;
use Phrontlyne\Models\ProcessedPolicy;
use Phrontlyne\Models\Policy;
use Carbon\Carbon;
use Cache;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

         $customercount    =   Cache::remember('customercount', 22*60, function(){
           return Customer::count();
         });

        $processedpolicies =   Cache::remember('processedpolicies', 22*60, function(){
           return Policy::count();
         });
        
        $endingpolicies    =   Cache::remember('endingpolicies', 22*60, function(){
           return  Policy::limit(5)->where('insurance_period_to','<=',Carbon::now())->get();
         });

        $bills  =   Cache::remember('bills', 22*60, function(){
           return   Bill::where('payment_status','Unpaid')->orderBy('created_on','desc')->limit(5)->get();
         });


       //bills Graph
             $views = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('policy_product','Motor Insurance')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();

            $views2 = DB::table('bills')
              ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('policy_product','Fire Insurance')
              ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();


            $views3 = DB::table('bills')
            ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('policy_product','Bond Insurance')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();

        
        $labels = array();
        $billamount = array();

        $labels2 = array();
        $billamount2 = array();

        $labels3 = array();
        $billamount3 = array();

        foreach ($views as $view) {

            array_push($labels, $view->day_of_month);
            array_push($billamount, $view->billamount);
          
        }

         foreach ($views2 as $view2) {

            array_push($labels2, $view2->day_of_month);
            array_push($billamount2, $view2->billamount);
          
        }

         foreach ($views3 as $view3) {

            array_push($labels3, $view3->day_of_month);
            array_push($billamount3, $view3->billamount);
          
        }
        
        //dd(,$labels);
    
        $cobbillscharts = app()->chartjs
        ->name('billamount')
        ->type('line')
        ->size(['width' => 900, 'height' => 300])
        ->labels($labels)
        ->datasets([
            
            [
               // labels: [$labels],
                "label" => "Bills for Motor",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $billamount,
                'spanGaps' => "false",
            ],
            [
               "label" => "Bills for Fire",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $billamount2,
                'spanGaps' => "false",
            ],
            [
                "label" => "Bills for Bond",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $billamount3,
                'spanGaps' => "false",
            ]
            
        ])
        ->options([]);





        //Bills by branches

         //bills Graph
             $headoffice = DB::table('bills')
             ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','Accra (Head Office)')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();

             

            $kumasi = DB::table('bills')
              ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','Kumasi')
              ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();


            $takoradi = DB::table('bills')
            ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','Takoradi')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();


             $tamale = DB::table('bills')
            ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','Tamale')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();

             $sunyani = DB::table('bills')
            ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','Sunyani')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();

              $eastlegon = DB::table('bills')
            ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','East Legon')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();

             $koforidua = DB::table('bills')
            ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','Koforidua')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();

              $tema = DB::table('bills')
            ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','Tema')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();


             $capecoast = DB::table('bills')
            ->select(DB::raw("DATE_FORMAT(invoice_date,'%d-%M') as day_of_month"), DB::raw("sum(amount) as billamount"))
            ->where('branch','Cape Coast')
            ->whereRaw("invoice_date >= last_day(now()) + interval 1 day - interval 2 month")
             ->groupBy('day_of_month')
             ->orderby('invoice_date','asc')
             ->limit(30)
             ->get();


        
        $headofficelabel = array();
        $headofficeamount = array();

        $kumasilabel = array();
        $kumasiamount = array();

        $takoradilabel = array();
        $takoradiamount = array();

        $tamalelabel = array();
        $tamaleamount = array();

        $sunyanilabel = array();
        $sunyaniamount = array();

        $eastlegonlabel = array();
        $eastlegonamount = array();

        $koforidualabel = array();
        $koforiduaamount = array();

        $temalabel = array();
        $temaamount = array();

        $capecoastlabel = array();
        $capecoastamount = array();


        

        foreach ($headoffice as $headoffice) {
            array_push($headofficelabel, $headoffice->day_of_month);
            array_push($headofficeamount, $headoffice->billamount);

             //dd($headofficelabel);
          
        }

         foreach ($kumasi as $kumasi) {
            array_push($kumasilabel, $kumasi->day_of_month);
            array_push($kumasiamount, $kumasi->billamount);
          
        }

          foreach ($takoradi as $takoradi) {
            array_push($takoradilabel, $takoradi->day_of_month);
            array_push($takoradiamount, $takoradi->billamount);
          
        }

        foreach ($tamale as $tamale) {
            array_push($tamalelabel, $tamale->day_of_month);
            array_push($tamaleamount, $tamale->billamount);
          
        }

         foreach ($sunyani as $sunyani) {
            array_push($sunyanilabel, $sunyani->day_of_month);
            array_push($sunyaniamount, $sunyani->billamount);
          
        }

        foreach ($eastlegon as $eastlegon) {
            array_push($eastlegonlabel, $eastlegon->day_of_month);
            array_push($eastlegonamount, $eastlegon->billamount);
          
        }

        foreach ($koforidua as $koforidua) {
            array_push($koforidualabel, $koforidua->day_of_month);
            array_push($koforiduaamount, $koforidua->billamount);
        }

        foreach ($tema as $tema) {
            array_push($temalabel, $tema->day_of_month);
            array_push($temaamount, $tema->billamount);
          
        }

        foreach ($capecoast as $capecoast) {
            array_push($capecoastlabel, $capecoast->day_of_month);
            array_push($capecoastamount, $capecoast->billamount);
          
        }


         
        
       
    
        $branchbillschart = app()->chartjs
        ->name('branchsummary')
        ->type('line')
        ->size(['width' => 900, 'height' => 300])
        ->labels($headofficelabel)
        ->datasets([
            
            [
               // labels: [$labels],
                "label" => "Accra (Head Office)",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                'strokeColor' => "#f56954",
                'pointColor' => "#A62121",
                'pointStrokeColor' => "#741F1F",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $headofficeamount,
                'spanGaps' => "false",
            ],
            [
               "label" => "Kumasi",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $kumasiamount,
                'spanGaps' => "false",
            ],
            [
                "label" => "Takoradi",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(93, 173, 226, 0.31)",
                'borderColor' => "rgba(93, 173, 226, 0.7)",
                "pointBorderColor" => "rgba(93, 173, 226, 0.7)",
                "pointBackgroundColor" => "rgba(93, 173, 226, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $takoradiamount,
                'spanGaps' => "false",
            ],
            [
                "label" => "Tamale",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(33, 47, 61, 0.31)",
                'borderColor' => "rgba(33, 47, 61, 0.7)",
                "pointBorderColor" => "rgba(33, 47, 61, 0.7)",
                "pointBackgroundColor" => "rgba(33, 47, 61, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $tamaleamount,
                'spanGaps' => "false",
            ],
            [
                "label" => "Sunyani",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(151, 154, 154, 0.31)",
                'borderColor' => "rgba(151, 154, 154, 0.7)",
                "pointBorderColor" => "rgba(151, 154, 154, 0.7)",
                "pointBackgroundColor" => "rgba(151, 154, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $sunyaniamount,
                'spanGaps' => "false",
            ],
            [
                "label" => "East Legon",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(244, 208, 63, 0.31)",
                'borderColor' => "rgba(244, 208, 63, 0.7)",
                "pointBorderColor" => "rgba(244, 208, 63, 0.7)",
                "pointBackgroundColor" => "rgba(244, 208, 63, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $eastlegonamount,
                'spanGaps' => "false",
            ],
            [
                "label" => "Koforidua",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(211, 84, 0, 0.31)",
                'borderColor' => "rgba(211, 84, 0, 0.7)",
                "pointBorderColor" => "rgba(211, 84, 0, 0.7)",
                "pointBackgroundColor" => "rgba(211, 84, 0, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $koforiduaamount,
                'spanGaps' => "false",
            ],
            [
                "label" => "Tema",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(241, 148, 138, 0.31)",
                'borderColor' => "rgba(241, 148, 138, 0.7)",
                "pointBorderColor" => "rgba(241, 148, 138, 0.7)",
                "pointBackgroundColor" => "rgba(241, 148, 138, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $temaamount,
                'spanGaps' => "false",
            ]
            ,
            [
                "label" => "Cape Coast",
                 //fill => false,
                //'beginAtZero' => "true",
                'backgroundColor' => "rgba(153, 102, 255, 0.31)",
                'borderColor' => "rgba(153, 102, 255, 0.7)",
                "pointBorderColor" => "rgba(153, 102, 255, 0.7)",
                "pointBackgroundColor" => "rgba(153, 102, 255, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $capecoastamount,
                'spanGaps' => "false",
            ]
            
        ])
        ->options([]);




        //customer type count

        $corporate       = Customer::where('account_type', 'Business')->where('status','Active')->count();
        $private         = Customer::where('account_type', 'Individual')->where('status','Active')->count();
        $total           = Customer::where('status','Active')->count();
       
         //dd($pharmacy);
         $corporate = $corporate/$total * 100;
         $private = $private/$total * 100;
        


       $customertypejs = app()->chartjs
        ->name('pieChartTest')
        ->type('doughnut')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Corporate', 'Individual'])
        ->datasets([
            [
                'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                'hoverBackgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 70, 235)'],
                'data' => [ $corporate , $private]
                
            ]
        ])
        ->options([]);

       

       
        return View('pages.dashboard', compact('getactivities','branchbillschart','customertypejs','cobbillscharts','birthdays','processedpolicies','paidbills','customercount','bills','endingpolicies'));
    }


   






}
