@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
                    <p><span class="label label-success">{{ $cessions->cession_number }} - {{$cessions->fullname}} </span></p> 
                     <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $cessions->status }}</span></p>
                     <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($cessions->record_date)->diffForHumans() }}</span></p>

                     <div class="btn-group pull-right">
                    <p>
                    
                   <a href="/reinsurance-businesses" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> Return to FAC list  </a>
                    </p>
              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                        
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $cessions->fullname }} </div>
                            <br>
                            <div>
                          
                           <p class="block"><a href="/view-policy/{{ $cessions->policy_number }}" class="">POL # </a> <span class="label label-default">{{ $cessions->master_policy_number }}</span></p>
                           <p class="block"><a href="/view-policy/{{ $cessions->policy_number }}" class="">REF # </a> <span class="label label-danger">{{ $cessions->item_id }}</span></p>
                           <input type="hidden" id="cession_number" name="cession_number" value="{{ $cessions->cession_number }}">
                            </div>
                          </div>                
                        </div>

                       <br>
                      
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ Carbon\Carbon::parse($cessions->period_from)->year }}</span>
                                <small class="text-muted">Year</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $cessions->exchange_rate }}</span>
                                <small class="text-muted">Rate</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">{{ $cessions->currency }}</span>
                                <input type="hidden" id="cession_curreny" name="cession_curreny" value="{{ $cessions->currency }}">
                                <small class="text-muted">Currency</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       <br>
                       
                     
                        <div>
                          <ul class="list-group no-radius">
                        
                          <li class="list-group-item">
                            <span class="pull-right">{{ Carbon\Carbon::parse($cessions->period_from)->format('Y-m-d') }}</span>
                            
                             <small class="text-muted">Period From</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ Carbon\Carbon::parse($cessions->period_to)->format('Y-m-d') }}</span>
                            
                             <small class="text-muted">Period To</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ $cessions->business_class }}</span>
                            
                             <small class="text-muted">Business Class</small>
                          </li>     
                          <li class="list-group-item">
                            <span class="pull-right">{{ $cessions->cover_type }}</span>
                            
                             <small class="text-muted">Risk</small>
                          </li>     
                         
                        </ul>
                         
                          <br>
                         <img src="/images/762620.svg"> 
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>



                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class=""><a href="#fac-arrangement" data-toggle="tab"><i class="fa fa-lightbulb-o text-default"></i> Facultative Arrangement </a></li>
                           <li class=""><a href="#cession-apportions" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Apportionments </a></li>
                            <li class=""><a href="#cession-payments" data-toggle="tab"><i class="fa fa-money text-default"></i> Requisition &  Payments </a></li>
                          <li class=""><a href="#cession-debits" data-toggle="tab"><i class="fa fa-gavel text-default"></i>Debit/Receipts </a></li>
                          <li class=""><a href="#cession-claims" data-toggle="tab"><i class="fa fa-flask text-default"></i> Claims </a></li>
                          <li class=""><a href="#cession-documents" data-toggle="tab"><i class="fa fa-tint text-default"></i> History </a></li> 
                        <li class=""><a href="#cession-audit" data-toggle="tab"><i class="fa fa-table text-default"></i> Audit Trail </a></li> 

                         <span class="hidden-sm">.</span>
                      </ul>
                    </header>



                     <div class="panel-body">
                     <div class="tab-content"> 

                      <div class="tab-pane active" id="fac-arrangement">
                      <section class="panel panel-default">
                      <div class="panel-body">

                         <form method="post" action="/update-arrangement">
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
                          <td><span class="label label-info">Offer</span></td>
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
                          <td> <span class="label label-success">Company Additional Share </span> </td>
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
                          <td><span class="label label-warning">Facultative Offer Available </span> </td>
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

                        <br>
                        <br>
                        {{-- <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                         
                           <select id="reinsurer" name="reinsurer" rows="3" tabindex="1" data-placeholder="Select reinsurer to apportion to ..." style="width:100%">
                           <option value="{{ $cessions->reinsurer_broker }}">{{ $cessions->reinsurer_broker }}</option>
                           @foreach($reinsurers as $reinsurer)
                         <option value="{{ $reinsurer->name }}">{{ $reinsurer->name }}</option>
                          @endforeach 
                        </select>      
                        </div>   
                         
                        </div> --}}
                          <p>
                    <a href="#" class="btn btn-danger btn-lg pull-right">Net Premium : {{$cessions->currency }} {{ number_format($cessions->net_premium , 1, '.', ',') }} </a>
                  </p>
                    </div>
                      </div>

                       
                    
                      @role(['System Admin','Reinsurance Officer','Reinsurance Manager','General Manager Technical'])
                      <footer class="panel-footer text-right bg-light lter">
                        <input type="hidden" id="cessionid" name="cessionid" value="{{ $cessions->id }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn btn-success btn-s-xs">Update Arrangement</button>
                      </footer>
                      @endrole


                      </section>
                    </form>

                  <p>
                    <a href="/arrangement-slip/{{ $cessions->cession_number}}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-bars">  </i>Print Arrangement</a>
                    
                   
                  </p>
                       </div>
                   


                  <div class="tab-pane" id="review-fluid">
                          <section class="panel panel-default">
                     
                    
                    </section>
                  </div>
 


                        <div class="tab-pane" id="cession-debits">
                          <section class="panel panel-default">
                     
                    </section>
                     <img src="/images/438526.svg" width="7%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Transaction History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                           <th>Invoice #</th>
                                            <th>Date</th>
                                            <th>Currency</th>
                                             <th>Sum Insured</th>
                                            <th>Premium</th>
                                            <th>Paid</th>
                                             <th>Transaction Type</th>
                                            <th>Status</th>
                                            <th>Generated By</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                     @foreach($bills as $bill )
                                    <tr>
                                      <td>{{ $bill->invoice_number }}</td>
                                      <td>{{ $bill->invoice_date }}</td>
                                      <td>{{ $bill->currency }}</td>
                                      <td>{{ $bill->sum_insured }}</td>
                                      <td>{{ $bill->amount }}</td>
                                      <td>{{ $bill->paid_amount }}</td>
                                      <td>{{ $bill->transaction_type }}</td>
                                      <td>{{ $bill->payment_status }}</td>
                                      <td>{{ $bill->created_by }}</td>
                                    </tr>
                                   @endforeach 
                                      </tbody>
                                    </table>
                    </div>
                    </div>
                    </section>
                  </div>


                     <div class="tab-pane" id="cession-claims">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                          <th>Claim ID </th>
                                          <th>Item </th>
                                          <th>Nature of Loss</th>
                                          <th>Date of Loss</th>
                                          <th>S.I</th>
                                          <th>Estimated</th>
                                          <th>Approved</th>
                                          <th>Paid</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach( $claims as $claim )
                                      <tr>
                                        <td><a href="/edit-claim/{{ $claim->claim_id }}">{{ $claim->claim_id }}</a></td>
                                        <td>{{ $claim->item_id  }}</td>
                                        <td>{{ $claim->cause_of_loss  }}</td>
                                        <td>{{ $claim->loss_date  }}</td>
                                        <td>{{ $claim->currency  }} </td>
                                        <td>{{ $claim->reserve_estimated  }}</td>
                                        <td>{{ $claim->reserve_approved }}</td>
                                        <td>{{ $claim->reserve_paid }}</td>
                                        <td>{{ $claim->status }}</td> 
                                      </tr>
                                     @endforeach  
                                      </tbody>
               
                                    </table>
                                  </div>
                          </ul>
                        </div>
               
                

                   <div class="tab-pane" id="cession-apportions">
                        <section class="panel panel-default">
                      <div class="panel-body">
                          
                          <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="reinsurer_apportion" name="reinsurer_apportion" rows="3" tabindex="1" data-placeholder="Select reinsurer to apportion to ..." style="width:100%">
                           <option value="">-- Select Reinsurer--</option>
                           @foreach($reinsurers as $reinsurer)
                         <option value="{{ $reinsurer->name }}">{{ $reinsurer->name }}</option>
                          @endforeach 
                        </select>  <div class="input-group-btn">
                           <a href="#" class="bootstrap-modal-form-open" data-toggle="modal" ><button  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('reinsurer_rate') ? ' has-error' : ''}}">
                            <label>Gross Facultative Rate(%)</label>
                             <input type="text" class="form-control" readonly="true" class="text-success" id="gross_fac_rate"  value="{{ $cessions->facultative_percentage }}"  name="gross_fac_rate">       
                           @if ($errors->has('reinsurer_rate'))
                          <span class="help-block">{{ $errors->first('reinsurer_rate') }}</span>
                           @endif    
                          </div>   
                        </div>


                        
                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('reinsurer_rate') ? ' has-error' : ''}}">
                            <label>Apportionment Rate(%)</label>
                             <input type="text" class="form-control" class="text-success" id="reinsurer_rate"  value="{{ Request::old('reinsurer_rate') ?: '' }}"  name="reinsurer_rate">       
                           @if ($errors->has('reinsurer_rate'))
                          <span class="help-block">{{ $errors->first('reinsurer_rate') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('reinsurer_premium') ? ' has-error' : ''}}">
                           
                             <input type="hidden" class="form-control" class="text-success" id="reinsurer_premium"  value="{{ Request::old('reinsurer_premium') ?: '' }}"  name="reinsurer_premium">  

                             <input type="hidden" id="fac_value" name="fac_value" value="{{ $cessions->net_premium }} " > 
                             <input type="hidden" id="fac_rate" name="fac_rate" value="{{ $cessions->facultative_percentage }}" > 

                           @if ($errors->has('reinsurer_premium'))
                          <span class="help-block">{{ $errors->first('reinsurer_premium') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                     @role(['System Admin','Reinsurance Officer','Reinsurance Manager','General Manager Technical','Manager'])
                      <footer class="panel-footer text-right bg-light lter">

                        <button type="button" onclick="addapportioment()" class="btn btn-success btn-s-xs">Add Apportionment</button>
                      </footer>
                      @endrole


                      </div>
                    </section> 


                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Apportionments</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="apportionmentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Participating Company</th>
                              <th>% Apportioned</th>
                              <th>Premium Share</th>
                              <th>Created On</th>
                              <th> Cretaed By</th>
                              <th></th>
                               <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                          <p>
                    <a href="#" class="btn btn-danger btn-lg pull-right">Net Premium : {{$cessions->currency }} {{ number_format($cessions->net_premium , 1, '.', ',') }} </a>
                  
                    <a href="#" class="btn btn-success btn-lg pull-left">Net Apportioned : {{$cessions->currency }} {{ number_format($apportionments->sum('amount') , 1, '.', ',') }} </a>
                  </p>
                    </div>
                    </div>

                      </section>

                      <footer>
                        <a href="/final-cover-slip/{{ $cessions->cession_number}}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-file"></i>Print Cover Note</a>
                      </footer>
                  </div>
 



                  <div class="tab-pane" id="cession-payments">
                      <section class="panel panel-default">
                      <div class="panel-body">
                        

                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      FAC Requistion Information
                    </header>
                      <div class="panel-body">
                        

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pv_number') ? ' has-error' : ''}}">
                            <label>Payment Requisition Number</label>
                            <input type="text" rows="3" class="form-control" readonly="true" id="pv_number" name="pv_number" value="{{ Request::old('pv_number') ?: '' }}">      
                           @if ($errors->has('pv_number'))
                          <span class="help-block">{{ $errors->first('pv_number') }}</span>
                           @endif    
                          </div>   
                        </div>


                       <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pv_date') ? ' has-error' : ''}}">
                            <label>Date</label>
                            <input type="text" rows="3" class="form-control" id="pv_date" name="pv_date" value="{{ Request::old('pv_date') ?: '' }}">      
                           @if ($errors->has('pv_date'))
                          <span class="help-block">{{ $errors->first('pv_date') }}</span>
                           @endif    
                          </div>   
                        </div>


                        <div class="col-sm-3">
                            <label>Payment Method</label> 
                            <div class="form-group{{ $errors->has('pv_payment_mode') ? ' has-error' : ''}}">
                            <select id="pv_payment_mode" name="pv_payment_mode" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" >
                        <option value=""> -- Please select method -- </option>
                       <option value="Cash">Cash</option>
                       <option value="Cash" selected>Cheque</option>
                        </select>  
                           @if ($errors->has('pv_payment_mode'))
                          <span class="help-block">{{ $errors->first('pv_payment_mode') }}</span>
                           @endif    
                          </div>
                          </div>
                          <div class="col-sm-3">
                            <label>Payment Source</label> 
                            <div class="form-group{{ $errors->has('pv_payment_source') ? ' has-error' : ''}}">
                            <select id="pv_payment_source" name="pv_payment_source" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" >
                        <option value=""> -- Please select method -- </option>
                       <option value="Reinsurance Treaty">Reinsurance Treaty</option>
                       <option value="Reinsurance FAC">Reinsurance FAC</option>
                       <option value="Accounts" selected>Accounts</option>
                       <option value="Insured">Insured</option>
                        </select>  
                           @if ($errors->has('pv_payment_source'))
                          <span class="help-block">{{ $errors->first('pv_payment_source') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                       
                       
                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Amount Paid To</label> 
                            <div class="form-group{{ $errors->has('pv_payee_name') ? ' has-error' : ''}}">
                            <select id="pv_payee_name" name="pv_payee_name" onchange="fetchReinsurerPremium()" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" >
                       {{--  <option value=""> -- Please select claimant -- </option> --}}
        {{--                @foreach($claimants as $claimant)
                       <option value="{{ $claimant->claimant_name }}">{{ $claimant->claimant_name }}</option>
                      @endforeach --}}
                        </select>  
                           @if ($errors->has('pv_payee_name'))
                          <span class="help-block">{{ $errors->first('pv_payee_name') }}</span>
                           @endif    
                          </div>
                          </div>
                          </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('pv_amount') ? ' has-error' : ''}}">
                            <label>The Sum of </label>
                            <input type="number" min="0" step="0.01" readonly="true" rows="3" class="form-control"  id="pv_amount" name="pv_amount" value="{{ Request::old('pv_amount') ?: '' }}">      
                           @if ($errors->has('pv_amount'))
                          <span class="help-block">{{ $errors->first('pv_amount') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('pv_description') ? ' has-error' : ''}}">
                            <label>On Account Of</label>
                            <input type="text" rows="3" class="form-control" id="pv_description" data-required="true" name="pv_description" value="Payment of FAC Premium">      
                           @if ($errors->has('pv_description'))
                          <span class="help-block">{{ $errors->first('pv_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                       
                      
                      </div>
                      </section>
                    
                     

                       <div class="checkbox">
                          <label>
                            <input type="checkbox" name="check" unchecked ><a href="#" class="text-info">Try to automap payment</a>
                          </label>
                        </div>

                      
                        </div>
                         
                     @role(['System Admin','Reinsurance Officer','Reinsurance Manager','General Manager Technical','Manager'])
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addpayments()" class="btn btn-success btn-s-xs">Generate Requisition</button>
                      </footer>
                      @endrole

                    </section>
                     <img src="/images/951846.svg" width="7%" align="right"> 
                        <section class="panel panel-danger">
                                <header class="panel-heading font-bold">Requisition(s) Generated </header> 
                                <div class="panel-body">
                                      <div class="table-responsive">
                      <table id="paymentvoucherTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                           <th>PV #</th>
                                            <th>Date Generated</th>
                                            <th>Payee</th>
                                            <th>Currency</th>
                                            <th>PV Amount</th>
                                            <th>Checked By</th>
                                            <th>Approved By</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                             <th></th>
                                             <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    {{--  @foreach($bills as $bill )
                                    <tr>
                                      <td>{{ $bill->invoice_number }}</td>
                                      <td>{{ $bill->invoice_date }}</td>
                                      <td>{{ $bill->currency }}</td>
                                      <td>{{ $bill->sum_insured }}</td>
                                      <td>{{ $bill->amount }}</td>
                                      <td>{{ $bill->paid_amount }}</td>
                                      <td>{{ $bill->transaction_type }}</td>
                                      <td>{{ $bill->payment_status }}</td>
                                      <td>{{ $bill->created_by }}</td>
                                    </tr>
                                   @endforeach  --}}
                                      </tbody>
                                    </table>
                    </div>
                    </div>
                    </section>

              
                  </div>
 
{{-- 
                    <div class="tab-pane" id="cession-payments">
                         <section class="panel panel-default">
                      <div class="panel-body">
                          
                          <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="bank" name="bank" rows="3" tabindex="1" data-placeholder="Select bank to ..." style="width:100%">
                           <option value="">-- Select Bank--</option>
                           @foreach($banks as $bank)
                         <option value="{{ $bank->name }}">{{ $bank->name }}</option>
                          @endforeach 
                        </select>  <div class="input-group-btn">
                           <a href="#" class="bootstrap-modal-form-open" data-toggle="modal" ><button  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>


                        
                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('cheque_number') ? ' has-error' : ''}}">
                            <label>Cheque Number</label>
                             <input type="text" class="form-control" class="text-success" id="cheque_number"  value="{{ Request::old('cheque_number') ?: '' }}"  name="cheque_number">       
                           @if ($errors->has('cheque_number'))
                          <span class="help-block">{{ $errors->first('cheque_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('cheque_date') ? ' has-error' : ''}}">
                            <label>Cheque Date</label>
                             <input type="text" class="form-control" class="text-success"  id="cheque_date"  value="{{ Request::old('cheque_date') ?: '' }}"  name="cheque_date">  

                           @if ($errors->has('cheque_date'))
                          <span class="help-block">{{ $errors->first('cheque_date') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('cheque_amount') ? ' has-error' : ''}}">
                            <label>Amount</label>
                             <input type="text" class="form-control" class="text-success"  id="cheque_amount" readonly="true" value="{{ $cessions->net_premium }}"  name="cheque_amount">  
                             <input type="hidden" id="cheque_currency" name="cheque_currency" value="{{ $cessions->currency }}" > 

                           @if ($errors->has('cheque_amount'))
                          <span class="help-block">{{ $errors->first('cheque_amount') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                     
                      <footer class="panel-footer text-right bg-light lter">

                        <button type="button" onclick="addpayments()" class="btn btn-success btn-s-xs">Add Payment</button>
                      </footer>
                      </div>
                    </section> 


                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Payment History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="paymentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Bank</th>
                              <th>Cheque Number</th>
                              <th>Cheque Date</th>
                              <th>Currency</th>
                              <th>Amount Paid</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                          <p>
                    <a href="#" class="btn btn-danger btn-lg pull-right">Net Premium : {{$cessions->currency }} {{ number_format($cessions->net_premium , 1, '.', ',') }} </a>
                  
                    <a href="#" class="btn btn-success btn-lg pull-left">Net Apportioned : {{$cessions->currency }} {{ number_format($apportionments->sum('amount') , 1, '.', ',') }} </a>
                  </p>
                    </div>
                    </div>

                      </section>
                  </div> --}}




                  
                

                 

                      </div>
                    </section>
                  </section>
                  
                </aside>


    
                    </section>
                    </section>
                    </section>



  @stop

  <div class="modal fade" id="make-payment" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Make Payment On Requisition</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form"  data-validate="parsley" method="post" action="/make-requisition-payment">
                             @include('reinsurance/payment')

                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>



<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
$(function () {
  $('#pv_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
     "maxDate": moment(),
    "singleDatePicker":true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 1,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
  $('#payment_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
     "maxDate": moment(),
    "singleDatePicker":true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 1,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(document).ready(function () {

    loadApportionments();
    loadPayments();
    loadPVReinsurer();
    $('#reinsurer').select2({
      tags: true
      });

    $('#reinsurer_apportion').select2({
      tags: true
      });

    $('#pv_payee_name').select2();

    $('#reference_name').select2({
      tags: true
      });
    


    $('#bank').select2({
      tags: true
      });
   
  });
</script>





<script type="text/javascript">

 @role(['System Admin','Reinsurance Officer','Reinsurance Manager','General Manager Technical','Manager'])
  function addapportioment()
{
if($('#reinsurer_apportion').val()!= "" && $('#reinsurer_rate').val()!= "")
{

    $.get('/add-apportionment',
        {
          "cession_number": $('#cession_number').val(),
          "reinsurer": $('#reinsurer_apportion').val(),
          "reinsurer_rate": $('#reinsurer_rate').val()            
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadApportionments();
          loadPVReinsurer();

          //alert(data["SurplusRate"]);
          $('#reinsurer_rate').val(data["SurplusRate"]);
        
        }
        else if(data["Surplus"])
        {
           sweetAlert("Share has been over apportioned, please check values!");
        }

        else
        {
          sweetAlert("Apportionment failed to add!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please fill all the fields!");}
}



  function addpayments()
{


  if($('#pv_amount').val()!= "" && $('#pv_payee_name').val()!= "")
{

    $.get('/add-fac-payment',
        {

          "cession_number"   :$('#cession_number').val(),
          "pv_number"        :$('#pv_number').val(),
          "pv_payee_name"    :$('#pv_payee_name').val(),
          "pv_date"          :$('#pv_date').val(),
          "pv_payment_mode"  :$('#pv_payment_mode').val(),
          "pv_payment_source":$('#pv_payment_source').val(),
          "pv_cheque_number" :$('#pv_cheque_number').val(),
          "pv_description"   :$('#pv_description').val(),
          "pv_currency"      :$('#cession_curreny').val(),
          "pv_amount"        :$('#pv_amount').val()
          
        },
        
        function(data)
        { 
          
        $.each(data, function (key, value) {
        if(data["OK"])
        {
         
         toastr.success("Payment Voucher successfully saved!"); 
         loadPayments();

        }
        else
        {
         toastr.warning("PV failed to save!"); 
        }
      });
                                        
        },'json');
    }

  else
    
    {
      sweetAlert("Some fields not have no value!");
    }

}





function removeApportioment(id)
   {
     
          $.get('/delete-apportionment',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
               loadApportionments();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }


   function removePV(id)
   {
          $.get('/delete-payment-voucher-reinsurer',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
               loadPayments()();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error"); 
            }
        });
                                          
          },'json');        
   }




    function makePayment(id)
{ 

  $.get("/load-requisition-detail",
          {"id":id},
          
  function(json)
          {
                $('#make-payment input[name="payment_amount"]').val(json.payment_amount);
                $('#make-payment input[name="payer_name"]').val(json.payer_name);
                $('#make-payment input[name="payer_id"]').val(json.payer_id);
                $('#make-payment input[name="payment_description"]').val(json.payment_description);
             //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}




   function removePayment(id)
   {
     
          $.get('/delete-fac-payment',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
               loadPayments();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }

@endrole

function fetchReinsurerPremium()

{ 

  //alert($('#pv_payee_name').val());

  $.get("/load-reinsurer-premium",
          {
            "cession_number":$('#cession_number').val(),
            "reinsurer":$('#pv_payee_name').val()
         },
          
  function(json)
          {

                $('#pv_amount').val(json.pv_amount);
                
              
               
             //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });



}

function loadApportionments()
   {
         
        
        $.get('/get-apportionment',
          {
            "cession_number": $('#cession_number').val()
          },
          function(data)
          { 

            $('#apportionmentTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#apportionmentTable tbody').append('<tr><td>'+ value['reinsurer'] +'</td><td>'+ value['rate'] +'</td><td>'+ value['amount'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="/fac-slip/'+ value['id'] +'"><i class="fa fa-print"></i></a></td><td><a a href="#"><i onclick="removeApportioment('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }



    function loadPVReinsurer()
    {


        $.get('/load-pv-reinsurer',
          {
            "cession_number": $('#cession_number').val()
          },
          function(data)
          { 
           
            $('#pv_payee_name').empty();
           
            $.each(data, function () 
            {

            $('#pv_payee_name').append($('<option></option>').val(this['reinsurer']).html(this['reinsurer']));
            });
                                          
         },'json');      


    }



function loadPayments()
   {
         
        
        $.get('/get-fac-payments',
          {
            "cession_number": $('#cession_number').val()
          },
          function(data)
          { 

           $('#paymentvoucherTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#paymentvoucherTable tbody').append('<tr><td>'+ value['pv_number'] +'</td><td>'+ value['pv_date'] +'</td><td>'+ value['pv_payee_name'] +'</td><td>'+ value['currency'] +'</td><td>'+ value['pv_amount'] +'</td><td>'+ value['checked_by'] +'</td><td>'+ value['approved_by'] +'</td><td>'+ value['status'] +'</td><td>' + ( value['status'] == "Unpaid" ? '<a a href="/print-requisition-slip/'+value['id']+'">' : '<a a href="/print-requisition-receipt/'+value['id']+'">' ) + '<i onclick="" class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Voucher"></i></a></td><td><a a href="#"><i onclick="removePV('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a a href="#make-payment" class="bootstrap-modal-form-open" data-toggle="modal"><i onclick="makePayment('+value['id']+')" class="fa fa-money"></i></a></td><td>' + ( value['payment_mode'] == "Cash" ? '<a a href="/discharge-voucher/'+value['id']+'">' : '<a a href="/discharge-voucher/'+value['id']+'">' ) + '<i onclick="" class="fa fa-ticket" data-toggle="tooltip" data-placement="top" title="" data-original-title="Discharge Voucher"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

</script>




