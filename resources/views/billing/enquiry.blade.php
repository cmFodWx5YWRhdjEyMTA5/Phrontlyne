@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Bill Manager</div>
              <ul class="nav">
              <li class="b-b b-light"><a href="/billing-dashboard"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Dashboard</a></li>
              <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Patient Enquiry</a></li>
              <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Patients</a></li>
              <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Copayers</a></li>
                <div class="line"></div>
                <li class="b-b b-light"><a href="billing-index"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Invoices</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Payments</a></li>
                 <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Receipts</a></li>
                  <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Special Offers</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Add New Bill</a>

                    <span class="badge badge-info">Record(s) Found : {{ $bills->total() }} {{ str_plural('Bills', $bills->total()) }}</span>

                     <span class="badge badge-info btn-dark">Total Amount Billable : GHS {{ $bills->sum('amount') }} </span>
                    </div>

                  <form action="/find-bill" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a patient">
                        <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="submit">Go!</button>
                        </span>
                      </div>
                    </div>
                     </form>
                    </div>
                  </div>
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none">
                        <thead>
                          <tr>
                            <th>Invoice No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Bill Quantity</th>
                            <th>Amount</th>
                            <th>Due</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($bills as $bill )
                          <tr>
                            
                            <td><a href="/billing-invoice/{{ $bill->visit_id }}" class="text-danger">IN-{{ $bill->id }}</a></td>
                            <td>{{ $bill->fullname }}</td>
                            <td>{{ $bill->item_name }}</td>
                            <td>{{ $bill->date }}</td>
                            <td>{{ $bill->quantity  }}</td>
                            <td>{{ $bill->amount }}</td>
                             <td>{{ $bill->amount*$bill->quantity }}</td>
                            
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                </section>
                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                     {!!$bills->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

