<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- COMMON TAGS -->
    <meta charset="utf-8">
    <title>{{$organisation->name}}</title>
    <meta name="csrf-token" content="{{csrf_token()}}" />


    <!-- Search Engine -->
    {{-- <meta name="description" content="{{$organisation->about->who_we_are}}">
    <meta name="image" content="{{asset('assets/organisation/img/website/frontimage')}}/{{$organisation->about->front_image}}"> --}}

    <!-- Schema.org for Google -->


    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{$organisation->name}}">
    {{--  <meta name="twitter:description" content="{{$organisation->about->who_we_are}}">  --}}
    <meta name="twitter:site" content="@TeifFoundation">
    <meta name="twitter:creator" content="@TeifFoundation">
    {{--  <meta name="twitter:image:src" content="{{asset('assets/organisation/img/website/frontimage')}}/{{$organisation->about->front_image}}">  --}}
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->

    <meta property="og:url"         content="{{url('')}}" />
    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="{{$organisation->name}}" />
    {{--  <meta property="og:description" content="{{$organisation->about->who_we_are}}" />  --}}
    <meta property="og:image" content="{{asset('assets/organisation/img/logo')}}/{{$organisation->logo}}" />
    <meta property="og:image:type"  content="image/jpeg" />
    <meta property="og:image:width" content="50" />
    <meta property="og:image:height"content="20" />
    <meta property="fb:app_id"      content="828111440888989" />
    {{-- <meta property="fb:pages" content="{PAGE_ID}">
    <meta property="ia:markup_url" content="{URL}"> --}}

    {{-- teif pixel tracking facebook --}}

    <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '306290463376372');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=306290463376372&ev=PageView&noscript=1"/>
        </noscript>
    <!-- End Facebook Pixel Code -->

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
        <link rel="stylesheet" href="{{URL::asset('themes/adminlte3/plugins/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{URL::asset('themes/adminlte3/dist/css/adminlte.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{URL::asset('themes/adminlte3/plugins/iCheck/flat/blue.css')}}">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{URL::asset('themes/adminlte3/plugins/morris/morris.css')}}">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{URL::asset('themes/adminlte3/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{URL::asset('themes/adminlte3/plugins/datepicker/datepicker3.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{URL::asset('themes/adminlte3/plugins/daterangepicker/daterangepicker-bs3.css')}}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{URL::asset('themes/adminlte3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper" id="app">

            <backend></backend>

        </div>
        <!-- ./wrapper -->
    </body>

        <!-- jQuery -->
        @if(Auth::check())
            <script>
                    window.logged_user = {!! json_encode($logged_user); !!}
            </script>
        @endif
            <script type="text/javascript">
                  var APP_URL = {!! json_encode(url('')) !!}
            </script>
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
            <script src="{{URL::asset('themes/adminlte3/plugins/jquery/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
            $.widget.bridge('uibutton', $.ui.button)
            </script>
        <!-- Bootstrap 4 -->
            <script src="{{URL::asset('themes/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Morris.js charts -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="{{URL::asset('themes/adminlte3/plugins/morris/morris.min.js')}}"></script>
        <!-- Sparkline -->
            <script src="{{URL::asset('themes/adminlte3/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
        <!-- jvectormap -->
            <script src="{{URL::asset('themes/adminlte3/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
            <script src="{{URL::asset('themes/adminlte3/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- jQuery Knob Chart -->
            <script src="{{URL::asset('themes/adminlte3/plugins/knob/jquery.knob.js')}}"></script>
        <!-- daterangepicker -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
            <script src="{{URL::asset('themes/adminlte3/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- datepicker -->
            <script src="{{URL::asset('themes/adminlte3/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
        <!-- Bootstrap WYSIHTML5 -->
            <script src="{{URL::asset('themes/adminlte3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <!-- Slimscroll -->
            <script src="{{URL::asset('themes/adminlte3/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
            <script src="{{URL::asset('themes/adminlte3/plugins/fastclick/fastclick.js')}}"></script>
        <!-- AdminLTE App -->
            <script src="{{URL::asset('themes/adminlte3/dist/js/adminlte.js')}}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="{{URL::asset('themes/adminlte3/dist/js/pages/dashboard.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
            <script src="{{URL::asset('themes/adminlte3/dist/js/demo.js')}}"></script>

</html>
