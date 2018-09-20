
@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Banks</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="/banking.banks"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Banks</a></li>
                <li class="b-b b-light"><a href="/banking.accounts"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Banks Accounts</a></li>
                <li class="b-b b-light"><a href="/banking.deposites"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Deposites</a></li>
                <li class="b-b b-light"><a href="/banking.payments"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Payments</a></li>
                <li class="b-b b-light"><a href="/banking.transfers"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Transfers</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-upload"></i> Upload</a>
                      <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-file"></i> File</a>
                      <a href="#modal_new_bank"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"><i class="fa fa-group"></i> Add New Bank </a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                      <span class="badge badge-info">Record(s) Found : {{ $banks->total() }} {{ str_plural('Bank', $banks->total()) }} </span>
                    </div>
                  <form action="/account.find" method="GET">
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
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th></th>
                            <th>#</th>
                            <th>Bank</th>
                            <th>Swift Number</th>
                            <th>Created By</th>
                            <th>Created On</th>
                          </tr>
                        </thead>
                        <tbody>
                   @foreach($banks as $bank)
                          <tr>
                            <td><a href="#modal_edit_bank" class="bootstrap-modal-form-open" onclick="editbank('{{ $bank->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td>
                             <td><a href="#" class="bootstrap-modal-form-open" onclick=""  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td>
                            <td>{{ $bank->id }}</td>
                            <td>{{ $bank->bank_name }}</td>
                            <td>{{ $bank->swift_number }}</td>
                            <td>{{ $bank->created_by }}</td>
                            <td>{{ $bank->created_on }}</td>
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
                     
                          {!!$banks->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
         
   @stop


<div class="modal fade" id="modal_new_bank" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">

                       <li class=""><a href="#fixedincometab" data-toggle="tab">New Bank</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-pane active" id="equitytab">

                         <div class="tab-pane" id="fixedincometab">
                           <form  method="post" data-validate="parsley" action="/banking.create-bank" class="panel-body wrapper-lg">
                          @include('banking/new_bank')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                       
                      </div>
                    </section>
                  </section>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal_edit_bank" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">

                       <li class=""><a href="#fixedincometab" data-toggle="tab">Edit Bank</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-pane active" id="equitytab">

                         <div class="tab-pane" id="fixedincometab">
                           <form  method="post" action="/banking.create-bank" class="panel-body wrapper-lg">
                          @include('banking/edit_bank')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                       
                      </div>
                    </section>
                  </section>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>





