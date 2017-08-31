<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <!-- Styles -->
    {!! Html::style('assets/bootstrap/css/bootstrap.css') !!}
    {!! Html::style('css/custom.css') !!}
    {!! Html::style('assets/bootstrap/css/font-awesome.min.css') !!}
    {!! Html::style('assets/adminlte/plugins/select2/select2.min.css') !!}
    {!! Html::style('assets/adminlte/css/AdminLTE.min.css') !!}
    {!! Html::style('assets/adminlte/css/skins/_all-skins.min.css') !!}
    {!! Html::style('assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}  
    {!! Html::style('css/bootstrap-datetimepicker.css') !!}  
    <!-- Scripts -->
    {!! Html::script('js/custom.js') !!}
    {!! Html::script('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') !!}
    {!! Html::script('assets/bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('assets/adminlte/js/app.js') !!}
    {!! Html::script('assets/adminlte/plugins/select2/select2.full.min.js') !!}
    {!! Html::script('assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.js') !!}
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'baseURL' => url('/'),
        ]); ?>
    </script>
</head>
<body class="sidebar-mini skin-green">
    <div class="wrapper">
        
        <header class="main-header">
          <!-- Logo -->
          <a href="{{url('/')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>N</b>P</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Nexus</b> Portal</span>
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                    @if(!Auth::guest())
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#" onclick="modelForm({{Auth::user()->id}})">Update Profile</a>
                        <li>
                          <a href="{{ url('/logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          Logout
                          </a>

                          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          </form>
                        </li>
                      </ul>
                    </li>
                    @endif
                  </ul>
                </div>
          </nav>

        </header>        
        @include('backend.layouts.sidebar')
        <div style="min-height: 946px;" class="content-wrapper">
            @include('flash::message')
            @yield('content')
        </div>
        @include('backend.layouts.footer')
    </div>

      <!-- model start -->
      <?php $sele=[1=>'Admin',2=>'Data']; ?>
      <div class="modal fade" id="myModal{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content modal-primary">
          {!!Form::open(['url'=>'dashboard/admin/'.Auth::user()->id,'id'=>'usercreateUpdate'])!!}
            <div class="modal-header">                                            
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">
                Create Admin
              </h4>
            </div>
            <div class="modal-body" id="modal-bodyku">
                <div class="form-group">
                  <input type="text" name="name" value="{{Auth::user()->name}}" required="true" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="email" name="email" value="{{Auth::user()->email}}" required="true" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="old_password" class="form-control" placeholder="Old Password">               
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="New Password">               
                </div>
                <div class="form-group">
                  <select name="role_id" class="form-control">
                    @foreach($sele as $key=>$value)
                      <option value="{{$key}}" <?php echo (Auth::user()->role_id==$key)?'selected':''; ?>>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="modal-footer" id="modal-footerq">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
          {!!Form::close()!!}
          </div>
        </div>
      </div>
   <!-- model end -->
</body>
</html>
