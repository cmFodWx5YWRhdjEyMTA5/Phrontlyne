@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p>{{ $patients[0]->fullname }}'s Bill</p>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/{{ $patients[0]->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $patients[0]->image }}" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $patients[0]->fullname }}</div>
                            <br>
                            <div>
                           <span class="label label-default">{{ $patients[0]->patient_id }}</span>
                            </div>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients[0]->gender }}</span>
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients[0]->date_of_birth->age }}</span>
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">{{ $patients[0]->civil_status }}</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       
                        <div>
                          <small class="text-uc text-xs text-muted">Mobile</small>
                          <p>+{{ $patients[0]->mobile_number }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Address</small>
                          <p>{{ $patients[0]->postal_address }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Email</small>
                         <p>{{ $patients[0]->email }}</p>
                          </div>

                          <div>
                            <small class="text-uc text-xs text-muted">Date</small>
                          <p>{{ date('Y-m-d') }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Visit Number</small>
                          <br>
                          <br>
                          <p><span class="label label-info">{{ $bills[0]->visit_id }}</span></p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted"><strong>Billable</strong></small>
                          <br>
                           <p class="btn btn-xs btn-danger m-t-ml">GHS {{ $bills->sum('amount') }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted"><strong>Debit</strong></small>
                          <br>
                          <p class="btn btn-xs btn-dark m-t-ml">GHS {{ $balances->sum('bill_total') }}</p>
                           <div class="line"></div>
                          <small class="text-uc text-xs text-muted"><strong>Credit</strong></small>
                          <br>
                          <p class="btn btn-xs btn-dark m-t-ml">GHS {{ $balances->sum('AmountReceived') }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted"><strong>Balance</strong></small>
                          <br>
                          <p class="btn btn-xs btn-success m-t-ml">GHS {{ $balances->sum('bill_total')-$balances->sum('AmountReceived') }}</p>

                           {{-- <p>{!! QrCode::size(100)->generate(Request::url()); !!}</p> --}}
                           {{-- <small class="text-uc text-xs text-muted">Total Items</small>
                           <p class="btn btn-xs btn-success m-t-ms"> {{ $bills->count('item_name') }}</p> --}}
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#consultation_tab" data-toggle="tab"> Billable Items </a></li>
                        <li class=""><a href="#transaction_tab" data-toggle="tab"> Transactions </a></li>
                        <li class=""><a href="#prepaid_tab" data-toggle="tab"> Prepaids </a></li>
                        <li class=""><a href="#balance_sheet_tab" data-toggle="tab"> Balance Sheet </a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="consultation_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          @foreach($bills as $bill)
                            @if($bill->note != null)
                            <li class="list-group-item animated fadeInRightBig">
                              <a href="#" class="thumb-sm pull-left m-r-sm" data-toggle="class:show,hide">
                                <img src="/images/avatar_default.jpg" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right"><i class="fa fa-clock-o"></i> {{ $bill->date }}</small>
                                <strong class="block">{{ $bill->item_name }}</strong>
                                <small class="text-danger">GHS {{ $bill->amount }}</small>
                                <a href="#comment-id-3" data-dismiss="alert" class="btn btn-default btn-xs">
                              <i class="fa fa-trash-o text-muted"></i> 
                              Remove
                            </a>
                              </a>
                            </li>
                            @else
                            

                            @endif
                            @endforeach
                          </ul>
                        </div>

                         <div class="tab-pane" id="balance_sheet_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                           <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Doc Type</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($balances as $key => $balance )
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $balance->date }}</td>
                            <td>{{ $balance->visit_id }}</td>
                            <td>{{ $balance->bill_total }}</td>
                            @if($balance->AmountReceived==null) <td> 0 </td>
                            @else <td> {{ $balance->AmountReceived  }} </td>

                            @endif
                            <td>{{ $balance->bill_total-$balance->AmountReceived }}</td>
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
                       
                        <section class="panel clearfix bg-default lter">
                          <div class="panel-body">
                            <span class="pull-left thumb-sm"><i class="fa fa-file-o fa-3x icon-muted"></i></span>
                            <div class="clear">
                              <a href="#" class="text-info">{{ $patients[0]->fullname }} <i class="fa fa-credit-card"></i></a>
                              <small class="block text-muted">Make Payment</small>
                              <a href="#show_payment_form" onclick="getDetails('{{ $bills[0]->id }}')"  data-toggle="modal" class="btn btn-xs btn-success m-t-xs bootstrap-modal-form-open">Make Payment</a>
                              
                              <a href="/billing-print/{{ $bills[0]->visit_id }}" class="btn btn-xs btn-success m-t-xs">Print Invoice</a>
                              <a href="/billing-email/{{ $bills[0]->visit_id }}" class="btn btn-xs btn-success m-t-xs">Email Invoice</a>
                            </div>
                          </div>
                        </section>


                      </div>
                    </section>
                    </section>
                    </aside>
                    </section>
                    </section>
                    </section>

  @stop


<div class="modal fade" id="show_payment_form" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Invoice<span id="selectedName"></span></h4>
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
                        <div class="tab-pane active" id="details">
                            <form  class="bootstrap-modal-form" method="post" action="/do-payment" class="panel-body wrapper-lg">
                          @include('billing/payments')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                      
                    
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>



<script type="text/javascript">
  

function getDetails(id)
{ 


  
  $.get("/get-invoice-info",
          {"id":id
       
          },
          function(json)
          {

              
                $('#show_payment_form input[name="patient_id"]').val(json.patient_id);
                $('#show_payment_form input[name="fullname"]').val(json.fullname);
                $('#show_payment_form input[name="visit_id"]').val(json.visit_id);
       
           

                loadinvoiceitems();
               
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}


function loadinvoiceitems()
   {
         

        $.get('/invoice-list',
          {
            "opd_number": $('#visit_id').val()
          },
          function(data)
          { 

            $('#invoiceTable tbody').empty();
            $.each(data, function (key, value) 
            {           
           $('#invoiceTable tbody').append('<tr><td>'+ value['item_name'] +'</td><td>'+ value['quantity'] +'</td><td>'+ value['rate'] +'</td><td>0</td><td>0</td><td>'+ value['amount'] +'</td><td><a a href="#"><i onclick="removeinvestigation(\''+value['id']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

</script>

