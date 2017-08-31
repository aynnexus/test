@extends('backend.layouts.app')
@section('content')
	@include('backend.client.tab')
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						<div class="dataTables_wrapper form-inline dt-bootstrap">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dashboard/clients/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Client</a>
								</div>
								<div class="col-md-6" style="text-align: right">
									<form action="{{url('dashboard/clients/search?')}}" class="" method="get" accept-charset="utf-8">
					                  <input type="search" class="" name="name" placeholder="Search client name">
					                </form> 
								</div>
							</div>	
							<div class="row">
								<div class="col-sm-12">
									<table class="table table-bordered table-striped dataTable">
									<thead>

										<tr>
											<th>#</th>
											<th>Client Name</th>
											<th>Client Email</th>
											<th>Site Name</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($clients as $key=>$row)
										<tr>
											<td>{{$key+1}}.</td>
											<td>
												<div>
													<a id="" value="" href="#">{{$row->User->name}}</a>
												</div>	
											</td>
											<td>
												{{$row->User->email}}
											</td>									
											<td>
												@foreach($row->site($row->site_id) as $site_name)
													<p>{{$site_name}}</p>
												@endforeach
												
											</td>
											
											<td>
												{{showPrettyStatus($row->status)}}
											</td>
											<td>
												{{date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<a href="{{url('/dashboard/clients/edit/'.$row->client_id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Check</a>
												<a href="{{url('/dashboard/clients/remove/'.$row->client_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
											</td>
										</tr>
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