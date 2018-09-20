@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li >Reports</li>
                <li class="active">Renewal Notice </li>
              </ul>
            
              <div class="col-lg-12">
                  <h2 class="font-thin">Renewal Notice </h2>
                </div>
                
              <div class="row">
              <div class="col-sm-12">
               <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Renewal Notice 
                </header>
                <div class="panel-body">
                  <form id="claimsheet" class="form-horizontal" action="/claim-form-bulk" method="get" >
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Date From</label>
                      <div class="col-sm-10">
                        <input type="text" id="datefrom" name="datefrom" value="" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Date To</label>
                      <div class="col-sm-10">
                        <input type="text" id="dateto" name="dateto" value="" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Business Class</label>
                      <div class="col-sm-10">
                        <select id="business_class" name="business_class" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                          <option value=""> -- Select Business Class -- </option>
       {{--                    @foreach($providers as $provider)
                        <option value="{{ $provider->care_provider }}">{{ $provider->care_provider }}</option>
                          @endforeach --}}
                        </select>                        
                      </div>
                    </div>
  <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Branch</label>
                      <div class="col-sm-10">
                        <select id="branch" name="branch" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                          <option value=""> -- Select Branch -- </option>
       {{--                    @foreach($providers as $provider)
                        <option value="{{ $provider->care_provider }}">{{ $provider->care_provider }}</option>
                          @endforeach --}}
                        </select>                        
                      </div>
                    </div>
  <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Use</label>
                      <div class="col-sm-10">
                        <select id="vehicle_use" name="vehicle_use" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                          <option value=""> -- Select Use -- </option>
       {{--                    @foreach($providers as $provider)
                        <option value="{{ $provider->care_provider }}">{{ $provider->care_provider }}</option>
                          @endforeach --}}
                        </select>                        
                      </div>
                    </div>
  <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Source</label>
                      <div class="col-sm-10">
                        <select id="source" name="source" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                          <option value=""> -- Select Source -- </option>
       {{--                    @foreach($providers as $provider)
                        <option value="{{ $provider->care_provider }}">{{ $provider->care_provider }}</option>
                          @endforeach --}}
                        </select>                        
                      </div>
                    </div>
  <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Cover Type</label>
                      <div class="col-sm-10">
                        <select id="cover_type" name="cover_type" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                          <option value=""> -- Select Cover Type -- </option>
       {{--                    @foreach($providers as $provider)
                        <option value="{{ $provider->care_provider }}">{{ $provider->care_provider }}</option>
                          @endforeach --}}
                        </select>                        
                      </div>
                    </div>


                     <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Generate Notices</button>
                      </footer>

                    </form>
                    </div>
                    </section>
                    </div>

              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(document).ready(function () {
   
    $('#insurance_cover').select2({
      tags: true
      });
        

  });
</script>

<script type="text/javascript">
$(function () {
  $('#datefrom ').daterangepicker({
     "minDate": moment('1930-06-14'),
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

<script type="text/javascript">
$(function () {
  $('#dateto ').daterangepicker({
     "minDate": moment('1930-06-14'),
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


