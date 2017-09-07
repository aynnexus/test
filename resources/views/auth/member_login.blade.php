@extends('layouts.app')

@section('content')

<div class="lockscreen-wrapper hold-transition lockscreen">
  <div class="lockscreen-logo">
    <a href="#"><b>Wifi</b>Protal</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
   <!--  <div class="lockscreen-image">
      <img src="{{asset('img/avatar5.png')}}" alt="User Image">
    </div> -->
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    {!! Form::open(['url'=>'member','class'=>'lockscreen-credentials']) !!}
      {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'email','required']) !!}
      
      <div class="input-group">
      <input type="password" name="password" class="form-control" required placeholder="password">
        <div class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    {!! Form::close() !!}
  
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    
  </div>
  <div class="text-center">
    <a href="login.html"></a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2017 <b><a href="http://www.nexus.com.mm/" class="text-black">Nexus Solutions</a>.</strong></b><br>
    All rights reserved
  </div>
</div>

@endsection
