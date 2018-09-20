@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Finance Station </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/179440.svg" width="15%" class="pull-left">
                    <a class="clear" href="/invoice"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Pending Bills</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/845582.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/invoice-processed">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Payments</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/147262.svg" width="15%" class="pull-left">
                    <a class="clear" href="/payment-logs">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Payment Logs</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/839847.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/service-charges">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Journals</small>
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
                    <form action="/find-invoice" method="GET">
                      <div class="input-group text-ms">
                        
                        <div class="col-md-8">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by insured, business class, item id, policy number, status">
                        </div>
                       
                         <div class="col-md-4">
                        <input type="text" name='review_period' id='review_period' class="input-sm form-control" placeholder="Enter period">
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
                            
                            
                            <th>Invoice #</th>
                            <th>Customer</th>
                            <th>Item</th>
                            <th>Product</th>
                            <th>Date</th>
                             <th>Currency</th>
                            <th>Premium</th>
                            <th>Paid</th>
                           {{--  <th>Balance</th>
                            <th>Status</th> --}}
                            <th>Generated By</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                       @foreach( $bills->groupby('invoice_number') as $bill )
                          <tr>

                            @foreach($bill as $item)
                            <td>{{ $item->invoice_number }}</td>
                            <td>{{$item->fullname}}</td>
                            <td>{{$item->reg_number}}</td>
                            <td>{{ ucwords(strtolower($item->policy_product)) }}</td>
                            <td>{{ $item->created_on }}</td>
                            <td>{{ $item->currency }}</td>
                            <td>{{ number_format($item->amount  , 2, '.', ',')}}</td>
                            <td>{{ $item->payment_status }}</td>
                            <td>{{ $item->created_by }}</td>
                             <td>
                              <a href="/billing-invoice/{{ $item->id }}" class="btn btn-s-md btn-danger btn-rounded bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit">Collect Payment</a> </td>
                             
                             <td><a href="/print-invoice/{{ $item->id }}" data-toggle="modal" ><i class="fa fa-print"></i></a></td>
                             </tr>
                            @endforeach
                            <tr>
                             <td colspan="8" class="text-right no-border"><strong>Debit Total</strong></td>
                               <td> <strong>{{ number_format($bill->sum('amount'), 2, '.', ',') }} </strong></td>
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
                      <span class="badge badge-info">Record(s) Found : {{ $bills->total() }} {{ str_plural('Bill', $bills->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                      {!!$bills->render()!!} 
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop







