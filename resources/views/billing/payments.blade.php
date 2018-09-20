                    <section class="panel panel-default">
                      <div class="panel-body">
                       
                        <div class="clearfix m-b">

                          <a href="#" class="thumb-lg">
                            <img src="" name="imagePreview" id="imagePreview"  class="img-circle">
                          </a>
                          
                        </div>
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Patient Number</label> 
                            <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="patient_id" readonly="true" name="patient_id" value="{{ Request::old('patient_id') ?: '' }}">   
                           @if ($errors->has('patient_id'))
                          <span class="help-block">{{ $errors->first('patient_id') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('copayer') ? ' has-error' : ''}}">
                            <label>Co Payer</label>

                            <select id="copayer" name="copayer" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            {{--  @foreach($accounttype as $accounttype)
                            <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                            @endforeach --}}
                        </select>         
                           @if ($errors->has('copayer'))
                          <span class="help-block">{{ $errors->first('copayer') }}</span>
                           @endif    
                          </div>
                            <div ><a href="#" class="btn btn-rounded btn-sm btn-icon btn-info"><i class="fa fa-plus"></i></a> </div>
                        </div>
                        </div>


                        <div class="form-group">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Patient Name </label>
                          <input type="text" class="form-control" id="fullname" readonly="true" value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Date</label> 
                            <div class="form-group{{ $errors->has('paymentdate') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" readonly="true" id="paymentdate" name="paymentdate" value="{{ Carbon\Carbon::now() }}">   
                           @if ($errors->has('paymentdate'))
                          <span class="help-block">{{ $errors->first('paymentdate') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('visit_id') ? ' has-error' : ''}}">
                            <label>Visit Number</label>
                              <input type="text" rows="3" class="form-control" readonly="true" id="visit_id" name="visit_id" value="{{ Request::old('visit_id') ?: '' }}">   
                           @if ($errors->has('visit_id'))
                          <span class="help-block">{{ $errors->first('visit_id') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('paymentmethod') ? ' has-error' : ''}}">
                            <label>Payment Method</label>
                            <select id="paymentmethod" name="paymentmethod" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($receiptmodes as $receiptmode)
                        <option value="{{ $receiptmode->type }}">{{ $receiptmode->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('paymentmethod'))
                          <span class="help-block">{{ $errors->first('paymentmethod') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                            <label>Reference Number</label> 
                            <div class="form-group{{ $errors->has('referencenumber') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control"  id="referencenumber" name="referencenumber" value="{{ Request::old('referencenumber') ?: '' }}">   
                           @if ($errors->has('referencenumber'))
                          <span class="help-block">{{ $errors->first('referencenumber') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                         <div class="col-sm-6">
                            <label>Amount Received</label> 
                            <div class="form-group{{ $errors->has('amountreceived') ? ' has-error' : ''}}">
                            <input type="number" rows="3" class="form-control"  id="amountreceived" name="amountreceived" value="{{ Request::old('amountreceived') ?: '' }}">   
                           @if ($errors->has('amountreceived'))
                          <span class="help-block">{{ $errors->first('amountreceived') }}</span>
                           @endif    
                          </div>
                          </div>

                        </div>
                        <br>
                        <br>
                        <br>
                        <br>

                       <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                  
                        <li><a href="#medication_tab" data-toggle="tab"><i class="fa fa-money text-default"></i> 
                        Invoice Items - Bill Total : GHS {{ $bills->sum('amount') }}  </a></li>
                        
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                    

                       {{-- Patient treatment Start --}}
                    <div class="tab-pane" id="medication_tab">
                    <div >
               
                       <table id="invoiceTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Item Name</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Tax %</th>
                              <th>Discount</th>
                              <th>Amount Payable</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                </div>
                 <div class="line"></div>
                 <div class="text-right no-border"><strong><span> Bill Total : GHS {{ $bills->sum('amount') }} </span></strong></div>
              </div>
                     
                      {{-- Patient History End --}}
                
                          
                    </div>
                  </section>

                        
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                         <input type="hidden" name="visit_id" id="visit_id" value="{{ Request::old('visit_id') ?: '' }}">
                      </footer>
                    </section>



