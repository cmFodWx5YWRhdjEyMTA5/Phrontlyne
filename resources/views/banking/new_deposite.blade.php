<section class="panel panel-default">
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          
                        <div class="col-sm-6">
                            <label>Account Name</label> 
                            <div class="form-group{{ $errors->has('transactiontype') ? ' has-error' : ''}}">
                            <select id="transactiontype" name="transactiontype" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          @foreach($account_name as $account_name)
                        <option value="{{ $account_name->account_name }}">{{ $account_name->account_name }}</option>
                          @endforeach
                        </select>  
                           @if ($errors->has('account_name'))
                          <span class="help-block">{{ $errors->first('account_name') }}</span>
                           @endif    
                          </div>
                          </div>

                            <div class="col-sm-6">
                            <label>Amount</label> 
                            <div class="form-group{{ $errors->has('trasactionamount') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" data-required="true" id="trasactionamount" name="trasactionamount" value="{{ Request::old('trasactionamount') ?: '' }}">   
                           @if ($errors->has('trasactionamount'))
                          <span class="help-block">{{ $errors->first('trasactionamount') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('narration') ? ' has-error' : ''}}">
                            <label>Narration</label>
                            <input type="text" rows="3" class="form-control" id="narration" name="narration" value="{{ Request::old('narration') ?: '' }}" data-required="true" placeholder="Enterprise insurance commission for Jan 2016">      
                           @if ($errors->has('narration'))
                          <span class="help-block">{{ $errors->first('narration') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Receipt Mode</label> 
                            <div class="form-group{{ $errors->has('receiptmode') ? ' has-error' : ''}}">
                            <select id="receiptmode" name="receiptmode" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          @foreach($receiptmodes as $receiptmodes)
                        <option value="{{ $receiptmodes->type }}">{{ $receiptmodes->type }}</option>
                          @endforeach
                        </select>    
                           @if ($errors->has('receiptmode'))
                          <span class="help-block">{{ $errors->first('receiptmode') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('chequenumber') ? ' has-error' : ''}}">
                            <label>Cheque Number</label>
                            <input type="text" rows="3" class="form-control" id="chequenumber" name="chequenumber" value="{{ Request::old('chequenumber') ?: '' }}">      
                           @if ($errors->has('chequenumber'))
                          <span class="help-block">{{ $errors->first('chequenumber') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-s-xs">Process</button>
                      </footer>
                    </section>