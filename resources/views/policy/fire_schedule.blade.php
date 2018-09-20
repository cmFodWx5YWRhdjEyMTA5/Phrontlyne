@extends('layouts.default')

@section('content')

         <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">

                {{--  @if($policydetails->policy_status == 'Released')
                      <a href="#" onclick="approvePolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-success pull-right"><i class="fa fa-thumbs-up  fa-lock"></i> Policy Released </a>
                      @else
                      <a href="#" onclick="approvePolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-danger pull-right"><i class="fa fa-spin fa-spinner hide show inline" id="spin"></i> Activation Pending  </a>
                      @endif
                     
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();"> @if($policydetails->policy_status != 'Released' ) Print Draft Schedule  @else Print Schedule  @endif</button>
                 --}}

                <div class="btn-group pull-right">
              <p>
                      
                      @if($policydetails->policy_status == 'In Force')
                      <a href="#" class="btn btn-rounded btn-sm btn-success"><i class="fa fa-thumbs-up  fa-lock"></i> Policy is {{ $policydetails->policy_status }} </a>
                      @else
                      <a href="#" onclick="approvePolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-spin fa-spinner hide show inline" id="spin"></i> Policy in {{ $policydetails->policy_status}} state  </a>
                      @endif

                      <a href="/print-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print Policy </a>

                      <a href="#" class="btn btn-rounded btn-sm btn-default" onClick="window.print();"><i class="fa fa-fw fa-print"></i> @if($policydetails->policy_status != 'In Force' ) Print Draft Schedule  @else Print Schedule  @endif </a>

                       <a href="/print-notice/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Renewal Notice </a>

                      @if($policydetails->policy_status == 'In Force')
                      <a href="/print-invoice/{{ $debitid }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-money  fa-lock"></i> Print Debit Note </a>
                      @else
                     
                      @endif
              </p>

                  <input type="hidden" id="policy_number" name="policy_number" value="{{ $policydetails->policy_number }}">
                <input type="hidden" id="policy_product" name="policy_product" value="{{ $policydetails->policy_product }}">
                <input type="hidden" id="cover_type" name="cover_type" value="{{ $policydetails->coverage }}">
                <input type="hidden" id="risk_type" name="risk_type" value="NA">
                <input type="hidden" id="policy_branch" name="policy_branch" value="{{ $policydetails->policy_branch }}">
                <input type="hidden" id="policy_sales_type" name="policy_sales_type" value="{{ $policydetails->policy_source }}">
                 

              </div>

                <p>FIRE SCHEDULE</p>
              </header>
               
        <div id="background">
          @if($policydetails->policy_status != 'In Force' ) <p id="bg-text">Draft</p>  @else   @endif 
        </div>          
     
               

               <section class="scrollable wrapper" id="summaryreport">
               <img src="/images/{{ $company->logo }}" width="15%" />

                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG($policydetails->master_policy_number, 'QRCODE')}}" alt="barcode" />
                <br>
                <br>
                <br>
             <div class="line"></div>


                     <h4 align="center"> <strong>POLICY SCHEDULE </strong></h4>
                <div class="line"></div>  
              <div class="row">
                <div class="col-xs-6">

                  <p>  <strong> Agency : </strong> {{ $policydetails->agency }} </p>
                   <p>  <strong> Policy Number : </strong> {{ $policydetails->master_policy_number }} </p>
                  <p>  <strong> Client / Account Number : </strong> {{ $policydetails->account_number }} </p> 
              
                
                </div>
                <div class="col-xs-6 text-right">
               
                  <p>  <strong> Class of Policy : </strong> {{ $policydetails->coverage }} </p>
                  <p>  <strong> Issued on : </strong> {{ $policydetails->first_issue_date->format('d-m-Y H:i:s')  }} </p>
                  <p>  <strong> Acceptance Date : </strong> {{ $policydetails->acceptance_date->format('d-m-Y')  }}  </p>
                   
                </div>
              
                    
              </div>   
             
              <div class="line"></div>
                   <p>  <strong> Period of Insurance from </strong> {{ Carbon\Carbon::parse($policydetails->insurance_period_from )->format('d-m-Y') }} to  {{ Carbon\Carbon::parse($policydetails->insurance_period_to )->format('d-m-Y') }}, both dates inclusive </p>
              <div class="line"></div>
                  <p>  <strong> Insured's Name : </strong> {{ strtoupper($customers->fullname) }} </p>
                  <p>  <strong> Address : </strong> {{ $customers->postal_address }} </p>
                  <p>  <strong> Occupation / Business : </strong> {{ $customers->field_of_activity }} </p>
                 
              <div class="line"></div>

                 <p><i>{!!  $policydetails->policy_upper_text !!}</i></p>  
                <div class="line"></div>
               
                <div class="row">
                  
                   <div class="col-xs-4 text-center">
               
                  <p>  <strong> Basic Annual Premium : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('actual_premium'), 2, '.', ',') }} </p>
                  <p>  <strong> Long Term Agreement : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('long_term_value'), 2, '.', ',')  }} </p>
                  <p>  <strong> Fire Extinguisher Appliance : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('fire_ex_value'), 2, '.', ',')  }} </p>
                  
                   
                </div>

                <div class="col-xs-4 text-right">
               
                  <p>  <strong> Fire Hydrant : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('fire_hy_value'), 2, '.', ',')  }} </p>
                  <p>  <strong> Total Annual Premium : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('annual_premium'), 2, '.', ',') }} </p>
                 
                  
                   
                </div>

                <div class="col-xs-4 text-right">
               
                 
                  <p>  <a href="#" class="h4"> <strong> Premium Due : </strong><b> {{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('premium_payable') +  $fees->amount, 2, '.', ',')  }} </b> </a> </p>
                  
                   
                </div>
                </div>

                 <div class="line"></div>
                
                  <p> {{ $policydetails->coverage }}   </p>               
                  

               <div class="line"></div>
                 <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                 
                    <th width="30" style="font-size:12px">Risk #</th>
                    <th width="30" style="font-size:12px">Description</th>
                    <th colspan="3" width="60" class="text-right">Sum Insured</th>
                    
                  </tr>
                </thead>
                <tbody>
                 @foreach($fetchrecord as $risk => $risks )
                  <tr>
                     <th colspan="3"  class="text-left"> Risk {{ $risk }} <br>
                      Situation : {{ $risks[0]->property_address }} <br>
                      Occupancy : {{ $risks[0]->property_type }}
                      <br>
                      <br>
                       </th>
                        <td>
                        <p>            
                           
                        
                   </p>
                        @foreach($risks as $key => $schedule)

                            <tr> 
                            <td colspan="0" class="text-left no-border">Item {{ ++$key }}</td>
                           <td class="text-left no-border">{!! $schedule->property_description !!}</td>
                           <td colspan="3"  class="text-right no-border">{{ $policydetails->policy_currency }} {{ number_format($schedule->item_value, 2, '.', ',') }} </td> 
                           </tr>
                        @endforeach
                        </td>
                          <tr>
                    <td colspan="3" class="text-right no-border"></td>
                    <td colspan="3" class="text-right no-border"><strong>Total Sum Insured </strong> | {{ $policydetails->policy_currency }} {{ number_format($risks->sum('item_value'), 2, '.', ',')}} </td>
                  </tr> 
                  <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"></td>
                    <td colspan="3" class="text-right no-border"><strong>Basic Annual Premium</strong> | {{ $policydetails->policy_currency }} {{ number_format($risks->sum('actual_premium'), 2, '.', ',') }}</td>
                  </tr>

                  <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"></td>
                    <td colspan="3" class="text-right no-border"><strong> Long Term Agreement </strong> | - {{ $policydetails->policy_currency }} {{ number_format($risks->sum('long_discount'), 2, '.', ',')  }}</td>
                  </tr>

                   <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"></td>
                    <td colspan="3" class="text-right no-border"><strong> Fire Extinguisher Appliance </strong> | - {{ $policydetails->policy_currency }} {{ number_format(($risks->sum('actual_premium') - $risks->sum('long_discount'))  * $risks->sum('extinguisher_discount'), 2, '.', ',')  }}</td>
                  </tr>

                   <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"></td>
                    <td colspan="3" class="text-right no-border">Fire Hydrant | - {{ $policydetails->policy_currency }} {{ number_format((($risks->sum('actual_premium') - $risks->sum('long_discount')) -  ($risks->sum('actual_premium') - $risks->sum('long_discount')) * $risks->sum('extinguisher_discount'))  *  $risks->sum('hydrant_discount') , 2, '.', ',') }}</td>
                  </tr>
          
                  <tr>
                    <td colspan="3" class="text-right no-border" style="font-size:10px"></td>
                    <td colspan="3" class="text-right no-border"><strong>Total Annual Premium</strong> |  <strong>{{ $policydetails->policy_currency }} {{ number_format((($risks->sum('actual_premium') - $risks->sum('long_discount')) -  ($risks->sum('actual_premium') - $risks->sum('long_discount')) * $risks->sum('extinguisher_discount')) - ((($risks->sum('actual_premium') - $risks->sum('long_discount')) -  ($risks->sum('actual_premium') - $risks->sum('long_discount')) * $risks->sum('extinguisher_discount')) * $risks->sum('hydrant_discount')), 2, '.', ',') }}</strong>
                    </td>
                  </tr> 

                  <tr>
                    <td colspan="3" class="text-right no-border" style="font-size:10px"></td>
                    <td colspan="3" class="text-right no-border"><strong>Premium Due </strong> | <strong>{{ $policydetails->policy_currency }} {{ number_format($risks->sum('premium_payable'), 2, '.', ',') }}</strong>
                    </td>
                  </tr> 
                  </tr>
                 @endforeach
                
              </tbody>
            </table> 

  
                 
            

      

<div class="line"></div>
<strong>Subject to the following clauses/warranties/endorsements/memo attached hereto :-   </strong>
<br>
<p>{!! $policydetails->policy_clause !!}</p>
<br>          
<div class="line"></div>
 <p><i>{!!  $policydetails->policy_lower_text !!}</i></p>  


                <br>
                <br>
       
                   <p class="pull-left">Signed for and on behalf of the Company
                   <br>
                   <br>
                   <br>  ............................................................................. <br>  {{ Auth::user()->getNameOrUsername() }}</p>

                  <br>
                   <br>
                   <br>
                  <p class="pull-right"> ............................................................................. <br> Authorised Signature  </p>
                  
                  {{-- <div style="position: absolute;bottom: 10px; left: 10px; ">{{ Carbon\Carbon::parse($policydetails->created_on )->format('dmY') }}|{{Abbreviation::make($policydetails->created_by)}}|{{ Carbon\Carbon::parse($policydetails->approved_on )->format('dmY') }}|{{Abbreviation::make($policydetails->approved_by)}}|{{ Carbon\Carbon::now()->format('dmY') }}|{{Abbreviation::make(Auth::user()->getNameOrUsername())}}</div> --}}
                  </section>
                  
                  </section>
<div>{{ Carbon\Carbon::parse($policydetails->created_on )->format('dmY') }}|{{Abbreviation::make($policydetails->created_by)}}|{{ Carbon\Carbon::parse($policydetails->approved_on )->format('dmY') }}|{{Abbreviation::make($policydetails->approved_by)}}|{{ Carbon\Carbon::now()->format('dmY') }}|{{Abbreviation::make(Auth::user()->getNameOrUsername())}}</div>
            
@stop



<style type="text/css">
#background{
  position: absolute;
  z-index: 0;
  background: white;
  display: block;
  min-height: 50%;
  min-width: 50%;
  color: yellow;

}
#bg-text
{
    color:lightgrey;
    font-size:150px;
    transform:rotate(300deg);
    -webkit-transform:rotate(300deg);
}
</style>


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).bind("contextmenu",function(e) {
e.preventDefault();
});
</script>



<script>
function approvePolicy(id,name)
   {

    //alert($('#policy_sales_type').val());
      swal({   
        title: "Are you sure?",   
        text: "Do you want to approve  "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, approve it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/approve-policy',
          {
             "ID":                $('#policy_number').val(),
             "policy_product":    $('#policy_product').val(), 
             "cover_type":        $('#cover_type').val(),
             "risk_type":         $('#risk_type').val(),
             "policy_branch":     $('#policy_branch').val(),
             "policy_sales_type": $('#policy_sales_type').val()

          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Approved!", name +" was approved in policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to approved.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to approved.", "error");   
        } });

   }
</script>






