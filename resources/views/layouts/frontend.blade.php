<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Househelp</title>
    <link href="{{URL::asset('themes/eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('themes/eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('themes/eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{URL::asset('themes/eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{URL::asset('themes/eshopper/css/animate.css')}}" rel="stylesheet">
	<link href="{{URL::asset('themes/eshopper/css/main.css')}}" rel="stylesheet">
	<link href="{{URL::asset('themes/eshopper/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{URL::asset('themes/eshopper/js/html5shiv.js')}}"></script>
    <script src="{{URL::asset('themes/eshopper/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{URL::asset('themes/eshopper/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{URL::asset('themes/eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{URL::asset('themes/eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL::asset('themes/eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{URL::asset('themes/eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

    <body>
        <div id="app">
            <frontend></frontend>
        </div>
    </body>
    {{--  @if(Auth::check())
        <script>
                window.logged_user = {!! json_encode($logged_user); !!}
        </script>
    @endif
    <script type="text/javascript">
          var APP_URL = {!! json_encode(url('')) !!}
    </script>  --}}

    <script>
        @auth
            window.Roles = {!! json_encode(Auth::user()->allRoles, true) !!};
            window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
        @else
            window.Roles = [];
            window.Permissions = [];
        @endauth
    </script>
    <!-- REQUIRED SCRIPTS -->
    <script src="{{URL::asset('js/app.js')}}"></script>
    <script src="{{URL::asset('themes/eshopper/js/jquery.js')}}"></script>
    <script src="{{URL::asset('themes/eshopper/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('themes/eshopper/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{URL::asset('themes/eshopper/js/price-range.js')}}"></script>
    <script src="{{URL::asset('themes/eshopper/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{URL::asset('themes/eshopper/js/main.js')}}"></script>
</html>
