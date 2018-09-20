@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
                    <p><span class="label label-success">{{ $policies->itemid }} - {{ $policies->fullname}} </span></p> 
                     <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $policies->status }}</span></p>
                     <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($policies->record_date)->diffForHumans() }}</span></p>

                     <div class="btn-group pull-right">
                    <p>
                    <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $policies->created_by }}   </a>
                   <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $policies->policy_branch }}</a>
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
                            <div class="h3 m-t-xs m-b-xs">{{ $policies->fullname }} </div>
                           
                            {{--  <div class="h6 m-t-xs m-b-xs"><i class="fa fa-fw fa-phone"></i> {{ $insured->mobile_number }} </div>
                             <div class="h6 m-t-xs m-b-xs"> <i class="fa fa-fw fa-home"></i> {{ $insured->postal_address }} </div> --}}


                            <div>
                           <p class="block"><a href="/view-policy/{{ $policies->policy_number }}" class="">POL # </a> <span class="label label-default">{{ $policies->master_policy_number }}</span></p>
                           <p class="block"><a href="/view-policy/{{ $policies->policy_number }}" class="">REF # </a> <span class="label label-danger">{{ $policies->itemid }}</span></p>
                          
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
                            
                             <small class="text-muted">Risk</small>
                          </li>     
                           <li class="list-group-item">
                            <span class="pull-right">{{ $policies->agency }}</span>
                            
                             <small class="text-muted">Agency</small>
                          </li>         
                         
                        </ul>
                         
                          <br>
                          
                          <img src="/images/607623.svg"> 
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
                       
                       {{-- 
                        
                           <li class=""><a href="#loss-information" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Loss Information </a></li>
                            <li class=""><a href="#loss-report" data-toggle="tab"><i class="fa fa-bars text-default"></i> Liability Report </a></li>
                           <li class=""><a href="#loss-risk-details" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Key Risk Details </a></li>
                         
                         <li class=""><a href="#loss-claimant" data-toggle="tab"><i class="fa fa-users text-default"></i> Claimant </a></li>

                         @if($policies->policy_product == 'Motor Insurance')
                            <li class=""><a href="#loss-drivers" data-toggle="tab"><i class="fa fa-puzzle-piece text-default"></i> Named Drivers </a></li>
                          @else
                          @endif
                          <li class=""><a href="#claim-adjustment" data-toggle="tab"><i class="fa fa-gavel text-default"></i>Reserves / Loss Adjustment </a></li>
                          <li class=""><a href="#claim-payments" data-toggle="tab"><i class="fa fa-money text-default"></i> Payments </a></li> 
                          <li class=""><a href="#loss-debits" data-toggle="tab"><i class="fa fa-sort-numeric-asc text-default"></i> Invoices </a></li>
                          <li class=""><a href="#loss-cessions"  data-toggle="tab"><i class="fa fa-retweet text-default"></i> FAC XOL </a></li>
                          <li class=""><a href="#review-procedure" data-toggle="tab"><i class="fa fa-tasks text-default"></i> Logs </a></li> 
                          <li class=""><a href="#loss-documents" data-toggle="tab"><i class="fa fa-folder text-default"></i> Documents </a></li> 
 --}}

                         <span class="hidden-sm">.</span>
                      </ul>
                    </header>



                     <div class="panel-body">
                     <div class="tab-content"> 

                   
                      <div class="tab-pane active" id="claim-information">
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
                            <input id="claim_number" name="claim_number" value="" readonly="true" class="form-control" rows="3" tabindex="1">
                             
                           @if ($errors->has('claim_number'))
                          <span class="help-block">{{ $errors->first('claim_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                      
                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                       <div class="form-group @if($errors->has('notification_date')) has-error @endif">
                        <label for="submit_broker_date">Notification Date </label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="notification_date" id="notification_date" placeholder="Select your time" value="{{ old('notification_date') }}">
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

                        <div class="col-sm-6">
                        <div class="form-group @if($errors->has('loss_date')) has-error @endif">
                        <label for="loss_date">Loss Date & Time</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="loss_date" id="loss_date" placeholder="Select your time" value="{{ old('loss_date') }}">
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
                         
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('status_of_claim') ? ' has-error' : ''}}">
                            <label>Status</label>
                            <select id="status_of_claim" name="status_of_claim" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        @foreach($status_of_claim as $status_of_claim)
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

                        
                     {{--     <div class="form-group pull-in clearfix">

                        <div class="col-sm-12">
                            <label>Classification of Claim</label> 
                           <input type="text" class="form-control" id="classification"  value="{{ Request::old('classification') ?: '' }}"  name="classification">
                          @if ($errors->has('classification'))
                          <span class="help-block">{{ $errors->first('classification') }}</span>
                           @endif   
                          </div>
                            
                        </div> --}}
                      
                   

                        <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claim_handler') ? ' has-error' : ''}}">
                            <label>Claim Handler</label>
                            <select id="claim_handler" name="claim_handler" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            <option value=" {{ Auth::user()->getNameOrUsername() }}"> {{ Auth::user()->getNameOrUsername() }}</option>
                           
                     @foreach($intermediary as $intermediary)
                        <option value="{{ $intermediary->username }}">{{ $intermediary->username }}</option>
                          @endforeach --}}
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
                        <input type="text" class="form-control" name="transaction_date" id="transaction_date" placeholder="Select your time" value="{{ old('transaction_date') }}">
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
                    <input type="hidden" id="period_from" name="period_from"  value="{{ $policies->insurance_period_from }}">
                    <input type="hidden" id="period_to" name="period_to"  value="{{ $policies->insurance_period_to }}">

                        <button onclick="saveClaim()" class="btn btn-success btn-s-xs">Register Claim</button>

                       
                      </footer>
                       </div>
                   


                  <div class="tab-pane" id="loss-information">
                          
                     <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Loss Information
                             </header>
                        <div class="panel-body">

                              <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                        <div class="form-group @if($errors->has('loss_date')) has-error @endif">
                        <label for="loss_date">Loss Date & Time</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="loss_date" id="loss_date" placeholder="Select your time" value="{{ old('loss_date') }}">
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

                      <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('loss_cause') ? ' has-error' : ''}}">
                            <label>Cause Of Loss </label>
                            <select id="loss_cause" name="loss_cause" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                             <option value="">-- Not set --</option>
                          @foreach($loss_causes as $loss_cause)
                        <option value="{{ $loss_cause->type }}">{{ $loss_cause->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('loss_cause'))
                          <span class="help-block">{{ $errors->first('loss_cause') }}</span>
                           @endif    
                          </div>   
                        </div>
                      </div>


                           <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('location_of_loss') ? ' has-error' : ''}}">
                            <label>Location of Loss or Incidence</label>
                             <textarea type="text" rows="3" class="form-control" id="location_of_loss" name="location_of_loss" value="{{ Request::old('location_of_loss') ?: '' }}"></textarea>         
                           @if ($errors->has('location_of_loss'))
                          <span class="help-block">{{ $errors->first('location_of_loss') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                           <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('loss_description') ? ' has-error' : ''}}">
                            <label>Loss / Damage Description </label>
                            <textarea type="text" rows="3" class="form-control" id="loss_description" name="loss_description" value="{{ Request::old('loss_description') ?: '' }}"></textarea> 
                           @if ($errors->has('loss_description'))
                          <span class="help-block">{{ $errors->first('loss_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        

                          <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('loss_amount') ? ' has-error' : ''}}">
                            <label>Loss Amount</label>
                            <input type="number" class="form-control" name="loss_amount" id="loss_amount" placeholder="" value="{{ old('loss_amount') }}">         
                           @if ($errors->has('loss_amount'))
                          <span class="help-block">{{ $errors->first('loss_amount') }}</span>
                           @endif    
                          </div>   
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('excess_amount') ? ' has-error' : ''}}">
                            <label>Deductible/Excess Amount </label>
                            <div class="input-group">
                             <input type="number" class="form-control" name="excess_amount" id="excess_amount" placeholder="" value="{{ old('excess_amount') }}">
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
                             <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="" value="{{ old('contact_number') }}">
                             <span class="input-group-addon">
                            <span class="fa fa-money"></span>
                            </span>         
                           @if ($errors->has('contact_number'))
                          <span class="help-block">{{ $errors->first('contact_number') }}</span>
                           @endif    
                          </div>
                          </div>   
                        </div>
                        </div>



                       



                      

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

                           <div class="col-sm-4">
                            <label>Our Share % </label> 
                           <input type="number" class="form-control" id="vehicle_value"  value="{{ Request::old('vehicle_value') ?: '' }}"  name="vehicle_value">
                          @if ($errors->has('vehicle_value'))
                          <span class="help-block">{{ $errors->first('vehicle_value') }}</span>
                           @endif   
                          </div>        
                          
                         
                            
                        </div>


                        <div class="form-group pull-in clearfix">

                         <div class="col-sm-4">
                            <label>Gross Reserve  </label> 
                           <input type="text" class="form-control" id="reserve_estimated"  value="{{ Request::old('reserve_estimated') ?: '' }}"  name="reserve_estimated">
                          @if ($errors->has('reserve_estimated'))
                          <span class="help-block">{{ $errors->first('reserve_estimated') }}</span>
                           @endif   
                          </div>

                        <div class="col-sm-4">
                            <label>Planned to pay</label> 
                           <input type="text" class="form-control" id="reserve_approved"  value="{{ Request::old('reserve_approved') ?: '' }}"  name="reserve_approved">
                          @if ($errors->has('vehicle_registration_number'))
                          <span class="help-block">{{ $errors->first('vehicle_registration_number') }}</span>
                           @endif   
                          </div>

                        <div class="col-sm-4">
                            <label>Payment Amount</label> 
                           <input type="number" class="form-control" id="reserve_paid"  value="{{ Request::old('reserve_paid') ?: '' }}"  name="reserve_paid">
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
                    <footer class="panel-footer text-right bg-light lter">
 

                        <button onclick="saveClaim()" class="btn btn-success btn-s-xs">Save Details</button>
                      </footer>
                    
                    
                  </div>
 
                   

                        <div class="tab-pane" id="loss-claimant">
                        <section class="panel panel-default">

                        <div  class="panel-body">


                          <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                           <label> Claimant Type </label>
                           <select id="claimant_type" name="claimant_type" rows="3" tabindex="1" data-placeholder="Select loss adjustment ..." style="width:100%">
                           <option value="">-- Select Claimant Type--</option>
                       {{--  @foreach($lossadjustors as $lossadjustor)
                         <option value="{{ $lossadjustor->loss }}">{{ $lossadjustor->loss }}</option>
                          @endforeach   --}}
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
                      
                        </div>


                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : ''}}">
                            <label>Vehicle Registration Number</label>
                             <input type="text" class="form-control" class="text-success" id="claimant_registration_number"  value="{{ Request::old('claimant_registration_number') ?: '' }}"  name="claimant_registration_number">  
                           @if ($errors->has('claimant_registration_number'))
                          <span class="help-block">{{ $errors->first('claimant_registration_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('claimant_notification_date') ? ' has-error' : ''}}">
                            <label>Notification Date </label>
                             <input type="text" class="form-control" class="text-success" id="claimant_notification_date"  value="{{ Request::old('claimant_notification_date ') ?: '' }}"  name="years_of_experience">       
                           @if ($errors->has('claimant_notification_date'))
                          <span class="help-block">{{ $errors->first('claimant_notification_date') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('claimant_offer_date') ? ' has-error' : ''}}">
                            <label>Offer Date </label>
                             <input type="text" class="form-control" class="text-success" id="claimant_offer_date"  value="{{ Request::old('claimant_offer_date') ?: '' }}"  name="claimant_offer_date">  
                           @if ($errors->has('claimant_offer_date'))
                          <span class="help-block">{{ $errors->first('claimant_offer_date') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('claimant_agreed_date') ? ' has-error' : ''}}">
                            <label>Agreed Date </label>
                             <input type="text" class="form-control" class="text-success" id="claimant_agreed_date"  value="{{ Request::old('claimant_agreed_date') ?: '' }}"  name="claimant_agreed_date">  
                           @if ($errors->has('claimant_agreed_date'))
                          <span class="help-block">{{ $errors->first('claimant_agreed_date') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>



                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('years_of_experience') ? ' has-error' : ''}}">
                            <label>Claims Status </label>
                             <input type="text" class="form-control" class="text-success" id="claimant_status"  value="{{ Request::old('claimant_status ') ?: '' }}"  name="claimant_status">       
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


                       
                            

                        </div>

                         <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="saveClaimant()" class="btn btn-success btn-s-xs">Add Claimant</button>
                      </footer>

                      
                    </section> 


                        <section class="panel panel-info">
                        <img src="/images/130147.svg" width="7%" align="right"> 
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
                     
                    </section>
                     <img src="/images/438526.svg" width="7%" align="right"> 
                        <section class="panel panel-warning">
                                <header class="panel-heading font-bold">Payment Vouchers Generated <a href="#payment-voucher" class="bootstrap-modal-form-open pull-right" data-toggle="modal"><span class="label label-default"> + Add New Voucher</span></a></header> 
                                <div class="panel-body">
                                      <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                           <th>PV #</th>
                                            <th>Date Generated</th>
                                            <th>Currency</th>
                                             <th>PV Amount</th>
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
                                   @endforeach  --}}
                                      </tbody>
                                    </table>
                    </div>
                    </div>
                    </section>

                    <section class="panel panel-info">
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
                                   @endforeach  --}}
                                      </tbody>
                                    </table>
                    </div>
                    </div>
                    </section>
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
                          <section class="panel panel-default">
                     
                    </section>
                     
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Liability Report</header>
                                <div class="panel-body">
                                      <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="liabilty_report" name="liabilty_report" class="form-control" style="overflow:scroll;height:500px;max-height:500px" contenteditable="true"> 

                      </div>
                      </div>



                                </div>
                                </section>
                                <footer class="panel-footer text-right bg-light lter">

                        <button type="button" onclick="saveLiabiltyReport()" class="btn btn-success btn-s-xs">Save Report</button>
                      </footer>
                              </div>

                  <div class="tab-pane" id="claim-adjustment">
                      

                      <div class="panel-body">
                          
                          <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="adjustor_type" name="adjustor_type" rows="3" tabindex="1" data-placeholder="Select loss adjustment ..." style="width:100%">
                           <option value="">-- Select Loss Type--</option>
                        @foreach($lossadjustors as $lossadjustor)
                         <option value="{{ $lossadjustor->loss }}">{{ $lossadjustor->loss }}</option>
                          @endforeach  
                        </select>  <div class="input-group-btn">
                           <a href="#" class="bootstrap-modal-form-open" data-toggle="modal" ><button  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>


                        
                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('loss_estimate') ? ' has-error' : ''}}">
                            <label>Estimate</label>
                             <input type="text" class="form-control" class="text-success" id="loss_estimate"  value="{{ Request::old('loss_estimate ') ?: '' }}"  name="loss_estimate">       
                           @if ($errors->has('loss_estimate'))
                          <span class="help-block">{{ $errors->first('loss_estimate') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('loss_approved') ? ' has-error' : ''}}">
                            <label>Approved</label>
                             <input type="text" class="form-control" class="text-success" id="loss_approved"  value="{{ Request::old('loss_approved') ?: '' }}"  name="loss_approved">  

                            
                           @if ($errors->has('loss_approved'))
                          <span class="help-block">{{ $errors->first('loss_approved') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                     
                      <footer class="panel-footer text-right bg-light lter">

                        <button type="button" onclick="addadjustor()" class="btn btn-success btn-s-xs">Add Adjustment</button>
                      </footer>
                      </div>
                     <img src="/images/426394.svg" width="7%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Loss Adjustment</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                      <table id="adjustorTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                          
                              <th>Type</th>
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
                   Registration Number : {{ $fetchrecord->vehicle_risk }}
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
                                       <td><a href="#">{{ Carbon\Carbon::parse($cession->record_date)->year }}</a></td>
                                       <td><a href="/view-cession/{{ $cession->cession_number }}">{{ $cession->cession_number }}</a></td>
                                        <td><a href="/view-cession/{{ $cession->cession_number }}">{{ $cession->item_id }}</a></td>
                                        <td>{{ $cession->reinsurer_broker }}</td>
                                        <td>{{ $cession->facultaive_offer }}</td>
                                        <td>{{ $cession->facultative_percentage }}</td>
                                        <td>{{ $cession->status }}</td>
                                        <td>{{ $cession->facultative_percentage/100 }}</td>
                                       
                                        
                                      </tr>
                                   @endforeach 
                          </tbody>
                        </table>
                          
                    </div>
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
          <input type="hidden" name="item_id" id="item_id" value="{{ $policies->item_id }}">
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


   <div class="modal fade" id="payment-voucher" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Payment Voucher</h4>
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
                           <form  class="bootstrap-modal-form" data-parsley-validate="" method="post" action="/create-agent">
                           
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


function saveClaim()
{

 //generateClaimNumber();
//alert($('#claim_number').val());


    $.get('/add-new-claim',
        {



          "claim_number"                :$('#claim_number').val(),
          "policy_number"               :$('#master_policy_number').val(),
          "reference_number"            :$('#policy_ref_number').val(),
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

          "loss_cause"                  :$('#loss_cause').val(),
          "location_of_loss"            :$('#location_of_loss').val(),
          "loss_description"            :$('#loss_description').val(),
          "loss_amount"                 :$('#loss_amount').val(),
          "excess_amount"               :$('#excess_amount').val(),

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
         
         sweetAlert("Claim successfully generated!"); 
         window.location = "/edit-claim/"+ data["claimid"];
          
        
        }
        else
        {
         toastr.error("Claimed failed to save!"); 
        }
      });
                                        
        },'json');
  
  
         
}


function continueClaim()
{

window.location = "/edit-claim/"+ $('#claim_number').val();

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
          "payee_name"    :$('#pv_payee_name').val(),
          "payment_mode"  :$('#pv_payment_mode').val(),
          "cheque_number" :$('#pv_cheque_number').val(),
          "cheque_date"   :$('#pv_cheque_date').val(),
          "description"   :$('#pv_description').val(),
          "currency"      :$('#pv_currency').val(),
          "amount"        :$('#pv_amount').val()
          
        },
        
        function(data)
        { 
          
        $.each(data, function (key, value) {
        if(data["OK"])
        {
         
         toastr.success("Payment Voucher successfully saved!"); 
         loadPV();

        }
        else
        {
         toastr.error("PV failed to save!"); 
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

    $.get('/add-liability-report',
        {

          "claim_number"          :$('#claim_number').val(),
          "liabilty_report"       :$('#liabilty_report').html()
        
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




</script>

<script type="text/javascript">
$(document).ready(function () {
   
    
      $('#adjustor_type').select2({
      tags: true
      });

      $('#claimant_type').select2();

     $('#claimant_status').select2({
      tags: true
      });

     $('#claimant_status_cause').select2({
      tags: true
      });
   loadAdjustments();
   loadDrivers();
   loadClaimants();
    

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
function addadjustor()
{
if($('#adjustor_type').val()!= "" && $('#claim_number').val()!= "")
{

    $.get('/add-loss-adjustment',
        {
          "claim_id": $('#claim_id').val(),
          "adjustor_type": $('#adjustor_type').val(),
          "loss_estimate": $('#loss_estimate').val(),
          "loss_approved": $('#loss_approved').val()            
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadAdjustments();
        
        }
        else
        {
          sweetAlert("Loss adjustments failed to add!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select a loss adjustment type and ensure claims number is valid!");}
}


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



function loadAdjustments()
   {
         
        
        $.get('/get-loss-adjustments',
          {
            "claim_id": $('#claim_id').val()
          },
          function(data)
          { 

            $('#adjustorTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#adjustorTable tbody').append('<tr><td>'+ value['adjustor_type'] +'</td><td>'+ value['loss_estimate'] +'</td><td>'+ value['loss_approved'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeAdjustments('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


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

</script>




