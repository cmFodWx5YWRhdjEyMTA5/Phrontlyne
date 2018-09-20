@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Reinsurance </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">

                   <img src="/images/258401.png" width="15%" class="pull-left">
                    <a class="clear" href="/reinsurance-businesses"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>{{ $pendingcount }}</strong></span>
                      <small class="text-muted text-uc">Pending FAC Businesses for placement</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/272370.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="reinsurance-ceded-businesses">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{ $cededcount }}</strong></span>
                      <small class="text-muted text-uc">Ceded FAC Businesses</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/138285.svg" width="15%" class="pull-left">
                    <a class="clear" href="/insurance-claims">
                      <span class="h3 block m-t-xs"><strong></strong></span>
                      <small class="text-muted text-uc">Claim Recoveries</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/230363.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/treaty-businesses">
                      <span class="h3 block m-t-xs"><strong id="bugs"></strong></span>
                      <small class="text-muted text-uc">Treaty</small>
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
                    <form action="/find-reinsurance" method="GET">
                      <div class="input-group text-ms">
                        
                        <div class="col-md-8">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by insured, business class, item id, policy number, status">
                        </div>
                       
                         <div class="col-md-4">
                        <input type="text" name='review_period' id='review_period' class="input-sm form-control" placeholder="Search by patient, test, status">
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
                           <th></th>
                          <th>Month Placed</th>
                            <th>Policy #</th>
                            <th>Name</th>
                            <th>Item ID</th>
                            <th>Insurance Period</th>
                            <th>Cover Type</th>
                            <th>Currency</th> 
                            <th>Sum Insured</th> 
                            <th>Debit</th>
                             <th width="20"></th>
                            <th width="20"></th>           
                          </tr>
                        </thead>
                        <tbody>
                           @foreach( $reinsurances  as $key => $reinsurance)


                       

                            <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ Carbon\Carbon::parse($reinsurance->record_date)->format('FY') }}</td>
                            <td>{{ $reinsurance->master_policy_number }}</td>
                            
                            <td>{{ str_limit($reinsurance->fullname,30) }}</td>
                            <td>{{ str_limit($reinsurance->item_id,30) }}</td>
                            <td>{{ Carbon\Carbon::parse($reinsurance->period_from)->format('Y-m-d') }} to {{ Carbon\Carbon::parse($reinsurance->period_to)->format('Y-m-d') }}</td>
                            <td>{{ str_limit($reinsurance->cover_type,20) }}</td>
                            <td>{{ $reinsurance->currency }}</td>
                            <td>{{ number_format($reinsurance->sum_insured, 2, '.', ',') }}</td>
                            <td>{{ number_format($reinsurance->premium, 2, '.', ',') }}</td>
                            <td>
                            <a href="#" class="">
                              
                            </a> 
                           
                             @if($reinsurance->status === 'Paid')
                           <span class="label btn-rounded" style="background-color:#2ECC71">{{ $reinsurance->status }}</span> 
                        @elseif($reinsurance->status === 'Sent to finance')
                           <span class="label btn-rounded" style="background-color:#D7BDE2">{{ $reinsurance->status }}</span> 
                        @elseif($reinsurance->status === 'Approved')
                        <span class="label btn-rounded" style="background-color:#F4D03F">{{ $reinsurance->status }}</span> 
                         @elseif($reinsurance->status === 'Unpaid')
                        <span class="label btn-rounded" style="background-color:#F1948A">{{ $reinsurance->status }}</span> 
                         @elseif($reinsurance->status === 'Pending to be Ceded')
                        <span class="label btn-rounded" style="background-color:#F1948A">{{ $reinsurance->status }}</span> 
                        @else
                        <span class="label btn-rounded" style="background-color:#5DADE2">{{ $reinsurance->status }}</span> 
                        @endif
                            </td>


                            <td><a href="/view-cession/{{ $reinsurance->cession_number }}" class="bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-folder-open-o"></i></a></td>
                            
                            @role(['Reinsurance Manager','System Admin'])
                            <td>
                             <a href="#" onClick="excludefromtreaty('{{ $reinsurance->id }}','{{ $reinsurance->policy_number }}')"><i class="fa fa-trash"></i></a>
                             </td> 
                            @endrole
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
                  

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $reinsurances->total() }} {{ str_plural('Cession', $reinsurances->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                       {!!$reinsurances->render()!!}
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#review_period span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#review_period').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});


</script>

<script type="text/javascript">
  
function excludefromtreaty(id,name)
  {

         
      swal({   
        title: "Are you sure?",   
        text: "Do you want to exclude "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, exclude it!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/exclude-from-treaty',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Excluded!", "Successfully excluded.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", "Operation failed", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", "Operation failed", "error");   
        } });

  }

 

</script>





