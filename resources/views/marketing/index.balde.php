@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Sale & Marketing Portal </li>
              </ul>
             
              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/214325.svg" width="15%"  class="pull-left">
                    <a class="clear" href="/expired-policies">
                      <span class="h3 block m-t-xs"><strong></strong></span>
                      <small class="text-muted text-uc">Renewals</small>
                    </a>
                   
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/230315.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Intermediary</small>
                    </a>
                  </div>
                 <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/544561.svg" width="15%" class="pull-left">

                    <a class="clear" href="/online-policies/new">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Reports</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/686546.svg" width="15%" class="pull-left">


                    </span>
                    <a class="clear" href="/expired-policies">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Appointments</small>
                    </a>
                  </div>
                </div>
              </section>


              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-renewal" method="GET">


                      <div class="input-group text-ms">
                        
                        <div class="col-md-8">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by policy number, insured, registration number">
                        </div>
                       
                         <div class="col-md-4">
                        <input type="text" name='insurance_period' id='insurance_period' class="input-sm form-control" placeholder="Search by patient, test, status">
                        </div>

                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search Policy!</button>
                        </div>
                      </div>



                      </form>

                    </header>
                    <div class="table-responsive">

                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th>Policy #</th>
                            <th>Object #</th>
                            <th>@sortablelink('fullname')</th>
                            <th>Validity </th>
                            <th>Policy Type</th>
                            <th>Created By</th>
                           <th>Created On</th>
                            <th>Status</th>
                             
                           {{--  <th width="30"></th> --}}
                            <th width="30"></th>
                              <th width="30"></th>
                            
                           
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $policies as $key => $policy )
                          <tr>
                           <td>{{ ++$key }}</td>
                            @if($policy->insurance_period_to < Carbon\Carbon::now())
                            
                              <td><a href="/view-policy/{{ $policy->policy_number }}" class="text-danger">{{ $policy->policy_number }}</a></td>
                            @else
                           <td><a href="/view-policy/{{ $policy->policy_number }}" class="text-info">{{ $policy->policy_number }}</a></td>
                            @endif
                             <td><a href="/customer-profile/{{ $policy->account_number }}" class="text-default">{{ $policy->itemid }}</a></td>
                             <td><a href="/customer-profile/{{ $policy->account_number }}" class="text-default">{{ $policy->fullname }}</a></td>
                            <td width="200">{{Carbon\Carbon::parse($policy->insurance_period_from )->format('d-m-Y') }} to {{ Carbon\Carbon::parse($policy->insurance_period_to )->format('d-m-Y') }}</td>
                           
                            <td>{{ $policy->policy_product }}</td>
                             <td>{{ $policy->created_by }}</td> 
                             <td>{{ $policy->created_on }}</td> 
                           <td>Awaiting Renewal</td> 
                          

                            <td>
                            <a href="/renew-policy/{{ $policy->id }}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-refresh"></i></a>
                             </td>
                             <td>
                            <a href="/print-notice/{{ $policy->id }}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a>
                             </td>
                            
                             
                          
                          
                          </tr>
                         @endforeach 
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                </section>
                </div>
              </div>

            </section>
             <footer class="footer bg-white b-t">
                  

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $policies->total() }} {{ str_plural('Policy', $policies->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!!$policies->appends(\Request::except('page'))->render()!!}
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

@stop

<script type="text/javascript">
  function removePolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from policy list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from policy list.", "error");   
        } });

    
   }
</script>
<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(function () {
  $('#insurance_period').daterangepicker({
    "minDate": moment('2015-06-14 0'),
    "startDate":  moment(),
    "endDate":  moment().add(1, 'month').subtract(1, 'days'),
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 15,
    "showDropdowns": true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>






