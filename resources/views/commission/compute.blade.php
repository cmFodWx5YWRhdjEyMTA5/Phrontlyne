@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p>{{ $bills[0]->fullname }}'s Bill </p>
                <div class="btn-group pull-right">
              <p>
                    <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $bills[0]->created_by }}</a>
                       <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $bills[0]->branch }}  </a>
                   
              </p>
              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">

                           
               {{--  <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/avatar_default.jpg" class="pull-left thumb m-r">
                            <img src="/images/avatar_default.jpg" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $bills[0]->fullname }}</div>
                            <br>
                            <div>
                           <span class="btn btn-xs btn-dark btn-rounded m-t-ml">{{ $bills[0]->account_number }}</span>
                            </div>
                            
                            </div>
                          </div>                
                        </div>


                          <div>
                          <ul class="list-group no-radius">
                          <li class="list-group-item">
                            <span class="pull-right">{{ $bills[0]->policy_number }}</span>
                           
                             <small class="text-muted">Policy</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ 0 }}</span>
                            
                             <small class="text-muted">Address</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ 0 }}</span>
                            
                             <small class="text-muted">Email</small>
                          </li>
                        </ul>
                          </div> 

                           <img src="/images/129515.svg" style="width:100%" >

                        </div>

                    </section>
                  </section>
                </aside> --}}
                 
                <aside class="bg-white">
               


                  <form  data-validate="parsley" method="post" action="/process-commission-bulk" class="panel-body wrapper-lg"> 
                  <section class="vbox">
               {{--      <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#consultation_tab" data-toggle="tab"> Billable Items </a></li>
                        
                      </ul>
                    </header> --}}
                    <header class="panel-heading">
                  Commission Items
                </header>

                   <p>
                    <a href="#" class="btn btn-danger btn-lg pull-right">Amount Due : {{$bills[0]->currency }} {{ number_format($bills->sum('amount'), 2, '.', ',') }} </a>
                  </p>
                

                         <div class="table-responsive">
               
                       <table id="invoiceTable" cellpadding="0" cellspacing="1" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th width="20"><input type="checkbox" ></th>
                               <th>#</th>
                              <th>Item ID</th>
                               <th>Risk</th>
                               <th>Commission Rate</th> 
                              <th>Amount Payable</th>
                              <th>Amount Paid</th>
                              <th>Sticker Charge</th>
                              <th>Gross Commission</th>
                              <th>Tax</th>
                              <th>Net Commission</th>
                              <th></th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($bills as $keys => $bill)
   
                        @if($bill->quantity  == 0)
                          <tr bgcolor="#FDEBD0">
                        @else
                        <tr>
                        @endif
                            <td><input type="checkbox" checked="checked" name="item[]" id="item" value="{{ $bill->id }}"></td>
                           <td>{{ ++$keys }}</td>
                            <td>{{ $bill->reg_number }}</td>
                             <td>{{ $bill->cover_type }}</td>

                             <td><input type="text" class="input-sm form-control rounded" readonly="true" value="{{ $bill->commission_rate }}" id="commission_rate" name="commission_rate[]"> </td> 
                             <td><input type="text" class="input-sm form-control rounded" readonly="true" value="{{ $bill->amount }}" id="amount_payable" name="amount_payable[]"></td></td>
                             <td> <input type="text" class="input-sm form-control rounded" readonly="true" value="{{ $bill->amount * ($payment->amount_paid/$payment->amount_payable) }}" id="amount_paid" name="amount_paid[]"></td>


                             <td> <input type="text" class="input-sm form-control rounded" readonly="true" value="@if($bill->policy_product == 'Motor Insurance')
                              {{ ($bill->amount * ($payment->amount_paid/$payment->amount_payable)  / $bill->amount ) * $mysticker }}
                              @else
                              {{ 0 }}
                              @endif" id="sticker_charge" name="sticker_charge[]">
                              
                             </td>


                             <td> 
                             <input type="text" class="input-sm form-control rounded" readonly="true" value="@if($bill->policy_product == 'Motor Insurance')
                              {{ ((($bill->amount * ($payment->amount_paid/$payment->amount_payable)) - (($bill->amount * ($payment->amount_paid/$payment->amount_payable)  / $bill->amount ) * $mysticker))* $bill->commission_rate/100)  }}
                              @else
                              {{ ($bill->amount * ($payment->amount_paid/$payment->amount_payable)) * $bill->commission_rate/100  }}
                              @endif" id="gross_commission" name="gross_commission[]">
                            
                               </td>


                               <td> 
                               <input type="text" class="input-sm form-control rounded" readonly="true" value="@if($bill->policy_product == 'Motor Insurance')
                              {{ (((($bill->amount * ($payment->amount_paid/$payment->amount_payable)) - (($bill->amount * ($payment->amount_paid/$payment->amount_payable)  / $bill->amount ) * $mysticker))* $bill->commission_rate/100 ) * $mytax/100) }}
                              @else
                              {{ (($bill->amount * ($payment->amount_paid/$payment->amount_payable)) * $bill->commission_rate/100) * $mytax/100  }}
                              @endif" id="tax_charged" name="tax_charged[]">
                             
                               </td>


                               <td> 
                               <input type="text" class="input-sm form-control rounded" readonly="true" value=" @if($bill->policy_product == 'Motor Insurance')
                              {{ ((($bill->amount * ($payment->amount_paid/$payment->amount_payable)) - (($bill->amount * ($payment->amount_paid/$payment->amount_payable)  / $bill->amount ) * $mysticker))* $bill->commission_rate/100)-(((($bill->amount * ($payment->amount_paid/$payment->amount_payable)) - (($bill->amount * ($payment->amount_paid/$payment->amount_payable)  / $bill->amount ) * $mysticker))* $bill->commission_rate/100 ) * $mytax/100)}}
                              @else
                              {{  ((($bill->amount * ($payment->amount_paid/$payment->amount_payable)) - (($bill->amount * ($payment->amount_paid/$payment->amount_payable)  / $bill->amount ) * 0))* $bill->commission_rate/100)-(((($bill->amount * ($payment->amount_paid/$payment->amount_payable)) - (($bill->amount * ($payment->amount_paid/$payment->amount_payable)  / $bill->amount ) * 0))* $bill->commission_rate/100 ) * $mytax/100)  }}
                              @endif" id="net_commission" name="net_commission[]">
                            
                               </td>


                             @role(['System Admin','Billing'])
                             <td><a href="#" onclick="excludefrombill('{{ $bill->id }}','{{ $bill->reg_number }}')" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td> 
                             @endrole 
                             </tr>
                            @endforeach
                          </tbody>
                        </table>

                        
                <section class="panel panel-default">
                  
                    @role(['Billing','System Admin'])
                      <div class="panel-body">
                       
                        <div class="clearfix m-b">

                          
                          
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                             
                        <footer class="panel-footer text-right bg-light lter">
                        <a href="#"><button type="button" class="btn btn-warning btn-s-xs">Print Bill</button></a> 
                        <button type="submit" class="btn btn-success btn-s-xs">Process</button>
                        <input type="hidden" name="receipt_number" id="receipt_number" value="{{ $payment->receipt_number }}">
                        <input type="hidden" name="_token" id="_token" value="{{ Session::token() }}">
                       
                      </footer>
                     
                      </div>
                       @endrole
                    </section>
                   </form> 
                         

                          
                </div>
                

                 

                   
                  </section>
                  
                </aside>
                 
               
                 
            </section>
        </section>
        
  </section>

  @stop




  

  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {
   
    $('#selected_item').select2();
    //loadInvestigation();
    

  });

function excludefrombill(id,name)
  {

         
      swal({   
        title: "Are you sure?",   
        text: "Do you want to exclude "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, exclude it!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/exclude-from-bill',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Excluded!", "Successfully excluded.", "success"); 
              //loadinvoiceitems();
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", "Operation failed", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", "Operation failed", "error");   
        } });

  }

</script>


