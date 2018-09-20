@extends('layouts.default')
@section('content')
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Account Creation</li>
              </ul>



        <div class="row">
                <div class="col-sm-6">
                  <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">

                        <li class="active"><a href="#individual" data-toggle="tab">Individual Account</a></li>
                        <li class=""><a href="#joint" data-toggle="tab">Joint Account</a></li>
                        <li class=""><a href="#trust" data-toggle="tab">Trust Account</a></li>
                        <li class=""><a href="#corporate" data-toggle="tab">Corporate Account</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  method="post" action="/customer" class="panel-body wrapper-lg">
                    <section class="panel panel-default">
                      <header class="panel-heading">
                        
                      </header>
                      <div class="panel-body">
                        <p class="text-muted">Personal Details</p>
                        <div class="clearfix m-b">
                          <a href="#" class="pull-left thumb m-r">
                            <img src="images/avatar.jpg" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">John.Smith</div>
                            <small class="text-muted"><i class="fa fa-map-marker"></i> London, UK</small>
                          </div>                
                        </div>

                   


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Account Number</label> 
                            <div class="form-group{{ $errors->has('accountnumber') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="accountnumber" name="accountnumber" value="{{ Request::old('accountnumber') ?: '' }}">   
                           @if ($errors->has('accountnumber'))
                          <span class="help-block">{{ $errors->first('accountnumber') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('postaladdress') ? ' has-error' : ''}}">
                            <label>Account Type</label>
                            <input type="text" rows="3" class="form-control" id="accounttype" name="accounttype" value="{{ Request::old('accounttype') ?: '' }}">      
                           @if ($errors->has('accounttype'))
                          <span class="help-block">{{ $errors->first('accounttype') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>



                        <div class="form-group">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Full name</label>
                          <input type="text" class="form-control" id="fullname" value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>

                        <div class="form-group">
                        <div class="form-group{{ $errors->has('dateofbirth') ? ' has-error' : ''}}">
                          <label>Date of Birth</label>
                          <input type="text" class="input-sm input-s datepicker-input form-control" value="{{ Request::old('dateofbirth') ?: '' }}"   id="dateofbirth" name="dateofbirth">                        
                          @if ($errors->has('dateofbirth'))
                          <span class="help-block">{{ $errors->first('dateofbirth') }}</span>
                           @endif           
                        </div>

                         <div class="form-group">
                         <div class="form-group{{ $errors->has('occupation') ? ' has-error' : ''}}">
                          <label>Occupation</label>
                          <input type="text" class="form-control" id="occupation" name="occupation" value="{{ Request::old('occupation') ?: '' }}"> 
                          @if ($errors->has('occupation'))
                          <span class="help-block">{{ $errors->first('occupation') }}</span>
                           @endif                                  
                        </div>

                        <div class="form-group">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                          <label>Email</label>
                          <input type="text" class="form-control" id="email" name="email" value="{{ Request::old('email') ?: '' }}"> 
                          @if ($errors->has('email'))
                          <span class="help-block">{{ $errors->first('email') }}</span>
                           @endif                            
                        </div>

                        <div class="form-group">
                          <label>Mobile Number</label>
                          <div class="form-group{{ $errors->has('mobilenumber') ? ' has-error' : ''}}">
                          <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" value="{{ Request::old('mobilenumber') ?: '' }}">   
                          @if ($errors->has('mobilenumber'))
                          <span class="help-block">{{ $errors->first('mobilenumber') }}</span>
                           @endif                           
                        </div>

                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Residential Address</label> 
                            <div class="form-group{{ $errors->has('residentialaddress') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="residentialaddress" name="residentialaddress" value="{{ Request::old('residentialadress') ?: '' }}">   
                           @if ($errors->has('residentialaddress'))
                          <span class="help-block">{{ $errors->first('residentialaddress') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('postaladdress') ? ' has-error' : ''}}">
                            <label>Postal Address</label>
                            <input type="text" rows="3" class="form-control" id="postaladdress" name="postaladdress" value="{{ Request::old('postaladdress') ?: '' }}">      
                           @if ($errors->has('postaladdress'))
                          <span class="help-block">{{ $errors->first('postaladdress') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                     
                         
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Identification Type</label>
                            <input type="text" rows="3" class="form-control" id="idcardtype" name="idcardtype" value="{{ Request::old('idcardtype') ?: '' }}">   
                          </div>
                          <div class="col-sm-6">
                            <label>ID Number</label>
                            <div class="form-group{{ $errors->has('idcardnumber') ? ' has-error' : ''}}"> 
                            <input type="text" rows="3" class="form-control" id="idcardnumber" name="idcardnumber" value="{{ Request::old('idcardnumber') ?: '' }}"> 
                            @if ($errors->has('idcardnumber'))
                          <span class="help-block">{{ $errors->first('idcardnumber') }}</span>
                           @endif             
                          </div>   
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Bank Name</label> 
                            <input type="text" rows="3" class="form-control" id="bankname" name="bankname" value="{{ Request::old('bankname') ?: '' }}">   
                          </div>
                          <div class="col-sm-6">
                            <label>Bank Account Number</label>
                            <input type="text" rows="3" class="form-control" id="bankaccountnumber" name="bankaccountnumber" value="{{ Request::old('bankaccountnumber') ?: '' }}">      
                          </div>   
                        </div>
                        </div>
                        </div>

                      

                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="check" checked > I agree to the <a href="#" class="text-info">Terms of Service</a>
                          </label>
                        </div>
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Create New</button>
                      </footer>
                    </section>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                  </form>
                        </div>
                        <div class="tab-pane" id="joint">
                                     
                        </div>


                        <div class="tab-pane" id="trust">
                  
                 
                        </div>

                        <div class="tab-pane" id="corporate">
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                
              </div>
              </div>
          </section>


    </section> 
  </section> 

          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>

@stop


