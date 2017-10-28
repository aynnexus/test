@extends('backend.layouts.app')
@section('content')
	@include('backend.template.tab')
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						<div class="dataTables_wrapper form-inline dt-bootstrap">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dashboard/template/step_one/0')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New Template</a>
								</div>
								<div class="col-md-6" style="text-align: right">
									<!-- <form action="{{url('admin/category/data/response?')}}" class="" method="get" accept-charset="utf-8">
					                  <input type="search" class="" name="category_search" placeholder="Search Name">
					                  <input type="hidden" class="" name="type" value="">
					                </form>  -->
								</div>
							</div>	
							<div class="row">
								<div class="col-sm-12">
									<table class="table table-bordered table-striped dataTable">
									<thead>

										<tr>
											<th>#</th>
											<th>Template in Site</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($templates as $key=>$row)
										<tr>
											<td>{{$key+1}}.</td>
											<td>
												@foreach($row->Site($row->site_id) as $val)
													<p>{{$val}}</p>
												@endforeach
											</td>
											<td>
												<p data-toggle="modal" data-target="#ChangeStatusBox{{$row->template_id}}" class='btn btn-{{($row->status==ACTIVE)?'success':'danger'}} btn-xs'>{{$row->status==ACTIVE?'Enabled':'Disabled'}}</p>
											</td>
											<td>
												{{$row->User['name'].' / '.date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<a href="{{url('dashboard/template/step_one/'.$row->template_id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
												<a href="#" onclick="targetButton({{$row->template_id}},'template')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
											</td>
										</tr>
										<!-- Modal -->
										 	<div class="modal fade" id="ChangeStatusBox{{$row->template_id}}" role="dialog">
											 	<div class="modal-dialog modal-sm">
											 		<div class="modal-content">
											 			<div class="modal-header"> 				
											 				<button type="button" class="close" data-dismiss="modal">&times;</button>
											 				<h4>Select Status</h4>
											 				<!-- <h4 class="modal-title">Modal Header</h4> -->
											 				<div class="col-md-offset-3">
											 					<a href="{{url('/dashboard/template/status/1/'.$row->template_id)}}" class='btn btn-success'>Enable</a>
											 					<a href="{{url('/dashboard/template/status/0/'.$row->template_id)}}" class='btn btn-danger'>Disable</a>
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
		</div>
		
	</section>
@stop