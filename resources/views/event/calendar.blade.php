@extends('layouts.default')
@section('content')
<section id="content">
          <section class="hbox stretch">          
            <!-- .aside -->
            <aside>
              <section class="vbox">
                <section class="scrollable wrapper">
                  <section class="panel panel-default">
                    <header class="panel-heading bg-light clearfix">
                      <div class="btn-group pull-right" data-toggle="buttons">
                        <label class="btn btn-sm btn-bg btn-default active" id="monthview">
                          <input type="radio" name="options">Month
                        </label>
                        <label class="btn btn-sm btn-bg btn-default" id="weekview">
                          <input type="radio" name="options">Week
                        </label>
                        <label class="btn btn-sm btn-bg btn-default" id="dayview">
                          <input type="radio" name="options">Day
                        </label>
                      </div>
                      <span class="m-t-xs inline">
                        Fullcalendar
                      </span>
                    </header>
                    <div class="calendar" id="calendar">

                    </div>
                  </section>
                </section>
              </section>
            </aside>
            <!-- /.aside -->
            <!-- .aside -->
            <aside class="aside-lg b-l">
              <div class="padder">
                <h5>Dragable events</h5>
                <div class="line"></div>
                <div id="myEvents" class="pillbox clearfix m-b no-border no-padder">
                  <ul>
                    <li class="label bg-dark">Appointments</li>
                    <li class="label bg-info">Follow ups</li>
                    <input type="text" placeholder="add an event">
                  </ul>
                </div>
                <div class="line"></div>
                <div class="checkbox">
                  <label class="checkbox-custom"><input type='checkbox' id='drop-remove' /><i class="fa fa-square-o"></i> remove after drop</label>
                </div>
                <div>
                <a href="#modal_create_event"  data-toggle="modal" class="btn btn-sm btn-info bootstrap-modal-form-open"> <i class="fa fa-plus"></i>  Add New Appointment</a>
                </div>
                <div class="line"></div>
                 <div>
                <a href="/event-list"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"> <i class="fa fa-file"></i>  Show All Appointment</a>
                </div>
                  
              </div>
            </aside>
            <!-- /.aside -->
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
    @stop

  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
  <script src="{{ asset('/event_components/bootstrap.min.js')}}"></script>
  <script src="{{ asset('/event_components/fullcalendar.min.js')}}"></script>
  <script src="{{ asset('/event_components/moment.min.js')}}"></script>


<script type="text/javascript">
  $(document).ready(function() {
    
    var base_url = '{{ url('/') }}';

    $('#calendar').fullCalendar({
      weekends: true,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: {
        url: '/event/api',
        error: function() {
          alert("cannot load json");
        }
      }
    });
  });
</script>



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