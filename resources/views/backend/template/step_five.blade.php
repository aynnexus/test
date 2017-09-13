@extends('backend.layouts.app')
@section('content')
	@include('backend.template.tab')
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">				
					<div class="box-body">
						@include('backend.template.menu')
							<div class="col-md-6">
								<h4>Please make your Ads page.</h4>
								<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewDetailPopUp0"><i class="fa fa-plus"></i> Add New Ads</button>
							</div>
							
						<div class="row">
							<div class="col-sm-12">
								<table class="table table-bordered table-striped dataTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Gender</th>
											<th>Age Group</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									@if(isset($ads))
										@foreach($ads as $key=>$row)
										<?php $ages = explode(',', $row->target_age);?>

										<tr>
											<td>{{$key+1}}.</td>
											<td>{{$gender[$row->target_gender]}}</td>	
											<td>
												@foreach($age as $key=>$value)
													@if(in_array($key,$ages))
														{{$value}}<br>
													@endif
												@endforeach
											</td>
											<td>
												<p data-toggle="modal" data-target="#ChangeStatusBox{{$row->site_id}}" class='btn btn-{{($row->status==ACTIVE)?'success':'danger'}} btn-xs'>{{$row->status==ACTIVE?'Enabled':'Disabled'}}</p>
											</td>
											<td>
												{{date('M d, Y',strtotime($row->created_at))}}
											</td>
											<td>
												<a href="#" data-toggle="modal" data-target="#viewDetailPopUp{{$row->ads_id}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Check</a>
												<a href="{{url('/dashboard/template/step_five/remove/'.$row->ads_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>
											</td>
										</tr>
										<!--edit-Modal -->
							<div class="modal fade" id="viewDetailPopUp{{$row->ads_id}}" role="dialog">
							  <div class="modal-dialog modal-md">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>           
							        <h4 class="modal-title"> Edit Ads</h4>  
							      </div>    
							      <div class="modal-body">
							        <form method="POST" action="{!! url('dashboard/template/step_five/'.$row->ads_id) !!}" role="form" enctype="multipart/form-data">
							          {{ csrf_field() }}         
							          <input type="hidden" name="template_id" value="{{$id}}">
							          <div class="form-group">
							            <label class="form-label">Gender :</label>            
							            {!! Form::select('gender',$gender,$row->target_gender,['class'=>'form-control select2','required']) !!}
							          </div>  
							          <div class="form-group">
							            <label class="form-label">Age Group :</label>            
							            {!! Form::select('age[]',$age,$ages,['class'=>'form-control select2','multiple','data-placeholder'=>'select one','required']) !!}
							          </div>   
							          <div class="form-group">
							          	<label class="form-label">Photo</label>
							            <input type="file" id="photo" name="photo" class="form-control">
							            @if($row->type==1)
							            	<img src="{{url('/storage/'.$row->photo)}}" width="60%" height="200px">
							            @endif
							          </div> 
							          <div class="form-group">
							          	<label class="form-label">Ads Time</label>
							            <input type="number" name="timeout" value="{{$row->timeout}}" class="form-control">
							           
							          </div> 
							          <div class="form-group">
							          	<label class="form-label">Video</label>
							            <input type="text" id="video" value="{{$row->video}}" name="video" class="form-control" placeholder="url">
							          </div>
							          <div class="form-group">
							          	<label class="form-label">Photo <input type="radio" required {{$row->type==ACTIVE?'checked':''}} id="Rphoto" value="{{ACTIVE}}" name="type"> </label>
							            <label class="form-label">Video <input type="radio" required {{$row->type==INACTIVE?'checked':''}} id="Rvideo" value="{{INACTIVE}}" name="type"></label>
							          </div>
							          <div class="form-group">
							            <label class="form-label">Status :</label>
							            <input type="radio" required {{$row->status==ACTIVE?'checked':''}} value="{{ACTIVE}}" name="status" checked="">Active
							            <input type="radio" required {{$row->status==INACTIVE?'checked':''}} value="{{INACTIVE}}" name="status">Inactive
							          </div>
							          <button type="submit" class="btn btn-primary">Save</button>
							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        </form>                                                     
							      </div>                                             
							        <!-- <div class="modal-footer">
							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        </div>   -->
							    </div>
							  </div>
							</div>
							<!--edit-Modal-end -->
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

<!--create-Modal -->
<div class="modal fade" id="viewDetailPopUp0" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>           
        <h4 class="modal-title"> Add Ads</h4>  
      </div>    
      <div class="modal-body">
        <form method="POST" action="{!! url('dashboard/template/step_five/0') !!}" role="form" enctype="multipart/form-data">
          {{ csrf_field() }}         
          <input type="hidden" name="template_id" value="{{$id}}">
          <div class="form-group">
            <label class="form-label">Gender :</label>            
            {!! Form::select('gender',$gender,null,['class'=>'form-control select2','required']) !!}
          </div>  
          <div class="form-group">
            <label class="form-label">Age Group :</label>            
            {!! Form::select('age[]',$age,null,['class'=>'form-control select2','multiple','data-placeholder'=>'select one','required']) !!}
          </div>
          <div class="form-group">
          	<label class="form-label">Ads Time</label>
            <input type="number" name="timeout" class="form-control">
          </div>    
          <div class="form-group">
          	<label class="form-label">Photo</label>
            <input type="file" id="photo" name="photo" class="form-control">
          </div> 
          <div class="form-group">
          	<label class="form-label">Video</label>
            <input type="text" id="video" name="video" class="form-control" placeholder="url">
          </div>
          <div class="form-group">
          	<label class="form-label">Photo <input type="radio" required id="Rphoto" value="{{ACTIVE}}" name="type"> </label>
            <label class="form-label">Video <input type="radio" required id="Rvideo" value="{{INACTIVE}}" name="type"></label>
          </div>
          <div class="form-group">
            <label class="form-label">Status :</label>
            <input type="radio" required value="{{ACTIVE}}" name="status" checked="">Active
            <input type="radio" required value="{{INACTIVE}}" name="status">Inactive
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>                                                     
      </div>                                             
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>   -->
    </div>
  </div>
</div>
<!--create-Modal-end -->
<script type="text/javascript">
	$('input#Rphoto').on('click',function(){
		$('input#photo').prop('required',true);
		$('input#video').prop('required',false);
	})
	$('input#Rvideo').on('click',function(){
		$('input#photo').prop('required',false);
		$('input#video').prop('required',true);
	})
</script>
@stop