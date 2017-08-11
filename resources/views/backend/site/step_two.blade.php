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
								<h4>Please make your landing page required fields</h4>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<form class="form" action="{{url('dashboard/sites/step_two/'.$id)}}" method="POST">
								
										{{csrf_field()}}
										<input type="hidden" name="step" value="{{$step}}">
										<?php $field_1 = isset($site_field)?json_decode($site_field->social_login):null;
											$field_2 = isset($site_field)?json_decode($site_field->form_login):null; ?>

										<div class="row">
											<h4>Social Login</h4>
											<div class="col-md-3">
												<label>Facebook Login</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_1!=null && $field_1->fb==1)?'checked':''}} value="1" name="fb"> Yes
												
												<input type="radio" value="0" {{($field_1!=null && $field_1->fb==0)?'checked':''}} name="fb"> No
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label>Gmail Login</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_1!=null && $field_1->gmail==1)?'checked':''}} value="1" name="gmail"> Yes
												
												<input type="radio" value="0" {{($field_1!=null && $field_1->gmail==0)?'checked':''}} name="gmail"> No
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label>Google Login</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_1!=null && $field_1->google==1)?'checked':''}} value="1" name="google"> Yes
												<input type="radio" value="0" {{($field_1!=null&& $field_1->google==0)?'checked':''}} name="google"> No
											</div>
										</div>
										<hr>
										<div class="row">
											<h4>Fields Login</h4>
											<div class="col-md-3">
												<label>Name</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_2!=null && $field_2->name==1)?'checked':''}} value="1" name="name"> Yes
												
												<input type="radio" value="0" {{($field_2!=null && $field_2->name==0)?'checked':''}} name="name"> No
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label>Email</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_2!=null && $field_2->email==1)?'checked':''}} value="1" name="email"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->email==0)?'checked':''}} name="email"> No
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label>Age</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_2!=null && $field_2->age==1)?'checked':''}} value="1" name="age"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->age==0)?'checked':''}} name="age"> No
											</div>
										</div>

										<div class="row">
											<div class="col-md-3">
												<label>Phone</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_2!=null && $field_2->phone==1)?'checked':''}} value="1" name="phone"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->phone==0)?'checked':''}} name="phone"> No
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label>Custom Field 1</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_2!=null && $field_2->field_1==1)?'checked':''}} value="1" name="field_1"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->field_1==0)?'checked':''}} name="field_1"> No
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label>Custom Field 2</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-3">
												<input type="radio" {{($field_2!=null && $field_2->field_2==1)?'checked':''}} value="1" name="field_2"> Yes
												<input type="radio" value="0" {{($field_2!=null && $field_2->field_2==0)?'checked':''}} name="field_2"> No
											</div>
										</div>
										<hr>
										<a href="{{url('/dashboard/sites/step_one/'.$id)}}" class="btn btn-default">Back</a>
										<button type="submit" class="btn btn-primary"> {{isset($field_1)?'Update':'Submit'}}</button>
										@if(isset($field_1))<a href="{{url('dashboard/sites/step_three/'.$id)}}" class="btn btn-warning">Continue</a>@endif
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