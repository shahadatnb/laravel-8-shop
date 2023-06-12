<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <meta name="keywords" content="{{ config('settings.metaKeywords', '') }}">
    <meta name="description" content="{{ config('settings.metaDescription', '') }}">
    <meta name="author" content="">
    <!-- site icons -->
    <link rel="icon" href="{{ asset('upload/site_file/'.config('settings.fevicon')) }}" type="image/gif" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('/assets/front')}}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('/assets/front/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/front/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{asset('/assets/front/css/style.css')}}?v={{time()}}" />

    <link rel="stylesheet" href="{{asset('/assets/loading.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/inner_product.css?v='.time())}}" media="all">
    <link rel="stylesheet" href="{{asset('/assets/front/font-awesome-4.7.0/css/font-awesome.css')}}" />
    @yield('css')
    <title>
        @hasSection('title')
        @yield('title') -
        @endif
        {{ config('settings.appTitle', 'Laravel') }}
    </title>
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->
    <script src="{{asset('/assets/front')}}/js/jquery.js"></script>
    @yield('js-head')
    @livewireStyles
    @livewireScripts
</head>

<body>
    <header class="_home_header sticky-top py-2">
        <nav class="container-fluid px-sm-5">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-2">
                    <div class="branding">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <figure class="_hmenu">
                                @if(!empty(config('settings.appLogo')))
                                <img class="" src="{{asset('/assets/front')}}/newImg/ladimum-logo.png" alt="{{ config('settings.appTitle') }}">
                                @else
                                <img src="{{ asset('storage/'.config('settings.appLogo')) }}" alt="{{ config('settings.appTitle') }}">
                                @endif
                            </figure>

                        </a>
                        <!-- <img src="assets\front\img\Ladiumbd-logo.png" class="w-75" alt="Company Logo"> -->
                    </div>
                </div>
                <div class="col-md-1 text-end">
                    <div class="productCategories">
                        <span class="btnOffcanvas" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </span>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Product Sub Categories</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="list-unstyled list-group list-group-flush text-start">
                                    <li><a href="#" class="fw-medium fs-5 text-body-secondary text-decoration-none">Sub Categories List Here</a></li>
                                    <li><a href="#" class="fw-medium fs-5 text-body-secondary text-decoration-none">Sub Categories List Here</a></li>
                                    <li><a href="#" class="fw-medium fs-5 text-body-secondary text-decoration-none">Sub Categories List Here</a></li>
                                    <li><a href="#" class="fw-medium fs-5 text-body-secondary text-decoration-none">Sub Categories List Here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="siteMenu" id="siteMenu">
                        <ul class="list-unstyled m-0 p-0">
                            <li class="px-2 text-center"><a href="#" class="fw-semibold fs-5 text-body-secondary text-decoration-none">Home</a></li>
                            <li class="px-2 text-center"><a href="#" class="fw-semibold fs-5 text-body-secondary text-decoration-none">Category</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="siteSearch">
                        <form class="searchBox" role="search">
                            <input class="form-control me-2 w-medium fs-6 text-body-secondary bg-transparent rounded" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="userProfile">
                        <a class="dropdown-toggle dropdownUser text-body-secondary text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        </a>
                        @auth('customer')
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> <img src="{{asset('/assets/front')}}/img/user.png" alt="User"> </a>
                            <ul class="dropdown-menu dropdown-menu-end _nedd_color">
                                <li><a class="dropdown-item" href="{{route('customer.profile')}}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"> Sign Out </a></li>
                                <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        @endauth
                        <ul class="dropdown-menu">
                            @guest('customer')
                            <li><a class="dropdown-item" href="{{route('customer.login')}}">Sign In</a></li>
                            <li><a class="dropdown-item" href="{{route('customer.register')}}">Sign Up</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="wishCartList text-end">
                        <ul class="textRightSet list-unstyled p-0 m-0" style="display: inline-flex;">
                            <li class="pe-2">
                                <a href="#" class="text-body-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg></a>
                            </li>
                            <li class="ps-2">
                                <a href="#" class="text-body-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer class="_site_footer pt-5">

        <section class="_footer_section">
            <div class="container-fluid px-5">
                <div class="row justify-content-between">

                    <div class="col-md-3 col-lg-2 pb-4">
                        <div class="_address">
                            <h5>About soccer club</h5>
                            <p>{{ config('settings.footerDdescription', '') }}</p>
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2 pb-4">
                        <div class="_useful">
                            <h5>Quick shop</h5>
                            @empty(!CustomHelper::NaveMenu('quick-shop',[]))
                            {!! CustomHelper::NaveMenu('quick-shop',[]) !!}
                            @endempty
                        </div>
                        <div class="_useful pt-3">
                            <h5>Useful links</h5>
                            @empty(!CustomHelper::NaveMenu('useful-links',[]))
                            {!! CustomHelper::NaveMenu('useful-links',[]) !!}
                            @endempty
                        </div>

                    </div>

                    <div class="col-md-2 col-lg-2 pb-4">
                        <div class="_loactions">
                            <h5>Contact Us</h5>
                            <ul><li><a href="mailto:{{ config('settings.appEmail', 'info@emailaddress.com') }}"> {{ config('settings.appEmail', 'info@emailaddress.com') }}</a></li>
                        <li><a href="tel:{{ config('settings.appPhone', '') }}"> {{ config('settings.appPhone', '') }}</a></li>
                        <li>{{ config('settings.appAddress', '') }}</li>
                        </ul>
                            <!-- <p><b>Email Us:</b></p>
                            <p><b>Call Us:</b></p>
                            <p><b>Address:</b> </p> -->
                                                       
                        </div>
                        <div class="_social">
                            <h5 class="pt-3">Follow Us</h5>
                            <ul class="list-unstyled d-inline-flex m-0 p-0">
                                @empty(!CustomHelper::SocialMenu('social'))
                                @foreach (CustomHelper::SocialMenu('social') as $item)
                                <li><a href="{{$item->menu_url}}"><i class="{{$item->menu_class}}" aria-hidden="true"></i></a></li>
                                @endforeach
                                @endempty
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        <div class="_newsletter">
                            <h5>PAYMENT METHODS</h5>
                            <div class="_payment">
                                <img src="{{asset('/assets/front')}}/img/SSLCommerz-Pay.png" alt="" class="w-100">
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="_footer_copyright py-2">
            <div class="container-fluid px-5">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-3 col-lg-2">
                        <img src="assets\front\img\Ladiumbd-logo-white.png" class="w-100" alt="Company Logo">
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <p>&copy; 2023. All Rights Reserved. Powered by {{ config('settings.appTitle','') }}.</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <!-- @livewire('subscribe-form') -->
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <!-- js section -->

    <script src="{{asset('/assets/front/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/front/js/owl.carousel.min.js')}}"></script>
    @yield('js')
    @stack('scripts')
    <!-- custom js -->
    <script src="{{asset('/assets/front/js/custom.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


    {{-- <script src="assts/js/jquery.js"></script>
    <script src="assts/js/bootstrap.min.js"></script>
    <script src="assts/js/owl.carousel.min.js"></script>
    <script src="assts/js/custom.js"></script> --}}

</body>

</html>