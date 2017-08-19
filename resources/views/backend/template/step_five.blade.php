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
							</div>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									
								</div>
							</div>	

					</div>  
				</div>
			</div>
		</div>
		
	</section>

@stop