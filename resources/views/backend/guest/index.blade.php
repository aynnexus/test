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
					<div class="box-header">
						<form action="{{url('dashboard/guests/search?')}}" class="" method="get" accept-charset="utf-8">
				            	<div class="col-sm-2">
				            		<div class="form-group">
				            			<select name="site_id" class="form-control select2">
											<option>Current Site</option>
											@if(isset($sites))
												@foreach($sites as $key=>$value)
													<option {{isset($_GET['to_date'])&&$_GET['site_id']==$value?'selected':''}} value="{{$value}}">{{$key}}</option>
												@endforeach
											@endif
										</select>
				            		</div>
				            	</div>
				            	<div class="col-sm-2">
				            		<div class="form-group">
				            			<input type="search" class="form-control" value="<?php echo isset($_GET['name'])?$_GET['name']:null ?>" name="name" placeholder="Search Name">
				            		</div>
				            	</div>
				                <div class="col-sm-2">
				                    <div class="input-group date">
				                        <input type="text" value="<?php echo isset($_GET['from_date'])?$_GET['to_date']:null ?>" name="from_date" class="form-control datetimepicker" placeholder="From">
				                        <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                    </div>
				                </div>

				                <div class="col-sm-2">
				                    <div class="input-group date">
				                        <input type="text" value="<?php echo isset($_GET['to_date'])?$_GET['to_date']:null ?>" name="to_date" class="form-control datetimepicker" placeholder="To">
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                    </div>
				                </div>
				                <div class="col-sm-2">
				                    <button type="submit" class="btn btn-primary btn-mgma mt0">Search</button>
				                    <a href="{{url('dashboard/guests')}}" class="btn btn-warning">Reset</a>
				                </div>

				        </form>
					</div>			
					<div class="box-body">
						<ul class="nav nav-tabs pull-right">
						  <li role="presentation" class="{{Request::is('dashboard/guests/register')?'active':''}}"><a href="{{url('dashboard/guests/register')}}">Register Users</a></li>
						  <li role="presentation" class="{{Request::is('dashboard/guests/social')?'active':''}}"><a href="{{url('dashboard/guests/social')}}">Social Users</a></li>
						  <li role="presentation" class="{{Request::is('dashboard/guests/mac')?'active':''}}"><a href="{{url('dashboard/guests/mac')}}">Group Mac</a></li>
						</ul>	
						<div class="row">
							<div class="col-sm-12">
							<form action="{{url('dashboard/guests/guest_info')}}" method="post">
                            {{csrf_field()}}
								<table class="table table-bordered table-striped dataTable">
									<thead>

										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Email/Phone</th>
											<th>Gender/Age Group</th>
											<th>Site Name</th>
											<th>Login Time</th>
											<th>Action</th>
											<!-- <th><label><input type="checkbox" id="all"> All</label></th> -->
										</tr>
									</thead>
									@if(isset($guests))
									<tbody>

										@foreach($guests as $key=>$row)
										<tr>
											<td>{{$key+1}}. </td>
											<td><img src="{{$row->profile_photo==null?asset('img/user-pic-01.jpg'):$row->profile_photo}}" width="40px" height="40px;" class="img-circle">
												<div>
													<a onclick="callModel({{$row->guest_id}})" href="#">{{$row->name}}</a>
												</div>	
											</td>									
											<td><i class="fa fa-envelope"></i> {{$row->email}} <br> <i class="fa fa-phone"></i> {{$row->phone}}</td>
											<td>{{$row->Gender($row->gender)}} / {{$row->Age($row->age)}}</td>
											<td>
												{{$row->Site['site_name']}}
											</td>
											<td>
												{{date('d M, Y g:i:s',strtotime($row->created_at))}}
											</td>
											<td>
												<a href="{{url('dashboard/guests/detail/'.$row->guest_id)}}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Detail</a>
												<a href="{{url('/dashboard/guests/remove/'.$row->guest_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
											</td>
											<input type="hidden" name="id[]" value="{{$row->guest_id}}">
										</tr>
										
                    					@endforeach
									</tbody>
									@endif	
								</table>	
								@if(isset($_GET['site_id']) || isset($_GET['name']))
								<div class="col-md-offset-5">
	                                <button type="submit" class="btn btn-success">Export</button>
	                            </div>
	                            @endif
							</div>
							</form>
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
		 <!-- Modal -->
		 <div class="modal fade" id="viewDetailPopUp" role="dialog">
		 	<div class="modal-dialog modal-md">
		 		<div class="modal-content">
		 			<div class="modal-header"> 				
		 				<button type="button" class="close" data-dismiss="modal">&times;</button>
		 				<h4 class="modal-title">Login Detail</h4>
		 				<table class="table table-bordered table-striped" id="render">
		 					
		 				</table>		 				
		 			</div>

		 			<div class="modal-footer">
		 				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		<!-- model end -->
	</section>
<script>
	$( ".datetimepicker" ).datetimepicker({format:'YYYY-MM-DD H:m:s'});
    $('input#all').on('click',function(e){
        if (e.target.checked) {
            $('input[type=checkbox]').prop('checked',true)
        }else{
            $('input[type=checkbox]').prop('checked',false)
        }
    });
    function callModel(attr_id)
    {	
    	$('#render tr').remove();
    	$.get('/dashboard/guests/single_detail/'+attr_id,function(response){
    		$('<tr><th>#</th><th>Email</th><th>Phone</th><th>Login At</th></tr>').appendTo('table#render')
    		response.map(function(index,key){
    			$('<tr><td>'+Number(key+1)+'.</td><td>'+index.email+'</td><td>'+index.phone+'</td><td>'+index.created_at+'</td></tr>').appendTo('table#render');    			
    		});
    		$('#viewDetailPopUp').modal('show')
    	});
    	
    }
</script>
@stop