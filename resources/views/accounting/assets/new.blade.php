              <section class="panel panel-default">
                      <div class="panel-body">
                
                        

                     <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Name</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>

                      <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Vendor</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>

                      <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Model Number</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>

                     <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Serial Number</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>


                     <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Bar Code</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>

                    <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Price</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>

                    <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Salvage Value</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>

                    <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Quantity</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>

                    <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Description</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <textarea type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"></textarea>
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                    </div>
                      
                    <div class="form-group pull-in clearfix">
                          
                        <div class="col-sm-12">
                            <label>Payment Mode</label> 
                            <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : ''}}">
                            <select id="payment_type" name="payment_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true">
                        <option value=""> -- Please select type -- </option>
                       {{--  @foreach($paymenttypes as $paymenttypes)
                        <option value="{{ $paymenttypes->type }}">{{ $paymenttypes->type }}</option>
                          @endforeach --}}
                        </select>  
                           @if ($errors->has('payment_type'))
                          <span class="help-block">{{ $errors->first('payment_type') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                       <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                       <div class="form-group @if($errors->has('payment_date')) has-error @endif">
                        <label for="payment_date">Purchase Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="payment_date" id="payment_date" placeholder="Select your time" value="{{ old('payment_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('payment_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('payment_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>


                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Add Asset</button>
                      </footer>
                      </div>
                    </section>