@extends('layouts.default')

@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>MOTOR RENEWAL NOTICE</p>
              </header>
               
     
               <section class="scrollable wrapper" id="summaryreport">
               <img src="/images/{{ $company->logo }}" width="15%" />

                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('$policydetails->master_policy_number', 'QRCODE')}}" alt="barcode" />
                  <div style="position: absolute;bottom: 10px; left: 10px; ">{{ Carbon\Carbon::parse($policydetails->created_on )->format('dmY') }}|{{Abbreviation::make($policydetails->created_by)}}|{{ Carbon\Carbon::parse($policydetails->approved_on )->format('dmY') }}|{{Abbreviation::make($policydetails->approved_by)}}|{{ Carbon\Carbon::now()->format('dmY') }}|{{Abbreviation::make(Auth::user()->getNameOrUsername())}}</div>

                <br>
                <br>
                <br>
             <div class="line"></div>


                    <span class="label label-danger"> @if($policydetails->policy_status != 'Released' ) Draft Policy  @else Original  @endif </span>  <h4 align="center"> <strong>RENEWAL NOTICE </strong></h4>
                <div class="line"></div>  
              <div class="row">
                <div class="col-xs-4">

                  <p>  <strong> Agency : </strong> {{ $policydetails->agency }} </p>
                  <p>  <strong> Account : </strong> {{ $policydetails->agency }} </p>
                  <p>  <strong> Client : </strong> {{ $policydetails->account_number }} </p> 
              
                
                </div>
                <div class="col-xs-4 text-center">
               
                  <p>  <strong> Class of Policy : </strong> {{ $policydetails->policy_product }} </p>
                  <p>  <strong> Issued on : </strong> {{ $policydetails->acceptance_date  }} </p>
                  <p>  <strong> Renewal Notice Date : </strong> {{ Carbon\Carbon::now()  }}  </p>
                   
                </div>
                <div class="col-xs-4 text-right">
               
                  <p>  <strong> Policy Number : </strong> {{ $policydetails->master_policy_number }} </p>
                  <p>  <strong> Expiry Date : </strong> {{ Carbon\Carbon::parse($policydetails->insurance_period_to )->format('d-m-Y') }} </p>
                   <p>  <strong> Renewal Number : </strong> {{ $policydetails->master_policy_number }} </p>
                   
                </div>
                    
              </div>   
             
              <div class="line"></div>
                   <p>  <strong> Period of Insurance from </strong> {{ Carbon\Carbon::parse($policydetails->insurance_period_from )->format('d-m-Y') }} to  {{ Carbon\Carbon::parse($policydetails->insurance_period_to )->format('d-m-Y') }}, both dates inclusive </p>
              <div class="line"></div>
                  <p>  <strong> Insured's Name : </strong> {{$customers->fullname }} </p>
                  <p>  <strong> Address : </strong> {{ $customers->postal_address }} </p>
                  <p>  <strong> Phone : </strong> {{ $customers->mobile_number }} </p>
                   <p>  <strong> Business / Occupation : </strong> {{ $customers->field_of_activity }} </p>
              <div class="line"></div>

                 <p><i>{{  $policydetails->policy_upper_text }}</i></p> 
                   
                
                    
            
             
              <div class="line"></div>
                    <h4 align="left"> <strong> Charges & Benefits </strong></h4>
              <div class="line"></div>

              <div class="row">
                <div class="col-xs-6">
                 
              
                  <p>  <strong> TP Basic Premium : </strong> {{ number_format( $fetchrecord->sum('base_premium'),2, '.', ',') }}</p>
                  <p>  <strong> Own Damage : </strong> {{ number_format( $fetchrecord->sum('own_damage_premium') - $fetchrecord->sum('base_premium') ,2, '.', ',') }}</p>
                  <p>  <strong> Cc/Age Loading : </strong> {{ number_format($fetchrecord->sum('cc_age'),2, '.', ',') }}</p>
                  <p>  <strong> Office Premium : </strong> {{ number_format($fetchrecord->sum('office_premium'),2, '.', ',') }} </p>
                  <p>  <strong> No Claim Discount : </strong> {{ number_format($fetchrecord->sum('ncd_charge'),2, '.', ',') }} </p>

                 
                </div>
                 <div class="col-xs-6 text-right">
               
                 <p>  <strong> Fleet Discount : </strong> {{ number_format($fetchrecord->sum('fleet_charge'),2, '.', ',') }} </p>
                  <p>  <strong> Net Premium : </strong> {{ number_format($fetchrecord->sum('netpremium'),2, '.', ',') }} </p>
                  <p>  <strong> Loading Applied : </strong> {{ number_format($fetchrecord->sum('loading_applied'),2, '.', ',') }} </p>
                  <p>  <strong> Motor Contribution : </strong> {{ number_format($fetchrecord->sum('contributions'),2, '.', ',') }} </p>
                   
                </div> 
                    
              </div>
  

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
                    <th width="30" style="font-size:12px">Office Premium</th>
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
                    <td>{{ number_format($vehicle->vehicle_premium_charged,2, '.', ',') }}</td>
                  </tr>
                 @endforeach

                  <tr>
                    <td colspan="12" class="text-right no-border"><strong>Total</strong></td>
                    <td><strong>{{ $policydetails->policy_currency }} {{ number_format($fetchrecord->sum('vehicle_premium_charged'), 2, '.', ',')}}</strong></td>
                  </tr>
                </tbody>
              </table> 

      

<div class="line"></div>
<strong>Clauses</strong>
<p>{!! $policydetails->policy_clause !!}</p>
<br>
<br>
                
<div class="line"></div>

<p> This document is a summary of cover provided in terms of the policy for renewal of the insurance for the period indicated. </p>                                         
<p> This document becomes valid as a Renewal Receipt and confirmation signed, stamped and dated by an official or agent of the Insurers </p>
                <br>
                <br>
                <br>
                <br>

                   <p class="pull-left">  ............................................................................. <br> Examined By  {{ Auth::user()->getNameOrUsername() }}</p>


                  <p class="pull-right"> ............................................................................. <br> Underwriting Manager </p>
                  
<br>
<br>
<br>

<small class="block m-t-sm"> PLEASE PAY THE ABOVE PREMIUM DIRECTLY TO ENTERPRISE INSURANCE                                                 
BEFORE OR AT RENEWAL. KINDLY INSIST ON A RECEIPT UPON PAYMENT  </small>                                               
                                                                                                              
<small class="block m-t-sm"> ##NO PREMIUM NO COVER: From 1st April, all premiums will have to be paid upfront in accordance with NIC's  'No premium, No cover' regulation. For any enquiries please contact any of our offices. </small> 

<small class="block m-t-sm"> ##FOREIGN CURRENCY POLICIES: All foreign currency policies have now been redenominated in Ghana Cedis in accordance with Bank of Ghana notice no BG/GOV/SEC/2014/02. Kindly note the exchange rate used, which should reflect in your premium as well as your sum insured. 1-USDollar = {{ $exchanges[3]->rate}}; 1-UK Pound = {{ $exchanges[2]->rate}}; 1-Euro = {{ $exchanges[0]->rate}} </small>

                  </section>
                  
                  </section>


             
@stop


<style type="text/css">


#bg-text
{
    color:lightgrey;
    font-size:100px;
    transform:rotate(300deg);
    -webkit-transform:rotate(300deg);
}
</style>



