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
								<h4>Site Name : {{$guest->Site['site_name']}}</h4><br>
								<div class="col-md-8">                      
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Name</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{$guest->name}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div><br>
				                  	</div>  
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Email</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{$guest->email}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div><br>                   
				                  	</div>  
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Phone</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{$guest->phone}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div><br>                   
				                  	</div>
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Age Group / Gender</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{$guest->Age($guest->age)}} / {{$guest->Gender($guest->gender)}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div><br>                   
				                  	</div>
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">User AP (Device)</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{$guest->user_ap}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div><br>                   
				                  	</div>
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">OS Type</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{$guest->os}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div><br>                   
				                  	</div>
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Social ID</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{$guest->social_id}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div><br>                   
				                  	</div>
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Login Time</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{date('d M, Y g:i:s',strtotime($guest->created_at))}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div><br>                   
				                  	</div>
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Comment</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
					                      	<label class="form-label">
												{{$guest->comment}}
											</label>	
				                      		<div class="clr"></div>
				                    	</div> <br><br>                  
				                  	</div>
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Rating</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7">                      
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
				                      		<div class="clr"></div>
				                    	</div><br>                   
				                  	</div>
				                  	<div class="form-group">                    
				                    	<label class="col-lg-3 control-label">Survey</label>
				                    	<label class="col-lg-1 control-label">:</label>
				                    	<div class="col-lg-7"> 
				                    		@foreach($guest->Surveys as $value)
				                    		<p><b>{{$value->question}}</b><br>{{$value->answer}}</p>
				                    		@endforeach
				                      		<div class="clr"></div>
				                    	</div>                  
				                  	</div>
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