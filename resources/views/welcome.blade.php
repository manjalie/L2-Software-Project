<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class=" js no-touch">

<head>
    <title>Learn After 6</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('landing/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/font-awesome.min.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600|Raleway:600,300|Josefin+Slab:400,700,600italic,600,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/slick-team-slider.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/style.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('template/img/favicon.ico')}}">

</head>

<body>
<!--HEADER START-->
<div class="main-navigation navbar-fixed-top">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('/')}}">LA6</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#banner">Home</a></li>
                    <li><a href="#service">Service</a></li>
                    <li><a href="#about">Our Team</a></li>

                    @if (Route::has('login'))

                            @auth
                                @if (\Illuminate\Support\Facades\Auth::user()->role == 'lecturer')
                                    <li><a href="{{ url('/lecturer') }}">Dashboard</a></li>
                                @elseif (\Illuminate\Support\Facades\Auth::user()->role == 'student')
                                    <li><a href="{{ url('/student') }}">Dashboard</a></li>
                                @elseif (\Illuminate\Support\Facades\Auth::user()->role == 'moderator')
                                    <li><a href="{{ url('/moderator') }}">Dashboard</a></li>
                                @elseif (\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                    <li><a href="{{ url('/admin') }}">Dashboard</a></li>
                                @endif
                            @else
                                <li> <a href="{{ route('login') }}">Login</a></li>
                            @endauth

                    @endif


                </ul>
            </div>
        </div>
    </nav>
</div>
<!--HEADER END-->

<!--BANNER START-->
<div id="banner" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h1 class="small">Welcome To <span class="bold">LA6</span></h1>
                <p class="big">Learning After 6.</p>
                <a href="#about" class="btn btn-banner">Learn More<i class="fa fa-send"></i></a>
            </div>
        </div>
    </div>
</div>
<!--BANNER END-->

<!--CTA1 START-->
<div class="cta-1">
    <div class="container">
        <div class="row text-center white">
            <h1 class="cta-title">Grab Your Books!!</h1>
            <p class="cta-sub-title">Start Learning After 6.</p>
        </div>
    </div>
</div>
<!--CTA1 END-->

<!--SERVICE START-->
<div id="service" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="page-title text-center">
                <h1>Our Service</h1>
                <p>
                    We are educational service providing company for part time and higher studies
                </p>
                <hr class="pg-titl-bdr-btm"></hr>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <div class="service-icon"><i class="fa fa-moon-o"></i></div>
                    <div class="service-text">
                        <h3>Night Study</h3>
                        <p>
                            Our classes hold after 6.so you don't need to worry about your careers,day time works.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <div class="service-icon"><i class="fa fa fa-book"></i></div>
                    <div class="service-text">
                        <h3>Courses</h3>
                        <p>
                            We have most like every higher educate courses.you just need to click a button to start to learn them
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <div class="service-icon"><i class="fa fa-graduation-cap"></i></div>
                    <div class="service-text">
                        <h3>Lecturers</h3>
                        <p>
                            not only student's,also graduate's can join with us.they can start lectures to students.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--SERVICE END-->


<!--TEAM START-->
<div id="about" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="page-title text-center">
                <h1>Meet Our Team</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor <br>incididunt ut labore et dolore magna aliqua. </p>
                <hr class="pg-titl-bdr-btm"></hr>
            </div>
            <div class="autoplay">
                <div class="col-md-6">
                    <div class="team-info">
                        <div class="img-sec">
                            <img src="{{asset('landing/img/agent1.jpg')}}" class="img-responsive">
                        </div>
                        <div class="fig-caption">
                            <h3>Haris Brown</h3>
                            <p class="marb-20">Sr. UI Designer</p>
                            <p>Follow me:</p>
                            <ul class="team-social">
                                <li class="bgblue-dark"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="bgred"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="bgblue-light"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="bgblue-dark"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="team-info">
                        <div class="img-sec">
                            <img src="{{asset('landing/img/agent2.jpg')}}" class="img-responsive">
                        </div>
                        <div class="fig-caption">
                            <h3>Emmy Brown</h3>
                            <p class="marb-20">Jr. UI Designer</p>
                            <p>Follow me:</p>
                            <ul class="team-social">
                                <li class="blue-dark"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="red"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="blue-light"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="blue-dark"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="team-info">
                        <div class="img-sec">
                            <img src="{{asset('landing/img/agent3.jpg')}}" class="img-responsive">
                        </div>
                        <div class="fig-caption">
                            <h3>Iain Dante</h3>
                            <p class="marb-20">Jr. UI Designer</p>
                            <p>Follow me:</p>
                            <ul class="team-social">
                                <li class="blue-dark"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="red"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="blue-light"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="blue-dark"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="team-info">
                        <div class="img-sec">
                            <img src="{{asset('landing/img/agent4.jpg')}}" class="img-responsive">
                        </div>
                        <div class="fig-caption">
                            <h3>Kate Haris</h3>
                            <p class="marb-20">Jr. UI Designer</p>
                            <p>Follow me:</p>
                            <ul class="team-social">
                                <li class="blue-dark"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="red"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="blue-light"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="blue-dark"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--TEAM END-->

<!--CTA2 START-->
<div class="cta2">
    <div class="container">
        <div class="row white text-center">
            <h3 class="wd75 fnt-24">“Every Thing is designed. Few Things are Designed well.” - Brian Reed</h3>
            <p class="cta-sub-title"></p>
        </div>
    </div>
</div>


{{--towk chat--}}
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
<!--End of Tawk.to Script-->
<!--CTA2 END-->

<!--CONTACT START-->

<!--CONTACT END-->

<!--FOOTER START-->
<footer class="footer section-padding">
    <div class="container">
        <div class="row">
            <div style="visibility: visible; animation-name: zoomIn;" class="col-sm-12 text-center wow zoomIn">
                <h3>Follow us on</h3>
                <div class="footer_social">
                    <ul>
                        <li><a class="f_facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="f_twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="f_google" href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a class="f_linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <!--- END COL -->
        </div>
        <!--- END ROW -->
    </div>
    <!--- END CONTAINER -->
</footer>
<!--FOOTER END-->
<div class="footer-bottom">
    <div class="container">
        <div style="visibility: visible; animation-name: zoomIn;" class="col-md-12 text-center wow zoomIn">
            <div class="footer_copyright">
                <p> © Copyright, All Rights Reserved.</p>
                <div class="credits">
                    Designed by <a href="#">Ebits.lk</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('landing/js/jquery.min.js')}}"></script>
<script src="{{asset('landing/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('landing/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('landing/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('landing/js/custom.js')}}"></script>
{{--<script src="contactform/contactform.js"></script>--}}

</body>

</html>
