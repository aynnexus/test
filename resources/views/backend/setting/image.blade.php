@extends('backend.layouts.app')
@section('content')
	<section class="content-header">
		<h1>Image Management</h1>
		<ol class="breadcrumb">
			<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li> 
			<li><a href="#"> Setting</a></li>
			<li><a href="{{url('/dashboad/setting/images')}}"> Image</a></li>
			<li class="active"> Action</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						<div class="dataTables_wrapper form-inline dt-bootstrap">
							<div class="row">
								<div class="col-md-6">
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp0"><i class="fa fa-plus"></i> Add Site</button>
								</div>
								<div class="col-md-6" style="text-align: right">
									
								</div>
							</div>	
							<div class="row">
								<div class="col-sm-12">
									<table class="table table-bordered table-striped dataTable">
									<thead>

										<tr>
											<th>#</th>
											<th>Width & Height</th>
											<th>Position</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($images as $key=>$row)
										<tr>
											<td>{{$key+1}}.</td>
											<td>
												{{$row->width.'x'.$row->height}}
											</td>									
											<td>
												<?php $pos = ['default','Top','Botton','Center'] ?>
												{{$pos[$row->position]}}
											</td>
											<td>
												{{showPrettyStatus($row->status)}}
											</td>
											<td>
												{{date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp{{$row->id}}"><i class="fa fa-edit"></i> Edit</button>
												<a href="{{url('/dashboard/settings/images/remove/'.$row->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
											</td>
										</tr>
										 <!--edit Modal -->
											 <div class="modal fade" id="viewDetailPopUp{{$row->id}}" role="dialog">
											 	<div class="modal-dialog modal-md">
											 		<div class="modal-content">
											 			<div class="modal-header"> 				
											 				<button type="button" class="close" data-dismiss="modal">&times;</button>
											 				<h3>Edit Image</h3>
											 				<!-- <h4 class="modal-title">Modal Header</h4> -->
											 				<form action="{{url('dashboard/settings/images/create/'.$row->id)}}" method="POST">
											 					{{csrf_field()}}
											 					<div class="form-group">
											 						<label class="form-label">Width</label>
											 						<input type="text" name="width" class="form-control" value="{{$row->width}}" required>
											 					</div>
											 					<div class="form-group">
											 						<label class="form-label">Height</label>
											 						<input type="text" name="height" class="form-control" value="{{$row->height}}" required>
											 					</div>
											 					<div class="form-group">
											 						<label class="form-label">Position</label>
											 						<select class="form-control" name="position" required>
											 							<option>Select One</option>
											 							<option {{$row->position==1?'selected':''}} value="1">Top</option>
											 							<option {{$row->position==2?'selected':''}} value="2">Button</option>
											 							<option {{$row->position==3?'selected':''}} value="3">Center</option>
											 						</select>
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
                    					@endforeach
									</tbody>
								</table>
								</div>
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
 				<h3>Add New Image</h3>
 				<!-- <h4 class="modal-title">Modal Header</h4> -->
 				<form class="form" action="{{url('dashboard/settings/images/create/0')}}" method="POST">
 					{{csrf_field()}}
 					<div class="form-group">
 						<label class="form-label">Width</label>
 						<input type="text" name="width" class="form-control" required>
 					</div>
 					<div class="form-group">
 						<label class="form-label">Height</label>
 						<input type="text" name="height" class="form-control" required>
 					</div>
 					<div class="form-group">
 						<label class="form-label">Position</label>
 						<select class="form-control" name="position" required>
 							<option>Select One</option>
 							<option value="1">Top</option>
 							<option value="2">Button</option>
 							<option value="3">Center</option>
 						</select>
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