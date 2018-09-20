@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Discharge Voucher</p>
              </header>
             <section class="scrollable wrapper">
             <img src="/images/{{ $company->logo }}" width="15%">
              <div class="row">
                <div class="col-xs-6">
                  <h4>{{ $company->legal_name }}</h4>
                  <p><a href="#">{{ $company->email }}</a></p>
                   <p><a href="#">{{ $company->address }}</a></p>
                   <p><a href="#">{{ $company->phone }}</a></p>
                   <p><a href="#">{{ $company->website }}</a></p>
                  <br>
                  <br>
                  <br>
                     
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="h4">Claim # :{{ $claim->claim_number }}</p>
                      <p class="h4">Policy # : {{ $lossdetail->policy_number }}</p>
                        <p class="h4">Item # : {{ $lossdetail->item_id }}</p>
                    <h5>{{ date('Y-m-d') }}</h5> 
                    <br>
                    <br>
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$claim->name', 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>    
              <div>
                <h3 align="center"> <strong> DISCHARGE VOUCHER </strong> </h3>
                <p style="font-size:18px">
                I(we) {{ $claim->payee_name }} of {{ $claim->address }} hereby accept the sum of {{ $claim->currency }} {{ number_format($claim->amount, 2, '.', ',') }} in ful and final satisfaction of all claims (whether past or arising in the future) which I might have arising directly or indirectly out of an accident which took place at about {{ $lossdetail->loss_date->format('g:i A')  }} on the {{ $lossdetail->loss_date->format('l jS \\of F Y') }}. I acknowledge that such payment is made without admission of liability and that the sum is received by me in the full and final settlement of all claims arising from the said accident. </p>
                <br>
                <p style="font-size:18px">In consideratio of the said payment, I hereby Discharge both insured and insurer and/or their agents from the liability in respect of claims arising out of the above accident on my behalf and it shall indemnify both the insurers, the insured and/or their agents of any claims which are or which may hereafter be brought on my behalf by any person arising out of the said accident.</p>
        
              </div>
              
              <div>

              
          <p style="font-size:18px"> <strong> Signed by the said : </strong>................................................................... </p>
            <br>
          <p style="font-size:18px"> <strong> Claimant's Signature : </strong>................................................................... </p>
            <br>
            <p style="font-size:18px"> <strong> in the presence of : </strong>................................................................... </p>
            <br>
            <p style="font-size:18px"> <strong> Witness's Signature : </strong>................................................................... </p>
            

          

          <p style="font-size:18px"> I {{ Auth::user()->getNameOrUsername() }} of {{ $company->legal_name }} hereby certify that I have fully explained to the claimant the nature of this Discharge, and he/she appeared perfectly to understand the same, and that his/her signature above was executed by him/her in my presence.</p>  
         

            </div>
         
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop