<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title>{{ $company->name }} | Account Manager</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('/css/animate.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('/css/font.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/app.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/app.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/js/toastr/toastr.css')}}" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>

<body>

  <section id="content" class="m-t-lg wrapper-md animated fadeInDown" >
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="{{ route('auth.signin') }}">{{ $company->name }}</a>
      <section class="panel panel-default m-t-lg bg-white">
        <header class="panel-heading text-center">
          <strong>Account Management</strong>
        </header>
    
        
        <form method="post" action="/update-user" class="panel-body wrapper-lg">
          <div class="form-group">
           <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
            <label class="control-label">Name</label> 
            <input type="text" placeholder="Enter your name" value="{{ $user->fullname }}" class="form-control input-lg" id="fullname" name="fullname">
             @if ($errors->has('fullname'))
          <span class="help-block">{{ $errors->first('fullname') }}</span>
            @endif
          </div>

           <div class="form-group">
           <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
            <label class="control-label">Email</label>
            <input type="email" placeholder="test@example.com" value="{{ $user->email }}" id="email" name="email" value="{{ Request::old('email') ?: '' }}" class="form-control input-lg">
              @if ($errors->has('email'))
          <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
          </div>

          <div class="form-group">
          <div class="form-group{{ $errors->has('location') ? ' has-error' : ''}}">
            <label class="control-label">Location</label>
            <select id="location" name="location" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="{{ $user->location }}">{{ $user->location }}</option>
                          @foreach($branches as $branch)
                          <option value="{{ $branch->branch_name }}">{{ $branch->branch_name }}</option>
                          @endforeach
                          </select>
              @if ($errors->has('location'))
          <span class="help-block">{{ $errors->first('location') }}</span>
            @endif
          </div>


           <div class="form-group">
           <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
            <label class="control-label">Username</label>
            <input type="text" placeholder="" value="{{ $user->username }}" class="form-control input-lg" id="username" name="username">
              @if ($errors->has('username'))
          <span class="help-block">{{ $errors->first('username') }}</span>
            @endif
          </div>

          <div class="form-group">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
            <label class="control-label">Password</label>
            <input type="password" placeholder="Type a password" class="form-control input-lg" id="password" name="password">
            @if ($errors->has('password'))
          <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
          </div>

           <div class="form-group">
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ''}}">
            <label class="control-label">Retype Password</label>
            <input type="password" placeholder="Retype password" class="form-control input-lg" id="password_confirmation" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
          <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
            @endif
          </div>
          
          

          <div class="form-group">
                            <div class="form-group{{ $errors->has('department') ? ' has-error' : ''}}">
                            <label>Role</label>
                            <select id="usertype" name="usertype" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control input-lg">
                            <option value="{{ $user->usertype }}">{{ $user->usertype }}</option>
                          @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('usertype'))
                          <span class="help-block">{{ $errors->first('usertype') }}</span>
                           @endif    
                          </div>   
                          </div>
         
            <button class="btn btn-lg btn-login btn-block btn-success" class="btn btn-primary" type="submit">Submit</button>
      <input type="hidden" name="userid" id="userid" value="{{ $user->id }}">
      <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
       <small>@include('includes.appversion')</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="{{ asset('/js/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('/js/bootstrap.js')}}"></script>
  <!-- App -->
  <script src="{{ asset('/js/app.js')}}"></script>
  <script src="{{ asset('/js/app.plugin.js')}}"></script>
  <script src="{{ asset('/js/slimscroll/jquery.slimscroll.min.js')}}"></script>

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