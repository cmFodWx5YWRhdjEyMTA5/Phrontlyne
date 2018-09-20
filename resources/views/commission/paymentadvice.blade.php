

@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Bill</p>
            </header>
             <section class="scrollable wrapper">
             <img src="/images/{{ $company->logo }}" width="15%">
              <div class="row">
                <div class="col-xs-6">
                  <h4>{{$company->legal_name }}</h4>
                  <p><a href="#">{{ $company->email }}</a></p>
                   <p><a href="#">{{ $company->address }}</a></p>
                   <p><a href="#">{{ $company->phone }}</a></p>
                   <p><a href="#">{{ $company->website }}</a></p>
                  <br> 
                  </p>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="h4 badge bg-default">{{ $selectedcommission->agent_number }}</p>
                  <p>{{ $selectedcommission->currency }}</p>
                  <p>{{ Carbon\Carbon::now() }}</p>
                 
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$selectedcommission->agent_number', 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>       
          
              <div class="line"></div>
              <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                     <th width="30" style="font-size:12px"></th>
                    <th width="30" style="font-size:12px">RECEIPT NUMBER</th>
                    <th width="30" style="font-size:12px">POLICY #</th>
                    <th width="30" style="font-size:12px">COB</th>
                    <th width="30" style="font-size:12px">INSURED</th>
                    <th width="30" style="font-size:12px">RECEIPT DATE</th>
                    <th width="30" style="font-size:12px">PREMIUM PAID</th>
                    <th width="30" style="font-size:12px">GROSS COMMISSION</th>
                    <th width="30" style="font-size:12px">PREMIUM TYPE</th>
                    <th width="30" style="font-size:12px">RECEIPT MODE</th>
                    <th width="30" style="font-size:12px">COMMSSION RATE</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($commissions as $keys => $bill )
                  <tr>
                   <td>{{ ++$keys }}</td>
                    <td>{{ $bill->receipt_number }}</td>
                    <td>{{ $bill->policy_number }}</td>
                    <td>{{ $bill->policy_product }}</td>
                     <td>{{ $bill->insured_name }}</td>
                    <td>{{ $bill->receipt_date }}</td>
                    <td>{{ number_format($bill->amount_paid, 2, '.', ',')  }}</td>
                    <td>{{ number_format($bill->gross_commission, 2, '.', ',')  }}</td>
                     <td>{{ $bill->collection_mode }} {{ $bill->reference_number}}</td>
                      <td>{{ $bill->transaction_type }}</td>
                    <td>{{ $bill->commission_rate }}</td>
                  </tr>
                 @endforeach



                  <tr>
                    <td colspan="10" class="text-right"><strong>Total Gross Commission</strong></td>
                    <td>{{ $commissions[0]->currency }} {{ number_format($commissions->sum('gross_commission'), 2, '.', ',') }}</td>
                  </tr>
                  <tr>
                    <td colspan="10" class="text-right no-border"><strong>IRS Tax</strong></td>
                    <td>{{ $commissions[0]->currency }}{{ number_format($commissions->sum('tax'), 2, '.', ',') }}</td>
                  </tr>
                  <tr>
                    <td colspan="10" class="text-right no-border"><strong>Net Commssion</strong></td>
                    <td><strong>{{ $commissions[0]->currency }} {{ number_format($commissions->sum('net_commission'), 2, '.', ',') }}</strong></td>
                  </tr>
                </tbody>
              </table> 
              <p class="btn btn-sm btn-default pull-right">Printed By : {{ Auth::user()->getNameOrUsername() }}</p> 
               <p class="btn btn-sm btn-default pull-left">Approved By : {{ $selectedcommission->approved_by }}</p>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
               <p class="pull-right">Accountant's Signature : ..............................................................................</p>
      <h4 class="text-center">Additional Notes</h4>
      <div class="text-center">
        <p>NB: NIC Sticker charge <strong> {{ number_format($selectedcommission->sticker_charge, 2, '.', ',') }}</strong> has been deducted from premium before gross commission computed.</p>

           
            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


