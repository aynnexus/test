@extends('backend.layouts.app')
@section('content')  
<section class="content-header">
	<h1>Servey Management</h1>
		<ol class="breadcrumb">
			<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li> 
			<li><a href="#"> Setting</a></li>
			<li><a href="{{url('/dashboad/setting/serveys')}}"> Servey</a></li>
			<li class="active"> Action</li>
		</ol>
</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<ul class="nav nav-tabs">
				  <li class="{{Request::is('dashboard/settings/serveys/questions')?'active':''}}"><a href="{{url('dashboard/settings/serveys/questions')}}">Questions</a></li>
				  <li class="{{Request::is('dashboard/settings/serveys/answers')?'active':''}}"><a href="{{url('dashboard/settings/serveys/answers')}}">Answers</a></li>
				</ul>
				<div class="box">				
					<div class="box-body">
						<div class="row">
								<div class="col-md-6">
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp0"><i class="fa fa-plus"></i> Add {{$type}}</button>
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
											<th>Slug</th>
											<th>Question</th>
											@if($type=='answers')
											<th>Answer</th>
											@endif
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if(isset($datas))
										@foreach($datas as $key=>$row)
										<tr>
											<td>{{$key+1}}.</td>
											<td>
												{{$row->slug}}
											</td>									
											@if($type=='answers')
											<td>
												{{$row->Question->label}}
											</td>
											@endif
											<td>{{$row->label}}</td>
											<td>
												{{$row->User->name}} - {{date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp{{$type=='questions'?$row->question_id:$row->answer_id}}"><i class="fa fa-edit"></i> Check</button>
												
												@if($type=='questions')
													<a href="{{url('/dashboard/settings/serveys/questions/remove/'.$row->question_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
												@else
													<a href="{{url('/dashboard/settings/serveys/answers/remove/'.$row->answer_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
												@endif
											</td>
										</tr>
										 <!--edit Modal -->
											<div class="modal fade" id="viewDetailPopUp{{$type=='questions'?$row->question_id:$row->answer_id}}" role="dialog">
											 	<div class="modal-dialog modal-md">
											 		<div class="modal-content">
											 			<div class="modal-header"> 				
											 				<button type="button" class="close" data-dismiss="modal">&times;</button>
											 				<h3>Edit {{$type}}</h3>
											 				<!-- <h4 class="modal-title">Modal Header</h4> -->
											 				@if($type=='answers')
											 				<form action="{{url('dashboard/settings/serveys/'.$type.'/'.$row->answer_id)}}" method="POST">
											 				@else
											 				<form action="{{url('dashboard/settings/serveys/'.$type.'/'.$row->question_id)}}" method="POST">
											 				@endif
											 					{{csrf_field()}}
											 					<div class="form-group">
											 						<label class="form-label">Slug</label>
											 						<input type="text" value="{{$row->slug}} " name="slug" class="form-control" required>
											 					</div>
											 					<div class="form-group">
											 						<label class="form-label">Label</label>
											 						<input type="text" name="label" class="form-control" value="{{$row->label}} " required>
											 					</div>
											 					@if($type=='answers')
												 					<div class="form-group">
												 						<label class="form-label">Position</label>
												 						<select class="form-control" name="question_id" required>
												 							<option>Select One</option>
												 							@foreach($question as $q)
												 								<option {{$q->question_id==$row->question_id?'selected':''}} value="{{$row->question_id}}">{{$q->slug}}</option>
												 							@endforeach
												 						</select>
												 					</div>
											 					@endif
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
 				<h3>Add New {{$type}}</h3>
 				<!-- <h4 class="modal-title">Modal Header</h4> -->
 				<form class="form" action="{{url('dashboard/settings/serveys/'.$type.'/0')}}" method="POST">
 					{{csrf_field()}}
 					<div class="form-group">
 						<label class="form-label">Slug</label>
 						<input type="text" name="slug" class="form-control" required>
 					</div>
 					<div class="form-group">
 						<label class="form-label">Label</label>
 						<input type="text" name="label" class="form-control" required>
 					</div>
 					@if($type=='answers')
	 					<div class="form-group">
	 						<label class="form-label">Position</label>
	 						<select class="form-control" name="question_id" required>
	 							<option>Select One</option>
	 							@foreach($question as $row)
	 								<option value="{{$row->question_id}}">{{$row->slug}}</option>
	 							@endforeach
	 						</select>
	 					</div>
 					@endif
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