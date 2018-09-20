
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Resources </li>   
              </ul>
            
              <div class="row">
                <div class="col-lg-12">
                       <section class="panel panel-default">
                    <header class="panel-heading">                    
                      <span class="label bg-warning">{{ $documents->count() }}</span> Items
                    </header>
                    <section class="panel-body" data-height="100px">
                    @foreach($documents as $document)
                      <article class="media">
                        <span class="pull-left thumb-sm"><i class="fa fa-file fa-3x"></i></span>
                        <div class="media-body">
                          <a href="/uploads/documents/{{ $document->file }}" class="h4">{{ $document->name }}</a>
                        </div>
                      </article>
                        <div class="line pull-in"></div>
                      @endforeach
                    
                    </section>
                  </section>
                
                </div>
              </div>


            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
