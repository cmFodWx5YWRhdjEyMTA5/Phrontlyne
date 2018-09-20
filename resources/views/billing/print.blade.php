@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Invoice</p>
            </header>
            <section class="scrollable wrapper">
              <i class="fa fa-xing fa fa-3x"></i>
              <div class="row">
                <div class="col-xs-6">
                  <h4>OrionMD</h4>
                  <p><a href="#">www.OrionLabs.com</a></p>
                  <br>
                  <p>{{ $patients[0]->fullname }} <br>
                    {{ $patients[0]->postal_address }}<br>
                    Ghana
                  </p>
                  <p>
                    Telephone:  +{{ $patients[0]->mobile_number }}<br>
                    Email:  {{ $patients[0]->email }}
                  </p>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="h4">#9048392</p>
                  <h5>{{ date('Y-m-d') }}</h5>   
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('9048392', 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>          
          
              <div class="line"></div>
              <table class="table">
                <thead>
                  <tr>
                    <th width="60">QTY</th>
                    <th>DESCRIPTION</th>
                    <th width="140">UNIT PRICE</th>
                    <th width="90">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($bills as $bill )
                  <tr>
                    <td>1</td>
                    <td>{{ $bill->item_name }}</td>
                    <td>{{ $bill->amount }}</td>
                    <td>{{ $bill->amount }}</td>
                  </tr>
                 @endforeach
                  <tr>
                    <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                    <td>GHS {{ $bills->sum('amount') }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>Deliveries</strong></td>
                    <td>GHS0.00</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>VAT Included in Total</strong></td>
                    <td>GHS0.00</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>Total</strong></td>
                    <td><strong>GHS {{ $bills->sum('amount') }}</strong></td>
                  </tr>
                </tbody>
              </table>  
              <h4 class="text-center">Thank you for your payment!</h4><br><br>
            <p class="text-right payment-methods"><i class="fa fa-cc-visa fa-3x"></i> <i class="fa fa-cc-mastercard fa-3x"></i> <i class="fa fa-cc-discover fa-3x"></i> <i class="fa fa-cc-amex fa-3x"></i> <i class="fa fa-cc-paypal fa-3x"></i> <i class="fa fa-cc-stripe fa-3x"></i></p>
            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop