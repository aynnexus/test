@extends('layouts.app')

@section('content')

<body class="hold-transition register-page" style="background: {{$temp->Profile->background_color}}">
    <img src="{{url('/storage/'.$temp->Profile->header_image)}}" height="200px" width="100%">
        <div class="register-box" style="margin:0% auto">
            <div class="register-logo">
                <img src="{{url('/storage/'.$temp->Profile->logo_image)}}" class="logo-template" width="100" height="100" style="left: 46%;">
            </div>

            <div class="register-box-body" style="border-radius:10px;background: transparent;">
                <p class="login-box-msg"></p>
                <?php   $social = json_decode($temp->Field->social_login);
                        $form = json_decode($temp->Field->form_login);
                         ?>
                {!! Form::open(['url'=>'/']) !!}
                    @if(isset($form) && $form->name==1)
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
                    @if(isset($form) && $form->age==1)
                    <div class="form-group has-feedback">
                        {!! Form::select('age',$look_age,null,['class'=>'form-control','placeholder'=>'Select age group',($form->a_req==1)?'required':'']) !!}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-8">
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-success btn-block">Connect</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    @if(isset($social) && $social->fb==1)
                        <a href="#" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                    @endif
                    @if(isset($social) && $social->gmail==1)
                        <a href="#" class="btn btn-block btn-social btn-google"><i class="fa fa-google"></i> Sign in using
                        Gmail</a>
                    @endif
                </div>
            </div>
            <!-- /.form-box --> 
        </div>
    <img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="250px" width="100%">
</body>
@endsection
