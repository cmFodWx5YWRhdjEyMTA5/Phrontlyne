@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p class="h4 text-dark"><strong>Policy : {{ $policydetails->master_policy_number }} ({{ $policydetails->fullname }} )</strong></p> 
                       
          {{--    <a href="http://web.whatsapp.com//send?text=Hello, this is {{ Auth::user()->getNameOrUsername() }} from Phoenix!&phone= {{ $phone }}" target="new" class="btn btn-rounded  btn-icon"><img src="/images/174879.svg"></a> --}}
              
              <div class="btn-group pull-right">
              <p>
                    {{-- <a href="#" onclick="suspendPolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-archive"></i> Suspend</a>
                    <a href="/edit-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-pencil"></i> Edit</a>
                    <a href="#" onclick="cancelPolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-ban"></i> Cancel</a>
                    <a href="#" onclick="deletePolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-trash"></i> Delete</a>
                    <a href="/renew-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw  fa-refresh"></i> Renew</a>
                    <a href="#" onclick="lockPolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw  fa-lock"></i> Lock</a>
 --}}

                      

                     
                     
                     


                      <a href="/print-schedule/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-folder"></i> View Documents </a> 

                    
              </p>



              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
        
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#consultation_tab" data-toggle="tab">Overview</a></li>
                        <li class=""><a href="#diagnosis_tab" data-toggle="tab">CO/RI </a></li>
                         <li class=""><a href="#object_list" data-toggle="tab">Vehicle / Objects</a></li>
                        <li class=""><a href="#invoices_tab" data-toggle="tab">Debits <label class="label bg-info m-l-xs">{{ number_format($bills->sum('amount'), 2, '.', ',') }}</label></a></li>
                        <li class=""><a href="#receipts_tab" data-toggle="tab">Receipts <label class="label bg-warning m-l-xs">{{ number_format($receipts->sum('amount_paid'), 2, '.', ',') }}</label></a></li>
                        <li class=""><a href="#document_tab" data-toggle="tab">Document</a></li>
                        <li class=""><a href="#claims_tab" data-toggle="tab">Claims<label class="label bg-danger m-l-xs">{{ $claims->count() }}</label></a></li>
                        <li class=""><a href="#renewal_tab" data-toggle="tab">Renewals</a></li>
                        <li class=""><a href="#logstabe" data-toggle="tab">Logs</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="consultation_tab">
                         <img src="/images/809461.svg" width="5%"  class="pull-right">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                         <br>
                         <br>

                         <section class="panel panel-default">

                <header class="panel-heading font-bold">
                  Policy info
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Customer</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->account_number }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Policy Type</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->policy_product }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Object</label>
                      <div class="col-sm-10">
                       @if($policydetails->policy_product == 'Motor Insurance')
                        <input type="text" readonly="true" value="@foreach($vehicles as $val) [ {{ $val->vehicle_registration_number }} ] @endforeach" class="form-control rounded">
                        @else
                       <input type="text" readonly="true"  value="Nothing to show" class="form-control rounded">
                       @endif
                      </div>
                    </div>

                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Coverage</label>
                      <div class="col-sm-10">
                       @if($policydetails->policy_product == 'Motor Insurance')
                        <input type="text" readonly="true" value="{{ $fetchrecord->vehicle_cover }}" class="form-control rounded">   
                         @elseif($policydetails->policy_product == 'Fire Insurance')
                        <input type="text" readonly="true" value="{{ $policydetails->coverage }}" class="form-control rounded">  
                        @elseif($policydetails->policy_product == 'Bond Insurance')
                        <input type="text" readonly="true" value="{{ $fetchrecord->bond_risk_type }}" class="form-control rounded"> 
                        @elseif($policydetails->policy_product == 'Engineering Insurance')
                        <input type="text" readonly="true" value="{{ $fetchrecord->car_risk_type }}" class="form-control rounded">  
                        @elseif($policydetails->policy_product == 'Marine Insurance')
                        <input type="text" readonly="true" value="{{ $fetchrecord->marine_risk_type }}" class="form-control rounded"> 
                        @elseif($policydetails->policy_product == 'General Accident Insurance')
                        <input type="text" readonly="true" value="{{ $fetchrecord->accident_risk_type }}" class="form-control rounded"> 
                        @elseif($policydetails->policy_product == 'Liability Insurance')
                        <input type="text" readonly="true" value="{{ $fetchrecord->liability_risk_type }}" class="form-control rounded"> 
                         @else
                       <input type="text" readonly="true"  value="{{ $fetchrecord->RISKLINE }}" class="form-control rounded">
                       @endif                   
                      </div>
                    </div>
                   
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Policy number</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->master_policy_number }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Issue date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->created_on }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Start date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->insurance_period_from }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">End date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->insurance_period_to }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->policy_status }}" class="form-control rounded">                        
                      </div>
                    </div>

                    </form>
                    </div>
                    </section>

                <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Sales
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Sales type</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->policy_sales_type }}" class="form-control rounded">                        
                      </div>
                    </div>
                    </form>
                    </div>
                    </section>


                <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Renewal
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Renewal status</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="Not Renewed" class="form-control rounded">                        
                      </div>
                    </div>
                    </form>
                    </div>
                    </section>



                          </ul>
                        </div>
                        <div class="tab-pane" id="diagnosis_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                   <section class="panel panel-info portlet-item">
                                      <header class="panel-heading">
                                        Quick View
                                      </header>

                                       <div class="table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                        <th>Cession Year </th>
                                          <th>Cession Number </th>
                                          <th>Object # </th>
                                          <th>Reinsurer </th>
                                          <th>FAC Offer</th>
                                          <th>Share %</th>
                                          <th>Commission</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach( $reinsurances as $reinsurance )
                                      <tr>
                                       <td><a href="#">{{ Carbon\Carbon::parse($reinsurance->record_date)->year }}</a></td>
                                       <td><a href="/view-cession/{{ $reinsurance->cession_number }}">{{ $reinsurance->cession_number }}</a></td>
                                        <td><a href="/view-cession/{{ $reinsurance->cession_number }}">{{ $reinsurance->item_id }}</a></td>
                                        <td>{{ $reinsurance->reinsurer_broker }}</td>
                                        <td>{{ $reinsurance->facultaive_offer }}</td>
                                        <td>{{ $reinsurance->facultative_percentage }}</td>
                                        <td>{{ $reinsurance->facultative_comm}}</td>
                                       
                                        <td>{{ $reinsurance->status }}</td>
                                        
                                      </tr>
                                     @endforeach  
                                      </tbody>
               
                                    </table>
                                  </div>
                                      
                          </section>
                          </ul>
                        </div>
                        <div class="tab-pane" id="claims_tab">
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
                        <div class="tab-pane" id="document_tab">
                         <img src="/images/214273.svg" width="5%"  class="pull-right">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                      <a href="#attach_document" class="bootstrap-modal-form-open" data-toggle="modal"><span class="label bg-success pull-right">Add New</span></a>
                      
                    </header>
                          <div class="table-responsive">
                    @foreach($images as $keys => $image)
                   

                   <div class="col-md-3 col-sm-4 thumb-lg">
  
                    @if($image->mime == 'docx')
                   <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/images/ms_word.png' !!}" class="img-circle">
                              </a>  {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @elseif($image->mime == 'pdf')
                     <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/images/pdf.png' !!}" class="img-circle">
                              </a>{{ $image->filename }} <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a> <span class="label label-default btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $image->created_on}}">{{ $image->created_on->diffForHumans() }}</span>
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

                        @if($policydetails->policy_product == 'Motor Insurance')
                        <div class="tab-pane" id="object_list">
                        <img src="/images/880505.svg" width="5%"  class="pull-right">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          
                          <div class="table-responsive">
                           <form  method="post" action="/bulk-renew-policy" >
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <th width="20"><input type="checkbox"></th>
                            <td></td>
                            <th>Registration #</th>
                            <th>Make & Model</th>
                            <th>Cover</th>
                            <th>Vehicle Value</th>
                            <th>Premium</th>
                            <th>Make Year</th>
                            <th>Seat Capacity</th>
                            <th>Cubic Capacity</th>
                          {{--   <th>Chasis</th> --}}
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th></th>
                           {{--  <th></th>
                             <th></th> --}}
                          </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($vehicles as $keys => $vehicle)
                         <tr>
                          <td><input type="checkbox" name="vehicle[{{ $vehicle->id }}]" id="{{ $vehicle->id }}" value="{{ $vehicle->id }}"></td>
                         <td> {{ ++$keys }}</td>
                        <td>{{ $vehicle->vehicle_registration_number }}</td>
                        <td>{{ $vehicle->vehicle_make }} - {{ $vehicle->vehicle_model }}</td>
                        <td>{{ $vehicle->vehicle_cover }}</td>
                        <td>{{ $vehicle->vehicle_currency  }}{{ number_format($vehicle->vehicle_value, 2, '.', ',') }}</td>
                        <td>{{ $vehicle->premium_due }}</td>
                        <td>{{ $vehicle->vehicle_make_year }}</td>
                        <td>{{ $vehicle->vehicle_seating_capacity }}</td>
                        <td>{{ $vehicle->vehicle_cubic_capacity }}</td>
                       {{--  <td>{{ $vehicle->CHASSIS_NO }}</td> --}}
                        <td>{{ $vehicle->period_to }}</td>
                        <td> 
                        @if($vehicle->period_to < Carbon\Carbon::now())
                            <a href="#" data-toggle="class" onclick="computePremium('{{ $vehicle->registration_number }}')" class="label bg-danger m-l-xs"><span class="text-default">Expired</span> </a>
                            @else
                              <span class="text-info">Running</span> 
                             @endif
                          
                        </td>
                        <td>

                        <div class="input-group-btn">
                      <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">Renew</a></li>
                        <li><a href="#">Cancel</a></li>
                        <li><a href="#">Suspend</a></li>
                        <li><a href="#">Deactivate</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Print Schedule</a></li>
                        <li><a href="#">Print Policy</a></li>
                      </ul>
                    </div>
                    </td>

                        </tr>
                        @endforeach

                        </tbody>
                      </table>


                        <br>
                        <br>
                      @if($vehicles->count() > 10)
                      <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
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
                      
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                     
                      <input type="hidden" name="_token" value="{{ Session::token() }}">
                       <input type="hidden" name="policy_number" id="policy_number" value="{{ $policydetails->policy_number }}">
                      <button type="submit" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-refresh"></i>  Bulk Renewal </button>

                    </div>
                    
                  </div>
                   
               
                </footer>
                @else

                @endif



                      </form>
                    </div>
                          </ul>
                        </div>
                        @elseif($policydetails->policy_product == 'Fire Insurance')
          

                        <div class="tab-pane" id="object_list">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                     
                      
                    </header>
                          
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <td></td>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Sum Insured</th>
                            <th></th>
                             <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        
                         @foreach($objects as $keys => $object)
                         <tr>
                         <td> {{ ++$keys }}</td>
                        <td>{{ $object->property_type }}</td>
                        <td>{{ $object->property_description }}</td>
                        <td>{{  $policydetails->policy_currency  }}{{ $object->item_value }}</td>
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

                        
                        @elseif($policydetails->policy_product == 'Bond Insurance')
                        <div class="tab-pane" id="object_list">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                     
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <td></td>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Interest</th>
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
                        <td>{{ $object->bond_risk_type }}</td>
                        <td>{{ $object->bond_contract_description }}</td>
                        <td>{{ $object->bond_interest }}</td>
                        <td>{{ $policydetails->policy_currency  }}{{ $object->bond_sum_insured }}</td>
                        <td>{{ $object->net_premium }}</td>
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
                        @elseif($policydetails->policy_product == 'Engineering Insurance')
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
                        <td>{{ $policydetails->policy_currency  }}{{ $object->car_contract_sum }}</td>
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
                        @elseif($policydetails->policy_product == 'Marine Insurance')
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
                        <td>{{ $policydetails->policy_currency  }}{{ $object->marine_sum_insured }}</td>
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

                        @elseif($policydetails->policy_product == 'General Accident Insurance')
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
                        
                        <td>{{ $policydetails->policy_currency  }}{{ $object->general_accident_sum_insured }}</td>
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


                         
                        <div class="tab-pane" id="invoices_tab">
                      <img src="/images/845752.svg" width="5%"  class="pull-right">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">

                                 <div class="table-responsive">
                                 
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                           <th>Invoice #</th>
                                            <th>Date</th>
                                            <th>Item ID</th>
                                            <th>Currency</th>
                                            <th>Premium</th>
                                            <th>Paid</th>
                                            <th>Status</th>
                                            <th>Generated By</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                     @foreach($bills as $bill )
                                    <tr>
                                      <td>{{ $bill->invoice_number }}</td>
                                      <td>{{ $bill->invoice_date }}</td>
                                       <td>{{ $bill->reg_number }}</td>
                                      <td>{{ $bill->currency }}</td>
                                      <td>{{ number_format($bill->amount, 2, '.', ',') }}</td>
                                      <td>{{ number_format($bill->paid_amount, 2, '.', ',') }}</td>
                                      <td>{{ $bill->payment_status }}</td>
                                      <td>{{ $bill->created_by }}</td>
                                    </tr>
                                   @endforeach 
                                      </tbody>
                                    </table>
                                   
                                  </div>
                          </ul>
                        </div>

                        <div class="tab-pane" id="receipts_tab">
                            <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                 <div class="table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                           <th>Receipt #</th>
                                            <th>Date</th>
                                            <th>Currency</th>
                                            <th>Premium</th>
                                            <th>Paid</th>
                                            <th>Generated By</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                     @foreach($receipts as $receipt )
                                    <tr>
                                      <td>{{ $receipt->receipt_number }}</td>
                                      <td>{{ $receipt->receipt_date }}</td>
                                      <td>{{ $receipt->currency }}</td>
                                      <td>{{ number_format($receipt->amount_payable, 2, '.', ',') }}</td>
                                      <td>{{ number_format($receipt->amount_paid, 2, '.', ',') }}</td>
                                      <td>{{ $receipt->created_by }}</td>
                                    </tr>
                                   @endforeach 
                                      </tbody>
                                    </table>
                                   
                                  </div>
                          </ul> 
                        </div>

                      </div>
                    </section>
                  </section>
                </aside>


 @if($policydetails->policy_product == 'Motor Insurance')
              <aside class="col-lg-2 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">


                       
                       
                         <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong>NCD Discount </strong></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>{{ $fetchrecord->ncd_percent * 100}}%</p>
                               
                            </li>
                           
                          </ul>
                          <h4 class="font-thin padder"><strong>Fleet Discount </strong></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>{{ $fetchrecord->vehicle_fleet_discount }}%</p>
                               
                            </li>
                           
                          </ul>
                        </section> 


                          <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Customer payment </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                             <a class="list-group-item" href="#">
                            <span class="badge bg-danger">{{ number_format($bills->sum('amount'), 2, '.', ',') }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Customer payable
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-info"> {{ number_format($receipts->sum('paid_amount'), 2, '.', ',') }}</span>
                            <i class="fa fa-money"></i> 
                            Customer paid
                          </a>
                         
                          <a class="list-group-item" href="#">
                            <span class="badge bg-light">{{    number_format($bills->sum('amount') - $receipts->sum('paid_amount'), 2, '.', ',')  }}</span>
                            <i class="fa  fa-qrcode"></i> 
                           Policy balance
                          </a>
                        </div>
                          </ul>
                        </section>



                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Fleet Upload</header>

                               
                                 <input type="file" class="form-control dropbox" width="500px" height="40px" name="file"/>\
                                  <a href="/images/fleet_upload_file.csv" target="new" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-danger pull-right"><i class="fa fa-download"></i>Download File</span></a>
                               
                    </section>
                       

                        {{-- <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Commission </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $balancesheet->commission_rate, 2, '.', ',') }}%</span>
                            <i class="fa fa-money"></i> 
                            Commission Rate
                          </a>
                           <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ ($balancesheet->amount * ($balancesheet->commission_rate/100)), 2, '.', ',') }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Gross Commission
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ (($balancesheet->amount * ($balancesheet->commission_rate/100)) * 5/100)), 2, '.', ',') }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Tax
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ ($balancesheet->amount * ($balancesheet->commission_rate/100)) - (($balancesheet->amount * ($balancesheet->commission_rate/100)) * 5/100) }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Commission Receivable
                          </a>
                         
                        </div>
                          </ul>
                        </section> --}}


                       
                       

                

                      </div>
                    </section>
                    </section>
                    </aside>
                    @else

@endif


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
          <form method="post"  enctype="multipart/form-data" action="/uploadfiles">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $policydetails->policy_number }}">
          <input type="hidden" name="selectedcustomer" id="selectedcustomer" value="{{ $policydetails->account_number }}">
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
    "showDropdowns": true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
  function deletePolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was delete from policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to delete.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to delete.", "error");   
        } });

    
   }

   function suspendPolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to suspend "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/suspend-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Suspended!", name +" was suspended from policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to suspend.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to suspend.", "error");   
        } });

    
   }


   function cancelPolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to cancel "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/cancel-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Cancelled!", name +" was cancelled from policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to cancel.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to cancel.", "error");   
        } });

   }

  
function computePremium(id)
{

  //alert("Hello");

    $.get('/compute-renewal-premium',
        {


          "registration": id
         


        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
          sweetAlert("Renewal Premium Payable : ", data["Premium"], "info");
          //$('#gross_premium').val(data.Premium);
       
      });
                                        
        },'json');
  
}


   function lockPolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to lock "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/lock-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Locked!", name +" was locked in policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to lock.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to lock.", "error");   
        } });

   }

   function approvePolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to approve  "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, approve it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/approve-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Approved!", name +" was approved in policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to approved.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to approved.", "error");   
        } });

   }
</script>






