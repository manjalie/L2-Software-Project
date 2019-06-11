<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">


    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('template/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('template/vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{asset('template/css/font.css')}}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/css/style.default.premium.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('template/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('template/img/favicon.ico')}}">
    {{--animate css--}}
    <link rel="stylesheet" href="{{asset('template/css/animate.css')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

</head>
<body>
@yield('content')
    <div class="copyrights text-center">
        <p>Design by <a href="https://ebits.lk" class="external">EBITS</a></p>

    </div>


<!--Start of Tawk.to Script-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5c56831b7cf662208c93d216/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
{{--end towk chat--}}

<!-- JavaScript files-->
<script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('template/vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('template/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('template/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('template/js/charts-home.js')}}"></script>
<script src="{{asset('template/js/front.js')}}"></script>
<script src="{{asset('template/js/bootstrap-notify.min.js')}}"></script>
<!-- Notifications-->
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/messenger-hubspot/build/js/messenger.min.js">   </script>
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/messenger-hubspot/build/js/messenger-theme-flat.js">       </script>
@yield('javaScripts')
</body>
</html>