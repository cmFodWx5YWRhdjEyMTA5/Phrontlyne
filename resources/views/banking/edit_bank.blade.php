<section class="panel panel-default">
                      <div class="panel-body">
                        

                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Bank Name</label> 
                            <div class="form-group{{ $errors->has('bank_name') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="bank_name" name="bank_name" value="{{ Request::old('bank_name') ?: '' }}">   
                           @if ($errors->has('bank_name'))
                          <span class="help-block">{{ $errors->first('bank_name') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Swift Number</label> 
                            <div class="form-group{{ $errors->has('swift_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="swift_number" name="swift_number" value="{{ Request::old('swift_number') ?: '' }}">   
                           @if ($errors->has('swift_number'))
                          <span class="help-block">{{ $errors->first('swift_number') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Update Bank</button>
                      </footer>
                      </section>

