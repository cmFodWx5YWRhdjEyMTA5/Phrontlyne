
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class=""> Policy Administration </li>
                 <li class="active"> New Policy </li>   
              </ul>


              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                <form method="post" id="masterform" name="masterform" data-validate="parsley" enctype="multipart/form-data" action="/fleet-upload" class="panel-body wrapper-lg">
                  <section class="panel panel-default">
                    
                    <div class="wizard clearfix">
                      <ul class="steps">
                        <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Customer</li>
                        <li data-target="#step2"><span class="badge">2</span>Policy</li>
                        <li data-target="#step3"><span class="badge">3</span>Coverage</li>
                        <li data-target="#step4"><span class="badge">4</span>Premium</li>
                        
                      </ul>
                      <div class="actions">
                        <button type="button" class="btn btn-default btn-xs btn-prev" disabled="disabled">Prev</button>
                        <button type="button" class="btn btn-default btn-xs btn-next" data-last="Finish">Next</button>
                      </div>
                    </div>
                    <div class="step-content">
                    {{-- Step 1 Start --}}
                      <div class="step-pane active" id="step1">
                        <section class="panel panel-default">
                      <div class="panel-body">
                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('customer_number') ? ' has-error' : ''}}">
                            <label>Customer</label>
                            <select id="customer_number" name="customer_number" data-required="true" rows="3" tabindex="1" data-placeholder="Select a customer" style="width:100%">
                          @if($customers->count() > 1)  <option value="">-- select a customer --</option> @else @endif 
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('customer_number'))
                          <span class="help-block">{{ $errors->first('customer_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                            <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_number') ? ' has-error' : ''}}">
                            <label>Policy Number</label>
                            <input id="policy_number" name="policy_number" class="form-control" rows="3" tabindex="1">
                             
                           @if ($errors->has('policy_number'))
                          <span class="help-block">{{ $errors->first('policy_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                      </div>
                    </section>
                    </div>
                    {{-- Step 1 End --}}  
                    {{-- Step 2 Start --}}
                      <div class="step-pane" id="step2">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Policy Info
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_type') ? ' has-error' : ''}}">
                            <label>Policy Type</label>
                            <select id="policy_type" name="policy_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" onchange="loadInsurer(),loadinsurancetype()">
                         @foreach($policytypes as $policytype)
                        <option value="{{ $policytype->type }}">{{ $policytype->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('policy_type'))
                          <span class="help-block">{{ $errors->first('policy_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>



                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_insurer') ? ' has-error' : ''}}">
                            <label>Insurer</label>
                            <select id="policy_insurer" name="policy_insurer" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="">-- select from here --</option>
                        @foreach($insurers as $insurer)
                        <option value="{{ $insurer->name }}">{{ $insurer->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('policy_insurer'))
                          <span class="help-block">{{ $errors->first('policy_insurer') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>



                        <div class="form-group @if($errors->has('insurance_period')) has-error @endif">
                        <label for="time">Insurance Period</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="insurance_period" id="insurance_period" placeholder="Select your time" value="{{ old('insurance_period') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('insurance_period'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('insurance_period') }}
                       </p>
                        @endif
                      </div>

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Currency</label> 
                          <select id="policy_currency" data-required="true" name="policy_currency" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- not set --</option>
                         @foreach($currencies as $currency)
                        <option value="{{ $currency->type }}">{{ $currency->type }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('policy_currency'))
                          <span class="help-block">{{ $errors->first('policy_currency') }}</span>
                           @endif    
                          </div>
                          </div>
                      
                      </div>
                    </section>
                      </div>
                    {{-- Step 2 End --}}
                    {{-- Step 3 Start --}}
                    <div class="step-pane" id="step3">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Choose Product
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_product') ? ' has-error' : ''}}">
                             <select id="policy_product" name="policy_product" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." style="width:100%" onchange="getproductform()">
                             <option value="">-- select a product --</option>
                        @foreach($producttypes as $producttype)
                        <option value="{{ $producttype->type }}"> {{$producttype->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('policy_product'))
                          <span class="help-block">{{ $errors->first('policy_product') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                      
                      </div>
                    </section>



                    <div id="motorinsurance" name="motorinsurance">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Motor Insurance
                       <a href="/images/McBroker_fleet.csv" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-danger pull-right"><i class="fa fa-download"></i>Download Fleet File</span></a>
                      <input type="file" class="form-control dropbox" width="500px" height="40px" name="file"/>
                    </header>
                      {{-- <div class="panel-body">
                        
                                 <div class="form-group pull-in clearfix">
                          
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('preferedcover') ? ' has-error' : ''}}">
                            <label>Prefered Cover</label>
                            <select id="preferedcover" name="preferedcover" onchange="getcomprehensiveform()" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">Choose Cover Type</option>
                        <option value="Comprehensive">Comprehensive</option>
                        <option value="Third Party Fire & Theft">Third Party Fire & Theft</option>
                         <option value="Third Party">Third Party</option>
                        </select>         
                           @if ($errors->has('preferedcover'))
                          <span class="help-block">{{ $errors->first('preferedcover') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                        <div class="col-sm-4">
                            <label>Vehicle Use</label> 
                          <select id="vehicle_use" name="vehicle_use" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" onchange="loadNCD(),loadRisk()">
                           <option value="">-- select from here --</option>
                          <option value="Commercial">Commercial</option>
                           <option value="Private">Private</option>
                        </select> 
                           @if ($errors->has('vehicle_use'))
                          <span class="help-block">{{ $errors->first('vehicle_use') }}</span>
                           @endif    
                          </div>

                          <div class="col-sm-4">
                            <label>Vehicle Risk</label> 
                          <select id="vehicle_risk" name="vehicle_risk" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           <option value="">-- select from here --</option>
                          @foreach($vehicleuses as $vehicleuse)
                        <option value="{{ $vehicleuse->risk }}"> {{$vehicleuse->risk }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('vehicle_risk'))
                          <span class="help-block">{{ $errors->first('vehicle_risk') }}</span>
                           @endif    
                          </div>
                        </div>

     
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                            <label>Vehicle Value</label> 
                           <input type="number" class="form-control" id="vehicle_value"  value="{{ Request::old('vehicle_value') ?: '' }}"  name="vehicle_value">
                          @if ($errors->has('vehicle_value'))
                          <span class="help-block">{{ $errors->first('vehicle_value') }}</span>
                           @endif   
                          </div>


                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_buy_back_excess') ? ' has-error' : ''}}">
                            <label>Buy Back Excess</label>
                            <select id="vehicle_buy_back_excess" name="vehicle_buy_back_excess" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value="">-- not set --</option>
                         @foreach($selectstatus as $selectstatus)
                        <option value="{{ $selectstatus->type }}">{{ $selectstatus->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_buy_back_excess'))
                          <span class="help-block">{{ $errors->first('vehicle_buy_back_excess') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                       
                        </div>

                  


                        <div class="form-group pull-in clearfix">
                       
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_make') ? ' has-error' : ''}}">
                            <label>Vehicle Make</label>
                            <select id="vehicle_make" name="vehicle_make" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" onchange="loadModels()">
                             <option value="">-- select from here --</option>
                          @foreach($vehiclemakes as $vehiclemake)
                        <option value="{{ $vehiclemake->type }}">{{ $vehiclemake->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('vehicle_make'))
                          <span class="help-block">{{ $errors->first('vehicle_make') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_model') ? ' has-error' : ''}}">
                            <label>Vehicle Model</label>
                            <select id="vehicle_model" name="vehicle_model" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                             <option value="">-- select from here --</option>
                          @foreach($vehiclemodels as $vehiclemodel)
                        <option value="{{ $vehiclemodel->type }}">{{ $vehiclemodel->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('vehicle_model'))
                          <span class="help-block">{{ $errors->first('vehicle_model') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_body_type') ? ' has-error' : ''}}">
                            <label>Body Type</label>
                            <select id="vehicle_body_type" name="vehicle_body_type" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- select from here --</option>
                         @foreach($vehicletypes as $vehicletype)
                        <option value="{{ $vehicletype->type }}">{{ $vehicletype->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_body_type'))
                          <span class="help-block">{{ $errors->first('vehicle_body_type') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                    

                        <div class="form-group pull-in clearfix">

                          <div class="col-sm-4">
                            <label>TPPDL Limit Amount</label> 
                           <input type="number" class="form-control" id="vehicle_tppdl_value"  value="{{ '2000' }}"  name="vehicle_tppdl_value">
                          @if ($errors->has('vehicle_tppdl_value'))
                          <span class="help-block">{{ $errors->first('vehicle_tppdl_value') }}</span>
                           @endif   
                          </div>
                         

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_make_year') ? ' has-error' : ''}}">
                            <label>Make Year </label>
                            <select id="vehicle_make_year" name="vehicle_make_year" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        @foreach($year as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                          @endforeach  

                        </select>         
                           @if ($errors->has('vehicle_make_year'))
                          <span class="help-block">{{ $errors->first('vehicle_make_year') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-4">
                            <label>Seating Capacity</label> 
                           <input type="number" class="form-control" id="vehicle_seating_capacity"  value="{{ Request::old('vehicle_seating_capacity') ?: '' }}"  name="vehicle_seating_capacity">
                          @if ($errors->has('vehicle_seating_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_seating_capacity') }}</span>
                           @endif   
                          </div>
                            
                        </div>


                      
                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Cubic Capacity</label> 
                           <input type="number" class="form-control" id="vehicle_cubic_capacity"  value="{{ Request::old('vehicle_cubic_capacity') ?: '' }}"  name="vehicle_cubic_capacity">
                          @if ($errors->has('vehicle_cubic_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_cubic_capacity') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Registration Number</label> 
                           <input type="text" class="form-control" id="vehicle_registration_number"  value="{{ Request::old('vehicle_registration_number') ?: '' }}"  name="vehicle_registration_number">
                          @if ($errors->has('vehicle_registration_number'))
                          <span class="help-block">{{ $errors->first('vehicle_registration_number') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>Chassis Number</label> 
                           <input type="text" class="form-control" id="vehicle_chassis_number"  value="{{ Request::old('vehicle_chassis_number') ?: '' }}"  name="vehicle_chassis_number">
                          @if ($errors->has('vehicle_chassis_number'))
                          <span class="help-block">{{ $errors->first('vehicle_chassis_number') }}</span>
                           @endif   
                          </div>
                        </div>
                    </div> --}}
                   </section> 

                    {{-- <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Discount
                    </header>
                      <div class="panel-body">
                        
                       <div class="form-group pull-in clearfix">
                       
                         <div class="col-sm-6">
                            <label>NCD</label> 
                          <select id="vehicle_ncd" name="vehicle_ncd" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           <option value="">-- select from here --</option>
                        @foreach($noclaimdiscount as $noclaimdiscount)
                        <option value="{{ $noclaimdiscount->rate }}">{{ $noclaimdiscount->type }}</option>
                          @endforeach 
                        </select> 
                           @if ($errors->has('vehicle_ncd'))
                          <span class="help-block">{{ $errors->first('vehicle_ncd') }}</span>
                           @endif    
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_fleet_discount') ? ' has-error' : ''}}">
                            <label>Fleet Discount </label>
                            <select id="vehicle_fleet_discount" name="vehicle_fleet_discount" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       @foreach($fleetdiscount as $fleetdiscount)
                        <option value="{{ $fleetdiscount->charge }}">{{ $fleetdiscount->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_fleet_discount'))
                          <span class="help-block">{{ $errors->first('vehicle_fleet_discount') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                        <div  class="btn-group pull-right"> 
                        <button type="button" class="btn btn-rounded btn-sm btn-info" onclick="computePremium()">Compute Premium
                        </button>
                        </div>
                        </div>
                        </div>
                      </div>
                    </section> --}}
                      </div>



                    <div id="motorinsurancecomprehensive" name="motorinsurancecomprehensive">
                     {{-- <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      About the Vehicle (Comprehensive Cover)
                    </header>
                      <div class="panel-body">
                        
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_interest_status') ? ' has-error' : ''}}">
                            <label>Any Interest</label>
                            <select id="vehicle_interest_status" name="vehicle_interest_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('vehicle_interest_status'))
                          <span class="help-block">{{ $errors->first('vehicle_interest_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                       


                        <div class="form-group">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('vehicle_interest_name') ? ' has-error' : ''}}">
                          <label>Interest Name </label>
                         <textarea type="text" rows="3" class="form-control" id="vehicle_interest_name" name="vehicle_interest_name" value="{{ Request::old('vehicle_interest_name') ?: '' }}"></textarea> 
                          @if ($errors->has('vehicle_interest_name'))
                          <span class="help-block">{{ $errors->first('vehicle_interest_name') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>
                        </div>   



                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_declined_status') ? ' has-error' : ''}}">
                            <label>Has any insurance company ever in connection with any motor vehicle declined your proposal?</label>
                            <select id="vehicle_declined_status" name="vehicle_declined_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('vehicle_declined_status'))
                          <span class="help-block">{{ $errors->first('vehicle_declined_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="form-group">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('vehicle_declined_reason') ? ' has-error' : ''}}">
                          <label>Declined reasons </label>
                         <textarea type="text" rows="3" class="form-control" id="vehicle_declined_reason" name="vehicle_declined_reason" value="{{ Request::old('vehicle_declined_reason') ?: '' }}"></textarea> 
                          @if ($errors->has('vehicle_declined_reason'))
                          <span class="help-block">{{ $errors->first('vehicle_declined_reason') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>
                        </div>       
     
                     <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_cancelled_status') ? ' has-error' : ''}}">
                            <label>Has any insurance company ever in connection with any motor vehicle cancelled your policy?</label>
                            <select id="vehicle_cancelled_status" name="vehicle_cancelled_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('vehicle_cancelled_status'))
                          <span class="help-block">{{ $errors->first('vehicle_cancelled_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('vehicle_cancelled_reason') ? ' has-error' : ''}}">
                          <label>Cancelled reasons </label>
                         <textarea type="text" rows="3" class="form-control" id="vehicle_cancelled_reason" name="vehicle_cancelled_reason" value="{{ Request::old('vehicle_cancelled_reason') ?: '' }}"></textarea> 
                          @if ($errors->has('vehicle_cancelled_reason'))
                          <span class="help-block">{{ $errors->first('vehicle_cancelled_reason') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>
                        </div>

                    </div>
                   </section>  --}}
                  </div>


                    {{-- Travel Insurance Start--}}
                  <div id="travelinsurance" name="travelinsurance">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Travel Insurance
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('destination_country') ? ' has-error' : ''}}">
                            <label>Destination Country</label>
                            <select id="destination_country" name="destination_country[]" multiple="multiple" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value="">-- select from here --</option>
                          @foreach($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('destination_country'))
                          <span class="help-block">{{ $errors->first('destination_country') }}</span>
                           @endif    
                          </div>   
                        </div>

                      
                        <div class="col-sm-4">
                       <div class="form-group @if($errors->has('departure_date')) has-error @endif">
                        <label for="departure_date">Date of Departure</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="departure_date" id="departure_date" placeholder="Select your time" value="{{ old('departure_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('departure_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('departure_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                     

                        
                        <div class="col-sm-4">
                       <div class="form-group @if($errors->has('arrival_date')) has-error @endif">
                        <label for="arrival_date">Date of Arrival</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="arrival_date" id="arrival_date" placeholder="Select your time" value="{{ old('arrival_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('arrival_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('arrival_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                   </div>  


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('travel_reason') ? ' has-error' : ''}}">
                            <label>Reason for Travel</label>
                            <textarea type="text" rows="3" class="form-control" id="travel_reason" name="travel_reason" value="{{ Request::old('travel_reason') ?: '' }}"></textarea> 
                           @if ($errors->has('travel_reason'))
                          <span class="help-block">{{ $errors->first('travel_reason') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        
                   </section> 

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Passport Information
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('passport_number') ? ' has-error' : ''}}">
                            <label>Passport No.</label>
                             <input type="text" class="form-control" id="passport_number"  value="{{ Request::old('passport_number') ?: '' }}"  name="passport_number">         
                           @if ($errors->has('passport_number'))
                          <span class="help-block">{{ $errors->first('passport_number') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('issuing_country') ? ' has-error' : ''}}">
                            <label>Issuing Country</label>
                            <select id="issuing_country" name="issuing_country" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="Ghana">-- Ghana --</option>
                          @foreach($countries as $country2)
                        <option value="{{ $country2->name }}">{{ $country2->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('issuing_country'))
                          <span class="help-block">{{ $errors->first('issuing_country') }}</span>
                           @endif    
                          </div>   
                        </div>
                        

                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('citizenship') ? ' has-error' : ''}}">
                            <label>Citizenship</label>
                            <select id="citizenship" name="citizenship" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="Ghanaian">-- Ghanaian --</option>
                          @foreach($countries as $country3)
                        <option value="{{ $country3->name }}">{{ $country3->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('citizenship'))
                          <span class="help-block">{{ $errors->first('citizenship') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                   </section> 

                   <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Beneficiary Information
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('beneficiary_name') ? ' has-error' : ''}}">
                            <label>Name of Beneficiary</label>
                           <input type="text" class="form-control" id="beneficiary_name"  value="{{ Request::old('beneficiary_name') ?: '' }}"  name="beneficiary_name">          
                           @if ($errors->has('beneficiary_name'))
                          <span class="help-block">{{ $errors->first('beneficiary_name') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('beneficiary_relationship') ? ' has-error' : ''}}">
                            <label>Relationship with Beneficiary</label>
                            <select id="beneficiary_relationship" name="beneficiary_relationship" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            <option value="">-- not set --</option>
                          @foreach($beneficiaries as $beneficiary)
                        <option value="{{ $beneficiary->type }}">{{ $beneficiary->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('beneficiary_relationship'))
                          <span class="help-block">{{ $errors->first('beneficiary_relationship') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('beneficiary_contact') ? ' has-error' : ''}}">
                            <label>Beneficiary contact details</label>
                             <input type="text" class="form-control" id="beneficiary_contact"  value="{{ Request::old('beneficiary_contact') ?: '' }}"  name="beneficiary_contact">         
                           @if ($errors->has('beneficiary_contact'))
                          <span class="help-block">{{ $errors->first('beneficiary_contact') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                   </section> 
                </div>

                     {{-- Travel Insurance End--}}


                       {{-- Personal Accident Insurance Start--}}
                             <div id="personalaccidentinsurance" name="personalaccidentinsurance">

                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                              Insurance Cover Details
                               </header>
                            <div class="panel-body">

                              <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('pa_sum_insured') ? ' has-error' : ''}}">
                            <label>Sum Insured</label>
                            <input type="text" class="form-control" id="pa_sum_insured"  value="{{ Request::old('pa_sum_insured') ?: '' }}"  name="pa_sum_insured">         
                           @if ($errors->has('pa_sum_insured'))
                          <span class="help-block">{{ $errors->first('pa_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                            </div>
                            </section>
                               <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Personal Details
                               </header>
                            <div class="panel-body">
                              
                            <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pa_height') ? ' has-error' : ''}}">
                            <label>Height</label>
                            <input type="text" class="form-control" id="pa_height"  value="{{ Request::old('pa_height') ?: '' }}"  name="pa_height">         
                           @if ($errors->has('pa_height'))
                          <span class="help-block">{{ $errors->first('pa_height') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-3">
                            <label>Weight</label> 
                              <div class="form-group{{ $errors->has('pa_weight') ? ' has-error' : ''}}">
                          <input type="text" class="form-control" id="pa_weight"  value="{{ Request::old('pa_weight') ?: '' }}"  name="pa_weight">   
                           @if ($errors->has('pa_weight'))
                          <span class="help-block">{{ $errors->first('pa_weight') }}</span>
                           @endif    
                          </div>
                          </div>   

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : ''}}">
                            <label>Marital Status</label>
                            <select id="marital_status" name="marital_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($maritalstatus as $maritalstatus)
                        <option value="{{ $maritalstatus->type }}">{{ $maritalstatus->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('marital_status'))
                          <span class="help-block">{{ $errors->first('marital_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('nature_of_work') ? ' has-error' : ''}}">
                            <label>Nature of Work</label>
                            <select id="nature_of_work" name="nature_of_work" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($natureofwork as $natureofwork)
                        <option value="{{ $natureofwork->type }}">{{ $natureofwork->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('nature_of_work'))
                          <span class="help-block">{{ $errors->first('nature_of_work') }}</span>
                           @endif    
                          </div>   
                        </div>
                              

                            </div>
                            </section>

                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Previous Accident Information
                               </header>
                            <div class="panel-body">
                              

                            <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pa_accident_received') ? ' has-error' : ''}}">
                            <label>Accident Received?</label>
                            <select id="pa_accident_received" name="pa_accident_received" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_accident_received'))
                          <span class="help-block">{{ $errors->first('pa_accident_received') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-3">
                            <label>Nature of Accident</label> 
                             <div class="form-group{{ $errors->has('pa_nature_of_accident') ? ' has-error' : ''}}">
                          <select id="pa_nature_of_accident" name="pa_nature_of_accident" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       @foreach($natureofaccident as $natureofaccident)
                        <option value="{{ $natureofaccident->type }}">{{ $natureofaccident->type }}</option>
                          @endforeach 
                        </select> 
                           @if ($errors->has('pa_nature_of_accident'))
                          <span class="help-block">{{ $errors->first('pa_nature_of_accident') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('accident_duration') ? ' has-error' : ''}}">
                            <label>Duration</label>
                            <select id="accident_duration" name="accident_duration" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="0">-- not set --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="5">6</option>
                        <option value="5">7</option>
                        <option value="5">8</option>
                        <option value="5">9</option>
                        <option value="5">10</option>
                        </select>         
                           @if ($errors->has('accident_duration'))
                          <span class="help-block">{{ $errors->first('accident_duration') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('accident_period') ? ' has-error' : ''}}">
                            <label>Period</label>
                            <select id="accident_period" name="accident_period" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="0">-- not set --</option>
                        <option value="Days">Days</option>
                        <option value="Weeks">Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Years">Years</option>
                        </select>         
                           @if ($errors->has('accident_period'))
                          <span class="help-block">{{ $errors->first('accident_period') }}</span>
                           @endif    
                          </div>   
                        </div>
                              


                            </div>
                            </section>

                            <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Activities Detail
                               </header>
                            <div class="panel-body">
                              
                             <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('pa_activities') ? ' has-error' : ''}}">
                           
                            <select id="pa_activities" name="pa_activities" multiple="multiple" rows="3" tabindex="1" data-placeholder="Choose Activities Engaged In" style="width:100%">
                           <option value="Motor Cycling">Motor Cycling</option>
                           <option value="Football">Football</option>
                           <option value="Big Game Hunting">Big Game Hunting</option>
                          <option value="Parachuting">Parachuting</option>
                          <option value="Big Game Hunting">Diving</option>
                          <option value="Parachuting">Mining</option>
                        </select>         
                           @if ($errors->has('pa_activities'))
                          <span class="help-block">{{ $errors->first('pa_activities') }}</span>
                           @endif    
                          </div>   
                          </div>
                          
                        </div>

                            </div>
                            </section>


                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Has any insurance company ever...
                               </header>
                            <div class="panel-body">
                                  <div class="form-group pull-in clearfix">
                       
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('pa_special_term_status') ? ' has-error' : ''}}">
                            <label>1. Required Special Terms?</label>
                            <select id="pa_special_term_status" name="pa_special_term_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_special_term_status'))
                          <span class="help-block">{{ $errors->first('pa_special_term_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-4">
                            <label>2. Cancelled or refused your insurance?</label> 
                            <div class="form-group{{ $errors->has('pa_cancelled_insurance_status') ? ' has-error' : ''}}">
                          <select id="pa_cancelled_insurance_status" name="pa_cancelled_insurance_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select> 
                           @if ($errors->has('pa_cancelled_insurance_status'))
                          <span class="help-block">{{ $errors->first('pa_cancelled_insurance_status') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('pa_increased_premium_status') ? ' has-error' : ''}}">
                            <label>3. Increase your premium on renewal?</label>
                            <select id="pa_increased_premium_status" name="pa_increased_premium_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_increased_premium_status'))
                          <span class="help-block">{{ $errors->first('pa_increased_premium_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                            </div>
                            </section>

                            <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Benefit Details
                               </header>
                            <div class="panel-body">
                              
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('pa_benefit_details') ? ' has-error' : ''}}">
                            <label>Name, Gender, Date of Birth, Relationship of each person on a new line</label>
                            <textarea type="text" rows="3" class="form-control" id="pa_benefit_details" name="pa_benefit_details" value="{{ Request::old('pa_benefit_details') ?: '' }}"></textarea>         
                           @if ($errors->has('pa_benefit_details'))
                          <span class="help-block">{{ $errors->first('pa_benefit_details') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                            </div>
                            </section>
                          </div>


                         {{-- Personal Accident Insurance End--}}

                             {{--Bond Insurance Start--}}
                      <div id="liabilityinsurance" name="liabilityinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Liability Information

                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('liability_risk_type') ? ' has-error' : ''}}">
                            <label>Liability Type</label>
                            <select id="liability_risk_type" name="liability_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select coverage --</option>
                           @foreach($liabilitytypes as $liabilitytypes)
                        <option value="{{ $liabilitytypes->type }}">{{ $liabilitytypes->type }}</option>
                          @endforeach  --}}
                        </select>         
                           @if ($errors->has('liability_risk_type'))
                          <span class="help-block">{{ $errors->first('liability_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('liability_schedule') ? ' has-error' : ''}}">
                            <label>Schedule description of each object on a new line </label>
                             <textarea type="text" class="form-control" rows="5" id="liability_schedule"  value="{{ Request::old('liability_schedule') ?: '' }}"  name="liability_schedule"></textarea>           
                           @if ($errors->has('liability_schedule'))
                          <span class="help-block">{{ $errors->first('liability_schedule') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('liability_beneficiary') ? ' has-error' : ''}}">
                            <label>List of beneficiaries of limits on a new line </label>
                             <textarea type="text" class="form-control" rows="5" id="liability_beneficiary"  value="{{ Request::old('liability_beneficiary') ?: '' }}"  name="liability_beneficiary"></textarea>           
                           @if ($errors->has('liability_beneficiary'))
                          <span class="help-block">{{ $errors->first('liability_beneficiary') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                       
                      </div>
                   </section>

            </div>


            <div id="healthinsurance" name="healthinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Health Plan Information

                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('health_type') ? ' has-error' : ''}}">
                            <label>Plan Type</label>
                            <input id="health_type" name="health_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control">  
                           @if ($errors->has('health_type'))
                          <span class="help-block">{{ $errors->first('health_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('health_plan_details') ? ' has-error' : ''}}">
                            <label>Plan Details </label>
                             <textarea type="text" class="form-control" rows="5" id="health_plan_details"  value="{{ Request::old('health_plan_details') ?: '' }}"  name="health_plan_details"></textarea>           
                           @if ($errors->has('health_plan_details'))
                          <span class="help-block">{{ $errors->first('health_plan_details') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('health_plan_limits') ? ' has-error' : ''}}">
                            <label>List of plan limits, each on a new line </label>
                             <textarea type="text" class="form-control" rows="5" id="health_plan_limits"  value="{{ Request::old('health_plan_limits') ?: '' }}"  name="health_plan_limits"></textarea>           
                           @if ($errors->has('health_plan_limits'))
                          <span class="help-block">{{ $errors->first('health_plan_limits') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                       
                      </div>
                   </section>

            </div>

            <div id="lifeinsurance" name="lifeinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Life Plan Information

                    </header>
                      <div class="panel-body">

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('life_type') ? ' has-error' : ''}}">
                            <label>Plan Type</label>
                            <input id="life_type" name="life_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control">  
                           @if ($errors->has('life_type'))
                          <span class="help-block">{{ $errors->first('life_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('life_cover_amount') ? ' has-error' : ''}}">
                            <label>Cover Amount</label>
                            <input type="text" class="form-control" id="life_cover_amount"  value="{{ Request::old('life_cover_amount') ?: '' }}"  name="life_cover_amount">         
                           @if ($errors->has('life_cover_amount'))
                          <span class="help-block">{{ $errors->first('life_cover_amount') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('life_monthly_premium') ? ' has-error' : ''}}">
                            <label>Monthly Premium</label>
                            <input type="text" class="form-control" id="life_monthly_premium"  value="{{ Request::old('life_monthly_premium') ?: '' }}"  name="life_monthly_premium">         
                           @if ($errors->has('life_monthly_premium'))
                          <span class="help-block">{{ $errors->first('life_monthly_premium') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>



                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('life_plan_details') ? ' has-error' : ''}}">
                            <label>Plan Details </label>
                             <textarea type="text" class="form-control" rows="5" id="life_plan_details"  value="{{ Request::old('life_plan_details') ?: '' }}"  name="life_plan_details"></textarea>           
                           @if ($errors->has('life_plan_details'))
                          <span class="help-block">{{ $errors->first('life_plan_details') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('life_plan_limits') ? ' has-error' : ''}}">
                            <label>Beneficiaries, each person on a new line with % share</label>
                             <textarea type="text" class="form-control" rows="5" id="life_plan_limits"  value="{{ Request::old('life_plan_limits') ?: '' }}"  name="life_plan_limits"></textarea>           
                           @if ($errors->has('life_plan_limits'))
                          <span class="help-block">{{ $errors->first('life_plan_limits') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                       
                      </div>
                   </section>

            </div>


{{-- starting GeneralAccident--}}
 <div id="generalaccident" name="generalaccident">
 
                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Accident Details
                    </header>
                      <div class="panel-body">
                        

                            <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('accident_risk_type') ? ' has-error' : ''}}">
                            <label>Accident Type</label>
                            <select id="accident_risk_type" name="accident_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select type --</option>
                         @foreach($accidenttypes as $accidenttypes)
                        <option value="{{ $accidenttypes->type }}">{{ $accidenttypes->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('accident_risk_type'))
                          <span class="help-block">{{ $errors->first('accident_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
              

                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('general_accident_sum_insured') ? ' has-error' : ''}}">
                            <label>Capital Sum Insured</label>
                             <input type="text" class="form-control" id="general_accident_sum_insured"  value="{{ Request::old('general_accident_sum_insured') ?: '' }}"  name="general_accident_sum_insured">           
                           @if ($errors->has('general_accident_sum_insured'))
                          <span class="help-block">{{ $errors->first('general_accident_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('general_accident_deductible') ? ' has-error' : ''}}">
                            <label>Deductible</label>
                                 <input type="text" class="form-control" id="general_accident_deductible"  value="{{ Request::old('general_accident_deductible') ?: '' }}"  name="general_accident_deductible">          
                           @if ($errors->has('general_accident_deductible'))
                          <span class="help-block">{{ $errors->first('general_accident_deductible') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('accident_description') ? ' has-error' : ''}}">
                            <label>Accident Description </label>
                             <textarea type="text" class="form-control" rows="3" id="accident_description"  value="{{ Request::old('accident_description') ?: '' }}"  name="accident_description"></textarea>           
                           @if ($errors->has('accident_description'))
                          <span class="help-block">{{ $errors->first('accident_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('accident_beneficiaries') ? ' has-error' : ''}}">
                            <label>Beneficiaries (Name, Benefit of each person on a new line) </label>
                             <textarea type="text" class="form-control" rows="6" id="accident_beneficiaries"  value="{{ Request::old('accident_beneficiaries') ?: '' }}"  name="accident_beneficiaries"></textarea>           
                           @if ($errors->has('accident_beneficiaries'))
                          <span class="help-block">{{ $errors->first('accident_beneficiaries') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('accident_clause_limit') ? ' has-error' : ''}}">
                            <label>Clause Applicable / Limits Applicable (Each item on a new line)</label>
                             <textarea type="text" class="form-control" rows="6" id="accident_clause_limit"  value="{{ Request::old('accident_clause_limit') ?: '' }}"  name="accident_clause_limit"></textarea>           
                           @if ($errors->has('accident_clause_limit'))
                          <span class="help-block">{{ $errors->first('accident_clause_limit') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('accident_clause_limit') ? ' has-error' : ''}}">
                            <label>Special Clause Applicable</label>
                             <textarea type="text" class="form-control" rows="6" id="accident_clause_limit"  value="{{ Request::old('accident_clause_limit') ?: '' }}"  name="accident_clause_limit"></textarea>           
                           @if ($errors->has('accident_clause_limit'))
                          <span class="help-block">{{ $errors->first('accident_clause_limit') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        </div>
                   </section>
</div>






{{-- Ending General Accident--}}




                        {{--Bond Insurance Start--}}
                            <div id="bondinsurance" name="bondinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Bond Details
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_risk_type') ? ' has-error' : ''}}">
                            <label>Bond Type</label>
                            <select id="bond_risk_type" name="bond_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select coverage --</option>
                         @foreach($bondtypes as $bondtype)
                        <option value="{{ $bondtype->type }}">{{ $bondtype->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('bond_risk_type'))
                          <span class="help-block">{{ $errors->first('bond_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_interest') ? ' has-error' : ''}}">
                            <label>Principal</label>
                             <input type="text" class="form-control" id="bond_interest"  value="{{ Request::old('bond_interest') ?: '' }}"  name="bond_interest">           
                           @if ($errors->has('bond_interest'))
                          <span class="help-block">{{ $errors->first('bond_interest') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_interest_address') ? ' has-error' : ''}}">
                            <label>Principal Address</label>
                                 <input type="text" class="form-control" id="bond_interest_address"  value="{{ Request::old('bond_interest_address') ?: '' }}"  name="bond_interest_address">          
                           @if ($errors->has('bond_interest_address'))
                          <span class="help-block">{{ $errors->first('bond_interest_address') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>
                        </div>
                   </section>

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Bond Details
                    </header>
                      <div class="panel-body">
                        
              

                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('contract_sum') ? ' has-error' : ''}}">
                            <label>Contract Sum</label>
                             <input type="text" class="form-control" id="contract_sum"  value="{{ Request::old('contract_sum') ?: '' }}"  name="contract_sum">           
                           @if ($errors->has('contract_sum'))
                          <span class="help-block">{{ $errors->first('contract_sum') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_sum_insured') ? ' has-error' : ''}}">
                            <label>Bond Amount</label>
                                 <input type="text" class="form-control" id="bond_sum_insured"  value="{{ Request::old('pa_height') ?: '' }}"  name="bond_sum_insured">          
                           @if ($errors->has('bond_sum_insured'))
                          <span class="help-block">{{ $errors->first('bond_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_contract_description') ? ' has-error' : ''}}">
                            <label>Contract Description</label>
                             <textarea type="text" class="form-control" rows="3" id="bond_contract_description"  value="{{ Request::old('bond_contract_description') ?: '' }}"  name="bond_contract_description"></textarea>           
                           @if ($errors->has('bond_contract_description'))
                          <span class="help-block">{{ $errors->first('bond_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                        </div>
                    
                   </section>


                            </div>


                        {{--Bond Insurance End--}}

              {{-- CAR start--}}

                             <div id="contractorallrisk" name="contractorallrisk">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Contract Details
                    </header>
                      <div class="panel-body">

                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('car_risk_type') ? ' has-error' : ''}}">
                            <label>Risk Type</label>
                            <select id="car_risk_type" name="car_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select risk --</option>
                          @foreach($engineeringrisktypes as $engineeringrisktypes)
                        <option value="{{ $engineeringrisktypes->type }}">{{ $engineeringrisktypes->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('car_risk_type'))
                          <span class="help-block">{{ $errors->first('car_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        
                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('car_parties') ? ' has-error' : ''}}">
                            <label>Parties Involved</label>
                             <input type="text" class="form-control" id="car_parties"  value="{{ Request::old('car_parties') ?: '' }}"  name="car_parties">           
                           @if ($errors->has('car_parties'))
                          <span class="help-block">{{ $errors->first('car_parties') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('car_nature_of_business') ? ' has-error' : ''}}">
                            <label>Nature of Business</label>
                                 <input type="text" class="form-control" id="car_nature_of_business"  value="{{ Request::old('car_nature_of_business') ?: '' }}"  name="car_nature_of_business">          
                           @if ($errors->has('car_nature_of_business'))
                          <span class="help-block">{{ $errors->first('car_nature_of_business') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('car_contract_description') ? ' has-error' : ''}}">
                            <label>Contract Description</label>
                             <textarea type="text" class="form-control" rows="3" id="car_contract_description"  value="{{ Request::old('car_contract_description') ?: '' }}"  name="car_contract_description"></textarea>           
                           @if ($errors->has('car_contract_description'))
                          <span class="help-block">{{ $errors->first('car_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                   </section>

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                     
                    </header>
                      <div class="panel-body">
                        
              

                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('car_contract_sum') ? ' has-error' : ''}}">
                            <label>Engineering Sum Insured</label>
                             <input type="text" class="form-control" id="car_contract_sum"  value="{{ Request::old('car_contract_sum') ?: '' }}"  name="car_contract_sum">           
                           @if ($errors->has('car_contract_sum'))
                          <span class="help-block">{{ $errors->first('car_contract_sum') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('car_deductible') ? ' has-error' : ''}}">
                            <label>Deductible</label>
                                 <input type="text" class="form-control" id="car_deductible"  value="{{ Request::old('car_deductible') ?: '' }}"  name="car_deductible">          
                           @if ($errors->has('car_deductible'))
                          <span class="help-block">{{ $errors->first('car_deductible') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('car_endorsements') ? ' has-error' : ''}}">
                            <label>Engineering Items - Add each item on a new line</label>
                             <textarea type="text" class="form-control" rows="3" id="car_endorsements"  value="{{ Request::old('car_endorsements') ?: '' }}"  name="car_endorsements"></textarea>           
                           @if ($errors->has('car_endorsements'))
                          <span class="help-block">{{ $errors->first('car_endorsements') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                        </div>
                    
                   </section>
</div>









                      {{-- CAR end--}}




                             {{--marine Insurance Start--}}
                            <div id="marineinsurance" name="marineinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Marine
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('marine_risk_type') ? ' has-error' : ''}}">
                            <label>Marine Type</label>
                            <select id="marine_risk_type" name="marine_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select coverage --</option>
                          @foreach($marinetypes as $marinetypes)
                        <option value="{{ $marinetypes->type }}">{{ $marinetypes->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('marine_risk_type'))
                          <span class="help-block">{{ $errors->first('marine_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_sum_insured') ? ' has-error' : ''}}">
                            <label>Sum Insured</label>
                             <input type="text" class="form-control" id="marine_sum_insured"  value="{{ Request::old('marine_sum_insured') ?: '' }}"  name="marine_sum_insured">           
                           @if ($errors->has('marine_sum_insured'))
                          <span class="help-block">{{ $errors->first('marine_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_bill_landing') ? ' has-error' : ''}}">
                            <label>Bill of Landing No.</label>
                                 <input type="text" class="form-control" id="marine_bill_landing"  value="{{ Request::old('marine_bill_landing') ?: '' }}"  name="marine_bill_landing">          
                           @if ($errors->has('marine_bill_landing'))
                          <span class="help-block">{{ $errors->first('marine_bill_landing') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>
                        </div>
                   </section>

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Marine Details
                    </header>
                      <div class="panel-body">
                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_interest') ? ' has-error' : ''}}">
                            <label>Interest & Marks</label>
                             <input type="text" class="form-control" id="marine_interest"  value="{{ Request::old('marine_interest') ?: '' }}"  name="marine_interest">           
                           @if ($errors->has('marine_interest'))
                          <span class="help-block">{{ $errors->first('marine_interest') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_vessel') ? ' has-error' : ''}}">
                            <label>Name of Vessel</label>
                                 <input type="text" class="form-control" id="marine_vessel"  value="{{ Request::old('marine_vessel') ?: '' }}"  name="marine_vessel">          
                           @if ($errors->has('marine_vessel'))
                          <span class="help-block">{{ $errors->first('marine_vessel') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_insurance_condition') ? ' has-error' : ''}}">
                            <label>Insurance Condition</label>
                             <input type="text" class="form-control" id="marine_insurance_condition"  value="{{ Request::old('marine_insurance_condition') ?: '' }}"  name="marine_insurance_condition">           
                           @if ($errors->has('marine_insurance_condition'))
                          <span class="help-block">{{ $errors->first('marine_insurance_condition') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_valuation') ? ' has-error' : ''}}">
                            <label>Valuation Basis</label>
                                 <input type="text" class="form-control" id="marine_valuation"  value="{{ Request::old('marine_valuation') ?: '' }}"  name="marine_valuation">          
                           @if ($errors->has('marine_valuation'))
                          <span class="help-block">{{ $errors->first('marine_valuation') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('marine_means_of_conveyance') ? ' has-error' : ''}}">
                            <label>Ship or vessel or other means of conveyance </label>
                             <textarea type="text" class="form-control" rows="3" id="marine_means_of_conveyance"  value="{{ Request::old('marine_means_of_conveyance') ?: '' }}"  name="marine_means_of_conveyance"></textarea>           
                           @if ($errors->has('marine_means_of_conveyance'))
                          <span class="help-block">{{ $errors->first('marine_means_of_conveyance') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('marine_voyage') ? ' has-error' : ''}}">
                            <label>Voyage</label>
                             <input type="text" class="form-control" id="marine_voyage"  value="{{ Request::old('marine_voyage') ?: '' }}"  name="marine_voyage">           
                           @if ($errors->has('marine_voyage'))
                          <span class="help-block">{{ $errors->first('marine_voyage') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('marine_condition') ? ' has-error' : ''}}">
                            <label>Conditions of insurance subject to </label>
                             <textarea type="text" class="form-control" rows="3" id="marine_condition"  value="{{ Request::old('marine_condition') ?: '' }}"  name="marine_condition"></textarea>           
                           @if ($errors->has('marine_condition'))
                          <span class="help-block">{{ $errors->first('marine_condition') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        </div>
                   </section>
            </div>


                      
          
                      {{-- Fire Insurance End--}}
                       <div id="fireinsurance" name="fireinsurance">
                         <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                              ABOUT INSURANCE
                               </header>
                            <div class="panel-body">

                             <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_risk_covered') ? ' has-error' : ''}}">
                            <label>Risk Covered</label>
                            <select id="fire_risk_covered" name="fire_risk_covered" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       @foreach($firerisks as $firerisks)
                        <option value="{{ $firerisks->type }}">{{ $firerisks->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('fire_risk_covered'))
                          <span class="help-block">{{ $errors->first('fire_risk_covered') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                              
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_building_cost') ? ' has-error' : ''}}">
                            <label>Sum Insured</label>
                            <input type="text" class="form-control" id="fire_building_cost"  value="{{ Request::old('fire_building_cost') ?: '' }}"  name="fire_building_cost">         
                           @if ($errors->has('fire_building_cost'))
                          <span class="help-block">{{ $errors->first('fire_building_cost') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_deductible') ? ' has-error' : ''}}">
                            <label>Deductible</label>
                           <input type="text" class="form-control" id="fire_deductible"  value="{{ Request::old('fire_deductible') ?: '' }}"  name="fire_deductible">  
                           @if ($errors->has('fire_deductible'))
                          <span class="help-block">{{ $errors->first('fire_deductible') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_personal_property_coverage') ? ' has-error' : ''}}">
                            <label>Personal Property Coverage</label>
                              <input type="text" class="form-control" id="fire_personal_property_coverage"  value="{{ Request::old('fire_personal_property_coverage') ?: '' }}"  name="fire_personal_property_coverage">
                           @if ($errors->has('fire_personal_property_coverage'))
                          <span class="help-block">{{ $errors->first('fire_personal_property_coverage') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_temporary_rental_cost') ? ' has-error' : ''}}">
                            <label>Temporay Rental Costs Coverage</label>
                            <input type="text" class="form-control" id="fire_temporary_rental_cost"  value="{{ Request::old('fire_temporary_rental_cost') ?: '' }}"  name="fire_temporary_rental_cost">

                           @if ($errors->has('fire_temporary_rental_cost'))
                          <span class="help-block">{{ $errors->first('fire_temporary_rental_cost') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        
                        </div>
                        </section>

                   <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      BUILDING INFORMATION
                    </header>
                      <div class="panel-body">
                        
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_building_address') ? ' has-error' : ''}}">
                            <label>Building Address</label>
                            <textarea type="text" rows="3" class="form-control" id="fire_building_address" name="fire_building_address" value="{{ Request::old('fire_building_address') ?: '' }}"></textarea>         
                           @if ($errors->has('fire_mortgage_status'))
                          <span class="help-block">{{ $errors->first('fire_building_address') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_property_type') ? ' has-error' : ''}}">
                            <label>Property Type</label>
                            <select id="fire_property_type" name="fire_property_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($propertytypes as $propertytypes)
                        <option value="{{ $propertytypes->type }}">{{ $propertytypes->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('fire_property_type'))
                          <span class="help-block">{{ $errors->first('fire_property_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('walled_with') ? ' has-error' : ''}}">
                            <label>Construction details of your wall</label>
                            <select id="walled_with" multiple="multiple" name="walled_with" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($walled as $walled)
                        <option value="{{ $walled->type }}">{{ $walled->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('walled_with'))
                          <span class="help-block">{{ $errors->first('walled_with') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('roofed_with') ? ' has-error' : ''}}">
                            <label>Construction details of your roof</label>
                            <select id="roofed_with" multiple="multiple" name="roofed_with" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        @foreach($roofed as $roofed)
                        <option value="{{ $roofed->type }}">{{ $roofed->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('roofed_with'))
                          <span class="help-block">{{ $errors->first('roofed_with') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                    
                   </section>

                
                 <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      INTEREST INFORMATION
                    </header>
                      <div class="panel-body">

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_mortgage_status') ? ' has-error' : ''}}">
                            <label>Is your building subject to a mortgage loan?</label>
                            <select id="fire_mortgage_status" name="fire_mortgage_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_mortgage_status'))
                          <span class="help-block">{{ $errors->first('fire_mortgage_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_mortgage_company') ? ' has-error' : ''}}">
                            <label>Provide name of mortgage company</label>
                            <select id="fire_mortgage_company" name="fire_mortgage_company" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                     @foreach($mortagecompanies as $mortagecompanies)
                        <option value="{{ $mortagecompanies->name }}">{{ $mortagecompanies->name }}</option>
                          @endforeach --}}
                        </select>         
                           @if ($errors->has('fire_mortgage_company'))
                          <span class="help-block">{{ $errors->first('fire_mortgage_company') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div> 
                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('property_content') ? ' has-error' : ''}}">
                            <label>Property Content (Item Name, Description, Cost of each item on a new line)</label>
                            <textarea type="text" rows="3" class="form-control" id="property_content" name="property_content" value="{{ Request::old('property_content') ?: '' }}"></textarea>         
                           @if ($errors->has('property_content'))
                          <span class="help-block">{{ $errors->first('property_content') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        </div>
                    
                   </section>



                      </div>
                      {{-- Fire Insurance End--}}
                         
                      </div>

                    {{-- Step 3 End --}}
                      <div class="step-pane" id="step4">
                      <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                              Premium / Payment
                               </header>
                            <div class="panel-body">
                              
                      {{--   <div class="form-group pull-in clearfix">
                          <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('gross_premium') ? ' has-error' : ''}}">
                            <label>Gross Premium</label>
                            <div class="input-group m-b">
                            <input type="text" class="form-control parsley-validated" data-required="true" id="gross_premium"  value="{{ Request::old('gross_premium') ?: '' }}" data-type="number" name="gross_premium"><span class="input-group-addon">.00</span>   
                            </div>      
                           @if ($errors->has('gross_premium'))
                          <span class="help-block">{{ $errors->first('gross_premium') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('commission_rate') ? ' has-error' : ''}}">
                            <label>Commission Rate</label>
                            <input type="text" class="form-control parsley-validated" data-required="true" id="commission_rate"  value="{{ Request::old('commission_rate') ?: '' }}" data-type="number"   name="commission_rate">         
                           @if ($errors->has('commission_rate'))
                          <span class="help-block">{{ $errors->first('commission_rate') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
 --}}

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('collection_mode') ? ' has-error' : ''}}">
                            <label>Collection</label>
                            <select id="collection_mode" name="collection_mode" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         @foreach($collectionmodes as $collectionmodes)
                        <option value="{{ $collectionmodes->type }}">{{ $collectionmodes->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('collection_mode'))
                          <span class="help-block">{{ $errors->first('collection_mode') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        
                        <div class="btn-group pull-right">
                        <button type="submit" onclick="fillmandatory()" class="btn btn-rounded btn-sm btn-info">Save Record</button>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </div>

                        </div>
                        </section>

                      </div>

                     
                    </div>
                  </section>
                       
                      </form>
                </section>
                </div>
              </div>


            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

  <div class="modal fade" id="upload-fleet" size="100">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Fleet Upload</h4>
        </div>
        <div class="modal-body">
         <form method="post"  enctype="multipart/form-data" action="/fleet-upload">
          <input type="file"  class="btn btn-default btn-s-lg" width="1000" height="40px" name="file" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>             
                   

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(function () {
  $('#insurance_period').daterangepicker({
    "minDate": moment('2015-06-14 0'),
    "startDate":  moment(),
    "endDate":  moment().add(1, 'years').subtract(1, 'days'),
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 15,
    "showDropdowns": true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>





<script>
function  getproductform() 
{


   if( $('#policy_product').val() == "Motor Insurance")
    {
         $('#motorinsurance').show();
          $('#fireinsurance').hide(); 
          $('#travelinsurance').hide(); 
          $('#personalaccidentinsurance').hide(); 
          $('#bondinsurance').hide();
          $('#marineinsurance').hide();
          $('#liabilityinsurance').hide();
          $('#contractorallrisk').hide();
          $('#generalaccident').hide();
          $('#healthinsurance').hide();
          $('#lifeinsurance').hide();
   }
  else if( $('#policy_product').val() == "Fire Insurance")
    {
         $('#fireinsurance').show();
          $('#motorinsurance').hide(); 
          $('#travelinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#personalaccidentinsurance').hide(); 
           $('#bondinsurance').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
   }
else if( $('#policy_product').val() == "Travel Insurance")
    {
      $('#travelinsurance').show(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#personalaccidentinsurance').hide();
           $('#bondinsurance').hide();
           $('#marineinsurance').hide(); 
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
   }

   else if( $('#policy_product').val() == "Personal Accident Insurance")
    {
      $('#personalaccidentinsurance').show();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#bondinsurance').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
            
   }
    else if( $('#policy_product').val() == "Bond Insurance")
    {
      $('#bondinsurance').show();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
            
   }

    else if( $('#policy_product').val() == "Marine Insurance")
    {
      $('#marineinsurance').show();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
           
            
   }

    else if( $('#policy_product').val() == "Liability Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#liabilityinsurance').show();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
           
            
   }

   else if( $('#policy_product').val() == "Engineering Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
      $('#fireinsurance').hide();
      $('#motorinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').show();
      $('#generalaccident').hide();
      $('#healthinsurance').hide();
      $('#lifeinsurance').hide();
           
            
   }

   else if( $('#policy_product').val() == "General Accident Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
      $('#fireinsurance').hide();
      $('#motorinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').hide();
      $('#generalaccident').show();
      $('#healthinsurance').hide();
      $('#lifeinsurance').hide();
           
            
   }

   else if( $('#policy_product').val() == "Health Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
      $('#fireinsurance').hide();
      $('#motorinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').hide();
      $('#generalaccident').hide();
      $('#healthinsurance').show();
      $('#lifeinsurance').hide();      
   }

    else if( $('#policy_product').val() == "Life Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
      $('#fireinsurance').hide();
      $('#motorinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').hide();
      $('#generalaccident').hide();
      $('#healthinsurance').hide();
      $('#lifeinsurance').show();      
   }

   else if( $('#policy_product').val() == "")
    {
        $('#motorinsurance').hide(); 
        $('#fireinsurance').hide(); 
       $('#motorinsurancecomprehensive').hide();
       $('#travelinsurance').hide(); 
       $('#personalaccidentinsurance').hide(); 
       $('#bondinsurance').hide();
       $('#marineinsurance').hide();
       $('#liabilityinsurance').hide();
       $('#contractorallrisk').hide();
       $('#generalaccident').hide();
       $('#healthinsurance').hide();
       $('#lifeinsurance').hide();    
   }
   else
   {
      $('#motorinsurance').hide(); 
      $('#fireinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#travelinsurance').hide();
      $('#personalaccidentinsurance').hide(); 
      $('#bondinsurance').hide(); 
      $('#marineinsurance').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').hide();
      $('#generalaccident').hide();
      $('#healthinsurance').hide();
      $('#lifeinsurance').hide();


    }
}
</script>

<script>
function  getcomprehensiveform() 
{

  //alert($('#policy_product').val());
   if( $('#preferedcover').val() == "Comprehensive")
    {
         
      $('#motorinsurancecomprehensive').show();
      $('#vehicle_value').prop('disabled', false);
      $('#vehicle_buy_back_excess').prop('disabled', false);
      $('#vehicle_tppdl_value').prop('disabled', false);

          $('#vehicle_body_type').prop('disabled', false);
        $('#vehicle_chassis_number').prop('disabled', false);
         $('#vehicle_cubic_capacity').prop('disabled', false);
          $('#vehicle_make_year').prop('disabled', false);
    }

    else if( $('#preferedcover').val() == "Third Party")
    {
     
       $('#motorinsurancecomprehensive').hide();
       $('#vehicle_value').prop('disabled', true);
      $('#vehicle_buy_back_excess').prop('disabled', true);
      $('#vehicle_tppdl_value').prop('disabled', false);

       $('#vehicle_body_type').prop('disabled', true);
        $('#vehicle_chassis_number').prop('disabled', false);
         $('#vehicle_cubic_capacity').prop('disabled', true);
          $('#vehicle_make_year').prop('disabled', true);
      
     }

     else if( $('#preferedcover').val() == "Third Party Fire & Theft")
    {
     
      $('#motorinsurancecomprehensive').hide();
      $('#vehicle_value').prop('disabled', false);
      $('#vehicle_buy_back_excess').prop('disabled', false);
      $('#vehicle_tppdl_value').prop('disabled', false);
      $('#vehicle_body_type').prop('disabled', false);
      $('#vehicle_chassis_number').prop('disabled', false);
      $('#vehicle_cubic_capacity').prop('disabled', false);
      $('#vehicle_make_year').prop('disabled', false);
     }

     else if( $('#preferedcover').val() == "")
    {
     
       $('#motorinsurancecomprehensive').hide();
     }

   else
   {
      $('#motorinsurancecomprehensive').hide();
  }
}
</script>

<script type="text/javascript">
$(document).ready(function () {
    $('#motorinsurance').hide(); 
    $('#fireinsurance').hide(); 
    $('#motorinsurancecomprehensive').hide();
    $('#marineinsurance').hide();
    $('#bondinsurance').hide();
    $('#travelinsurance').hide(); 
    $('#personalaccidentinsurance').hide(); 
    $('#liabilityinsurance').hide();
    $('#generalaccident').hide();
    $('#contractorallrisk').hide();
    $('#healthinsurance').hide();
    $('#lifeinsurance').hide();  
    $('#pa_activities').select2();
    $('#policy_insurer').select2();
    $('#roofed_with').select2();
    $('#walled_with').select2();
    $('#customer_number').select2();
    $('#vehicle_body_type').select2();
    $('#vehicle_make').select2();
    $('#vehicle_model').select2();
    $('#policy_product').select2();
    $('#destination_country').select2();

    loadInsurer();
    loadinsurancetype();

    $("#formid").submit(function() 
         {      
             $(".masterform").val("");//for all textboxes having class "textbox" 
         });
     
  });
</script>


<script type="text/javascript">

function fillmandatory()
{
  if($('#customer_number').val()=="")
  {sweetAlert("Please select a customer ",'Fill all fields', "error");}
  
   else if($('#policy_insurer').val()=="")
  {sweetAlert("Please select an insurer ",'Fill all fields', "error");}

  else if($('#policy_product').val()=="")
  {sweetAlert("Please select a product",'Fill all fields', "error");}

   else if($('#policy_type').val()=="")
  {sweetAlert("Please select excess ",'Fill all fields', "error");}



}



function computePremium()
{

  if($('#preferedcover').val()=="")
  {sweetAlert("Please select cover ",'Fill all fields', "error");}
  else if($('#vehicle_value').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Enter vehicle value ",'Fill all fields', "error");}
  else if($('#vehicle_currency').val()=="")
  {sweetAlert("Please select currency ",'Fill all fields', "error");}
 else if($('#vehicle_buy_back_excess').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Please select excess ",'Fill all fields', "error");}
else if($('#vehicle_use').val()=="")
  {sweetAlert("Please select use ",'Fill all fields', "error");}
else if($('#vehicle_risk').val()=="")
  {sweetAlert("Please select risk ",'Fill all fields', "error");}
else if($('#vehicle_seating_capacity').val()=="")
  {sweetAlert("Please enter seat number ",'Fill all fields', "error");}
else if($('#vehicle_cubic_capacity').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Please enter cubic capacity ",'Fill all fields', "error");}
else if($('#vehicle_ncd').val()=="")
  {sweetAlert("Please select ncd ",'Fill all fields', "error");}
else if($('#vehicle_fleet_discount').val()=="")
  {sweetAlert("Please select fleet discount ",'Fill all fields', "error");}
  else
  {
    $.get('/compute-motor',
        {


          "preferedcover": $('#preferedcover').val(),
          "vehicle_value": $('#vehicle_value').val(),
          "vehicle_currency": $('#vehicle_currency').val(),
          "vehicle_buy_back_excess": $('#vehicle_buy_back_excess').val(),
          "vehicle_use":  $('#vehicle_use').val(),
          "vehicle_tppdl_value":  $('#vehicle_tppdl_value').val(),
          "vehicle_risk":  $('#vehicle_risk').val(),
          "vehicle_make_year":  $('#vehicle_make_year').val(),
          "vehicle_seating_capacity":  $('#vehicle_seating_capacity').val(), 
          "vehicle_cubic_capacity":  $('#vehicle_cubic_capacity').val(),
          "vehicle_ncd":  $('#vehicle_ncd').val(),      
          "vehicle_fleet_discount":  $('#vehicle_fleet_discount').val()


        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
          sweetAlert("Premium Payable : ", data["Premium"], "info");
          $('#gross_premium').val(data.Premium);
       
      });
                                        
        },'json');
  }
}
  
</script>

<script type="text/javascript">
      function loadNCD()
   {
    
        $.get('/load-ncd-rate',
          {
            "vehicle_use": $('#vehicle_use').val()
          },
          function(data)
          { 

            $('#vehicle_ncd').empty();
            $.each(data, function () 
            {           
            $('#vehicle_ncd').append($('<option></option>').val(this['rate']).html(this['type']));
            });
                                          
         },'json');      
    }

</script>

<script type="text/javascript">
      function loadRisk()
   {
         
        
        $.get('/load-risk',
          {
            "vehicle_use": $('#vehicle_use').val()
          },
          function(data)
          { 

            $('#vehicle_risk').empty();
            $.each(data, function () 
            {           
            $('#vehicle_risk').append($('<option></option>').val(this['risk']).html(this['risk']));
            });
                                          
         },'json');      
    }
</script>

<script type="text/javascript">
      function loadModels()
   {
         
        
        $.get('/load-vehicle-model',
          {
            "vehicle_make": $('#vehicle_make').val()
          },
          function(data)
          { 

            $('#vehicle_model').empty();
            $.each(data, function () 
            {           
            $('#vehicle_model').append($('<option></option>').val(this['model']).html(this['model']));
            });
                                          
         },'json');      
    }
</script>

<script type="text/javascript">
      function loadInsurer()
   {
         
        
        $.get('/load-insurer',
          {
            "policy_type": $('#policy_type').val()
          },
          function(data)
          { 

            $('#policy_insurer').empty();
            $.each(data, function () 
            {           
            $('#policy_insurer').append($('<option></option>').val(this['name']).html(this['name']));
            });
                                          
         },'json');      
    }
</script>

<script type="text/javascript">
      function loadinsurancetype()
   {
         
        
        $.get('/load-product',
          {
            "policy_type": $('#policy_type').val()
          },
          function(data)
          { 

            $('#policy_product').empty();
            $.each(data, function () 
            {           
            $('#policy_product').append($('<option></option>').val(this['type']).html(this['type']));
            });
                                          
         },'json');      
    }
</script>
<script type="text/javascript">
$(function () {
  $('#departure_date').daterangepicker({
     "minDate": moment('2010-06-14'),
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
  $('#arrival_date').daterangepicker({
     "minDate": moment('2010-06-14'),
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



