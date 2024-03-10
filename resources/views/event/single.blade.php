<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Meeta - Event & Conference HTML5 Template</title>
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
                            <a href="index.html"><img src="{{url('assets/images/logo-4.png')}}" alt="Logo"></a>
                        </div>
                        <!-- Header Logo End -->

                    </div>
                    <div class="col-lg-6 d-none d-lg-block">

                        <!-- Header Navigation Start -->
                        <div class="header-navigation">
                            <ul class="main-menu">
                                <li><a href="{{route('welcome')}}">Home</a>

                                </li>

                                <li><a href="{{route('login')}}">Login</a>
                                </li>
                                <li><a href="{{route('register')}}">Register</a>
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
                <a href="index.html"><img src="{{url('assets/images/logo-4.png')}}" alt=""></a>
            </div>
            <!-- Offcanvas Logo End -->
            <button type="button" class="close-btn" data-bs-dismiss="offcanvas"><i class="flaticon-close"></i></button>
        </div>

        <!-- Offcanvas Body Start -->
        <div class="offcanvas-body">
            <div class="offcanvas-menu offcanvas-menu-2">
                <ul class="main-menu">
                    <li><a href="#">Home</a>
                    </li>
                    <li><a href="{{route('login')}}">Login</a>
                    </li>
                    <li><a href="{{route('register')}}">Register</a>
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
                            <h2 class="title">Event Page Details</h2>
{{--                            <ul class="breadcrumb justify-content-center">--}}
{{--                                <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                                <li class="breadcrumb-item active" aria-current="page">Event Single</li>--}}
{{--                            </ul>--}}
                        </div>
                        <!-- Page Banner Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Event Single Start -->
    <div class="meeta-event-single section-padding">
        <div class="container">
            <div class="meeta-event-single-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Event Single Content Start -->
                        <div class="event-single-content">
                            <div class="meeta-video-section-2">
                                <div class="video-img text-center" style="background-image: url({{ $event->getFirstMediaUrl() }});">
                                    <div class="meeta-section-title-2 section-title-4">
                                        <h2 class="main-title">{{ $event->titre }}</h2>
                                    </div>
{{--                                    <a class="popup-video" href="{{ $event->video_url }}"><i class="fas fa-play"></i></a>--}}
                                </div>
                            </div>
                            <p>{{ $event->description }}</p>
                            <div class="event-single-item">
                                <h3 class="title">Event Speakers</h3>
                                <div class="speakers-content-wrap">
                                    <div class="row">
                                            <div class="col-md-4 col-sm-6">
                                                <div class="single-speker-3">
                                                    <div class="speker-img">
{{--                                                        <a href="{{ route('speaker.single', ['id' => $speaker->id]) }}"><img src="{{ $speaker->image_url }}" alt="{{ $speaker->name }}"></a>--}}
                                                        <div class="speker-content text-center">
                                                            <h3 class="name">{{ $event->lieu->ville }}</h3>
                                                            <span class="designation">{{ $event->deadline}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Event Single Content End -->

                    </div>
                    <div class="col-lg-4">
                        <!-- Event Single Sidebar Start -->
                        <div class="event-single-sidebar">

                                <div class="btn-price">
                                    @auth
                                        @if($event->nombre_place > 0)
                                            <a class="btn btn-primary" href="{{ route('ticketForm', ['eventId' => $event->id]) }}">Buy Ticket</a>
                                        @else
                                            <span class="btn btn-primary disabled">Sold Out</span>
                                        @endif                                    @else
                                        <a class="btn btn-primary" href="{{ url('login') }}">Buy Your Ticket</a>
                                    @endauth

                                    <div class="price">
                                        <span>{{ $event->prix }}<sup>Dhs</sup></span>
                                    </div>
                                </div>

                            <div class="sidebar-item">

                                <div class="event-details">
                                    <h3 class="sidebar-title">Details</h3>
                                    <ul>
                                        <li>
                                            <h5 class="title">Date & Time:</h5>
                                            <p>{{ date('d', strtotime($event->deadline)) }} {{ date('M', strtotime($event->deadline)) }}</p>
                                        </li>
                                        <li>
                                            <h5 class="title">Places:</h5>
                                            <p>{{$event->nombre_place}} </p>
                                        </li>
                                        <li>
                                            <h5 class="title">City:</h5>
                                            <p>{{ $event->lieu->ville }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <div class="event-map">
                                    <h3 class="sidebar-title">Location Map</h3>
                                    <div class="google-map">
                                        <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Mission%20District%2C%20San%20Francisco%2C%20CA%2C%20USA&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Event Single Sidebar End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Single End -->

</div>

<!-- Footer Start -->
<div class="meeta-footer-section" style="background-image: url(assets/images/bg/footer-bg.jpg);">

    <!-- Footer Widget Start -->
    <div class="footer-widget text-center">
        <div class="container">

            <!-- Footer Logo Start -->
            <div class="footer-logo">
                <a href="index.html"><img src="{{url('assets/images/footer-logo-1.png')}}" alt="Logo"></a>
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




<!-- JS
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
