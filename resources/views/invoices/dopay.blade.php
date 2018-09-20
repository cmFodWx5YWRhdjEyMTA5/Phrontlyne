              <section class="panel panel-default">
                      <div class="panel-body">
                         <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Add Payment
                    </header>
                      <div class="panel-body">
                        
                      
                    <div class="form-group pull-in clearfix">
                          
                        <div class="col-sm-12">
                            <label>Payment Type</label> 
                            <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : ''}}">
                            <select id="payment_type" name="payment_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" data-required="true">
                        <option value=""> -- Please select type -- </option>
                        @foreach($paymenttypes as $paymenttypes)
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
                        <div class="col-sm-6">
                       <div class="form-group @if($errors->has('payment_date')) has-error @endif">
                        <label for="payment_date">Payment Date</label>
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

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                            <label>Payment Sum</label> 
                            <div class="form-group{{ $errors->has('payment_sum') ? ' has-error' : ''}}">
                             <input type="text" data-required="true" rows="3" class="form-control" id="payment_sum" name="payment_sum" value="{{ Request::old('payment_sum') ?: '' }}"> 
                           @if ($errors->has('payment_sum'))
                          <span class="help-block">{{ $errors->first('payment_sum') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                        </div>
                        </section>

                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Payer Info
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('payer_name') ? ' has-error' : ''}}">
                            <label>Payer Name</label>
                            <input type="text" rows="3" class="form-control" id="payer_name" name="payer_name" value="{{ Request::old('payer_name') ?: '' }}">      
                           @if ($errors->has('payer_name'))
                          <span class="help-block">{{ $errors->first('payer_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('payer_id') ? ' has-error' : ''}}">
                            <label>Payer ID Code</label>
                            <input type="text" rows="3" class="form-control" readonly="true" id="payer_id" name="payer_id" value="{{ Request::old('payer_id') ?: '' }}">      
                           @if ($errors->has('payer_id'))
                          <span class="help-block">{{ $errors->first('payer_id') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('payer_account_number') ? ' has-error' : ''}}">
                            <label>Payer Account No</label>
                            <input type="text" rows="3" class="form-control" readonly="true" id="payer_account_number" name="payer_account_number"  value="{{ Request::old('payer_account_number') ?: '' }}">      
                           @if ($errors->has('payer_account_number'))
                          <span class="help-block">{{ $errors->first('payer_account_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('reference_number') ? ' has-error' : ''}}">
                            <label>Invoice No</label>
                            <input type="text" rows="3" class="form-control" readonly="true" id="reference_number" name="reference_number" value="{{ Request::old('reference_number') ?: '' }}">      
                           @if ($errors->has('reference_number'))
                          <span class="help-block">{{ $errors->first('reference_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('payment_description') ? ' has-error' : ''}}">
                            <label>Payment Description</label>
                            <input type="text" rows="3" class="form-control" id="payment_description" data-required="true" name="payment_description" value="Payment of policy">      
                           @if ($errors->has('payment_description'))
                          <span class="help-block">{{ $errors->first('payment_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                      
                      </div>
                      </section>
                    
                      <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Reference Number
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('cash_receipt_number') ? ' has-error' : ''}}">
                            <label>(Cash Receipt No, Mobile Money Number, Cheque No., Swift No. )</label>
                            <input type="text" rows="3" class="form-control" id="cash_receipt_number" name="cash_receipt_number" value="{{ Request::old('cash_receipt_number') ?: '' }}">      
                           @if ($errors->has('cash_receipt_number'))
                          <span class="help-block">{{ $errors->first('cash_receipt_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                          <div class="form-group pull-in clearfix">
                          
                        <div class="col-sm-12">
                            <label>Pay Into</label> 
                            <div class="form-group{{ $errors->has('broker_bank_account') ? ' has-error' : ''}}">
                            <select id="broker_bank_account" name="broker_bank_account" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" >
                        <option value=""> -- Please select account -- </option>
                        @foreach($bankaccounts as $bankaccounts)
                        <option value="{{ $bankaccounts->account_number }}">{{ $bankaccounts->bank_name }} | {{ $bankaccounts->account_number}}</option>
                          @endforeach 
                        </select>  
                           @if ($errors->has('broker_bank_account'))
                          <span class="help-block">{{ $errors->first('broker_bank_account') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                      
                      </div>
                      </section>

                       <div class="checkbox">
                          <label>
                            <input type="checkbox" name="check" unchecked ><a href="#" class="text-info">Try to automap payment</a>
                          </label>
                        </div>

                      
                        </div>
                         
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Process</button>
                        <input type="hidden" name="premium" id="premium" value="{{ Request::old('premium') ?: '' }}">
                      </footer>
                    </section>