@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Workset</li>
                 @include('includes.alert')
                 
              </ul>
            
              <div class="row">
                <div class="col-md-8">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Company Overview</header>
                    <div class="panel-body">
                      <div id="flot-1ine" style="height:210px"></div>
                    </div>
                    <footer class="panel-footer bg-white no-padder">
                      <div class="row text-center no-gutter">
                        <div class="col-xs-3 b-r b-light">
                          <span class="h4 font-bold m-t block"></span>
                          <small class="text-muted m-b block">Invoices</small>
                        </div>
                        <div class="col-xs-3 b-r b-light">
                          <span class="h4 font-bold m-t block"></span>
                          <small class="text-muted m-b block">Receipts</small>
                        </div>
                        <div class="col-xs-3 b-r b-light">
                          <span class="h4 font-bold m-t block">21,230</span>
                          <small class="text-muted m-b block">Payments</small>
                        </div>
                        <div class="col-xs-3">
                          <span class="h4 font-bold m-t block">7,230</span>
                          <small class="text-muted m-b block">Transfers</small>                        
                        </div>
                      </div>
                    </footer>
                  </section>
                </div>
                <div class="col-md-4">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Bank Balances- Current Account</header>
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
                        <span class="h3 block">GHS2500.00</span>
                      </div>
                      <div class="line pull-in"></div>
                      <div class="row m-t-sm">
                        <div class="col-xs-4">
                          <small class="text-muted block">Market</small>
                          <span>GHS1500.00</span>
                        </div>
                        <div class="col-xs-4">
                          <small class="text-muted block">Referal</small>
                          <span>GHS600.00</span>
                        </div>
                        <div class="col-xs-4">
                          <small class="text-muted block">Affiliate</small>
                          <span>GHS400.00</span>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>

              <div class="row">

              <div class="col-lg-4">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Sales and Income</header>
                    <div class="panel-body text-center">              
                      <div class="sparkline inline" data-type="pie" data-height="150" data-slice-colors="['#99c7ce','#f2f2f2']">60,40</div>
                      <div class="line pull-in"></div>
                      <div class="text-xs">
                        <i class="fa fa-circle text-info"></i> 60%
                        <i class="fa fa-circle text-muted"></i> 40%
                      </div>
                    </div>
                  </section>
                </div>

               <div class="col-lg-4">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Debtors</header>
                    <div class="panel-body text-center">
                      <div class="sparkline inline" data-type="bar" data-height="160" data-bar-width="12" data-bar-spacing="10" data-stacked-bar-color="['#afcf6f', '#eee']">5:5,8:4,12:5,10:6,11:7,12:2,8:6,9:3,5:5,4:9</div>
                      <ul class="list-inline text-muted axis"><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li><li>10</li></ul>
                    </div>
                  </section>
                </div>

                
                <div class="col-lg-4">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Expenses and Cost</header>
                    <div class="panel-body">
                      <div id="flot-pie-donut"  style="height:240px"></div>
                    </div>
                  </section>
                </div>
              </div>

               

              </div>
     {{--  <a><i class="fa fa-long-arrow-up"><iframe src="http://www.bloomberg.com/markets/components/data-drawer" width="1700" height="100px" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0">
         </iframe></i></a> --}}
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

<script type="text/javascript">
         function getSummarycount()
   {
      
        $.get('/business.summary',
          {
             "": $("#").text()
          },
          function(data)
          { 

         
                               
          },'json');
      
   }

   </script>