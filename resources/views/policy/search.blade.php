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
                    <form action="/find-customer-policy" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-lg form-control" placeholder="Search by customer, phone, type">
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
                            
                            <th>Customer # </th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone #</th>
                            <th>Created On</th>
                            <th>Managed By</th>
                              <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $customers as $customer )
                          <tr>
                           
                            <td><a href="/customer-profile/{{ $customer->account_number }}">{{ $customer->account_number }}</a></td>
                            <td><a href="/customer-profile/{{ $customer->account_number }}" class="text-dark">{{ strtoupper($customer->fullname) }}</a></td>

                            <td>{{ strtoupper($customer->postal_address) }}</td>
                            <td>{{ $customer->mobile_number }}</td>
                            <td>{{ $customer->created_on }}</td>
                            <td>{{ $customer->created_by }}</td>
                             <td><a href="/online-policies/new/{{ $customer->account_number }}" class="btn btn-s-sm btn-primary btn-rounded bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-plus"> </i> Create Policy </a></td>
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
                     
                         {!!$customers->render()!!}
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

@stop









