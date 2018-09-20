@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p>{{ $billindex->fullname }}'s Bill </p>
                <div class="btn-group pull-right">
              <p>
                    <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $billindex->created_by }}</a>
                       <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $billindex->branch }}  </a>
                   
              </p>
              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">

                           
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/avatar_default.jpg" class="pull-left thumb m-r">
                            <img src="/images/avatar_default.jpg" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $billindex->fullname }}</div>
                            <br>
                            <div>
                           <span class="btn btn-xs btn-dark btn-rounded m-t-ml">{{ $billindex->account_number }}</span>
                            </div>
                            
                            </div>
                          </div>                
                        </div>


                          <div>
                          <ul class="list-group no-radius">
                          <li class="list-group-item">
                            <span class="pull-right">{{ $billindex->policy_number }}</span>
                           
                             <small class="text-muted">Policy</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ $customer->mobile_number }}</span>
                            
                             <small class="text-muted">Phonenumber</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ 0 }}</span>
                            
                             <small class="text-muted">Email</small>
                          </li>
                        </ul>
                          </div> 

                           <img src="/images/138360.svg" style="width:100%" >

                        </div>

                    </section>
                  </section>
                </aside>
                 
                <aside class="bg-white">
                <form  data-validate="parsley" method="post" action="/do-payment" class="panel-body wrapper-lg">
                <section class="panel panel-default">
                  
                    @role(['Billing','System Admin'])
                      <div class="panel-body">
                       
                        <div class="clearfix m-b">

                          <a href="#" class="thumb-lg">
                            <img src="" name="imagePreview" id="imagePreview"  class="img-circle">
                          </a>
                          
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('receipt_type') ? ' has-error' : ''}}">
                            <label>Receipt Type</label>
                            <select id="receipt_type" name="receipt_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            @foreach($receipttypes as $receipttype)
                        <option value="{{ $receipttype->type }}">{{ $receipttype->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('receipt_type'))
                          <span class="help-block">{{ $errors->first('receipt_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('paymentmethod') ? ' has-error' : ''}}">
                            <label>Payment Method</label>
                            <select id="paymentmethod" name="paymentmethod" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($paymenttypes as $receiptmode)
                        <option value="{{ $receiptmode->type }}">{{ $receiptmode->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('paymentmethod'))
                          <span class="help-block">{{ $errors->first('paymentmethod') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                            <label>Reference Number</label> 
                            <div class="form-group{{ $errors->has('referencenumber') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control"  id="referencenumber" name="referencenumber" value="{{ Request::old('referencenumber') ?: '' }}">   
                           @if ($errors->has('referencenumber'))
                          <span class="help-block">{{ $errors->first('referencenumber') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                         <div class="col-sm-6 ">
                            <label>Amount Received</label> 
                            <div class="form-group{{ $errors->has('amountreceived') ? ' has-error' : ''}} has-success">
                            <input  type="number" min="0" value="0" step="0.01" class="form-control" id="amountreceived" data-required="true" value="{{ Request::old('amountreceived') ?: '' }}"  name="amountreceived">   
                           @if ($errors->has('amountreceived'))
                          <span class="help-block">{{ $errors->first('amountreceived') }}</span>
                           @endif    
                          </div>
                          </div>

                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Paid By </label>
                          <input type="text" class="form-control" id="fullname_paid" data-required="true" value="{{ Request::old('fullname') ?: '' }}"  name="fullname_paid">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>


                        <br>
                        <br>
                        <br>
                        <br>
                             
                        <footer class="panel-footer text-right bg-light lter">
                        <a href="#"><button type="button" class="btn btn-warning btn-s-xs">Print Bill</button></a> 
                        <button type="submit" class="btn btn-success btn-s-xs">Pay</button>
                        <input type="hidden" name="payable" id="payable" value="{{ $bills->sum('amount') }}">
                        <input type="hidden" name="_token" id="_token" value="{{ Session::token() }}">
                        <input type="hidden" name="billid" id="billid" value="{{ $billindex->id }}">

                      </footer>
                     
                      </div>
                       @endrole
                    </section>
                   </form>



                  <section class="vbox">
               {{--      <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#consultation_tab" data-toggle="tab"> Billable Items </a></li>
                        
                      </ul>
                    </header> --}}
                    <header class="panel-heading">
                  Items Payable
                </header>

                   <p>
                    <a href="#" class="btn btn-danger btn-lg pull-right">Amount Due : {{ $billindex->currency }} {{ number_format($bills->sum('amount'), 2, '.', ',') }} </a>
                  </p>
                

                         <div class="table-responsive">
               
                       <table id="invoiceTable" cellpadding="0" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th width="20"><input type="checkbox" ></th>
                               <th>#</th>
                               <th>Date</th>
                              <th>Item ID</th>
                              <th>Period</th>
                              <th>Source</th>
                               <th>Risk</th>
                              <th>Sum Insured</th>
                              <th>Amount Payable</th>
                              <th></th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($bills as $keys => $bill)
   
                        @if($bill->quantity  == 0)
                          <tr bgcolor="#F5B7B1">
                        @else
                        <tr>
                        @endif
                            <td><input type="checkbox" checked="checked" name="item[{{ $bill->id }}]" id="{{ $bill->id }}" value="{{ $bill->id }}"></td>
                           <td>{{ ++$keys }}</td>
                            <td>{{ $bill->created_on }}</td>
                            <td>{{ $bill->reg_number }}</td>
                            <td>{{Carbon\Carbon::parse($bill->period_from )->format('d-m-Y') }} to {{ Carbon\Carbon::parse($bill->period_to )->format('d-m-Y') }}</td>
                            <td>{{ $bill->policy_product }}</td>
                             <td>{{ $bill->cover_type }}</td>
                              <td>{{ number_format($bill->sum_insured, 2, '.', ',') }}</td>
                             <td>{{ number_format($bill->amount, 2, '.', ',') }}</td>
                             @role(['System Admin','Billing'])
                             <td><a href="#" onclick="excludefrombill('{{ $bill->id }}','{{ $bill->reg_number }}')" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td> 
                             @endrole 
                             </tr>
                            @endforeach
                          </tbody>
                        </table>
                         

                          
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

  
function addInvestigation()
{
if($('#selected_item').val()!= "")
{
    //alert($('#payercode').val());

    $.get('/add-investigation',
        {
          "patient_id":  $('#patient_id').val(),
          "accounttype": $('#payercode').val(),
          "opd_number":  $('#visit_id').val(),
          "investigation": $('#selected_item').val(),
          "fullname":  $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
          location.reload(true);
          $('#investigation').val()!= ""
        }
        else
        {
          sweetAlert("Investigation failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select an Investigation!");}
}


</script>


