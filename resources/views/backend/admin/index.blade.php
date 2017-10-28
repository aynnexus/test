@extends('backend.layouts.app')
@section('content')
<section class="content">
    <div class="row">
    	<div class="col-lg-12">
        
        <a href="{{ url('register') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Create</a>
    		<div class="box">
	    		<div class="box-header with-border">
    				<h3 class="box-title">Admin Lists</h3>
              <div class="box-tools pull-right">
                
                <form action="{{url('admin/user/data?')}}" class="" method="get" accept-charset="utf-8">  
                  <input type="search" class="pull-right custom-input" name="user_search" placeholder="Search Name">
              </form>  
              </div>
	    		</div>
	    		<div class="box-body">
	    			<div class="table-responsive mailbox-messages">
			    		<table class="table table-hover table-striped">
			    			<thead>
			    				<tr>
			    					<th>#</th>
			    					<th>Name</th>
			    					<th>Email</th>
                    <th>Role</th>
			    					<th>Status</th>
			    					<th>Action</th>
			    				</tr>
			    			</thead>
			    			<tbody>
                  <?php $index=1;?> 
                  @if(isset($users))                    
                    @foreach($users as $key => $value)  
                      <tr>              
                        <td>{{ $index}}.</td> 
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>    
                        <td>{{ $value->role==1?'Admin':'Client'}}</td>  
                        <td>{{ ($value->status==1)?'Active':'Inactive'}}</td>  
                        <td>    
                          <a href="#" data-toggle="modal" data-target="#viewDetailPopUp{{$value->id}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                          <a href="{{url('dashboard/admin/remove/'.$value->id)}}" onclick="return confirm('Are you want to sure delete?')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</a>

                        </td>  
                      </tr>
                      <?php $index++; ?>
                        <!-- edit Modal -->
                           <div class="modal fade" id="viewDetailPopUp{{$value->id}}" role="dialog">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="modal-header">        
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h3>Edit Admin</h3>
                                  <!-- <h4 class="modal-title">Modal Header</h4> -->
                                  <form class="form" action="{{url('dashboard/admin/update/'.$value->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                      <label class="form-label">Name</label>
                                      <input type="text" value="{{$value->name}}" name="name" class="form-control" required placeholder="Example">
                                    </div>
                                    <div class="form-group">
                                      <label class="form-label">Email</label>
                                      <input type="email" value="{{$value->email}}" name="email" class="form-control" required placeholder="example@gmail.com">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Update</button>
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
                  @else
                    @foreach($result as $key => $value)  
                      <tr>              
                        <td>{{ $index}}</td> 
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->role==1?'Admin':'Client'}}</td>
                        <td>{!! show_pretty_status($value->status) !!}</td>
                        <td>               
                          <!-- <a class="btn btn-small btn-info" href="{{ URL::to('user/' . $value->id . '/edit') }}">Edit</a> -->
                          
                          <a href="{{url('admin/user/delete/'.$value->id)}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i>Delete</a>
                          

                        </td>  
                      </tr>
                      <?php $index++; ?>
                    @endforeach
                  @endif
			    			</tbody>
			    		</table>
			    	</div>
	    		</div>
          <div class="box-footer">
            <div class="pull-right">
              @if(isset($user))
                {{ $user->links('vendor.pagination.bootstrap-4') }}
              @endif
            </div>
          </div>
	    	</div>
	    </div>
	</div>
</section>
<script type="text/javascript">
    function checkComfirm()
    {
      if (comfirm("Are you want to sure delete.")==true) {
        location.reload();
      }
      console.log('hi');
    }
</script>
@stop