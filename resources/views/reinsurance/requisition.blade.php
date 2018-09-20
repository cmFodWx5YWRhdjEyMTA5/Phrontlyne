@extends('layouts.default')

@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">


                @role(['System Admin','General Manager Technical'])
                <button href="#" class="btn btn-sm btn-warning pull-right" onClick="Checked('{{ $requisition->id }}','{{ $requisition->pv_payee_name }}');">Approve (GMT)</button> 
                @endrole

                @role(['System Admin','General Manager Finance'])
                <button href="#" class="btn btn-sm btn-success pull-right" onClick="Approved('{{ $requisition->id }}','{{ $requisition->pv_payee_name }}');">Approve (Finance)</button> 
                @endrole                    
                <button href="#" class="btn btn-sm btn-dark pull-right" onClick="window.print();">Print</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                @role(['System Admin','Reinsurance Officer','Reinsurance Manager'])
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
                <p>REINSURANCE PAYMENT REQUISITIONS</p>
              </header>
               
              <section class="scrollable wrapper" id="summaryreport">
               <img src="/images/{{ $company->logo }}" width="15%" />

                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG($cession->cession_number, 'QRCODE')}}" alt="barcode" />
                <br>
                <br>
                <br>
             <div class="line"></div>


                  <h4 align="center"> <strong>REINSURANCE PAYMENT REQUISITIONS </strong></h4>
                <div class="line"></div>  
              <div class="row">
                <div class="col-xs-6">

                    <p>  <strong> Policy No : </strong> {{ $cession->master_policy_number }} </p> 
                  <p>  <strong> Reference : </strong> {{ $cession->item_id }} </p>
                  <p>  <strong> Class : </strong> {{ $cession->business_class }} </p> 
                  <p>  <strong> Risk : </strong> {{ $cession->cover_type }} </p> 
                    <p>  <strong> Insurance Period : </strong> {{ Carbon\Carbon::parse($cession->period_from)->format('Y-m-d') }} to {{ Carbon\Carbon::parse($cession->period_to)->format('Y-m-d') }} </p> 
                
            
                </div>
             
                <div class="col-xs-6 text-right">
               
                  <p>  <strong> Requistion No : </strong> {{ $requisition->pv_number }} </p>
                  <p>  <strong> Date : </strong> {{ $requisition->pv_date }} </p>
                  <p>  <strong> Cession Number : </strong> {{ $cession->cession_number }} </p>
                  <p>  <strong> Date Generated : </strong> {{ $requisition->created_on }} </p>      

                </div>
                    
              </div>   
             
              <div class="line"></div>
                  <p> <strong>Insured : </strong> {{ $cession->fullname }} </p>
                  <p>  <strong> In favour of :</strong> Please authorize for the payment of an amount of <b>{{ $requisition->currency }} {{ number_format($requisition->pv_amount, 2, '.', ',') }}</b> to <b>{{ $requisition->pv_payee_name }}</b> being payment of their share {{ number_format($requisition->pv_amount/$cession->net_premium * $cession->facultative_percentage, 2, '.', ',') }}, less {{ $cession->comm_on_facultative }}% commission on the Facultative Offer available. </p>


                  <input type="hidden" id="currency" name="currency" value="{{ $requisition->currency }}">
                  <input type="hidden" id="amount" name="currency" value="{{ number_format($requisition->pv_amount, 2, '.', ',') }}">
                  <input type="hidden" id="netpremium" name="currency" value="{{ number_format($requisition->pv_amount/$cession->net_premium * $cession->facultative_percentage, 2, '.', ',') }}">
                  <input type="hidden" id="commission" name="currency" value="{{ $cession->comm_on_facultative }}">
                  <input type="hidden" id="reinsurer" name="reinsurer" value="{{ $requisition->pv_payee_name }}">
                  <input type="hidden" id="url" name="url" value="{{ $requisition->id }}">

                  
                 
              <div class="line"></div>

         <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>Reinsurer</th>
                    <th>PV Description</th>
                    <th>Amount Payable</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>1</td>
                    <td>{{ $requisition->pv_payee_name }}</td>
                    <td>{{ $requisition->description }}</td>
                    <td>{{ $requisition->currency }}{{ number_format($requisition->pv_amount, 2, '.', ',') }}</td>
                  </tr>
                 
                
         
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>NET REQUISITION PAYABLE</strong></td>
                    <td><strong>{{ $requisition->currency }} {{ number_format($requisition->pv_amount, 2, '.', ',') }}</strong></td>
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
                   <br>  ............................................................................. <br>  {{ Auth::user()->getNameOrUsername() }} <br><br><br>{{ $requisition->created_on }}
                  </p>
                  
                 

            
                </div>
              
                <div class="col-xs-4 ">
               
                  <p class="pull-left">Checked By
                   <br>
                   <br>
                   <br> @if($requisition->checked_by != null) <img src="/images/gmt.png" width="25%" /> @else  @endif <br> {{ $requisition->checked_by }}  <br><br><br>
                   {{ $requisition->checked_on }}</p>

                  {{--  <canvas id="signature" width="450" height="150" style="border: 1px solid #ddd;"></canvas>
                   <button id="clear-signature">Clear</button> --}}

                  
                   
                </div>

                <div class="col-xs-4">
               
                  <p class="pull-left">Approved By
                   <br>
                   <br>
                   <br> @if($requisition->approved_by != null) <img src="/images/finance.png" width="30%" /> @else  @endif <br> {{ $requisition->approved_by }} <br><br><br>
                   {{ $requisition->approved_on }}</p>
                  
                   
                </div>
                    
              </div>   


       
                  

               
                  
                  
                  </section>
                  
                  </section>
<div>{{ Carbon\Carbon::parse($requisition->created_on )->format('dmY') }}|{{Abbreviation::make($requisition->created_by)}}|{{ Carbon\Carbon::parse($requisition->approved_on )->format('dmY') }}|{{Abbreviation::make($requisition->approved_by)}}|{{ Carbon\Carbon::now()->format('dmY') }}|{{Abbreviation::make(Auth::user()->getNameOrUsername())}}</div>
            
@stop
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {
    
    $('#approver').select2({
      tags: true
      });

 });
  </script>

<script type="text/javascript">
  jQuery(document).ready(function($){
    
    var canvas = document.getElementById("signature");
    var signaturePad = new SignaturePad(canvas);
    
    $('#clear-signature').on('click', function(){
        signaturePad.clear();
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
    $.get('/send-requisition-request',
        {
          "approver": $('#approver').val(),
          "reinsurer": $('#reinsurer').val(),
          "commission": $('#commission').val(),
          "amount": $('#amount').val(),
          "netpremium": $('#netpremium').val(),
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
          $.get('/approve-requisition-request-finance',
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
          $.get('/approve-requisition-request',
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
