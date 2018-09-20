@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
          {{--  <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Reinsurance Management</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="/agent-list-agent"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Pending</a></li>
                <li class="b-b b-light"><a href="/agent-list-broker"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Processed</a></li>
                <li class="b-b b-light"><a href="/agent-list-bank"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Disposed</a></li>
              </ul>
            </aside> --}}
          

            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                   
                         <div class="col-sm-8 m-b-xs">
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                    <a href="/reinsurance-pending" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fa fa-random"></i> Unprocessed</a>
                    <a href="/reinsurance-businesses" data-toggle="modal" class="btn btn-sm btn-info"><i class="fa fa-cogs"></i> Processed</a>
                    <a href="/reinsurance-disposed" data-toggle="modal" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Disposed</a>
                     <span class="badge badge-info">Record(s) Found : {{ $reinsurances->total() }} {{ str_plural('Reinsurance', $reinsurances->total()) }} </span>
                    </div>

                  <form action="#" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for customer">
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
                          <th>Month Placed</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Item ID</th>
                            {{-- <th>Insurance Period</th> --}}
                            <th>Cover Type</th>
                            <th>Currency</th> 
                            <th>Sum Insured</th> 
                            <th>Debit</th>
                             <th width="20"></th>
                            <th width="20"></th>    
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $reinsurances  as $reinsurance)
                          <tr>
                            <td>{{ Carbon\Carbon::parse($reinsurance->record_date)->format('FY') }}</td>
                            <td>{{ $reinsurance->policy_number }}</td>
                            <td>{{ str_limit($reinsurance->account_name,30) }}</td>
                            <td>{{ $reinsurance->item_number }}</td>
                            {{-- <td>{{ $reinsurance->period_from.' to '.$reinsurance->period_to  }}</td> --}}
                            <td>{{ $reinsurance->cover_type }}</td>
                            <td>{{ $reinsurance->currency }}</td>
                            <td>{{ $reinsurance->sum_insured }}</td>
                            <td>{{ $reinsurance->amount }}</td>
                            <td><a href="#" class="bootstrap-modal-form-open" onclick="getDetails('{{ $reinsurance->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-gears (alias)"></i></a></td>
                            <td><a href="#" class="bootstrap-modal-form-open" onclick="removeUser('{{ $reinsurance->id }}','{{ $reinsurance->fullname }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td>
                   
                            
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
                     
                        {!!$reinsurances->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop






