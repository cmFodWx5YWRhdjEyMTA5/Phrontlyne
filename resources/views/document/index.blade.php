
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Resources </li>   
              </ul>
        
              <div class="col-sm-12">
                      <section class="panel panel-default">
                        <header class="panel-heading bg-info lt no-border">
                          <div class="clearfix">
                          
                            <div class="clear">
                              <div class="h3 m-t-xs m-b-xs text-white">
                               Policy Templates
                               <a href="/new-templates" class="bootstrap-modal-form-open" data-toggle="modal"> <i class="fa fa-plus text-white pull-right text-xs m-t-sm"></i></a>
                              </div>
                              <small class="text-muted"> </small>
                            </div>                
                          </div>
                        </header>
                        <div class="list-group no-radius alt">
                        @foreach($documents as $document)

                          <a class="list-group-item" href="{!! '/uploads/images/'.$document->filePath !!}">
                            <span class="badge bg-success">{{ $document->id }}</span>
                            <i class="fa fa-bars"></i> 
                            {{ $document->filename }}
                          </a>
                        @endforeach
                        </div>
                        <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!!$documents->render()!!}
                        
                    </div>
                  </div>
                </footer>

                      </section>
                    </div>


            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

