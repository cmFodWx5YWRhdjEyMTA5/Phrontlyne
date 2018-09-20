@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p class="h4 text-dark"><strong>Claim Number : {{ $claims->claim_number  }}</strong></p>
              
             
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
        
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#my_info" data-toggle="tab">Overview</a></li>
                        <li class=""><a href="#my_policies" data-toggle="tab">Progress</a></li>
                        <li class=""><a href="#my_objects" data-toggle="tab">Documents</a></li>
                        <li class=""><a href="#my_quotes" data-toggle="tab">Photos</a></li>
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
                  Claim Information
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Claim ID</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->claim_number }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Customer</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->insurer_contact_name }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->status_of_claim }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Loss Date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->loss_date }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Date submitted to broker</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->submit_broker_date }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Settlement Date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->settlement_date }}" class="form-control rounded">                        
                      </div>
                    </div>
                    
                    </form>
                    </div>
                    </section>

                <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Policy
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Policy</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->policy_number }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Insurer</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->policy_insurer }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Product</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->insurer_contact_phone }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Start Date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->period_from }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">End Date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->period_to }}" class="form-control rounded">                        
                      </div>
                    </div>
                    </form>
                    </div>
                    </section>

                    <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Loss Information
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Location of loss</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->location_of_loss }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Damage description</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $claims->loss_description }}" class="form-control rounded">                        
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
                            <th> Date </th>
                            <th> Claim handler </th>
                            <th> Status </th>
                            <th> Info </th>
                            <th> </th>
                            <th> </th>
                          </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
 
                      </table>
                    </div>
                          </ul>
                        </div>

                        <div class="tab-pane" id="my_objects">
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
                    <div class="tab-pane" id="my_quotes">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
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
                          <h4 class="font-thin padder"><strong> Amount </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $claims->loss_amount }}</span>
                            <i class="fa fa-money"></i> 
                            Loss amount
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $claims->excess_amount }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Excess / Deductible
                          </a>
                  
                        </div>
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
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $claims->claim_number }}">
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






