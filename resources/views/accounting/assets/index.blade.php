@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Asset Manager</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Active</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Salvaged</a></li>
              
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <a href="#add_asset" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-money"></i> Add New Asset</a>
                      <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-file"></i> File</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                    {{--  <span class="badge badge-info">Record(s) Found : {{ $payments->total() }} {{ str_plural('Payment', $payments->total()) }} </span> --}}
                    </div>

                  <form action="/find-invoice" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a client">
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
                      <table class="table table-striped m-b-none">
                        <thead>
                          <tr>
                            
                            <th width="20"></th>
                            <th width="20"></th>
                            <th>Asset #</th>
                            <th>Asset</th>
                            <th>Purchase Date</th>
                            <th>Purchase Cost</th>
                            <th>Depreciation/pa</th>
                            <th>Current Value</th>
                          </tr>
                        </thead>
                        <tbody>
                       {{--  @foreach( $payments as $payment )
                          <tr>
                           
                            <td><a onclick="makeNewPost('{{ $payment->id  }}')" class="bootstrap-modal-form-open" href="#modal_posting" data-toggle="modal" ><i class="fa fa-pencil"></i></a></td>
                              <td><a href="/print-invoice/{{ $payment->id }}" data-toggle="modal" ><i class="fa fa-print"></i></a></td>
                            <td>{{ $payment->payment_type }}</td>
                            <td>{{ $payment->reference_number }}</td>
                            <td>{{ $payment->paymentid }}</td>
                            <td>{{ $payment->payment_sum }}</td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>{{ $payment->payer_name }}</td>
                            <td>{{ $payment->payment_description }}</td>
                            <td>{{ $payment->created_by }}</td>
                            <td>{{ $payment->created_on }}</td>
                           
                          </tr>
                         @endforeach  --}}
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
                     
                      {{--  {!!$payments->render()!!}  --}}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

  
<div class="modal fade" id="add_asset" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Asset</h4>
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
                           <form  class="bootstrap-modal-form" method="post" action="/create-opd" class="panel-body wrapper-lg">
                          @include('accounting/assets/new')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                        </section>
                      </div>
      </div>
        </div>
    </div><!-- /.modal-dialog -->



