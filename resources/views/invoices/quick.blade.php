              <section class="panel panel-default">
                      <div class="panel-body">
                         <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Create Invoice
                    </header>
                      <div class="panel-body">
                        
                      
                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Name</label> 
                            <div class="form-group{{ $errors->has('account_holder') ? ' has-error' : ''}}">
                            <select id="account_holder" name="account_holder" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" data-required="true">
                         <option value="">-- select a customer --</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->fullname }}">{{ $customer->fullname }}</option>
                          @endforeach 
                        </select>  
                           @if ($errors->has('account_holder'))
                          <span class="help-block">{{ $errors->first('account_holder') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Business Class</label> 
                            <div class="form-group{{ $errors->has('business_class') ? ' has-error' : ''}}">
                            <select id="business_class" name="business_class" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" data-required="true">
                         <option value="">-- select a product --</option>
                        @foreach($producttypes as $producttype)
                        <option value="{{ $producttype->type }}"> {{$producttype->type }}</option>
                          @endforeach
                        </select>  
                           @if ($errors->has('business_class'))
                          <span class="help-block">{{ $errors->first('business_class') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>
                        

                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Account Manager</label> 
                            <div class="form-group{{ $errors->has('account_manager') ? ' has-error' : ''}}">
                            <select id="account_manager" name="account_manager" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" data-required="true">
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
                        </div>

  

                      <div class="form-group @if($errors->has('insurance_period')) has-error @endif">
                        <label for="time">Insurance Period</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="insurance_period" id="insurance_period" placeholder="Select your time" value="{{ old('insurance_period') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('insurance_period'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('insurance_period') }}
                       </p>
                        @endif
                      </div>
                      
                        
                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                            <label>Currency</label> 
                            <div class="form-group{{ $errors->has('currency') ? ' has-error' : ''}}">
                            <select id="currency" name="currency" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true">
                        <option value="">-- not set --</option>
                         @foreach($currencies as $currency)
                        <option value="{{ $currency->type }}">{{ $currency->type }}</option>
                          @endforeach
                        </select>  
                           @if ($errors->has('currency'))
                          <span class="help-block">{{ $errors->first('currency') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                            <label>Sum Insured</label> 
                            <div class="form-group{{ $errors->has('sum_insured') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="sum_insured" name="sum_insured" value="{{ Request::old('sum_insured') ?: '' }}"> 
                           @if ($errors->has('sum_insured'))
                          <span class="help-block">{{ $errors->first('sum_insured') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                            <label>Gross Premium</label> 
                            <div class="form-group{{ $errors->has('gross_premium') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="gross_premium" name="gross_premium" value="{{ Request::old('gross_premium') ?: '' }}"> 
                           @if ($errors->has('gross_premium'))
                          <span class="help-block">{{ $errors->first('gross_premium') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Pay in the name of </label> 
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="status" name="status" value="{{ Request::old('status') ?: '' }}"> 
                           @if ($errors->has('status'))
                          <span class="help-block">{{ $errors->first('status') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Description </label> 
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
                             <textarea type="text" rows="3" class="form-control" id="description" name="description" value="{{ Request::old('description') ?: '' }}"> </textarea>
                           @if ($errors->has('description'))
                          <span class="help-block">{{ $errors->first('description') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>



                        </div>
                        </section>
                      
                        </div>
                         
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Process Profoma</button>
                      </footer>
                    </section>