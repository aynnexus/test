@extends('layouts.app')
@section('content')
<!-- Main content --><br><br><br>
<body class="container-fluid" style="width:auto; background-color:#006B2D; background-attachment:fixed;">
<!--<div class="container-fluid" style="position:absolute; margin:0;padding:0; left:0; top:0;"><img src="{{asset('img/rth-bg.jpg')}}" ></div>-->
 <section class="content" style="position:relative;">
  <div class="text-center" style="top:0;"><img src="{{asset('img/ykko-logo.png')}}" style="width:200px;height:200px;margin:0;padding:0;align:center;"></div>
  
    <div class="container error-page">

      <!--<div class="text-center" style="margin-top:5px;">
	 <h3 class="text-primary">YKKO<i class="fa fa-coffee" aria-hidden="true"></i></h3>
	 <img src="{{asset('img/logo.png')}}" alt="" width="100px" height="100px"> 
      </div>-->
      <h1 class="alert text-center text-red" style="font-size:60px;">Sorry!</h1>

      <div class="custom-box" >
        
		<p class="text-warning text-justified login-box-msg" style="font-size:20px; text-align:center;padding:20px;" ><i class="fa fa-warning text-red"></i> You have used up your data quota. Please visit again in five(5) hours <i class="fa fa-clock-o" aria-hidden="true" width="30px;"></i>.
        </p>
	

      </div>
    </div>
    <!-- /.error-page -->

  </section>
  <!-- /.content -->
</body>

@endsection
