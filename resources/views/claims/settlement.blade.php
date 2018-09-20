@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Settlement Letter</p>
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
                    <p class="h4"># {{ $claim->claim_id }}</p>
                    <h5>{{ date('Y-m-d') }}</h5> 
                    <br>
                    <br>
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$claim->name', 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>    
              <div>
                <h3 align="center"> <strong> SETTLEMENT LETTER </strong> </h3>
                <p style="font-size:18px">
                We are pleased to inform you that on the basis of the submission of papers and also the assessment of the loss, the claim has been sanctioned for the payment of {{ $claim->loss_approved }} as per the details given below. Please find attached the cheque being payment of this claim. </p>
                <br>
                <p style="font-size:18px">We keep on record our sincere gratitude to the cooperation extended to us during the entire process. You valued suggesstions are of utmost importance to us, as it will help us improve our services to our customers. Please enclosed to this document is a Customer feedback form. Kindly help us fill this.</p>

                <p> Thank you</p>
                <p> Your faithfully</p>

        
              </div>
              
              <div>
          

          <p style="font-size:18px"> For Total Loss/ Total Loss Net of Salvage, the policy will have to be surrendered for cancellation and no refund of Premium will be made.</p>  
         

            </div>
         
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop