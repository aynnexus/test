<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ Request::is('dashboard')?'active':'' }}"><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      @if(Auth::user()->role==1)<li class="{{ Request::is('dashboard/sites')?'active':'' || Request::is('dashboard/sites/*')?'active':'' }}"><a href="{{url('dashboard/sites')}}"><i class="fa fa-file"></i> <span>Sites</span></a></li>
      @endif
      <li class="{{ Request::is('dashboard/template')?'active':'' || Request::is('dashboard/template/*')?'active':'' }}"><a href="{{url('dashboard/template')}}"><i class="fa fa-sitemap"></i> <span>Template</span></a></li>
      @if(Auth::user()->role==1)      
      <li class="{{ Request::is('dashboard/clients')?'active':'' || Request::is('dashboard/clients/*')?'active':'' }}">
        <a href="{{url('dashboard/clients')}}">
          <i class="fa fa-filter"></i><span>Clients</span>
        </a>
      </li>
      @endif
      @if(Auth::user()->role==1)
        <li class="{{ Request::is('dashboard/guests')?'active':''}}"><a href="{{url('dashboard/guests')}}"><i class="fa fa-users"></i> <span>Guest Info</span></a></li>
      @else
        <li class="{{ Request::is('dashboard/guests/*')?'active':''}}"><a href="{{url('dashboard/guests/'.Auth::user()->Client->client_id)}}"><i class="fa fa-users"></i> <span>Guest Info</span></a></li>
      @endif
      @if(Auth::user()->role==1) 
      <li class="{{ Request::is('dashboard/admins')?'active':'' || Request::is('dashboard/admins/*')?'active':'' }}">
        <a href="{{url('dashboard/admin')}}"><i class="fa fa-diamond"></i> Admins</a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-gears"></i> <span>Settings</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu"> 
          <li><a href="{{url('dashboard/settings/serveys/questions')}}"><i class="fa fa-circle-o"></i> Servey</a></li>
          <li><a href="{{url('dashboard/settings/lookup')}}"><i class="fa fa-circle-o"></i> LookUp</a></li>    
          <!-- <li><a href="{{url('dashboard/settings/images')}}"><i class="fa fa-circle-o"></i> Image</a></li>          
          <li><a href="{{url('dashboard/permission')}}"><i class="fa fa-circle-o"></i> Permission</a></li> -->         
        </ul>
      </li>
      @endif
     <!--  <li><a href="{{url('dashboard/user')}}"><i class="fa fa-users"></i> <span>Newsletters</span></a></li> -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>