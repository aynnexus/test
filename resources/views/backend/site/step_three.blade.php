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
								<h4>Please make your landing page Image.</h4>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
								
									<form class="form" action="{{url('dashboard/sites/step_three/'.$id)}}" method="POST" enctype="multipart/form-data">
								
										{{csrf_field()}}
										<input type="hidden" name="step" value="3">
										<div class="form-group">
											<label class="form-label">Header Image : </label>
											<input type="file" name="file_1" class="form-control">
											{{isset($site_photo)?$site_photo->header_image:''}}
										</div>
										<div class="form-group">
											<label class="form-label">Footer Image : </label>
											<input type="file" name="file_2" class="form-control">
											{{isset($site_photo)?$site_photo->footer_image:''}}
										</div>
										<div class="form-group">
											<label class="form-label">Background Image : </label>
											<input type="file" name="file_3" class="form-control">
											{{isset($site_photo)?$site_photo->background_image:''}}
										</div>
										<div class="form-group">
											<label class="form-label">Background Color : </label>
											<input type="text" value="{{isset($site_photo)?$site_photo->background_color:null}}" name="color" class="form-control">
										</div>

										<a href="{{url('/dashboard/sites')}}" class="btn btn-default">Back</a>
										<button type="submit" class="btn btn-primary"> {{isset($site_photo)?'Update':'Submit'}}</button>
										@if(isset($site_photo))<a href="{{url('dashboard/sites/step_four/'.$id)}}" class="btn btn-warning">Preview</a>@endif
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