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
								<h4>Please make your landing page Image.</h4>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
								
									<form class="form" action="{{url('dashboard/template/step_three/'.$id)}}" method="POST" enctype="multipart/form-data">
								
										{{csrf_field()}}
										<input type="hidden" name="step" value="3">
										<div class="form-group">
											<label class="form-label">Header Image : </label>
											<input type="file" name="file_1" class="form-control">
											<div class="clr"></div>
											{{isset($site_photo)?$site_photo->header_image:''}}
											@if(isset($site_photo) && $site_photo->header_image!=null)
												<a href="{{url('dashboard/template/photo/remove/?type=hd&id='.$id)}}" class="btn btn-danger btn-xs pull-right"><i class="fa fa-remove"></i></a>
											@endif
										</div>
										<div class="form-group">
											<label class="form-label">Logo Image : </label>
											<input type="file" name="file_4" class="form-control">
											<div class="clr"></div>
											{{isset($site_photo)?$site_photo->logo_image:''}}
											@if(isset($site_photo) && $site_photo->logo_image!=null)
												<a href="{{url('dashboard/template/photo/remove/?type=lg&id='.$id)}}" class="btn btn-danger btn-xs pull-right"><i class="fa fa-remove"></i></a>
											@endif
										</div>
										<div class="form-group">
											<label class="form-label">Footer Image : </label>
											<input type="file" name="file_2" class="form-control">
											<div class="clr"></div>
											{{isset($site_photo)?$site_photo->footer_image:''}}
											@if(isset($site_photo) && $site_photo->footer_image!=null)
												<a href="{{url('dashboard/template/photo/remove/?type=ft&id='.$id)}}" class="btn btn-danger btn-xs pull-right"><i class="fa fa-remove"></i></a>
											@endif
										</div>
										<div class="form-group">
											<label class="form-label">Background Image : </label>
											<input type="file" name="file_3" class="form-control">
											<div class="clr"></div>
											{{isset($site_photo)?$site_photo->background_image:''}}
											@if(isset($site_photo) && $site_photo->background_image!=null)
												<a href="{{url('dashboard/template/photo/remove/?type=bg&id='.$id)}}" class="btn btn-danger btn-xs pull-right"><i class="fa fa-remove"></i></a>
											@endif
										</div>
										<div class="form-group">
											<label class="form-label">Background Color : </label>
											<input type="text" value="{{isset($site_photo)?$site_photo->background_color:null}}" name="color" class="form-control">
										</div>

										<a href="{{url('/dashboard/template')}}" class="btn btn-default">Back</a>
										<button type="submit" class="btn btn-primary"> {{isset($site_photo)?'Update':'Submit'}}</button>
										@if(isset($site_photo))<a href="{{url('dashboard/template/step_five/'.$id)}}" class="btn btn-warning">Continue</a>@endif
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