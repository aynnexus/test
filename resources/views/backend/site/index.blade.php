@extends('backend.layouts.app')
@section('content')
<section class="content-header">
	<h1>Site Template Management</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li> 
		<li><a href="{{url('/dashboad/sites')}}"> Site</a></li>
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
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp0"><i class="fa fa-plus"></i> Add New Site</button>
								</div>
								<div class="col-md-6" style="text-align: right">
									<form action="{{url('dashboard/sites/search?')}}" class="" method="get" accept-charset="utf-8">
					                  <input type="search" class="" name="name" placeholder="Search Name">
					                </form> 
								</div>
						</div>	
						<div class="row">
							<div class="col-sm-12">
								<table class="table table-bordered table-striped dataTable">
									<thead>

										<tr>
											<th>#</th>
											<th>Site Name</th>
											<th>Data Limitation</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($sites as $key=>$row)
										<tr>
											<td>{{$key+1}}.</td>
											<td>
												<div>
													<a id="" value="" href="#">{{$row->site_name}}</a>
												</div>	
											</td>	
											<td>
												{{$row->data_limit}} Kbs /
												{{$row->time_limit}} Minite
											</td>
											<td>
												<p data-toggle="modal" data-target="#ChangeStatusBox{{$row->site_id}}" class='btn btn-{{($row->status==ACTIVE)?'success':'danger'}} btn-xs'>{{$row->status==ACTIVE?'Enabled':'Disabled'}}</p>
											</td>
											<td>
												{{date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<a href="#" data-toggle="modal" data-target="#viewDetailPopUp{{$row->site_id}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Check</a>
												<a href="{{url('/dashboard/sites/remove/'.$row->site_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
											</td>
										</tr>
										<!-- edit Modal -->
											 <div class="modal fade" id="viewDetailPopUp{{$row->site_id}}" role="dialog">
											 	<div class="modal-dialog modal-md">
											 		<div class="modal-content">
											 			<div class="modal-header"> 				
											 				<button type="button" class="close" data-dismiss="modal">&times;</button>
											 				<h3>Edit Site</h3>
											 				<!-- <h4 class="modal-title">Modal Header</h4> -->
											 				<form class="form" action="{{url('dashboard/sites/store/'.$row->site_id)}}" method="POST">
											 					{{csrf_field()}}				
											 					<div class="form-group">		
											 						<div class="row">
											 							<div class="col-md-6">
											 								<label class="form-label">Site Name</label>
											 								<input type="text" value="{{$row->site_name}}" name="site_name" class="form-control" required placeholder="Hash">
											 							</div>
											 							<div class="col-md-6">
											 								<label class="form-label">Site Code</label>
											 								<input type="text" value="{{$row->site_code}}" name="site_code" class="form-control" required placeholder="Hash">
											 							</div>
											 						</div>
											 					</div>
											 					<div class="form-group">
											 						<div class="row">
											 							<div class="col-md-6">
											 								<label class="form-label">Session Datalimit (Mb)</label>
											 								<input type="text"  name="limit_data" class="form-control" value="{{isset($row)?$row->data_limit:null}}" required placeholder="3 Mbs">
											 							</div>
											 							<div class="col-md-6">
											 								<label class="form-label">Session Timelimit (Mins)</label>
											 								<input type="text" value="{{isset($row)?$row->time_limit:null}}" name="limit_time" class="form-control" required placeholder="2 Minite">
											 							</div>
											 						</div>
											 					</div>
											 					<div class="form-group">
											 						<div class="row">
											 							<div class="col-md-6">
											 								<label class="form-label">Session Timeout Limit (Mins)</label>
											 								<input type="text"  name="timeout_limit" class="form-control" value="{{isset($row)?$row->timeout_limit:null}}" required placeholder="10 Mins">
											 							</div>
											 							<div class="col-md-6">
											 								<label class="form-label">Download/Upload Speedlimit (Mb)</label>
											 								<input type="text" value="{{isset($row)?$row->speed_limit:null}}" name="speed_limit" class="form-control" required placeholder="100 Mb">
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
										 <!-- status Modal -->
										 	<div class="modal fade" id="ChangeStatusBox{{$row->site_id}}" role="dialog">
											 	<div class="modal-dialog modal-sm">
											 		<div class="modal-content">
											 			<div class="modal-header"> 				
											 				<button type="button" class="close" data-dismiss="modal">&times;</button>
											 				<h4>Select Status</h4>
											 				<!-- <h4 class="modal-title">Modal Header</h4> -->
											 				<div class="col-md-offset-3">
											 					<a href="{{url('/dashboard/sites/status/1/'.$row->site_id)}}" class='btn btn-success'>Enable</a>
											 					<a href="{{url('/dashboard/sites/status/0/'.$row->site_id)}}" class='btn btn-danger'>Disable</a>
											 				</div>
											 			</div>

											 			<div class="modal-footer">
											 				<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
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
	 						<div class="row">
	 							<div class="col-md-6">	 							
	 								<label class="form-label">Site Name</label>
	 								<input type="text" name="site_name" class="form-control" required placeholder="Hash">
	 							</div>
		 						<div class="col-md-6">
		 							<label class="form-label">Site Code</label>
		 							<input type="text" name="site_code" class="form-control" required placeholder="Hash">
		 						</div>
	 						</div>
	 					</div>
	 					<div class="form-group">
	 						<div class="row">
	 							<div class="col-md-6">
	 								<label class="form-label">Session Datalimit (Mb)</label>
	 								<input type="text"  name="limit_data" class="form-control" required placeholder="3 Mbs">
	 							</div>
	 							<div class="col-md-6">
	 								<label class="form-label">Session Timelimit (Mins)</label>
	 								<input type="text" name="limit_time" class="form-control" required placeholder="2 Mins">
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