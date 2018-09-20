@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Manage Customer </li>
              </ul>

             

              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-claim-policy" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-lg form-control" placeholder="Search by customer, vehicle number, policynumber">
                        <div class="input-group-btn">
                           <button class="btn btn-lg btn-success" type="submit">Search!</button>
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
                            <th>Object ID</th>
                            <th>Insured Name </th>
                            <th>Validity </th>
                            <th>Policy Type</th>
                            <th>Created By</th>
                           <th>Created On</th>
                            <th>Status</th>
                            <th></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $policies as $key => $policy )
                          <tr>
                           <td>{{ ++$key }}</td>
                            @if($policy->insurance_period_to < Carbon\Carbon::now())
                            
                              <td><a href="/view-policy/{{ $policy->policy_number }}" class="text-danger">{{ $policy->master_policy_number }}</a></td>
                            @else
                           <td><a href="/view-policy/{{ $policy->policy_number }}" class="text-info">{{ $policy->master_policy_number }}</a></td>
                            @endif
                            <td><a href="#" class="text-default">{{ $policy->itemid }}</a></td>
                             <td><a href="/customer-profile/{{ $policy->account_number }}" class="text-default">{{ $policy->fullname }}</a></td>
                            <td>{{ $policy->insurance_period_from }} to {{ $policy->insurance_period_to }}</td>
                           
                            <td>{{ $policy->policy_product }}</td>
                             <td>{{ $policy->created_by }}</td> 
                             <td>{{ $policy->created_on }}</td> 

                             @if($policy->insurance_period_to < Carbon\Carbon::now())
                            <td >Expired</td>
                            @else
                             <td>Running ({{$policy->insurance_period_from->diffForHumans() }})</td>
                             @endif
                             <td><a href="/online-claims/new/{{ $policy->id }}" class="btn btn-s-sm btn-primary btn-rounded bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-plus"> </i> Create Claim </a></td>
                           
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
                      <span class="badge badge-info">Record(s) Found : {{ $policies->total() }} {{ str_plural('Policies', $policies->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                         {!!$policies->render()!!}
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

@stop









