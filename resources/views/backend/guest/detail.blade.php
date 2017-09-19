@extends('backend.layouts.app')
@section('content')
<section class="content-header">
	<h1>Guest User Detail</h1>
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
						
						
							<table class="table table-bordered table-striped">
								<tr>
									<th>#</th>
									<th>User Info</th>
									<th>User AP/OS/Social ID</th>
									<th>Rating</th>
									<th>Survay</th>
									<th>Comment</th>
									<th>Login Time</th>
								</tr>
								@foreach($guests as $key=>$row)
									<?php $rating_key = isset($row->rating_key)?json_decode($row->rating_key):null;
										 	$rating_value = isset($row->rating_value)?json_decode($row->rating_value):null; ?>
									<tr>
										<td>{{$key+1}}. </td>
										<td>{{$row->name!=''?$row->name:'-'}}<br>{{$row->email!=''?$row->email:'-'}}<br>{{$row->phone!=''?$row->phone:'-'}} <br>
										{{$row->Age($row->age)!=''?$row->Age($row->age):'-'}} <br> {{$row->Gender($row->gender)!=''?$row->Gender($row->gender):'-'}}
										</td>
										<td>{{$row->user_ap!=''?$row->user_ap:'-'}}<br>{{$row->os!=''?$row->os:''}}<br>{{$row->social_id!=''?$row->social_id:'-'}}</td>
										<td class="col-md-2">
											@if(isset($rating_value))
												@foreach($rating_value as $key=>$value)
												
												<div class="form-group">
													<span>{{$rating_key[$key]}}</span>
													<input class="star star-5" {{$value==5?'checked':''}} id="star-5" type="radio"/>
													<label class="star stared star-5" for="star-5"></label>
													<input class="star star-4" {{$value==4?'checked':''}} id="star-4" type="radio"/>
													<label class="star stared star-4" for="star-"></label>
													<input class="star star-3" {{$value==3?'checked':''}} id="star-3" type="radio"/>
													<label class="star stared star-3" for="star-3"></label>
													<input class="star star-2" {{$value==2?'checked':''}} id="star-2" type="radio" />
													<label class="star stared star-2" for="star-2"></label>
													<input class="star star-1" {{$value==1?'checked':''}} value="1" id="star-1" type="radio" />
													<label class="star stared star-1" for="star-"></label>
												</div>
												@endforeach
											@endif	
										</td>
										<td>
											@foreach($row->Surveys as $value)
				                    		<p><b>{{$value->question}}</b><br>{{$value->answer}}</p>
				                    		@endforeach
										</td>
										<td>{{$row->comment!=''?$row->comment:'-'}}</td>
										<td>{{date('d M, Y g:i:s',strtotime($row->created_at))}}</td>
									</tr>
								@endforeach
							</table>
						
					</div>
					<div class="box-footer col-md-offset-5">
						<a href="{{url('dashboard/guests')}}" class="btn btn-default"> Back</a>
					</div>  
				</div>
			</div>
		</div>
		
	</section>

@stop