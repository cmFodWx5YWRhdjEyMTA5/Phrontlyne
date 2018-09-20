@extends('layouts.default')

@section('content')

          <section class="vbox bg-white">


              <header class="header b-b b-light hidden-print">


                @role(['System Admin','Claims Manager'])
                <button href="#" class="btn btn-sm btn-warning pull-right" onClick="Checked('{{ $payments->id }}','{{ $payments->pv_payee_name }}');">Approve (Manager)</button> 
                @endrole

                @role(['System Admin','General Manager Technical'])
                <button href="#" class="btn btn-sm btn-success pull-right" onClick="Approved('{{ $payments->id }}','{{ $payments->pv_payee_name }}');">Approve (GMT)</button> 
                @endrole                    
                <button href="#" class="btn btn-sm btn-dark pull-right" onClick="window.print();setReprintCounter('{{ $payments->id }}')">Print</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                @role(['System Admin','Claims Officer','Claims Manager'])
                <button href="#" onClick="sendForApproval();" class="btn btn-sm btn-info pull-right">Send For Approval</button>
                <br>
                 <div class="col-sm-4 pull-right">
                       <select id="approver" name="approver" rows="3" tabindex="1" data-placeholder="Select person(s) to approve.." style="width:100%">
                         <option value="">-- Select an approval --</option>
                            @foreach($authoritylist as $employee)
                          <option value="{{ $employee->email }}">{{ $employee->fullname }}</option>
                          @endforeach   
                         </select>
                         </div>
                @endrole
                <p>CLAIMS PAYMENT VOUCHER</p>
              </header>
               
              <section class="scrollable wrapper" id="summaryreport">
               <img src="/images/{{ $company->logo }}" width="15%" />

                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('$claimdetails->claim_id', 'QRCODE')}}" alt="barcode" />
                <br>
                <br>
                <br>
             <div class="line"></div>


                   <span class="label label-danger"> @if($payments->reprint <= 1 ) Original Copy  @else Reprint  @endif </span> <h4 align="center"> <strong>PAYMENT VOUCHER </strong></h4>
                <div class="line"></div>  
              <div class="row">
                <div class="col-xs-6">

                  <p>  <strong> Reference : </strong> {{ $claimdetails->item_id }} </p>
                  <p>  <strong> Class : </strong> {{ $claimdetails->policy_product }} </p> 
                  <p>  <strong> Branch : </strong> {{ $claimdetails->branch }} </p> 
                  <p>  <strong> Intermediary : </strong> {{ $claimdetails->agency }} </p> 
                  <p>  <strong> Policy No : </strong> {{ $claimdetails->policy_number }} </p> 
            
                </div>
             
                <div class="col-xs-6 text-right">
               
                  <p>  <strong> PV No : </strong> {{ $payments->pv_number }} </p>
                  <p>  <strong> Date : </strong> {{ $payments->pv_date }} </p>
                  <p>  <strong> Our Claim No. : </strong> {{ $claimdetails->claim_id }} </p>
                  <p>  <strong> Date of Loss : </strong> {{ $claimdetails->loss_date }} </p>  


                   <input type="hidden" id="currency" name="currency" value="{{ $payments->currency }}">
                  <input type="hidden" id="amount" name="amount" value="{{ number_format($payments->amount, 2, '.', ',') }}">
                  <input type="hidden" id="reinsurer" name="reinsurer" value="{{ $payments->payee_name }}">
                  <input type="hidden" id="url" name="url" value="{{ $payments->id }}">    

                </div>
                    
              </div>   
             
              <div class="line"></div>
                  <p>  <strong> In favour of : </strong> {{ $claimdetails->insured_name }} </p>
                 
              <div class="line"></div>

         <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>Claimant</th>
                    <th>Cause of Loss</th>
                    <th>Descr. of Loss</th>
                    <th>PV Description</th>
                    <th>Claims Payable</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <tr>
                    <td>1</td>
                    <td>{{ $payments->payee_name }}</td>
                    <td>{{ $claimdetails->cause_of_loss }}</td>
                    <td>{{ $claimdetails->loss_description }}</td>
                    <td>{{ $payments->description }}</td>
                    <td>{{ $payments->currency }}{{ number_format($payments->amount, 2, '.', ',') }}</td>
                  </tr>
                 
                
         
                  <tr>
                    <td colspan="5" class="text-right no-border"><strong>NET CLAIMS PAYABLE</strong></td>
                    <td><strong>{{ $payments->currency }} {{ number_format($payments->amount, 2, '.', ',') }}</strong></td>
                  </tr>
                </tbody>
              </table>  

                <br>
                <br>

                <div class="row">
                <div class="col-xs-4">

                  <p class="pull-left">Processed by
                   <br>
                   <br>
                   <br>  ............................................................................. <br>  {{ Auth::user()->getNameOrUsername() }} <br><br><br>{{ $payments->created_on }}
                  </p>
                  
                 

            
                </div>
              
                <div class="col-xs-4 ">
               
                  <p class="pull-left">Checked By
                   <br>
                   <br>
                   <br> @if($payments->checked_by != null) <img src="/images/gmt.png" width="25%" /> @else  @endif <br> {{ $payments->checked_by }}  <br><br><br>
                   {{ $payments->checked_on }}</p>

                  {{--  <canvas id="signature" width="450" height="150" style="border: 1px solid #ddd;"></canvas>
                   <button id="clear-signature">Clear</button> --}}

                  
                   
                </div>

                <div class="col-xs-4">
               
                  <p class="pull-left">Approved By
                   <br>
                   <br>
                   <br> @if($payments->approved_by != null) <img src="/images/finance.png" width="30%" /> @else  @endif <br> {{ $payments->approved_by }} <br><br><br>
                   {{ $payments->approved_on }}</p>
                  
                   
                </div>
                    
              </div>   


       
                  

               
                  
                  
                  </section>
                  
                  </section>
<div>{{ Carbon\Carbon::parse($claimdetails->created_on )->format('dmY') }}|{{Abbreviation::make($claimdetails->created_by)}}|{{ Carbon\Carbon::parse($claimdetails->approved_on )->format('dmY') }}|{{Abbreviation::make($claimdetails->approved_by)}}|{{ Carbon\Carbon::now()->format('dmY') }}|{{Abbreviation::make(Auth::user()->getNameOrUsername())}}</div>
            
@stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    
    $('#approver').select2({
      tags: true
      });

 });
  </script>
<script type="text/javascript">

function setReprintCounter(id)
   {
        //alert(id);
     
          $.get('/set-pv-reprint-counter',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
               //loadAdjustments();
             }
            else
            { 
              swal("Error","Failed processing print command.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }

    function sendForApproval()
   {

    if($('#approver').val()!= "")
  {
  //alert($('#complaint').val());
    $.get('/send-requisition-request-claim',
        {
          "approver": $('#approver').val(),
          "reinsurer": $('#reinsurer').val(),
          "amount": $('#amount').val(),
           "url": $('#url').val(),
          "currency": $('#currency').val()
          
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          sweetAlert("Sent");
          
        }
        else
        {
          sweetAlert("Assessment failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add an assessment!");}
   }


   function Approved(id,name)
   {

    swal({   
        title: "Are you sure?",   
        text: "Do you want to approve "+ name +" payment request?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, Approve it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/approve-requisition-request-finance-claim',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Success!", name +" has been approved for payment.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled","Failed to approve.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to approve.", "error");   
        } });


   }

   function Checked(id,name)
   {
      //alert(id);
      swal({   
        title: "Are you sure?",   
        text: "Do you want to approve "+ name +" payment request?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, Approve it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/approve-requisition-request-claim',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Success!", name +" has been approved for payment.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled","Failed to approve.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to approve.", "error");   
        } });

   }

   function Reject()
   {


   }

</script>
