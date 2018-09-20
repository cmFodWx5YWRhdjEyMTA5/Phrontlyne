@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Commission Station </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/138306.svg" width="15%" class="pull-left">
                    <a class="clear" href="/commission"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Pending Commissions</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/148968.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/processed-commissions">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Processed</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/138203.svg" width="15%" class="pull-left">
                    <a class="clear" href="/payment-logs">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Paid</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/138210.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/service-charges">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Report</small>
                    </a>
                  </div>

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">


                  {{-- <header class="panel-heading">
                    <form action="/find-bill" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by patient, insurance, encounter">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search!</button>
                        </div>
                      </div>
                      </form>
                    </header> --}}

                    <header class="panel-heading">
                    <form action="/find-commission" method="GET">
                      <div class="input-group text-ms">
                        
                        <div class="col-md-8">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by insured, business class, item id, policy number, status">
                        </div>
                       
                         <div class="col-md-4">
                        <input type="text" name='commission_period' id='commission_period' class="input-sm form-control" placeholder="Commission payment period">
                        </div>
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search List!</button>
                        </div>
                      </div>
                      </form>
                    </header>

                          <br>
                        <form  method="post" action="/process-commission-bulk-master" >
                        <input type="hidden" name="_token" id="_token" value="{{ Session::token() }}">
                      <button type="submit" class="btn btn-sm btn-success rounded pull-right"><i class="fa fa-add"></i>  Click to Process Bulk Commission </button>
                      <br>
                    <div class="table-responsive">
                       <br>
                     <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                             <th width="20"><input type="checkbox" ></th>
                            <th></th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Receipt Number</th>
                            <th>Currency</th>
                            <th>Premium Payable</th>
                            <th>Premium Paid </th>
                            <th>Agency</th>
                            <th>Branch</th>
                            <th>Generated By</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                       
                       @foreach( $bills as $keys => $bill )
                          <tr>
                            <td><input type="checkbox" name="item[]" id="item" value="{{ $bill->id }}"></td>
                            <td>{{ ++$keys }}</td>
                            <td>{{ $bill->insured }}</td>
                            <td>{{ $bill->policy_product }}</td>
                            <td>{{ $bill->created_on }}</td>
                            <td>{{ $bill->receipt_number }}</td>
                            <td>{{ $bill->currency }}</td>
                            <td>{{ $bill->amount_payable }}</td>
                            <td>{{ $bill->amount_paid }}</td>
                           <td>{{ $bill->agency }}</td>
                           <td>{{ $bill->branch }}</td>
                            <td>{{ $bill->created_by }}</td>
                            <td>
                              <a href="/process-commission/{{ $bill->id }}" class="btn btn-s-md btn-danger btn-rounded bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit">Process Commission</a> </td>
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
                  

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                    
                      <p class="text-muted m-t pull-center">
                     
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                      {!!$bills->render()!!} 
                        
                    </div>
                  </div>
                   </form>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#commission_period span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#commission_period').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});


</script>

  




