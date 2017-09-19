@extends('backend.layouts.app')
@section('content')
	@include('backend.template.tab')
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
							@include('backend.template.menu')
							<div class="col-md-6">
								<h4>Please make your landing page required fields</h4>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<form class="form" action="{{url('dashboard/template/step_two/'.$id)}}" method="POST">
								
										{{csrf_field()}}
										<input type="hidden" name="step" value="{{$step}}">
										<?php $field_1 = isset($site_field)?json_decode($site_field->social_login):null;
											$field_2 = isset($site_field)?json_decode($site_field->form_login):null; ?>

										<div class="row">
											<div class="col-md-3 pull-right"><h4>Social Login</h4></div>
											<div class="col-md-3">
												<label>Facebook Login</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_1!=null && $field_1->fb==1)?'checked':''}} value="1" name="fb"> Yes
												
												<input type="radio" value="0" {{($field_1!=null && $field_1->fb==0)?'checked':''}} name="fb"> No
												
											</div>
											{{-- <div class="col-md-2">
												<label><input type="checkbox" {{($field_1!=null && $field_1->fb_req==1)?'checked':''}} value="1" name="fb_require"> Require</label>
											</div> --}}
										</div><hr>
										<div class="row">
											<div class="col-md-3">
												<label>Gmail Login</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_1!=null && $field_1->gmail==1)?'checked':''}} value="1" name="gmail"> Yes
												
												<input type="radio" value="0" {{($field_1!=null && $field_1->gmail==0)?'checked':''}} name="gmail"> No
											</div>
											{{-- <div class="col-md-2">
												<label><input type="checkbox" {{($field_1!=null && $field_1->g_req==1)?'checked':''}} value="1" name="gmail_require"> Require</label>
											</div>	 --}}										
										</div>										
										<hr>
										<div class="row">
											<div class="col-md-3 pull-right"><h4>Fields Login</h4></div>
											<div class="col-md-3">
												<label>Name</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-5">
												<input type="radio" {{($field_2!=null && $field_2->name==1)?'checked':''}} value="1" name="name"> Yes
												
												<input type="radio" value="0" {{($field_2!=null && $field_2->name==0)?'checked':''}} name="name"> No
											
												<label><input type="checkbox" {{($field_2!=null && $field_2->n_req==1)?'checked':''}} value="1" name="name_require"> Require</label>
											</div>
										</div><hr>
										<div class="row">
											<div class="col-md-3">
												<label>Email</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-5">
												<input type="radio" {{($field_2!=null && $field_2->email==1)?'checked':''}} value="1" name="email"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->email==0)?'checked':''}} name="email"> No
											
												<label><input type="checkbox" {{($field_2!=null && $field_2->e_req==1)?'checked':''}} value="1" name="email_require"> Require</label>
											</div>
										</div><hr>

										<div class="row">
											<div class="col-md-3">
												<label>Gender</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-5">
												<input type="radio" {{($field_2!=null && $field_2->gender==1)?'checked':''}} value="1" name="gender"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->gender==0)?'checked':''}} name="gender"> No
											
												<label><input type="checkbox" {{($field_2!=null && $field_2->g_req==1)?'checked':''}} value="1" name="gender_require"> Require</label>
											</div>
										</div><hr>

										<div class="row">
											<div class="col-md-3">
												<label>Age Group</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-5">
												<input type="radio" {{($field_2!=null && $field_2->age==1)?'checked':''}} value="1" name="age"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->age==0)?'checked':''}} name="age"> No
											
												<label><input type="checkbox" {{($field_2!=null && $field_2->a_req==1)?'checked':''}} value="1" name="age_require"> Require</label>
											</div>
										</div><hr>

										<div class="row">
											<div class="col-md-3">
												<label>Phone</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-5">
												<input type="radio" {{($field_2!=null && $field_2->phone==1)?'checked':''}} value="1" name="phone"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->phone==0)?'checked':''}} name="phone"> No
											
												<label><input type="checkbox" {{($field_2!=null && $field_2->p_req==1)?'checked':''}} value="1" name="ph_require"> Require</label>
											</div>
										</div><hr>
										<div class="row">
											<div class="col-md-3">
												<label>Custom Field 1</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-5">
												<input type="radio" {{($field_2!=null && $field_2->field_1==1)?'checked':''}} value="1" name="field_1"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->field_1==0)?'checked':''}} name="field_1"> No
											
												<label><input type="checkbox" {{($field_2!=null && $field_2->f1_req==1)?'checked':''}} value="1" name="cs1_require"> Require</label>
											</div>
										</div><hr>
										<div class="row">
											<div class="col-md-3">
												<label>Custom Field 2</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-5">
												<input type="radio" {{($field_2!=null && $field_2->field_2==1)?'checked':''}} value="1" name="field_2"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->field_2==0)?'checked':''}} name="field_2"> No
											
												<label><input type="checkbox" {{($field_2!=null && $field_2->f2_req==1)?'checked':''}} value="1" name="cs2_require"> Require</label>
											</div>
										</div>
										<hr>
										<a href="{{url('/dashboard/sites/step_one/'.$id)}}" class="btn btn-default">Back</a>
										<button type="submit" class="btn btn-primary"> {{isset($field_1)?'Update':'Submit'}}</button>
										@if(isset($field_1))<a href="{{url('dashboard/template/step_three/'.$id)}}" class="btn btn-warning">Continue</a>@endif
								</form>
								</div>
							</div>	

					</div>  
				</div>
			</div>
		</div>
		
	</section>
<script type="text/javascript">
</script>
@stop