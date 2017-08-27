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
<?php $rating_key = isset($guest->rating_key)?json_decode($guest->rating_key):null;
										 	$rating_value = isset($guest->rating_value)?json_decode($guest->rating_value):null; ?>	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						
						<div class="row">
							<div class="col-md-offset-3">
								<h4>Site Code : {{$guest->site_name}}</h4><br>
								<div class="col-md-3">
									<div class="form-group">
										<label class="form-label">
											Name
										</label>										
									</div>
									<div class="form-group">
										<label class="form-label">
											Email
										</label>
									</div>
									<div class="form-group">
										<label class="form-label">
											Phone
										</label>
									</div>
									<div class="form-group">
										<label class="form-label">
											Age Group / Gender
										</label>
									</div>
									<div class="form-group">
										<label class="form-label">
											Comment
										</label>
									</div>
									@if(isset($rating_key))
									@foreach($rating_key as $key=>$value)
									<div class="form-group">
										<label class="form-label">
											{{$value}}
										</label>
									</div>
									@endforeach
									@endif
								</div>	
								<div class="col-md-1">
									<div class="form-group">
										<label class="form-label">:
										</label>										
									</div>
									<div class="form-group">
										<label class="form-label">:
										</label>										
									</div>
									<div class="form-group">
										<label class="form-label">:
										</label>										
									</div>
									<div class="form-group">
										<label class="form-label">:
										</label>										
									</div>
									<div class="form-group">
										<label class="form-label">:
										</label>										
									</div>
									@if(isset($rating_value))
										@foreach($rating_value as $key=>$value)
										<div class="form-group">
											<label class="form-label">
												:
											</label>
										</div>
										@endforeach
									@endif
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label class="form-label">
											{{$guest->name}}
										</label>										
									</div>
									<div class="form-group">
										<label class="form-label">
											{{$guest->email}}
										</label>
									</div>
									<div class="form-group">
										<label class="form-label">
											{{$guest->phone}}
										</label>
									</div>
									<div class="form-group">
										<label class="form-label">
											{{$guest->Gender($guest->gender)}} / {{$guest->Age($guest->age)}}</p>
						                                  		<p>{{$guest->comment}}
										</label>
									</div>
									<div class="form-group">
										<label class="form-label">
											{{$guest->comment}}
										</label>
									</div>
									@if(isset($rating_value))
										@foreach($rating_value as $key=>$value)
										<div class="form-group">
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
								</div>
							</div>
						</div>	

					</div>
					<div class="box-footer col-md-offset-3">
						<a href="{{url('dashboard/guests')}}" class="btn btn-default"> Back</a>
					</div>  
				</div>
			</div>
		</div>
		
	</section>

@stop