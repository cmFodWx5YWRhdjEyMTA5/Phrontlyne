@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p>{{ $customers->NAME }}'s profile</p>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/{{ $customers->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $customers->image }}" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $customers->fullname }}</div>
                            <small class="text-muted"><i class="fa fa-map-marker"></i>ID :{{ $customers->account_number }}</small>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $customers->gender }}</span>
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $customers->date_of_birth->age }}</span>
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $customers->status }}</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="btn-group btn-group-justified m-b">
                          <a class="btn btn-primary btn-rounded" data-toggle="button">
                            <span class="text">
                              <i class="fa fa-eye"></i> Whatsapp
                            </span>
                            <span class="text-active">
                              <i class="fa fa-eye-slash"></i> Call
                            </span>
                          </a>
                          <a class="btn btn-dark btn-rounded" data-loading-text="Connecting">
                            <i class="fa fa-comment-o"></i> SMS
                          </a>
                        </div>
                        <div>
                          <small class="text-uc text-xs text-muted">Mobile</small>
                          <p>{{ $customers->PHONE }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Address</small>
                          <p>{{ $customers->ADDRESS }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Email</small>
                          <p class="m-t-sm">
                            <a href="#" class="btn btn-rounded btn-twitter btn-icon"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="btn btn-rounded btn-facebook btn-icon"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="btn btn-rounded btn-gplus btn-icon"><i class="fa fa-google-plus"></i></a>
                          </p>
                          
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#consultation_tab" data-toggle="tab">Policies</a></li>
                        <li class=""><a href="#diagnosis_tab" data-toggle="tab">Objects</a></li>
                        <li class=""><a href="#medication_tab" data-toggle="tab">Quotes</a></li>
                        <li class=""><a href="#document_tab" data-toggle="tab">Invoices</a></li>
                        <li class=""><a href="#allergy_tab" data-toggle="tab">Documents</a></li>
                        <li class=""><a href="#treatment_tab" data-toggle="tab">Claims</a></li>
                        <li class=""><a href="#surgeries_tab" data-toggle="tab">CRM</a></li>
                        <li class=""><a href="#surgeries_tab" data-toggle="tab">Logs</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="consultation_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                         {{--  @foreach($consultations as $consult)
                            @if($consult->consultation_type != null)
                            <li class="list-group-item animated fadeInRightBig">
                              <a href="#" class="thumb-sm pull-left m-r-sm" data-toggle="class:show,hide">
                                <img src="/images/avatar_default.jpg" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">{{ $consult->date }}</small>
                                <strong class="block">{{ $consult->consultation_type }}</strong>
                                <small>{{ $consult->doctorid }}</small>
                              </a>
                            </li>
                            @else
                            

                            @endif
                            @endforeach --}}
                          </ul>
                        </div>
                        <div class="tab-pane" id="diagnosis_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                         {{--  @foreach($consultations as $consult)
                             @if($consult->diagnosis != null)
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="/images/avatar_default.jpg" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">{{ $consult->date }}</small>
                                <strong class="block">{{ $consult->diagnosis }}</strong>
                                <small>{{ $consult->doctorid }}</small>
                              </a>
                            </li>
                            @else
                            

                            @endif
                            @endforeach --}}
                          </ul>
                        </div>
                        <div class="tab-pane" id="medication_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                         {{--  @foreach($medications as $drug)
                          @if($drug->DrugName != null)
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="/images/avatar_default.jpg" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">{{ $drug->StartDate }}</small>
                                <strong class="block">{{ $drug->DrugName }}</strong>
                                <small>{{ $drug->Createdby }}</small>
                              </a>
                            </li>
                            @else
                            

                            @endif
                            @endforeach --}}
                          </ul>
                        </div>
                        <div class="tab-pane" id="document_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                      {{--     @foreach($images as $image)
                            <li class="list-group-item">
                              <a href="{!! '/uploads/images/'.$image->filepath !!}" class="thumb-sm pull-left m-r-sm">
                                <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-circle">
                              </a>
                              <a href="{!! '/uploads/images/'.$image->filepath !!}" class="clear">
                                <small class="pull-right">{{ $image->created_on }}</small>
                                <strong class="block">{{ $image->filename }}</strong>
                                <small>{{ $image->filepath }}</small>
                              </a>
                            </li>
                            @endforeach  --}}
                          </ul>
                        </div>

                         <div class="tab-pane" id="allergy_tab">

                       {{--    @foreach($images as $image)
                          <div id="gallery" class="gallery">
                           <div class="item">
                            <img src="{!! '/uploads/images/'.$image->filepath !!}"  width="400px" height="400px" />
                              <a href="{!! '/uploads/images/'.$image->filepath !!}" width="800px" height="800px" ></a>                  
                                <div class="desc">
                              <h4>{{ $image->filename }}</h4>
                             <p>{{ $image->filepath }}</p>
                              <span>{{ $image->created_on }}</span>
                               </div>
                          </div>
                        </div>
                      @endforeach --}}
                        </div>

                        <div class="tab-pane" id="treatment_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                       {{--     @foreach($consultations as $consult)
                           @if($consult->procedures != null)
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="/images/avatar_default.jpg" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">{{ $consult->date }}</small>
                                <strong class="block">{{ $consult->procedures }}</strong>
                                <small>{{ $consult->doctorid }}</small>
                              </a>
                            </li>
                            @else
                            

                            @endif
                            @endforeach --}}
                          </ul>
                        </div>

                        <div class="tab-pane" id="surgeries_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          {{--  @foreach($consultations as $consult)
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="/images/avatar_default.jpg" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">{{ $consult->date }}</small>
                                <strong class="block">{{ $consult->medication }}</strong>
                                <small>{{ $consult->doctorid }}</small>
                              </a>
                            </li>
                            @endforeach --}}
                          </ul>
                        </div>


                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="col-lg-4 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">

                        <section class="panel panel-default">
                          <h4 class="font-thin padder">Sales Opportunities</h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                            <li class="list-group-item">
                                <p>Morbi nec <a href="#" class="text-info">@Jonathan George</a> nunc condimentum ipsum dolor sit amet, consectetur</p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                            </li>
                            <li class="list-group-item">                     
                                <p><a href="#" class="text-info">@Josh Long</a> Vestibulum ullamcorper sodales nisi nec adipiscing elit. </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                            </li>
                          </ul>
                        </section>
                        <section class="panel clearfix bg-info lter">
                          <div class="panel-body">
                            <a href="#" class="thumb pull-left m-r">
                              <img src="/images/{{ $customers[0]->image }}" class="img-circle">
                            </a>
                            <div class="clear">
                              <a href="/event-calendar" class="text-info">{{ $customers[0]->fullname }} <i class="fa fa-twitter"></i></a>
                              <small class="block text-muted">Appointments</small>
                              <a href="/event-calendar" class="btn btn-xs btn-success m-t-xs">Schedule Consultation</a>
                              <a href="/event-calendar" class="btn btn-xs btn-success m-t-xs">Schedule Resource</a>
                               @if(Auth::user()->usertype == 'Guest')
                              <a href="#modal_check_in" class="bootstrap-modal-form-open btn btn-xs btn-success m-t-xs" onclick="getGuestdetails('{{ Auth::user()->location }}')"  id="edit" name="edit" data-toggle="modal" alt="edit" >Check In</a>
                               @else
                              <a href="#modal_check_in" class="bootstrap-modal-form-open btn btn-xs btn-success m-t-xs" onclick="getDetails()"  id="edit" name="edit" data-toggle="modal" alt="edit" >Check In</a>
                              @endif
                            </div>
                          </div>
                        </section>

                         <section class="panel panel-default">
                          <h4 class="font-thin padder">Task</h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                           
                          </ul>
                        </section>

                         <section class="panel panel-default">
                          <h4 class="font-thin padder">Notes</h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                           
                          </ul>
                        </section>

                       <section class="panel panel-default">
                          <h4 class="font-thin padder">Contact Persons</h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                           
                          </ul>
                        </section>

                         <section class="panel panel-default">
                          <h4 class="font-thin padder">Contracts / Power of Attorney</h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                           
                          </ul>
                        </section>



                      </div>
                    </section>
                    </section>
                    </aside>
                    </section>
                    </section>
                    </section>

  @stop






