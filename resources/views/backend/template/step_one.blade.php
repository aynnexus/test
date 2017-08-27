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
								<h4>Please tags your site or add new site.</h4>
							</div>
							<div class="row">
								
								<div class="col-md-6 col-md-offset-3">
									@if(isset($template))
									<form class="form" action="{{url('dashboard/template/step_one/'.$template->template_id)}}" method="POST">
									@else
									<form class="form" action="{{url('dashboard/template/step_one')}}" method="POST">
									@endif
										{{csrf_field()}}
										<input type="hidden" name="step" value="{{isset($template)?$template->step:1}}">
										<div class="form-group">
											<label class="form-label">Choice Site Code</label>
											<?php $sit = isset($template)?array_map('intval', json_decode($template->site_id)):null ?>
											{!! Form::select('site_name[]',$sites,$sit,['class'=>'form-control select2','required','multiple data-placeholder'=>'Select One']) !!}
										</div>
										
										<a href="{{url('/dashboard/template')}}" class="btn btn-default">Back</a>
										<button type="submit" class="btn btn-primary"> {{isset($template)?'Update':'Submit'}}</button>
										@if(isset($template))<a href="{{url('dashboard/template/step_two/'.$id)}}" class="btn btn-warning">Continue</a>@endif
									</form>
								</div>
								<div class="col-md-2">
									<div style="color: transparent;margin-bottom: 5px">skip</div>
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp0"><i class="fa fa-plus"></i> Add New Site</button>
								</div>
							</div>	

					</div>  
				</div>
			</div>
		</div>
		
	</section>
 <!-- Modal -->
	 <div class="modal fade" id="viewDetailPopUp0" role="dialog">
	 	<div class="modal-dialog modal-md">
	 		<div class="modal-content">
	 			<div class="modal-header"> 				
	 				<button type="button" class="close" data-dismiss="modal">&times;</button>
	 				<h3>Add New Site</h3>
	 				<!-- <h4 class="modal-title">Modal Header</h4> -->
	 				<form class="form" action="{{url('dashboard/sites/store/0')}}" method="POST">
	 					{{csrf_field()}}
	 					<div class="form-group">
	 						<label class="form-label">Site Code</label>
	 						<input type="text" name="site_name" class="form-control" required placeholder="Hash">
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
	 					<div class="form-group">
	 						<div class="row">
	 							<div class="col-md-6">
	 								<label class="form-label">Session Timeout Limit (Mins)</label>
	 								<input type="text"  name="timeout_limit" class="form-control" required placeholder="10 Mins">
	 							</div>
	 							<div class="col-md-6">
	 								<label class="form-label">Download/Upload Speedlimit (Mb)</label>
	 								<input type="text" name="speed_limit" class="form-control" required placeholder="100 Mb">
	 							</div>
	 						</div>
	 					</div>
	 					<button type="submit" class="btn btn-primary">Submit</button>
	 				</form>
	 			</div>

	 			<div class="modal-footer">
	 				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	 			</div>
	 		</div>
	 	</div>
	 </div>
 <!-- model end -->
@stop