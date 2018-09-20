@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Finance Station </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/265671.svg" width="15%" class="pull-left">
                    <a class="clear" href="/agent-list-agent"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Agents</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/858069.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/agent-list-broker">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Brokers</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/265686.svg" width="15%" class="pull-left">
                    <a class="clear" href="/agent-list-bank">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Banks</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/839847.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/#">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Reports</small>
                    </a>
                  </div>

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">


                  {{-- <header class="panel-heading">
                    <form action="/find-bill" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by patient, insurance, encounter">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search!</button>
                        </div>
                      </div>
                      </form>
                    </header> --}}

                    <header class="panel-heading">
                    <form action="/find-agent" method="GET">
                      <div class="input-group text-ms">
                        
                        <div class="col-md-12">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by agent name,id or type">
                        </div>
                       
                       
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search List!</button>
                        </div>
                      </div>
                      </form>
                    </header>


                    <div class="table-responsive">

                    <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Registered On</th>   
                            <th width="20"></th>
                            <th width="20"></th> 
                            <th width="20"></th>  
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $agents as $agent )
                          <tr>
                           
                            <td><a href="/agency-profile/{{ $agent->agentcode }}" class="text-info">{{ $agent->agentcode }}</a></td>
                            <td>{{ $agent->agentname }}</td>
                            <td>{{ ucwords(strtolower(str_limit($agent->address,30))) }}</td>
                            <td>{{ $agent->phone_number }}</td>
                            <td>{{ $agent->contract_type }}</td>
                            <td>{{ $agent->created_on }}</td>
                            <td>
                              <a href="#" class="active" onclick="deactivateAccount('{{ $agent->id }}')" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                              <td><a href="#edit-agent" class="bootstrap-modal-form-open" onclick="editAgent('{{ $agent->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td>
                            <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteAgent('{{ $agent->id }}','{{ $agent->agentname }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td>
                            
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                  </section>
         
                </div>
              </div>

            </section>
             <footer class="footer bg-white b-t">
                    <a href="#new-agent" class="bootstrap-modal-form-open float" data-toggle="modal">
              <i class="fa fa-plus my-float"></i><i class="fa fa-user my-float"></i>
              </a>

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $agents->total() }} {{ str_plural('Intermdairy', $agents->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                      {!!$agents->render()!!} 
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop




  <div class="modal fade" id="new-agent" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Agent</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-parsley-validate="" method="post" action="/create-agent">
                           @include('agents/create')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="edit-agent" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Agent</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-parsley-validate="" method="post" action="/update-agent">
                           @include('agents/edit')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>




<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script>

var account_no = null;
function editAgent(id)
{ 

  $.get("/edit-agent",
          {"id":id},
          function(json)
          {
            
                $('#edit-agent input[name="account_number"]').val(json.account_number);
                $('#edit-agent input[name="fullname"]').val(json.fullname);
                $('#edit-agent select[name="account_type"]').val(json.account_type);
                $('#edit-agent textarea[name="residential_address"]').val(json.residential_address);
                $('#edit-agent textarea[name="postal_address"]').val(json.postal_address);
                $('#edit-agent input[name="date_of_birth"]').val(json.date_of_birth);
                $('#edit-agent input[name="license_number"]').val(json.license_number);
                $('#edit-agent input[name="license_date"]').val(json.license_date);
                $('#edit-agent input[name="appointment_date"]').val(json.appointment_date);

                $('#edit-agent input[name="email"]').val(json.email);
                $('#edit-agent select[name="account_manager"]').val(json.account_manager);
                $('#edit-agent input[name="field_of_activity"]').val(json.field_of_activity);
                $('#edit-agent input[name="mobile_number"]').val(json.mobile_number);
                $('#edit-agent select[name="sales_channel"]').val(json.sales_channel);
                $('#edit-agent select[name="gender"]').val(json.gender);
                 
                            
              //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}
</script>

<script >
function deactivate(id,name)
  {

         
      swal({   
        title: "Are you sure?",   
        text: "Do you want to deactivate "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, deactivate it!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/deactivate-agent',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully deactivated.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to deactivate.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
             
        else {     
          swal("Cancelled", name +" failed to deactivate.", "error");   
        } });

  }

function deleteAgent(id,name)
  {

         
      swal({   
        title: "Are you sure?",   
        text: "Do you want to delete "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-agent',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully deleted.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to delete.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to delete.", "error");   
        } });

  }

  function activate(id,name)
  {

        //alert(id,name);
      swal({   
        title: "Are you sure?",   
        text: "Do you want to activate "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, activate it!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/activate-agent',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was activated successully.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to activate.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to activate.", "error");   
        } });

  }
</script>

<script type="text/javascript">
$(function () {
  $('#license_date').daterangepicker({
    "minDate": moment('1950-06-14 0'),
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
  $('#date_of_birth').daterangepicker({
    "minDate": moment('1950-06-14 0'),
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
  $('#appointment_date').daterangepicker({
    "minDate": moment('1950-06-14 0'),
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




