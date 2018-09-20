@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p class="h4 text-dark"><strong>Customer : {{ $customers->account_number  }} ( {{ $customers->fullname }} )</strong></p>
              
              <div class="btn-group pull-right">
              <p>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-ban"></i> Cancel</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-trash"></i> Delete</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw  fa-refresh"></i> Renew</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw  fa-lock"></i> Lock</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print</a>
              </p>
              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
        
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#my_info" data-toggle="tab">Overview</a></li>
                        <li class=""><a href="#my_policies" data-toggle="tab">Policies</a></li>
                        <li class=""><a href="#my_quotes" data-toggle="tab">Quotes</a></li>
                        <li class=""><a href="#my_invoices" data-toggle="tab">Invoices</a></li>
                        <li class=""><a href="#my_documents" data-toggle="tab">Documents</a></li>
                        <li class=""><a href="#my_claims" data-toggle="tab">Claims</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="my_info">
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
                      <label class="col-sm-2 control-label">Customer Type</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ ucwords(strtolower($customers->account_type)) }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ ucwords(strtolower($customers->fullname)) }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">DOB</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $employees->date_of_birth->age or 0}} year(s)" class="form-control rounded">                     
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ ucwords(strtolower($customers->email)) }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Mobile Phone</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers->mobile_number }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Account Manager</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers->created_by }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Address</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ ucwords(strtolower($customers->postal_address)) }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Filed of Activity</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers->field_of_activity }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers->status }}" class="form-control rounded">                        
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
                      <label class="col-sm-2 control-label">Sales Channel</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers->sales_channel }}" class="form-control rounded">                        
                      </div>
                    </div>
                    </form>
                    </div>
                    </section>



                          </ul>
                        </div>
                        <div class="tab-pane" id="my_policies">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                           <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th> #</th>
                            <th>Policy Number</th>
                            <th>Validity</th>
                            <th>Object</th>
                            <th>Created On</th>
                            <th>Created By</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($policies as $key => $policy )
                          <tr>
                            <td>{{ ++$key }}</td>
                           <td><a href="/view-policy/{{ $policy->policy_number }}"> {{ $policy->policy_number }}</a></td>
                            <td>{{ $policy->insurance_period_from }} to {{ $policy->insurance_period_to }}</td>
                            <td>{{ $policy->policy_product }}</td>
                            <td>{{ $policy->created_on }}</td>
                            <td>{{ $policy->created_by }}</td>
                            <td> 
                        @if($policy->insurance_period_to < Carbon\Carbon::now())
                            <a href="#" class="label bg-danger m-l-xs"><span class="text-default">Expired</span> </a>
                            @else
                              <span class="text-info">Running</span> 
                             @endif
                            </a> 
                        </td>
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                          </ul>
                        </div>
                        <div class="tab-pane" id="my_objects">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Object</th>
                            <th>Type</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>
                    <div class="tab-pane" id="my_quotes">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                     <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Quote #</th>
                            <th>Object</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Broker</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>

                  <div class="tab-pane" id="my_invoices">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                 <div class="table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                           <th>Invoice #</th>
                                            <th>Date</th>
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
                                      <td>{{ $bill->currency }}</td>
                                      <td>{{ $bill->amount }}</td>
                                      <td>{{ $bill->paid_amount }}</td>
                                      <td>{{ $bill->payment_status }}</td>
                                      <td>{{ $bill->created_by }}</td>
                                    </tr>
                                   @endforeach 
                                      </tbody>
                                    </table>
                                   
                                   
                                  </div>
                          </ul>
                        </div>

                        <div class="tab-pane" id="my_documents">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                     <header class="panel-heading">
                      <a href="#attach_document" class="bootstrap-modal-form-open" data-toggle="modal"><span class="label bg-success pull-right">Add New</span></a>
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>File</th>
                            <th>Comment</th>
                            <th>Added</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($images as $image)
                         <tr>
                        <td>{{ $image->filename }}</td>
                        <td>{{ $image->created_by }}</td>
                        <td>{{ $image->created_on }}</td>
                        <td>
                            <a href="{!! '/uploads/images/'.$image->filepath !!}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-eye"></i></a>
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

                        <div class="tab-pane" id="my_claims">
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
                                        <td><a href="/edit-claim/{{ $claim->id }}">{{ $claim->claim_id }}</a></td>
                                        <td>{{ $claim->item_id  }}</td>
                                        <td>{{ $claim->cause_of_loss  }}</td>
                                        <td>{{ $claim->loss_date  }}</td>
                                        <td>{{ $claim->currency  }} </td>
                                        <td>{{ $claim->estimated_amount  }}</td>
                                        <td>{{ $claim->approved_amount }}</td>
                                        <td>{{ $claim->paid_amount }}</td>
                                        <td>{{ $claim->status }}</td> 
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
                <aside class="col-lg-4 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">

                        <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Customer Balance </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $bills->sum('DOCUMENT_AMOUNT') }}</span>
                            <i class="fa fa-money"></i> 
                            Generated Invoices
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-info">0</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Payments
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-danger">0</span>
                            <i class="fa  fa-heart-o "></i> 
                           Balance Total
                          </a>
                        </div>
                          </ul>
                        </section>
                       


                       

                        <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Sales Opportunities </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          {{-- <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $policydetails[0]->commission }}%</span>
                            <i class="fa fa-money"></i> 
                            Commission 
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $policydetails[0]->amount * ($policydetails[0]->commission/100) }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Commission 
                          </a> --}}
                         
                        </div>
                          </ul>
                        </section>
                       

                         <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong>Task</strong></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this new phrontlyne web application , have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                           
                          </ul>
                        </section>

                           <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong>Notes</strong></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this new phrontlyne web application , have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                           
                          </ul>
                        </section>
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
          <form method="post"  enctype="multipart/form-data" action="/uploadfiles">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $customers->ID  }}">
          <input type="hidden" name="selectedcustomer" id="selectedcustomer" value="{{ $customers->ID  }}">
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



