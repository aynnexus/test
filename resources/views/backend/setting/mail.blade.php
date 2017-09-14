@extends('backend.layouts.app')

@section('content')
<!-- <section class="content-header">
    <ol class="breadcrumb">
        
    </ol>
</section>
<br> -->
<section class="content">	

	<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Mail Setting</h3>
        </div>
        	{!! Form::open(['url'=>'dashboard/setting/mailsetting']) !!}
          {{csrf_field()}}
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="col-md-6">             
                <a href="{{url('dashboard/settings/mailtest')}}" class="btn btn-success" title="">Send Mail Test</a>
            </div>
            <!-- /.box-footer -->
           {!! Form::close() !!}
    </div>
    <!-- /. box -->        
</section>

@stop