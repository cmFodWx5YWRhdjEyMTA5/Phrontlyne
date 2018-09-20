
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Claims Administration </li>   
              </ul>
             

              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                 <form method="post" data-validate="parsley" action="/save-claim" class="panel-body wrapper-lg">
                  <section class="panel panel-default">
                    
                    <div class="wizard clearfix">
                      <ul class="steps">
                        <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Policy Information</li>
                        <li data-target="#step2"><span class="badge">2</span>Claim Information</li>
                        <li data-target="#step3"><span class="badge">3</span>Product Information</li>
                        <li data-target="#step4"><span class="badge">4</span>Claimant</li>
                        <li data-target="#step5"><span class="badge">5</span>Reserves</li>
                        
                      </ul>
                      <div class="actions">
                        <button type="button" class="btn btn-default btn-xs btn-prev" disabled="disabled">Prev</button>
                        <button type="button" class="btn btn-default btn-xs btn-next" data-last="Finish">Next</button>
                      </div>
                    </div>
                    <div class="step-content">
                    {{-- Step 1 Start --}}
                    
                    <div class="step-pane" id="step3">
                       
                  <div class="panel-group m-b" id="accordion2">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                           <span class="label label-success">   Loss Details & Reserve  </span>
                        </a>
                      </div>
                      <div id="collapseOne" class="panel-collapse in">
                        <div class="panel-body text-sm">
                          <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                             
                             </header>
                        <div class="panel-body">

                           


                      

                        </div>
                    </section>

                        </div>
                      </div>
                    </div>
                    {{-- <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                           <span class="label label-success">  Key Risk Information </span> 
                        </a>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                             
                             </header>
                        <div class="panel-body">
                              
                        <div class="form-group pull-in clearfix">
                       
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_make') ? ' has-error' : ''}}">
                            <label>Vehicle Make</label>
                             <input type="text" class="form-control" id="vehicle_make" readonly="true"  value="{{ $vehicledetails->vehicle_make }}"  name="vehicle_make">        
                           @if ($errors->has('vehicle_make'))
                          <span class="help-block">{{ $errors->first('vehicle_make') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_model') ? ' has-error' : ''}}">
                            <label>Vehicle Model</label>
                            <input type="text" class="form-control" id="vehicle_model" readonly="true" value="{{ $vehicledetails->vehicle_model }}"  name="vehicle_model">
                           @if ($errors->has('vehicle_model'))
                          <span class="help-block">{{ $errors->first('vehicle_model') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_body_type') ? ' has-error' : ''}}">
                            <label>Body Type</label>
                           <input type="text" class="form-control" id="vehicle_body_type" readonly="true"  value="{{$vehicledetails->vehicle_body_type  }}"  name="vehicle_body_type">
                           @if ($errors->has('vehicle_body_type'))
                          <span class="help-block">{{ $errors->first('vehicle_body_type') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                    

                        <div class="form-group pull-in clearfix">

                          <div class="col-sm-4">
                            <label>TPPDL Limit Amount</label> 
                           <input type="number" class="form-control" id="vehicle_tppdl_value" readonly="true"  value="{{$vehicledetails->vehicle_tppdl_value  }}"  name="vehicle_tppdl_value">
                          @if ($errors->has('vehicle_tppdl_value'))
                          <span class="help-block">{{ $errors->first('vehicle_tppdl_value') }}</span>
                           @endif   
                          </div>
                         

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_make_year') ? ' has-error' : ''}}">
                            <label>Year of Manufacture </label>
                           <input type="number" class="form-control" id="vehicle_make_year"  readonly="true" value="{{$vehicledetails->vehicle_make_year  }}"  name="vehicle_make_year">
                           @if ($errors->has('vehicle_make_year'))
                          <span class="help-block">{{ $errors->first('vehicle_make_year') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-4">
                            <label>Seating Capacity</label> 
                           <input type="number" class="form-control" id="vehicle_seating_capacity"  value="{{$vehicledetails->vehicle_seating_capacity  }}" readonly="true"  name="vehicle_seating_capacity">
                          @if ($errors->has('vehicle_seating_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_seating_capacity') }}</span>
                           @endif   
                          </div>
                            
                        </div>


                      
                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Cubic Capacity</label> 
                           <input type="number" class="form-control" id="vehicle_cubic_capacity"  value="{{$vehicledetails->vehicle_cubic_capacity }}"  readonly="true" name="vehicle_cubic_capacity">
                          @if ($errors->has('vehicle_cubic_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_cubic_capacity') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Engine Number</label> 
                           <input type="text" class="form-control" id="vehicle_engine_number" readonly="true"  value="{{$vehicledetails->vehicle_engine_number  }}"  name="vehicle_engine_number">
                          @if ($errors->has('vehicle_engine_number'))
                          <span class="help-block">{{ $errors->first('vehicle_engine_number') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>Chassis Number</label> 
                           <input type="text" class="form-control" id="vehicle_chassis_number" readonly="true"  value="{{$vehicledetails->vehicle_chassis_number  }}"  name="vehicle_chassis_number">
                          @if ($errors->has('vehicle_chassis_number'))
                          <span class="help-block">{{ $errors->first('vehicle_chassis_number') }}</span>
                           @endif   
                          </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Owner Name</label> 
                           <input type="number" class="form-control" id="vehicle_owner_name" readonly="true"  value="{{ Request::old('vehicle_owner_name') ?: '' }}"  name="vehicle_owner_name">
                          @if ($errors->has('vehicle_owner_name'))
                          <span class="help-block">{{ $errors->first('vehicle_owner_name') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Colour</label> 
                           <input type="text" class="form-control" id="vehicle_colour" readonly="true"  value="{{ Request::old('vehicle_colour') ?: '' }}"  name="vehicle_colour">
                          @if ($errors->has('vehicle_colour'))
                          <span class="help-block">{{ $errors->first('vehicle_colour') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>Registration Month & Year</label> 
                           <input type="text" class="form-control" id="vehicle_register_date" readonly="true"  value="{{ Request::old('vehicle_register_date') ?: '' }}"  name="vehicle_register_date">
                          @if ($errors->has('vehicle_register_date'))
                          <span class="help-block">{{ $errors->first('vehicle_register_date') }}</span>
                           @endif   
                          </div>
                        </div>




                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Vehicle Tonnage</label> 
                           <input type="number" class="form-control" id="vehicle_cubic_capacity" readonly="true"  value="{{ Request::old('vehicle_cubic_capacity') ?: '' }}"  name="vehicle_cubic_capacity">
                          @if ($errors->has('vehicle_cubic_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_cubic_capacity') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Trailer Number</label> 
                           <input type="text" class="form-control" id="vehicle_trailer_number" readonly="true"  value="{{ Request::old('vehicle_trailer_number') ?: '' }}"  name="vehicle_trailer_number">
                          @if ($errors->has('vehicle_trailer_number'))
                          <span class="help-block">{{ $errors->first('vehicle_trailer_number') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>Mileage</label> 
                           <input type="text" class="form-control" id="vehicle_mileage_number" readonly="true"  value="{{ Request::old('vehicle_mileage_number') ?: '' }}"  name="vehicle_mileage_number">
                          @if ($errors->has('vehicle_mileage_number'))
                          <span class="help-block">{{ $errors->first('vehicle_mileage_number') }}</span>
                           @endif   
                          </div>
                        </div>
                        </div>
                    </section>
                        </div>
                      </div>
                    </div> --}}
                    
                  </div>

                    

                    </div>

                    {{-- Step 3 End --}}
                      <div class="step-pane" id="step4">

                       <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Claimant Info
                             </header>
                        <div class="panel-body">

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_insured_status') ? ' has-error' : ''}}">
                            <label>Is policy holder claimant ? </label>
                            <select id="claimant_insured_status" name="claimant_insured_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" onchange="getclaimsform()">
                          <option value=""></option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>         
                           @if ($errors->has('claimant_insured_status'))
                          <span class="help-block">{{ $errors->first('claimant_insured_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                    </section>

                    
                    <div id="claimantdetails" name="claimantdetails">

                     <section class="panel panel-info">
                                <header class="panel-heading font-bold">Filed Claimants</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="drugTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Type</th>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Date Notified</th>
                              <th>Reserve</th>
                              <th>Added By</th>
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
                       <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                             New Claimant(s)
                             </header>
                        <div class="panel-body">


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Claim Status</label> 
                          <select id="claimant_status" data-required="true" name="claimant_status" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- not set --</option>
                     {{--   @foreach($intermediary as $intermediary)
                        <option value="{{ $intermediary->AGENTNAME }}">{{ $intermediary->AGENTNAME }}</option>
                          @endforeach  --}}
                        </select> 
                           @if ($errors->has('agent_number'))
                          <span class="help-block">{{ $errors->first('agent_number') }}</span>
                           @endif    
                          </div>

                          <div class="col-sm-6">
                            <label>Cause of Status</label> 
                          <select id="claimant_status_cause" data-required="true" name="claimant_status_cause" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- not set --</option>
                 {{--       @foreach($intermediary as $intermediary)
                        <option value="{{ $intermediary->AGENTNAME }}">{{ $intermediary->AGENTNAME }}</option>
                          @endforeach  --}}
                        </select> 
                           @if ($errors->has('claimant_status'))
                          <span class="help-block">{{ $errors->first('claimant_status') }}</span>
                           @endif    
                          </div>

                          </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_type') ? ' has-error' : ''}}">
                            <label> Type  </label>
                            <select id="claimant_type" data-required="true" name="claimant_type" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- not set --</option>
                     {{--   @foreach($intermediary as $intermediary)
                        <option value="{{ $intermediary->AGENTNAME }}">{{ $intermediary->AGENTNAME }}</option>
                          @endforeach  --}}
                        </select>        
                           @if ($errors->has('claimant_type'))
                          <span class="help-block">{{ $errors->first('claimant_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_name') ? ' has-error' : ''}}">
                            <label> Name  </label>
                            <input type="text" class="form-control" name="claimant_name" id="claimant_name" placeholder="" value="{{ old('claimant_name') }}">       
                           @if ($errors->has('claimant_name'))
                          <span class="help-block">{{ $errors->first('claimant_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_address') ? ' has-error' : ''}}">
                            <label> Address  </label>
                            <textarea type="text" class="form-control" name="claimant_address" id="claimant_address" rows="3" placeholder="" value="{{ old('claimant_address') }}">   </textarea>
                           @if ($errors->has('claimant_address'))
                          <span class="help-block">{{ $errors->first('claimant_address') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('claimant_email') ? ' has-error' : ''}}">
                            <label> E-mail Address  </label>
                            <input type="text" class="form-control" name="claimant_email" id="claimant_email" placeholder="" value="{{ old('claimant_email') }}">       
                           @if ($errors->has('claimant_email'))
                          <span class="help-block">{{ $errors->first('claimant_email') }}</span>
                           @endif    
                          </div>   
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('claimant_phone') ? ' has-error' : ''}}">
                            <label> Phone No.  </label>
                            <input type="text" class="form-control" name="claimant_phone" id="claimant_phone" placeholder="" value="{{ old('claimant_phone') }}">       
                           @if ($errors->has('claimant_phone'))
                          <span class="help-block">{{ $errors->first('claimant_phone') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('date_notified') ? ' has-error' : ''}}">
                            <label>TP Date of Notification  </label>
                            <input type="text" class="form-control" name="date_notified" id="date_notified" placeholder="" value="{{ old('date_notified') }}">       
                           @if ($errors->has('date_notified'))
                          <span class="help-block">{{ $errors->first('date_notified') }}</span>
                           @endif    
                          </div>   
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('date_offered') ? ' has-error' : ''}}">
                            <label>Date of Offer  </label>
                            <input type="text" class="form-control" name="date_offered" id="date_offered" placeholder="" value="{{ old('date_offered') }}">       
                           @if ($errors->has('date_offered'))
                          <span class="help-block">{{ $errors->first('date_offered') }}</span>
                           @endif    
                          </div>   
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('date_agreed') ? ' has-error' : ''}}">
                            <label>Date Agreed</label>
                            <input type="text" class="form-control" name="date_agreed" id="date_agreed" placeholder="" value="{{ old('date_agreed') }}">       
                           @if ($errors->has('date_agreed'))
                          <span class="help-block">{{ $errors->first('date_agreed') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         


                        

                    </div>

                    <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Add Claimant</button>
                      </footer>
                    </section>
                    </div>


                      </div>
                      
                       <div class="step-pane" id="step5">

                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Reserves</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="drugTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Type</th>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Date Notified</th>
                              <th>Reserve</th>
                              <th>Added By</th>
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


                       <button type="submit" class="btn btn-success btn-s-xs">Save Record</button>
                       </div>

                    </div>
                  </section>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                  </form>
                </section>
                </div>
              </div>


            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

 

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

