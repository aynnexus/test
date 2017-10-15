@extends('layouts.app')
@section('content')
<!-- Main content --><br><br><br>
<body style="width:auto; background-color:gold; background:url("<?php echo asset('img/est.jpg') ?>"); background-attachment:fixed; background-position:top center; ">
  <section class="content">

    <div class="container error-page">
	<div class="logo"><img src="/img/hledan_center-logo.png"></div>
      <h2 class="headline text-red">Sorry!</h2>

      <div class="error-content">
        <p class="text-warning text-justified" ><i class="fa fa-warning text-red"></i> You have used up your data quota. Please visit again in four(4) hours <i class="fa fa-clock-o" aria-hidden="true"></i>.
   </p>

     </div>
    </div>
    <!-- /.error-page -->

  </section>
  <!-- /.content -->
</body>

@endsection
