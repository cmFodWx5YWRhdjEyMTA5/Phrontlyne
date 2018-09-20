@extends('layouts.default')

@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();setReprintCounter('{{ $payments->id }}') ">Print</button>
                <p>RECEIPT</p>
              </header>
               
              <section class="scrollable wrapper" id="summaryreport">
               <img src="/images/{{ $company->logo }}" width="15%" />

                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('$claimdetails->claim_id', 'QRCODE')}}" alt="barcode" />
                <br>
                <br>
                <br>
             <div class="line"></div>


                   <span class="label label-danger"> @if($payments->reprint <= 1 ) Original Copy  @else Reprint  @endif </span> <h4 align="center"> <strong>RECEIPT </strong></h4>
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
               
                  <p>  <strong> Receipt No : </strong> {{ $payments->receipt_number }} </p>
                  <p>  <strong> Date : </strong> {{ $payments->cheque_date }} </p>
                  <p>  <strong> Our Claim No. : </strong> {{ $claimdetails->claim_id }} </p>
                  <p>  <strong> Date of Loss : </strong> {{ $claimdetails->loss_date }} </p>      
                   
                </div>
                    
              </div>   
             
              <div class="line"></div>
                  <p>  <strong> In favour of : </strong> {{ $claimdetails->insured_name }} </p>
                  <p>  <strong> Address : </strong> {{ $claimdetails->postal_address }} </p>
                 
              <div class="line"></div>

         <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>Claimant</th>
                    <th>Cause of Loss</th>
                    <th>Descr. of Loss</th>
                    <th>Payment Description</th>
                    <th>Amount</th>
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
                    <td colspan="5" class="text-right no-border"><strong>AMOUNT PAID</strong></td>
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
                   <br>  ............................................................................. <br>  {{ Auth::user()->getNameOrUsername() }} <br><br><br>
                   .........../............/................</p>
                  
                 

            
                </div>
              
                <div class="col-xs-4 ">
               
                  <p class="pull-left">Checked By
                   <br>
                   <br>
                   <br>  ............................................................................. <br>   <br><br><br>
                   .........../............/................</p>
                  
                   
                </div>

                <div class="col-xs-4">
               
                  <p class="pull-left">Approved By
                   <br>
                   <br>
                   <br>  ............................................................................. <br>  <br><br><br>
                   .........../............/................</p>
                  
                   
                </div>
                    
              </div>   


       
                  

               
                  
                  
                  </section>
                  
                  </section>
<div>{{ Carbon\Carbon::parse($claimdetails->created_on )->format('dmY') }}|{{Abbreviation::make($claimdetails->created_by)}}|{{ Carbon\Carbon::parse($claimdetails->approved_on )->format('dmY') }}|{{Abbreviation::make($claimdetails->approved_by)}}|{{ Carbon\Carbon::now()->format('dmY') }}|{{Abbreviation::make(Auth::user()->getNameOrUsername())}}</div>
            
@stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
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

</script>
