@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside>
              <section class="vbox">
                <form method="post" action="/add-new-document">
  <textarea id="report" name="report" ></textarea>
   <footer class="panel-footer text-right bg-light lter">
                        <input type="text" class="form-control" placeholder="Enter document name" style="width:700px" name="file_name" id="file_name">
                        @if ($errors->has('file_name'))
                          <span class="help-block">{{ $errors->first('file_name') }}</span>
                           @endif             
                        <button type="submit" class="btn btn-success btn-s-xs">Add Document</button>
                         <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </footer>
                    </form>        
                  </section>
                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                       {{--  {!!$drugs->render()!!} --}}
                        
                    </div>
                  </div>
                </footer>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
<script src="{{ asset('/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
  <script>tinymce.init({ selector:'#report' ,menubar: false,
  browser_spellcheck: true,height: 700 });</script>