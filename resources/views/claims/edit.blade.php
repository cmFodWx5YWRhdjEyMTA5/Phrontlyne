@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
                    <p><span class="label label-success">{{ $policies->itemid }} - {{ $policies->fullname}} </span></p> 
                     <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $policies->status }}</span></p>
                     <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($policies->record_date)->diffForHumans() }}</span></p>

                     <div class="btn-group pull-right">
                    <p>
                     <a href="/facing-sheet/{{ $claimdetails->id }}" class="btn btn-rounded btn-sm btn-dark"><i class="fa fa-fw fa-print"></i>Print Claim Face Sheet   </a>
                   
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
                            <div class="h3 m-t-xs m-b-xs">{{ $policies->fullname }}  </div>
                           
                            {{--  <div class="h6 m-t-xs m-b-xs"><i class="fa fa-fw fa-phone"></i> {{ $insured->mobile_number }} </div>
                             <div class="h6 m-t-xs m-b-xs"> <i class="fa fa-fw fa-home"></i> {{ $insured->postal_address }} </div> --}}

                            
                            <div>
                            <p class="block"><a href="/view-policy/{{ $policies->policy_number }}" class="">PHONE # <span class="label label-default">{{ $insured->mobile_number }}</span>  </a> </p>

                           <p class="block"><a href="/view-policy/{{ $policies->policy_number }}" class="">POL # <span class="label label-default">{{ $policies->master_policy_number }}</span>  </a> </p>
                           <p class="block"><a href="/view-policy/{{ $policies->policy_number }}" class="">VEHICLE/ITEM #  <span class="label label-danger">{{ $policies->itemid }}</span></a></p>
                          
                          <input type="hidden" name="account_number" id="account_number" value="{{ $policies->account_number }}">
                            </div>
                          </div>                
                        </div>

                       <br>
                      
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ Carbon\Carbon::parse($policies->insurance_period_from)->format('Y') }}</span>
                                <small class="text-muted">Year</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              {{-- <a href="#">
                                <span class="m-b-xs h4 block">{{ $policies->exchange_rate }}</span>
                                <small class="text-muted">Rate</small>
                              </a> --}}
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">{{ $policies->policy_currency }}</span>
                                <small class="text-muted">Currency</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       <br>
                       
                     
                        <div>
                          <ul class="list-group no-radius">
                        
                          <li class="list-group-item">
                            <span class="pull-right">{{ Carbon\Carbon::parse($policies->insurance_period_from)->format('Y-m-d') }}</span>
                            
                             <small class="text-muted">Period From</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ Carbon\Carbon::parse($policies->insurance_period_to)->format('Y-m-d') }}</span>
                            
                             <small class="text-muted">Period To</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ $policies->policy_product }}</span>
                            
                             <small class="text-muted">COB</small>
                          </li>     
                          <li class="list-group-item">
                            <span class="pull-right">{{ str_limit($policies->coverage,12) }}</span>
                            
                             <small class="text-muted">Cover</small>
                          </li>     
                           <li class="list-group-item">
                            <span class="pull-right">{{ $policies->agency }}</span>
                            
                             <small class="text-muted">Agency</small>
                          </li>    
                           <li class="list-group-item">
                            <span class="pull-right">{{ $policies->policy_branch }}</span>
                            
                             <small class="text-muted">Branch</small>
                          </li>    
                          <li class="list-group-item">
                            <span class="pull-right">{{ str_limit($policies->created_by, $limit = 10, $end = '...') }}</span>
                            
                             <small class="text-muted">Underwritten By</small>
                          </li>          
                         
                        </ul>
                         
                          <br>
                          
                          @if($policies->policy_product == 'Motor Insurance')
                          <img  src="/images/832900.svg"> 
                          @elseif($policies->policy_product == 'Fire Insurance')
                           <img  src="/images/964386.svg"> 
                            @elseif($policies->policy_product == 'Bond Insurance')
                           <img  src="/images/890168.svg"> 
                          @else
                          <img  src="/images/890168.svg"> 
                          @endif
                           
                        {{--  <img src="/images/607623.svg">  --}}
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>



                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">


                       
                         <li class=""><a href="#claim-information" data-toggle="tab"><i class="fa fa-lightbulb-o text-default"></i> Claim Notification </a></li>
                         
                       
                        
                           <li class="active"><a href="#loss-information" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Loss Header </a></li>
                          
                            
                         <li class=""><a href="#loss-claimant" data-toggle="tab"><i class="fa fa-users text-default"></i> Claimant </a></li>
{{-- 
                         @if($policies->policy_product == 'Motor Insurance')
                            <li class=""><a href="#loss-drivers" data-toggle="tab"><i class="fa fa-puzzle-piece text-default"></i> Named Drivers </a></li>
                          @else
                          @endif --}}
                          <li class=""><a href="#claim-adjustment" data-toggle="tab"><i class="fa fa-gavel text-default"></i> Item & Reserve </a></li>
                          <li class=""><a href="#claim-payments" data-toggle="tab"><i class="fa fa-money text-default"></i> Payments </a></li> 
                           <li class=""><a href="#loss-memo" data-toggle="tab"><i class="fa fa-file text-default"></i> Memo </a></li>
                          <li class=""><a href="#loss-report" data-toggle="tab"><i class="fa fa-bars text-default"></i> Liability Report </a></li>
                           <li class=""><a href="#loss-risk-details" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Key Risk Details </a></li>
                          <li class=""><a href="#loss-debits" data-toggle="tab"><i class="fa fa-sort-numeric-asc text-default"></i> Invoices </a></li>
                          <li class=""><a href="#loss-cessions"  data-toggle="tab"><i class="fa fa-retweet text-default"></i> FAC XOL </a></li>
                          <li class=""><a href="#review-procedure" data-toggle="tab"><i class="fa fa-tasks text-default"></i> Logs </a></li> 
                          <li class=""><a href="#loss-documents" data-toggle="tab"><i class="fa fa-folder text-default"></i> Supporting Documents / Attachments </a></li> 
                           


                         <span class="hidden-sm">.</span>
                      </ul>
                    </header>



                     <div class="panel-body">
                     <div class="tab-content"> 

                   
                      <div class="tab-pane" id="claim-information">
                      <section class="panel panel-default">

                       <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Claim Information
                             </header>
                        <div class="panel-body">
                        

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claim_number') ? ' has-error' : ''}}">
                            <label>Claim Number</label>
                            <input id="claim_number" name="claim_number" value="{{ $claimdetails->claim_id }}" readonly="true" class="form-control" rows="3" tabindex="1">
                             
                           @if ($errors->has('claim_number'))
                          <span class="help-block">{{ $errors->first('claim_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                        <div class="form-group @if($errors->has('loss_date')) has-error @endif">
                        <label for="loss_date">Loss Date & Time</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="loss_date" id="loss_date" placeholder="Select your time" value="{{ $claimdetails->loss_date->format('d-m-Y H:i:s') }}" disabled>
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('loss_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('loss_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>
                      
                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                       <div class="form-group @if($errors->has('notification_date')) has-error @endif">
                        <label for="submit_broker_date"> Notification Date </label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="notification_date" id="notification_date" placeholder="Select your time" value="{{ $claimdetails->date_notified->format('d-m-Y H:i:s') }}" disabled>
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('notification_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('notification_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>

                       <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('status_of_claim') ? ' has-error' : ''}}">
                            <label>Status</label>
                            <select id="status_of_claim" name="status_of_claim" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        
                         <option value="{{ $claimdetails->status }}">{{ $claimdetails->status }}</option>
                        @foreach($status_of_claims as $status_of_claim)
                        <option value="{{ $status_of_claim->type }}">{{ $status_of_claim->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('status_of_claim'))
                          <span class="help-block">{{ $errors->first('status_of_claim') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                       <div class="form-group @if($errors->has('status_change_date')) has-error @endif">
                        <label for="status_change_date">Date of Status</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="status_change_date" id="status_change_date" placeholder="Select your time" value="{{ old('status_change_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('status_change_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('status_change_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                        </div>

                        
                      
                      
                   

                        <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claim_handler') ? ' has-error' : ''}}">
                            <label>Claim Handler</label>
                            <select id="claim_handler" name="claim_handler" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            <option value=" {{ Auth::user()->getNameOrUsername() }}"> {{ Auth::user()->getNameOrUsername() }}</option>
                           
                     @foreach($intermediary as $intermediary)
                        <option value="{{ $intermediary->username }}">{{ $intermediary->username }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('claim_handler'))
                          <span class="help-block">{{ $errors->first('claim_handler') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                       <div class="form-group @if($errors->has('transaction_date')) has-error @endif">
                        <label for="transaction_date">Transaction Date </label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="transaction_date" id="transaction_date" placeholder="Select your time" value="{{ $claimdetails->date_transacted->format('d-m-Y H:i:s')  }}" disabled>
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('transaction_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('transaction_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>

                      
                      </div>
                    </section>


                    @role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
                     <footer class="panel-footer text-right bg-light lter">
                   <input type="hidden" id="master_policy_number" name="master_policy_number" value="{{ $policies->master_policy_number }}">
                    <input type="hidden" id="policy_ref_number" name="policy_ref_number" value="{{ $policies->policy_number }}">
                    <input type="hidden" id="insured" name="insured" value="{{ $policies->fullname }}">
                    <input type="hidden" id="loss_id" name="loss_id" value="{{ $policies->itemid }}">
                    <input type="hidden" id="policy_product" name="policy_product" value="{{ $policies->policy_product }}">
                    <input type="hidden" id="branch" name="branch"  value="{{ $policies->policy_branch }}">
                    <input type="hidden" id="agency" name="agency"  value="{{ $policies->agency }}">
                    <input type="hidden" id="risktype" name="risktype"  value="{{ $fetchrecord->vehicle_risk }}">
                    <input type="hidden" id="coverage" name="coverage"  value="{{ $policies->coverage }}">
                    <input type="hidden" id="period_from" name="period_from"  value="{{ Carbon\Carbon::parse($policies->insurance_period_from)->format('Y-m-d')}}">
                    <input type="hidden" id="period_to" name="period_to"  value="{{ Carbon\Carbon::parse($policies->insurance_period_to)->format('Y-m-d') }}">

                        <button onclick="saveClaim()" class="btn btn-success btn-s-xs">Save</button>
                      </footer>

                      @endrole
                       </div>
                   


                  <div class="tab-pane active" id="loss-information">
                          
                     <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Loss Information
                             </header>
                        <div class="panel-body">

                             


                      <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('loss_cause') ? ' has-error' : ''}}">
                            <label>Cause of Loss</label>
                             <textarea type="text" rows="3" class="form-control" id="loss_cause" name="loss_cause" value="{{ Request::old('loss_cause') ?: '' }}">{{ $claimdetails->cause_of_loss }}</textarea>         
                           @if ($errors->has('loss_cause'))
                          <span class="help-block">{{ $errors->first('loss_cause') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('loss_description') ? ' has-error' : ''}}">
                            <label>Description of Loss</label>
                             <textarea type="text" rows="3" class="form-control" id="loss_description" name="loss_description" value="{{ Request::old('loss_description') ?: '' }}">{{ $claimdetails->loss_description }}</textarea>         
                           @if ($errors->has('loss_description'))
                          <span class="help-block">{{ $errors->first('loss_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                         <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('location_of_loss') ? ' has-error' : ''}}">
                            <label>Location of Loss or Incidence</label>
                             <textarea type="text" rows="3" class="form-control" id="location_of_loss" name="location_of_loss" value="{{ Request::old('location_of_loss') ?: '' }}">{{ $claimdetails->location_of_loss }}</textarea>         
                           @if ($errors->has('location_of_loss'))
                          <span class="help-block">{{ $errors->first('location_of_loss') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          

                        

                          <div class="form-group pull-in clearfix">
                         
                          @if($policies->policy_product == 'Motor Insurance')
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('depreciation_amount') ? ' has-error' : ''}}">
                            <label>TPPDL</label>
                            <input type="number" min="0" step="0.001" readonly="true" class="form-control" name="depreciation_amount" id="depreciation_amount" placeholder="" value="{{ $fetchrecord->vehicle_tppdl_value }}">         
                           @if ($errors->has('depreciation_amount'))
                          <span class="help-block">{{ $errors->first('depreciation_amount') }}</span>
                           @endif    
                          </div>   
                        </div>
                        <div class="col-sm-6">
                        @else
                         <div class="col-sm-12">
                        @endif
                          <div class="form-group{{ $errors->has('excess_amount') ? ' has-error' : ''}}">
                            <label>Excess Amount </label>
                            <div class="input-group">
                             <input type="number" min="0" step="0.001" class="form-control" name="excess_amount" id="excess_amount" placeholder="" value="{{ $excess_charge_rate }}">
                             <span class="input-group-addon">
                            <span class="fa fa-money"></span>
                            </span>         
                           @if ($errors->has('excess_amount'))
                          <span class="help-block">{{ $errors->first('excess_amount') }}</span>
                           @endif    
                          </div>
                          </div>   
                        </div>
                        </div>



{{-- 
                         <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('related_claim_number') ? ' has-error' : ''}}">
                            <label>Related Claim Number</label>
                            <input type="text" class="form-control" name="related_claim_number" id="related_claim_number" placeholder="" value="{{ old('related_claim_number') }}">         
                           @if ($errors->has('related_claim_number'))
                          <span class="help-block">{{ $errors->first('related_claim_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : ''}}">
                            <label>Contact Number </label>
                            <div class="input-group">
                             <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="" value="{{ $insured->mobile_number }}">
                             <span class="input-group-addon">
                           
                            </span>         
                           @if ($errors->has('contact_number'))
                          <span class="help-block">{{ $errors->first('contact_number') }}</span>
                           @endif    
                          </div>
                          </div>   
                        </div>
                        </div>
 --}}


                       



                      

                        <br>

                        <div class="line"></div>

                         <br>
                          <br>

                        <div class="form-group pull-in clearfix">

                        <div class="col-sm-4">
                            <label>Reserve Currency</label> 
                           <input type="text" class="form-control" id="claim_currency" readonly="true" value="{{ $policies->policy_currency }}"  name="claim_currency">
                          @if ($errors->has('vehicle_registration_number'))
                          <span class="help-block">{{ $errors->first('vehicle_registration_number') }}</span>
                           @endif   
                          </div>

                        {{--    <div class="col-sm-4">
                            <label>Our Share % </label> 
                           <input type="number" class="form-control" id="vehicle_value"  value="{{ Request::old('vehicle_value') ?: '' }}"  name="vehicle_value">
                          @if ($errors->has('vehicle_value'))
                          <span class="help-block">{{ $errors->first('vehicle_value') }}</span>
                           @endif   
                          </div>        
                           --}}
                         
                            
                        </div>


                        <div class="form-group pull-in clearfix">

                         <div class="col-sm-4">
                            <label>Gross Reserve  </label> 
                           <input type="text" class="form-control" readonly="true" id="reserve_estimated"  value="{{ number_format($grossreserve->sum('loss_estimate') - $totalunpaid , 2, '.', ',') }}"  name="reserve_estimated">
                          @if ($errors->has('reserve_estimated'))
                          <span class="help-block">{{ $errors->first('reserve_estimated') }}</span>
                           @endif   
                          </div>

                         <div class="col-sm-4">
                            <label>Planned to pay</label> 
                           <input type="text" class="form-control" readonly="true" id="reserve_approved"  value="{{ number_format($totalunpaid - $totalpaid, 2, '.', ',') }}"  name="reserve_approved">
                          @if ($errors->has('reserve_approved'))
                          <span class="help-block">{{ $errors->first('reserve_approved') }}</span>
                           @endif   
                          </div>

                        <div class="col-sm-4">
                            <label>Payment Amount</label> 
                           <input type="text" class="form-control" readonly="true" id="reserve_paid"  value="{{ number_format($totalpaid, 2, '.', ',') }}"  name="reserve_paid">
                          @if ($errors->has('reserve_paid'))
                          <span class="help-block">{{ $errors->first('reserve_paid') }}</span>
                           @endif   
                          </div> 

                          
                         
                        </div>

                           <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                       <div class="form-group @if($errors->has('settlement_date')) has-error @endif">
                        <label for="settlement_date">Settlement Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="settlement_date" id="settlement_date" placeholder="Select your settlement_date" value="{{ old('settlement_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('settlement_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('settlement_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>


                        </div>



                    </section>
                    @role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
                    <footer class="panel-footer text-right bg-light lter">
                        <button onclick="saveClaim()" class="btn btn-success btn-s-xs">Save Details</button>
                      </footer>
                      @endrole
                    
                    
                  </div>
 
                   

                        <div class="tab-pane" id="loss-claimant">
                        <section class="panel panel-default">

                        <div  class="panel-body">


                          <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                           <label> Claimant Type </label>
                           <select id="claimant_type" name="claimant_type" rows="3" tabindex="1" onchange="loadInsuredDetail()" data-placeholder="Select loss adjustment ..." style="width:100%">
                           <option value="">-- Select Claimant Type--</option>
                         @foreach($claimanttypes as $claimant)
                         <option value="{{ $claimant->type }}">{{ $claimant->type }}</option>
                          @endforeach   
                        </select>  
                        
                          </div>
                        </div>



                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <label> Name</label>
                          <div class="m-b">
                           <input type="text" class="form-control" class="text-success" id="claimant_name"  value="{{ Request::old('claimant_name') ?: '' }}"  name="claimant_name">       
                        </div>   
                          </div>
                        </div>


                        
                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('license_number') ? ' has-error' : ''}}">
                            <label>Address</label>
                             <input type="text" class="form-control" class="text-success" id="claimant_address"  value="{{ Request::old('claimant_address') ?: '' }}"  name="claimant_address">       
                           @if ($errors->has('claimant_address'))
                          <span class="help-block">{{ $errors->first('claimant_address') }}</span>
                           @endif    
                          </div>   
                        </div>
                
                        </div>

                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('claimant_phone_number') ? ' has-error' : ''}}">
                            <label>Phone Number</label>
                             <input type="number" class="form-control" class="text-success" id="claimant_phone_number"  value="{{ Request::old('claimant_phone_number ') ?: '' }}"  name="claimant_phone_number">       
                           @if ($errors->has('claimant_phone_number'))
                          <span class="help-block">{{ $errors->first('claimant_phone_number') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : ''}}">
                            <label>Reference Number</label>
                             <input type="text" class="form-control" class="text-success" id="claimant_registration_number"  value="{{ Request::old('claimant_registration_number') ?: '' }}"  name="claimant_registration_number">  
                           @if ($errors->has('claimant_registration_number'))
                          <span class="help-block">{{ $errors->first('claimant_registration_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                      
                        </div>


                       

{{-- 
                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('claimant_notification_date') ? ' has-error' : ''}}">
                            <label>TP Notification Date </label>
                             <input type="text" class="form-control" class="text-success" id="claimant_notification_date"  value="{{ Request::old('claimant_notification_date ') ?: '' }}"  name="years_of_experience">       
                           @if ($errors->has('claimant_notification_date'))
                          <span class="help-block">{{ $errors->first('claimant_notification_date') }}</span>
                           @endif    
                          </div>   
                        </div>
                         



                         
                        </div>
 --}}

{{-- 
                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('claimant_status') ? ' has-error' : ''}}">
                            <label>Claims Status </label>
                              <select id="claimant_status" name="claimant_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        
                         
                        @foreach($status_of_claims as $status_of_claim)
                        <option value="{{ $status_of_claim->type }}">{{ $status_of_claim->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('claimant_status'))
                          <span class="help-block">{{ $errors->first('claimant_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : ''}}">
                            <label>Cause of Status </label>
                             <input type="text" class="form-control" class="text-success" id="claimant_status_cause"  value="{{ Request::old('claimant_status_cause') ?: '' }}"  name="claimant_status_cause">  
                           @if ($errors->has('claimant_status_cause'))
                          <span class="help-block">{{ $errors->first('claimant_status_cause') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('claimant_status_date') ? ' has-error' : ''}}">
                            <label>Status Date</label>
                             <input type="text" class="form-control" class="text-success" id="claimant_status_date"  value="{{ Request::old('claimant_status_date') ?: '' }}"  name="claimant_status_date">  
                           @if ($errors->has('claimant_status_date'))
                          <span class="help-block">{{ $errors->first('claimant_status_date') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
 --}}

                       
                            

                        </div>
                        
                        @role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
                         <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="saveClaimant()" class="btn btn-success btn-s-xs">Add Claimant</button>
                      </footer>
                      @endrole

                      
                    </section> 


                        <section class="panel panel-info">
                        <img src="/images/864501.svg" width="7%" align="right"> 
                                <header class="panel-heading font-bold">Registered Claimant(s)</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="claimantsTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Claimant Type</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Reference</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                          
                    </div>
                    </div>

                      </section>
                  </div>




                      <div class="tab-pane" id="claim-payments">
                      <section class="panel panel-default">
                      <div class="panel-body">
                        

                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Vourcher Info
                    </header>
                      <div class="panel-body">
                        

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pv_number') ? ' has-error' : ''}}">
                            <label>Payment Voucher Number</label>
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
                            <select id="pv_payee_name" name="pv_payee_name" onchange="loadPVamount()" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" >
                        <option value=""> -- Please select claimant -- </option>
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
                            <input type="text" rows="3" class="form-control"  id="pv_amount" name="pv_amount" value="{{ Request::old('pv_amount') ?: '' }}">      
                           @if ($errors->has('pv_amount'))
                          <span class="help-block">{{ $errors->first('pv_amount') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('pv_description') ? ' has-error' : ''}}">
                            <label>On Account Of</label>
                            <input type="text" rows="3" class="form-control" id="pv_description" data-required="true" name="pv_description" value="Payment of claim">      
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
                         
                     @role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="saveVoucher()" class="btn btn-success btn-s-xs">Generate PV</button>
                      </footer>
                      @endrole

                    </section>
                     <img src="/images/951846.svg" width="7%" align="right"> 
                        <section class="panel panel-danger">
                                <header class="panel-heading font-bold">Payment Vouchers Generated </header> 
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
                                             <th>Generated On</th>
                                            <th>Generated By</th>
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

               {{--      <section class="panel panel-info">
                                <header class="panel-heading font-bold">Payments Made</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                           <th>Receipt #</th>
                                            <th>Date</th>
                                            <th>Currency</th>
                                            <th>Premium</th>
                                            <th>Amount</th>
                                             <th>Receipt Date</th>
                                            <th>Status</th>
                                            <th>Generated By</th>
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
                                   @endforeach 
                                      </tbody>
                                    </table>
                    </div>
                    </div>
                    </section> --}}
                  </div>





                        <div class="tab-pane" id="loss-debits">
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



                  <div class="tab-pane" id="loss-report">
                         
                     <form method="post" action="/add-liability-report">
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Liability Report</header>
                                <div class="panel-body">
                                      <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        
                       <textarea id="liability_report" name="liability_report"> {!! $liabiltyreport->liability_report !!} </textarea>
                       
                      </div>
                      </div>

                                </div>
                                </section>

                               @role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
                        <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save Report</button>
                         <input type="hidden" name="_token" value="{{ Session::token() }}">
                         <input type="hidden" name="current_claim" id="current_claim" value="{{ $claimdetails->claim_id }}">
                      </footer>
                      @endrole

                      </form>
                  </div>


                   <div class="tab-pane" id="loss-memo">
                         
                     <form method="post" action="/add-liability-memo">
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Claim Memo</header>
                                <div class="panel-body">
                                      <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        
                       <textarea id="liability_memo" name="liability_memo"> {!! $liabiltymemo->memo !!} </textarea>
                       
                      </div>
                      </div>

                                </div>
                                </section>

                               
                                <footer class="panel-footer text-right bg-light lter">

                        <button type="submit" class="btn btn-success btn-s-xs">Save Report</button>
                         <input type="hidden" name="_token" value="{{ Session::token() }}">
                         <input type="hidden" name="current_claim_memo" id="current_claim_memo" value="{{ $claimdetails->claim_id }}">

                      </footer>
                      </form>
                              </div>

                  <div class="tab-pane" id="claim-adjustment">
                      

                      <div class="panel-body">
                          
                          <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                           <label>Claimant</label>
                        
                           <select id="adjustor_type" name="adjustor_type" rows="3" tabindex="1" data-placeholder="Select loss adjustment ..." style="width:100%">
                          
                         
                        </select> 
                        
                          </div>
                        </div>


                         {{-- <div class="form-group pull-in clearfix">
                         
                         
                         <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('loss_description') ? ' has-error' : ''}}">
                            <label>Loss / Damage Description </label>
                            <textarea type="text" rows="3" class="form-control" id="loss_description" name="loss_description" value="{{ Request::old('loss_description') ?: '' }}">{{ $claimdetails->loss_description }}</textarea> 
                           @if ($errors->has('loss_description'))
                          <span class="help-block">{{ $errors->first('loss_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div> --}}

                           <div class="form-group pull-in clearfix">
                         
                         

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('nature_of_loss') ? ' has-error' : ''}}">
                            <label>Nature of loss </label>
                            <select id="nature_of_loss" name="nature_of_loss" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                             <option value="">-- Not set --</option>
                          @foreach($loss_causes as $loss_cause)
                        <option value="{{ $loss_cause->type }}">{{ $loss_cause->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('nature_of_loss'))
                          <span class="help-block">{{ $errors->first('nature_of_loss') }}</span>
                           @endif    
                          </div>  
                          </div> 
                        </div>

                        <br>
                        <br>

                          
                          @if($policies->policy_product == 'Bond Insurance')
                        <div class="tab-pane" id="object_list">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                     
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="1" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <td></td>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Interest</th>
                            <th>Sum Insured</th>
                            <th>Premium</th>
                            <th></th>
                             
                          </tr>
                        </thead>
                        <tbody>
                        
                         @foreach($objects as $keys => $object)
                         <tr>
                         <td> {{ ++$keys }}</td>
                        <td>{{ $object->bond_risk_type }}</td>
                        <td>{{ $object->bond_contract_description }}</td>
                        <td>{{ $object->bond_interest }}</td>
                        <td>{{ number_format($object->bond_sum_insured, 2, '.', ',') }}</td>
                        <td>{{ number_format($object->premium_due, 2, '.', ',') }}</td>
                        <td>
                            <input type="checkbox" id="{{ $object->id }}" value="{{ $object->id }}" price="{{ $object->bond_sum_insured }}" onchange="computeRiskValue()" />
                        </td>
                      
                          
                        </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>
                        @elseif($policies->policy_product == 'Fire Insurance')
                        <div class="tab-pane" id="object_list">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                     
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="1" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <td></td>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Sum Insured</th>
                            <th>Premium</th>
                            <th></th>
                             
                          </tr>
                        </thead>
                        <tbody>
                        
                         @foreach($objects as $keys => $object)
                         <tr>
                         <td>  {{ ++$keys }}</td>
                        <td>{{ $object->property_type }}</td>
                        <td>{{ $object->property_description }}</td>
                        <td>{{ number_format($object->item_value, 2, '.', ',') }}</td>
                        <td>{{ number_format($object->premium_payable, 2, '.', ',') }}</td>
                        <td>
                            <input type="checkbox" checked id="{{ $object->id }}" value="{{ $object->id }}" price="{{ $object->item_value }}" onchange="computeRiskValue()" />
                        </td>
                      
                          
                        </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>
                        @elseif($policies->policy_product == 'Engineering Insurance')
                        <div class="tab-pane" id="object_list">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                     
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <td></td>
                            <th>Interest</th>
                            <th>Description</th>
                            <th>Sum Insured</th>
                            <th>Premium</th>
                            <th></th>
                             <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        
                         @foreach($objects as $keys => $object)
                         <tr>
                         <td> {{ ++$keys }}</td>
                        <td>{{ $object->car_parties }}</td>
                        <td>{{ $object->car_contract_description }}</td>
                        <td>{{ $object->car_contract_sum }}</td>
                        <td>{{ $object->car_premium_payable }}</td>
                        <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-eye"></i></a>
                        </td>
                         <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                        </td>
                          
                        </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>
                        @elseif($policies->policy_product == 'Marine Insurance')
                        <div class="tab-pane" id="object_list">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                     
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <td></td>
                            <th>Vogage</th>
                            <th>Interest</th>
                            <th>Vessel</th>
                            <th>Sum Insured</th>
                            <th>Premium</th>
                            <th></th>
                             <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        
                         @foreach($objects as $keys => $object)
                         <tr>
                         <td> {{ ++$keys }}</td>
                        <td>{{ $object->marine_voyage }}</td>
                        <td>{{ $object->marine_interest }}</td>
                        <td>{{ $object->marine_vessel }}</td>
                        <td>{{ $object->marine_sum_insured }}</td>
                        <td>{{ $object->premium_payable }}</td>
                        <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-eye"></i></a>
                        </td>
                         <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                        </td>
                          
                        </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>

                        @elseif($policies->policy_product == 'General Accident Insurance')
                        <div class="tab-pane" id="object_list">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                      <a href="#attach_document" class="bootstrap-modal-form-open" data-toggle="modal"><span class="label bg-success pull-right">Add New</span></a>
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <td></td>
                            
                            <th>Description</th>
                            
                            <th>Sum Insured</th>
                            <th>Premium</th>
                            <th></th>
                             <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        
                         @foreach($objects as $keys => $object)
                         <tr>
                         <td> {{ ++$keys }}</td>
                        
                        <td>{{ $object->accident_description }}</td>
                        
                        <td>{{ $object->general_accident_sum_insured }}</td>
                        <td>{{ $object->PREMIUM }}</td>
                        <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-eye"></i></a>
                        </td>
                         <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                        </td>
                          
                        </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>
                        @else

                        @endif



                        <br>
                        <br>
                       


                        


                        
                          <div class="form-group pull-in clearfix">

                           <div class="col-sm-4">
                            <label>Reserve Currency</label> 
                           <input type="text" class="form-control" id="claim_currency" readonly="true" value="{{ $policies->policy_currency }}"  name="claim_currency">
                          @if ($errors->has('claim_currency'))
                          <span class="help-block">{{ $errors->first('claim_currency') }}</span>
                           @endif   
                          </div>

                           <div class="col-sm-4">
                            <label>Sum Insured</label> 
                           <input type="text" class="form-control" id="sum_insured" readonly="true" value="{{ number_format($fetchrecord->vehicle_value, 2, '.', ',') }}"  name="sum_insured">
                          @if ($errors->has('sum_insured'))
                          <span class="help-block">{{ $errors->first('sum_insured') }}</span>
                           @endif   
                          </div>

                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('loss_estimate') ? ' has-error' : ''}}">
                            <label>O/S Reserve <sup class="text-danger"> <i class="fa fa-asterisk text-danger"></i> </sup> </label>
                             <input type="number" min="0" step="0.001" class="form-control" class="text-success" id="loss_estimate"  value="{{ Request::old('loss_estimate ') ?: '' }}"  name="loss_estimate">       
                           @if ($errors->has('loss_estimate'))
                          <span class="help-block">{{ $errors->first('loss_estimate') }}</span>
                           @endif    
                          </div>   
                        </div>

                         


                     {{--      <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('loss_approved') ? ' has-error' : ''}}">
                            <label>Planned to Pay</label>
                             <input type="number" min="0" step="0.001" class="form-control" class="text-success" id="loss_approved"  value="{{ Request::old('loss_approved') ?: '' }}"  name="loss_approved">  
                           @if ($errors->has('loss_approved'))
                          <span class="help-block">{{ $errors->first('loss_approved') }}</span>
                           @endif    
                          </div>   
                        </div>


                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('loss_approved') ? ' has-error' : ''}}">
                            <label>Already Paid</label>
                             <input type="number" min="0" step="0.001" class="form-control" class="text-success" id="loss_approved"  value="{{ Request::old('loss_approved') ?: '' }}"  name="loss_approved">  

                            
                           @if ($errors->has('loss_approved'))
                          <span class="help-block">{{ $errors->first('loss_approved') }}</span>
                           @endif    
                          </div>   
                        </div> --}}
                        </div>


                        
                     @role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addadjustor()" class="btn btn-success btn-s-xs">Add Reserve</button>
                      </footer>
                      @endrole


                      </div>
                     <img src="/images/814410.svg" width="7%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Reserves</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                      <table id="adjustorTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                          
                              <th>Claimant</th>
                              <th>Nature of Loss</th>
                              <th>Estimate</th>
                              <th>Approved</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>
                    </section>
                  </div>

                   <div class="tab-pane" id="loss-risk-details">
                        <section class="panel panel-default">
                      <div class="panel-body">
                         <div class="row">

               <div class="col-sm-12 portlet ui-sortable">
               @if($policies->policy_product=='Motor Insurance')
              <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 Motor Details
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                   Registration Number : {{ $fetchrecord->vehicle_registration_number }}
                  </a>

                   <a href="#" class="list-group-item">
                   Sum Insured : {{ $fetchrecord->vehicle_value }}
                  </a>

                   <a href="#" class="list-group-item">
                   Risk Type : {{ $fetchrecord->vehicle_risk }}
                  </a>


                   <a href="#" class="list-group-item">
                   Excess : {{ $fetchrecord->vehicle_buy_back_excess }}
                  </a>


                   <a href="#" class="list-group-item">
                   Cover Type : {{ $fetchrecord->vehicle_cover }}
                  </a>

                   <a href="#" class="list-group-item">
                    Make : {{ $fetchrecord->vehicle_make }}
                  </a>

                   <a href="#" class="list-group-item">
                    Model :  {{ $fetchrecord->vehicle_model }}
                  </a>

                   <a href="#" class="list-group-item">
                   Body Type : {{ $fetchrecord->vehicle_body_type }}
                  </a>


                   <a href="#" class="list-group-item">
                   Cubic Capacity : {{ $fetchrecord->vehicle_cubic_capacity }}
                  </a>

                   <a href="#" class="list-group-item">
                   Year of Make : {{ $fetchrecord->vehicle_make_year }}
                  </a>

                   <a href="#" class="list-group-item">
                   Chassis Number : {{ $fetchrecord->vehicle_chassis_number }}
                  </a>

                   <a href="#" class="list-group-item">
                   Seating Capacity : {{ $fetchrecord->vehicle_seating_capacity }}
                  </a>

                   <a href="#" class="list-group-item">
                   LogBook Number : {{ $fetchrecord->logbook_no }}
                  </a>

                   <a href="#" class="list-group-item">
                   Trailer Number : {{ $fetchrecord->trailer_no }}
                  </a>

                


                </div>
              </section>
              @elseif($policies->policy_product=='Bond Insurance')
                 <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 Bond Details
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                   Risk Type : {{ $fetchrecord->bond_risk_type }}
                  </a>

                   <a href="#" class="list-group-item">
                   Interest Name : {{ $fetchrecord->bond_interest }}
                  </a>

                    <a href="#" class="list-group-item">
                   Interest Address : {{ $fetchrecord->bond_interest_address }}
                  </a>

                   <a href="#" class="list-group-item">
                  Contract Sum : {{ $fetchrecord->contract_sum }}
                  </a>

                   <a href="#" class="list-group-item">
                   Sum Insured : {{ $fetchrecord->bond_sum_insured }}
                  </a>

                  <a href="#" class="list-group-item">
                   Bond Description : {{ $fetchrecord->bond_contract_description }}
                  </a>

                  <a href="#" class="list-group-item">
                   Created By : {{ $fetchrecord->created_by }}
                  </a>

                  <a href="#" class="list-group-item">
                   Created On : {{ $fetchrecord->created_on }}
                  </a>
                </div>
              </section>

              @elseif($policies->policy_product=='Engineering Insurance')
                 <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 Bond Details
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                   Risk Type : {{ $fetchrecord->car_risk_type }}
                  </a>

                   <a href="#" class="list-group-item">
                   Interest Name : {{ $fetchrecord->car_parties }}
                  </a>

                    <a href="#" class="list-group-item">
                   Interest Address : {{ $fetchrecord->car_nature_of_business }}
                  </a>

                   <a href="#" class="list-group-item">
                  Contract Sum : {{ $fetchrecord->car_contract_sum }}
                  </a>

                  <a href="#" class="list-group-item">
                   Bond Description : {{ $fetchrecord->car_contract_description }}
                  </a>

                  <a href="#" class="list-group-item">
                   Created By : {{ $fetchrecord->created_by }}
                  </a>

                  <a href="#" class="list-group-item">
                   Created On : {{ $fetchrecord->created_on }}
                  </a>
                </div>
              </section>
              @else

              @endif
              </div>






              

               

          
    
              </div>

                      </div>
                   
                    </section>
                  </div>


                  <div class="tab-pane" id="loss-documents">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                      <a href="#attach_document" class="bootstrap-modal-form-open" data-toggle="modal"><span class="label bg-success pull-right">Add New</span></a>
                      
                    </header>
                          <div class="row">
                  

                     
                     @foreach($images as $keys => $image)
                   

                   <div class="col-md-3 col-sm-4 thumb-lg">
  
                    @if($image->mime == 'docx')
                   <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/images/ms_word.png' !!}" class="img-circle">
                              </a>  {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @elseif($image->mime == 'pdf')
                     <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/images/pdf.png' !!}" class="img-circle">
                              </a>{{ $image->filename }} <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a> <span class="label label-default btn-rounded">{{ Carbon\Carbon::parse($image->created_on)->diffForHumans()}}</span>
                      @else 
                     <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-circle">
                              </a> {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @endif        
                      </div>
                    @endforeach


                    </div>
                          </ul>
                        </div>

                   <div class="tab-pane" id="loss-drivers">
                        <section class="panel panel-default">

                        <div  class="panel-body">
                                   <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                           <label>Drive Name</label>
                          <div class="m-b">
                           <input type="text" class="form-control" class="text-success" id="driver_name"  value="{{ Request::old('driver_name ') ?: '' }}"  name="driver_name">       
                        </div>   
                          </div>
                        </div>


                        
                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('license_number') ? ' has-error' : ''}}">
                            <label>License Number</label>
                             <input type="text" class="form-control" class="text-success" id="license_number"  value="{{ Request::old('license_number ') ?: '' }}"  name="license_number">       
                           @if ($errors->has('license_number'))
                          <span class="help-block">{{ $errors->first('license_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : ''}}">
                            <label>Date of Birth</label>
                             <input type="text" class="form-control" class="text-success" id="date_of_birth"  value="{{ Request::old('date_of_birth') ?: '' }}"  name="date_of_birth">  

                            
                           @if ($errors->has('date_of_birth'))
                          <span class="help-block">{{ $errors->first('date_of_birth') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('years_of_experience') ? ' has-error' : ''}}">
                            <label>Year(s) of Experience</label>
                             <input type="number" class="form-control" class="text-success" id="years_of_experience"  value="{{ Request::old('years_of_experience ') ?: '' }}"  name="years_of_experience">       
                           @if ($errors->has('years_of_experience'))
                          <span class="help-block">{{ $errors->first('years_of_experience') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : ''}}">
                            <label>Marital Status</label>
                             <input type="text" class="form-control" class="text-success" id="marital_status"  value="{{ Request::old('marital_status') ?: '' }}"  name="marital_status">  
                           @if ($errors->has('marital_status'))
                          <span class="help-block">{{ $errors->first('marital_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('gender') ? ' has-error' : ''}}">
                            <label>Gender</label>
                             <input type="text" class="form-control" class="text-success" id="gender"  value="{{ Request::old('gender ') ?: '' }}"  name="gender">       
                           @if ($errors->has('gender'))
                          <span class="help-block">{{ $errors->first('gender') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('dip') ? ' has-error' : ''}}">
                            <label>DIP</label>
                             <input type="text" class="form-control" class="text-success" id="dip"  value="{{ Request::old('dip') ?: '' }}"  name="dip">  

                            
                           @if ($errors->has('dip'))
                          <span class="help-block">{{ $errors->first('dip') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                            

                        </div>

                         <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addDriver()" class="btn btn-success btn-s-xs">Add Driver</button>
                      </footer>

                      
                    </section> 


                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Named Driver(s)</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="driverTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Driver Name</th>
                              <th>License Number</th>
                              <th>Date of Birth</th>
                              <th>Created On</th>
                              <th>Cretaed By</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                          
                    </div>
                    </div>

                      </section>
                  </div>
 

                     <div class="tab-pane" id="loss-cessions">
                         <section class="panel panel-default">
                      
                    </section> 


                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">FAC XOL - Claim Apportionment</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="paymentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                            <th>Cession Year </th>
                            <th>Cession Number </th>
                            <th>Object # </th>
                            <th>Reinsurer </th>
                            <th>FAC Offer</th>
                            <th>Share %</th>
                           
                            <th>Status</th>
                             <th>Claim Share Payable</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($cessions as $cession )
                                    <tr>
                                       <td><a href="#">{{ Carbon\Carbon::parse($cession->period_from)->year }}</a></td>
                                       <td><a href="/view-cession/{{ $cession->cession_number }}">{{ $cession->cession_number }}</a></td>
                                        <td><a href="/view-cession/{{ $cession->cession_number }}">{{ $cession->item_id }}</a></td>
                                        <td>{{ $cession->reinsurer_broker }}</td>
                                        <td>{{ $cession->facultaive_offer }}</td>
                                        <td>{{ $cession->facultative_percentage }}</td>
                                        <td>{{ $cession->status }}</td>
                                        <td>{{ $cession->facultative_percentage/100 * $claimdetails->reserve_approved }}</td>
                                       
                                        
                                      </tr>
                                   @endforeach 
                          </tbody>
                        </table>
                          
                    </div>
                    </div>

                      </section>


                       <section class="panel panel-info">
                                <header class="panel-heading font-bold">Treaty XOL - Claim Apportionment</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="paymentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                            <th>Cession Year </th>
                            <th>Cession Number </th>
                            <th>Object # </th>
                            <th>Cedant Retention </th>
                            <th>1st Layer Recovery</th>
                            <th>2nd Layer Recovery</th>
                           
                            <th>Status</th>
                             <th>Claim Share Payable</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($cessionstreaty as $cessiontreaty )
                                    <tr>
                                       <td><a href="#">{{ Carbon\Carbon::parse($cessiontreaty->period_from)->year }}</a></td>
                                       <td><a href="/view-cession-treaty/{{ $cessiontreaty->cession_number }}">{{ $cessiontreaty->cession_number }}</a></td>
                                        <td><a href="/view-cession-treaty/{{ $cessiontreaty->cession_number }}">{{ $cessiontreaty->item_id }}</a></td>
                                        <td>{{ $cessiontreaty->retention_percentage }} </td>
                                        <td>{{ $cessiontreaty->first_suplus_percentage }}</td>
                                        <td>{{ $cessiontreaty->second_suplus_percentage }}</td>

                                        <td>{{ $cessiontreaty->status }}</td>
                                        <td>{{ $cessiontreaty->first_suplus_percentage/100 * $claimdetails->reserve_approved }}</td>
                                       
                                        
                                      </tr>
                                   @endforeach 
                          </tbody>
                        </table>
                          
                    </div>
                    </div>

                      </section>



                      <section>
                        
                        <div id="nonmotorcharges" name="nonmotorcharges">
                          
                          <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th></th>
                              <th>Amount</th>
                           
                            </tr>
                          </thead>
                          <tbody>

                          <tr>
                          <td>Reserve</td>
                          <td>
                            <input type="text" class="form-control" readonly="true"  value="0" id="suminsured_2" name="suminsured_2"> 
                        
                          </td>
                          </tr>



                         


                          <tr>
                          <td>Depreciation</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="0" id="discount_2" name="discount_2"> 
                          </td>
                          </tr>

                           <tr>
                          <td>Excess</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="1.5" id="stamp_fee" name="stamp_fee"> 
                          </td>
                          </tr>


                          <tr>
                          <td>Survey Fees & Towing Fees</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="0" id="fee" name="fee"> 
                          </td>
                           
                          </tr>

                             <tr>
                          <td>Net Claim Amount</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="0" id="fee" name="fee"> 
                          </td>
                           
                          </tr>


                           <tr>
                          <td>Salvage</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="0" id="tax" name="tax"> 
                          </td>
                           
                          </tr>

                           <tr>
                          <td>Fac Recovery</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="" id="tax" name="tax"> 
                          </td>
                           
                          </tr>


                            <tr>
                          <td>Retention Recovery</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="" id="tax" name="tax"> 
                          </td>
                           
                          </tr>

                           <tr>
                          <td>1st Layer Recovery</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="" id="tax" name="tax"> 
                          </td>
                           
                          </tr>

                           <tr>
                          <td>2nd Layer Recovery</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="" id="tax" name="tax"> 
                          </td>
                           
                          </tr>




                         
                          
                   
                          </tbody>
                        </table>

                        </div>
                      </section>
                  </div>

 

                    <div class="tab-pane" id="cession-payments">
                         <section class="panel panel-default">
                      
                    </section> 


                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Registered Claimant</header>
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
                          
                    </div>
                    </div>

                      </section>
                  </div>



                  
                

                 

                      </div>
                    </section>
                  </section>
                  
                </aside>


    
                    </section>
                    </section>
                    </section>



  @stop

  <div class="modal fade" id="attach_document" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Attach Document</h4>
        </div>

        <div class="modal-body">
         <div class="fallback">
          <form method="post"  enctype="multipart/form-data" action="/upload-claims-files">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="policy_number" id="policy_number" value="{{ $policies->policy_number }}">
          <input type="hidden" name="item_id" id="item_id" value="{{ $claimdetails->claim_id }}">
        </form>
        </div>
          <br>
          <br>
          <br>
              <div class="jumbotron how-to-create">
                <ul>
                    <li>Documents/Images are uploaded as soon as you drop them</li>
                    <li>Maximum allowed size of image is 8MB</li>
                </ul>

            </div>

      </div>
      </div>
      </div>
      </div>


   <div class="modal fade" id="make-payment" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Make Payment On Voucher</h4>
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
                           <form  class="bootstrap-modal-form"  data-validate="parsley" method="post" action="/make-claim-payment">
                             @include('claims/payment')

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


<script src="{{ asset('/js/tinymce/tinymce.min.js')}}"></script>
 
 <script>tinymce.init({
  selector: '#liability_report',
  height: 500,
  menubar: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount',
    'template'
  ],
  toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  templates: [
    //{title: 'Some title 1', description: 'Some desc 1', content: 'My content  {$bond_description}'},
    {title: 'Advance Payment Bond', description: 'Some desc 2', url: 'http://127.0.0.1:8000/bond-test'}
  ],
  template_replace_values: {
    bond_description: "{{ $claimdetails->claim_id }}",
    staffid: "991234"
  }

  

});
 </script>


  <script>tinymce.init({
  selector: '#liability_memo',
  height: 500,
  menubar: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount',
    'template'
  ],
  toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  templates: [
    //{title: 'Some title 1', description: 'Some desc 1', content: 'My content  {$bond_description}'},
    {title: 'Advance Payment Bond', description: 'Some desc 2', url: 'http://127.0.0.1:8000/bond-test'}
  ],
  template_replace_values: {
    bond_description: "{{ $claimdetails->claim_id }}",
    staffid: "991234"
  }

  

});
 </script>

{{-- 
<script type="text/javascript">
        $(window).on("beforeunload", function() {
          //swal ("Are you sure? You didn't finish the form!");
            return "Are you sure? You didn't finish the form!";

        });
        
        $(document).ready(function() {
            $("#masterform").on("submit", function(e) {
                //check form to make sure it is kosher
                //remove the ev
                $(window).off("beforeunload");
                return true;
            });
        });
</script> 
      
 --}}

<script type="text/javascript">
  

function generateClaimNumber()
  {

    //alert('hello');

     if($('#claim_number').val()=="")
     {
        $.get('/generate-claimnumber-new',
        {

        
       
          "policy_product": $('#policy_product').val(),
          

        },
        function(data)
        { 
          
          $.each(data, function (key, value) 
          { 
            //sweetAlert("Policy : ", data["policy_number"], "info");
          $('#claim_number').val(data.claim_number);

           });
                                        
        },'json');
     }

     else
     {

     }

  }

@role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
function saveClaim()
{

 //generateClaimNumber();
//alert($('#period_from').val());

if($('#claim_number').val()!= "")
{

    $.get('/update-new-claim',
        {



          "claim_number"               :$('#claim_number').val(),
           "policy_number"              :$('#master_policy_number').val(),
          "reference_number"            :$('#policy_number').val(),
          "loss_id"                     :$('#loss_id').val(),
          "status_of_claim"             :$('#status_of_claim').val(),
          "insured"                     :$('#insured').val(),
          "loss_date"                   :$('#loss_date').val(),
          "notification_date"           :$('#notification_date').val(),
          "status_change_date"          :$('#status_change_date').val(),
          "settlement_date"             :$('#settlement_date').val(),
          "claim_handler"               :$('#claim_handler').val(),
          "policy_product"              :$('#policy_product').val(),
          "claim_handler"               :$('#claim_handler').val(),
          "policy_product"              :$('#policy_product').val(),
          "loss_amount"                 :$('#loss_amount').val(),
          "excess_amount"               :$('#excess_amount').val(),
          "depreciation_amount"         :$('#depreciation_amount').val(),
          "salvage_amount"              :$('#salvage_amount').val(),
          "survey_tow_amount"           :$('#survey_tow_amount').val(),

          "location_of_loss"            :$('#location_of_loss').val(),
           "loss_cause"                  :$('#loss_cause').val(),
          "loss_description"            :$('#loss_description').val(),  
         

          "related_claim_number"        :$('#related_claim_number').val(),
          "contact_number"              :$('#contact_number').val(),
          "claim_currency"              :$('#claim_currency').val(),
          "reserve_estimated"           :$('#reserve_estimated').val(),
          "reserve_approved"            :$('#reserve_approved').val(),
          "reserve_paid"                :$('#reserve_paid').val(),

          "branch"                      :$('#branch').val(),
          "coverage"                    :$('#coverage').val(),
          "risktype"                    :$('#risktype').val(),
           "period_from"                 :$('#period_from').val(),
          "period_to"                   :$('#period_to').val(),
          "agency"                      :$('#agency').val()
          

            },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
         toastr.success("Claim successfully generated!"); 
          
        
        }
        else
        {
         toastr.error("Claimed failed to save!"); 
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Some fields not have no value!");}
         
}


function saveClaimant()
{

if($('#claim_number').val()!= "" && $('#claimant_name').val()!= "")
{

    $.get('/add-new-claimant',
        {



          "claim_number"                :$('#claim_number').val(),
          "policy_number"               :$('#policy_number').val(),
          "claimant_type"               :$('#claimant_type').val(),
          "claimant_name"               :$('#claimant_name').val(),
          "claimant_address"            :$('#claimant_address').val(),
          "claimant_phone_number"       :$('#claimant_phone_number').val(),
          "claimant_registration_number":$('#claimant_registration_number').val(),
          "claimant_notification_date"  :$('#claimant_notification_date').val(),
          "claimant_status_date"        :$('#claimant_status_date').val(),
          "claimant_agreed_date"        :$('#claimant_agreed_date').val(),
          "claimant_offer_date"         :$('#claimant_offer_date').val(),
          "claimant_status"             :$('#claimant_status').val(),
          "claimant_status_cause"       :$('#claimant_status_cause').val()
          

          

            },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
         toastr.success("Claimant successfully saved!"); 
          
        loadClaimants();
        loadPVClaimant();
        loadItemClaimant();

        $('#claimant_name').val('');
        $('#claimant_address').val('');
        $('#claimant_phone_number').val('');
        $('#claimant_registration_number').val('');
        }
        else
        {
         toastr.error("Claimant failed to save!"); 
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Some fields not have no value!");}
         
}

function saveVoucher()
{

if($('#claim_number').val()!= "" && $('#pv_payee_name').val()!= "")
{

    $.get('/add-new-voucher',
        {

          "claim_number"  :$('#claim_number').val(),
          "pv_number"     :$('#pv_number').val(),
          "pv_payee_name"    :$('#pv_payee_name').val(),
          "pv_payment_mode"  :$('#pv_payment_mode').val(),
          "pv_payment_source":$('#pv_payment_source').val(),
          "pv_cheque_number" :$('#pv_cheque_number').val(),
          "pv_cheque_date"   :$('#pv_date').val(),
          "pv_description"   :$('#pv_description').val(),
          "pv_currency"      :$('#claim_currency').val(),
          "pv_amount"        :$('#pv_amount').val()
          
        },
        
        function(data)
        { 
          
        $.each(data, function (key, value) {
        if(data["OK"])
        {
         
         toastr.success("Payment Voucher successfully saved!"); 
         loadPaymentVoucher();

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


function saveLiabiltyReport()
{

if($('#claim_number').val()!= "")
{

    //alert($('#liability_report').val());

    $.get('/add-liability-report',
        {

          "claim_number"          :$('#claim_number').val(),
          "liability_report"       :$('#liability_report').val()
          
        
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
         toastr.success("Report successfully saved!"); 
       
        }
        else
        {
         toastr.error("Report failed to save!"); 
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("No claim number has been generated yet!");}
         
}


@endrole

</script>

<script type="text/javascript">



$(document).ready(function () {
   
    
     
   loadAdjustments();
   loadDrivers();
   loadClaimants();
   loadPVClaimant();
   loadItemClaimant();
   loadPaymentVoucher();
   //loadInsuredDetail();

     $('#claimant_type').select2({
      tags: true
      });

  

     $('#pv_payee_name').select2();

     $('#adjustor_type').select2();

     $('#nature_of_loss').select2();

    
  });
</script>


<script type="text/javascript">
$(function () {
  $('#loss_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
     "maxDate": moment(),
    "singleDatePicker":true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 1,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
  $('#transaction_date').daterangepicker({
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
  $('#notification_date').daterangepicker({
     "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
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
  $('#status_change_date').daterangepicker({
     "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
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
  $('#settlement_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
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
  $('#claimant_status_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
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
  $('#claimant_agreed_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
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
  $('#claimant_offer_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
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
  $('#claimant_notification_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
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
  $('#pv_date').daterangepicker({
    "minDate": moment(),
    "maxDate": moment(),
    "singleDatePicker":true,
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


function computeRiskValue()
{
//   var _total = 0;
// $('input[type="checkbox"]').change(function() {
//   if($(this).is(':checked')){
//   _total += parseFloat($(this).attr('price')) || 0;
//   }
// else{
//   _total -= parseFloat($(this).attr('price')) || 0;
// }
// $('#sum_insured').val(_total);
// })

$('input:checkbox').change(function(){
var totalprice=0;
$('input:checkbox:checked').each(function(){
totalprice+= parseFloat($(this).attr('price'));
});
$('#sum_insured').val(totalprice)
});

}


@role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
function addadjustor()
{
if($('#adjustor_type').val()!= "" && $('#loss_estimate').val()!= 0)
{

    $.get('/add-loss-adjustment',
        {
          "claim_number": $('#claim_number').val(),
          "adjustor_type": $('#adjustor_type').val(),
          "loss_estimate": $('#loss_estimate').val(),
          "loss_approved": $('#loss_estimate').val(),
          "nature_of_loss"   :$('#nature_of_loss').val()         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadAdjustments();


        $('#adjustor_type').val('');
        $('#loss_estimate').val('');
        $('#loss_approved').val('');
        $('#nature_of_loss').val('');

        
        }
        else
        {
          sweetAlert("Loss adjustments failed to add!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please fill all required field!");}
}
@endrole


function addDriver()
{
if($('#driver_name').val()!= "" && $('#claim_number').val())
{

    $.get('/add-loss-driver',
        {
          "claim_number":        $('#claim_number').val(),
          "driver_name":         $('#driver_name').val(),
          "license_number":      $('#license_number').val(),
          "date_of_birth":       $('#date_of_birth').val(),
          "years_of_experience": $('#years_of_experience').val(),
          "dip":                 $('#dip').val(),       
          "marital_status":      $('#marital_status').val(),
          "gender":              $('#gender').val()                 
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadDrivers();
        
        }
        else
        {
          sweetAlert("Claimant/Driver failed to add!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please ensure all fields are filled!");}
}


function loadDrivers()
   {
         
        
        $.get('/get-named-drivers',
          {
            "claim_number": $('#claim_number').val()
          },
          function(data)
          { 

            $('#driverTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#driverTable tbody').append('<tr><td>'+ value['driver_name'] +'</td><td>'+ value['license_number'] +'</td><td>'+ value['date_of_birth'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeDriver('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


    function loadClaimants()
   {
         
        
        $.get('/get-claimant',
          {
            "claim_number": $('#claim_number').val()
          },
          function(data)
          { 

            $('#claimantsTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#claimantsTable tbody').append('<tr><td>'+ value['claimant_type'] +'</td><td>'+ value['claimant_name'] +'</td><td>'+ value['claimant_phone_number'] +'</td><td>'+ value['claimant_registration_number'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeClaimant('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


     function loadPaymentVoucher()
   {
         
        
        $.get('/get-payment-voucher',
          {
            "claim_number": $('#claim_number').val()
          },
          function(data)
          { 

            $('#paymentvoucherTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#paymentvoucherTable tbody').append('<tr><td>'+ value['pv_number'] +'</td><td>'+ value['pv_date'] +'</td><td>'+ value['payee_name'] +'</td><td>'+ value['currency'] +'</td><td>'+ value['amount'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td>'+ value['status'] +'</td><td>' + ( value['payment_mode'] == "Cash" ? '<a a href="/print-voucher-slip/'+value['id']+'">' : '<a a href="/print-voucher-slip/'+value['id']+'">' ) + '<i onclick="" class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Voucher"></i></a></td><td><a a href="#"><i onclick="removePV('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a a href="#make-payment" class="bootstrap-modal-form-open" data-toggle="modal"><i onclick="makePayment('+value['id']+')" class="fa fa-money"></i></a></td><td>' + ( value['payment_mode'] == "Cash" ? '<a a href="/discharge-voucher/'+value['id']+'">' : '<a a href="/discharge-voucher/'+value['id']+'">' ) + '<i onclick="" class="fa fa-ticket" data-toggle="tooltip" data-placement="top" title="" data-original-title="Discharge Voucher"></i></a></td></tr>');
            });
                                          
         },'json');      
    }




    function loadPVClaimant()
    {


        $.get('/load-pv-claimant',
          {
            "claim_number": $('#claim_number').val()
          },
          function(data)
          { 

            $('#pv_payee_name').empty();
            $.each(data, function () 
            {           
            $('#pv_payee_name').append($('<option></option>').val(this['claimant_name']).html(this['claimant_name']));
            });
                                          
         },'json');      


    }


    function loadItemClaimant()
    {


        $.get('/load-pv-claimant',
          {
            "claim_number": $('#claim_number').val()
          },
          function(data)
          { 

            $('#adjustor_type').empty();
            $.each(data, function () 
            {           
            $('#adjustor_type').append($('<option></option>').val(this['claimant_name']).html(this['claimant_name']));
            });
                                          
         },'json');      


    }



function loadAdjustments()
   {
         
        
        $.get('/get-loss-adjustments',
          {
            "claim_id": $('#claim_number').val()
          },
          function(data)
          { 

            $('#adjustorTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#adjustorTable tbody').append('<tr><td>'+ value['adjustor_type'] +'</td><td>'+ value['loss_nature'] +'</td><td>'+ value['loss_estimate'] +'</td><td>'+ value['loss_approved'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeAdjustments('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }




// function fetchReinsurerPremium()

// { 

//   $.get("/load-claim-pv-amount",
//           {
//             "cliam_id":$('#cession_number').val(),
//             "reinsurer":$('#pv_payee_name')s.val()
//          },
          
//   function(json)
//           {

//                 $('#pv_amount').val(json.pv_amount);
                
              
               
//              //}
//           },'json').fail(function(msg) {
//           alert(msg.status + " " + msg.statusText);
//         });



// }

@role(['System Admin','Claims Officer','Claims Manager','General Manager Technical','Manager'])
    function removeAdjustments(id)
   {
     
          $.get('/delete-adjustments',
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
               loadAdjustments();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }

    function removeClaimant(id)
   {
     
          $.get('/delete-claimant',
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
               loadClaimants();
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
     
          $.get('/delete-payment-voucher',
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
               loadPaymentVoucher();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }


   function removeDriver(id)
   {
     
          $.get('/delete-claim-driver',
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
               loadDrivers();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }

@endrole

   function makePayment(id)
{ 

  $.get("/load-pv-detail",
          {"id":id},
          
  function(json)
          {
            
                $('#make-payment input[name="payment_amount"]').val(json.payment_amount);
                $('#make-payment input[name="payer_name"]').val(json.payee_name);
                $('#make-payment input[name="payer_id"]').val(json.payer_id);
                $('#make-payment input[name="payment_description"]').val(json.payment_description);
             //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}


function loadInsuredDetail()

{ 

  if($('#claimant_type').val()== "Insured" )
{

  //alert($('#account_number').val());
  $.get("/load-claimant-info",
          {
            "id":$('#account_number').val()
         },
          
  function(json)
          {

                $('#claimant_name').val(json.fullname);
                $('#claimant_address').val(json.postal_address);
                $('#claimant_phone_number').val(json.mobile_number);
                $('#claimant_registration_number').val($('#loss_id').val());
              
               
             //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });



}

else
{
  $('#claimant_name').val('');
  $('#claimant_address').val('');
  $('#claimant_phone_number').val('');
  $('#claimant_registration_number').val('');

}

}





</script>




