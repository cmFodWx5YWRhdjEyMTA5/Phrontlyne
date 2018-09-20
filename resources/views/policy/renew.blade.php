
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
             <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class=""> Policy Administration </li>
                 <li class="active"> Edit Policy </li>   
              </ul>

              <header class="header bg-white b-b b-light">
              <p class="h4 text-dark"><strong>Edit Policy : {{ $policy->fullname }} ( {{ $policy->policy_number }} ) - {{ $policy->policy_product }} </strong></p>
            </header>

              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                <form method="post" id="masterform" name="masterform" data-validate="parsley" action="/create-policy" class="panel-body wrapper-lg">
                  <section class="panel panel-default">
                    
                    <div class="wizard clearfix" id="form-wizard">
                      <ul class="steps">
                        <li data-target="#step1" class="active"><span class="badge badge-info">1</span>General</li>
                        <li data-target="#step2"><span class="badge">2</span>Header</li>
                        <li data-target="#step3"><span class="badge">3</span>Risk</li>
                        <li data-target="#step4"><span class="badge">4</span>Premium</li>
                        
                      </ul>
                       

                     

                    
                    </div>
                    <div class="step-content">
                    {{-- Step 1 Start --}}
                     <div class="step-pane active" id="step1">
                      
                        <section class="panel panel-default">
                      <div class="panel-body">
                       
                    
                       

                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('customer_number') ? ' has-error' : ''}}">
                            <label>Customer </label>
                           <div class="input-group">
                          <input type="hidden" class="form-control" id="customer_number" data-required="true" name="customer_number" value="{{$policy->account_number}}" readonly="true">

                          <input type="text" class="form-control" id="fullname" required="" name="fullname" value="{{$policy->fullname}}" readonly="true">
                          <span class="input-group-btn">
                           <button class="btn btn-dark" href="#get-customer-form" class="bootstrap-modal-form-open" data-toggle="modal"  type="button">Choose customer</button>
                       
                          </span>
                        </div>
                           @if ($errors->has('customer_number'))
                          <span class="help-block">{{ $errors->first('customer_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Policy Type</label>
                          <div class="form-group{{ $errors->has('policy_product') ? ' has-error' : ''}}">
                             <select id="policy_product" name="policy_product" rows="3" disabled data-required="true" tabindex="1" data-placeholder="Select here.." style="width:100%" onchange="getproductform()">
                             <option value="{{$policy->policy_product}}">{{$policy->policy_product}}</option>
                        @foreach($producttypes as $producttype)
                        <option value="{{ $producttype->type }}"> {{$producttype->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('policy_product'))
                          <span class="help-block">{{ $errors->first('policy_product') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>




                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <div class="form-group{{ $errors->has('policy_branch') ? ' has-error' : ''}}">
                            <label>Branch</label> 
                          <select id="policy_branch" name="policy_branch" data-trigger="change" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.."  style="width:100%">
                          <option value="{{$policy->policy_branch}}">{{$policy->policy_branch}}</option>
                       @foreach($branches as $branch)
                        <option value="{{ $branch->branch_name }}">{{ $branch->branch_name }}</option>
                          @endforeach 
                        </select> 
                           @if ($errors->has('policy_branch'))
                          <span class="help-block">{{ $errors->first('policy_branch') }}</span>
                           @endif    
                          </div>
                          </div>
                          </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Business Source</label> 
                            <div class="form-group{{ $errors->has('policy_sales_type') ? ' has-error' : ''}}">
                          <select id="policy_sales_type" name="policy_sales_type" data-trigger="change" data-required="true" rows="3" tabindex="1" onchange="loadIntermediary()" data-placeholder="Select here.." style="width:100%">
                          <option value="{{$policy->policy_sales_type}}">{{$policy->policy_sales_type}}</option>
                         @foreach($business_statuses as $business_status)
                        <option value="{{ $business_status->type }}">{{ $business_status->type }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('policy_sales_type'))
                          <span class="help-block">{{ $errors->first('policy_sales_type') }}</span>
                           @endif    
                          </div>
                          </div>
                          </div>

                        
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Intermediary</label> 
                          <select id="agency" data-trigger="change" data-required="true" name="agency" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="{{ $policy->agency }}">{{ $policy->agency }}</option>
                    {{--    @foreach($intermediary as $intermediary)
                        <option value="{{ $intermediary->agentname }}">{{ $intermediary->agentname }}</option>
                          @endforeach  --}}
                        </select> 
                           @if ($errors->has('agency'))
                          <span class="help-block">{{ $errors->first('agency') }}</span>
                           @endif    
                          </div>
                          </div>

                          <br>

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Currency</label> 
                          <select id="policy_currency" data-trigger="change" data-required="true" name="policy_currency" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="{{ $policy->policy_currency }}">{{ $policy->policy_currency }}</option>
                         @foreach($currencies as $currency)
                        <option value="{{ $currency->type }}">{{ $currency->type }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('policy_currency'))
                          <span class="help-block">{{ $errors->first('policy_currency') }}</span>
                           @endif    
                          </div>
                          </div>
                            
                            <br>
{{-- 
                            <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('collection_mode') ? ' has-error' : ''}}">
                            <label>Payment Method</label>
                            <select id="payment_status" name="payment_status" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                         @foreach($paymentstatus as $paymentstatus)
                        <option value="{{ $paymentstatus->type }}">{{ $paymentstatus->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('collection_mode'))
                          <span class="help-block">{{ $errors->first('collection_mode') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div> --}}


                        
                        

                        <div class="form-group pull-in clearfix">
                      <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('policy_sales_channel') ? ' has-error' : ''}}">
                        <label>Campaign</label>
                        <select id="policy_sales_channel" data-trigger="change" data-required="true" name="policy_sales_channel" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="{{ $policy->policy_sales_channel }}">{{ $policy->policy_sales_channel }}</option>
                       @foreach($collectionmodes as $collectionmodes)
                        <option value="{{ $collectionmodes->type }}">{{ $collectionmodes->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('policy_sales_channel'))
                          <span class="help-block">{{ $errors->first('policy_sales_channel') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                           

                      </div>
                    </section>

                      </div>
                    {{-- Step 1 End --}}  




                    {{-- Step 1 End --}}  


                   <div class="step-pane" id="step2">
                     
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Policy Info
                    </header>
                      <div class="panel-body">

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_number') ? ' has-error' : ''}}">
                            <label>Policy Number</label>
                            <input id="policy_number" name="policy_number" value="{{ $policy->policy_number }}" readonly="true" class="form-control" rows="3" tabindex="1">
                             
                           @if ($errors->has('policy_number'))
                          <span class="help-block">{{ $errors->first('policy_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                      
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('endorsement_number') ? ' has-error' : ''}}">
                            <label>Endorsment Number</label>
                            <input id="endorsement_number" name="endorsement_number" value="{{ $policy->endorsement_number }}" readonly="true" class="form-control" rows="3" tabindex="1">
                             
                           @if ($errors->has('endorsement_number'))
                          <span class="help-block">{{ $errors->first('endorsement_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                       
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_status') ? ' has-error' : ''}}">
                            <label>Policy Status</label>
                            <select id="policy_status" name="policy_status" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="{{ $policy->policy_status }}">{{ $policy->policy_status }}</option>
                         @foreach($policystatus as $policystatus)
                        <option value="{{ $policystatus->type }}">{{ $policystatus->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('policy_status'))
                          <span class="help-block">{{ $errors->first('policy_status') }}</span>
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
                      
                        <br>

                       

                          <div class="form-group @if($errors->has('transaction_date')) has-error @endif">
                        <label for="time">Transaction Date</label>
                        <div class="input-group">

                        @if($policy->transaction_date==null)
                        <input type="text" class="form-control" name="transaction_date" id="transaction_date" placeholder="Select your time"  value="">
                        @else
                       <input type="text" class="form-control" name="transaction_date" readonly="true" id="transaction_date" placeholder="Select your time" value="{{ $policy->transaction_date->format('d-m-Y i') }} ">
                        @endif
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

                       <br>

                        <div class="form-group @if($errors->has('issue_date')) has-error @endif">
                        <label for="time">First Issue Date</label>
                        <div class="input-group">
                         @if($policy->first_issue_date==null)
                        <input type="text" class="form-control" name="issue_date" id="issue_date" placeholder="Select your time"  value="">
                        @else
                       <input type="text" class="form-control" name="issue_date" readonly="true" id="issue_date" placeholder="Select your time" value="{{ $policy->first_issue_date->format('d-m-Y i') }} ">
                        @endif
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('issue_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('issue_date') }}
                       </p>
                        @endif
                      </div>

                         <br>

                          <div class="form-group @if($errors->has('acceptance_date')) has-error @endif">
                        <label for="time">Acceptance Date & Time</label>
                        <div class="input-group">
                        @if($policy->acceptance_date==null)
                        <input type="text" class="form-control" name="acceptance_date" id="acceptance_date" placeholder="Select your time"  value="">
                        @else
                       <input type="text" class="form-control" name="acceptance_date" readonly="true" id="acceptance_date" placeholder="Select your time" value="{{ $policy->acceptance_date->format('d-m-Y i') }} ">
                        @endif
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('acceptance_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('acceptance_date') }}
                       </p>
                        @endif
                      </div>


                       <br>
                      
                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_interest') ? ' has-error' : ''}}">
                            <label>Interest Name</label>
                            <select id="policy_interest" name="policy_interest[]" multiple rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="{{ $policy->policy_interest }}" selected>{{ $policy->policy_interest }}</option>
                        @foreach($insurers as $insurer)
                        <option value="{{ $insurer->name }}">{{ $insurer->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('policy_interest'))
                          <span class="help-block">{{ $errors->first('policy_interest') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                      </div>
                    </section>


                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Endorsement Text
                    </header>
                      <div class="panel-body">
                        
                      
                        


                        <div class="panel-group m-b" id="accordion3">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseOne3">
                          Upper Text
                        </a>
                      </div>
                      <div id="collapseOne3" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="policy_upper_text" name="policy_upper_text" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true">  {!! $policy->policy_upper_text !!}

                      </div>
                      </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo3">
                          Lower Text
                        </a>
                      </div>
                      <div id="collapseTwo3" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <div class="col-sm-12">
                        
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="policy_lower_text" name="policy_lower_text" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true">  {!! $policy->policy_lower_text !!}

                      </div>
                      </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree3">
                          End Text
                        </a>
                      </div>
                      <div id="collapseThree3" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <div class="col-sm-12">
                       
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="policy_end_text" name="policy_end_text" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true"> {!! $policy->policy_end_text !!}

                      </div>
                      </div>
                        </div>
                      </div>
                    </div>
                  </div>


                      
                      </div>

                       

                    </section>
                      </div>
                    {{-- Step 2 End --}}
                    {{-- Step 3 Start --}}
                    <div class="step-pane" id="step3">
                     


                    <div id="motorinsurance" name="motorinsurance">
                     
                    <div class="panel-group m-b" id="accordion2">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        

                        <span class="label label-info">  Registered Vehicle(s) </span>
                        </a>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                         <section class="panel panel-info">
                                <header class="panel-heading font-bold">Schedule</header>

                                <a href="/images/fleet_upload_file.csv" target="new" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-danger pull-right"><i class="fa fa-download"></i>Download Fleet File</span></a>
                                 <input type="file" class="form-control dropbox" width="500px" height="40px" name="file"/>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="motorScheduleTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Vehicle Reg. #</th>
                              <th>Risk Type</th>
                              <th>Cover Type</th>
                              <th>Engine #</th>
                              <th>Chassis #</th>
                              <th>Owner Name</th>
                              <th></th>
                               <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>
                    </section>

                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                         <span class="label label-success">  + Add Vehicle </span>
                        </a>
                      </div>
                      <div id="collapseTwo" class="panel-collapse in">
                        <div class="panel-body text-sm">
                         <div id="motorinsurance" name="motorinsurance">
                     
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Motor Insurance
                    </header>
                      <div class="panel-body">

                                

                                <div class="form-group pull-in clearfix">

                        <div class="col-sm-4">
                            <label>Vehicle Registration Number</label> 
                           <input type="text" class="form-control" id="vehicle_registration_number" onblur="vehicleexiststatus()"  value="{{ Request::old('vehicle_registration_number') ?: '' }}"  name="vehicle_registration_number">
                          @if ($errors->has('vehicle_registration_number'))
                          <span class="help-block">{{ $errors->first('vehicle_registration_number') }}</span>
                           @endif   
                          </div>

                          
                          <div class="col-sm-4">
                            <label>Vehicle Value</label> 
                           <input type="number" min="0" value="0" step="0.01" class="form-control" id="vehicle_value"  value="{{ Request::old('vehicle_value') ?: '' }}"  name="vehicle_value">
                          @if ($errors->has('vehicle_value'))
                          <span class="help-block">{{ $errors->first('vehicle_value') }}</span>
                           @endif   
                          </div>


                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_buy_back_excess') ? ' has-error' : ''}}">
                            <label>Buy Back Excess</label>
                            <select id="vehicle_buy_back_excess" name="vehicle_buy_back_excess" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value="">-- not set --</option>
                         @foreach($selectstatus as $selectstatus)
                        <option value="{{ $selectstatus->type }}">{{ $selectstatus->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_buy_back_excess'))
                          <span class="help-block">{{ $errors->first('vehicle_buy_back_excess') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                       
                        </div>

                  



                        
                            <div class="form-group pull-in clearfix">
                          
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('preferedcover') ? ' has-error' : ''}}">
                            <label>Prefered Cover</label>
                            <select id="preferedcover" name="preferedcover" onchange="vehicleexiststatus();getCommissionRates(this);" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="">Choose Cover Type</option>
                        <option value="Comprehensive">Comprehensive</option>
                        <option value="Third Party Fire & Theft">Third Party Fire & Theft</option>
                        <option value="Third Party">Third Party</option>
                        </select>         
                           @if ($errors->has('preferedcover'))
                          <span class="help-block">{{ $errors->first('preferedcover') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                        <div class="col-sm-4">
                            <label>Vehicle Usage</label> 
                          <select id="vehicle_use" name="vehicle_use" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" onchange="loadNCD(),loadRisk()">
                           <option value="">-- select from here --</option>
                          <option value="Commercial">Commercial</option>
                           <option value="Private">Private</option>
                        </select> 
                           @if ($errors->has('vehicle_use'))
                          <span class="help-block">{{ $errors->first('vehicle_use') }}</span>
                           @endif    
                          </div>

                          <div class="col-sm-4">
                            <label>Certificate Type</label> 
                          <select id="vehicle_risk" name="vehicle_risk" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                           <option value="">-- select from here --</option>
                          @foreach($vehicleuses as $vehicleuse)
                        <option value="{{ $vehicleuse->risk }}"> {{$vehicleuse->risk }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('vehicle_risk'))
                          <span class="help-block">{{ $errors->first('vehicle_risk') }}</span>
                           @endif    
                          </div>
                        </div>

     


                        <div class="form-group pull-in clearfix">
                       
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_make') ? ' has-error' : ''}}">
                            <label>Vehicle Make</label>
                            <select id="vehicle_make" name="vehicle_make" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" onchange="loadModels()">
                             <option value="">-- select from here --</option>
                          @foreach($vehiclemakes as $vehiclemake)
                        <option value="{{ $vehiclemake->type }}">{{ $vehiclemake->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('vehicle_make'))
                          <span class="help-block">{{ $errors->first('vehicle_make') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_model') ? ' has-error' : ''}}">
                            <label>Vehicle Model</label>
                            <select id="vehicle_model" name="vehicle_model" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                             <option value="">-- select from here --</option>
                          @foreach($vehiclemodels as $vehiclemodel)
                        <option value="{{ $vehiclemodel->type }}">{{ $vehiclemodel->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('vehicle_model'))
                          <span class="help-block">{{ $errors->first('vehicle_model') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_body_type') ? ' has-error' : ''}}">
                            <label>Body Type</label>
                            <select id="vehicle_body_type" name="vehicle_body_type" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- select from here --</option>
                         @foreach($vehicletypes as $vehicletype)
                        <option value="{{ $vehicletype->type }}">{{ $vehicletype->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_body_type'))
                          <span class="help-block">{{ $errors->first('vehicle_body_type') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                    

                        <div class="form-group pull-in clearfix">

                          <div class="col-sm-4">
                            <label>TPPDL Limit Amount</label> 
                           <input type="number" min="2000" max="20000" value="2000" step="1" class="form-control" id="vehicle_tppdl_value" name="vehicle_tppdl_value">
                          @if ($errors->has('vehicle_tppdl_value'))
                          <span class="help-block">{{ $errors->first('vehicle_tppdl_value') }}</span>
                           @endif   
                          </div>
                         

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_make_year') ? ' has-error' : ''}}">
                            <label>Year of Manufacture </label>
                            <select id="vehicle_make_year" name="vehicle_make_year" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        @foreach($year as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                          @endforeach  

                        </select>         
                           @if ($errors->has('vehicle_make_year'))
                          <span class="help-block">{{ $errors->first('vehicle_make_year') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-4">
                            <label>Seating Capacity</label> 
                           <input type="number" min="0" max="100" value="5" step="1" class="form-control" id="vehicle_seating_capacity"  name="vehicle_seating_capacity">
                          @if ($errors->has('vehicle_seating_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_seating_capacity') }}</span>
                           @endif   
                          </div>
                            
                        </div>


                      
                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Cubic Capacity</label> 
                           <input type="number" min="0" max="10000" value="0" step="1" class="form-control" id="vehicle_cubic_capacity" name="vehicle_cubic_capacity">
                          @if ($errors->has('vehicle_cubic_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_cubic_capacity') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Engine Number</label> 
                           <input type="text" class="form-control" id="vehicle_engine_number"  value="{{ Request::old('vehicle_engine_number') ?: '' }}"  name="vehicle_engine_number">
                          @if ($errors->has('vehicle_engine_number'))
                          <span class="help-block">{{ $errors->first('vehicle_engine_number') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>Chassis Number</label> 
                           <input type="text" class="form-control" id="vehicle_chassis_number"  value="{{ Request::old('vehicle_chassis_number') ?: '' }}"  name="vehicle_chassis_number">
                          @if ($errors->has('vehicle_chassis_number'))
                          <span class="help-block">{{ $errors->first('vehicle_chassis_number') }}</span>
                           @endif   
                          </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Owner Name</label> 
                           <input type="text" class="form-control" id="vehicle_owner_name"  value="{{ Request::old('vehicle_owner_name') ?: '' }}"  name="vehicle_owner_name">
                          @if ($errors->has('vehicle_owner_name'))
                          <span class="help-block">{{ $errors->first('vehicle_owner_name') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Owner LI Number</label> 
                           <input type="text" class="form-control" id="license_number"  value="{{ Request::old('license_number') ?: '' }}"  name="license_number">
                          @if ($errors->has('license_number'))
                          <span class="help-block">{{ $errors->first('license_number') }}</span>
                           @endif   
                          </div>

                          <div class="col-sm-4">
                            <label>Registration Month & Year</label> 
                           <input type="text" class="form-control" id="vehicle_register_date"  value="{{ Request::old('vehicle_register_date') ?: '' }}"  name="vehicle_register_date">
                          @if ($errors->has('vehicle_register_date'))
                          <span class="help-block">{{ $errors->first('vehicle_register_date') }}</span>
                           @endif   
                          </div>
                        </div>

                          

                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Log Book Number</label> 
                           <input type="number" class="form-control" id="vehicle_log_book"  value="{{ Request::old('vehicle_log_book') ?: '' }}"  name="vehicle_log_book">
                          @if ($errors->has('vehicle_log_book'))
                          <span class="help-block">{{ $errors->first('vehicle_log_book') }}</span>
                           @endif   
                          </div>
                            
                           <div class="col-sm-4">
                            <label>Colour</label> 
                           <input type="text" class="form-control" id="vehicle_colour"  value="{{ Request::old('vehicle_colour') ?: '' }}"  name="vehicle_colour">
                          @if ($errors->has('vehicle_colour'))
                          <span class="help-block">{{ $errors->first('vehicle_colour') }}</span>
                           @endif   
                          </div>

                          <div class="col-sm-4">
                            <label>Model Description</label> 
                           <input type="text" class="form-control" id="vehicle_model_description"  value="{{ Request::old('vehicle_model_description') ?: '' }}"  name="vehicle_model_description">
                          @if ($errors->has('vehicle_mileage_number'))
                          <span class="help-block">{{ $errors->first('vehicle_model_description') }}</span>
                           @endif   
                          </div>
                        </div>



                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Vehicle Tonnage</label> 
                           <input type="number" class="form-control" id="vehicle_tonnage_capacity"  value="{{ Request::old('vehicle_tonnage_capacity') ?: '' }}"  name="vehicle_tonnage_capacity">
                          @if ($errors->has('vehicle_tonnage_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_tonnage_capacity') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Trailer Number</label> 
                           <input type="text" class="form-control" id="vehicle_trailer_number"  value="{{ Request::old('vehicle_trailer_number') ?: '' }}"  name="vehicle_trailer_number">
                          @if ($errors->has('vehicle_trailer_number'))
                          <span class="help-block">{{ $errors->first('vehicle_trailer_number') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>Mileage</label> 
                           <input type="number" class="form-control" id="vehicle_mileage_number"  value="{{ Request::old('vehicle_mileage_number') ?: '' }}"  name="vehicle_mileage_number">
                          @if ($errors->has('vehicle_mileage_number'))
                          <span class="help-block">{{ $errors->first('vehicle_mileage_number') }}</span>
                           @endif   
                          </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>New Purchase Price</label> 
                           <input type="number" class="form-control" id="vehicle_purchase_price"  value="{{ Request::old('vehicle_purchase_price') ?: '' }}"  name="vehicle_purchase_price">
                          @if ($errors->has('vehicle_purchase_price'))
                          <span class="help-block">{{ $errors->first('vehicle_purchase_price') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>LTA Upload Date</label> 
                           <input type="text" class="form-control" id="vehicle_lta_upload"  value="{{ Request::old('vehicle_lta_upload') ?: '' }}"  name="vehicle_lta_upload">
                          @if ($errors->has('vehicle_lta_upload'))
                          <span class="help-block">{{ $errors->first('vehicle_lta_upload') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>LTA Transmission Date</label> 
                           <input type="text" class="form-control" id="vehicle_lta_transmission"  value="{{ Request::old('vehicle_lta_transmission') ?: '' }}"  name="vehicle_lta_transmission">
                          @if ($errors->has('vehicle_lta_transmission'))
                          <span class="help-block">{{ $errors->first('vehicle_lta_transmission') }}</span>
                           @endif   
                          </div>
                        </div>
                    </div>
                   </section> 
                      
                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Reference Number(s)
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Sticker Number</label> 
                           <input type="number" class="form-control" id="sticker_number"  value="{{ Request::old('sticker_number') ?: '' }}"  name="sticker_number">
                          @if ($errors->has('sticker_number'))
                          <span class="help-block">{{ $errors->first('sticker_number') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Certificate Number</label> 
                           <input type="text" class="form-control" id="certificate_number"  value="{{ Request::old('certificate_number') ?: '' }}"  name="certificate_number">
                          @if ($errors->has('certificate_number'))
                          <span class="help-block">{{ $errors->first('certificate_number') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>Brown Card Number</label> 
                           <input type="text" class="form-control" id="brown_card_number"  value="{{ Request::old('brown_card_number') ?: '' }}"  name="brown_card_number">
                          @if ($errors->has('brown_card_number'))
                          <span class="help-block">{{ $errors->first('brown_card_number') }}</span>
                           @endif   
                          </div>
                        </div>
                      </div>
                    </section>
                  

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Discount
                    </header>
                      <div class="panel-body">
                        
                       <div class="form-group pull-in clearfix">
                       
                         <div class="col-sm-6">
                            <label>NCD</label> 
                          <select id="vehicle_ncd" name="vehicle_ncd" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                           <option value="">-- select from here --</option>
                        @foreach($noclaimdiscount as $noclaimdiscount)
                        <option value="{{ $noclaimdiscount->rate }}">{{ $noclaimdiscount->type }}</option>
                          @endforeach 
                        </select> 
                           @if ($errors->has('vehicle_ncd'))
                          <span class="help-block">{{ $errors->first('vehicle_ncd') }}</span>
                           @endif    
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_fleet_discount') ? ' has-error' : ''}}">
                            <label>Fleet Discount </label>
                            <select id="vehicle_fleet_discount" name="vehicle_fleet_discount" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                       @foreach($fleetdiscount as $fleetdiscount)
                        <option value="{{ $fleetdiscount->charge }}">{{ $fleetdiscount->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_fleet_discount'))
                          <span class="help-block">{{ $errors->first('vehicle_fleet_discount') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                        <div  class="btn-group pull-right"> 
                        <button type="button" class="btn btn-rounded btn-sm btn-info" onclick="computePremium()">Compute Premium
                        </button>

                       
                        </div>
                        </div>
                        </div>
                      </div>
                    </section>
                      </div>



                
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  </div>



                     {{-- Travel Insurance End--}}


                       {{-- Personal Accident Insurance Start--}}
                             <div id="personalaccidentinsurance" name="personalaccidentinsurance">

                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                              Insurance Cover Details
                               </header>
                            <div class="panel-body">

                              <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('pa_sum_insured') ? ' has-error' : ''}}">
                            <label>Sum Insured</label>
                            <input type="number" min="0" value="0" step="0.01" class="form-control" id="pa_sum_insured"  value="{{ Request::old('pa_sum_insured') ?: '' }}"  name="pa_sum_insured">         
                           @if ($errors->has('pa_sum_insured'))
                          <span class="help-block">{{ $errors->first('pa_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                            </div>
                            </section>
                               <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Personal Details
                               </header>
                            <div class="panel-body">
                              
                            <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pa_height') ? ' has-error' : ''}}">
                            <label>Height</label>
                            <input type="text" class="form-control" id="pa_height"  value="{{ Request::old('pa_height') ?: '' }}"  name="pa_height">         
                           @if ($errors->has('pa_height'))
                          <span class="help-block">{{ $errors->first('pa_height') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-3">
                            <label>Weight</label> 
                              <div class="form-group{{ $errors->has('pa_weight') ? ' has-error' : ''}}">
                          <input type="text" class="form-control" id="pa_weight"  value="{{ Request::old('pa_weight') ?: '' }}"  name="pa_weight">   
                           @if ($errors->has('pa_weight'))
                          <span class="help-block">{{ $errors->first('pa_weight') }}</span>
                           @endif    
                          </div>
                          </div>   

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : ''}}">
                            <label>Marital Status</label>
                            <select id="marital_status" name="marital_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($maritalstatus as $maritalstatus)
                        <option value="{{ $maritalstatus->type }}">{{ $maritalstatus->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('marital_status'))
                          <span class="help-block">{{ $errors->first('marital_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('nature_of_work') ? ' has-error' : ''}}">
                            <label>Nature of Work</label>
                            <select id="nature_of_work" name="nature_of_work" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($natureofwork as $natureofwork)
                        <option value="{{ $natureofwork->type }}">{{ $natureofwork->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('nature_of_work'))
                          <span class="help-block">{{ $errors->first('nature_of_work') }}</span>
                           @endif    
                          </div>   
                        </div>
                              

                            </div>
                            </section>

                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Previous Accident Information
                               </header>
                            <div class="panel-body">
                              

                            <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pa_accident_received') ? ' has-error' : ''}}">
                            <label>Accident Received?</label>
                            <select id="pa_accident_received" name="pa_accident_received" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_accident_received'))
                          <span class="help-block">{{ $errors->first('pa_accident_received') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-3">
                            <label>Nature of Accident</label> 
                             <div class="form-group{{ $errors->has('pa_nature_of_accident') ? ' has-error' : ''}}">
                          <select id="pa_nature_of_accident" name="pa_nature_of_accident" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       @foreach($natureofaccident as $natureofaccident)
                        <option value="{{ $natureofaccident->type }}">{{ $natureofaccident->type }}</option>
                          @endforeach 
                        </select> 
                           @if ($errors->has('pa_nature_of_accident'))
                          <span class="help-block">{{ $errors->first('pa_nature_of_accident') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('accident_duration') ? ' has-error' : ''}}">
                            <label>Duration</label>
                            <select id="accident_duration" name="accident_duration" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="0">-- not set --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="5">6</option>
                        <option value="5">7</option>
                        <option value="5">8</option>
                        <option value="5">9</option>
                        <option value="5">10</option>
                        </select>         
                           @if ($errors->has('accident_duration'))
                          <span class="help-block">{{ $errors->first('accident_duration') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('accident_period') ? ' has-error' : ''}}">
                            <label>Period</label>
                            <select id="accident_period" name="accident_period" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="0">-- not set --</option>
                        <option value="Days">Days</option>
                        <option value="Weeks">Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Years">Years</option>
                        </select>         
                           @if ($errors->has('accident_period'))
                          <span class="help-block">{{ $errors->first('accident_period') }}</span>
                           @endif    
                          </div>   
                        </div>
                              


                            </div>
                            </section>

                            <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Activities Detail
                               </header>
                            <div class="panel-body">
                              
                             <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('pa_activities') ? ' has-error' : ''}}">
                           
                            <select id="pa_activities" name="pa_activities" multiple="multiple" rows="3" tabindex="1" data-placeholder="Choose Activities Engaged In" style="width:100%">
                           <option value="Motor Cycling">Motor Cycling</option>
                           <option value="Football">Football</option>
                           <option value="Big Game Hunting">Big Game Hunting</option>
                          <option value="Parachuting">Parachuting</option>
                          <option value="Big Game Hunting">Diving</option>
                          <option value="Parachuting">Mining</option>
                        </select>         
                           @if ($errors->has('pa_activities'))
                          <span class="help-block">{{ $errors->first('pa_activities') }}</span>
                           @endif    
                          </div>   
                          </div>
                          
                        </div>

                            </div>
                            </section>


                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Has any insurance company ever...
                               </header>
                            <div class="panel-body">
                                  <div class="form-group pull-in clearfix">
                       
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('pa_special_term_status') ? ' has-error' : ''}}">
                            <label>1. Required Special Terms?</label>
                            <select id="pa_special_term_status" name="pa_special_term_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_special_term_status'))
                          <span class="help-block">{{ $errors->first('pa_special_term_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-4">
                            <label>2. Cancelled or refused your insurance?</label> 
                            <div class="form-group{{ $errors->has('pa_cancelled_insurance_status') ? ' has-error' : ''}}">
                          <select id="pa_cancelled_insurance_status" name="pa_cancelled_insurance_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select> 
                           @if ($errors->has('pa_cancelled_insurance_status'))
                          <span class="help-block">{{ $errors->first('pa_cancelled_insurance_status') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('pa_increased_premium_status') ? ' has-error' : ''}}">
                            <label>3. Increase your premium on renewal?</label>
                            <select id="pa_increased_premium_status" name="pa_increased_premium_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_increased_premium_status'))
                          <span class="help-block">{{ $errors->first('pa_increased_premium_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                            </div>
                            </section>

                            <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Benefit Details
                               </header>
                            <div class="panel-body">
                              
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('pa_benefit_details') ? ' has-error' : ''}}">
                            <label>Name, Gender, Date of Birth, Relationship of each person on a new line</label>
                            <textarea type="text" rows="3" class="form-control" id="pa_benefit_details" name="pa_benefit_details" value="{{ Request::old('pa_benefit_details') ?: '' }}"></textarea>         
                           @if ($errors->has('pa_benefit_details'))
                          <span class="help-block">{{ $errors->first('pa_benefit_details') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                            </div>
                            </section>
                          </div>


                         {{-- Personal Accident Insurance End--}}

                             {{--Bond Insurance Start--}}
                      <div id="liabilityinsurance" name="liabilityinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Liability Information

                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('liability_risk_type') ? ' has-error' : ''}}">
                            <label>Liability Type</label>
                            <select id="liability_risk_type" name="liability_risk_type" onchange="getCommissionRates(this)" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="">-- Select coverage --</option>
                           @foreach($liabilitytypes as $liabilitytypes)
                        <option value="{{ $liabilitytypes->type }}">{{ $liabilitytypes->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('liability_risk_type'))
                          <span class="help-block">{{ $errors->first('liability_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>




                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-2">
                            <label>Risk Group No</label> 
                           <input type="number" min="1" value="1" step="1" class="form-control" id="liability_risk_number"  value="{{ Request::old('liability_risk_number') ?: '' }}"  name="liability_risk_number">
                          @if ($errors->has('liability_risk_number'))
                          <span class="help-block">{{ $errors->first('liability_risk_number') }}</span>
                           @endif   
                          </div>
                          </div>

                            <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('liability_risk_description') ? ' has-error' : ''}}">
                            <label> Risk Description</label>
                             <input type="text"  class="form-control" id="liability_risk_description"  value="{{ Request::old('liability_risk_description') ?: '' }}"  name="liability_risk_number">           
                           @if ($errors->has('liability_risk_description'))
                          <span class="help-block">{{ $errors->first('liability_risk_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>









                    
                      <!-- .accordion -->
                  <div class="panel-group m-b" id="accordion2">

                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne117">
                           Risk Details #1
                        </a>
                      </div>
                      <div id="collapseOne117" class="panel-collapse in">
                        <div class="panel-body text-sm">
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">

             
               
                <section class="panel-body">
                
                             <div class="form-group pull-in clearfix">
                          <div class="col-sm-2">
                            <label>Item No</label> 
                           <input type="number" min="1" value="1" step="1" class="form-control" id="liability_item_number"  value="{{ Request::old('liability_item_number') ?: '' }}"  name="liability_item_number">
                          @if ($errors->has('liability_item_number'))
                          <span class="help-block">{{ $errors->first('liability_item_number') }}</span>
                           @endif   
                          </div>
                          </div>


                             <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('liability_risk_description') ? ' has-error' : ''}}">
                            <label> Item Description</label>
                             <input type="text"  class="form-control" id="liability_risk_description"  value="{{ Request::old('liability_risk_description') ?: '' }}"  name="liability_risk_description">           
                           @if ($errors->has('liability_risk_description'))
                          <span class="help-block">{{ $errors->first('liability_risk_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('liability_unit') ? ' has-error' : ''}}">
                            <label>UOM Description</label>
                            <select id="liability_unit" name="liability_unit" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="">-- Select coverage --</option>
                            @foreach($limitsofmeasures as $unit)
                        <option value="{{ $unit->type }}">{{ $unit->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('liability_unit'))
                          <span class="help-block">{{ $errors->first('liability_unit') }}</span>
                           @endif    
                          </div>   
                        </div>
                        
                          <div class="col-sm-4">
                            <label>UOM Amount</label> 
                           <input type="number" min="0" value="0" step="0.01" class="form-control" id="liability_si"  value="{{ Request::old('liability_si') ?: '' }}"  name="liability_si">
                          @if ($errors->has('liability_si'))
                          <span class="help-block">{{ $errors->first('liability_si') }}</span>
                           @endif   
                          </div>


                            <div class="col-sm-2">
                            <label>Rate (%)</label> 
                           <input type="number" min="0" value="0" step="0.01" class="form-control" id="liability_rate"  value="{{ Request::old('liability_rate') ?: '' }}"  name="liability_rate">
                          @if ($errors->has('liability_rate'))
                          <span class="help-block">{{ $errors->first('liability_rate') }}</span>
                           @endif   
                          </div>

                            <div class="col-sm-2">
                            <label>SD Rate (%)</label> 
                           <input type="number" min="0" value="0" step="0.01" class="form-control" id="liability_sd_rate"  value="{{ Request::old('liability_sd_rate') ?: '' }}"  name="liability_sd_rate">
                          @if ($errors->has('liability_sd_rate'))
                          <span class="help-block">{{ $errors->first('liability_sd_rate') }}</span>
                           @endif   
                          </div>

                        
                        </div>
                </section>
                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne11">
                          Miscellaneous Risk Details #1
                        </a>
                      </div>
                      <div id="collapseOne11" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">

              <section class="panel panel-default portlet-item" style="opacity: 1;">
                <header class="panel-heading">                    
                  <span class="label bg-dark"></span> Schedule description of each object on a new line
                </header>
                <section class="panel-body">
                <div class="col-sm-12">
                        <label class="badge bg-default"></label> 
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="liability_schedule" name="liability_schedule" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true"> 

                      </div>
                      </div>
                </section>
                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo22">
                          Miscellaneous Risk Details #2
                        </a>
                      </div>
                      <div id="collapseTwo22" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                            <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">

              <section class="panel panel-default portlet-item" style="opacity: 1;">
                <header class="panel-heading">                    
                  <span class="label bg-dark"></span> List of beneficiaries of limits on a new line
                </header>
                <section class="panel-body">
                <div class="col-sm-12">
                        <label class="badge bg-default"></label> 
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="liability_beneficiary" name="liability_beneficiary" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true"> 

                      </div>
                      </div>
                </section>
                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- / .accordion -->







                        
                       
                      </div>

                        <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addLiabilityDetails()" class="btn btn-success btn-s-xs">Add to Schedule</button>
                      </footer>
                   </section>

                    


                          <section class="panel panel-info">
                                <header class="panel-heading font-bold"> Risk(s) Registered</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="liabilityScheduleTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              
                              <th>Risk Type</th>
                              <th>Description</th>
                              <th>Sum Insured</th>
                              <th>Rate</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                       
                    </div>
                    </div>

                      </section>

            </div>





{{-- starting GeneralAccident--}}
 <div id="generalaccident" name="generalaccident">
 
                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Liability Information

                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('accident_risk_type') ? ' has-error' : ''}}">
                            <label>Risk Type</label>
                            <select id="accident_risk_type" name="accident_risk_type" onchange="getCommissionRates(this)" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="">-- Select coverage --</option>
                           @foreach($accidenttypes as $accident)
                        <option value="{{ $accident->type }}">{{ $accident->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('accident_risk_type'))
                          <span class="help-block">{{ $errors->first('accident_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                          
                          


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-2">
                            <label>Risk Number</label> 
                           <input type="number" min="1" value="1" step="1" class="form-control" id="accident_risk_number"  value="{{ Request::old('accident_risk_number') ?: '' }}"  name="accident_risk_number">
                          @if ($errors->has('accident_risk_number'))
                          <span class="help-block">{{ $errors->first('accident_risk_number') }}</span>
                           @endif   
                          </div>
                          </div>

                            <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('accident_risk_description') ? ' has-error' : ''}}">
                            <label>Risk Description</label>
                             <input type="text" class="form-control" id="accident_risk_description"  value="{{ Request::old('accident_risk_description') ?: '' }}"  name="accident_risk_description">           
                           @if ($errors->has('accident_risk_description'))
                          <span class="help-block">{{ $errors->first('accident_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         




                    
                      <!-- .accordion -->
                  <div class="panel-group m-b" id="accordion2">

                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne1111">
                          Risk Items
                        </a>
                      </div>
                      <div id="collapseOne1111" class="panel-collapse in">
                        <div class="panel-body text-sm">
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">

              <section class="panel panel-default portlet-item" style="opacity: 1;">
                
                <section class="panel-body">

                <div class="form-group pull-in clearfix">
                          <div class="col-sm-2">
                            <label>Item Number</label> 
                           <input type="number" min="1" value="1" step="1" class="form-control" id="accident_item_number"  value="{{ Request::old('accident_item_number') ?: '' }}"  name="accident_item_number">
                          @if ($errors->has('accident_item_number'))
                          <span class="help-block">{{ $errors->first('accident_item_number') }}</span>
                           @endif   
                          </div>
                          </div>


                            <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('accident_item_description') ? ' has-error' : ''}}">
                            <label>Item Description</label>
                             <input type="text" class="form-control" id="accident_item_description"  value="{{ Request::old('accident_item_description') ?: '' }}"  name="accident_item_description">           
                           @if ($errors->has('accident_item_description'))
                          <span class="help-block">{{ $errors->first('accident_item_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                 <div class="form-group pull-in clearfix">



                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('liability_unit') ? ' has-error' : ''}}">
                            <label>UOM Description</label>
                            <select id="accident_unit" name="accident_unit" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="">-- Select coverage --</option>
                            @foreach($limitsofmeasures as $unit)
                        <option value="{{ $unit->type }}">{{ $unit->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('accident_unit'))
                          <span class="help-block">{{ $errors->first('accident_unit') }}</span>
                           @endif    
                          </div>   
                        </div>
                        
                          <div class="col-sm-4">
                            <label>UOM Amount</label> 
                           <input type="number" min="0" value="0" step="0.01" class="form-control" id="accident_si"  value="{{ Request::old('accident_si') ?: '' }}"  name="accident_si">
                          @if ($errors->has('accident_si'))
                          <span class="help-block">{{ $errors->first('accident_si') }}</span>
                           @endif   
                          </div>


                            <div class="col-sm-2">
                            <label>Rate (%)</label> 
                           <input type="number" min="0" value="0" step="0.01" class="form-control" id="accident_rate"  value="{{ Request::old('accident_rate') ?: '' }}"  name="accident_rate">
                          @if ($errors->has('accident_rate'))
                          <span class="help-block">{{ $errors->first('accident_rate') }}</span>
                           @endif   
                          </div>

                            <div class="col-sm-2">
                            <label>SD Rate (%)</label> 
                           <input type="number" min="0" value="0" step="0.01" class="form-control" id="accident_sd_rate"  value="{{ Request::old('accident_sd_rate') ?: '' }}"  name="accident_sd_rate">
                          @if ($errors->has('accident_sd_rate'))
                          <span class="help-block">{{ $errors->first('accident_sd_rate') }}</span>
                           @endif   
                          </div>

                        
                        </div>

                </section>
                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne111">
                          Miscellaneous Risk Details #1
                        </a>
                      </div>
                      <div id="collapseOne111" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">

              <section class="panel panel-default portlet-item" style="opacity: 1;">
                <header class="panel-heading">                    
                  <span class="label bg-dark"></span> Schedule description of each object on a new line
                </header>
                <section class="panel-body">
                <div class="col-sm-12">
                        <label class="badge bg-default"></label> 
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="accident_schedule" name="accident_schedule" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true"> 

                      </div>
                      </div>
                </section>
                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo222">
                          Miscellaneous Risk Details #2
                        </a>
                      </div>
                      <div id="collapseTwo222" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                            <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">

              <section class="panel panel-default portlet-item" style="opacity: 1;">
                <header class="panel-heading">                    
                  <span class="label bg-dark"></span> List of beneficiaries of limits on a new line
                </header>
                <section class="panel-body">
                <div class="col-sm-12">
                        <label class="badge bg-default"></label> 
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="accident_beneficiary" name="accident_beneficiary" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true"> 

                      </div>
                      </div>
                </section>
                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- / .accordion -->







                        
                       
                      </div>

                        <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addAccidentDetails()" class="btn btn-success btn-s-xs">Add to Schedule</button>
                      </footer>
                   </section>

                    <section class="panel panel-info">
                                <header class="panel-heading font-bold"> Risk(s) Registered</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="accidentScheduleTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              
                              <th>Risk Type</th>
                              <th>Description</th>
                              <th>Sum Insured</th>
                              <th>Rate</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                       
                    </div>
                    </div>

                      </section>
                  
                  </div>






{{-- Ending General Accident--}}




                        {{--Bond Insurance Start--}}
                            <div id="bondinsurance" name="bondinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Bond Details
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_risk_type') ? ' has-error' : ''}}">
                            <label>Bond Type</label>
                            <select id="bond_risk_type" name="bond_risk_type" onchange="getCommissionRates(this)" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="">-- Select coverage --</option>
                         @foreach($bondtypes as $bondtype)
                        <option value="{{ ucwords(strtolower($bondtype->type)) }}">{{ ucwords(strtolower($bondtype->type)) }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('bond_risk_type'))
                          <span class="help-block">{{ $errors->first('bond_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_interest') ? ' has-error' : ''}}">
                            <label>Principal Name</label>
                             <input type="text" class="form-control" id="bond_interest"  value="{{ Request::old('bond_interest') ?: '' }}"  name="bond_interest">           
                           @if ($errors->has('bond_interest'))
                          <span class="help-block">{{ $errors->first('bond_interest') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                         <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_interest_address') ? ' has-error' : ''}}">
                            <label>Principal Address</label>
                                 <input type="text" class="form-control" id="bond_interest_address"  value="{{ Request::old('bond_interest_address') ?: '' }}"  name="bond_interest_address">          
                           @if ($errors->has('bond_interest_address'))
                          <span class="help-block">{{ $errors->first('bond_interest_address') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('contract_sum') ? ' has-error' : ''}}">
                            <label>Contract Sum</label>
                             <input type="number" min="0" value="0" step="0.01" class="form-control"  value="{{ Request::old('contract_sum') ?: '' }}"  name="contract_sum" id="contract_sum">           
                           @if ($errors->has('contract_sum'))
                          <span class="help-block">{{ $errors->first('contract_sum') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('bond_sum_insured') ? ' has-error' : ''}}">
                            <label>Bond Amount</label>
                                 <input type="number" min="0" value="0" step="0.01" class="form-control" id="bond_sum_insured"  value="{{ Request::old('pa_height') ?: '' }}"  name="bond_sum_insured">          
                           @if ($errors->has('bond_sum_insured'))
                          <span class="help-block">{{ $errors->first('bond_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('bond_rate') ? ' has-error' : ''}}">
                            <label>Bond Rate (%)</label>
                                 <input type="number" min="0" value="0" step="0.01" class="form-control" id="bond_rate"  value="{{ Request::old('bond_rate') ?: '' }}"  name="bond_rate">        
                           @if ($errors->has('bond_rate'))
                          <span class="help-block">{{ $errors->first('bond_rate') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_contract_description') ? ' has-error' : ''}}">
                            <label>Contract Description</label>
                             <textarea type="text" class="form-control" rows="3" id="bond_contract_description"  value="{{ Request::old('bond_contract_description') ?: '' }}"  name="bond_contract_description"></textarea>           
                           @if ($errors->has('bond_contract_description'))
                          <span class="help-block">{{ $errors->first('bond_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>




                        </div>

                         <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addBondDetails()" class="btn btn-success btn-s-xs">Add Bond Risk</button>
                      </footer>


                   </section>

                   <section class="panel panel-info">
                                <header class="panel-heading font-bold"> Risk(s) Registered</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="bondScheduleTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              
                              <th>Risk Type</th>
                              <th>Interest</th>
                              <th>Description</th>
                              <th>Sum Insured</th>
                              <th>Rate</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                       
                    </div>
                    </div>

                      </section>
                       </div>


                        {{--Bond Insurance End--}}

              {{-- CAR start--}}

                             <div id="contractorallrisk" name="contractorallrisk">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Contract Details
                    </header>
                      <div class="panel-body">

                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('car_risk_type') ? ' has-error' : ''}}">
                            <label>Risk Type</label>
                            <select id="car_risk_type" name="car_risk_type" rows="3" onchange="getCommissionRates(this)" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        <option value="">-- Select risk --</option>
                          @foreach($engineeringrisktypes as $engineeringrisktypes)
                        <option value="{{ $engineeringrisktypes->type }}">{{ $engineeringrisktypes->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('car_risk_type'))
                          <span class="help-block">{{ $errors->first('car_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        
                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('car_parties') ? ' has-error' : ''}}">
                            <label>Parties Involved</label>
                             <input type="text" class="form-control" id="car_parties"  value="{{ Request::old('car_parties') ?: '' }}"  name="car_parties">           
                           @if ($errors->has('car_parties'))
                          <span class="help-block">{{ $errors->first('car_parties') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('car_nature_of_business') ? ' has-error' : ''}}">
                            <label>Nature of Business</label>
                                 <input type="text" class="form-control" id="car_nature_of_business"  value="{{ Request::old('car_nature_of_business') ?: '' }}"  name="car_nature_of_business">          
                           @if ($errors->has('car_nature_of_business'))
                          <span class="help-block">{{ $errors->first('car_nature_of_business') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('car_contract_description') ? ' has-error' : ''}}">
                            <label>Contract Description</label>
                             <textarea type="text" class="form-control" rows="3" id="car_contract_description"  value="{{ Request::old('car_contract_description') ?: '' }}"  name="car_contract_description"></textarea>           
                           @if ($errors->has('car_contract_description'))
                          <span class="help-block">{{ $errors->first('car_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                   </section>

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                     
                    </header>
                      <div class="panel-body">
                        
              

                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('car_contract_sum') ? ' has-error' : ''}}">
                            <label>Engineering Sum Insured</label>
                             <input type="number" min="0" step="0.01" class="form-control" id="car_contract_sum"  value="{{ Request::old('car_contract_sum') ?: '' }}"  name="car_contract_sum">           
                           @if ($errors->has('car_contract_sum'))
                          <span class="help-block">{{ $errors->first('car_contract_sum') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('car_contract_rate') ? ' has-error' : ''}}">
                            <label>Engineering Rate (%)</label>
                                 <input type="number" min="0" value="0" step="0.01" class="form-control" id="car_contract_rate"  value="{{ Request::old('car_contract_rate') ?: '' }}"  name="car_deductible">          
                           @if ($errors->has('car_deductible'))
                          <span class="help-block">{{ $errors->first('car_deductible') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                       

                       <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                        <label class="badge bg-default">Engineering Items - Add each item on a new line</label> 
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="car_endorsements" name="car_endorsements" class="form-control" style="overflow:scroll;height:150px;max-height:150px" contenteditable="true">
                          
                        </div>
                      </div>
                    </div>



                        </div>
                    
                     <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addEngineeringDetails()" class="btn btn-success btn-s-xs">Add Engineering Schedule</button>
                      </footer>
                   </section>

                  <section class="panel panel-info">
                                <header class="panel-heading font-bold"> Risk Registered</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="engineeringScheduleTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Parties Involved</th>
                              <th>Nature of Business</th>
                              <th>Contract Description</th>
                              <th>Sum Insured</th>
                              <th>Rate</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                       
                    </div>
                    </div>

                      </section>

                </div>









                      {{-- CAR end--}}




                             {{--marine Insurance Start--}}
                            <div id="marineinsurance" name="marineinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Marine
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('marine_risk_type') ? ' has-error' : ''}}">
                            <label>Marine Type</label>
                            <select id="marine_risk_type" name="marine_risk_type" rows="3" tabindex="1" onchange="getCommissionRates(this)" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select coverage --</option>
                          @foreach($marinetypes as $marinetypes)
                        <option value="{{ $marinetypes->type }}">{{ $marinetypes->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('marine_risk_type'))
                          <span class="help-block">{{ $errors->first('marine_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_sum_insured') ? ' has-error' : ''}}">
                            <label>Sum Insured</label>
                             <input ttype="number" min="0" value="0" step="0.01" class="form-control" id="marine_sum_insured"  value="{{ Request::old('marine_sum_insured') ?: '' }}"  name="marine_sum_insured">           
                           @if ($errors->has('marine_sum_insured'))
                          <span class="help-block">{{ $errors->first('marine_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_rate') ? ' has-error' : ''}}">
                            <label>Marine Rate %</label>
                                 <input type="number" min="0" value="0" step="0.01" class="form-control" id="marine_rate"  value="{{ Request::old('marine_rate') ?: '' }}"  name="marine_rate">          
                           @if ($errors->has('marine_rate'))
                          <span class="help-block">{{ $errors->first('marine_rate') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>
                        </div>
                   </section>

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Marine Details
                    </header>
                      <div class="panel-body">
                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_interest') ? ' has-error' : ''}}">
                            <label>Interest & Marks</label>
                             <input type="text" class="form-control" id="marine_interest"  value="{{ Request::old('marine_interest') ?: '' }}"  name="marine_interest">           
                           @if ($errors->has('marine_interest'))
                          <span class="help-block">{{ $errors->first('marine_interest') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_vessel') ? ' has-error' : ''}}">
                            <label>Vessel Name & Number</label>
                                 <input type="text" class="form-control" id="marine_vessel"  value="{{ Request::old('marine_vessel') ?: '' }}"  name="marine_vessel">          
                           @if ($errors->has('marine_vessel'))
                          <span class="help-block">{{ $errors->first('marine_vessel') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('voyage_date') ? ' has-error' : ''}}">
                            <label>Voyage Date</label>
                             <input type="text" class="form-control" id="voyage_date"  value="{{ Request::old('voyage_date') ?: '' }}"  name="voyage_date">           
                           @if ($errors->has('voyage_date'))
                          <span class="help-block">{{ $errors->first('voyage_date') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('departure_date') ? ' has-error' : ''}}">
                            <label>Estimated Departure Date</label>
                                 <input type="text" class="form-control" id="departure_date"  value="{{ Request::old('departure_date') ?: '' }}"  name="departure_date">          
                           @if ($errors->has('departure_date'))
                          <span class="help-block">{{ $errors->first('departure_date') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>




                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_insurance_condition') ? ' has-error' : ''}}">
                            <label>Insurance Condition</label>
                             <input type="text" class="form-control" id="marine_insurance_condition"  value="{{ Request::old('marine_insurance_condition') ?: '' }}"  name="marine_insurance_condition">           
                           @if ($errors->has('marine_insurance_condition'))
                          <span class="help-block">{{ $errors->first('marine_insurance_condition') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('marine_valuation') ? ' has-error' : ''}}">
                            <label>Valuation Basis</label>
                                 <input type="text" class="form-control" id="marine_valuation"  value="{{ Request::old('marine_valuation') ?: '' }}"  name="marine_valuation">          
                           @if ($errors->has('marine_valuation'))
                          <span class="help-block">{{ $errors->first('marine_valuation') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('marine_means_of_conveyance') ? ' has-error' : ''}}">
                            <label>Ship or vessel or other means of conveyance </label>
                             <textarea type="text" class="form-control" rows="3" id="marine_means_of_conveyance"  value="{{ Request::old('marine_means_of_conveyance') ?: '' }}"  name="marine_means_of_conveyance"></textarea>           
                           @if ($errors->has('marine_means_of_conveyance'))
                          <span class="help-block">{{ $errors->first('marine_means_of_conveyance') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('marine_voyage') ? ' has-error' : ''}}">
                            <label>Voyage</label>
                             <input type="text" class="form-control" id="marine_voyage"  value="{{ Request::old('marine_voyage') ?: '' }}"  name="marine_voyage">           
                           @if ($errors->has('marine_voyage'))
                          <span class="help-block">{{ $errors->first('marine_voyage') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('marine_condition') ? ' has-error' : ''}}">
                            <label>Conditions of insurance subject to </label>
                             <textarea type="text" class="form-control" rows="3" id="marine_condition"  value="{{ Request::old('marine_condition') ?: '' }}"  name="marine_condition"></textarea>           
                           @if ($errors->has('marine_condition'))
                          <span class="help-block">{{ $errors->first('marine_condition') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addMarineDetails()" class="btn btn-success btn-s-xs">Add Marine Schedule</button>
                      </footer>
                   </section>

                   <section class="panel panel-info">
                                <header class="panel-heading font-bold"> Risk Registered</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="marineScheduleTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Vessel Number</th>
                              <th>Voyage</th>
                              <th>Means of Conveyance</th>
                              <th>Sum Insured</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                       
                    </div>
                    </div>

                      </section>
            </div>


                      
          
                      {{-- Fire Insurance End--}}
                <div id="fireinsurance" name="fireinsurance">
                 <div class="col-lg-12">
                  <!-- .accordion -->
                  <div class="panel-group m-b" id="accordion4">

                  <div class="panel panel-default">
                      
                    </div>
              




                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapseTwo4">
                          <span class="label label-success">  + Add Property & Items </span>
                        </a>
                      </div>
                      <div id="collapseTwo4" class="panel-collapse in">
                       <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      PROPERTY & ITEMS INFORMATION 
                    </header>
                      <div class="panel-body">


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_risk_covered') ? ' has-error' : ''}}">
                            <label>Risk Covered</label>
                            <select id="fire_risk_covered" name="fire_risk_covered" onchange="getCommissionRates(this)" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value="{{ $fetchrecord->fire_risk_covered }}">{{ $fetchrecord->fire_risk_covered }}</option>
                       @foreach($firerisks as $firerisks)
                        <option value="{{ $firerisks->type }}">{{ $firerisks->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('fire_risk_covered'))
                          <span class="help-block">{{ $errors->first('fire_risk_covered') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                       <!-- .accordion -->
                  <div class="panel-group m-b" id="accordion2222">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2222" href="#collapse123">
                         <span class="label label-warning">1. Add  Risk Details</span> 
                        </a>
                      </div>
                      <div id="collapse123" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                         <div class="form-group pull-in clearfix">

                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('property_type') ? ' has-error' : ''}}">
                            <label>Property / Occupancy - Type</label>
                            <select id="property_type" name="property_type" onchange="notbuilding()" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                           @foreach($propertytypes as $property)
                        <option value="{{ $property->type }}">{{ $property->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('property_type'))
                          <span class="help-block">{{ $errors->first('property_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('property_number') ? ' has-error' : ''}}">
                            <label>Risk Number</label>
                              <input type="text" class="form-control" id="property_number"  value="{{ Request::old('property_number') ?: '' }}"  name="property_number">
                           @if ($errors->has('property_number'))
                          <span class="help-block">{{ $errors->first('property_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div id="notproperty">

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('unit_number') ? ' has-error' : ''}}">
                            <label>GPS/Post Code</label>
                            <input type="text" class="form-control" id="unit_number"  value="{{ Request::old('unit_number') ?: '' }}"  name="unit_number">

                           @if ($errors->has('unit_number'))
                          <span class="help-block">{{ $errors->first('unit_number') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('walled_with') ? ' has-error' : ''}}">
                            <label>Construction Class</label>
                            <select id="walled_with" multiple="multiple" name="walled_with" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                           
                          @foreach($walled as $walled)
                        <option value="{{ $walled->type }}">{{ $walled->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('walled_with'))
                          <span class="help-block">{{ $errors->first('walled_with') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('roofed_with') ? ' has-error' : ''}}">
                            <label>Roof Class</label>
                            <select id="roofed_with" multiple="multiple" name="roofed_with" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            
                        @foreach($roofed as $roofed)
                        <option value="{{ $roofed->type }}">{{ $roofed->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('roofed_with'))
                          <span class="help-block">{{ $errors->first('roofed_with') }}</span>
                           @endif    
                          </div>   
                        </div> 
                       </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('property_description') ? ' has-error' : ''}}">
                            <label>Risk  Address</label>
                            <textarea type="text" rows="3" class="form-control" id="property_address" name="property_address" value="{{ Request::old('property_address') ?: '' }}"></textarea>         
                           @if ($errors->has('property_description'))
                          <span class="help-block">{{ $errors->first('property_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                      

                        </div>


                       

                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                        <label>Risk Description</label> 
                        
                        <div id="property_description" name="property_description" class="form-control" style="overflow:scroll;height:100px;max-height:100px" contenteditable="true">
                          
                        </div>
                      </div>
                    </div>

                        
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('item_value') ? ' has-error' : ''}}">
                            <label>Risk  Value</label>
                            <input type="number"  min="0" step="0.001" rows="3" class="form-control" id="item_value" name="item_value" value="{{ Request::old('item_value') ?: '' }}">   
                           @if ($errors->has('item_value'))
                          <span class="help-block">{{ $errors->first('item_value') }}</span>
                           @endif    
                          </div>   
                        </div>
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_rate') ? ' has-error' : ''}}">
                            <label>Basic Rate (%)</label>
                           <input type="number"  min="0" step="0.001" class="form-control" id="fire_rate"  value="{{ Request::old('fire_rate') ?: '' }}"  name="fire_rate">  
                           @if ($errors->has('fire_rate'))
                          <span class="help-block">{{ $errors->first('fire_rate') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('survey_number') ? ' has-error' : ''}}">
                            <label>Survey Report Number</label>
                            <input type="text" rows="3" class="form-control" id="survey_number" name="survey_number" value="{{ Request::old('survey_number') ?: '' }}">   
                           @if ($errors->has('survey_number'))
                          <span class="help-block">{{ $errors->first('survey_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('survey_date') ? ' has-error' : ''}}">
                            <label>Survey Date</label>
                           <input type="text"  class="form-control" id="survey_date"  value="{{ Request::old('survey_date') ?: '' }}"  name="survey_date">  
                           @if ($errors->has('fire_rate'))
                          <span class="help-block">{{ $errors->first('survey_date') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div> 
                        </div>
                         <footer class="panel-footer text-right bg-light lter">

                        <button type="button" onclick="addProperty()" class="btn btn-success btn-s-xs">Add Risk</button>
                        <input type="hidden" id="firepremium" name="firepremium" value="">
                      </footer>
                      </div>

                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2222" href="#collapse34">
                         <span class="label label-primary">2. Add  Item Details</span> 
                        </a>
                      </div>
                      <div id="collapse34" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <div class="form-group pull-in clearfix">

                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('property_type') ? ' has-error' : ''}}">
                            <label> Item Type</label>
                            <select id="property_type_item" name="property_type_item" onchange="notbuilding()" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            @foreach($propertyitemtypes as $item)
                        <option value="{{ $item->type }}">{{ $item->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('property_type'))
                          <span class="help-block">{{ $errors->first('property_type') }}</span>
                           @endif    
                          </div>   
                        </div>


                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('property_number_item') ? ' has-error' : ''}}">
                            <label> Risk Number </label>
                            <select id="property_number_item" name="property_number_item" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">

                        </select>         
                           @if ($errors->has('property_number_item'))
                          <span class="help-block">{{ $errors->first('property_number_item') }}</span>
                           @endif    
                          </div>   
                        </div>


                       
                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('property_item_number') ? ' has-error' : ''}}">
                            <label>Item Number</label>
                              <input type="text" class="form-control" id="property_item_number"  value="{{ Request::old('property_item_number') ?: '' }}"  name="property_item_number">
                           @if ($errors->has('property_item_number'))
                          <span class="help-block">{{ $errors->first('property_item_number') }}</span>
                           @endif    
                          </div>   
                        </div>



                        </div>


                          <div id="notproperty">

                         

                       
                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                        <label>Item Description</label> 
                        
                        <div id="property_description_item" name="property_description_item" class="form-control" style="overflow:scroll;height:100px;max-height:100px" contenteditable="true">
                          
                        </div>
                      </div>
                    </div>

                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('item_value') ? ' has-error' : ''}}">
                            <label> Item  Value</label>
                            <input type="number"  min="0" step="0.001" rows="3" class="form-control" id="item_value_item" name="item_value_item" value="{{ Request::old('item_value_item') ?: '' }}">   
                           @if ($errors->has('item_value'))
                          <span class="help-block">{{ $errors->first('item_value') }}</span>
                           @endif    
                          </div>   
                        </div>
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_rate') ? ' has-error' : ''}}">
                            <label>Basic Rate (%)</label>
                           <input type="number"  min="0" step="0.001" class="form-control" id="fire_rate_item"  value="{{ Request::old('fire_rate_item') ?: '' }}"  name="fire_rate_item">  
                           @if ($errors->has('fire_rate'))
                          <span class="help-block">{{ $errors->first('fire_rate') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        {{--  <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('survey_number') ? ' has-error' : ''}}">
                            <label>Survey Report Number</label>
                            <input type="text" rows="3" class="form-control" id="survey_number_item" name="survey_number_item" value="{{ Request::old('survey_number_item') ?: '' }}">   
                           @if ($errors->has('survey_number'))
                          <span class="help-block">{{ $errors->first('survey_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('survey_date') ? ' has-error' : ''}}">
                            <label>Survey Date</label>
                           <input type="text"  class="form-control" id="survey_date_item"  value="{{ Request::old('survey_date_item') ?: '' }}"  name="survey_date_item">  
                           @if ($errors->has('fire_rate'))
                          <span class="help-block">{{ $errors->first('survey_date') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div> --}}
                        </div>
                      </div>
                       <footer class="panel-footer text-right bg-light lter">

                        <button type="button" onclick="addPropertyItem()" class="btn btn-success btn-s-xs">Add Item</button>
                        <input type="hidden" id="firepremium" name="firepremium" value="">
                      </footer>
                    </div>

                    
                  </div>
                  <!-- / .accordion -->






                    {{-- <div class="col-lg-8 pull-left">
                      <img src="/images/footer_cityscape.png">
                    </div> --}}





    
                        </div>
                        <div class="row">
                  
                  <div class="col-xs-4 pull-left">
                   <span class="label label-success"> Discounts </span> 
                  <div class="panel wrapper panel-success">
                          <div class="row pull-left">
                            <div class="col-xs-2">
                              <a href="#">
                                <span class="m-b-xs h4 block"><input type="text" value="0" class="form-control" onchange="computeLoading()" id="lta" name="lta"></span>
                                <small class="text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Long Term Agree Discount">LTA (%)</small>
                              </a>
                            </div>
                            <div class="col-xs-2">
                              <a href="#">
                                <span class="m-b-xs h4 block"><input type="text" value="0" class="form-control" id="fire_extinguisher" name="fire_extinguisher"></span>
                                <small class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fire Extinguisher">FEAW (%)</small>
                              </a>
                            </div>
                            <div class="col-xs-2">
                              <a href="#">
                                <span class="m-b-xs h4 block"><input type="text" value="0" class="form-control" id="fire_hydrant" name="fire_hydrant"></span>
                                <small class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fire Hydrant">FH (%)</small>
                              </a>
                            </div>
                            <div class="col-xs-2">
                              <a href="#">
                                <span class="m-b-xs h4 block"><input type="text" value="0" class="form-control" id="staff_discount" name="staff_discount"></span>
                                <small class="text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Staff Discount">SD (%)</small>
                              </a>
                            </div>
                          </div>

                        
                        </div>
                </div>


                <div class="col-xs-4 pull-right">
                   <span class="label label-danger">Loading </span> 
                  <div class="panel wrapper panel-danger">
                        
                          <div class="row pull-right">
                            <div class="col-xs-2">
                              <a href="#">
                                <span class="m-b-xs h4 block"><input type="text" value="0" class="form-control" id="collapserate" name="collapserate"></span>
                                <small class="text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Collapse of Building Load Rate">COL</small>
                              </a>
                            </div>
                            <div class="col-xs-2">
                              <a href="#">
                                <span class="m-b-xs h4 block"><input type="text" value="0" class="form-control" id="earthquakerate" name="earthquakerate"></span>
                                <small class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Earthquake Rate">EQ</small>
                              </a>
                            </div>
                            <div class="col-xs-2">
                              <a href="#">
                                <span class="m-b-xs h4 block"><input type="text" value="0" class="form-control" id="publicliabilityrate" name="publicliabilityrate"></span>
                                <small class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Public Liability Rate">PL</small>
                              </a>
                            </div>
                            <div class="col-xs-2">
                              <a href="#">
                                <span class="m-b-xs h4 block"><input type="text" value="0" class="form-control" id="floodrate" name="floodrate"></span>
                                <small class="text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Flood Rate">FR</small>
                              </a>
                            </div>
                          </div>
                        </div>
                </div>

                 </div>

                        


                       <section class="panel panel-info">
                                <header class="panel-heading font-bold"> Risk Registered</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="fireRiskTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Risk Number</th>
                               <th>Item Number</th>
                              <th>Risk Type</th>
                              <th>Description</th>
                              <th>Sum Insured</th>
                               <th>Rate</th>
                               <th>Premium</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>

                 
                       
                    </div>
                    </div>

                      </section>
                    
                   </section>
                      </div>
                    </div>
                   {{--  <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapseThree4">
                         <span class="label label-warning">  + Add Item(s) </span>
                        </a>
                      </div>
                      <div id="collapseThree4" class="panel-collapse collapse">
                        <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      ITEMS INFORMATION
                    </header>
                      <div class="panel-body">


                       <div class="form-group pull-in clearfix">

                       <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('item_property_number') ? ' has-error' : ''}}">
                            <label>Property Number</label>
                              <input type="text" class="form-control" id="item_property_number"  value="{{ Request::old('item_property_number') ?: '' }}"  name="item_property_number">
                           @if ($errors->has('item_property_number'))
                          <span class="help-block">{{ $errors->first('item_property_number') }}</span>
                           @endif    
                          </div>   
                        </div>

                           <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('item_type') ? ' has-error' : ''}}">
                            <label> Item Type</label>
                            <select id="item_type" name="item_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          {{--  @foreach($propertytypes as $propertytypes)
                        <option value="{{ $propertytypes->type }}">{{ $propertytypes->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('item_type'))
                          <span class="help-block">{{ $errors->first('item_type') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('item_number') ? ' has-error' : ''}}">
                            <label>Item Number</label>
                              <input type="text" class="form-control" id="item_number"  value="{{ Request::old('item_number') ?: '' }}"  name="item_number">
                           @if ($errors->has('item_number'))
                          <span class="help-block">{{ $errors->first('item_number') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_item_value') ? ' has-error' : ''}}">
                            <label>Item Value</label>
                              <input type="number"  min="0" value="0.000" step="0.01"class="form-control" id="fire_item_value"  name="fire_item_value">
                           @if ($errors->has('fire_item_value'))
                          <span class="help-block">{{ $errors->first('fire_item_value') }}</span>
                           @endif    
                          </div>   
                        </div>

                         
                        </div>
                        
                    

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('item_description') ? ' has-error' : ''}}">
                            <label>Item Description</label>
                            <textarea type="text" rows="3" class="form-control" id="item_description" name="item_description" value="{{ Request::old('item_description') ?: '' }}"></textarea>         
                           @if ($errors->has('item_description'))
                          <span class="help-block">{{ $errors->first('item_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                          
                        </div>

                         <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addPropertyItem()" class="btn btn-success btn-s-xs">Add Item</button>
                      </footer>


                       <section class="panel panel-warning">
                                <header class="panel-heading font-bold"> Items Registered</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="fireItemTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Property Number</th>
                              <th>Item Number</th>
                              <th>Description</th>
                              <th>Created On</th>
                              <th>Created By</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                       
                    </div>
                    </div>

                      </section>
                    
                   </section>

                      </div>
                    </div> --}}
         
                  </div>
                  </div>

                      </div>


                      <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Clauses & Text
                    </header>
                      <div class="panel-body">
                        
                      
                         <div class="form-group pull-in clearfix">
                          
                          <div class="col-sm-12">
                          <label>Clauses Applicable</label>
                          <div class="form-group{{ $errors->has('policy_clause') ? ' has-error' : ''}}">
                             <select id="policy_clause" name="policy_clause[]" multiple rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." style="width:100%" >
                             <option value="{{ $policy->policy_clause }}" selected>{{ $policy->policy_clause }}</option>
                         @foreach($clausetypes as $clausetype)
                        <option value="{{ $clausetype->type }}"> {{$clausetype->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('policy_clause'))
                          <span class="help-block">{{ $errors->first('policy_clause') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                          
                      </div>
                    </section>
                      </div>

                      {{-- Fire Insurance End--}}
                        
                     



      
  
                      

                    {{-- Step 3 End --}}
                      <div class="step-pane" id="step4">
                      <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                                    Premium / Payment
                                 </header>
                                 <div class="panel-body">

                        {{-- <div class="form-group pull-in clearfix">
                          <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('gross_premium') ? ' has-error' : ''}}">
                            <label>Net Annual Premium</label>
                            <div class="input-group m-b">
                            <input type="text" class="form-control parsley-validated" data-required="true" readonly="true" id="gross_premium"  value="{{ Request::old('gross_premium') ?: '' }}" data-type="number" name="gross_premium"><span class="input-group-addon">.00</span>   
                            </div>      
                           @if ($errors->has('gross_premium'))
                          <span class="help-block">{{ $errors->first('gross_premium') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('commission_rate') ? ' has-error' : ''}}">
                            <label>Base Commission Rate (%)</label>
                            <input type="text" class="form-control parsley-validated" data-required="true" readonly="true" id="commission_rate"  value="{{ Request::old('commission_rate') ?: '' }}" data-type="number"   name="commission_rate">         
                           @if ($errors->has('commission_rate'))
                          <span class="help-block">{{ $errors->first('commission_rate') }}</span>
                           @endif    
                          </div>   
                        </div>
                      

                          
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('discount_rate') ? ' has-error' : ''}}">
                            <label>Discount (%)</label>
                            <input type="text" class="form-control parsley-validated" data-required="true" id="discount_rate"  value="{{ Request::old('discount_rate') ?: '' }}" data-type="number"   name="discount_rate">         
                           @if ($errors->has('discount_rate'))
                          <span class="help-block">{{ $errors->first('discount_rate') }}</span>
                           @endif    
                          </div>   
                        </div>

                          
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('documentation_fee') ? ' has-error' : ''}}">
                            <label>Documentation Fee</label>
                            <input type="text" class="form-control parsley-validated" data-required="true" id="documentation_fee"  value="{{ Request::old('documentation_fee') ?: '' }}" data-type="number"   name="documentation_fee">         
                           @if ($errors->has('documentation_fee'))
                          <span class="help-block">{{ $errors->first('documentation_fee') }}</span>
                           @endif    
                          </div>   
                        </div>
                        

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('sticker_fee') ? ' has-error' : ''}}">
                            <label>Sticker Fee</label>
                            <input type="text" class="form-control parsley-validated" data-required="true" id="sticker_fee"  value="{{ Request::old('sticker_fee') ?: '' }}" data-type="number"   name="sticker_fee">         
                           @if ($errors->has('sticker_fee'))
                          <span class="help-block">{{ $errors->first('sticker_fee') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                       
                       </div> --}}


{{-- 
                         <input type="hidden" id="loading" name="loading" value="{{ Request::old('loading') ?: '' }}">
                          <input type="hidden" id="netpremium" name="netpremium" value="{{ Request::old('netpremium') ?: '' }}">
                          <input type="hidden" id="ccage" name="ccage" value="{{ Request::old('ccage') ?: '' }}">
                          <input type="hidden" id="tpbasic" name="tpbasic" value="{{ Request::old('tpbasic') ?: '' }}">
                          <input type="hidden" id="owndamage" name="owndamage" value="{{ Request::old('owndamage') ?: '' }}">
                          <input type="hidden" id="officepremium" name="officepremium" value="{{ Request::old('officepremium') ?: '' }}">
                          <input type="hidden" id="ncd" name="ncd" value="{{ Request::old('ncd') ?: '' }}">
                          <input type="hidden" id="fleet" name="fleet" value="{{ Request::old('fleet') ?: '' }}">
                          <input type="hidden" id="contribution" name="contribution" value="{{ Request::old('contribution') ?: '' }}">
                          <input type="hidden" id="suminsured" name="suminsured" value="{{ Request::old('suminsured') ?: '' }}">
                           --}}


                        <div id="motorcharges" name="motorcharges">
                        <input type="hidden" id="myrisk" name="myrisk" value="{{ Request::old('myrisk') ?: '' }}">

                       <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th></th>
                            
                              <th>Charged</th>
                            </tr>
                          </thead>
                          <tbody>

                          <tr>
                          <td>Sum Insured</td>
                          <td>
                            <input type="text" class="form-control" readonly="true" value="{{ Request::old('suminsured') ?: '' }}" id="suminsured" name="suminsured">
                          </td>
                          </tr>


                          

                          <tr>
                          <td>Own Damage</td>
                          <td>
                          {{--  <input type="text" style="width:300px; border: 1px solid #ABADB3; text-align: center;" id="od_ocular_adnexae" name="od_ocular_adnexae">  --}}
                          <input type="text" class="form-control" readonly="true" value="{{ Request::old('owndamage') ?: '' }}" id="owndamage" name="owndamage"> 
                          </td>
                          
            
                        
                          </tr>

                           <tr>
                          <td>Third Party Basic</td>
                          <td>
                         <input type="text" class="form-control" readonly="true" value="{{ Request::old('tpbasic') ?: '' }}" id="tpbasic" name="tpbasic"> 
                          </td>
                         

                        
                          </tr>

                           <tr>
                          <td>Age & Cubic Capacity Charge</td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ Request::old('tpbasic') ?: '' }}" id="ccage" name="ccage"> 
                          </td>
                          </tr>


                          <tr>
                          <td>Excess Bought</td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ Request::old('execessbought') ?: '' }}" id="execessbought" name="execessbought"> 

                            <input type="hidden" class="form-control" readonly="true" value="{{ Request::old('excess_charge_rate') ?: '' }}" id="excess_charge_rate" name="excess_charge_rate"> 
                          </td>
                          </tr>

                          



                          <tr>
                          <td><span class="label label-info">Office Premium</span></td>
                          <td>
                          <input type="text" class="form-control" readonly="true" value="{{ Request::old('officepremium') ?: '' }}" id="officepremium" name="officepremium"> 
                          </td>
                                           
                          </tr>


                          <tr>
                          <td> <span class="label label-success">Less No Claim Discount</span> </td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ Request::old('ncd') ?: '' }}" id="ncd" name="ncd"> 
                          </td>
                     
       
                        
                          </tr>


                           <tr>
                          <td><span class="label label-warning">Less Fleet Discount </span> </td>
                          <td>
                           <input type="text" class="form-control" readonly="true" value="{{ Request::old('fleet') ?: '' }}" id="fleet" name="fleet"> 
                          </td>
                       
                        
                          </tr>
                          
                           <tr>
                          <td>Motor Contributions </td>
                            <td>
                           <input type="text" class="form-control" value="{{ Request::old('contribution') ?: '' }}" id="contribution" name="contribution"> 
                          </td>
                         
                          </tr>

                           <tr>
                          <td>Other Loadings </td>
                            <td>
                           <input type="text" class="form-control" value="{{ Request::old('loading') ?: '' }}" id="loading" name="loading"> 
                          </td>
                         
                          </tr>


                             <tr>
                          <td>Gross Premium</td>
                            <td>
                           <input type="text" class="form-control" value="{{ Request::old('gross_premium') ?: '' }}" id="gross_premium" name="gross_premium"> 
                          </td>
                       
                          </tr>

                          <tr>
                          <td> Premium Due</td>
                            <td>
                           <input type="text" class="form-control" value="{{ Request::old('premium_due_motor') ?: '' }}" id="premium_due_motor" name="premium_due_motor"> 
                          </td>
                       
                          </tr>


                          


                          <tr>
                          <td>Base Commission (%)</td>
                            <td>
                           <input type="text" class="form-control" value="{{ Request::old('commission_rate') ?: '' }}" id="commission_rate" name="commission_rate"> 
                          </td>
                           
                          </tr>

                          
                          @role(['System Admin'])
                          <tr>
                          <td>2nd Commission Rate (%)</td>
                            <td>
                           <input type="text" class="form-control" value="" id="commisson_number_2" name="commisson_number_2"> 
                          </td>
                            
                          </tr>

                           <tr>
                          <td>3rd Commission Rate (%)</td>
                            <td>
                           <input type="text" class="form-control" value="" id="commisson_number_3" name="commisson_number_3"> 
                          </td>
                            
                          </tr>
                          
                          <tr>
                          <td>4th Commission Rate (%)</td>
                            <td>
                           <input type="text" class="form-control" value="" id="commisson_number_4" name="commisson_number_4"> 
                          </td>
                            
                          </tr>
                          @endrole


                         
                          
                   
                          </tbody>
                        </table>

                        </div>


                        <div id="nonmotorcharges" name="nonmotorcharges">
                          
                          <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th></th>
                              <th>Charge</th>
                           
                            </tr>
                          </thead>
                          <tbody>

                          <tr>
                          <td>Sum Insured</td>
                          <td>
                            <input type="text" class="form-control" readonly="true"  value="{{ Request::old('suminsured_2') ?: '' }}" id="suminsured_2" name="suminsured_2"> 
                        
                          </td>
                          </tr>



                         


                          <tr>
                          <td>Discount</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="0" id="discount_2" name="discount_2"> 
                          </td>
                          </tr>

                           <tr>
                          <td>Stamp</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="1.5" id="stamp_fee" name="stamp_fee"> 
                          </td>
                          </tr>


                          <tr>
                          <td>Fee</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="0" id="fee" name="fee"> 
                          </td>
                           
                          </tr>

                           <tr>
                          <td>Tax</td>
                            <td>
                           <input type="text" class="form-control" readonly="true"  value="0" id="tax" name="tax"> 
                          </td>
                           
                          </tr>




                            <tr>
                          <td>Gross Premium</td>
                            <td>
                           <input type="text" class="form-control" readonly="true" value="{{ Request::old('gross_premium_2') ?: '' }}" id="gross_premium_2" name="gross_premium_2"> 
                          </td>
                          </tr>

                           <tr>
                          <td>Premium Due</td>
                            <td>
                           <input type="text" class="form-control" readonly="true" value="{{ Request::old('gross_premium_21') ?: '' }}" id="gross_premium_21" name="gross_premium_21"> 
                          </td>
                          </tr>

                           <tr>
                          <td>Base Commission (%)</td>
                            <td>
                           <input type="text" class="form-control" readonly="true" value="{{ Request::old('commission_rate_2') ?: '' }}" id="commission_rate_2" name="commission_rate"> 
                          </td>
                          </tr>


                          <tr>
                          <td>2nd Commission Rate (%)</td>
                            <td>
                           <input type="text" class="form-control" value="0"  id="commission_rate_21" name="commission_rate_21"> 
                          </td>
                            
                          </tr>

                           <tr>
                          <td>3rd Commission Rate (%)</td>
                            <td>
                           <input type="text" class="form-control" value="0" id="commission_rate_22" name="commission_rate_22"> 
                          </td>
                           
                          </tr>

                          
                   
                          </tbody>
                        </table>

                        </div>

                        </section>

                          <footer>
                        <div class="btn-group pull-right">
                        <button type="button" onclick="savePolicy()" class="btn btn-lg btn-info"><i class=""></i> Save </button>
                        
                        </div>
                        </footer>

       </div>


        
                          <div class="actions">
                        <button type="button" class="btn btn-default btn-lg btn-prev" data-target="#form-wizard" data-wizard="previous" disabled="disabled">Prev</button>
                        <button type="button" onclick="generateEndorsementNumber();computenonMotorPremium();getCommissionRates()" class="btn btn-success btn-lg btn-next" data-target="#form-wizard" data-wizard="next" data-last="Finish">Next</button>

                        
                      </div>     


                        </form>

                        


                                        
                     
                    </div>
  
                      
                  </section>
                      
                      
                </section>

                </div>
              </div>


            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>



@stop

  <div class="modal fade" id="upload-fleet" size="100">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Fleet Upload</h4>
        </div>
        <div class="modal-body">
         <form method="post"  enctype="multipart/form-data" action="/fleet-upload">
          <input type="file"  class="btn btn-default btn-s-lg" width="1000" height="40px" name="file" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>             
            

  <div class="modal fade" id="get-customer-form" style="height:700px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Choose Customer</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" class="panel-body wrapper-lg">
                          {{--  @include('policy/print') --}}
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                        </section>
                      </div>
                    
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->


    <div class="modal fade" id="get-agency-form" style="height:700px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Choose Agent</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" class="panel-body wrapper-lg">
                           @include('policy/agency')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                        </section>
                      </div>
                    
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
 <script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
        $(window).on("beforeunload", function() {
          //swal ("Are you sure? You didn't finish the form!");
            return "Are you sure? You didn't finish the form!";

        });
        
        $(document).ready(function() {
            $("#masterform").on("submit", function(e) {
                //check form to make sure it is kosher
                //remove the ev
                $(window).off("beforeunload");
                return true;
            });
        });
</script> 
      
<script type="text/javascript">


function scrollbackup()
{
   $("html, body").animate({
        scrollTop: 0
    }, 9000);  
}



function notbuilding()
{
  if($('#property_type').val() != "Public Liability")
   {
     $('#notproperty').show();
   }

   else
   {
     $('#notproperty').hide();
   }

}

function computeLoading()
{
  var premium         = isNaN(parseInt($("#item_value").val() * $("#fire_rate").val()/100 )) ? 0 :($("#item_value").val() * $("#fire_rate").val()/100)  
  var collapsecharge  = isNaN(parseInt($("#item_value").val() * $("#collapserate").val()/100 )) ? 0 :($("#item_value").val() * $("#collapserate").val()/100)

   
   //renovationcharge = (txtsuminsured.Value * (txtrenovationcharge.Value / 100));
   //publicliabilitycharge = (PlLimit.Value * (PLrate.Value / 100));
   //txtloading2 = txtbasicpremium.Value + propertydamagelimit.Value;


  var ltadiscount     = (premium * $("#lta").val()/100)
  var fhdiscount      = (premium * $("#fire_hydrant").val()/100)
  var fireexdiscount  = (premium * $("#fire_extinguisher").val()/100)
  var staffdiscount   = (premium * $("#staff_discount").val()/100)

  //var totaldiscount   = ltadiscount + fhdiscount + fireexdiscount + staffdiscount;
  //var netpremium =  premium + collapsecharge - totaldiscount;

  //alert(totaldiscount);

   $("#firepremium").val(premium);
   //$("#firepremium2").val(netpremium);


}




function savePolicy()
{

   if($('#policy_product').val() == "Motor Insurance")
    {

      addMotorDetails();

    }


    else if($('#policy_product').val() == "Fire Insurance")
    {


      saveNonMotorPolicy();

    }


    else if($('#policy_product').val() == "Bond Insurance")
    {

        saveNonMotorPolicy();
    }

    else if($('#policy_product').val() == "Marine Insurance")
    {

      saveNonMotorPolicy();

    }
    else if($('#policy_product').val() == "Engineering Insurance")
    {
      
     saveNonMotorPolicy();

    }

    else if($('#policy_product').val() == "General Accident Insurance")
    {
       saveNonMotorPolicy();
    }

    else if($('#policy_product').val() == "Liability Insurance")
    {
       saveNonMotorPolicy();
    }


}


function computenonMotorPremium()
{
    if($('#policy_product').val() == "Fire Insurance")
    {

      // var total=isNaN(parseInt($("#fire_rate").val()/100 * $("#item_value").val())) ? 0 :($("#item_value").val() * $("#fire_rate").val()/100)
      // $("#gross_premium_2").val(total);
      // var suminsured = $("#item_value").val();
      // $("#suminsured_2").val(suminsured);
      
       var risk = $("#fire_risk_covered").val();
       $("#myrisk").val(risk);


       getCommulativeFirePremiumSI();

       

    }

    else if($('#policy_product').val() == "Bond Insurance")
    {



       var risk = $("#bond_risk_type").val();
       $("#myrisk").val(risk);

        getCommulativeFirePremiumSI();


    }

    else if($('#policy_product').val() == "Marine Insurance")
    {

      var risk = $("#marine_risk_type").val();
       $("#myrisk").val(risk);

        getCommulativeFirePremiumSI();

    }
    else if($('#policy_product').val() == "Engineering Insurance")
    {

      var risk = $("#car_risk_type").val();
       $("#myrisk").val(risk);

        getCommulativeFirePremiumSI();

    }

    else if($('#policy_product').val() == "General Accident Insurance")
    {
    
      var risk = $("#accident_risk_type").val();
       $("#myrisk").val(risk);

        getCommulativeFirePremiumSI();
    }


     else if($('#policy_product').val() == "Liability Insurance")
    {
     
      var risk = $("#liability_risk_type").val();
       $("#myrisk").val(risk);

        getCommulativeFirePremiumSI();
    }


}



function getCommissionRates(cover)
{

        var mycover = cover.value;
    
        //alert(mycover);
        $.get('/get-commission-non-motor',
        {

          "policy_product": $('#policy_product').val(),
          "agency": $('#policy_sales_type').val(),
          "cover" : mycover,

        },
        function(data)
        { 
          
          $.each(data, function (key, value) 
          { 

          $('#commission_rate_2').val(data.commission);

           });
                                        
        },'json');
     
}

function getCommulativeFirePremiumSI()
{


        //alert($('#policy_number').val());
        $.get('/get-fire-premium',
        {

           //alert($('#policy_number').val());
          "policy_number": $('#policy_number').val(),
          "policy_product": $('#policy_product').val()
          

        },
        function(data)
        { 
          
          $.each(data, function (key, value) 
          { 

           // alert($('#policy_number').val());
           //sweetAlert("Premium Payable : ", data["myfiresuminsured"], "info");
          $('#suminsured_2').val(data.myfiresuminsured);
          $('#gross_premium_2').val(data.myfirepremium);
          

           });
                                        
        },'json');

  
}

  function generatePolicyNumber()
  {

    //alert('hello');

     if($('#policy_number').val()=="")
     {
        $.get('/generate-policynumber-new',
        {

        
       
          "policy_product": $('#policy_product').val(),
          

        },
        function(data)
        { 
          
          $.each(data, function (key, value) 
          { 
            //sweetAlert("Policy : ", data["policy_number"], "info");
          $('#policy_number').val(data.policy_number);

           });
                                        
        },'json');
     }

     else
     {

     }

  }


function addPerilRate()
{
if($('#peril_rate').val()!= "")
{

    $.get('/add-fire-peril-applied',
        {
          "policy_number": $('#policy_number').val(),
          "fire_peril": $('#fire_peril').val(),
          "peril_rate": $('#peril_rate').val()        
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Rate successfully saved!");
          loadPerilsApplied();
        
        }
        else
        {
          toastr.success("Rate failed to save!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please fill appplicable peril details!");}
}


  function addProperty()
{

  if($('#fire_risk_covered').val()=="")
  {sweetAlert("Please select risk cover ",'Fill all fields', "error");}
  else if($('#property_type').val()=="")
  {sweetAlert("Enter select risk type ",'Fill all fields', "error");}
  else if($('#property_number').val()=="")
  {sweetAlert("Please enter risk number ",'Fill all fields', "error");}
 else if($('#item_value').val()=="" )
  {sweetAlert("Please enter risk value ",'Fill all fields', "error");}
else if($('#property_description').html()=="")
  {sweetAlert("Please enter risk description or address ",'Fill all fields', "error");}
else if($('#fire_rate').val()=="")
  {sweetAlert("Please enter risk rate ",'Fill all fields', "error");}


else
{

    computeLoading();

    $.get('/add-property-risk',
        {
          "policy_number": $('#policy_number').val(),
           "fire_risk_covered": $('#fire_risk_covered').val(),
          "property_type": $('#property_type').val(),
          "property_number": $('#property_number').val(),
          "item_value": $('#item_value').val(),
          "unit_number": $('#unit_number').val(),
          "property_address": $('#property_address').val(),
          "property_description": $('#property_description').html(),
          "insurance_period": $('#insurance_period').val(),

          "longitude_x": $('#longitude_x').val(),
          "longitude_y": $('#longitude_y').val(),
          "survey_number": $('#survey_number').val(),
          "survey_date": $('#survey_date').val(),
          "property_content": $('#property_content').val(),


          "fire_rate": $('#fire_rate').val(),
          "firepremium": $('#firepremium').val(),
          "lta": $('#lta').val(),
          "fire_extinguisher": $('#fire_extinguisher').val(),
          "fire_hydrant": $('#fire_hydrant').val(),
          "staff_discount": $('#staff_discount').val(),
          "collapserate": $('#collapserate').val()

        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          toastr.success("Property successfully saved!");
          loadProperties();
          loadRiskNumber()


          //$('#fire_risk_covered').val('');
         // $('#property_type').val('');
          $('#property_number').val('');
          $('#item_value').val('');
          $('#unit_number').val('');
          $('#property_address').val('');
          $('#property_description').html('');


          
        
        }
        else
        {
          toastr.success("Property failed to save!");
        }
      });
                                        
        },'json');
  }
  
}



function addPropertyItem()
{

  if($('#fire_risk_covered').val()=="")
  {sweetAlert("Please select risk cover ",'Fill all fields', "error");}
  else if($('#property_type_item').val()=="")
  {sweetAlert("Enter select item type ",'Fill all fields', "error");}
  else if($('#property_number_item').val()=="")
  {sweetAlert("Please select risk number ",'Fill all fields', "error");}
else if($('#property_item_number').val()=="")
  {sweetAlert("Please enter item number ",'Fill all fields', "error");}
 else if($('#item_value_item').val()=="" )
  {sweetAlert("Please enter item value ",'Fill all fields', "error");}
else if($('#property_description_item').html()=="")
  {sweetAlert("Please enter item description ",'Fill all fields', "error");}
else if($('#fire_rate_item').val()=="")
  {sweetAlert("Please enter item rate ",'Fill all fields', "error");}


else
{


    computeLoading();

    $.get('/add-property-risk',
        {
          "policy_number":      $('#policy_number').val(),
          "fire_risk_covered":  $('#fire_risk_covered').val(),
          "property_type":      $('#property_type_item').val(),
          "property_number":    $('#property_number_item').val(),
          "item_number":        $('#property_item_number').val(),
          "item_value":         $('#item_value_item').val(),
          "unit_number":        $('#unit_number').val(),
          "property_address":   $('#property_address').val(),
          "property_description": $('#property_description_item').html(),
          "insurance_period":   $('#insurance_period').val(),

          "longitude_x": $('#longitude_x').val(),
          "longitude_y": $('#longitude_y').val(),
          "survey_number": $('#survey_number_item').val(),
          "survey_date": $('#survey_date_item').val(),
          "property_content": $('#property_content').val(),


          "fire_rate": $('#fire_rate_item').val(),
          "firepremium": $('#firepremium').val(),
          "lta": $('#lta').val(),
          "fire_extinguisher": $('#fire_extinguisher').val(),
          "fire_hydrant": $('#fire_hydrant').val(),
          "staff_discount": $('#staff_discount').val(),
          "collapserate": $('#collapserate').val()

        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          toastr.success("Item successfully saved!");
          loadProperties();


          //$('#fire_risk_covered').val('');
          $('#property_type_item').val('');
          //$('#property_number_item').val('');
          $('#property_item_number').val('');
          $('#item_value_item').val('');
           //$('#fire_rate_item').val('');
          
          $('#unit_number').val('');
          $('#property_address').val('');
          $('#property_description_item').html('');
   

          
        
        }
        else
        {
          toastr.success("Property failed to save!");
        }
      });
                                        
        },'json');
  }
  
}



  function addBondDetails()
{
if($('#bond_contract_description').val()!= "")
{


//alert($('#contract_sum').val());
    $.get('/add-bond-schedule',
        {
          "insurance_period"        :$('#insurance_period').val(),
          "bond_risk_type"       :$('#bond_risk_type').val(),
          "bond_interest"        :$('#bond_interest').val(),
          "bond_rate"            :$('#bond_rate').val(),
          "bond_interest_address":$('#bond_interest_address').val(),
          "contract_sum"         :$('#contract_sum').val(),
          "bond_sum_insured"     :$('#bond_sum_insured').val(),
          "bond_contract_description" :$('#bond_contract_description').val(),
          "policy_number"        :$('#policy_number').val()        
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Bond Schedule successfully saved!");
          loadBondDetails();
        
        }
        else
        {
          toastr.error("Bond Schedule failed to save!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please fill bond details!");}
}


function addMarineDetails()
{
if($('#marine_means_of_conveyance').val()!= "" && $('#marine_risk_type').val()!= "")
{

    $.get('/add-marine-schedule',
        {
          "policy_number"          :$('#policy_number').val(),
          "marine_risk_type"       :$('#marine_risk_type').val(),
          "marine_sum_insured"     :$('#marine_sum_insured').val(),
          "marine_vessel"     :$('#marine_vessel').val(),
          "marine_rate"            :$('#marine_rate').val(),
          "marine_interest"         :$('#marine_interest').val(),
          "marine_insurance_condition" :$('#marine_insurance_condition').val(),
          "marine_valuation"           :$('#marine_valuation').val(),
          "marine_means_of_conveyance" :$('#marine_means_of_conveyance').val(),
          "marine_voyage"              :$('#marine_voyage').val(),
          "marine_condition"           :$('#marine_condition').val(),
          "voyage_date"                :$('#voyage_date').val(),
          "departure_date"             :$('#departure_date').val(),
          "marine_voyage"              :$('#marine_voyage').val()         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Marine schedule successfully saved!");
          loadMarineDetails();
        
        }
        else
        {
          toastr.error("Marine schedule failed to save!");
          
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please fill all Marine details!");}
}

function generateEndorsementNumber()
  {

    //alert('hello');

     if($('#endorsement_number').val()=="")
     {
        $.get('/generate-endorsement-new',
        {

        
       
          "policy_product": $('#policy_product').val(),
          

        },
        function(data)
        { 
          
          $.each(data, function (key, value) 
          { 
            //sweetAlert("Policy : ", data["policy_number"], "info");
          $('#endorsement_number').val(data.endorsement_number);

           });
                                        
        },'json');
     }

     else
     {

     }

  }


function addEngineeringDetails()
{
if($('#car_contract_sum').val()!= "" && $('#car_contract_description').val()!= "")
{

    $.get('/add-engineering-schedule',
        {
          "policy_number"          :$('#policy_number').val(),
          "car_risk_type"       :$('#car_risk_type').val(),
          "car_parties"     :$('#car_parties').val(),
          "car_nature_of_business"          :$('#car_nature_of_business').val(),
          "car_contract_description"            :$('#car_contract_description').val(),
          "car_contract_sum"        :$('#car_contract_sum').val(),
          "car_contract_rate" :$('#car_contract_rate').val(),
          "car_contract_premium"           :$('#car_contract_premium').val(),
          "car_deductible" :$('#car_deductible').val(),
          "insurance_period" :$('#insurance_period').val(),
          "car_endorsements" :$('#car_endorsements').html() 
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Engineering schedule successfully saved!");
          loadEngineeringDetails();
        
        }
        else
        {
          toastr.error("Engineering schedule failed to save!");
          
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please fill all Engineering details!");}
}


function addAccidentDetails()
{
if($('#accident_risk_type').val()!= "" && $('#accident_unit').val()!= "" && $('#accident_risk_number').val()!= "")
{

    $.get('/add-accident-schedule',
        {
          "policy_number"                :$('#policy_number').val(),
          "insurance_period"             :$('#insurance_period').val(),
          "account_number"               :$('#customer_number').val(),
          "accident_risk_number"         :$('#accident_risk_number').val(),
           "accident_item_number"        :$('#accident_item_number').val(),
          "currency"                     :$('#policy_currency').val(),
          "accident_risk_type"           :$('#accident_risk_type').val(),
          "accident_risk_description"    :$('#accident_risk_description').val(),
          "accident_item_description"    :$('#accident_item_description').val(),
          "accident_unit"                :$('#accident_unit').val(),
          "accident_si"                  :$('#accident_si').val(),
          "accident_rate"                :$('#accident_rate').val(),
          "accident_sd_rate"             :$('#accident_sd_rate').val(),
          "accident_schedule"            :$('#accident_schedule').html(),
          "accident_beneficiary"         :$('#accident_beneficiary').html()
              
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Accident risk successfully added!");
          loadAccidentDetails();

          //$('#accident_risk_type').val(''),
          $('#accident_unit').val(''),
          $('#accident_si').val(''),
          $('#accident_rate').val(''),
          $('#accident_item_description').val(),
          $('#accident_description').val(''),
          $('#accident_schedule').html(''),
          $('#accident_beneficiary').html('')
        
        }
        else
        {
          toastr.error("Risk failed to save!");
          
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please fill all Accident risk details!");}
}


function addLiabilityDetails()
{
if($('#liability_risk_type').val()!= "" && $('#liability_unit').val()!= "" && $('#liability_risk_number').val()!= "")
{

    $.get('/add-liability-schedule',
        {
          "policy_number"                 :$('#policy_number').val(),
          "insurance_period"              :$('#insurance_period').val(),
          "account_number"                :$('#customer_number').val(),
          "liability_risk_number"         :$('#liability_risk_number').val(),
          "liability_item_number"         :$('#liability_item_number').val(),
          "currency"                      :$('#policy_currency').val(),
          "liability_risk_type"           :$('#liability_risk_type').val(),
          "liability_unit"                :$('#liability_unit').val(),
          "liability_si"                  :$('#liability_si').val(),
          "liability_rate"                :$('#liability_rate').val(),
          "liability_risk_description"    :$('#liability_risk_description').val(),
          "liability_item_description"    :$('#liability_item_description').val(),
          "liability_sd_rate"             :$('#liability_sd_rate').val(),
          "liability_schedule"            :$('#liability_schedule').html(),
          "liability_beneficiary"         :$('#liability_beneficiary').html()
              
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Liability risk successfully added!");
          loadLiabilityDetails();

          $('#liability_risk_type').val(''),
          $('#liability_unit').val(''),
          $('#liability_si').val(''),
          $('#liability_description').val(''),
          $('#liability_item_description').val(''),
          $('#liability_rate').val(''),
          $('#liability_schedule').html(''),
          $('#liability_beneficiary').html('')
        
        }
        else
        {
          toastr.error("Risk failed to save!");
          
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please fill all Liability risk details!");}
}



function addMotorDetails()
{
 if($('#preferedcover').val()=="")
  {sweetAlert("Please select cover ",'Fill all fields', "error");}
  else if($('#vehicle_value').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Enter vehicle value ",'Fill all fields', "error");}
 else if($('#vehicle_buy_back_excess').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Please select excess ",'Fill all fields', "error");}
else if($('#vehicle_use').val()=="")
  {sweetAlert("Please select use ",'Fill all fields', "error");}
else if($('#vehicle_risk').val()=="")
  {sweetAlert("Please select risk ",'Fill all fields', "error");}
else if($('#vehicle_body_type').val()=="")
  {sweetAlert("Please select body type ",'Fill all fields', "error");}
else if($('#vehicle_model').val()=="")
  {sweetAlert("Please select model ",'Fill all fields', "error");}
else if($('#vehicle_make').val()=="")
  {sweetAlert("Please select make ",'Fill all fields', "error");}
else if($('#vehicle_registration_number').val()=="")
  {sweetAlert("Please enter registration number ",'Fill all fields', "error");}
else if($('#vehicle_chassis_number').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Please enter chasis number ",'Fill all fields', "error");}
else if($('#sticker_number').val()=="")
  {sweetAlert("Please enter sticker number ",'Fill all fields', "error");}
else if($('#vehicle_seating_capacity').val()=="")
  {sweetAlert("Please enter seat number ",'Fill all fields', "error");}
else if($('#vehicle_cubic_capacity').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Please enter cubic capacity ",'Fill all fields', "error");}
else if($('#vehicle_ncd').val()=="")
  {sweetAlert("Please select ncd ",'Fill all fields', "error");}
else if($('#vehicle_fleet_discount').val()=="")
  {sweetAlert("Please select fleet discount ",'Fill all fields', "error");}
  else
  {

    $.get('/add-motor-schedule',
        {

          "customer_number"              :$('#customer_number').val(),
          "fullname"                     :$('#fullname').val(),
          "policy_number"                :$('#policy_number').val(),
          "vehicle_registration_number"  :$('#vehicle_registration_number').val(),
          "policy_product"               :$('#policy_product').val(),
          "transaction_date"             :$('#transaction_date').val(),
          "acceptance_date"              :$('#acceptance_date').val(),
          "issue_date"                   :$('#issue_date').val(),
          "policy_sales_type"            :$('#policy_sales_type').val(),
          "policy_sales_channel"         :$('#policy_sales_channel').val(),
          "policy_currency"              :$('#policy_currency').val(),
          "policy_status"                :$('#policy_status').val(),
          "policy_branch"                :$('#policy_branch').val(),
          "agency"                       :$('#agency').val(),
          "preferedcover"                :$('#preferedcover').val(),
          "policy_clause"                :$('#policy_clause').val(),
          "policy_interest"              :$('#policy_interest').val(),
          "policy_upper_text"            :$('#policy_upper_text').html(),
          "policy_lower_text"            :$('#policy_lower_text').html(),
          "policy_end_text"              :$('#policy_end_text').html(),
          "insurance_period"             :$('#insurance_period').val(),
          "endorsement_number"             :$('#endorsement_number').val(),

         

           "vehicle_value"               :$('#vehicle_value').val(),
          "vehicle_buy_back_excess"      :$('#vehicle_buy_back_excess').val(),
          "vehicle_tppdl_standard"       :$('#vehicle_tppdl_standard').val(),
          "vehicle_tppdl_value"          :$('#vehicle_tppdl_value').val(),
          "vehicle_body_type"            :$('#vehicle_body_type').val(),
          "vehicle_model"                :$('#vehicle_model').val(),
          "vehicle_make"                 :$('#vehicle_make').val(),
          "vehicle_use"                  :$('#vehicle_use').val(),
          "vehicle_make_year"            :$('#vehicle_make_year').val(),
          "vehicle_cubic_capacity"       :$('#vehicle_cubic_capacity').val(),
          "vehicle_seating_capacity"     :$('#vehicle_seating_capacity').val(),
          "vehicle_registration_number"  :$('#vehicle_registration_number').val(),
          "vehicle_chassis_number"       :$('#vehicle_chassis_number').val(),
          "vehicle_engine_number"        :$('#vehicle_engine_number').val(),
          "vehicle_interest_status"      :$('#vehicle_interest_status').val(),
          "vehicle_interest_name"        :$('#vehicle_interest_name').val(),
          "vehicle_risk"                 :$('#vehicle_risk').val(),
          "vehicle_ncd"                  :$('#vehicle_ncd').val(),
          "vehicle_fleet_discount"       :$('#vehicle_fleet_discount').val(),
          


          "gross_premium"               :$('#gross_premium').val(),
          "vehicle_colour"              :$('#vehicle_colour').val(),
          "vehicle_register_date"       :$('#vehicle_register_date').val(),
          "vehicle_tonnage_capacity"    :$('#vehicle_tonnage_capacity').val(),
          "vehicle_mileage_number"      :$('#vehicle_mileage_number').val(),
          "vehicle_trailer_number"      :$('#vehicle_trailer_number').val(),


          "vehicle_log_book"            :$('#vehicle_log_book').val(),
          "vehicle_model_description"   :$('#vehicle_model_description').val(),
          "vehicle_purchase_price"      :$('#vehicle_purchase_price').val(),

          "vehicle_lta_upload"          :$('#vehicle_lta_upload').val(),
          "vehicle_lta_transmission"    :$('#vehicle_lta_transmission').val(),

          "sticker_number"              :$('#sticker_number').val(),
          "certificate_number"          :$('#certificate_number').val(),
          "brown_card_number"           :$('#brown_card_number').val(),
          

          "execessbought"               :$('#execessbought').val(),
          "excess_charge_rate"          :$('#excess_charge_rate').val(),


          "tpbasic"                     :$('#tpbasic').val(),
          "owndamage"                   :$('#owndamage').val(),
          "ccage"                       :$('#ccage').val(),
          "officepremium"               :$('#officepremium').val(),
          "ncd"                         :$('#ncd').val(),
          "fleet"                       :$('#fleet').val(),
          "loading"                     :$('#loading').val(),
          "contribution"                :$('#contribution').val(),
          "netpremium"                  :$('#premium_due_motor').val()
     

              
        },
        function(data)
        { 
          
        $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Motor schedule successfully saved!");
          loadMotorSchedule();
        
        }
        else
        {
          toastr.error("Motor schedule failed to save!");
          
        }
      });
                                        
        },'json');
  }
  
}


function saveNonMotorPolicy()
{

//alert($('#myrisk').val());

if($('#policy_number').val()!= "" && $('#suminsured_2').val()!= "")
{

    $.get('/add-non-motor-policy',
        {



          "customer_number"              :$('#customer_number').val(),
          "fullname"                     :$('#fullname').val(),
          "policy_number"                :$('#policy_number').val(),
          "endorsement_number"                :$('#endorsement_number').val(),
          "vehicle_registration_number"  :$('#vehicle_registration_number').val(),
          "policy_product"               :$('#policy_product').val(),
          "transaction_date"             :$('#transaction_date').val(),
          "issue_date"                    :$('#issue_date').val(),
          "acceptance_date"              :$('#acceptance_date').val(),
          "policy_sales_type"            :$('#policy_sales_type').val(),
          "policy_sales_channel"         :$('#policy_sales_channel').val(),
          "policy_currency"              :$('#policy_currency').val(),
          "policy_status"                :$('#policy_status').val(),
          "policy_branch"                :$('#policy_branch').val(),
          "agency"                       :$('#agency').val(),
          "preferedcover"                :$('#myrisk').val(),
          "policy_clause"                :$('#policy_clause').val(),
          "policy_interest"              :$('#policy_interest').val(),
          "policy_upper_text"            :$('#policy_upper_text').html(),
          "policy_lower_text"            :$('#policy_lower_text').html(),
          "policy_end_text"              :$('#policy_end_text').html(),
          "insurance_period"             :$('#insurance_period').val(),
          "gross_premium"                :$('#gross_premium_2').val(),
          "commission_rate"              :$('#commission_rate').val(),
          "sum_insured"                  :$('#suminsured_2').val()

            },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
         toastr.success("Policy successfully saved!"); 
          
        
        }
        else
        {
         toastr.error("Policy failed to save!"); 
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Some fields not have no value!");}
         
}





function loadPerilsApplied()
   {
         
        
        $.get('/get-fire-peril-applied',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#firePerilTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#firePerilTable tbody').append('<tr><td>'+ value['fire_peril'] +'</td><td>'+ value['peril_rate'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removePeril('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }



function loadMotorSchedule()
   {
         
        
        $.get('/get-motor-schedule',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#motorScheduleTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#motorScheduleTable tbody').append('<tr><td>'+ value['vehicle_registration_number'] +'</td><td>'+ value['vehicle_cover'] +'</td><td>'+ value['vehicle_risk'] +'</td><td>'+ value['vehicle_value'] +'</td><td>'+ value['vehicle_tppdl_value'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeMotor('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


    function loadMarineDetails()
   {
         
        
        $.get('/get-marine-schedule',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#marineScheduleTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#marineScheduleTable tbody').append('<tr><td>'+ value['marine_vessel'] +'</td><td>'+ value['marine_voyage'] +'</td><td>'+ value['marine_means_of_conveyance'] +'</td><td>'+ value['marine_sum_insured'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeMarine('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


     function loadBondDetails()
   {
         
        
        $.get('/get-bond-schedule',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#bondScheduleTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#bondScheduleTable tbody').append('<tr><td>'+ value['bond_risk_type'] +'</td><td>'+ value['bond_interest'] +'</td><td>'+ value['bond_contract_description'] +'</td><td>'+ value['bond_sum_insured'] +'</td><td>'+ value['bond_rate'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeBond('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }



  function loadEngineeringDetails()
   {
         
        
        $.get('/get-engineering-schedule',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#engineeringScheduleTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#engineeringScheduleTable tbody').append('<tr><td>'+ value['car_parties'] +'</td><td>'+ value['car_nature_of_business'] +'</td><td>'+ value['car_contract_description'] +'</td><td>'+ value['car_contract_sum'] +'</td><td>'+ value['car_contract_rate'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeEngineering('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


  function loadAccidentDetails()
   {
         
        
        $.get('/get-accident-schedule',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#accidentScheduleTable tbody').empty();
            $.each(data, function (key, value) 
            {           
           $('#accidentScheduleTable tbody').append('<tr><td>'+ value['risk_type'] +'</td><td>'+ value['unit'] +'</td><td>'+ value['sum_insured'] +'</td><td>'+ value['rate'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeAccident('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


      function loadLiabilityDetails()
   {
         
        
        $.get('/get-liability-schedule',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#liabilityScheduleTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#liabilityScheduleTable tbody').append('<tr><td>'+ value['risk_type'] +'</td><td>'+ value['unit'] +'</td><td>'+ value['sum_insured'] +'</td><td>'+ value['rate'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeLiability('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }



    function loadProperties()
   {
         
        
        $.get('/get-fire-property',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 


            $('#fireRiskTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#fireRiskTable tbody').append('<tr><td>'+ value['risk_number'] +'</td><td>'+ value['item_number'] +'</td><td>'+ value['property_type'] +'</td><td>'+ value['property_description'] +'</td><td>'+ value['item_value'] +'</td><td>'+ value['rate'] +'</td><td>'+ value['actual_premium'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeProperty('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


function loadPropertyItem()
   {
         
        
        $.get('/get-fire-property-item',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#fireItemTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#fireItemTable tbody').append('<tr><td>'+ value['property_number'] +'</td><td>'+ value['item_number'] +'</td><td>'+ value['item_description'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removePropertyItem('+value['id']+')" class="fa fa-trash-o"></i></a></td><td><a href="/print-property/'+value['id']+'">' + '<i onclick="" class="fa fa-print"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


function removeProperty(id)
   {
     
          $.get('/delete-fire-property',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
               loadProperties();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }


function removePropertyItem(id)
   {
     
          $.get('/delete-fire-property-item',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
               loadPropertyItem();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }



function removeMarine(id)
   {
     
          $.get('/delete-marine-schedule',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
               loadMarineDetails();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }



function removeAccident(id)
   {
     
          $.get('/delete-accident-schedule',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
               loadAccidentDetails();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }


function removeLiability(id)
   {
     
          $.get('/delete-liability-schedule',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
               loadLiabilityDetails();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }


   function removeEngineering(id)
   {
     
          $.get('/delete-engineering-schedule',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
               loadEngineeringDetails();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }



function removeBond(id)
   {
     
          $.get('/delete-bond-schedule',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
               loadBondDetails();
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }


   function removePeril(id)
   {
     
          $.get('/delete-fire-peril',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
               loadPerilsApplied();
            }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }



  function loadCustomer()
   {
         
        
        $.get('/load-customer-details',
          {
            "search": $('#search').val()
          },
          function(data)
          { 

            $('#searchTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#searchTable tbody').append('<tr><td><a a href="#" class="text-info" onclick="setCustomer(\''+value['ID']+'\')">'+ value['NAME'] +'</a></td><td>'+ value['ID'] +'</td><td>'+ value['CREATED BY'] +'</td></tr>');
            });
                                          
         },'json');      
    }


 function setCustomer(id)
   {
         
        $.get("/get-customer",
          
          {"id":id},
          function(json)
          {

                 //sweetAlert(json.account_number);

                $('#customer_number').val(json.fullname);
                $('#get-customer-form').modal('toggle')
               
               
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

    }

    function loadAgent()
   {
          //alert($('#agentsearch').val());
        
        $.get('/load-agent-details',
          {

            "search": $('#agentsearch').val()
          },
          function(data)
          { 

            $('#agentTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#agentTable tbody').append('<tr><td><a a href="#" class="text-info" onclick="setAgent(\''+value['id']+'\')">'+ value['agent_name'] +'</a></td><td>'+ value['agent_code'] +'</td><td>'+ value['type'] +'</td></tr>');
            });
                                          
         },'json');      
    }



function setAgent(id)
   {
         
        $.get("/get-agent",
          
          {"id":id},
          function(json)
          {

                 sweetAlert(json.agent_code);
                $('#agent_number').val(json.agent_name);
               
               
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

    }


</script>         

                 
                   

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(function () {
  $('#insurance_period').daterangepicker({
    "minDate": moment('2015-06-14 0'),
    "startDate":  moment(),
    "endDate":  moment().add(1, 'years').subtract(1, 'days'),
    "showDropdowns": true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>


<script type="text/javascript">
$(function () {
   $('#transaction_date').daterangepicker({
    "minDate": moment('2015-06-14 '),
    "maxDate": moment(),
     "singleDatePicker":true,
    "timePicker": true,
    "timePicker24Hour": true,
    "showDropdowns": true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
   $('#issue_date').daterangepicker({
    "minDate": moment('2015-06-14 0'),
    "maxDate": moment(),
     "singleDatePicker":true,
    "showDropdowns": true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
   $('#acceptance_date').daterangepicker({
    "minDate": moment('2015-06-14 0'),
    "maxDate": moment(),
     "singleDatePicker":true,
    "showDropdowns": true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
   $('#survey_date').daterangepicker({
    "minDate": moment('2015-06-14 0'),
    "maxDate": moment(),
     "singleDatePicker":true,
    "showDropdowns": true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>








<script>



function  getproductform() 
{

     //$('#policy_number').val('');   

   if( $('#policy_product').val() == "Motor Insurance")
    {
         $('#motorinsurance').show();
          $('#fireinsurance').hide(); 
          $('#travelinsurance').hide(); 
          $('#personalaccidentinsurance').hide(); 
          $('#bondinsurance').hide();
          $('#marineinsurance').hide();
          $('#liabilityinsurance').hide();
          $('#contractorallrisk').hide();
          $('#generalaccident').hide();
          $('#healthinsurance').hide();
          $('#lifeinsurance').hide();
          $('#motorcharges').show();
          $("motorcharges").prop("disabled", false);
          $('#nonmotorcharges').hide();
           $("nonmotorcharges").prop("disabled", true);
          $('#bonddate').hide();
   }
  else if( $('#policy_product').val() == "Fire Insurance")
    {
         $('#fireinsurance').show();
          $('#motorinsurance').hide(); 
          $('#travelinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#personalaccidentinsurance').hide(); 
           $('#bondinsurance').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
           $('#motorcharges').hide();
           $("motorcharges").prop("disabled", true);
           $('#nonmotorcharges').show();
           $("nonmotorcharges").prop("disabled", false);
           $('#bonddate').hide();
   }
else if( $('#policy_product').val() == "Travel Insurance")
    {
      $('#travelinsurance').show(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#personalaccidentinsurance').hide();
           $('#bondinsurance').hide();
           $('#marineinsurance').hide(); 
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
           $('#motorcharges').hide();
           $("motorcharges").prop("disabled", true);
           $('#nonmotorcharges').show();
           $("nonmotorcharges").prop("disabled", false);
           $('#bonddate').hide();
   
   }

   else if( $('#policy_product').val() == "Personal Accident Insurance")
    {
      $('#personalaccidentinsurance').show();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#bondinsurance').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
           $('#motorcharges').hide();
           $("motorcharges").prop("disabled", true);
           $('#nonmotorcharges').show();
           $("nonmotorcharges").prop("disabled", false);
           $('#bonddate').hide();
   
            
   }
    else if( $('#policy_product').val() == "Bond Insurance")
    {
      $('#bondinsurance').show();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
           $('#motorcharges').hide();
           $("motorcharges").prop("disabled", true);
           $('#nonmotorcharges').show();
           $("nonmotorcharges").prop("disabled", false);
           $('#bonddate').show();
   
            
   }

    else if( $('#policy_product').val() == "Marine Insurance")
    {
      $('#marineinsurance').show();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#liabilityinsurance').hide();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
           $('#motorcharges').hide();
           $("motorcharges").prop("disabled", true);
           $('#nonmotorcharges').show();
           $("nonmotorcharges").prop("disabled", false);
           $('#bonddate').hide();
   
           
            
   }

    else if( $('#policy_product').val() == "Liability Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#liabilityinsurance').show();
           $('#contractorallrisk').hide();
           $('#generalaccident').hide();
           $('#healthinsurance').hide();
           $('#lifeinsurance').hide();
           $('#motorcharges').hide();
           $("motorcharges").prop("disabled", true);
           $('#nonmotorcharges').show();
           $("nonmotorcharges").prop("disabled", false);
           $('#bonddate').hide();
   
           
            
   }

   else if( $('#policy_product').val() == "Engineering Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
      $('#fireinsurance').hide();
      $('#motorinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').show();
      $('#generalaccident').hide();
      $('#healthinsurance').hide();
      $('#lifeinsurance').hide();
      $('#motorcharges').hide();
      $("motorcharges").prop("disabled", true);
      $('#nonmotorcharges').show();
      $("nonmotorcharges").prop("disabled", false);
      $('#bonddate').hide();
   
           
            
   }

   else if( $('#policy_product').val() == "General Accident Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
      $('#fireinsurance').hide();
      $('#motorinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').hide();
      $('#generalaccident').show();
      $('#healthinsurance').hide();
      $('#lifeinsurance').hide();
      $('#motorcharges').hide();
      $("motorcharges").prop("disabled", true);
      $('#nonmotorcharges').show();
      $("nonmotorcharges").prop("disabled", false);
      $('#bonddate').hide();
   
           
            
   }

   else if( $('#policy_product').val() == "Health Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
      $('#fireinsurance').hide();
      $('#motorinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').hide();
      $('#generalaccident').hide();
      $('#healthinsurance').show();
      $('#lifeinsurance').hide();  
      $('#motorcharges').hide();
      $("motorcharges").prop("disabled", true);
      $('#nonmotorcharges').show();
      $("nonmotorcharges").prop("disabled", false);
      $('#bonddate').hide();
      
   }

    else if( $('#policy_product').val() == "Life Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
      $('#fireinsurance').hide();
      $('#motorinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').hide();
      $('#generalaccident').hide();
      $('#healthinsurance').hide();
      $('#lifeinsurance').show();
      $('#motorcharges').hide();
      $("motorcharges").prop("disabled", true);
      $('#nonmotorcharges').show();
       $("nonmotorcharges").prop("disabled", false);
        $('#bonddate').hide();
         
   }

   else if( $('#policy_product').val() == "")
    {
        $('#motorinsurance').hide(); 
        $('#fireinsurance').hide(); 
       $('#motorinsurancecomprehensive').hide();
       $('#travelinsurance').hide(); 
       $('#personalaccidentinsurance').hide(); 
       $('#bondinsurance').hide();
       $('#marineinsurance').hide();
       $('#liabilityinsurance').hide();
       $('#contractorallrisk').hide();
       $('#generalaccident').hide();
       $('#healthinsurance').hide();
       $('#lifeinsurance').hide(); 
       $('#motorcharges').hide();
       $("motorcharges").prop("disabled", true);
       $('#nonmotorcharges').show();
           $("nonmotorcharges").prop("disabled", false);
           $('#bonddate').hide();
      
   }
   else
   {
      $('#motorinsurance').hide(); 
      $('#fireinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#travelinsurance').hide();
      $('#personalaccidentinsurance').hide(); 
      $('#bondinsurance').hide(); 
      $('#marineinsurance').hide();
      $('#liabilityinsurance').hide();
      $('#contractorallrisk').hide();
      $('#generalaccident').hide();
      $('#healthinsurance').hide();
      $('#lifeinsurance').hide();
      $('#motorcharges').hide();
      $("motorcharges").prop("disabled", true);
      $('#nonmotorcharges').show();
           $("nonmotorcharges").prop("disabled", false);
           $('#bonddate').hide();
   


    }
}
</script>

<script>



function getinthousands(event) 
{
    var number = this.value;
    this.value = number.toLocaleString('en');

    alert(this.value);

}


function  getcomprehensiveform() 
{

  //alert($('#policy_product').val());
   if( $('#preferedcover').val() == "Comprehensive")
    {
         
      $('#motorinsurancecomprehensive').show();
      $('#vehicle_value').prop('disabled', false);
      $('#vehicle_buy_back_excess').prop('disabled', false);
      $('#vehicle_tppdl_value').prop('disabled', false);

          $('#vehicle_body_type').prop('disabled', false);
        $('#vehicle_chassis_number').prop('disabled', false);
         $('#vehicle_cubic_capacity').prop('disabled', false);
          $('#vehicle_make_year').prop('disabled', false);
    }

    else if( $('#preferedcover').val() == "Third Party")
    {
     
       $('#motorinsurancecomprehensive').hide();
       $('#vehicle_value').prop('disabled', true);
      $('#vehicle_buy_back_excess').prop('disabled', true);
      $('#vehicle_tppdl_value').prop('disabled', false);

       $('#vehicle_body_type').prop('disabled', true);
        $('#vehicle_chassis_number').prop('disabled', false);
         $('#vehicle_cubic_capacity').prop('disabled', true);
          $('#vehicle_make_year').prop('disabled', true);
      
     }

     else if( $('#preferedcover').val() == "Third Party Fire & Theft")
    {
     
      $('#motorinsurancecomprehensive').hide();
      $('#vehicle_value').prop('disabled', false);
      $('#vehicle_buy_back_excess').prop('disabled', false);
      $('#vehicle_tppdl_value').prop('disabled', false);
      $('#vehicle_body_type').prop('disabled', false);
      $('#vehicle_chassis_number').prop('disabled', false);
      $('#vehicle_cubic_capacity').prop('disabled', false);
      $('#vehicle_make_year').prop('disabled', false);
     }

     else if( $('#preferedcover').val() == "")
    {
     
       $('#motorinsurancecomprehensive').hide();
     }

   else
   {
      $('#motorinsurancecomprehensive').hide();
  }
}
</script>

<script type="text/javascript">
$(document).ready(function () {
    $('#motorinsurance').hide(); 
    $('#fireinsurance').hide(); 
    $('#motorinsurancecomprehensive').hide();
    $('#marineinsurance').hide();
    $('#bondinsurance').hide();
    $('#travelinsurance').hide(); 
    $('#personalaccidentinsurance').hide(); 
    $('#liabilityinsurance').hide();
    $('#generalaccident').hide();
    $('#contractorallrisk').hide();
    $('#healthinsurance').hide();
    $('#lifeinsurance').hide();  
    $('#motorcharges').hide();
    $("motorcharges").prop("disabled", true);
   
    $('#pa_activities').select2();

    $('#property_type').select2({
      tags: true
      });

     $('#property_type_item').select2({
      tags: true
      });

    $('#liability_unit').select2();

    $('#accident_unit').select2();

    $('#property_number_item').select2();

    $('#policy_interest').select2({
      tags: true
      });

     $('#vehicle_model').select2({
      tags: true
      });

      $('#vehicle_make').select2({
      tags: true
      });

       $('#vehicle_body_type').select2({
      tags: true
      });

        $('#fire_peril').select2({
      tags: true
      });


    $('#roofed_with').select2({
      tags: true
      });
    $('#walled_with').select2({
      tags: true
      });
    //$('#customer_number').select2();
    $('#vehicle_body_type').select2({
      tags: true
      });
    $('#policy_clause').select2();
    $('#vehicle_make').select2({
      tags: true
      });
    $('#vehicle_model').select2({
      tags: true
      });
    $('#policy_product').select2();
    $('#policy_branch').select2();
    $('#destination_country').select2();
    $('#agency').select2();
    $('#policy_currency').select2();
    $('#policy_sales_type').select2();
    $('#payment_status').select2();
    $('#policy_sales_channel').select2();

    $('#bond_risk_type').select2();
    $('#fire_risk_covered').select2();
    $('#car_risk_type').select2();
    $('#accident_risk_type').select2();
    $('#liability_risk_type').select2();


     $('#preferedcover').select2();
    $('#vehicle_use').select2();
     $('#vehicle_ncd').select2();
     $('#vehicle_fleet_discount').select2();
     $('#vehicle_risk').select2();
     $('#vehicle_make_year').select2();


    loadInsurer();
    getproductform(); 
    loadProperties();
    loadPropertyItem();
    loadAccidentDetails();
    loadEngineeringDetails();
    loadBondDetails();
    loadMarineDetails();
    loadPerilsApplied();

    $("#formid").submit(function() 
         {      
             $(".masterform").val("");//for all textboxes having class "textbox" 
         });
     

   // $('#item').priceFormat();



  });
</script>


<script type="text/javascript">

function fillmandatory()
{
  if($('#customer_number').val()=="")
  {sweetAlert("Please select a customer ",'Fill all fields', "error");}
  
   else if($('#policy_insurer').val()=="")
  {sweetAlert("Please select an insurer ",'Fill all fields', "error");}

  else if($('#policy_product').val()=="")
  {sweetAlert("Please select a product",'Fill all fields', "error");}

   else if($('#policy_type').val()=="")
  {sweetAlert("Please select excess ",'Fill all fields', "error");}



}



function computePremium()
{

  if($('#preferedcover').val()=="")
  {sweetAlert("Please select cover ",'Fill all fields', "error");}
  else if($('#vehicle_value').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Enter vehicle value ",'Fill all fields', "error");}
  else if($('#vehicle_currency').val()=="")
  {sweetAlert("Please select currency ",'Fill all fields', "error");}
 else if($('#vehicle_buy_back_excess').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Please select excess ",'Fill all fields', "error");}
else if($('#vehicle_use').val()=="")
  {sweetAlert("Please select use ",'Fill all fields', "error");}
else if($('#vehicle_risk').val()=="")
  {sweetAlert("Please select risk ",'Fill all fields', "error");}
else if($('#vehicle_seating_capacity').val()=="")
  {sweetAlert("Please enter seat number ",'Fill all fields', "error");}
else if($('#vehicle_cubic_capacity').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Please enter cubic capacity ",'Fill all fields', "error");}
else if($('#vehicle_ncd').val()=="")
  {sweetAlert("Please select ncd ",'Fill all fields', "error");}
else if($('#vehicle_fleet_discount').val()=="")
  {sweetAlert("Please select fleet discount ",'Fill all fields', "error");}
  else
  {
    $.get('/compute-motor',
        {

         // alert($('#agency').val());
       
          "policy_sales_type": $('#policy_sales_type').val(),
          "preferedcover": $('#preferedcover').val(),
          "vehicle_value": $('#vehicle_value').val(),
          "vehicle_currency": $('#vehicle_currency').val(),
          "vehicle_buy_back_excess": $('#vehicle_buy_back_excess').val(),
          "vehicle_use":  $('#vehicle_use').val(),
          "vehicle_tppdl_value":  $('#vehicle_tppdl_value').val(),
          "vehicle_risk":  $('#vehicle_risk').val(),
          "vehicle_make_year":  $('#vehicle_make_year').val(),
          "vehicle_seating_capacity":  $('#vehicle_seating_capacity').val(), 
          "vehicle_cubic_capacity":  $('#vehicle_cubic_capacity').val(),
          "vehicle_ncd":  $('#vehicle_ncd').val(),      
          "insurance_period":  $('#insurance_period').val(), 
          "vehicle_fleet_discount":  $('#vehicle_fleet_discount').val()


        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
          sweetAlert("Premium Payable : ", data["Premium"], "info");
          $('#gross_premium').val(data.gross_premium);
          $('#premium_due_motor').val(data.Premium);
          $('#commission_rate').val(data.commission);

          $('#contribution').val(data.contribution);
          $('#loading').val(data.loading);
          $('#netpremium').val(data.netpremium);
          $('#ncd').val(data.ncd);
          $('#fleet').val(data.fleet);
          $('#ccage').val(data.ccage);
          $('#officepremium').val(data.officepremium);
          $('#tpbasic').val(data.tpbasic);
          $('#owndamage').val(data.owndamage);
          $('#suminsured').val(data.suminsured);  

          $('#execessbought').val(data.execessbought); 
          $('#excess_charge_rate').val(data.excess_charge_rate);           
       
      });
                                        
        },'json');
  }
}
  
</script>

<script type="text/javascript">
      function loadNCD()
   {
    

        $.get('/load-ncd-rate',
          {
            "vehicle_use": $('#vehicle_use').val()
          },
          function(data)
          { 

            $('#vehicle_ncd').empty();
            $.each(data, function () 
            {           
            $('#vehicle_ncd').append($('<option></option>').val(this['rate']).html(this['type']));
            });
                                          
         },'json');      
    }

</script>

<script type="text/javascript">
      function loadRisk()
   {
         
        
        $.get('/load-risk',
          {
            "vehicle_use": $('#vehicle_use').val()
          },
          function(data)
          { 

            $('#vehicle_risk').empty();
            $.each(data, function () 
            {           
            $('#vehicle_risk').append($('<option></option>').val(this['risk']).html(this['risk']));
            });
                                          
         },'json');      
    }
</script>

<script type="text/javascript">

    function vehicleexiststatus()
    {

      $.get('/get-vehicle-availability',
        {
          "vehicle_registration_number": $('#vehicle_registration_number').val()    

        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
           $('#vehicle_registration_number').val('');
          sweetAlert("Vehicle "+ $('#vehicle_registration_number').val() +" already exist in system!");
         
        }
        else
        {
          //sweetAlert("Drug failed to be added!");
        }
      });
                                        
        },'json');


    }


    function checkCustomerType()
    {

      
     //alert($('#policy_product').val());

      // if($('#policy_product').val()=="Bond Insunrace" && $('#customer_type').val()=="Individual")
      // {

      //      $('#policy_product').val('');
      //      sweetAlert("You cannot create a " +  $('#policy_product').val() +" policy for this customer !");
      // }

      // else
      // {

      // }



    }


    function loadRiskNumber()
    {


        $.get('/load-risk-number',
          {
            "policy_number": $('#policy_number').val()
          },
          function(data)
          { 

            $('#property_number_item').empty();
            $.each(data, function () 
            {           
            $('#property_number_item').append($('<option></option>').val(this['risk_number']).html(this['risk_number']));
            });
                                          
         },'json');      


    }

      function loadIntermediary()
   {
         
        
        $.get('/load-intermediary',
          {
            "policy_sales_type": $('#policy_sales_type').val()
          },
          function(data)
          { 

            $('#agency').empty();
            $.each(data, function () 
            {           
            $('#agency').append($('<option></option>').val(this['agentname']).html(this['agentname']));
            });
                                          
         },'json');      
    }
</script>

<script type="text/javascript">
      function loadModels()
   {
         
        
        $.get('/load-vehicle-model',
          {
            "vehicle_make": $('#vehicle_make').val()
          },
          function(data)
          { 

            $('#vehicle_model').empty();
            $.each(data, function () 
            {           
            $('#vehicle_model').append($('<option></option>').val(this['model']).html(this['model']));
            });
                                          
         },'json');      
    }
</script>

<script type="text/javascript">
      function loadInsurer()
   {
         
        
        $.get('/load-insurer',
          {
            "policy_type": $('#policy_type').val()
          },
          function(data)
          { 

            $('#policy_insurer').empty();
            $.each(data, function () 
            {           
            $('#policy_insurer').append($('<option></option>').val(this['name']).html(this['name']));
            });
                                          
         },'json');      
    }
</script>

<script type="text/javascript">
      function loadinsurancetype()
   {
         
        
        $.get('/load-product',
          {
            "policy_type": $('#policy_type').val()
          },
          function(data)
          { 

            $('#policy_product').empty();
            $.each(data, function () 
            {           
            $('#policy_product').append($('<option></option>').val(this['type']).html(this['type']));
            });
                                          
         },'json');      
    }
</script>
<script type="text/javascript">
$(function () {
  $('#departure_date').daterangepicker({
     "minDate": moment('2010-06-14'),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
  $('#voyage_date').daterangepicker({
     "minDate": moment('2010-06-14'),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
  $('#vehicle_register_date').daterangepicker({
     "minDate": moment('2010-06-14'),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
  $('#vehicle_lta_upload').daterangepicker({
     "minDate": moment('2010-06-14'),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
  $('#vehicle_lta_transmission').daterangepicker({
     "minDate": moment('2010-06-14'),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
  $('#vehicle_register_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>




