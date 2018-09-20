                    <section class="panel panel-default">
                      <div class="panel-body">
                       
                     <div class="clearfix m-b">

                           <a href="#" class="thumb-lg">
                            <img src="" name="imagePreview" id="imagePreview"  class="img-circle">
                              <input type="file" height="40px" name="image" id="image" enctype="multipart/form-data">
                          </a>

                                
                        </div>
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Customer Number</label> 
                            <div class="form-group{{ $errors->has('account_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="account_number" readonly="true" name="account_number" value="{{ Request::old('account_number') ?: '' }}">   
                           @if ($errors->has('account_number'))
                          <span class="help-block">{{ $errors->first('account_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('account_type') ? ' has-error' : ''}}">
                            <label>Customer Type</label>
                            <select id="account_type" name="account_type" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- Select an account --</option>
                          @foreach($accounttype as $accounttype)
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
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Name </label>
                          <input type="text" class="form-control" id="fullname" data-required="true" value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>

                        <div class="form-group">
                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : ''}}">
                          <label>Date of Birth </label>
                          <input type="text" class="input-sm input-s datepicker-input form-control" value="{{ Request::old('dateofbirth') ?: '' }}"   id="date_of_birth" name="date_of_birth" placeholder="dd/mm/YYYY"> 
                                        
                          @if ($errors->has('date_of_birth'))
                          <span class="help-block">{{ $errors->first('date_of_birth') }}</span>
                           @endif           
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

                         

                        <div class="form-group">
                         <div class="form-group{{ $errors->has('field_of_activity') ? ' has-error' : ''}}">
                          <label>Occupation / Field of Activity</label>
                          <input type="text" class="form-control" id="field_of_activity" name="field_of_activity" value="{{ Request::old('field_of_activity') ?: '' }}"> 
                          @if ($errors->has('field_of_activity'))
                          <span class="help-block">{{ $errors->first('field_of_activity') }}</span>
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
                          <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : ''}}">
                          <input type="text" class="form-control" id="mobile_number" data-required="true" name="mobile_number" value="{{ Request::old('mobile_number') ?: '' }}">   
                          @if ($errors->has('mobile_number'))
                          <span class="help-block">{{ $errors->first('mobile_number') }}</span>
                           @endif                           
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
                            <textarea type="text" rows="3" class="form-control" data-required="true" id="postal_address" name="postal_address" value="{{ Request::old('postal_address') ?: '' }}"></textarea>     
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

                       <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                        
                        
                        <li><a href="#contactpersontab" data-toggle="tab"><i class="fa fa-users text-default"></i> Contact Person</a></li>
                        
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                        <div class="tab-pane" id="contactpersontab">
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Name</label> 
                            <input type="text" rows="3" class="form-control" id="bankname" name="bankname" value="{{ Request::old('bankname') ?: '' }}">   
                          </div>
                           <div class="col-sm-6">
                            <label>Relationship</label>
                            <input type="text" rows="3" class="form-control" id="bankaccountnumber" name="bankaccountnumber" value="{{ Request::old('bankaccountnumber') ?: '' }}">      
                          </div>   
                          <div class="col-sm-6">
                            <label>ID Type</label>
                            <input type="text" rows="3" class="form-control" id="bankaccountnumber" name="bankaccountnumber" value="{{ Request::old('bankaccountnumber') ?: '' }}">      
                          </div>   
                          <div class="col-sm-6">
                            <label>ID Number</label>
                            <input type="text" rows="3" class="form-control" id="bankaccountnumber" name="bankaccountnumber" value="{{ Request::old('bankaccountnumber') ?: '' }}">      
                          </div>   
                          <div class="col-sm-6">
                            <label>Contact Number</label>
                            <input type="text" rows="3" class="form-control" id="bankaccountnumber" name="bankaccountnumber" value="{{ Request::old('bankaccountnumber') ?: '' }}">      
                          </div>   
                          <div class="col-sm-6">
                            <label>Email</label>
                            <input type="text" rows="3" class="form-control" id="bankaccountnumber" name="bankaccountnumber" value="{{ Request::old('bankaccountnumber') ?: '' }}">      
                          </div>   
                         
                          <div class="col-sm-6">
                            <label>Address</label>
                            <input type="text" rows="3" class="form-control" id="bankaccountnumber" name="bankaccountnumber" value="{{ Request::old('bankaccountnumber') ?: '' }}">      
                          </div>   
                        </div>
                        </div>
                      </div>
                    </div>
                  </section>

                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="check" checked > I agree to the <a href="#" class="text-info">Terms of Service</a>
                          </label>
                        </div>
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save Record</button>
                      </footer>
                    </section>