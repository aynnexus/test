@extends('backend.layouts.app')
@section('content')
	@include('backend.site.tab')
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						@include('backend.site.menu')
						<div class="col-md-6">
								<h4>Preview your landing page</h4>
							</div>
						<div class="row">
								
							<div class="col-md-6 col-md-offset-3">
								<div style="background-color:{{($site->Profile!=null)?$site->Profile->background_color:'#d2d6de'}}" class="preview">
									<div class="preview_header">
										@if($site->Profile!=null)
											<img src="{{url('storage/'.$site->Profile->header_image)}}" height="200px" width="auto">
										@endif
									</div>
									<div class="preview_body">
										@if($site->Field!=null)
											<?php 
												$social = json_decode($site->Field->social_login);
												$field = json_decode($site->Field->form_login) ?>
											<div class="register-box">
											  <div class="register-logo">
											    <a href="#"><b>{{$site->site_name}}</b></a>
											  </div>
												<div class="register-box-body" style="background-color: transparent;">
												    <p class="login-box-msg">Register</p>
												    	@if($field->name==ACTIVE)
												      		<div class="form-group has-feedback">
														        <input type="text" class="form-control" placeholder="Full name">
														        <span class="glyphicon glyphicon-user form-control-feedback"></span>
												      		</div>
												      	@endif
												      	@if($field->email==ACTIVE)
													      <div class="form-group has-feedback">
													        <input type="email" class="form-control" placeholder="Email">
													        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
													      </div>
													    @endif
												      	@if($field->phone==ACTIVE)
													      <div class="form-group has-feedback">
													        <input type="input" class="form-control" placeholder="Phone">
													        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
													      </div>
													    @endif
												      	@if($field->age==ACTIVE)
													      <div class="form-group has-feedback">
													        <input type="input" class="form-control" placeholder="Age">
													        <span class="glyphicon glyphicon-signal form-control-feedback"></span>
													      </div>
													    @endif
												      <div class="row">
												        
												        <!-- /.col -->
												        <div class="col-xs-4">
												          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
												        </div>
												        <!-- /.col -->
												      </div>

												    <div class="social-auth-links text-center">
												      <p>- OR -</p>
												      	@if($social->fb==ACTIVE)
												      		<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
												        Facebook</a>
												      	@endif
												      	@if($social->google==ACTIVE)
												      		<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
												        Google+</a>
												      	@endif
												      	@if($social->gmail==ACTIVE)
												      		<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google"></i> Sign up using
												        	Gmail</a>
												     	@endif
												    </div>
												  </div>
												  <!-- /.form-box -->
												</div>
										@endif
									</div>
									<div class="preview_footer">
										@if($site->Profile!=null)
											<img src="{{url('storage/'.$site->Profile->footer_image)}}" height="200px" width="auto">
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>  
				</div>
			</div>
		</div>
		
	</section>
@stop