<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Meeta - Event List</title>
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/assets/images/favicon.png')}}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="../../../css2?family=Big+Shoulders+Display:wght@300;400;500;600;700;800&family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="../../../css?family=Archivo:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS
	============================================ -->

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{url('/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/flaticon.css')}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{url('/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/nice-select.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{url('/assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-jQRcBrHrAVYtV1u0/wx42UblVleFbhkeBLi8UpvE7l5rFRRg5uT2aY+bvyL4YH1Wm8C2AzM7vEseEfnqeYIzjQ==" crossorigin="anonymous" />



</head>

<body>

<div class="main-wrapper">

    <!-- Preloader start -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Header Start -->
    <div class="meeta-header-section meeta-header-4">

        <!-- Header Middle Start -->
        <div class="header-middle header-sticky">
            <div class="container-fluid custom-container">

                <div class="row align-items-center">
                    <div class="col-lg-3 col-4">

                        <!-- Header Logo Start -->
                        <div class="header-logo">
                            <a href="{{route('welcome')}}"><img src="{{url('assets/images/logo-4.png')}}" alt="Logo"></a>
                        </div>
                        <!-- Header Logo End -->

                    </div>
                    <div class="col-lg-6 d-none d-lg-block">

                        <!-- Header Navigation Start -->
                        <div class="header-navigation">
                            <ul class="main-menu">
                                <li><a href="{{route('welcome')}}">Home</a>

                                </li>
                                <li><a href="about.html">About</a></li>
                                <li class="active-menu"><a href="#">Pages</a>

                                </li>
                                <li><a href="#">Blog</a>


                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                        <!-- Header Navigation End -->

                    </div>
                    <div class="col-lg-3 col-8">

                        <!-- Header Meta Start -->
                        <div class="header-meta">

                            <div class="header-actions">
                                <div class="header-action d-none d-sm-block">
                                    <div class="header-search">
                                        <a class="search-btn" href="#"><i class="flaticon-loupe"></i></a>
                                        <div class="search-wrap">
                                            <div class="search-inner">
                                                <i id="search-close" class="flaticon-close search-close"></i>
                                                <div class="search-cell">
                                                    <form action="{{ route('events.search') }}" method="GET">
                                                        @csrf
                                                        <div class="search-field-holder">
                                                            <input name="titre" class="main-search-input" type="search" placeholder="Search Your Keyword...">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(auth()->check())
                                <!-- User is authenticated (logged in) -->
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="header-btn d-none d-md-block">
                                        <button type="submit" class="btn-2">Logout</button>
                                    </div>

                                </form>
                            @else
                                <!-- User is not authenticated (not logged in) -->
                                <div class="header-btn d-none d-md-block">
                                    <a href="{{ route('login') }}" class="btn-2">Buy Ticket</a>
                                </div>
                            @endif

                            <!-- Header Toggle Start -->
                            <div class="header-toggle d-md-none">
                                <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                            <!-- Header Toggle End -->

                        </div>
                        <!-- Header Meta End -->

                    </div>
                </div>

            </div>
        </div>
        <!-- Header Middle End -->

    </div>
    <!-- Header End -->




    <!-- Offcanvas Start-->
    <div class="offcanvas offcanvas-start" id="offcanvasExample">
        <div class="offcanvas-header">
            <!-- Offcanvas Logo Start -->
            <div class="offcanvas-logo">
                <a href="{{route('welcome')}}"><img src={{url('"assets/images/logo-4.png"')}} alt=""></a>
            </div>
            <!-- Offcanvas Logo End -->
            <button type="button" class="close-btn" data-bs-dismiss="offcanvas"><i class="flaticon-close"></i></button>
        </div>

        <!-- Offcanvas Body Start -->
        <div class="offcanvas-body">
            <div class="offcanvas-menu offcanvas-menu-2">
                <ul class="main-menu">
                    <li><a href="{{route('welcome')}}">Home</a>

                    </li>
                    <li><a href="about.html">About</a></li>
                    <li class="active-menu"><a href="#">Pages</a>

                    </li>
                    <li><a href="#">Blog</a>

                    </li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
        <!-- Offcanvas Body End -->
    </div>
    <!-- Offcanvas End -->

    <!-- Page Banner Start -->
    <div class="section page-banner-section">
        <div class="shape-2"></div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Banner Content Start -->
                        <div class="page-banner text-center">
                            <h2 class="title">Reset Password Page </h2>
                            <ul class="breadcrumb justify-content-center">

                                @if(isset($category))
                                    <li class="breadcrumb-item"><a href="{{ route('events.category', ['categoryId' => $category->id]) }}">{{ $category->name }}</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">New Password </li>
                            </ul>
                        </div>
                        <!-- Page Banner Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->


    <!-- Login Section Start -->
    <div class="section login-register-section section-padding">
        <div class="container d-flex justify-content-center align-items-center border-light p-4">

            <!-- Login Wrapper Start -->
            <div class="login-register-wrap">
                <div class="row gx-5">
                    <div class="col-lg-12">

                        <!-- Login Box Start -->
                        <div class="login-register-box">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="title mb-5">Set your new password</h2>
                            </div>
                            <!-- Section Title End -->

                            <div class="login-register-form">
                                <form  method="post" action="{{ route('password.update', ['token' => $token]) }}"   enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="single-form">
                                        <input name="email" type="text" class="form-control mb-4" value="{{ request()->get('email') }}"
                                        readonly>
                                        @error('email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <input name="password" type="password" class="form-control mb-4" placeholder="Password">
                                        @error('password')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <input name="password_confirmation" type="password" class="form-control mb-4" placeholder="Confirm your Password">
                                        @error('password_confirmation')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-btn">
                                        <button class="btn-2">Reset</button>
                                    </div>

                                </form>


                            </div>
                        </div>
                        <!-- Login Box End -->

                    </div>
                </div>
            </div>
            <!-- Login Wrapper End -->

        </div>
    </div>
    <!-- Login Section End -->




    <!-- Footer Start -->
    <div class="meeta-footer-section" style="background-image: {{url('assets/images/bg/footer-bg.jpg')}};">

        <!-- Footer Widget Start -->
        <div class="footer-widget text-center">
            <div class="container">

                <!-- Footer Logo Start -->
                <div class="footer-logo">
                    <a href="{{route('welcome')}}"><img src="{{url('assets/images/footer-logo-1.png')}}" alt="Logo"></a>
                </div>
                <!-- Footer Logo End -->

                <!-- Footer Newsletter Start -->
                <div class="footer-newsletter">
                    <p>Join our mailing list to stay up to date on all things Expotin</p>

                    <div class="footer-newsletter-form">
                        <form action="#">
                            <input type="text" placeholder="Your Email">
                            <button class="btn btn-primary">Subscribe</button>
                        </form>
                    </div>
                </div>
                <!-- Footer Newsletter End -->

                <!-- Footer widget Social Start -->
                <div class="footer-widget-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-dribbble"></i></a>
                    <a href="#"><i class="fab fa-behance"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
                <!-- Footer widget Social End -->

                <!-- Footer Copyright Start -->
                <div class="footer-copyright">
                    <p>2024 Evento. All Rights Reserved</p>
                </div>
                <!-- Footer Copyright End -->

            </div>
        </div>
        <!-- Footer Widget End -->

    </div>
    <!-- Footer End -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </div>
    <!-- back to top end -->
</div>
!-- JS
============================================ -->

<!-- Modernizer & jQuery JS -->
<script src="{{ asset('assets/js/vendor/modernizr-3.11.7.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins JS -->
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/back-to-top.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
