@extends('backend.layouts.app')
@section('content')
	@include('backend.site.tab')
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						<div class="dataTables_wrapper form-inline dt-bootstrap">
							<div class="row">
								<div class="col-md-6">
									<a href="{{url('dashboard/sites/step_one/0')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Site</a>
								</div>
								<div class="col-md-6" style="text-align: right">
									<label>Search
										<input type="search" class="form-control input-sm" name="site_search">
									</label>
								</div>
							</div>	
							<div class="row">
								<div class="col-sm-12">
									<table class="table table-bordered table-striped dataTable">
									<thead>

										<tr>
											<th>#</th>
											<th>Site Name</th>
											<th>Location (Lag/Lat)</th>
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
												<?php $loc = json_decode($row->site_location); ?>
												{{$loc->lag.' / '.$loc->lat}}
											</td>
											<td>
												{{$row->data_limit}} Kbs /
												{{$row->time_limit}} Minite
											</td>
											<td>
												<p onclick='getStatus({{$row->site_id}});' class='btn btn-{{($row->status==ACTIVE)?'success':'danger'}} btn-xs'>{{$row->status==ACTIVE?'Enabled':'Disabled'}}</p>
											</td>
											<td>
												{{date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<a href="{{url('/dashboard/sites/'.normal_step($row->step).'/'.$row->site_id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Check</a>
												<a href="{{url('/dashboard/sites/remove/'.$row->site_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
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
<script type="text/javascript">
	
function getStatus(status)
{
    $('#ChangeStatusBox').modal('show',status);
}
</script>
@stop