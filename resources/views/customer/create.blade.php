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
                            <label>Account Type</label>
                            <select id="account_type" name="account_type" onchange="notbusiness()" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
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


                        <div id="individualname">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('firstname') ? ' has-error' : ''}}">
                            <label>First Name</label>
                           <input type="text" rows="3" class="form-control" data-required="true" id="firstname" name="firstname" value="{{ Request::old('firstname') ?: '' }}">          
                           @if ($errors->has('firstname'))
                          <span class="help-block">{{ $errors->first('firstname') }}</span>
                           @endif    
                          </div>
                           
                        </div>

                          <div class="col-sm-4">
                            <label>Surname</label> 
                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" data-required="true" id="surname" name="surname" value="{{ Request::old('surname') ?: '' }}">   
                           @if ($errors->has('surname'))
                          <span class="help-block">{{ $errors->first('surname') }}</span>
                           @endif    
                          </div>
                          </div>


                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('othername') ? ' has-error' : ''}}">
                            <label>Other Name(s)</label>
                           <input type="text" rows="3" class="form-control"  id="othername"  name="othername" value="{{ Request::old('othername') ?: '' }}">          
                           @if ($errors->has('othername'))
                          <span class="help-block">{{ $errors->first('othername') }}</span>
                           @endif    
                          </div>
                           
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                        <div  class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : ''}}">
                          <label>Date of Birth / Incoporation </label>
                          <input type="text" class="datepicker-input form-control" value="{{ Request::old('dateofbirth') ?: '' }}"   id="date_of_birth" name="date_of_birth" placeholder="dd/mm/YYYY"> 
                                        
                          @if ($errors->has('date_of_birth'))
                          <span class="help-block">{{ $errors->first('date_of_birth') }}</span>
                           @endif           
                        </div>
                        </div>
                        </div>


                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : ''}}">
                          <label>Gender</label>
                           <select id="gender" name="gender" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                           <option value="">-- Select a gender --</option>
                          @foreach($gender as $gender)
                        <option value="{{ $gender->type }}">{{ $gender->type }}</option>
                          @endforeach
                        </select>                         
                          @if ($errors->has('gender'))
                          <span class="help-block">{{ $errors->first('gender') }}</span>
                           @endif           
                        </div>
                        </div>
                        </div>
                        </div>


                      
                        <div id="businessname">
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('companyname') ? ' has-error' : ''}} {!! $errors->has('companyname') ? 'has-error' : '' !!}">
                          <label>Business Name </label>
                          <input type="text" class="form-control" id="companyname" value="{{ Request::old('companyname') ?: '' }}" name="companyname" >
                          @if ($errors->has('companyname'))
                          <span class="help-block">{{ $errors->first('companyname') }}</span>
                           @endif                        
                        </div>
                          </div>
                        </div> 
                        </div>

                      


                         

                         
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                         
                          <label>Occupation / Field of Activity</label>
                          <div class="form-group{{ $errors->has('field_of_activity') ? ' has-error' : ''}}">

                          <select id="field_of_activity" name="field_of_activity" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">--Select--</option>
                       @foreach($professions as $profession)
                        <option value="{{ ucwords(strtolower($profession->type)) }}">{{ ucwords(strtolower($profession->type)) }}</option>
                          @endforeach 
                        </select> 


                          @if ($errors->has('field_of_activity'))
                          <span class="help-block">{{ $errors->first('field_of_activity') }}</span>
                           @endif                                  
                        </div>
                        </div>
                        </div>

                        <div class="form-group">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                          <label for="email">Email</label>
                          <input type="text" data-type="email" class="form-control" id="email" name="email" value="{{ Request::old('email') ?: '' }}"> 
                          @if ($errors->has('email'))
                          <span class="help-block">{{ $errors->first('email') }}</span>
                           @endif                            
                        </div>

                        <div class="form-group">
                          {{-- <label>Mobile Number</label>
                          <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : ''}}">
                          <input type="text" data-type="phone" data-required="true"  class="form-control"  id="mobile_number" name="mobile_number" value="{{ Request::old('mobile_number') ?: '' }}">   
                          @if ($errors->has('mobile_number'))
                          <span class="help-block">{{ $errors->first('mobile_number') }}</span>
                           @endif                           
                        </div> --}}

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                            <label>Mobile Number 1</label> 
                            <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : ''}}">
                             <input type="text" data-type="phone" data-required="true"  class="form-control"  id="mobile_number" name="mobile_number" value="{{ Request::old('mobile_number') ?: '' }}">    
                           @if ($errors->has('mobile_number'))
                          <span class="help-block">{{ $errors->first('mobile_number') }}</span>
                           @endif    
                          </div>
                          </div>

                           <div class="col-sm-4">
                            <label>Mobile Number 2</label> 
                            <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : ''}}">
                             <input type="text" data-type="phone"  class="form-control"  id="mobile_number_2" name="mobile_number_2" value="{{ Request::old('mobile_number') ?: '' }}">    
                           @if ($errors->has('mobile_number'))
                          <span class="help-block">{{ $errors->first('mobile_number') }}</span>
                           @endif    
                          </div>
                          </div>
                           <div class="col-sm-4">
                            <label>Office / Landline Number </label> 
                            <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : ''}}">
                             <input type="text" data-type="phone"  class="form-control"  id="mobile_number_3" name="mobile_number_3" value="{{ Request::old('mobile_number') ?: '' }}">    
                           @if ($errors->has('mobile_number'))
                          <span class="help-block">{{ $errors->first('mobile_number') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>



                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Residential / Office Address / Location</label> 
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
                            <textarea type="text" rows="3" data-required="true" class="form-control" id="postal_address" name="postal_address" value="{{ Request::old('postal_address') ?: '' }}"></textarea>     
                           @if ($errors->has('postal_address'))
                          <span class="help-block">{{ $errors->first('postal_address') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>



                        <div id="individualid">
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('idcardtype') ? ' has-error' : ''}}"> 
                            <label>Identification Type</label>
                            <select id="idcardtype" name="idcardtype" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            <option value="">-- Select an identification type --</option>
                          @foreach($identificationtypes as $identificationtypes)
                        <option value="{{ $identificationtypes->type }}">{{ $identificationtypes->type }}</option>
                          @endforeach
                        </select>    
                          @if ($errors->has('idcardtype'))
                          <span class="help-block">{{ $errors->first('idcardtype') }}</span>
                           @endif      
                            </div>
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
                        </div>
                        </div>



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