@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>FAC ARRANGEMENTS</p>
            </header>
             <section class="scrollable wrapper">
             <img src="/images/{{ $company->logo }}" width="15%">
               <div class="row">
                <div class="col-xs-6">
                  <p>{{$company->legal_name }} - Cession : ({{$cessions->cession_number }}) </p>
                  
                 <p>  <strong> Insured Name : </strong> {{ $cessions->fullname }}</p>
                 <p>  <strong> Policy # : </strong> {{ $cessions->master_policy_number }}</p>
                  <p>  <strong> Risk : </strong> {{ $cessions->cover_type }}</p>
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
                <h4 align="center"> <strong> REINSURANCE ARRANGEMENT </strong></h4>
              <div class="line"></div>
               <div class="panel-body">

                           <label> Fac Arrangement & Distribution </label>
                        <div class="table-responsive">
                       <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th></th>
                              <th>Distribution</th>
                              <th>Rate</th>
                              <th>Premium</th>
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
                          <td>Retention</td>
                          <td>
                          {{--  <input type="text" style="width:300px; border: 1px solid #ABADB3; text-align: center;" id="od_ocular_adnexae" name="od_ocular_adnexae">  --}}
                          <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->company_retention , 2, '.', ',') }}" id="company_retention" name="company_retention"> 
                          </td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ $cessions->retention_percentage}}" id="retention_percentage" name="retention_percentage"> 
                          </td>
                          <td>
                         <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->retention_on_prem , 2, '.', ',') }}" id="retention_on_prem" name="retention_on_prem"> 
                          </td>
                        
                          </tr>

                           <tr>
                          <td>First Layer</td>
                          <td>
                         <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->first_surplus , 2, '.', ',') }}" id="first_surplus" name="first_surplus"> 
                          </td>
                          <td>
                         <input type="text" class="form-control" readonly="true" value="{{ $cessions->first_suplus_percentage }}" id="first_suplus_percentage" name="first_suplus_percentage"> 
                         </td>
                         <td>
                         <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->first_sup_on_prem , 2, '.', ',') }}" id="first_sup_on_prem" name="first_sup_on_prem"> 
                          </td>
                        
                          </tr>

                           <tr>
                          <td>Second Layer</td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->second_surplus , 2, '.', ',') }}" id="second_surplus" name="second_surplus"> 
                          </td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ $cessions->second_suplus_percentage }}" id="second_suplus_percentage" name="second_suplus_percentage"> 
                          </td>
                          <td>
                         <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->second_sup_on_prem , 2, '.', ',') }}" id="second_sup_on_prem" name="second_sup_on_prem"> 
                          </td>
                        
                          </tr>

                          <tr>
                          <td>Offer</td>
                          <td>
                          <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->company_offer , 2, '.', ',') }}" id="company_offer" name="company_offer"> 
                          </td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ $cessions->comp_offer_percentage }}" id="comp_offer_percentage" name="comp_offer_percentage"> 

                           </td>
                           <td>
                         <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->offer_on_prem , 2, '.', ',')}}" id="offer_on_prem" name="offer_on_prem"> 
                          </td>
                        
                          </tr>


                          <tr>
                          <td> Company Additional Share </td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{  number_format($cessions->company_share , 2, '.', ',') }}" id="company_share" name="company_share"> 
                          </td>
                          <td>
                           <input type="text" class="form-control" value="{{ $cessions->phic_percentage }}" id="phic_percentage" name="phic_percentage"> 
                          </td>
                          <td>
                         <input type="text" class="form-control" readonly="true" value="{{ number_format($cessions->phic_on_prem , 2, '.', ',') }}" id="phic_on_prem" name="phic_on_prem"> 
                          </td>
                        
                          </tr>


                           <tr>
                          <td>Facultative Offer Available  </td>
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
                    <h3 class="font-thin pull-right"> Net Premium : {{$cessions->currency }} {{ number_format($cessions->net_premium , 1, '.', ',') }} </h3>
                  </p>
                    </div>
                      </div>
                      <br>
                      <br>
                      <footer>
                        <p class="pull-right"> ............................................................................. <br> Reinsurance : {{ Auth::user()->getNameOrUsername()  }} </p>
                      </footer>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
@stop