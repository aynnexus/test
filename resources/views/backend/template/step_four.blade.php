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
								<h4>Please make your feedback page required fields</h4>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<form class="form" action="{{url('dashboard/template/step_four/'.$id)}}" method="POST">
								
										{{csrf_field()}}
										<input type="hidden" name="step" value="{{$step}}">
										<?php $fdb = isset($feedback)?json_decode($feedback->feedback_fields):null; ?>

										<div class="row">
											<div class="col-md-3">
												<label>Facebook Check-in</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-2">
												<input type="radio" {{($fdb!=null && $fdb->checkin==1)?'checked':''}} value="1" name="checkin"> Yes
												
												<input type="radio" {{($fdb!=null && $fdb->checkin==0)?'checked':''}} value="0" name="checkin"> No
												
											</div>											
										</div><hr>
										<div class="row">
											<div class="col-md-3">
												<label>Facebook Like</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-2">
												<input type="radio" {{($fdb!=null && $fdb->like==1)?'checked':''}} value="1" name="like"> Yes
												
												<input type="radio" {{($fdb!=null && $fdb->like==0)?'checked':''}} value="0" name="like"> No
											</div>										
										</div>										
										<hr>
										<div class="row">
											<div class="col-md-3">
												<label>Comment Box</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-2">
												<input type="radio" {{($fdb!=null && $fdb->comment==1)?'checked':''}} value="1" name="comment"> Yes
												
												<input type="radio" {{($fdb!=null && $fdb->comment==0)?'checked':''}} value="0" name="comment"> No
											</div>
											<div class="col-md-2">
												<label><input type="checkbox" {{($fdb!=null && $fdb->cbb_require==1)?'checked':''}} value="1" name="cbb_require"> Require</label>
											</div>
										</div><hr>
										<div class="row">
											<div class="col-md-3">
												<label>Survey</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-2">
												<input type="radio" {{($fdb!=null && $fdb->survey==1)?'checked':''}} value="1" name="survey"> Yes
												<input type="radio" {{($fdb!=null && $fdb->survey==0)?'checked':''}} value="0" name="survey"> No
											</div>
											<!-- <div class="col-md-2">
												<label><input type="checkbox" {{($fdb!=null && $fdb->s_require==1)?'checked':''}} value="1" name="s_require"> Require</label>
											</div> -->
										</div><hr>
										<div class="row" id="select_open">
											<div class="col-md-12">
												<div class="col-md-6">	
													{!! Form::select('survey_id[]',$survey,$surveyings,['class'=>'form-control select2','multiple data-placeholder'=>'Select one rate']) !!}
												</div>	
											</div>
										</div><hr>
										<div class="row">
											<div class="col-md-3">
												<label>Rate</label>
											</div>
											<div class="col-md-1">:</div>
											<div class="col-md-2">
												<input type="radio" id="Yes" {{($fdb!=null && $fdb->rate==1)?'checked':''}} value="1" name="rate"> Yes
												<input type="radio" id="No" {{($fdb!=null && $fdb->rate==0)?'checked':''}} value="0" name="rate"> No
											</div>
											<!-- <div class="col-md-2">
												<label><input type="checkbox" {{($fdb!=null && $fdb->r_require==1)?'checked':''}} value="1" name="r_require"> Require</label>
											</div> -->

										</div>
										<br>
										
										<div class="row" id="select_open">
											<div class="col-md-12">
												<div class="col-md-6">													
													{!! Form::select('rate_id[]',$rate,$ratings,['class'=>'form-control select2','multiple data-placeholder'=>'Select one rate']) !!}
												</div>											
												<div class="col-md-4">
													<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp"><i class="fa fa-plus"></i> Add New Rate</button>
												</div>
											</div>
										</div>
										
										<hr>
										<a href="{{url('/dashboard/sites/step_one/'.$id)}}" class="btn btn-default">Back</a>
										<button type="submit" class="btn btn-primary"> {{isset($fdb)?'Update':'Submit'}}</button>
										@if(isset($fdb))<a href="{{url('dashboard/template/step_five/'.$id)}}" class="btn btn-warning">Continue</a>@endif
								</form>
								</div>
							</div>	

					</div>  
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="viewDetailPopUp" role="dialog">
		 	<div class="modal-dialog modal-sm">
		 		<div class="modal-content">
		 			<div class="modal-header"> 				
		 				<button type="button" class="close" data-dismiss="modal">&times;</button>
		 				<h3>Add New Rate</h3>
		 				<!-- <h4 class="modal-title">Modal Header</h4> -->
		 				<form class="form" action="{{url('dashboard/rate/add')}}" method="POST">
		 					{{csrf_field()}}
		 					<div class="form-group">
		 						<label class="form-label">Rate Label</label>
		 						<input type="text" name="rate_title" class="form-control" required placeholder="Hash">
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

		<div class="modal fade" id="surveryPopUp" role="dialog">
		 	<div class="modal-dialog modal-md">
		 		<div class="modal-content">
		 			<div class="modal-header"> 				
		 				<button type="button" class="close" data-dismiss="modal">&times;</button>
		 				<h3>Add New Suvery</h3>
		 				<!-- <h4 class="modal-title">Modal Header</h4> -->
		 				<form class="form" action="{{url('dashboard/survey/add')}}" method="POST">
		 					{{csrf_field()}}
		 					<div class="form-group">
		 						<label class="form-label">Slug</label>
		 						<input type="text" name="slug" class="form-control" required placeholder="Hash">
		 					</div>
		 					<div class="form-group">
		 						<label class="form-label">Suvery Label</label>
		 						<input type="text" name="survey_title" class="form-control" required placeholder="Hash">
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
	</section>
<!-- <script type="text/javascript">
	$('input#Yes').on('click',function(){
		$('#select_open').show();
		$('select#rating').attr('required',true);
	})
	$('input#No').on('click',function(){
		$('#select_open').hide();
		$('select#rating').attr('required',false);
	})
</script> -->
@stop