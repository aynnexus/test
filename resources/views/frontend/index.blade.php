@extends('layouts.app')

@section('content')
<body class="hold-transition register-page container-fluid frontend-body" style="width:auto; background-position:top center;background-attachment:fixed;background: {{$temp->Profile->background_color}};background-image: url(<?php echo ($temp->Profile!=null)?'/storage/'.$temp->Profile->background_image:''; ?>);background-repeat:no-repeat;padding:0;">
   <header style="text-align:center;"> <img src="{{url('/storage/'.$temp->Profile->header_image)}}" align="center"  height="200px" width="100%" style="max-width:600px;"></header>
	<!-- loading -->
	<div class="loading-div" id="loading-start" >
	      <div class="loading-text"><p><span style="padding-right:10px;"><img src="{{asset('img/loading.gif')}}"></span>Please Wait... Connecting...</p></div>
   	 </div>
	<!--loading / -->
        <div class="register-box" style="margin:0% auto">
            <div class="register-logo" style="margin-botton:0;">
                <img src="{{url('/storage/'.$temp->Profile->logo_image)}}" class="logo-template" width="100" height="100" style="left: 45%;margin-top:-45px;">
            </div>
            <div class="register-box-body" style="border-radius:10px;background: transparent;margin-top:10px; padding-top:0;">
               <p class="login-box-msg"></p>
                <?php   $social = json_decode($temp->Field->social_login);
                        $form = json_decode($temp->Field->form_login);
                         ?>
                
                @if(isset($social) && $social->fb==1 || $social->gmail==1)
                    <div class="social-auth-links text-center">                
                        @if(isset($social) && $social->fb==1)
                            <a href="{{url('guest/login/facebook')}}" class="btn btn-block btn-social btn-facebook loading" style="height:50px;line-height:33px;font-size:16px;border-radius:10px;padding-left:80px; "><i class="fa fa-facebook" style="line-height:50px; width:50px;"></i> Sign in with
                        Facebook</a>
                        @endif
                        @if(isset($social) && $social->gmail==1)
                            <a id="loading" href="{{url('guest/login/google')}}" class="btn btn-block btn-social btn-google"><i class="fa fa-google"></i> Sign in using
                            Gmail</a>
                        @endif  
                        @if(isset($form) && $form->name==1 || $form->email==1 || $form->phone==1 ||$form->gender==1 ||$form->age==1)
                        <p>- OR -</p>      
                        @endif           
                    </div>
                @endif
                @if(isset($form) && $form->name==1 || $form->email==1 || $form->phone==1 ||$form->gender==1 ||$form->age==1)                        
                    {!! Form::open(['url'=>'guest/login','id'=>'login']) !!}
                        @if(isset($form) && $form->name==1)
                        <input type="hidden" name="user_ap" value="{{$user_ap}}">
                        <div class="form-group has-feedback">
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Full name',($form->n_req==1)?'required':'']) !!}
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        @endif
                        @if(isset($form) && $form->email==1)
                        <div class="form-group has-feedback">
                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email',($form->e_req==1)?'required':'']) !!}
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        @endif
                        @if(isset($form) && $form->phone==1)
                        <div class="form-group has-feedback">
                            {!! Form::number('phone',null,['class'=>'form-control','placeholder'=>'Phone no.',($form->p_req==1)?'required':'']) !!}
                            <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                        </div>
                        @endif
                         @if(isset($form) && $form->gender==1)
                        <div class="form-group has-feedback">
                            {!! Form::select('gender',$look_gender,null,['class'=>'form-control','placeholder'=>'Select gender group',($form->g_req==1)?'required':'']) !!}
                        </div>
                        @endif
                        @if(isset($form) && $form->age==1)
                        <div class="form-group has-feedback">
                            {!! Form::select('age',$look_age,null,['class'=>'form-control','placeholder'=>'Select age group',($form->a_req==1)?'required':'']) !!}
                        </div>
                        @endif
                        @if(isset($form) && $form->field_1==1)
                        <div class="form-group has-feedback">
                            {!! Form::text('custom_1',null,['class'=>'form-control','placeholder'=>$form->field_1_value,($form->f1_req==1)?'required':'']) !!}
                        </div>
                        @endif
                        @if(isset($form) && $form->field_2==1)
                        <div class="form-group has-feedback">
                            {!! Form::text('custom_2',null,['class'=>'form-control','placeholder'=>$form->field_2_value,($form->f2_req==1)?'required':'']) !!}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-8">
                              
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" id="login" class="btn btn-success btn-block loading">Connect</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
       <!-- /.form-box --> 
        </div>
	<!--<div class="ads-footer"><img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="200px" width="100%" aling="center" style="max-width:500px;margin-bottom:25px;"></div> -->
	<footer class="frontend-footer">
	    <img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="200px" width="100%" aling="center" style="max-width:600px;">
	   <!-- <div class="up-footer">
	        <p>Powered by <a href="http://nexus.com.mm">Nexus Solutions</a></p>
      	  </div>
     	  <div class="low-footer"></div> -->
	</footer>
</body>
<script type="text/javascript">
    // $('button#login').click(function(){
    //     submitForm($('form#login'))
    // })
    $(".loading").click(function() {
      $('#loading-start').show()
    });
</script>
@endsection
