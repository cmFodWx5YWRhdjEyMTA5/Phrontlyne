@extends('layouts.default')
@section('content')

        <section id="content">
          <section class="hbox stretch">
              <section class="panel panel-default">
                    <header class="panel-heading text-right bg-light">
                      <ul class="nav nav-tabs pull-left">
      <li class="active"><a href="#Model-2" data-toggle="tab"><i class="fa  fa-flash text-default"></i> Vehicle Model</a></li>
      <li><a href="#Make-2" data-toggle="tab"><i class="fa  fa-inbox text-default"></i> Vehicle Make</a></li>
      <li><a href="#Currency-2" data-toggle="tab"><i class="fa fa-money text-default"></i> Currency</a></li>
      <li><a href="#Property-2" data-toggle="tab"><i class="fa fa-tasks text-default"></i> Property Type</a></li>
      <li><a href="#Mortgage-2" data-toggle="tab"><i class="fa fa-sitemap text-default"></i> Mortgage Company</a></li>
      <li><a href="#Insurer-2" data-toggle="tab"><i class="fa fa-suitcase text-default"></i> Insurer</a></li>
      <li><a href="#Policy-2" data-toggle="tab"><i class="fa fa-shopping-cart text-default"></i> Policy Product</a></li>
      <li><a href="#beneficiary-2" data-toggle="tab"><i class="fa fa-users text-default"></i> Policy Product</a></li>
                      </ul>
                      <span class="hidden-sm">Left tab</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                        <div class="tab-pane fade" id="Model-2">
                        <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new vehicle make</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-make">
                                    <div class="form-group">
                                      <label>Enter vehicle make</label>
                                      <input type="text" id="vehicle_make_main" name="vehicle_make_main" class="form-control" placeholder="">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Make-2">
                              <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new vehicle model</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Enter vehicle make</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Enter vehicle model</label>
                                      <input id="vehicle_model" name="vehicle_model" type="text" class="form-control" placeholder="">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Currency-2">
                            <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new currency</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-currency">
                                    <div class="form-group">
                                      <label>Enter currency</label>
                                      <input type="text" id="currency" name="currency" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Property-2">
                          <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new property</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-property">
                                    <div class="form-group">
                                      <label>Add property type</label>
                                      <input type="text" id="propertytype" name="propertytype" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Mortgage-2">
                          <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new mortgage company</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-mortgage">
                                    <div class="form-group">
                                      <label>Add mortgage company</label>
                                      <input type="text" id="mortgage_compaany" name="mortgage_compaany" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Insurer-2">
                               <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new insurer</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-insurer">
                                    <div class="form-group">
                                      <label>Add isurer name</label>
                                      <input type="text" id="insurer" name="insurer" class="form-control" placeholder="">
                                    </div>
                                     <div class="form-group">
                                      <label>Group (General , Life , Health)</label>
                                      <input type="text" id="insurer_type" name="insurer_type" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Policy-2">
                           <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new policy product</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-policy-product">
                                    <div class="form-group">
                                      <label>Add policy name</label>
                                      <input type="text" id="policytype" name="policytype" class="form-control" placeholder="">
                                    </div>
                                     <div class="form-group">
                                      <label>Group (General , Life , Health)</label>
                                      <input type="text" id="policygroup" name="policygroup" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                         <div class="tab-pane fade" id="beneficiary-2">
                           <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new beneficiary</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-beneficiary">
                                    <div class="form-group">
                                      <label>Add beneficiary type</label>
                                      <input type="text" id="beneficiary_type" name="beneficiary_type" class="form-control" placeholder="">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                      </div>
                    </div>
                  </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


 



