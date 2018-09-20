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

                     {{--  <a href="/print-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print Policy </a> --}}

                      <a href="#" class="btn btn-rounded btn-sm btn-default" onClick="window.print();"><i class="fa fa-fw fa-print"></i> @if($policydetails->policy_status != 'In Force' ) Print Draft Schedule  @else Print Schedule  @endif </a>

                      {{--  <a href="/print-notice/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Renewal Notice </a> --}}

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

                <p>ENGINEERING SCHEDULE</p>
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
                <div class="col-xs-4 text-center">
               
                   <p>  <strong> Class of Policy : </strong> {{ $policydetails->coverage }} </p>
                  <p>  <strong> Issued on : </strong>  {{ $policydetails->first_issue_date }}  </p>
                  <p>  <strong> Acceptance Date : </strong>  {{ $policydetails->acceptance_date }}  </p>
                   
                </div>
               
                    
              </div>   
             
              <div class="line"></div>
                   <p>  <strong> Period of Insurance from </strong> {{ Carbon\Carbon::parse($policydetails->insurance_period_from )->format('d-m-Y') }} to  {{ Carbon\Carbon::parse($policydetails->insurance_period_to )->format('d-m-Y') }}, both dates inclusive </p>
              <div class="line"></div>
                  <p>  <strong> Insured's Name : </strong> {{$customers->fullname }} </p>
                  <p>  <strong> Address : </strong> {{ $customers->postal_address }} </p>
                  <div class="line"></div>
               <p> <strong>Premium</strong></p>
              


                 <div class="row">
                  
                   <div class="col-xs-4 text-center">
               
                  <p>  <strong> Basic Annual Premium : </strong>{{ $policydetails->policy_currency }} {{ number_format($fetchrecord->sum('car_contract_premium'), 2, '.', ',') }} </p>
                  <p>  <strong> Total Annual Premium : </strong>{{ $policydetails->policy_currency }} {{ number_format($fetchrecord->sum('car_contract_premium'), 2, '.', ',')  }} </p>
                  
                  
                   
                </div>

                <div class="col-xs-4 text-right">
               
                 <p>  <strong> Premium Due : </strong>{{ $policydetails->policy_currency }} {{ number_format($fetchrecord->sum('car_premium_payable'), 2, '.', ',')  }} </p>
                  <p>   <a href="#" class="h4"><strong> Total Due : </strong>{{ $policydetails->policy_currency }} {{ number_format($fetchrecord->sum('car_premium_payable'), 2, '.', ',')  }}</a> </p>

                </div>

                
                </div>

                 
              <div class="line"></div>

                 <p><i>{{  $policydetails->policy_upper_text }}</i></p>  
               <div class="line"></div>
               

                  <p> {{ $policydetails->coverage }}   </p>               
                  


               <div class="line"></div>
                 <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                 
                    <th width="30" style="font-size:12px">Risk #</th>

                    <th width="30" style="font-size:12px">Description</th>
                    <th width="30" style="font-size:12px"></th>
                    
                  </tr>
                </thead>
                <tbody>
                 @foreach($fetchrecord as $keys => $item )
                  <tr>
                    <td colspan="0" class="text-left no-border"> Risk No. {{ ++$keys }} </td>
                    <td class="text-left no-border">{{ $item->car_contract_description }} 
                    <br> {!! $item->car_endorsements !!}
                    </td>
                    <td colspan="3"  class="text-right no-border"></td>
                     
                  </tr>
                 @endforeach

  
                  <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"><strong> </strong></td>
                    <td colspan="3" class="text-right" style="font-size:10px"><strong>Total Sum Insured {{ $policydetails->policy_currency }} {{ number_format($fetchrecord->sum('car_contract_sum'), 2, '.', ',')}} </strong></td>
                  </tr> 
                  <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"><strong></strong></td>
                    <td colspan="3" class="text-right" style="font-size:10px">Basic Annual Premium {{ $policydetails->policy_currency }} {{ number_format($fetchrecord->sum('car_contract_premium'), 2, '.', ',') }}</td>
                  </tr>

                  <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"><strong>  </strong></td>
                    <td colspan="3" class="text-right" style="font-size:10px">Discount 0</td>
                  </tr>
          
                  <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"><strong></strong></td>
                    <td colspan="3" class="text-right" style="font-size:10px"><strong>Premium Due {{ $policydetails->policy_currency }} {{  number_format(($fetchrecord->sum('car_premium_payable') - 0), 2, '.', ',') }}</strong></td>
                  </tr>
                </tbody>
              </table> 

      

<div class="line"></div>
<strong>Subject to the following clauses/warranties/endorsements/memo attached hereto :-   </strong>
<p>{!! $policydetails->policy_clause !!}</p>
<br>          
<div class="line"></div>
 <p><i>{{  $policydetails->policy_lower_text }}</i></p>  


                <br>
                <br>
       
                   <p class="pull-left">Signed for and on behalf of the company
                   <br>
                   <br>
                   <br>  ............................................................................. <br>  {{ Auth::user()->getNameOrUsername() }}</p>

                  <br>
                   <br>
                   <br>
                  <p class="pull-right"> ............................................................................. <br> Underwriting Manager </p>
                  
                  
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
