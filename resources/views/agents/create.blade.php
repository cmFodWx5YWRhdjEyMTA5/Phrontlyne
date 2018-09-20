                    <section class="panel panel-default">
                      <div class="panel-body">

                       
                     <div class="clearfix m-b">

                          <a href="#" class="thumb-lg">
                            <img src="images/avatar_default.jpg" id="imagePreview"  class="img-circle">

                             <input type="file" height="40px" name="image" id="image" enctype="multipart/form-data">
                          </a>
                                
                        </div>
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Intermediary Number</label> 
                            <div class="form-group{{ $errors->has('account_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="account_number" readonly="true" name="account_number" value="{{ Request::old('account_number') ?: '' }}">   
                           @if ($errors->has('account_number'))
                          <span class="help-block">{{ $errors->first('account_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('account_type') ? ' has-error' : ''}}">
                            <label>Intermediary Type</label>
                            <select id="account_type" name="account_type" required="" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- Select an account --</option>
                          @foreach($accounttypes as $accounttype)
                        <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('account_type'))
                          <span class="help-block">{{ $errors->first('account_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                      


                        <div class="form-group">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}} {!! $errors->has('first_name') ? 'has-error' : '' !!}">
                          <label>Intermediary Name </label>
                          <input type="text" class="form-control" id="fullname" value="{{ Request::old('fullname') ?: '' }}" name="fullname" data-parsley-trigger="change" required="">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                       <div class="form-group @if($errors->has('license_date')) has-error @endif">
                        <label for="license_date">Date of Birth</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Select your time" value="{{ old('date_of_birth') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('license_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('license_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>


                        
                       <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                       <div class="form-group @if($errors->has('license_date')) has-error @endif">
                        <label for="license_date">License Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="license_date" id="license_date" placeholder="Select your time" value="{{ old('license_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('license_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('license_date') }}
                       </p>
                        @endif
                      </div>
                      </div>

                        <div class="col-sm-6">
                       <div class="form-group @if($errors->has('appointment_date')) has-error @endif">
                        <label for="appointment_date">Appointment Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="appointment_date" id="appointment_date" placeholder="Select your time" value="{{ old('appointment_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('appointment_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('appointment_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                    </div>


                      <div class="form-group pull-in clearfix">
                         <div class="col-sm-6">
                          <label>License Number</label>
                          <div class="form-group{{ $errors->has('license_number') ? ' has-error' : ''}}">
                          <input type="text" class="form-control" maxlength="20" required="" id="license_number" name="license_number" value="{{ Request::old('license_number') ?: '' }}">   
                          @if ($errors->has('license_number'))
                          <span class="help-block">{{ $errors->first('license_number') }}</span>
                           @endif                           
                        </div>
                        </div>
                        </div>


                          <div class="form-group">
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : ''}}">
                          <label>Gender</label>
                           <select id="gender" name="gender" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                           <option value=""></option>
                          @foreach($gender as $gender)
                        <option value="{{ $gender->type }}">{{ $gender->type }}</option>
                          @endforeach
                        </select>                         
                          @if ($errors->has('gender'))
                          <span class="help-block">{{ $errors->first('gender') }}</span>
                           @endif           
                        </div>
                        </div>


                         

                        
                        
                        <div class="form-group pull-in clearfix">
                         <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" value="{{ Request::old('email') ?: '' }}" data-parsley-trigger="change" required=""> 
                          @if ($errors->has('email'))
                          <span class="help-block">{{ $errors->first('email') }}</span>
                           @endif                            
                        </div>
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                         <div class="col-sm-6">
                          <label>Mobile Number</label>
                          <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : ''}}">
                          <input type="number" class="form-control" maxlength="10" required="" id="mobile_number" name="mobile_number" value="{{ Request::old('mobile_number') ?: '' }}">   
                          @if ($errors->has('mobile_number'))
                          <span class="help-block">{{ $errors->first('mobile_number') }}</span>
                           @endif                           
                        </div>
                        </div>
                        </div>

                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Residential Address</label> 
                            <div class="form-group{{ $errors->has('residential_address') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="residential_address" name="residential_address" value="{{ Request::old('residential_address') ?: '' }}"></textarea>   
                           @if ($errors->has('residential_address'))
                          <span class="help-block">{{ $errors->first('residential_address') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('postal_address') ? ' has-error' : ''}}">
                            <label>Postal Address</label>
                            <textarea type="text" rows="3" required="" class="form-control" id="postal_address" name="postal_address" value="{{ Request::old('postal_address') ?: '' }}"></textarea>     
                           @if ($errors->has('postal_address'))
                          <span class="help-block">{{ $errors->first('postal_address') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                     
                         
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('account_manager') ? ' has-error' : ''}}"> 
                            <label>Account Manager</label>
                            <select id="account_manager" name="account_manager" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="{{  Auth::user()->getNameOrUsername() }}">{{  Auth::user()->getNameOrUsername() }}</option>
                         @foreach($users as $user)
                        <option value="{{ $user->fullname }}">{{ $user->fullname }}</option>
                          @endforeach
                        </select>    
                          @if ($errors->has('account_manager'))
                          <span class="help-block">{{ $errors->first('account_manager') }}</span>
                           @endif      
                            </div>
                          </div>
                          <div class="col-sm-6">
                           <div class="form-group{{ $errors->has('sales_channel') ? ' has-error' : ''}}"> 
                            <label>Sale Channel</label>
                             <select id="sales_channel" name="sales_channel" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                             <option value="">-- Not set --</option>
                          @foreach($sale_channels as $sale_channel)
                        <option value="{{ $sale_channel->channel }}">{{ $sale_channel->channel }}</option>
                          @endforeach 
                        </select>    
                            @if ($errors->has('sales_channel'))
                          <span class="help-block">{{ $errors->first('sales_channel') }}</span>
                           @endif             
                          </div>   
                        </div>
                        </div>


                        
                        </div>

                     

                  
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save Record</button>
                      </footer>
                    </section>