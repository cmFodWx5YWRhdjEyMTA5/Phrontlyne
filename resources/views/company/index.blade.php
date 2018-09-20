@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Branch Manager</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Branch</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Locations</a></li>
                <li class="b-b b-light"><a href="/company.items"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Items</a></li>
               
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                     @include('includes.alert')
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <a href="/patient.manage" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-reply-all"></i> Back to Main</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found :  {{ $companydetails->total() }} {{ str_plural('Branch', $companydetails->total()) }}</span>
                    </div>

                  <form action="/patient.find" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a branch">
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
                      <table class="table table-striped m-b-none text-sm" width="100%"  >
                        <thead>
                          <tr>
                            
                            <th width="20"></th>
                            <th>Branch #</th>
                            <th>Legal Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Customer #</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $companydetails as $companydetail )
                          <tr>
                            
                            <td><a href="#modal_check_in" class="bootstrap-modal-form-open" onclick="getDetails('{{ $companydetail->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td>
                            <td>{{ $companydetail->branch_code }}</td>
                            <td>{{ $companydetail->branch_name }}</td>
                            <td>{{ $companydetail->contact }}</td>
                            <td>{{ $companydetail->post_address }}</td>
                            <td>{{ $companydetail->client_count }}</td>
                            <td>
                              <a href="#" class="active" onclick="deactivateAccount('{{ $companydetail->id }}')" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                            
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
                     
                        {!!$companydetails->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

<div class="modal fade" id="modal_check_in" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Company Registration</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Check-in Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/opd.create" class="panel-body wrapper-lg">
                       {{--    @include('opd/checkin'); --}}
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
    <script>

var account_no = null;
function getDetails(acct_no)
{ 
  account_no = acct_no;
  $.get("/patient.edit",
          {"patient_id":account_no},
          function(json)
          {

                $('#modal_check_in input[name="patient_id"]').val(json.patient_id);
                $('#modal_check_in input[name="fullname"]').val(json.fullname);

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}

</script>
