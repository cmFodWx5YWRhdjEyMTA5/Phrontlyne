@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>FACULTATIVE PAYMENT</p>
            </header>
             <section class="scrollable wrapper">
             <img src="/images/{{ $company->logo }}" width="15%">
               <div class="row">
                <div class="col-xs-6">
                  <p>{{$company->legal_name }} - Cession : ({{$cessions->cession_number }}) </p>
                  
                 <p>  <strong> Insured Name : </strong> {{ $cessions->fullname }}</p>
                 <p>  <strong> Policy # : </strong> {{ $cessions->master_policy_number }}</p>
                  <p>  <strong> Business Class : </strong> {{ $cessions->business_class }}</p>
                  <p>  <strong> Risk : </strong> {{ $cessions->cover_type }}</p>
                   <p>  <strong> Currency : </strong> {{ $cessions->currency }}</p>
                  <p>  <strong> Reg/Ref No.: </strong> {{ $cessions->item_id }}</p>
                   <p>  <strong> Processed Time/Date : </strong> {{ date("g:ia\, jS M Y", strtotime($cessions->record_date )) }}</p>
                  <br>                 
                  </p>
                </div>
                <div class="col-xs-6 text-right">
                 <br>
                  <p>   <strong>  Insurance Period : </strong> {{ Carbon\Carbon::parse($cessions->period_from)->format('Y-m-d') }} to {{ Carbon\Carbon::parse($cessions->period_to)->format('Y-m-d') }} </p>
                  <p>   <strong>  Reinsurance Period : </strong> {{ Carbon\Carbon::parse($cessions->period_from)->format('Y-m-d') }} to {{ Carbon\Carbon::parse($cessions->period_to)->format('Y-m-d') }} </p>
                   
                   <p>  <strong> Treaty Year : </strong> {{ Carbon\Carbon::parse($cessions->period_from)->format('Y') }}</p>
                  <p>  <strong> Date Printed: </strong> {{ date("jS M Y", strtotime(date('Y-m-d')))  }}</p>  
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$cessions->policy_number', 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>
              </div>   
                <div class="line"></div>
               
                <h4 align="center"> <strong> FACULTATIVE PAYMENT </strong></h4>
              <div class="line"></div>    
                <p> To : <strong> {{ $cessions->reinsurer_broker }} </strong> </p>

              <p> Dear Sir/Madam,</p>
              <br>
              <p> Please find attached our <strong> {{ $payments->bank }} </strong> cheque number <strong> {{ $payments->cheque_number }} </strong> for <strong>{{ $payments->currency }}{{ number_format( $payments->cheque_amount , 2, '.', ',') }}</strong> being your share of premium on facultative offer.</p>
              <br>

             
               <div class="panel-body">

                           <label><strong> Fac Arrangement & Distribution </strong></label>
                        <div class="table-responsive">
                       <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th></th>
                              <th>Apportionment Amount</th>
                              <th>% Apportioned</th>
                              <th>Apportioned Premium</th>
                            </tr>
                          </thead>
                          <tbody>

                          <tr>
                          <td>Sum Insured</td>
                          <td>
                            <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->sum_insured , 2, '.', ',') }}" id="sum_insured" name="sum_insured"> 
                        
                          </td>
                          <td>
                         <input type="text" class="form-control" readonly="true" value="{{ $cessions->premium_percentage }}" id="premium_percentage" name="premium_percentage"> 
                          </td>
                        <td>
                         <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->premium , 2, '.', ',') }}" id="premium" name="premium"> 
                          </td>
                          </tr>



                         
                           <tr>
                          <td>Facultative  </td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->facultaive_offer , 2, '.', ',') }}" id="facultaive_offer" name="facultaive_offer"> 
                          </td>
                          <td>
                           <input type="text" class="form-control"readonly="true" value="{{ $cessions->facultative_percentage }}" id="facultative_percentage" name="facultative_percentage"> 
                          </td>
                          <td>
                         <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->facultative_on_prem , 2, '.', ',') }}" id="facultative_on_prem" name="facultative_on_prem"> 
                          </td>
                        
                          </tr>

                           </tr>
                          <tr>
                          <td>Commission </td>
                            <td></td>
                            <td>
                           <input type="text" class="form-control" value="{{ number_format($cessions->comm_on_facultative , 2, '.', ',') }}" id="comm_on_facultative" name="comm_on_facultative"> 
                          </td>
                            <td>
                           <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->facultative_comm , 2, '.', ',') }}" id="facultative_comm" name="facultative_comm"> 
                          </td>
                          </tr>
                         

                          
                   
                          </tbody>
                        </table>
                        <p>
                    <a href="#" class="btn btn-danger btn-lg pull-right">Net Premium : {{$cessions->currency }} {{ number_format($cessions->net_premium , 1, '.', ',') }} </a>
                  </p> 
                    </div>
                      </div>
                      <p>
    Kindly acknowledge receipt.
    </p>

    <p>
    
    Thank You,
    </p>
    <br>
    <br>
    <br>

        <p>
    
    Yours faithfully.
    </p>
                      <br>
                      <br>
                      <footer>
                        <p class="pull-right"> ............................................................................. <br> Head of Reinsurance : {{ Auth::user()->getNameOrUsername()  }} </p>
                      </footer>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
@stop