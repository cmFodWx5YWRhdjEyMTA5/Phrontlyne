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


                      @if($fetchrecord[0]->vehicle_value >= $protectedlimit->sum_insured)
                      <a href="#" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-thumbs-up  fa-lock"></i> Your limit/role cannot activate this policy </a>
                      @else
                      @if($policydetails->policy_status == 'In Force')
                      <a href="#" class="btn btn-rounded btn-sm btn-success"><i class="fa fa-thumbs-up  fa-lock"></i> Policy is {{ $policydetails->policy_status }} </a>
                      @else
                      <a href="#" onclick="approvePolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-spin fa-spinner hide show inline" id="spin"></i> Policy in {{ $policydetails->policy_status}} state  </a>
                      @endif
                      @endif



                      @if($debitreference->payment_status == 'Paid')
                      <a href="/print-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print Certificate </a>
                      @else

                      @endif

                      <a href="#" class="btn btn-rounded btn-sm btn-default" onClick="window.print();"><i class="fa fa-fw fa-print"></i> @if($policydetails->policy_status != 'In Force' ) Print Draft Schedule  @else Print Schedule  @endif </a>

                      @if($policydetails->policy_status != 'In Force' )
                      <a href="/append-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default" ><i class="fa fa-fw fa-plus"></i>  Add New Vehicle   </a> @else   @endif

                        
                       {{-- <a href="/print-notice/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Renewal Notice </a> --}}


                      @if($policydetails->policy_status == 'In Force')
                      <a href="/print-invoice/{{ $debitid }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-money  fa-lock"></i> Print Debit Note </a>
                      @else
                     
                      @endif
              </p>



              </div>

                <p>MOTOR SCHEDULE</p>
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


                 <input type="hidden" id="policy_number" name="policy_number" value="{{ $policydetails->policy_number }}">
                <input type="hidden" id="policy_product" name="policy_product" value="{{ $policydetails->policy_product }}">
                <input type="hidden" id="cover_type" name="cover_type" value="{{ $fetchrecord[0]->vehicle_use }}">
                <input type="hidden" id="risk_type" name="risk_type" value="{{ $fetchrecord[0]->vehicle_risk }}">
                <input type="hidden" id="policy_branch" name="policy_branch" value="{{ $policydetails->policy_branch }}">
                <input type="hidden" id="policy_sales_type" name="policy_sales_type" value="{{ $policydetails->policy_source }}">
                 
              
                <p>  <strong> Name of Insured : </strong> {{ $customers->fullname }} @if($policydetails->policy_interest != null) / {{ $policydetails->policy_interest  }} @else  @endif </p>
                <p>  <strong> Address: </strong> {{ $customers->postal_address }}</p>
                <p>  <strong> Occupation: </strong> {{ $customers->field_of_activity }}</p>
                <p>  <strong>  Branch : </strong> {{ $policydetails->policy_branch }} </p>
                 
                </div>
                <div class="col-xs-6 text-right">
               
                  <p>  <strong> Policy Number : </strong> [{{ $policydetails->master_policy_number }}] </p>
                  <p>  <strong> Period of Insurance : </strong> {{ Carbon\Carbon::parse($policydetails->insurance_period_from )->format('d-m-Y') }} to  {{ Carbon\Carbon::parse($policydetails->insurance_period_to )->format('d-m-Y') }} </p>
                   
                </div>
                    
              </div>    
             
              <div class="line"></div>
                    <h4 align="left"> <strong> Charges & Discounts </strong></h4>
              <div class="line"></div>

             
  

                 <p>{!!  $policydetails->policy_upper_text !!}</p>  
               <div class="line"></div>
               


                 <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th width="30"></th>
                    <th width="30" style="font-size:12px">Registration #</th>
                    <th width="30" style="font-size:12px">Make & Model</th>
                    <th width="30" style="font-size:12px">Cover Type</th>
                     <th width="30" style="font-size:12px">Motor Class</th>
                    <th width="30" style="font-size:12px">Chassis Number</th>
                    <th width="30" style="font-size:12px">Seating Capacity</th>
                    <th width="30" style="font-size:12px">Year of Make</th>
                    <th width="30" style="font-size:12px">Cubic Capacity</th>
                    <th width="30" style="font-size:12px">Sum Insured</th>
                    <th width="30" style="font-size:12px">NCD%</th>
                    <th width="30" style="font-size:12px">Fleet Discount%</th>
                    <th width="30" style="font-size:12px"> Premium</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($fetchrecord as $keys => $vehicle )
                  <tr>
                    <td> {{ ++$keys }} </td>
                    <td>{{ $vehicle->vehicle_registration_number }}</td>
                    <td>{{ $vehicle->vehicle_make }} - {{ $vehicle->vehicle_model }}</td>
                     <td>{{ Abbreviation::make($vehicle->vehicle_cover) }}</td>
                     <td>{{ $vehicle->vehicle_risk }}</td>
                    <td>{{ $vehicle->vehicle_chassis_number }}</td>
                    <td>{{ $vehicle->vehicle_seating_capacity }}</td>
                     <td>{{$vehicle->vehicle_make_year }}</td>
                    <td>{{ $vehicle->vehicle_cubic_capacity }}</td>
                    <td>{{ number_format($vehicle->vehicle_value, 2, '.', ',') }}</td>
                    <td>{{ $vehicle->vehicle_ncd * 100 }}</td>
                    <td>{{ $vehicle->vehicle_fleet_discount }}</td>
                    <td>{{ number_format($vehicle->premium_due,2, '.', ',') }}</td>
                  </tr>
                 @endforeach

                  <tr>
                    <td colspan="12" class="text-right no-border"><strong>Total</strong></td>
                    <td><strong>{{ $policydetails->policy_currency }} {{ number_format($fetchrecord->sum('premium_due'), 2, '.', ',')}}</strong></td>
                  </tr>
                </tbody>
              </table> 

      

<div class="line"></div>
 <div class="row">
                <div class="col-xs-6">
                 
              
                  <p>  <strong> TP Basic Premium : </strong> {{ number_format( $fetchrecord->sum('base_premium'),2, '.', ',') }}</p>
                  <p>  <strong> Own Damage : </strong> {{ number_format( $fetchrecord->sum('own_damage_premium') ,2, '.', ',') }}</p>
                  <p>  <strong> Cc/Age Loading : </strong> {{ number_format($fetchrecord->sum('cc_age'),2, '.', ',') }}</p>
                  <p>  <strong> Office Premium : </strong> {{ number_format($fetchrecord->sum('office_premium'),2, '.', ',') }} </p>
                  <p>  <strong> No Claim Discount : </strong> {{ number_format($fetchrecord->sum('ncd_charge'),2, '.', ',') }} </p>

                 
                </div>
                 <div class="col-xs-6 text-right">
               
                 <p>  <strong> Fleet Discount : </strong> {{ number_format($fetchrecord->sum('fleet_charge'),2, '.', ',') }} </p>
                  <p>  <strong> Loading Applied : </strong> {{ number_format($fetchrecord->sum('loading_applied'),2, '.', ',') }} </p>
                  <p>  <strong> Motor Contribution : </strong> {{ number_format($fetchrecord->sum('contributions'),2, '.', ',') }} </p>
                  <p>  <strong> Motor TPPDL : </strong> {{ number_format($fetchrecord->sum('vehicle_tppdl_value'),2, '.', ',') }} </p>
                    <p>  <strong> Net Premium : </strong> {{ number_format($fetchrecord->sum('netpremium'),2, '.', ',') }} </p>
                   
                </div> 
                    
              </div>
<div class="line"></div>
<strong>Clauses</strong>
<p>{!! $policydetails->policy_clause !!}</p>
<br>
<br>
                
<div class="line"></div>

 <p>{!!  $policydetails->policy_lower_text !!}</p>  

 <div class="line"></div>
<strong>Legend</strong>
<p>COM : Comprehensive</p>
<p>TPFT : Third Party Fire & Theft</p>
<p>TP : Third Party</p>
<div class="line"></div>
 
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                   <p class="pull-left">  ............................................................................. <br> Examined By  {{ Auth::user()->getNameOrUsername() }}</p>


                  <p class="pull-right"> ............................................................................. <br> Underwriting Manager </p>
                  
                  <div style="position: absolute;bottom: 10px; left: 10px; ">{{ Carbon\Carbon::parse($policydetails->created_on )->format('dmY') }}|{{Abbreviation::make($policydetails->created_by)}}|{{ Carbon\Carbon::parse($policydetails->approved_on )->format('dmY') }}|{{Abbreviation::make($policydetails->approved_by)}}</div>
                  </section>
                  
                  </section>


             
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



