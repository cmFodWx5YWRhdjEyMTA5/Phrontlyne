@extends('layouts.default')
@section('content')

        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Customer Manager</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="/active-customer"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Active Customers</a></li>
                <li class="b-b b-light"><a href="/inactive-customer"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Deactivated Customers</a></li>
                 <li class="b-b b-light"><a href="/pending-customer"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Pending Approval</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                     
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-upload"></i> Upload</a>
                      <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-file"></i> File</a>
                      <a href="#modal_client"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"><i class="fa fa-group"></i> Create New Customer</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found : {{ $customers->total() }} {{ str_plural('Customer', $customers->total()) }}</span>
                    </div>

                  <form action="/find-customer" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a customer">
                        <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="submit">Go!</button>
                        </span>
                      </div>
                    </div>
                     </form>
                  </div>
                  </div>
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                           @permission('edit-customer')
                            <th width="5"></th>
                            <th width="5"></th>
                             <th width="5"></th>
                              <th width="5"></th>
                            @endpermission
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone #</th>
                            <th>Created On</th>
                            <th>Managed By</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $customers as $customer )
                          <tr>
                            @permission('edit-customer')
                            <td>
                            @if(!$customer->id == null)
                            <a href="#edit_customer" data-toggle="modal" class="bootstrap-modal-form-open" onclick="setAccountNo('{{ $customer->id }}')"><i class="fa fa-pencil"></i></a>
                            @else
                            
                            @endif
                             </td>
                            <td>
                            <a  href="#attach_document" data-toggle="modal" class="bootstrap-modal-form-open" onclick="showidonModal('{{$customer->id}}')"><i class="fa fa-cloud-upload"></i></a>
                            </td>
                              <td>
                            <a  href="#" class="" onclick="deletecustomer('{{$customer->id}}','{{ $customer->fullname }}')"><i class="fa fa-trash"></i></a>
                            </td>
                             <td>
                             @if($customer->status == 'Active')
                              <a href="#" class="" onclick="deactivate('{{ $customer->id }}','{{ $customer->fullname }}')" data-toggle="class" ><i class="fa fa-thumbs-down" ></i> </a>
                              @else
                             <a href="#" class="" onclick="activate('{{ $customer->id }}','{{ $customer->fullname }}')" data-toggle="class"><i class="fa fa-thumbs-up"></i></a>
                             @endif
                            </td>
                          
                            @endpermission

                            <td><a href="/customer-profile/{{ $customer->id }}" class="text-default">{{ $customer->fullname }}</a></td>
                            <td>{{ $customer->postal_address }}</td>
                            <td>{{ $customer->mobile_number }}</td>
                            <td>{{ $customer->created_on }}</td>
                            <td>{{ $customer->account_manager }}</td>
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                </section>

                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!!$customers->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>

            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop




  <div class="modal fade" id="modal_client" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Customer</h4>
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
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/create-customer">
                           @include('customer/create')
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

  <div class="modal fade" id="edit_customer" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Customer</h4>
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
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" enctype="multipart/form-data" action="/update-customer">
                           @include('customer/edit')
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

  </div>

    
  
<script>

var account_no = null;
function setAccountNo(id)
{ 

  $.get("/edit-customer",
          {"id":id},
          function(json)
          {
            

                $('#edit_customer input[name="account_number"]').val(json.account_number);
                $('#edit_customer input[name="fullname"]').val(json.fullname);
                $('#edit_customer select[name="account_type"]').val(json.account_type);
                $('#edit_customer textarea[name="residential_address"]').val(json.residential_address);
                $('#edit_customer textarea[name="postal_address"]').val(json.postal_address);
                $('#edit_customer input[name="date_of_birth"]').val(json.date_of_birth);
                $('#edit_customer input[name="email"]').val(json.email);
                $('#edit_customer select[name="account_manager"]').val(json.account_manager);
                $('#edit_customer input[name="field_of_activity"]').val(json.field_of_activity);
                $('#edit_customer input[name="mobile_number"]').val(json.mobile_number);
                $('#edit_customer select[name="sales_channel"]').val(json.sales_channel);
                $('#edit_customer select[name="gender"]').val(json.gender);
                $('#edit_customer img[name="imagePreview"]').attr("src", '/images/'+json.image);
                $('#edit_customer input[name="image"]').val(json.image);
                 
               


                
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
          $.get('/deactivate-customer',
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

function deletecustomer(id,name)
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
          $.get('/delete-customer',
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
          $.get('/activate-customer',
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

 











