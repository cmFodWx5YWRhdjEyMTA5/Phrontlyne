  @role(['Broker','System Admin','Underwriting Officer','Underwriting Manager','Reinsurance Officer','Reinsurance Manager','Claims Officer','Claims Manager','Manager'])
 <aside class="bg-dark lter aside-md hidden-print" id="nav">          
          <section class="vbox">
           <header class="header lter text-center clearfix" style="background-color: #f0ad4e">
              {{-- <div class="btn-group">
                <button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i class="fa fa-plus"></i></button>
                <div class="btn-group hidden-nav-xs">
                  <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-toggle="dropdown">
                    Add
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu text-left">
                    <li><a href="/online-policies/new">New Policy</a></li>
                    <li><a href="/online-quotation/new">New Quote</a></li>
                    <li><a href="/active-customer">New Customer</a></li>
                    <li><a href="/active-customer">New Claim</a></li>
                  </ul>
                </div>
              </div> --}}
            </header>
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="{{ route('dashboard') }}"   class="active">
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>BI & Dashboard</span>
                      </a>
                    </li>
                    
                    <li >
                      <a href="#layout"  >
                        <i class="fa fa-user icon">
                           <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Account Creation</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="/active-customer" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Manage Account</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>
                    @role(['Broker','System Admin','Underwriting Officer','Underwriting Manager','Manager'])
                    {{-- <li >
                      <a href="/online-quotation/new"  >
                        
                        <i class="fa fa-umbrella icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Quote</span>
                      </a>
                    </li> --}}
                    

                
                    <li >
                      <a href="#layout"  >
                        <i class="fa fa-gavel icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Underwriting</span>
                      </a>
                      <ul class="nav lt">
                       
                         <li >
                          <a href="/active-customer" >  
                          <b class="badge bg-gavel pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Create New Policy</span>
                          </a>
                        </li>

                        
                         <li >
                          <a href="/online-policies" >  
                          <b class="badge bg-gavel pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>View Policies</span>
                          </a>
                        </li>

                        <li >
                          <a href="/query-policies" >  
                          <b class="badge bg-gavel pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Query Policies</span>
                          </a>
                        </li>


                        <li >
                          <a href="/expired-policies" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Renewals</span>
                          </a>
                        </li>

                        <li>
                          <a href="/endorsement-policies" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Endorsements</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    @endrole
                      @role(['Broker','System Admin','Manager','Claims Officer','Claims Manager'])
                    <li >
                      <a href="/claims"  >
                        
                        <i class="fa fa-wheelchair icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Claims</span>
                      </a>
                    </li>
                    @endrole
                      @role(['Broker','System Admin','Manager','Reinsurance Officer','Reinsurance Manager'])
                    <li >
                      <a href="/reinsurance-businesses"  >
                        
                        <i class="fa  fa-code-fork icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Reinsurance</span>
                      </a>
                    </li>
                     <li >
                      <a href="#"  >
                        
                        <i class="fa fa-cogs icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Risk Management</span>
                      </a>
                    </li>
                    <li >
                      <a href="#"  >
                        
                        <i class="fa fa-gift icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Sale & Marketing</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Broker','System Admin'])
                    <li >
                      <a href="/event-calendar"  >
                        
                        <i class="fa fa-calendar icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Calendar</span>
                      </a>
                    </li>
                    @endrole
                       @role(['Broker','System Admin','Manager'])
                        <li >
                      <a href="#pages"  >
                        <i class="fa fa-file-text icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Receipting</span>
                      </a>
                      <ul class="nav lt">
                        
                        <li >
                          <a href="/invoice" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Invoices</span>
                          </a>
                        </li>

                        <li >
                          <a href="/quick-invoices" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Generate Invoices</span>
                          </a>
                        </li>
                       
                        <li >
                          <a href="/payments" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Payments</span>
                          </a>
                        </li>

                        <li >
                          <a href="/debt-management" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Debt Management</span>
                          </a>
                        </li>
                          
                        <li >
                          <a href="/banking.banks" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Banking</span>
                          </a>
                        </li>

                        <li >
                          <a href="/sticker-returns" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Sticker Returns</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>
                    @endrole
                       @role(['Broker','System Admin'])
                    <li >
                      <a href="/commission"  >
                        
                        <i class="fa fa-sort-numeric-asc icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Commissions</span>
                      </a>
                    </li>
                     <li >
                      <a href="/agent-list-all"  >
                        
                        <i class="fa fa-sort-numeric-asc icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Agency</span>
                      </a>
                    </li>
                    @endrole
                       @role(['Broker','System Admin'])
                    <li >
                      <a href="#pages"  >
                        <i class="fa fa-money icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Accounting</span>
                      </a>
                      <ul class="nav lt">
                        
                        <li >
                          <a href="/company-assets" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Assets</span>
                          </a>
                        </li>

                        <li >
                          <a href="/account-transactions" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Transactions</span>
                          </a>
                        </li>
                        <li >
                          <a href="/account-reports" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Reports</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    @endrole
                       
                     <li >
                      <a href="#pages"  >
                        <i class="fa fa-file-text icon">
                           <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Reports</span>
                      </a>
                      <ul class="nav lt">
                        
                        <li >
                          <a href="/report-stats" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Overview & Statistics</span>
                          </a>
                        </li>

                        <li >
                          <a href="/report-list" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Reports</span>
                          </a>
                        </li>

                        <li >
                          <a href="/financial-reports" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Sales Performance Tracking</span>
                          </a>
                        </li>

                       
                      </ul>
                    </li>
                    @role('System Admin')
                  <li >
                      <a href="#pages"  >
                        <i class="fa fa-wrench icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Product Builder</span>
                      </a>
                      <ul class="nav lt">
                      
                         <li >
                          <a href="/reporting" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Communication</span>
                          </a>
                        </li>
                        <li >
                          <a href="/branch-list" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Branches</span>
                          </a>
                        </li>
                        <li >
                          <a href="/manage-users" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>User Management</span>
                          </a>
                        </li>

                         <li >
                          <a href="/setup" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Policy Management</span>
                          </a>
                        </li>


                       
                      </ul>
                    </li>
                    @endrole
                    <li >
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer lt hidden-xs b-t b-dark">
              <div id="chat" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">Active chats</header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No active chats.</p>
                      <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <div id="invite" class="dropup">                
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      {{ Auth::user()->getNameOrUsername() }} <i class="fa fa-circle text-success"></i>
                    </header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No contacts in your lists.</p>
                      <p><a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              <div class="btn-group hidden-nav-xs">
                <button type="button" title="Chats" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#chat"><i class="fa fa-comment-o"></i></button>
                <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#invite"><i class="fa fa-facebook"></i></button>
              </div>
            </footer>
          </section>
        </aside>
@endrole  