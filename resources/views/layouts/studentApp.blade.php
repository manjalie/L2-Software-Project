<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title')
    </title>
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
    <link id="new-stylesheet" rel="stylesheet" href="{{asset('template/css/style.default.css')}}">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/css/custom.css">
    {{--ladda button progress--}}
    <link rel="stylesheet" href="{{asset('template/css/ladda-themeless.min.css')}}">
    {{--animate css--}}
    <link rel="stylesheet" href="{{asset('template/css/animate.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('template/img/favicon.ico')}}">
    {{--time picker--}}
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- DataTables CSS-->
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">

    {{--image uploader--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Datepicker CSS-->
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <!----------------------------------------------select picker---------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/css/bootstrap-select.min.css">

</head>
<body>
<header class="header">
    <nav class="navbar navbar-expand-lg">
        {{--<div class="search-panel">--}}
            {{--<div class="search-inner d-flex align-items-center justify-content-center">--}}
                {{--<div class="close-btn">Close <i class="fa fa-close"></i></div>--}}
                {{--<form id="searchForm" action="#">--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="search" name="search" placeholder="What are you searching for...">--}}
                        {{--<button type="submit" class="submit">Search</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <!-- Navbar Header--><a href="{{route('/')}}" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Learn</strong><strong>After 6</strong></div>
                    <div class="brand-text brand-sm"><strong class="text-primary">LA</strong><strong>6</strong></div></a>
                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
            </div>
            <div class="right-menu list-inline no-margin-bottom">
                {{--<div class="list-inline-item"><a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a></div>--}}
                {{--<div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle"><i class="icon-email"></i><span class="badge dashbg-1">5</span></a>--}}
                    {{--<div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#" class="dropdown-item message d-flex align-items-center">--}}
                            {{--<div class="profile"><img src="{{asset('template/img/avatar-3.jpg')}}" alt="..." class="img-fluid">--}}
                                {{--<div class="status online"></div>--}}
                            {{--</div>--}}
                            {{--<div class="content">   <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">--}}
                            {{--<div class="profile"><img src="{{asset('template/img/avatar-2.jpg')}}" alt="..." class="img-fluid">--}}
                                {{--<div class="status away"></div>--}}
                            {{--</div>--}}
                            {{--<div class="content">   <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">--}}
                            {{--<div class="profile"><img src="{{asset('template/img/avatar-1.jpg')}}" alt="..." class="img-fluid">--}}
                                {{--<div class="status busy"></div>--}}
                            {{--</div>--}}
                            {{--<div class="content">   <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">--}}
                            {{--<div class="profile"><img src="{{asset('template/img/avatar-5.jpg')}}" alt="..." class="img-fluid">--}}
                                {{--<div class="status offline"></div>--}}
                            {{--</div>--}}
                            {{--<div class="content">   <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div></a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i class="fa fa-angle-right"></i></strong></a></div>--}}
                {{--</div>--}}
                <!-- Tasks-->
                    <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink2" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link tasks-toggle">

                            {{--writing php script for show new request as alert--}}
                            @php
                                use App\Payment;
                                use App\Student;
                                $student = Student::where('user_id','=',Auth::user()->id)->first();
                               $pending_payments = Payment::with(['student_class_request.subject','student_class_request'=> function($q) use($student) {
                                   $q->where('student_id', '=', $student->id);
                                   }])->where('status','=','pending')
                                    ->get();
                            @endphp

                            {{-----------------------------end of php script------------------------------------------}}

                            <i class="icon-new-file"></i>
                            <span class="badge dashbg-3">{{count($pending_payments )}}</span></a>
                        <div aria-labelledby="navbarDropdownMenuLink2" class="dropdown-menu tasks-list">


                            @foreach ($pending_payments as $payment)
                                <a href="{{route('student/paymentHistory/makePayment/',$payment->id)}}" class="dropdown-item">
                                    <div class="text d-flex justify-content-between">
                                        @if ($payment->student_class_request)
                                        <strong>{{$payment->student_class_request->subject->name}}</strong>
                                        @endif
                                    </div>
                                    <small>RS.{{$payment->amount}}/=</small>
                                </a>
                            @endforeach

                            <a href="{{route('student/paymentHistory')}}" class="dropdown-item text-center"> <strong>See All Payments <i class="fa fa-angle-right"></i></strong></a>
                        </div>
                    </div>
                <!-- Tasks end-->


                <!-- Log out               -->
                <div class="list-inline-item logout">
                    <a  class="nav-link" data-toggle="modal" href="#" data-target="#signoutConfirmModal">Logout <i class="icon-logout"></i></a>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar">
                <a href="{{route('student/profile')}}"><img src="{{asset('Profilepic/'.Auth::user()->avatar)}}" alt="..." class="img-fluid rounded-circle"></a>
            </div>
            <div class="title">
                <h1 class="h5">{{Auth::user()->first_name}}</h1>
                <p>Student</p>
            </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
            <li class=" {{ Request::path() == 'student' ? 'active' : '' }} "><a href="{{route('student')}}"> <i class="icon-home"></i>Home </a></li>
            <li class="{{ Request::segment(2) == 'newCourse' ? 'active' : '' }} "><a href="{{route('student/newCourse')}}"> <i class="icon-new-file"></i>Request New Course</a></li>
            <li class="{{ Request::path() == 'student/availableCourses' ? 'active' : '' }} "><a href="{{route('student/availableCourses')}}"> <i class="icon-list"></i>Available Courses</a></li>
            <li class ="{{ Request::segment(2) == 'classrooms' ? 'active' : '' }}"><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-presentation"></i>My Classrooms</a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{route('student/classrooms')}}">Time Table</a></li>
                </ul>
            </li>
            <li class="{{ Request::path() == 'student/requestHistory' ? 'active' : '' }} "><a href="{{route('student/requestHistory')}}">
                    <i class="icon-contract"></i>Requested Courses</a>
            </li>
            <li class ="{{ Request::segment(2) == 'paymentHistory' ? 'active' : '' }}"><a href="{{route('student/paymentHistory')}}"> <i class="icon-bill"></i>Payments </a></li>
        </ul>
    </nav>
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">@yield('pageHeader')</h2>
            </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
           @yield('breadcrumb')
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="container-fluid">
                @yield('content')

                <div class="modal fade" id="signoutConfirmModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title text-primary" ><i class="fa fa-sign-out"></i> &nbsp;&nbsp;Sign out?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            Do you want to sign out?all the unsaved changes will discard after sign out.
                            </div>
                            <div class="modal-footer">
                                <button id="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" type="button" class="btn btn-primary">Proceed</button>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
</section>
        <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                    <p class="no-margin-bottom">2019 &copy; Learn After 6. Design by <a href="https://ebits.lk">EBITS</a>.</p>
                </div>
            </div>
        </footer>
</div>
</div>


<!-- JavaScript files-->

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


<script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('template/vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('template/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('template/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('template/js/charts-home.js')}}"></script>
<script src="{{asset('template/js/front.js')}}"></script>
<script src="{{asset('template/js/bootstrap-notify.min.js')}}"></script>
{{--<script src="{{asset('template/js/spin.min.js')}}"></script>--}}
{{--<script src="{{asset('template/js/ladda.min.js')}}"></script>--}}
<script src="{{asset('template/js/bootstrap-confirmation.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/js/bootstrap-select.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<!-- Notifications-->
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/messenger-hubspot/build/js/messenger.min.js">   </script>
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/messenger-hubspot/build/js/messenger-theme-flat.js">       </script>
<!-- Data Tables-->
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/datatables.net/js/jquery.dataTables.js"></script>
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/js/tables-datatable.js"></script>
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
{{--bootstrap confirmation--}}
<script src="{{asset('template/js/bootstrap-confirmation.js')}}"></script>
<script>
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        // other options
    });
</script>
<!-- Jasny Bootstrap - Input Masks-->
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/jasny-bootstrap/js/jasny-bootstrap.min.js"> </script>
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/js/forms-advanced.js"></script>
{{---------------------------------------Bootstrap touchspin---------------------------}}
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
{{---------------------------------------Bootstrap multy select--------------------------}}
<script src="https://d19m59y37dris4.cloudfront.net/dark-admin-premium/1-4-4/vendor/multiselect/js/jquery.multi-select.js"> </script>
{{--------------------------------------image uploader----------------------------------}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script>
    $("#file-1").fileinput({
        theme: 'fa',
        uploadUrl: "/image-view",
        uploadExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),
            };
        },
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFilesNum: 10,
        maxFileCount: 1,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        },
        btnBrowse: '<div tabindex="500" class=""{status}>{icon}{label}</div>',

    });

</script>

@yield('javaScripts')
</body>
</html>