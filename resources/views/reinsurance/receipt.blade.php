@extends('layouts.default')

@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>REINSURANCE PAYMENT RECEIPT</p>
              </header>
               
              <section class="scrollable wrapper" id="summaryreport">
               <img src="/images/{{ $company->logo }}" width="15%" />

                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG($cession->cession_number, 'QRCODE')}}" alt="barcode" />
                <br>
                <br>
                <br>
            


                
                  
                  <p> {{ Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }} </p>
                  <p> The Managing Director </p>
                  <p> {{ $requisition->pv_payee_name  }} </p>
                 
                  <p> Dear Sir/Madam, </p>

                <div class="line"></div>  
                  <h4 align="center"> <strong>FACULTATIVE PAYMENT </strong></h4>
                    <div class="line"></div>


                      <p> Please find attached herewith our {{ $requisition->bank }} cheque with number {{ $requisition->cheque_number }} in the sum of {{ $requisition->currency }}{{ number_format($requisition->pv_amount, 2, '.', ',') }} being your share of the premium(s) on facultative offer details below</p>


                       <div class="line"></div>
                       <br>
                       <br>




              <div class="row">
                <div class="col-xs-6">

                    <p>  <strong> Policy No : </strong> {{ $cession->master_policy_number }} </p> 
                  <p>  <strong> Reference : </strong> {{ $cession->item_id }} </p>
                  <p>  <strong> Class : </strong> {{ $cession->business_class }} </p> 
                  <p>  <strong> Risk : </strong> {{ $cession->cover_type }} </p> 
                    <p>  <strong> Insurance Period : </strong> {{ Carbon\Carbon::parse($cession->period_from)->format('Y-m-d') }} to {{ Carbon\Carbon::parse($cession->period_to)->format('Y-m-d') }} </p> 
                
            
                </div>
             
                <div class="col-xs-6 text-right">
               
                  <p>  <strong> Receipt No : </strong> {{ $requisition->pv_number }} </p>
                  <p>  <strong> Date : </strong> {{ $requisition->pv_date }} </p>
                  <p>  <strong> Cession Number : </strong> {{ $cession->cession_number }} </p>
                  <p>  <strong> Date Processed : </strong> {{ $requisition->created_on }} </p>      

                </div>
                    
              </div>  
              <div class="line"></div> 

                <div class="row">
                <div class="col-xs-6">

                    <p>  <strong> Sum Insured : </strong>{{ $cession->currency }} {{ number_format($cession->sum_insured, 2, '.', ',') }} </p> 
                  <p>  <strong> Premium : </strong>{{ $cession->currency }} {{ number_format($cession->premium, 2, '.', ',') }} </p>
                 
                
            
                </div>
             
                <div class="col-xs-6 text-right">
               
                  <p>  <strong> Offer : </strong> {{ $cession->currency }} {{ number_format($requisition->pv_amount/$cession->net_premium * $cession->facultative_on_prem, 2, '.', ',') }} </p>
                  <p>  <strong> Less Commisson : </strong>{{ $cession->currency }} {{ number_format($requisition->pv_amount/$cession->net_premium * $cession->facultative_comm, 2, '.', ',') }} </p>
                  
                  <p><h4>  <strong> Net Premium : </strong>{{ $cession->currency }} {{ number_format($requisition->pv_amount, 2, '.', ',') }}</h4> </p>

                </div>
                    
              </div> 
             
                <div class="line"></div>
                    <br>
                   <br>
                   <p>Kindly acknowledge receipt.</p>
                   <br>
                   <br>
                   <p>Thank you,</p>
                   <br>
                   <p>Yours faithfully.</p>


      {{--    <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>Reinsurer</th>
                    <th>Receipt Description</th>
                    <th>Amount Paid</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <tr>
                    <td>1</td>
                    <td>{{ $requisition->pv_payee_name }}</td>
                    <td>{{ $requisition->description }} | {{ $requisition->bank }} | {{ $requisition->cheque_number }} | {{ $requisition->cheque_date }}</td>
                    <td>{{ $requisition->currency }}{{ number_format($requisition->pv_amount, 2, '.', ',') }}</td>
                  </tr>
                 
                
         
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>AMOUNT PAID</strong></td>
                    <td><strong>{{ $requisition->currency }} {{ number_format($requisition->pv_amount, 2, '.', ',') }}</strong></td>
                  </tr>
                </tbody>
              </table>  
 --}}
                <br>
                <br>

                <div class="row">
                <div class="col-xs-4">

                  <p class="pull-left">
                   <br>
                   <br>
                   <br>  ............................................................................. <br>  {{ Auth::user()->getNameOrUsername() }} <br><br><br>
                   .........../............/................
                  <br>
                   <br>
                   <br>
                   <br>
                   (Head, Reinsurance Department)
                   </p>
                  
                 

            
                </div>
              
        
                    
              </div>   


       
                  

               
                  
                  
                  </section>
                  
                  </section>
<div>{{ Carbon\Carbon::parse($requisition->created_on )->format('dmY') }}|{{Abbreviation::make($requisition->created_by)}}|{{ Carbon\Carbon::parse($requisition->approved_on )->format('dmY') }}|{{Abbreviation::make($requisition->approved_by)}}|{{ Carbon\Carbon::now()->format('dmY') }}|{{Abbreviation::make(Auth::user()->getNameOrUsername())}}</div>
            
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
