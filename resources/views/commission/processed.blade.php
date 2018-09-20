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
                            
                            
                            <th></th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Receipt Number</th>
                            <th>Currency</th>
                            <th>Premium Paid </th>
                            <th>Gross Comm </th>
                            <th>Tax </th>
                            <th>Net Comm</th>
                            <th>Agency</th>
                            <th>Branch</th>
                            <th>Generated By</th>
                            <th></th>
                            <th></th>
                            <th></th>

                          </tr>
                        </thead>
                        <tbody>
                       @foreach( $commissions as $keys => $bill )
                          <tr>
                       
                            <td>{{ ++$keys }}</td>
                            <td>{{ $bill->insured_name }}</td>
                            <td>{{ $bill->policy_product }}</td>
                            <td>{{ $bill->created_on }}</td>
                            <td>{{ $bill->receipt_number }}</td>
                            <td>{{ $bill->currency }}</td>
                            <td>{{ number_format($bill->amount_paid, 2, '.', ',') }}</td>
                            <td>{{ number_format($bill->gross_commission, 2, '.', ',') }}</td>
                            <td>{{ number_format($bill->tax, 2, '.', ',') }}</td>
                            <td>{{ number_format($bill->net_commission, 2, '.', ',') }}</td>
                           <td><a href="/commission-advice/{{ $bill->id }}"> {{ $bill->agent_number }}</a></td>
                           <td>{{ $bill->branch }}</td>
                          <td>{{ $bill->created_by }}</td>
                            <td>
                              <a href="#" class="active" onclick="doApprove('{{ $bill->id }}','{{ $bill->agent_number }}')" data-toggle="class"><i class="fa fa-thumbs-up" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve Commission"></i></a>
                            </td>
                           <td>
                              <a href="/commission-advice/1" data-toggle="class"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Payment Advice"></i></a>
                            </td>
                            <td>
                              <a href="#" class="active" onclick="doDelete('{{ $bill->id }}','{{ $bill->insured_name }}')" data-toggle="class"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Commission"></i></a>
                            </td>
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
                     
                      {!!$commissions->render()!!} 
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop











  


  




