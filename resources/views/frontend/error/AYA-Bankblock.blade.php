@extends('layouts.app')
@section('content')
<!-- Main content -->
<body style="width:auto; background-color:#FFF; background-attachment:fixed; ">
   <header style="text-align:center;"> <img src="{{asset('img/aya-ads.jpg')}}" align="center"  height="200px" width="100%" style="max-width:600px;"></header>
  <div class="text-center" style="top:0;"><img src="{{asset('img/aya-logo.png')}}" style="width:100px;height:100px;margin:0; padding:0;align:center;margin-top:-45px;"></div>
  <section  class="content" style="text-align:center;margin-top:-70px;">

    <div class="container error-page">

      <h1 class="alert text-center text-red" style="font-size:80px;margin-left:0;">Sorry!</h1>

      <div class="error-content" style="margin-left:0">
        <p class="text-warning text-justified" style="font-size:20px;" ><i class="fa fa-warning text-red"></i> You have used up your data quota.
        </p>

      </div>
    </div>
    <!-- /.error-page -->

  </section>
  <!-- <div class="error-ads" style="text-align:center;">
    <img src="{{asset('img/aya-ads.jpg')}}" height="250px" width="100%" aling="center" style="max-width:600px;">
  </div> -->
  <!-- /.content -->
  <footer class="frontend-footer">
	       <div class="up-footer">
	        <p>Powered by <a href="http://nexus.com.mm">Nexus Solutions</a></p>
        </div>
	</footer>
</body>

@endsection
