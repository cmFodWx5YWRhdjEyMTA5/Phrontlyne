@extends('layouts.default')

@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>FIRE SCHEDULE</p>
              </header>
               

               <section class="scrollable wrapper" id="summaryreport">
               <img src="/images/{{ $company->logo }}" width="15%" />

                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('$policydetails->policy_number', 'QRCODE')}}" alt="barcode" />
                <br>
                <br>
                <br>
             <div class="line"></div>


                   <span class="label label-danger"> @if($policydetails->status != 'Released' ) Draft Policy  @else Original  @endif </span> <h4 align="center"> <strong>POLICY SCHEDULE </strong></h4>
                <div class="line"></div>  
              <div class="row">
                <div class="col-xs-4">

                  <p>  <strong> Agency : </strong> {{ $policydetails->agency }} </p>
                  <p>  <strong> Account : </strong> {{ $policydetails->agency }} </p>
                  <p>  <strong> Client : </strong> {{ $policydetails->account_number }} </p> 
              
                
                </div>
                <div class="col-xs-4 text-center">
               
                  <p>  <strong> Class of Policy : </strong> {{ $policydetails->coverage }} </p>
                  <p>  <strong> Issued on : </strong> {{ $policydetails->first_issue_date  }} </p>
                  <p>  <strong> Acceptance Date : </strong> {{ $policydetails->acceptance_date  }}  </p>
                   
                </div>
                <div class="col-xs-4 text-right">
               
                  <p>  <strong> Policy Number : </strong> {{ $policydetails->policy_number }} </p>
                  
                   
                </div>
                    
              </div>   
             

             

              <div class="line"></div>
                   <p>  <strong> Period of Insurance from </strong> {{ Carbon\Carbon::parse($policydetails->insurance_period_from )->format('d-m-Y') }} to  {{ Carbon\Carbon::parse($policydetails->insurance_period_to )->format('d-m-Y') }}, both dates inclusive </p>
              <div class="line"></div>
                  <p>  <strong> Insured's Name : </strong> {{$customers->fullname }} </p>
                  <p>  <strong> Address : </strong> {{ $customers->postal_address }} </p>
                 
              <div class="line"></div>

                 <p><i>{{  $policydetails->policy_upper_text }}</i></p>  
                <div class="line"></div>
               
                <div class="row">
                  
                   <div class="col-xs-4 text-center">
               
                  <p>  <strong> Basic Annual Premium : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('actual_premium'), 2, '.', ',') }} </p>
                  <p>  <strong> LONG TERM AGREEMENT : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('long_term_value'), 2, '.', ',')  }} </p>
                  <p>  <strong> Fire Extinguisher Appliance : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('fire_ex_value'), 2, '.', ',')  }} </p>
                  
                   
                </div>

                <div class="col-xs-4 text-right">
               
                  <p>  <strong> FIRE HYDRANT : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('fire_hy_value'), 2, '.', ',')  }} </p>
                  <p>  <strong> Total Annual Premium : </strong>{{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('annual_premium'), 2, '.', ',') }} </p>
                  <p>  <strong> Premium Due : </strong><b> {{ $policydetails->policy_currency }} {{ number_format($mastergroup->sum('premium_payable') +  $fees->amount, 2, '.', ',')  }} </b> </p>
                  
                   
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
                    <th width="30" style="font-size:12px">Sum Insured</th>
                    
                  </tr>
                </thead>
                <tbody>
                 @foreach($fetchrecord as $risk => $risks )
                  <tr>
                     <th> Risk {{ $risk }} <br>
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
                           <td colspan="1">{{ $schedule->property_description }}</td>
                           <td colspan="1">{{ number_format($schedule->item_value, 2, '.', ',') }} </td> 
                           </tr>
                        @endforeach
                        </td>
                          <tr>
                    <td colspan="2" class="text-right no-border"><strong>Total Sum Insured </strong></td>
                    <td><strong>{{ $policydetails->policy_currency }} {{ number_format($risks->sum('item_value'), 2, '.', ',')}} </strong></td>
                  </tr> 
                  <tr>
                    <td colspan="2" class="text-right" style="font-size:10px"><strong>Basic Annual Premium</strong></td>
                    <td style="font-size:10px">{{ $policydetails->policy_currency }} {{ number_format($risks->sum('actual_premium'), 2, '.', ',') }}</td>
                  </tr>

                  <tr>
                    <td colspan="2" class="text-right" style="font-size:10px"><strong>LONG TERM AGREEMENT</strong></td>
                    <td style="font-size:10px"> - {{ $policydetails->policy_currency }} {{ number_format($risks->sum('long_discount'), 2, '.', ',')  }}</td>
                  </tr>

                   <tr>
                    <td colspan="2" class="text-right" style="font-size:10px"><strong>Fire Extinguisher Appliance</strong></td>
                    <td style="font-size:10px"> - {{ $policydetails->policy_currency }} {{ number_format(($risks->sum('actual_premium') - $risks->sum('long_discount'))  * $risks->sum('extinguisher_discount'), 2, '.', ',')  }}</td>
                  </tr>

                   <tr>
                    <td colspan="2" class="text-right" style="font-size:10px"><strong>FIRE HYDRANT</strong></td>
                    <td style="font-size:10px"> - {{ $policydetails->policy_currency }} {{ number_format((($risks->sum('actual_premium') - $risks->sum('long_discount')) -  ($risks->sum('actual_premium') - $risks->sum('long_discount')) * $risks->sum('extinguisher_discount'))  *  $risks->sum('hydrant_discount') , 2, '.', ',') }}</td>
                  </tr>
          
                  <tr>
                    <td colspan="2" class="text-right no-border" style="font-size:10px"><strong>Total Annual Premium</strong></td>
                    <td style="font-size:10px"><strong>{{ $policydetails->policy_currency }} {{ number_format((($risks->sum('actual_premium') - $risks->sum('long_discount')) -  ($risks->sum('actual_premium') - $risks->sum('long_discount')) * $risks->sum('extinguisher_discount')) - ((($risks->sum('actual_premium') - $risks->sum('long_discount')) -  ($risks->sum('actual_premium') - $risks->sum('long_discount')) * $risks->sum('extinguisher_discount')) * $risks->sum('hydrant_discount')), 2, '.', ',') }}</strong>
                    </td>
                  </tr> 

                  <tr>
                    <td colspan="2" class="text-right no-border" style="font-size:10px"><strong>Premium Due </strong></td>
                    <td style="font-size:10px"><strong>{{ $policydetails->policy_currency }} {{ number_format($risks->sum('premium_payable'), 2, '.', ',') }}</strong>
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



