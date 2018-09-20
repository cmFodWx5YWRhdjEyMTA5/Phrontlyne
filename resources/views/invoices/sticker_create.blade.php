                    <section class="panel panel-default">
                      <div class="panel-body">


                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Serial Number</label> 
                            <div class="form-group{{ $errors->has('account_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="account_number" readonly="true" name="account_number" value="{{ Request::old('account_number') ?: '' }}">   
                           @if ($errors->has('account_number'))
                          <span class="help-block">{{ $errors->first('account_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('account_type') ? ' has-error' : ''}}">
                            <label>Document Type</label>
                            <select id="account_type" name="account_type" required="" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- Select an document --</option>
                          
                        <option value="Sticker">Sticker</option>
                         <option value="Brown Card">Brown Card</option>
                         <option value="Certificate">Certificate</option>
                         <option value="Promotion Call Cards">Promotion Call Cards</option>
                         
                        </select>         
                           @if ($errors->has('account_type'))
                          <span class="help-block">{{ $errors->first('account_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('sticker_from') ? ' has-error' : ''}}">
                            <label>Serial From</label>
                           <input type="number" rows="3" class="form-control" id="sticker_from" required="true" name="sticker_from" value="{{ Request::old('sticker_from') ?: '' }}">          
                           @if ($errors->has('sticker_from'))
                          <span class="help-block">{{ $errors->first('sticker_from') }}</span>
                           @endif    
                          </div>
                           
                        </div>

                          <div class="col-sm-6">
                            <label>Serial To</label> 
                            <div class="form-group{{ $errors->has('sticker_from') ? ' has-error' : ''}}">
                            <input type="number" rows="3" class="form-control" id="sticker_to" required="true" name="sticker_to" value="{{ Request::old('sticker_to') ?: '' }}">   
                           @if ($errors->has('sticker_to'))
                          <span class="help-block">{{ $errors->first('sticker_to') }}</span>
                           @endif    
                          </div>
                          </div>                       
                        </div>
                        


                      
                


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                        <div  class="form-group{{ $errors->has('date_of_issue') ? ' has-error' : ''}}">
                          <label>Date of Issue </label>
                          <input type="text" class="input-sm input-s datepicker-input form-control" value="{{ Request::old('date_of_issue') ?: '' }}"   id="date_of_issue" name="date_of_issue" placeholder="dd/mm/YYYY"> 
                                        
                          @if ($errors->has('date_of_issue'))
                          <span class="help-block">{{ $errors->first('date_of_issue') }}</span>
                           @endif           
                        </div>
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Distribution Status</label> 
                            <div class="form-group{{ $errors->has('residential_address') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="residential_address" name="residential_address" value="{{ Request::old('residential_address') ?: '' }}"></textarea>   
                           @if ($errors->has('residential_address'))
                          <span class="help-block">{{ $errors->first('residential_address') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                     
                         
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('assigned_to') ? ' has-error' : ''}}"> 
                            <label>Assigned To</label>
                            <select id="assigned_to" name="assigned_to" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        
                         @foreach($users as $user)
                        <option value="{{ $user->fullname }}">{{ $user->fullname }}</option>
                          @endforeach
                        </select>    
                          @if ($errors->has('assigned_to'))
                          <span class="help-block">{{ $errors->first('assigned_to') }}</span>
                           @endif      
                            </div>
                          </div>
                    
                        </div>
                        </div>

                      
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save Record</button>
                      </footer>
                    </section>