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
								<h4>Please fill your landing page information</h4>
							</div>
							<div class="row">
								
								<div class="col-md-6 col-md-offset-3">
								@if(isset($site))
									<form class="form" action="{{url('dashboard/sites/step_one/'.$site->site_id)}}" method="POST">
								@else
									<form class="form" action="{{url('dashboard/sites/step_one')}}" method="POST">
								@endif
										{{csrf_field()}}
										<input type="hidden" name="step" value="{{isset($site)?$site->step:1}}">
										<div class="form-group">
											<label class="form-label">Site Name</label>
											<input type="text" value="{{isset($site)?$site->site_name:null}}" name="site_name" class="form-control" required placeholder="TERLLE">
										</div>
										<div class="form-group">											
											<div class="row">
												<div class="col-md-6">
													<label class="form-label">Site Location (Lag)</label>
													<?php $loc = isset($site)?json_decode($site->site_location):null; ?>
													<input type="text" value="{{$loc!=null?$loc->lag:$loc}}" name="lag" class="form-control" required placeholder="09.9445445">
												</div>
												<div class="col-md-6">
													<label class="form-label">Site Location (Lat)</label>
													<input type="text" value="{{$loc!=null?$loc->lat:$loc}}" name="lat" class="form-control" required placeholder="09.9445445">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label class="form-label">Session Datalimit (Mb)</label>
													<input type="text"  name="limit_data" class="form-control" value="{{isset($site)?$site->data_limit:null}}" required placeholder="3 Mbs">
												</div>
												<div class="col-md-6">
													<label class="form-label">Session Timelimit (Mins)</label>
													<input type="text" value="{{isset($site)?$site->time_limit:null}}" name="limit_time" class="form-control" required placeholder="2 Minite">
												</div>
											</div>
										</div>
										<a href="{{url('/dashboard/sites')}}" class="btn btn-default">Back</a>
										<button type="submit" class="btn btn-primary"> {{isset($site)?'Update':'Submit'}}</button>
										@if(isset($site))<a href="{{url('dashboard/sites/step_two/'.$id)}}" class="btn btn-warning">Continue</a>@endif
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