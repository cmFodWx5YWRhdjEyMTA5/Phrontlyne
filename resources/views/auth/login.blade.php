<!DOCTYPE html>
<html lang="en" class="bg-dark">
@include('includes.signinhead')
<body>

  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">

    <div class="container aside-xxl">
      <a class="navbar-brand block" href="#">{{ $company->name }} Login</a>
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong class="bg-dker">Sign in</strong>
        </header>
        <form method="post" action="{{ route('auth.signin') }}" class="panel-body wrapper-lg">

          <div class="form-group">
           <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
            <label class="control-label">Username</label>
            <input type="text" placeholder="" class="form-control input-lg" name="username" id="username">
            @if ($errors->has('username'))
          <span class="help-block">{{ $errors->first('username') }}</span>
            @endif
          </div>

          <div class="form-group">
          <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
            <label class="control-label">Password</label>
            <input type="password"  placeholder="" class="form-control input-lg" name="password" id="password">
               @if ($errors->has('password'))
          <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
          </div>

          <div class="checkbox">
            <label>
              <input id="remember" name="remember" type="checkbox"> Keep me logged in
            </label>
          </div>
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <a href="/password/reset" class="pull-right m-t-xs"><small>Forgot password?</small></a>
          <button class="btn btn-lg btn-login btn-warning btn-block" id="login" name="login" value="Login" type="submit">Sign in</button>
         

        </form>
      </section>
    </div>
   
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
       <small>@include('includes.appversion')</small>
      </p>
    </div>
  </footer>
 <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

  <!-- / footer -->

  <script src="{{ asset('/js/jquery.min.js')}}"></script>

  <!-- Bootstrap -->
  <script src="{{ asset('/js/bootstrap.js')}}"></script>
  <!-- App -->
  <script src="{{ asset('/js/app.js')}}"></script>
  <script src="{{ asset('/js/app.plugin.js')}}"></script>
  <script src="{{ asset('/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
 

 <script type="text/javascript" src="{{ asset('/js/jquery.backstretch.min.js')}}"></script>
   <script>
          $.backstretch("{{ asset('images/lock-screen.jpg')}}", {speed: 500});
      </script>


        <script src="{{ asset('/js/toastr/toastr.js')}}"></script> 
  
  <script>

  @if(Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
  @endif

  @if(Session::has('info'))
      toastr.success("{{ Session::get('info') }}");
  @endif

  @if(Session::has('warning'))
      toastr.warning("{{ Session::get('warning') }}");
  @endif

  @if(Session::has('error'))
      toastr.error("{{ Session::get('error') }}");
  @endif

</script>
</body>
</html>