@extends('layouts.app')

@section('content')

<body class="hold-transition register-page" style="background-repeat: no-repeat;background: {{$temp->Profile->background_color}};background-image: url(<?php echo ($temp->Profile!=null)?'/storage/'.$temp->Profile->background_image:''; ?>);">
    <img src="{{url('/storage/'.$temp->Profile->header_image)}}" height="200px" width="100%">
        <div class="register-box" style="margin:0% auto">
            <div class="register-logo">
                <img src="{{url('/storage/'.$temp->Profile->logo_image)}}" class="logo-template" width="100" height="100" style="left: 45%;">
            </div>
            <br>
            <div class="register-box-body" style="border-radius:10px;background: transparent;">
                <p class="login-box-msg"></p>
                <?php   $social = json_decode($temp->Field->social_login);
                        $form = json_decode($temp->Field->form_login);
                         ?>
                
                @if(isset($social) && $social->fb==1 || $social->gmail==1)
                <div class="social-auth-links text-center">
                
                    @if(isset($social) && $social->fb==1)
                        <a href="{{url('guest/login/facebook')}}" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                    @endif
                    @if(isset($social) && $social->gmail==1)
                        <a href="{{url('guest/login/google')}}" class="btn btn-block btn-social btn-google"><i class="fa fa-google"></i> Sign in using
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
                        {!! Form::number('phone',null,['class'=>'form-control','placeholder'=>'094354354',($form->p_req==1)?'required':'']) !!}
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
                        {!! Form::text('custom_1',null,['class'=>'form-control','placeholder'=>'Select age group',($form->f1_req==1)?'required':'']) !!}
                    </div>
                    @endif
                    @if(isset($form) && $form->field_2==1)
                    <div class="form-group has-feedback">
                        {!! Form::text('custom_2',null,['class'=>'form-control','placeholder'=>'Select age group',($form->f2_req==1)?'required':'']) !!}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-8">
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" id="login" class="btn btn-success btn-block">Connect</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {!! Form::close() !!}
                @endif
            </div>
            <!-- /.form-box --> 
        </div>
    <img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="250px" width="100%">
</body>
<script type="text/javascript">
    // $('button#login').click(function(){
    //     submitForm($('form#login'))
    // })
</script>
@endsection
