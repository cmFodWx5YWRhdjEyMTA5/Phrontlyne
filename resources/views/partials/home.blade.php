<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Workset </li>   
              </ul>
              <div class="m-b-md">
                <h3 class="m-b-none"> Workset </h3>
                 @if(Auth::check())
                <small>Welcome back,  {{ Auth::user()->getNameOrUsername() }}</small>
                 @endif
              </div>
              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">

                   <img src="/images/179670.svg" width="15%" class="pull-left">
                    <a class="clear" href="/active-customer">
                      <span class="h3 block m-t-xs"><strong>{{ $customercount }}</strong></span>
                      <small class="text-muted text-uc">Customers</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                   <img src="/images/189087.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/online-policies">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{ $processedpolicies }}</strong></span>
                      <small class="text-muted text-uc">Policies</small>
                    </a>
                  </div>


                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
                    <img src="/images/230312.svg" width="15%" class="pull-left">
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="firers">0</strong></span>
                      <small class="text-muted text-uc">Today's task</small>
                    </a>
                  </div>
                  
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/189096.svg" width="15%" class="pull-left">
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong>{{ Carbon\Carbon::now() }}</strong></span>
                      <small class="text-muted text-uc">Left to exit</small>
                    </a>
                  </div>
                </div>
              </section>

              <div class="row">
                <div class="col-md-8">
                 <section class="panel panel-default">
                    <header class="panel-heading">
                      Debits/Invoices within 90 days trend
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/cobbills') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="/visits-by-type" > % of visits</a></small></div>
                  </section>
                </div>
                <div class="col-md-4">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Document(s) Pending for Approval</header>
                    <div class="bg-light dk wrapper">
                      <span class="pull-right">Friday</span>
                      <span class="h4">GHS540<br>
                        <small class="text-muted">+1.05(2.15%)</small>
                      </span>
                      <div class="text-center m-b-n m-t-sm">
                          <div class="sparkline" data-type="line" data-height="65" data-width="100%" data-line-width="2" data-line-color="#dddddd" data-spot-color="#bbbbbb" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="3" data-resize="true" values="280,320,220,385,450,320,345,250,250,250,400,380"></div>
                          <div class="sparkline inline" data-type="bar" data-height="45" data-bar-width="6" data-bar-spacing="6" data-bar-color="#65bd77">10,9,11,10,11,10,12,10,9,10,11,9,8</div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div>
                        <span class="text-muted">Total:</span>
                        <span class="h3 block">GHS{{0 }}</span>
                      </div>
                      <div class="line pull-in"></div>
                      <div class="row m-t-sm">
                        <div class="col-xs-4">
                          <small class="text-muted block"> Invoices Generated</small>
                          <span>GHS{{0 }}</span>
                        </div>
                        <div class="col-xs-4">
                          <small class="text-muted block">Paid</small>
                          <span>GHS{{ 0 }}</span>
                        </div>
                        <div class="col-xs-4">
                          <small class="text-muted block">Outstanding</small>
                          <span>GHS{{ 0 }}</span>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
              <div class="row">
               <div class="col-md-8">
                <section class="panel panel-default">
                    <header class="panel-heading">
                      Debits/Invoices within 90 days trend
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/branchbills') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="/visits-by-type" > % of visits</a></small></div>
                  </section>           
                </div>

                
              <div class="col-md-4">
                <section class="panel b-light">
                    <header class="panel-heading bg-dark dker no-border"><strong>Account Type</strong></header>
                    <div class="inline">
                          @include('charts/customertype') 
                      </div>    
                  </section> 
            

              <section class="panel b-light">
                    <header class="panel-heading bg-warning dker no-border"><strong>Sales Goals</strong></header>
                    <div id="calendar" class="bg-primary m-l-n-xxs m-r-n-xxs"></div>
                    <div class="list-group">
         {{--              @foreach( $customers as $account )
                      <a href="/customer-profile/{{ $account->id }}" class="list-group-item text-ellipsis">
                        <span class="badge bg-default">{{ $account->created_at }}</span> 
                        <span class="pull-left thumb-sm">
                        <img src="/images/{{ $account->image }}" class="img-circle"> {{ $account->fullname }} - {{ $account->account_number }}  </span> 
                        
                      </a>
                      @endforeach  --}}
                    </div>
                  </section> 
            
                  

                     <section class="panel b-light">
                    <header class="panel-heading bg-dark dker no-border"><strong>Upcoming Birthdays</strong></header>
                    <div id="calendar" class="bg-primary m-l-n-xxs m-r-n-xxs"></div>
                    <div class="list-group">
{{--                      @foreach( $birthdays as $birthday )
                      <a href="/customer-profile/{{ $birthday->id }}" class="list-group-item text-ellipsis">
                        <span class="badge bg-default">{{ $birthday->date_of_birth }}</span> 
                        <span class="pull-left thumb-sm">
                        <img src="/images/{{ $birthday->image }}" class="img-circle"> {{ $birthday->fullname }} - {{ $birthday->date_of_birth->age }} years old </span> 
                        
                      </a>
                      @endforeach --}}
                    </div>
                  </section> 
            
                  </div>
                    {{--  <section class="panel panel-default">
                    <header class="panel-heading">                    
                      <span class="label bg-dark">15</span> Inbox
                    </header>

                     <section class="panel-body slim-scroll" data-height="230px">
                     @foreach( $patients as $patient )
                      <article class="media">
                        <span class="pull-left thumb-sm"><img src="/images/{{ $patient->image }}" class="img-circle"></span>
                        <div class="media-body">
                          <div class="pull-right media-xs text-center text-muted">
                            <strong class="h4">{{ $patient->created_at }}</strong><br>
                            
                          </div>
                          <a href="#" class="h4">{{ $patient->fullname }}</a>
                          <small class="block"><a href="#" class=""></a></small>
                         
                        </div>
                      </article>
                      
                        <div class="line pull-in"></div>
                         @endforeach 
                      </section>
                      </section>
 --}}
                </div>

              </div>
     {{--  <a><i class="fa fa-long-arrow-up"><iframe src="http://www.bloomberg.com/markets/components/data-drawer" width="1700" height="100px" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0">
         </iframe></i></a> --}}
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

