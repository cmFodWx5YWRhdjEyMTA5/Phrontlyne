
@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Appointment Manager</div>
              <ul class="nav">
              <li class="b-b b-light"><a href="/event-list"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Appointments</a></li>
              <li class="b-b b-light"><a href="/event-calendar"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Calendar</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                        <a href="#modal_create_event"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"><i class="fa fa-group"></i> Create New</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found : {{ $events->total() }} {{ str_plural('Event', $events->total()) }} </span>
                    </div>

                  <form action="/patient.find" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a patient">
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
                     
                        @if($events->count() > 0)
			<table class="table table-striped m-b-none">
			<thead>
				<tr>
					<th>#</th>
          <th>Patient Name / Phone No.</th>
					<th>Appointment Title</th>
					<th>Start</th>
					<th>End</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 1;?>
			@foreach($events as $event)
				<tr>
					<th scope="row">{{ $i++ }}</th>
          <td><a href="{{ url('events/' . $event->id) }}">{{ $event->name }}</a></td>
					<td><a href="{{ url('events/' . $event->id) }}">{{ $event->title }}</a></td>
					<td>{{ date("g:ia\, jS M Y", strtotime($event->start_time)) }}</td>
					<td>{{date("g:ia\, jS M Y", strtotime($event->end_time)) }}</td>
					 <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteappointment('{{ $event->id }}','{{ $event->title }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
           </td>
				</tr>
			@endforeach
			</tbody>
		</table>
		@else
			<h2>No event yet!</h2>
		@endif
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
                     
                        {!!$events->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

  <div class="modal fade" id="modal_create_event" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Appointment</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/create-event" class="panel-body wrapper-lg">
                          @include('event/create')
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


<script type="text/javascript">
$(function () {
	$('#modal_create_event input[name="time"]').daterangepicker({
		"minDate": moment('2016-06-14 0'),
		"timePicker": true,
		"timePicker24Hour": true,
		"timePickerIncrement": 15,
		"autoApply": true,
		"locale": {
			"format": "DD/MM/YYYY HH:mm:ss",
			"separator": " - ",
		}
	});
});
</script>

<script >
function deleteappointment(id,name)
  {

      //alert(id);

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
          $.get('/delete-appointment',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully deleted from store.", "success"); 
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
  </script>


