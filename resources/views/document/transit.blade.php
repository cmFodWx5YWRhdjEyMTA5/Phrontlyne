@extends('layouts.default')
@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>CERTIFICATE OF INSURANCE</p>
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
                  
                     
                  </div>
                  <div class="col-xs-6 text-right">
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($policy->policy_number, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>  

               <div class="line"></div>
						<h4 align="center"> <strong> CUSTOMS DIVISION OF GHANA REVENUE AUTHORITY (GRA)
GENERAL TRANSIT BOND </strong>
</h4>
               <div class="line"></div>
               <br>
             <p> <strong> THIS BOND </strong> is made between <strong> PHOENIX INSURANCE CO. (GH) LTD. P.O. BOX 17753, Accra </strong> (hereinafter called the <strong> “GUARANTOR” </strong> which expression shall include her successors and Assigns) and <strong> {{ $policy->fullname }} </strong> of <strong> {{ $customers->postal_address }} </strong> (hereinafter called <strong> THE TRANSITOR” </strong> which expression shall include her successors and Assigns) in favour of the <strong> CUSTOMS DIVISION OF GHANA REVENUE AUTHORITY (GRA)</strong>, a Statutory Revenue Agency of State, whose Headquarters is situated on 28th February Road Victoriaborg (Ministries) Accra. </p> <br>


<p> WHEREAS THE Commissioner of CUSTOMS DIVISION OF GHANA REVENUE AUTHORITY (GRA) has given permission to the Transitor to Transit dutiable goods namely CONTRACT from Ghana to ................ through Ghana from time to time along routes determined by the Commissioner of CUSTOMS DIVISION OF GHANA REVENUE AUTHORITY (GRA) for the period <strong> {{  Carbon\Carbon::parse($policy->insurance_period_from)->format('l jS \\of F Y') }} </strong> to <strong> {{ Carbon\Carbon::parse($policy->insurance_period_to)->format('l jS \\of F Y') }} </strong>. </p> <br>


<p> AND WHEREAS the Commissioner of CUSTOMS DIVISION OF GHANA REVENUE AUTHORITY (GRA)  has directed that the Transitor shall give security in the sum of <strong> {{ $suminsured }} ({{ ucwords(strtoupper($amountinwords))}}) </strong> in respect of the said goods and has hereby approved the guarantor as surety for the Transitor and as the Principal debtor of the Commissioner under Section 318 of PNDC Law 330. </p> <br>

                                                       
<strong> NOW THIS BOND WITNESSETH AS FOLLOWS: </strong>

<p> 
<ol>
<li> That the said goods and every part thereof shall be duly Transited or conveyed through <strong> GHANA </strong> along routes determined and on vehicles registered for the purpose for the period <strong> {{  Carbon\Carbon::parse($policy->insurance_period_from)->format('l jS \\of F Y') }} </strong> to <strong> {{ Carbon\Carbon::parse($policy->insurance_period_to)->format('l jS \\of F Y') }} </strong> without any diversion whatsoever.</li>

 

<li> That the Guarantor hereby guarantees that the whole consignment of the said goods herein described shall be delivered to the importer/shipper/owner at his destination in whole without any alteration or diminution in quantity or quality. </li>

 
<li> That the Guarantor hereby irrevocably and unconditionally guarantees for and on behalf of the Transitor to pay in full all revenue lost to the State including penalties and interest where payable arising from the diversion of the said goods by the Transitor, his servants, agents or escorts whether in whole or in part without cavil or argument. </li>

 
<li> That the liability of the Guarantor as specified in this Bond shall in the event of diversion be limited to the face value of the bond and that the Guarantor’s liability shall under no circumstances exceed One Hundred [percent (100%) of the amount guaranteed. </li>

 

<li> The commissioner shall notify the Guarantor of any diversion of the said goods which may lead to a claim under this bond within 180 days after the expiry of this bond. </li>

 

<li> Any claim by the Commissioner under this bond shall be without prejudice to the Guarantor’s right to institute legal action, whether Civil or Criminal, against any person or persons implicated in the diversion of the same goods or for any other malfeasance. </li>

 

<li>  It shall be mandatory for the Transitor to take an insurance policy to cover the goods in transit from one destination to the other for the security of the said goods and all revenue therein. </li>


 

<li> The Guarantor's obligation under this bond is for the payment of revenue loss to the state caused by the Transitor’s omission, commission, negligence or breach of law resulting from any diversion, theft accidental loss including fire and allied peril. </li>


<li> The failure of the Guarantor to honour the terms of this Bond by paying all revenue lost in full aforesaid, the commissioner shall consider the revenue lost as a tax debt with penalty and or interest and shall proceed to recover same under section 279 of PNDC Law by attaching any property of the Guarantor and further debar the Transitor and his agents from transacting any business with the CUSTOMS DIVISION OF GHANA REVENUE AUTHORITY (GRA) </li>


<li>  This bond shall be construed and read together with all other documents processed in connection with the transit goods. </li>
</ol>
</p>

<br>
<br>
<p> SIGNED, SEALED and DELIVERED </p>

               <br>
				<br>
               <p> For and behalf of {{ $company->legal_name }}</p>
               <br>
               <br>
           <p>  In the presence of :- </p>
<br>
               <br>

<p>SIGNED, SEALED and DELIVERED</p>						
 <br>
               <br>
<p> For and on behalf of </p>		
<strong> {{ strtoupper($policy->fullname) }}	</strong>							
<br>
               <br>	 							
<p> In the presence of:	</p>		
<br>
<br>

<p> Approved By:.........................................................................................	</p>	


                  </section>
                  
                  </section>

             
@stop




