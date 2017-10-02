@extends('backend.layouts.app')
@section('content')
<section class="content-header">
	<h1>Guest User Management</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li> 
		<li><a href="{{url('/dashboad/guests')}}"> Guest</a></li>
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
								</div>
								<div class="col-md-6" style="text-align: right">
									<form action="{{url('dashboard/guests/data/search?')}}" class="" method="get" accept-charset="utf-8">
										<select name="site_name">
											<option>Current Site</option>
											@if(isset($sites))
												@foreach($sites as $site)
													<option value="{{$site->site_id}}">{{$site->site_name}}</option>
												@endforeach
											@endif
										</select>
					                  <input type="search" class="" name="guest_name" placeholder="Search Guest Name">
					                </form> 
								</div>
						</div>	
						<div class="row">
							<div class="col-sm-12">
								<table class="table table-bordered table-striped dataTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Email/Phone</th>
											<th>Gender/Age Group</th>
											<th>Site Name</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									@if(isset($site->Guests))
									<tbody>

										@foreach($site->Guests as $key=>$row)
										 
										<tr>
											<td>{{$key+1}}.</td>
											<td>
												<div>
													<a id="" value="" href="#">{{$row->name}}</a>
												</div>	
											</td>									
											<td><i class="fa fa-envelope"></i> {{$row->email}} <br> <i class="fa fa-phone"></i> {{$row->phone}}</td>
											<td>{{$row->Gender($row->gender)}} / {{$row->Age($row->age)}}</td>
											<td>
												{{$row->Site['site_name']}}
											</td>
											<td>
												{{date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<a href="{{url('dashboard/guests/detail/'.$row->guest_id)}}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Check</a>
												<a href="{{url('/dashboard/guests/remove/'.$row->guest_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
											</td>
										</tr>
										
                    					@endforeach
                    					
									</tbody>
									@endif	
								</table>
							</div>
						</div>
					</div>  
					<div class="box-footer">
						<div class="pull-right">
						@if(isset($guests))
							{{ $guests->links('vendor.pagination.bootstrap-4') }}
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
@stop