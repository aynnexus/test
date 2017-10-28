@extends('backend.layouts.app')
@section('content')
<section class="content-header">
	<h1>LookUp Management <br> <i class="text-yellow">Warning!</i><small><b>This module define key is very <i class="text-red">important.</i> Please make with <i class="text-warning">unit key</i>.</b></small></h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li> 
		<li><a href="{{url('/dashboad/lookup')}}"> LookUp</a></li>
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
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp0"><i class="fa fa-plus"></i> Add New Lookup</button>
								</div>
								<div class="col-md-6" style="text-align: right">
									<form action="{{url('admin/category/data/response?')}}" class="" method="get" accept-charset="utf-8">
					                  <!-- <input type="search" class="custom-input" name="category_search" placeholder="Search Name">
					                  <input type="hidden" class="" name="type" value=""> -->
					                </form> 
								</div>
						</div>	
						<div class="row">
							<div class="col-sm-12">
								<table class="table table-bordered table-striped dataTable">
									<thead>

										<tr>
											<th>#</th>
											<th>Title (Slug)</th>
											<th>Key</th>
											<th>Value</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($lookups as $key=>$row)
										<tr>
											<td>{{$key+1}}.</td>
											<td>{{$row->title}}</td>	
											<td>{{$row->key}}</td>
											<td>{{$row->value}}</td>
											<td>
												<p data-toggle="modal" data-target="#ChangeStatusBox{{$row->lookup_id}}" class='btn btn-{{($row->status==ACTIVE)?'success':'danger'}} btn-xs'>{{$row->status==ACTIVE?'Enabled':'Disabled'}}</p>
											</td>
											<td>
												{{$row->User['name'].' / '.date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<a href="#" data-toggle="modal" data-target="#viewDetailPopUp{{$row->lookup_id}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
												<a href="{{url('/dashboard/settings/lookup/remove/'.$row->lookup_id)}}" onclick="return confirm('Are you want to sure delete?')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
											</td>
										</tr>
										 <!-- edit Modal -->
											 <div class="modal fade" id="viewDetailPopUp{{$row->lookup_id}}" role="dialog">
											 	<div class="modal-dialog modal-md">
											 		<div class="modal-content">
											 			<div class="modal-header"> 				
											 				<button type="button" class="close" data-dismiss="modal">&times;</button>
											 				<h3>Edit Lookup</h3>
											 				<!-- <h4 class="modal-title">Modal Header</h4> -->
											 				<form class="form" action="{{url('dashboard/settings/lookup/'.$row->lookup_id)}}" method="POST">
											 					{{csrf_field()}}
											 					<div class="form-group">
											 						<label class="form-label">Title (Slug)</label>
											 						<input disabled type="text" value="{{$row->title}}" name="title" class="form-control" required placeholder="Site Status">
											 					</div>
											 					<div class="form-group">											
											 						<div class="row">
											 							<div class="col-md-6">
											 								<label class="form-label">Define Key</label>
											 								<input type="text" value="{{$row->key}}" name="key" class="form-control" required>
											 							</div>
											 							<div class="col-md-6">
											 								<label class="form-label">Value</label>
											 								<input type="text" value="{{$row->value}}" name="value" class="form-control" required>
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
										 	<div class="modal fade" id="ChangeStatusBox{{$row->lookup_id}}" role="dialog">
											 	<div class="modal-dialog modal-sm">
											 		<div class="modal-content">
											 			<div class="modal-header"> 				
											 				<button type="button" class="close" data-dismiss="modal">&times;</button>
											 				<h4>Select Status</h4>
											 				<!-- <h4 class="modal-title">Modal Header</h4> -->
											 				<div class="col-md-offset-3">
											 					<a href="{{url('/dashboard/settings/lookup/1/'.$row->lookup_id)}}" class='btn btn-success'>Enable</a>
											 					<a href="{{url('/dashboard/settings/lookup/0/'.$row->lookup_id)}}" class='btn btn-danger'>Disable</a>
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
	 				<h3>Add New Lookup</h3>
	 				<!-- <h4 class="modal-title">Modal Header</h4> -->
	 				<form class="form" action="{{url('dashboard/settings/lookup/0')}}" method="POST">
	 					{{csrf_field()}}
	 					<div class="form-group">
	 						<label class="form-label">Title (Slug)</label>
	 						<input type="text" name="title" class="form-control" required placeholder="Site Status..">
	 					</div>
	 					<div class="form-group">											
	 						<div class="row">
	 							<div class="col-md-6">
	 								<label class="form-label">Define Key</label>
	 								<input type="text" name="key" class="form-control" required placeholder="1,2,3...">
	 							</div>
	 							<div class="col-md-6">
	 								<label class="form-label">Define Value</label>
	 								<input type="text" name="value" class="form-control" required placeholder="Test">
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