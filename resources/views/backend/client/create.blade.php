@extends('backend.layouts.app')
@section('content')
	@include('backend.client.tab')
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						
							<div class="row">
								<div class="col-md-6">
								@if(isset($client))
									<form class="form" action="{{url('dashboard/clients/update/'.$client->client_id)}}" method="POST" >
								@else
									<form class="form" action="{{url('dashboard/clients/create')}}" method="POST">
								@endif
										{{csrf_field()}}
										<div class="form-group">
											<label class="form-label">Client Name</label>
											<input type="text" value="{{isset($client)?$client->User->name:null}}" name="name" class="form-control" required placeholder="TERLLE">
											@if ($errors->has('name'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('name') }}</strong>
			                                    </span>
			                                @endif
										</div>
										<div class="form-group">
											<label class="form-label">Client Email</label>
											<input type="text" value="{{isset($client)?$client->User->email:null}}" name="email" class="form-control" required placeholder="TERLLE@gamilc.com">
											@if ($errors->has('email'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                @endif
										</div>
										<div class="form-group">
											<label class="form-label">Client Password</label>
											<input type="password" name="password" class="form-control" {{isset($client)?'':'required'}} placeholder=".....">
											@if ($errors->has('password'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('password') }}</strong>
			                                    </span>
			                                @endif
										</div>
										<div class="form-group">
											<label class="form-label">Site Name</label>
											<?php $site = isset($client)?array_map('intval', json_decode($client->site_id,true)):null;  ?>
											{!! Form::select('site_id[]',$sites,$site,['class'=>'form-control select2','multiple data-placeholder'=>'Select One', 'required']) !!}
										</div>
										
										<a href="{{url('/dashboard/clients')}}" class="btn btn-default">Back</a>
										<button type="submit" class="btn btn-primary">Submit</button>
								</form>
								</div>
							</div>	

					</div>  
				</div>
			</div>
		</div>
		
	</section>

@stop