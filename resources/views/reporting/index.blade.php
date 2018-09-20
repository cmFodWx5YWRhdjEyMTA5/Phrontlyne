@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Reports</li>
                
              </ul>
            
              <div class="row">

              

               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-info portlet-item">
                <header class="panel-heading">
                 Underwriting
                </header>
                <div class="list-group bg-white">
                  <a href="/policy-ending" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Client  Profitability Statistics
                  </a>
                  <a href="/policy-cancelled" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Coinsurance Bordereux
                  </a>
                  <a href="/policy-cancelled" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Coinsurance Premium by Source
                  </a>
                 
                  <a href="/policy-renewal" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Consolidated Premiums
                  </a>
                  <a href="/policy-active" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Commissions
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Download Premium Details
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Endorsment Checklist
                  </a>


                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Marine Policies
                  </a>
                  <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Inwards Business Analysis - Gross
                  </a>

                  <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Inwards Premium Register
                  </a>

                  <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Policies
                  </a>

                  <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Policies with Overriding Premiums
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Policy Ananlysis
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Policy Ananlysis by Occupation
                  </a>


                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Premium Comparision
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Premium Summary
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Productivity Statistics
                  </a>

                  <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Profitability by Accounting Year
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Renewal Notices
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Renewal Scrutiny List
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Renewals
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Risk Profiles
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Transactions by Account No.
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Type of Business Analysis
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Unearned Premium Reserves
                  </a>

                </div>
              </section>
              </div>






              
               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-success portlet-item">
                <header class="panel-heading">
                 Sales
                </header>
                <div class="list-group bg-white">
                  <a href="/sales-summary" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Sales summary report
                  </a>
                  <a href="/sales-main" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Sales report
                  </a>
                  <a href="/sales-commission" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Commission report
                  </a>
                  <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Commission Summary
                  </a>
                
                </div>
              </section>
              </div>


               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-success portlet-item">
                <header class="panel-heading">
                 Claims
                </header>
                <div class="list-group bg-white">
                  <a href="/sales-summary" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Analysis - Gross to Net
                  </a>
                  <a href="/sales-main" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Anaylsis By Occupation
                  </a>
                  <a href="/sales-commission" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims By Source
                  </a>
                  <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Gross Reserve
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims GST
                  </a>


                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Management Statistics
                  </a>


                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Paid & Loss Reserve
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Paid & Refund Summary
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Paid Monthly Analysis
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Payment & Recoveries
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Recoveries Summary
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Register
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims RI Advices
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims RI Bordereaux
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims RI Recoveries Bordereaux
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Claims Third Party Recoveries
                  </a>

                  <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>CO / RI Claims Outstanding Reserve
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Claims with FAC XOL
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Claims with Zero Reserves
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Unreleased Claims Payments
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Released Claims Payments
                  </a>


                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Premium & Claims Statistics
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Outstanding Reserves of Open Claims
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Outstanding Reserves by Class
                  </a>


                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Outstanding Reserves and Payments
                  </a>


                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Outstanding Claims RI Bordereaux 
                  </a>

                   <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i>Outward Claims Summary by Region
                  </a>

                
                </div>
              </section>
              </div>

              <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-danger portlet-item">
                <header class="panel-heading">
                 Customer billing
                </header>
                <div class="list-group bg-white">
                  <a href="/paid-invoices" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Payments report
                  </a>
                  <a href="/unpaid-invoices" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Unpaid invoices
                  </a>
                 
                  <a href="/invoices-generated" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Generated invoices
                  </a>
                  
                  <a href="/receivables-summary" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Receivables: summary
                  </a>
                  <a href="/receivables-details" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Receivables: detailed report
                  </a>
                
                </div>
              </section>
              </div>
    
              </div>
              

              <div class="row">

               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 Quotes
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Quotes overview
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Detailed quotes list
                  </a>
                </div>
              </section>
              </div>


              <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-danger portlet-item">
                <header class="panel-heading">
                 
                Insurer reporting
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Accrued installments report to insurer
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Installments unbound to insurer reporting
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Installments accrued, but unpaid to insurer
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Unpaid installments connected to insurer reports
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Installments unpaid to insurer
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Insurer balance report
                  </a>
                  
                
                </div>
              </section>
              </div>


              <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 
               Customers
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Customers
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Customer balance report
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Customer TOP
                  </a>  
                </div>
              </section>
              </div>



               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 
               Reinsurance
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Facultative XOL Cessions
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Monthly Requistion CEssions
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> 
                  </a>  
                </div>
              </section>
              </div>
               
               

              </div>
     
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop