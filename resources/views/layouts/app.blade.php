
<!DOCTYPE html>
<html lang="en" class="app">
@include('includes.head')
<body>
  <section class="vbox">
@include('includes.header')

    <section>
      <section class="hbox stretch">
        <!-- .aside -->
               @include('includes.sidebarleft')
        <!-- /.aside -->
        <section id="content">
       {{--  @include('includes.alert') --}}
          <section class="vbox">          
           @yield('content')
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
@include('includes.scripts')

</body>
</html>
