
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Whatsapp Administration </li>
              </ul>
             
             


              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="#" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by policy, insurer, customer, cover, status">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-dark" type="submit">Search!</button>
                        </div>
                      </div>
                      </form>
                    </header>
                    <div class="table-responsive">

                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th>Phone #</th>
                             <th>Name</th>
                            <th>Content #</th>
                            <th>Status</th>
                             <th></th>
                           
                          </tr>
                        </thead>
                         @foreach($policies as $keys => $message)
                        <tbody>
                       
                        <td>{{ ++$keys}}</td>
                        <td>{{ $message->phone_number}}</td>
                        <td>{{ $message->name}}</td>
                        <td>{{ $message->sms_details}}</td>
                        <td>{{ $message->status}}</td>
                        <td> <a href="http://web.whatsapp.com//send?text={{ $message->sms_details}} Phoenix Insurance. Wisdom!&phone=233{{$message->phone_number}}" onClick="changeWhatsappStatus('{{ $message->id }}')" target="_new" class="btn btn-s-md btn-danger btn-rounded"  data-toggle="modal" alt="edit">Send Message</a> </td>


                        
                       
                        </tbody>
                         @endforeach
 
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
                      <span class="badge badge-info">Record(s) Found : {{ $policies->total() }} {{ str_plural('Messages', $policies->total()) }}</span>
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

 <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
  

  function changeWhatsappStatus(id)
{
  //alert(status);

    $.get('/update-whatsapp-status',
        {
          "id": id,
                             
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          location.reload(true);
           toastr.success("Message sent!");
           
        }
        else
        {
          toastr.error("Error updating message!");
        }
      });
                                        
        },'json');
  }
</script>





