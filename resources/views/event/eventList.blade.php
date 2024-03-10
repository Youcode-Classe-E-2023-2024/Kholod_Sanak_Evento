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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- CSS
	============================================ -->

    <!-- Icon Font CSS -->
{{--    <link rel="stylesheet" href="{{url('/assets/css/all.min.css')}}">--}}
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
                            <h2 class="title">Event List</h2>
                            <ul class="breadcrumb justify-content-center">

                                @if(isset($category))
                                    <li class="breadcrumb-item"><a href="{{ route('events.category', ['categoryId' => $category->id]) }}">{{ $category->name }}</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">Event List</li>
                            </ul>
                        </div>
                        <!-- Page Banner Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Event List Start -->
    <div class="meeta-event-list section-padding">
        <div class="container">
            <div class="meeta-event-list-wrap">
                <!-- Event List Top Bar Start -->
                <div class="event-list-top-bar">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="event-list-search">
                                <form action="#">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            <div class="single-form">
                                                <i class="fas fa-search"></i>
                                                <input type="text" placeholder="Search Event">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="single-form form-border">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <input type="text" placeholder="Location">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-btn">
                                                <button class="btn btn-primary">Find Event</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="event-filter-wrap">
                                <div class="event-collapse-btn">
                                    <button class="btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFilters">
                                        <i class="fa fa-filter"></i>
                                        Hide Filters
                                    </button>
                                </div>
                                <div class="event-list-btn">
                                    <ul class="nav">
                                        <li>
                                            <button data-bs-toggle="tab" data-bs-target="#grid"><i class="fas fa-th-large"></i></button>
                                        </li>
                                        <li>
                                            <button class="active" data-bs-toggle="tab" data-bs-target="#list"><i class="fas fa-list"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- List Collapse Start -->
                    <div class="collapse" id="collapseFilters">
                        <div class="event-list-tag">

                        </div>
                    </div>
                    <!-- List Collapse End -->
                </div>
                <!-- Event List Top Bar End -->

                <!-- Event List Bottom Bar Start -->
                <div class="event-list-bottom-bar">
                    <div class="event-list-btn">
                        <a class="event-btn" href="#"><i class="flaticon-back"></i></a>
                        <a class="event-btn" href="#"><i class="flaticon-next"></i></a>
                    </div>
                </div>
                <!-- Event List Bottom Bar End -->

                <!-- Event List Content Start -->
                <div class="event-list-content-wrap">
                    <div class="tab-content">

                        <div class="tab-pane show active" id="list">
                            @foreach($events as $event)
                                <!-- Event List Item Start -->
                                <div class="event-list-item event-list d-lg-flex align-items-center">
                                    <div class="event-img">
                                        <a href="{{ route('event.single', $event->id) }}">
                                            <img src="{{ $event->getFirstMediaUrl() }}" alt="{{ $event->titre }}"
                                                 style="width: 300px; height: 200px;"></a>
                                    </div>
                                    <div class="event-list-content">
                                        <div class="event-price">
                                            <span class="price">{{ $event->prix }} Dhs</span>
                                        </div>
                                        <h3 class="title"><a href="{{ route('event.single', $event->id) }}">{{ $event->titre }}</a></h3>
                                        <div class="meta-data">
                                            <span><i class="fas fa-map-marker-alt"></i> {{ $event->deadline }}</span>
                                            <span><i class="fas fa-map-marker-alt"></i> {{ $event->lieu->ville }}</span>
                                        </div>
                                        <div class="event-desc">
                                            <p>{{ $event->description }}</p>
                                        </div>
                                        <a class="ticket-link" href="{{ route('event.single', $event->id) }}">Get Ticket Now</a>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Event List Item End -->
                                <div class="event-next-prev-btn text-center">
                                    {{ $events->links() }}
                                </div>
                        </div>
                    </div>
                </div>
                <!-- Event List Content End -->

            </div>
        </div>
    </div>
    <!-- Event List End -->

</div>

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
