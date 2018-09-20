@extends('layouts.default')
@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>CERTIFICATE OF INSURANCE</p>
              </header>
<div id="background">
          @if($policydetails->policy_status != 'In Force' ) <p id="bg-text">Draft</p>  @else   @endif 
        </div>    

              <section class="scrollable wrapper" id="summaryreport">
                 
                 <img src="/images/{{ $company->logo }}" width="15%" />
                  <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG($policydetails->master_policy_number, 'QRCODE')}}" alt="barcode" />
                 <br>
                 <br>
              <div class="row">
            
                  

                <div class="col-xs-6">

                 <p>  <strong> Policy Number : </strong> {{ $policydetails->master_policy_number }}</p>
                 <p>  <strong> Certificate No : </strong> {{ $fetchrecord->id.date("mY") }} </p>
                 <p>  <strong>  Certicate Time/Date : </strong> {{ date("g:ia\, jS M Y", strtotime($fetchrecord->created_on )) }}</p>
                 
                </div>
                <div class="col-xs-6 text-right">
               
                  <p>  <strong> Risk Type : </strong> {{ $fetchrecord->vehicle_risk }}</p>
                  <p>  <strong> Cover Type : </strong> {{ $fetchrecord->vehicle_cover }}</p>
                  <p>  <strong> Seating Capacity : </strong> {{ $fetchrecord->vehicle_seating_capacity }}</p>
                </div>
                   
              </div>    

               <div class="line"></div>
               <p style="font-size:12px"> <strong>1. Index Mark and Registration Number : </strong>
               {{ $fetchrecord->vehicle_registration_number }}
               </p>

               <div class="line"></div>


               
                 <p style="font-size:12px"> <strong>2. Name of Policy Holder : </strong> {{ $policydetails->fullname }} @if($policydetails->policy_interest != null) / {{ $policydetails->policy_interest  }} @else  @endif
                
               </p>
               

               
                 <p style="font-size:12px"> <strong>3. Effective Date of the Commencement of Insurance for the purpose of the Act : </strong>{{ Carbon\Carbon::parse($fetchrecord->period_from )->format('l jS \\of F Y') }}
               </p>
               

              
                 <p style="font-size:12px"> <strong>4. Date of Expiry of Insurance : </strong> {{ Carbon\Carbon::parse($fetchrecord->period_to )->format('l jS \\of F Y') }}
               </p>
              


            
                 <p style="font-size:12px"> <strong>5. Persons of Classes of Persons Entitled to Drive : </strong> {{ $certificate->entitled_to_drive }}
               </p>
              

               
                 <p style="font-size:12px"> <strong>6. Limited on as to Use : </strong> {{ $certificate->limitation_of_use }}
               
               </p> 


                
                 <p style="font-size:12px"> <strong>7. The Policy does not Cover : </strong>{{ $certificate->policy_not_covered }}
                
               </p>

                <p style="font-size:12px"> 
                <strong>8 O.D.E : </strong>{{ $fetchrecord->vehicle_buy_back_excess }} <br>
                 <strong>T.T.P.D.L : </strong>{{ $policydetails->policy_currency }}{{ number_format($fetchrecord->vehicle_tppdl_value,2, '.', ',') }} <br>
                  <strong>Voluntary Excess : </strong>{{ $fetchrecord->voluntary_status }}
               </p>
               
                <br>
                <br>
                 <div class="row">
                <div class="col-xs-6">
                 
                 <p>  <strong> Issued On: </strong> {{ $fetchrecord->created_on->format('d-m-Y') }}</p>
               
                 
                </div>
                <div class="col-xs-6 text-right">
               
                  <p>  <strong> Time : </strong> {{ $fetchrecord->created_on->format('h:i:s') }}</p>
                 
                </div>
                
              </div>    

              <div class="line"></div>
                <br>
                <br>

                 <p style="font-size:12px"> <i> <b> I / WE HEREBY CERTIFY that the policy to which this certicate relates is issued in accordance with the provisions of the MOTOR VEHICLES (THIRD PARTY INSURANCE) ACT, 1958 (GHANA) </b> </i>
                
               </p>

                <br>

                 <p style="font-size:12px"> <i> <b> For and on behalf of the PHOENIX INSURANCE COMPANY (GH.) LIMITED </b> </i>
                

                  <br>
                <br>
                  <br>
                <br>

                 
                   <p class="pull-left"> ............................................................................. <br> Examined By  [{{ $fetchrecord->created_by  }}] </p>


                  <p class="pull-right"> ............................................................................. <br> Underwriting Manager  </p>
                  
                  </section>
                  

                  </section>
                  <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('$fetchrecord->policy_number', 'QRCODE')}}" alt="barcode" /> 

             
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
