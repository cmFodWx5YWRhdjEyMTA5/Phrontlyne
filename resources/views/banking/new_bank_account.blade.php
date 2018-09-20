<section class="panel panel-default">
                      <div class="panel-body">
                        

                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Account Name</label> 
                            <div class="form-group{{ $errors->has('account_name') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="accouaccount_namentnumber" name="account_name" value="{{ Request::old('account_name') ?: '' }}" data-required="true">   
                           @if ($errors->has('account_name'))
                          <span class="help-block">{{ $errors->first('account_name') }}</span>
                           @endif    
                          </div>
                          </div>

                         <div class="col-sm-6">
                            <label>Bank Name</label> 
                            <div class="form-group{{ $errors->has('bank_name') ? ' has-error' : ''}}">
                            <select id="bank_name" name="bank_name" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          @foreach($banks as $bank)
                        <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>
                          @endforeach
                        </select>  
                           @if ($errors->has('bank_name'))
                          <span class="help-block">{{ $errors->first('bank_name') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                      <div class="form-group pull-in clearfix">
                            <div class="col-sm-6">
                            <label>Currency</label> 
                            <div class="form-group{{ $errors->has('currency') ? ' has-error' : ''}}">
                            <select id="currency" name="currency" rows="3" tabindex="1" data-required="true" data-placeholder="Select here.." class="form-control m-b">
                          @foreach($currencies as $currency)
                        <option value="{{ $currency->type }}">{{ $currency->type }}</option>
                          @endforeach
                        </select>  
                           @if ($errors->has('currency'))
                          <span class="help-block">{{ $errors->first('currency') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                            <label>Account Number</label> 
                            <div class="form-group{{ $errors->has('account_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" data-required="true"  id="account_number" name="account_number" value="{{ Request::old('account_number') ?: '' }}">   
                           @if ($errors->has('account_number'))
                          <span class="help-block">{{ $errors->first('account_number') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save Account</button>
                      </footer>
                      </section>

