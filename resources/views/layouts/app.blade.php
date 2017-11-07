<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Nexus_Portal') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        {!! Html::style('assets/bootstrap/css/bootstrap.css') !!}
        {!! Html::style('assets/bootstrap/css/font-awesome.min.css') !!}
        {!! Html::style('assets/adminlte/css/AdminLTE.css') !!}
        {!! Html::style('css/custom.css') !!}
        <!-- Scripts -->
        {!! Html::script('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') !!}
        {!! Html::script('assets/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('js/ajax.js') !!}
    </head>
    <div id="app">
        @yield('content')  
    </div>
</html>
