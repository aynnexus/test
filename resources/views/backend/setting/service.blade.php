@extends('backend.layouts.app')
@section('content')  
<section class="content-header">
	<h1>Service Management</h1>
		<ol class="breadcrumb">
			<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li> 
			<li><a href="#"> Setting</a></li>
			<li><a href="{{url('/dashboad/setting/service')}}"> Service</a></li>
			<li class="active"> Action</li>
		</ol>
</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						<div class="row">
								<div class="col-md-6">
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp0"><i class="fa fa-plus"></i> Add</button>
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
											<th>ID</th>
											<th>Secrect</th>
											<th>Provider</th>
											<th>Created At</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if(isset($services))
										@foreach($services as $key=>$row)
										<tr>
											<td>{{$key+1}}.</td>
											<td>
												{{$row->id}}
											</td>									
											
											<td>
												{{$row->secrect}}
											</td>
											<td>
												@if($row->type==1)	
													Facebook
												@else
													Google
												@endif
											</td>
											<td>
												{{date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewDetailPopUp{{$row->service_id}}"><i class="fa fa-edit"></i> Edit</button>
												
												
											</td>
										</tr>
										 <!--edit Modal -->
											<div class="modal fade" id="viewDetailPopUp{{$row->service_id}}" role="dialog">
											 	<div class="modal-dialog modal-md">
											 		<div class="modal-content">
											 			<div class="modal-header"> 				
											 				<button type="button" class="close" data-dismiss="modal">&times;</button>
											 				<h3>Edit </h3>
											 				<!-- <h4 class="modal-title">Modal Header</h4> -->
											 				
											 				<form action="{{url('dashboard/settings/service/'.$row->service_id)}}" method="POST">
											 					{{csrf_field()}}
											 					<div class="form-group">
											 						<label class="form-label">ID</label>
											 						<input type="text" value="{{$row->id}}" name="id" class="form-control" required>
											 					</div>
											 					<div class="form-group">
											 						<label class="form-label">Secrect</label>
											 						<input type="text" name="secrect" class="form-control" value="{{$row->secrect}}" required>
											 					</div>
											 					
												 					<div class="form-group">
												 						<label class="form-label">Provider</label>
												 						<select class="form-control" name="question_id" required>
												 							<option {{$row->type==1?'selected':''}} value="1">Facebook</option>
												 							<option {{$row->type==2?'selected':''}} value="2">Google</option>
												 							
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
                    				@endif
									</tbody>
								</table>
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
 				<h3>Add New</h3>
 				<!-- <h4 class="modal-title">Modal Header</h4> -->
 				<form class="form" action="{{url('dashboard/settings/service/0')}}" method="POST">
 					{{csrf_field()}}
 					<div class="form-group">
 						<label class="form-label">ID</label>
 						<input type="text" name="id" class="form-control" required>
 					</div>
 					<div class="form-group">
 						<label class="form-label">Secrect</label>
 						<input type="text" name="secrect" class="form-control" required>
 					</div>
 					
	 					<div class="form-group">
	 						<label class="form-label">Provider</label>
	 						<select class="form-control" name="type" required>
	 							<option value="1">Facebook</option>
	 							<option value="2">Google</option>
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