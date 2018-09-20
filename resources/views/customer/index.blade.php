@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Manage Customer </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                     <img src="/images/189073.svg" width="15%"  class="pull-left">
                    <a class="clear" href="/active-customer"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>{{ $customers->total() }}</strong></span>
                      <small class="text-muted text-uc">Active Customer</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                   <img src="/images/265742.svg" width="15%"  class="pull-left">
                    <a class="clear" href="/inactive-customer">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Inactive Customer</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/755176.svg" width="15%"  class="pull-left">
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Registered Companies</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/444992.svg" width="15%"  class="pull-left">
                    <a class="clear" href="/event-list">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Appointments</small>
                    </a>
                  </div>

                 
                </div>
              </section>
              <div class="row">
                <div class="col-md-12">
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-customer" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by customer, phone, type">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search!</button>
                        </div>
                      </div>
                      </form>
                    </header>
                    <div class="table-responsive">

                     <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Customer # </th>
                            <th>@sortablelink('fullname')</th>
                            <th>Address</th>
                            <th>Phone #</th>
                            <th>Created On</th>
                            <th>Managed By</th>
                             @permission('edit-customer')
                            <th width="5"></th>
                            <th width="5"></th>
                             <th width="5"></th> 
                              <th width="5"></th>
                               <th width="5"></th>
                            @endpermission
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $customers as $customer )
                          <tr>
                             <td><a href="/customer-profile/{{ $customer->account_number }}">{{ $customer->account_number }}</a></td>
                            <td><a href="/customer-profile/{{ $customer->account_number }}">{{ ucwords(strtolower($customer->fullname)) }}</a></td>
                            <td>{{ ucwords(strtolower($customer->postal_address)) }}</td>
                            <td>{{ $customer->mobile_number }}</td>
                            <td>{{ $customer->created_on }}</td>
                            <td>{{ $customer->created_by }}</td>
                            
                             <td>
                              <a href="/online-policies/new/{{ $customer->account_number }}" data-toggle="modal" class="bootstrap-modal-form-open"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="" data-original-title="Create New Policy"></i></a>  
                             </td>
                            <td>
                            @if(!$customer->id == null)
                            <a href="#edit_customer" data-toggle="modal" class="bootstrap-modal-form-open" onclick="setAccountNo('{{ $customer->id }}')"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Account"></i></a>
                            @else
                            
                            @endif
                             </td>
                            <td>
                            <a  href="#attach_document" data-toggle="modal" class="bootstrap-modal-form-open" onclick="showidonModal('{{$customer->id}}')"><i class="fa fa-cloud-upload" data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Document(s)"></i></a>
                            </td>
                              <td>
                            <a  href="#" class="" onclick="deletecustomer('{{$customer->id}}','{{ $customer->fullname }}')"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Account"></i></a>
                            </td> 
                             <td>
                             @if($customer->status == 'Active')
                              <a href="#" class="" onclick="deactivate('{{ $customer->id }}','{{ $customer->fullname }}')" data-toggle="class"><i class="fa fa-thumbs-down" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactive"></i> </a>
                              @else
                             <a href="#" class="" onclick="activate('{{ $customer->id }}','{{ $customer->fullname }}')" data-toggle="class"><i class="fa fa-thumbs-up" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate Account"></i></a>
                             @endif
                            </td>
                          
                           
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
                  
                  <a href="#new-customer" class="bootstrap-modal-form-open float" data-toggle="modal">
<i class="fa fa-plus my-float"></i><i class="fa fa-user my-float"></i>
</a>
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $customers->total() }} {{ str_plural('Customer', $customers->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                         {!!$customers->appends(\Request::except('page'))->render()!!}
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

@stop









<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<div class="modal fade" id="attach_document" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Attach Document</h4>
        </div>

        <div class="modal-body">
         <div class="fallback">
          <form method="post"  enctype="multipart/form-data" action="/upload-document">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
         <input type="hidden" name="selectedid" id="selectedid" value=""> 
        </form>
        </div>
          <br>
          <br>
          <br>
              <div class="jumbotron how-to-create">
                <ul>
                    <li>Documents/Images are uploaded as soon as you drop them</li>
                    <li>Maximum allowed size of image is 8MB</li>
                </ul>

            </div>

      </div>
      </div>
      </div>
      </div>


  <div class="modal fade" id="new-customer" size="600">
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
                        <div class="tab-pane active" id="individual2">
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
                    
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->



<script type="text/javascript">
$(document).ready(function () {
   
     $('#field_of_activity').select2({
      tags: true
      });

     $('#account_manager').select2({
      tags: true
      });


     $('#individualname').show();
     $('#businessname').hide();
     $('#individualid').hide();
   
     
  });
</script>
  
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
                $('#edit_customer img[name="imagePreview"]').attr("src", '/images/avatar_default.jpg');
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


  function notbusiness()
{
  if($('#account_type').val() != "Individual")
   {
     $('#businessname').show();
      $('#individualname').hide();
      $('#individualid').hide();

       $('#firstname').val('');
       $('#surname').val('');
       $('#lastname').val('');

       $('#firstname').val('NA');
       $('#surname').val('NA');
       $('#lastname').val('NA');



   }

   else
   {
     $('#businessname').hide();
      $('#individualname').show();
      $('#individualid').show();

      $('#companyname').val('');
      $('#companyname').val('NA');
   }

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

 











