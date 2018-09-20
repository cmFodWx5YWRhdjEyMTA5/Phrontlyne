@extends('layouts.default')

@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>CLAIM FACING SHEET</p>
              </header>
               

              <section class="scrollable wrapper" id="summaryreport">
               <img src="/images/{{ $company->logo }}" width="15%" />

                <img class="pull-right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('$claimdetails->claim_id', 'QRCODE')}}" alt="barcode" />
                <br>
                <br>
                <br>
                {{ strtoupper($claimdetails->insured_name) }}
             <div class="line"></div>


                   <span class="label label-danger"> @if($claimdetails->status != 'Released' ) Claim Information  @else Original  @endif </span> <h4 align="center"> <strong> CLAIM FACE SHEET </strong></h4>
                <div class="line"></div>  
              <div class="row">


                 <div class="col-xs-3">
                  <p>  <strong> Insured's Name : </strong> {{ $claimdetails->insured_name }} </p>
                  <p>  <strong> Address : </strong> {{ $insured->postal_address }} </p>
                   <p>  <strong> Agent : </strong> {{ $claimdetails->agency }} </p>
                    <p>  <strong> Policy Class : </strong> {{ $claimdetails->policy_product }} </p>
                   </div>


                <div class="col-xs-3">

                  <p>  <strong> Underwriting Year : </strong> {{ $claimdetails->period_from->format('Y') }} </p>
                  <p>  <strong> Cover Commence : </strong> {{ $claimdetails->period_from->format('d-m-Y') }} </p>
                  <p>  <strong> Cover Expiry : </strong> {{ $claimdetails->period_to->format('d-m-Y') }} </p>
                  <p>  <strong> Branch : </strong> {{ $claimdetails->branch }} </p> 
              
                
                </div>
                <div class="col-xs-3">
               
                   <p>  <strong> Notification Date : </strong> {{ $claimdetails->date_notified->format('d-m-Y') }} </p>
                  <p>  <strong>  Date of Loss : </strong>  {{ $claimdetails->loss_date->format('d-m-Y') }}  </p>
                  <p>  <strong>  Time of Loss : </strong>  {{ $claimdetails->loss_date->format('H:i:s') }}  </p>
                  
                   
                </div>


                <div class="col-xs-3">
               
                  <p>  <strong> Claim No : </strong> {{ $claimdetails->claim_id }} </p>
                  <p>  <strong> Policy No : </strong> {{ $claimdetails->policy_number }} </p>
                  <p>  <strong>  Risk : </strong>  {{ $claimdetails->risk_type }} | {{ $claimdetails->cover_type }}  </p>
                   <p>  <strong> O/S Premium : </strong> {{ 0 }} </p>
                  
                   
                </div>
                    
              </div>   

                 <div class="line"></div>
               <p>  <strong> Cause of Loss : </strong> {{ $claimdetails->cause_of_loss }} </p>

               <div class="line"></div>
                  <p>  <strong> Vehicle/Vessel : </strong> {{ $claimdetails->item_id }} </p>
                  <p>  <strong> Make/Model : </strong> {{ $vehicledetails->vehicle_make  }} {{ $vehicledetails->vehicle_model  }} </p>

               <div class="line"></div>
                <p>  <strong> Memo : </strong> {!! $liabilitymemo->memo !!} </p>
              <div class="line"></div>
              
                <div class="row">
                <div class="col-xs-4">

                  <p>  <strong> Coinsurance : </strong> No </p>
                  
              
                
                </div>
                <div class="col-xs-4 text-center">
               
                   <p>  <strong> Bill Coins.,% : </strong> {{ 0 }} </p>
                  
                   
                </div>
                <div class="col-xs-4 text-right">
               
                
                </div>
                    
              </div>        
          <div class="line"></div>
            <div class="row">
                <div class="col-xs-4">

                  <p>  <strong> Claim Status : </strong> {{ $claimdetails->status }} </p>
                   <p>  <strong> Premium Paid : </strong>{{ $vehicledetails->vehicle_currency }} {{ $vehicledetails->vehicle_premium_charged }} </p>
              
                
                </div>
                <div class="col-xs-4 text-center">
               
                   <p>  <strong> Entry By : </strong> {{ $claimdetails->created_by }} {{ $claimdetails->created_on->format('d-m-Y H:i:s') }}</p>
                  
                   
                </div>
                <div class="col-xs-4 text-right">
               <p>  <strong> Review By : </strong> {{ $claimdetails->approved_by }} {{ $claimdetails->approved_on }} </p>
                
                </div>
                    
              </div>        
                  


               <div class="line"></div>

                {{-- Claimant --}}
              <span class="label label-danger">  Claimant    </span>

                  <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                   
                     <th width="30" style="font-size:12px">Claimant #</th>
                      <th width="30" style="font-size:12px">Claimant</th>
                    <th width="30" style="font-size:12px">Loss Description</th>
                    <th width="30" style="font-size:12px">Nature of Loss</th>
                    <th width="30" style="font-size:12px">Reserve</th>
                     <th width="30" style="font-size:12px">Created On #</th>
                    <th width="30" style="font-size:12px">Created By</th>
                    
                  
                  </tr>
                </thead>
                <tbody>
                 @foreach($myclaimants as $keys => $myclaimant)
                  <tr>
                  <td>00{{ ++$keys }}</td>
                  <td>{{ $myclaimant->adjustor_type }}</td>
                  <td>{{ $claimdetails->loss_description }}</td>
                  <td>{{ $myclaimant->loss_nature }}</td>
                  <td>{{ number_format($myclaimant->loss_approved,2, '.', ',') }}</td>
                    <td>{{ $myclaimant->created_on }}</td>
                    <td>{{ $myclaimant->created_by }}</td>
                  </tr>
                 @endforeach

                 
                </tbody>
              </table> 

                   <br>
                  <br>
                <div class="line"></div>
              <span class="label label-danger">  Reserves    </span>

                  <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                   
                    <th width="30" style="font-size:12px">Item #</th>
                    <th width="30" style="font-size:12px">Category</th>
                    <th width="30" style="font-size:12px">Trans. Date</th>
                     <th width="30" style="font-size:12px">Amount (GHC)</th>
                    <th width="30" style="font-size:12px">Created By</th>
                    <th width="30" style="font-size:12px">Created On</th>
                  
                  </tr>
                </thead>
                <tbody>
                 @foreach($reserves as $keys => $reserve )
                  <tr>

                    <td>00{{  ++$keys }}</td>
                     <td>{{ $reserve->adjustor_type }}</td>
                      <td>{{ $reserve->created_on }}</td>
                       <td>{{ number_format($reserve->loss_estimate,2, '.', ',') }}</td>
                        <td>{{ $reserve->created_by }}</td>
                        <td>{{ $reserve->created_on }}</td>
                    
                  </tr>
                 @endforeach

                  <tr>
                    <td colspan="5" class="text-right no-border"><strong>Total Reserves Entries</strong></td>
                    <td><strong>{{  number_format($totalreserves, 2, '.', ',') }}</strong></td>
                  </tr>
                  <tr>
                    <td colspan="5" class="text-right no-border"><strong>Reserves O/S, Gross</strong></td>
                    <td><strong> {{  number_format($totalreserves, 2, '.', ',') }} </strong></td>
                  </tr>
                  <tr>
                    <td colspan="5" class="text-right no-border"><strong>Reserves O/S, Net (of all RI)</strong></td>
                    <td><strong>0</strong></td>
                  </tr>
                </tbody>
              </table> 
                
                 <br>
                  <br>
                  <br>

                <div class="line"></div>
<span class="label label-danger">  Payments/Recoveries    </span>

                  <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    
                     <th width="30" style="font-size:12px">Item #</th>
                      <th width="30" style="font-size:12px">Category</th>
                    <th width="30" style="font-size:12px">Tran. No.</th>
                    <th width="30" style="font-size:12px">Date</th>
                    <th width="30" style="font-size:12px">Released</th>
                     <th width="30" style="font-size:12px">Cheque #</th>
                    <th width="30" style="font-size:12px">Amount</th>
                    <th width="30" style="font-size:12px">Payee</th>
                    <th width="30" style="font-size:12px">Detail</th>
                  
                  </tr>
                </thead>
                <tbody>
                 @foreach($payments as $keys => $pvoucher )
                  <tr>
                    
                    <td>00{{  ++$keys }}</td>
                     <td>{{ $pvoucher->adjustor_type }}</td>
                      <td>{{ $pvoucher->pv_number }}</td>
                       <td>{{ $pvoucher->pv_date }}</td>
                       <td>{{ $pvoucher->released }}</td>
                        <td>{{ $pvoucher->cheque_number }}</td>
                        <td>{{ number_format($pvoucher->amount,2, '.', ',') }}</td>
                        <td>{{ $pvoucher->payee_name }}</td>
                         <td>{{ $pvoucher->description }}</td>
                  </tr>
                 @endforeach

                  <tr>
                    <td colspan="7" class="text-right no-border"><strong>Total Payments Released, Net</strong></td>
                    <td><strong>{{  number_format($totalpaid, 2, '.', ',') }}</strong></td>
                  </tr>
                </tbody>
              </table> 

                 <br>
                  <br>
                  <br>

                 

                <div class="line"></div>
                <span class="label label-danger">  Summary of Payments & Reserves (GHC)    </span>

                  <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th width="30"></th>
                    <th width="30" style="font-size:12px">Tran. Year</th>
                    <th width="30" style="font-size:12px">Payments (Res)</th>
                    <th width="30" style="font-size:12px">Payments (Loc)</th>
                     <th width="30" style="font-size:12px">Reserves (Res)</th>
                    <th width="30" style="font-size:12px">Reserves (Loc)</th>
                    <th width="30" style="font-size:12px">O/S Reserves</th>
                  
                  </tr>
                </thead>
                <tbody>
                 @foreach($payments as $keys => $vehicle )
                  <tr>
                    
                  </tr>
                 @endforeach

                 
                </tbody>
              </table> 
                  
                  <br>
                  <br>
                  <br>

                <div class="line"></div>

                <span class="label label-danger">  Reinsurance (% share and O/S reserve amount)    </span>

                  <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th width="30"></th>
                    <th width="30" style="font-size:12px">Type</th>
                    <th width="30" style="font-size:12px">RI Co.</th>
                    <th width="30" style="font-size:12px">Cession Yr.</th>
                     <th width="30" style="font-size:12px">Cession No.</th>
                    <th width="30" style="font-size:12px">Recip Policy & Claim</th>
                    <th width="30" style="font-size:12px">RI %</th>
                    <th width="30" style="font-size:12px">Entry by</th>
                    <th width="30" style="font-size:12px">Entry Date</th>
                    <th width="30" style="font-size:12px">Term.</th>
                  
                  </tr>
                </thead>
                <tbody>
                 @foreach($payments as $keys => $vehicle )
                  <tr>
                    
                  </tr>
                 @endforeach

                 
                </tbody>
              </table> 
                  
                  <br>
                  <br>
                  <br>

                <div class="line"></div>

                <span class="label label-danger">  Summary of Payments & Reserves - Gross, RI and Net (GHC)    </span>

                  <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th width="30"></th>
                    <th width="30" style="font-size:12px">Payments</th>
                    <th width="30" style="font-size:12px">Reserves</th>
                   
                  
                  </tr>
                </thead>
                <tbody>
                 @foreach($payments as $keys => $vehicle )
                  <tr>
                    
                  </tr>
                 @endforeach
                  <tr>
                    <td colspan="2" class="text-right no-border"><strong>Total Payments Released - Gross</strong></td>
                    <td><strong>{{  number_format($totalpaid, 2, '.', ',') }} </strong></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right no-border"><strong>Total Reserve O/S - Gross </strong></td>
                    <td><strong>{{  number_format($totalreserves, 2, '.', ',') }}</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right no-border"><strong>O/S Reserves, Auto - TREATY</strong></td>
                    <td><strong>0</strong></td>
                  </tr>
                   <tr>
                    <td colspan="2" class="text-right no-border"><strong>Recoveries, Auto - FAC </strong></td>
                    <td><strong>0</strong></td>
                  </tr>
                 
                </tbody>
              </table> 
            <div class="line"></div>
                
                <div align="center">
  <p><strong>----------------------- END -----------------------</strong></p>
</div>



                <br>
                <br>
       
                   <p class="pull-left">Generated By
                   <br>
                   <br>
                   <br>  ............................................................................. <br>  {{ Auth::user()->getNameOrUsername() }}</p>

                  <br>
                   <br>
                   <br>
                  <p class="pull-right"> ............................................................................. <br> Claims Manager </p>
                  
                  
                  </section>
                  
                  </section>
<div>{{ Carbon\Carbon::parse($claimdetails->created_on )->format('dmY') }}|{{Abbreviation::make($claimdetails->created_by)}}|{{ Carbon\Carbon::parse($claimdetails->approved_on )->format('dmY') }}|{{Abbreviation::make($claimdetails->approved_by)}}|{{ Carbon\Carbon::now()->format('dmY') }}|{{Abbreviation::make(Auth::user()->getNameOrUsername())}}</div>
            
@stop
