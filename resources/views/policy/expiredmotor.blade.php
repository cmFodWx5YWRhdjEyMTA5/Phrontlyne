@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Renewal Administration </li>
              </ul>
             
              
               <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-truck fa-stack-2x text-info"></i>
                      <i class="fa fa-gavel fa-stack-1x text-white"></i>
                    </span>

                    <a class="clear" href="/online-policies/new">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Motor</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-building-o fa-stack-1x text-white"></i>
                      </span>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Non Motor</small>
                    </a>
                  </div>
                 <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-Inverse"></i>
                      <i class="fa fa-clock-o fa-stack-1x text-white"></i>
                    </span>

                    <a class="clear" href="/online-policies/new">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">History</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger" ></i>
                      <i class="fa fa-warning (alias) fa-stack-1x text-white"></i>
                      </span>
                    </span>
                    <a class="clear" href="/expired-policies">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Report</small>
                    </a>
                  </div>
                </div>
              </section>




              <div class="row">

                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-renewal" method="GET">
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
                            <th>Policy</th>
                            <th>Customer </th>
                            <th>Validity </th>
                            <th>Cover Type</th>
                            <th>Status</th>
                            
                            <th width="30"></th>
                            <th width="30"></th>
                   
                            
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $policies as $key => $policy )
                          <tr>
                           <td>{{ ++$key }}</td>
                          
                           <td><a href="/view-policy/{{ $policy->POLICY_NUM }}" class="text-danger">{{ $policy->POLICY_NUM }}</a></td>
                          
                            <td><a href="/customer-profile/{{ $policy->APPLICANT_ID }}" class="text-default">{{ ucwords(strtolower($policy->NAME)) }}</a></td>
                            <td>{{ $policy->INSURANCE_END_DATE}} </td>
                            
                            <td><a href="#" data-toggle="class" onclick="computePremium('{{ $policy->VEHICLE_REG_NO }}')" class="label bg-info m-l-xs">{{ $policy->VEHICLE_REG_NO }}</a></td>
                            <td>Expired</td>

                           
                            <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-refresh"></i></a>
                             </td>
                             <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a>
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
                  

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $policies->total() }} {{ str_plural('Policy', $policies->total()) }}</span>
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

<script type="text/javascript">
  
function computePremium(id)
{

  //alert(id);

    $.get('/compute-renewal-premium',
        {


          "registration": id
         


        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
          sweetAlert("Renewal Premium Payable : ", data["Premium"], "info");
          //$('#gross_premium').val(data.Premium);
       
      });
                                        
        },'json');
  
}
  
</script>

