@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Sticker Management Station </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/148968.svg" width="15%" class="pull-left">
                    <a class="clear" href="/sticker-issued"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Issued Sticker</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/845582.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/sticker-returns">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Returns</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/628436.svg" width="15%" class="pull-left">
                    <a class="clear" href="/payment-logs">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Damages</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/839847.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/service-charges">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Reports</small>
                    </a>
                  </div>

                 
                </div>
              </section>



              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">



                    <header class="panel-heading">
                    <form action="/find-invoice" method="GET">
                      <div class="input-group text-ms">
                        
                        <div class="col-md-8">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by insured, business class, item id, policy number, status">
                        </div>
                       
                         <div class="col-md-4">
                        <input type="text" name='review_period' id='review_period' class="input-sm form-control" placeholder="Search by patient, test, status">
                        </div>
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search List!</button>
                        </div>
                      </div>
                      </form>
                    </header>


                    <div class="table-responsive">

                     <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            
                             <th>Sticker #</th>
                            <th>Vehicle Number</th>
                            <th>Issued To</th>
                            <th>Insurance Period</th>
                            <th>Created By</th>
                            <th>Created On</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                      
                            @foreach($returnstickers as $item)
                            <td> {{ $item->sticker_number }}</td>
                            <td> {{ $item->vehicle_registration_number }}</td>
                            <td>{{$item->owner_details}}</td>
                            <td>{{Carbon\Carbon::parse($item->period_from )->format('d-m-Y') }} to {{ Carbon\Carbon::parse($item->period_to )->format('d-m-Y') }}</td>
                            <td>{{ $item->created_by }}</td>
                            <td>{{ $item->created_on }}</td>
                            
                            
                             </tr> 
                            @endforeach
                          
                           
                       
                        </tbody>
 
                      </table>
                    </div>
                  </section>
         
                </div>
              </div>

            </section>
             <footer class="footer bg-white b-t">
                  <a href="#new-assignment" class="bootstrap-modal-form-open float" data-toggle="modal">
<i class="fa fa-plus my-float"></i><i class="fa fa-file my-float"></i>
</a>

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $returnstickers->total() }} {{ str_plural('Sticker', $returnstickers->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                      {!!$returnstickers->render()!!} 
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop



  <div class="modal fade" id="new-assignment" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Document Assignment</h4>
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
                           <form  class="bootstrap-modal-form" data-parsley-validate="" method="post" action="/sticker-generated">
                           @include('invoices/sticker_create')
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
  $('#date_of_issue').daterangepicker({
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


