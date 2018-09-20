
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Claims Administration </li>   
              </ul>
             
            

              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/407848.svg" width="15%"  class="pull-left">
                    <a class="clear" href="/claims">
                      <span class="h3 block m-t-xs"><strong>{{ $claims->total() }}</strong></span>
                      <small class="text-muted text-uc">Filed Claims</small>
                    </a>
                   
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/628436.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Overdue Claims</small>
                    </a>
                  </div>
                 <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/753506.svg" width="15%" class="pull-left">

                    <a class="clear" href="/online-policies/new">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">History</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/686546.svg" width="15%" class="pull-left">


                    </span>
                    <a class="clear" href="/expired-policies">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Reports</small>
                    </a>
                  </div>
                </div>
              </section>


              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-claim" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Claim ID,Customer, Status, Product">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-dark" type="submit">Search!</button>
                        </div>
                      </div>
                      </form>
                    </header>
                    <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                          <th>Claim ID </th>
                                          <th>Policy </th>
                                          <th>Insured Name</th>
                                          <th>Item </th>
                                          <th>Class </th>
                                          <th>Period of Insurance</th>
                                          <th>Loss Date </th>
                                          
                                        {{--   <th>Currency</th>
                                          <th>Estimated</th>
                                          <th>Approved</th>
                                          <th>Paid</th> --}}
                                          <th>Status</th>
                                           <th>Handler</th>
                                            <th>Registered On</th>
                                          <th></th>
                                          <th></th>
                                        
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach( $claims as $claim )
                                      <tr>
                                        <td><a href="#">{{ $claim->claim_id }}</a></td>
                                         <td><a href="#">{{ $claim->policy_number}}</a></td>
                                      <td><a href="#"> {{ ucwords(strtolower($claim->insured_name)) }}</a></td>
                                        <td>{{ $claim->item_id }}</td>
                                        <td>{{ Abbreviation::make($claim->policy_product) }}</td>
                                          <td>{{  Carbon\Carbon::parse($claim->period_from)->toDateString() }} - {{  Carbon\Carbon::parse($claim->period_to)->toDateString() }}</td>
                                           <td>{{  Carbon\Carbon::parse($claim->loss_date)->toDateString() }} <label class="badge bg-default">({{ Carbon\Carbon::parse($claim->loss_date)->diffForHumans() }})</label></td>
                                       
                                        {{-- <td>{{ $claim->currency}}</td>
                                        <td>{{ number_format($claim->reserve_estimated, 2, '.', ',')}}</td>
                                        <td>{{ number_format($claim->reserve_approved, 2, '.', ',')}}</td>
                                        <td>{{ number_format($claim->reserve_paid, 2, '.', ',')}}</td> --}}

                                       @if($claim->status == 'PAID')
                                       <td> <span class="label bg-success m-l-xs"> {{ $claim->status}} </span> </td>
                                       @elseif($claim->status == 'SBNP')
                                      <td> <span class="label label-info"> {{ $claim->status}} </span> </td>
                                       @elseif($claim->status == 'RBNS')
                                      <td> <span class="label label-danger"> {{ $claim->status}} </span> </td>
                                      @else
                                       <td>{{ $claim->status}}</td>
                                      @endif
                                       <td>{{ ucwords(strtolower($claim->created_by)) }}</td>
                                       <td>{{ $claim->created_on }}</td>


                            <td>
                            <a href="{{ route('edit-claim', $claim->claim_id) }}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a>
                             </td>
                             <td>
                            <a href="#" onClick="removeClaim('{{ $claim->id }}','{{ $claim->claim_id }}')"><i class="fa fa-trash"></i></a>
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

              <a href="/start-claim" class="bootstrap-modal-form-open float" data-toggle="modal">
              <i class="fa fa-plus my-float"></i><i class="fa fa-tags my-float"></i>
              </a>
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!!$claims->render()!!}
                        
                    </div>
                  </div>
                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


<script type="text/javascript">
  function removeClaim(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the claim list?",   
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
          $.get('/delete-claim',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from claim list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from claim list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from claim list.", "error");   
        } });

    
   }
</script>
