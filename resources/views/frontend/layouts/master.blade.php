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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('/assets/front/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/front/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="//unpkg.com/aos@next/dist/aos.css" />
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
            <div class="row justify-content-between g-2 g-sm-0 align-items-center">
                <div class="col-md-2 col-5 order-sm-1">
                    <div class="branding">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <figure class="m-0 _hmenu">
                                @if(empty(config('settings.appLogo')))
                                <img class="img-fluid w-sm-75" src="{{asset('/assets/front')}}/newImg/ladimum-logo.png" alt="{{ config('settings.appTitle') }}">
                                @else
                                <img class="img-fluid w-sm-75" src="{{ asset('storage/'.config('settings.appLogo')) }}" alt="{{ config('settings.appTitle') }}">
                                @endif
                            </figure>
                        </a>
                    </div>
                </div>

                <div class="col-md-1 col-4 text-center order-sm-4">
                    <ul class="userProfile list-unstyled m-0 p-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end _nedd_color">
                                @auth('customer')
                                <li><a class="dropdown-item" href="{{route('customer.profile')}}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"> Sign Out </a></li>
                                <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @endauth
                                @guest('customer')
                                <li><a class="dropdown-item" href="{{route('customer.login')}}">Sign In</a></li>
                                <li><a class="dropdown-item" href="{{route('customer.register')}}">Sign Up</a></li>
                                @endguest
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="col-md-1 col-3 text-end order-sm-5">
                    @livewire('mini-cart')
                </div>

                <div class="col-md-4 col-3 order-sm-2">
                    <div class="mobileNav d-block d-sm-none">
                        <a class="" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            <i class="bi bi-list fs-3 fw-5"></i>
                        </a>

                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="mobileMenus">
                                    @empty(!CustomHelper::NaveMenu('main',[]))
                                    {!! CustomHelper::NaveMenu('main',['menuClass'=>'mobileMenusUl','listClass'=>'navitem','linkClass'=>'nav-link', 'listParentClass'=>'dropdow','subMenuClass'=>'dropdownmenu','listParentLinkClass'=>'dropdowntoggle']) !!}
                                    @endempty
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="siteMenu d-none d-sm-block" id="siteMenu">
                        @empty(!CustomHelper::NaveMenu('main',[]))
                        {!! CustomHelper::NaveMenu('main',['menuClass'=>'list-unstyled m-0 p-0','listClass'=>'nav-item','linkClass'=>'nav-link px-2', 'listParentClass'=>'dropdown','subMenuClass'=>'border-bottom dropdown-menu','listParentLinkClass'=>'dropdown-toggle']) !!}
                        @endempty
                    </div>
                </div>

                <div class="col-md-3 col-9 order-sm-3">
                    <div class="siteSearch">
                        <form method="GET" class="searchBox" role="search" action="{{ route('search') }}">
                            <input name="search" class="form-control me-2 w-medium fs-6 text-body-secondary bg-transparent rounded" type="search" value="{{ request()->search }}" placeholder="Search" aria-label="Search">
                        </form>
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

                    <div class="col-md-4 col-lg-3 pb-4">
                        <div class="_address">
                            <h5>About our priority.</h5>
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
                            <ul>
                                <li><a href="mailto:{{ config('settings.appEmail', 'info@emailaddress.com') }}"> {{ config('settings.appEmail', 'info@emailaddress.com') }}</a></li>
                                <li><a href="tel:{{ config('settings.appPhone', '') }}"> {{ config('settings.appPhone', '') }}</a></li>
                                <li>{{ config('settings.appAddress', '') }}</li>
                            </ul>
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

                    <div class="col-md-3 col-lg-3">
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
                <div class="row justify-content-between align-items-center align-content-center">
                    <div class="col-md-3 col-lg-2">
                        @if(empty(config('settings.appLogo')))
                        <img class="w-75" src="{{asset('/assets/front')}}/img/Ladiumbd-logo-white.png" alt="{{ config('settings.appTitle') }}">
                        @else
                        <img class="w-75" src="{{ asset('storage/'.config('settings.footerLogo')) }}" alt="{{ config('settings.appTitle') }}">
                        @endif
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <p class="m-0">&copy; 2023. All Rights Reserved. Powered by {{ config('settings.appTitle','') }}.</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        @livewire('subscribe-form')
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
    <script src="//unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


    {{-- <script src="assts/js/jquery.js"></script>
    <script src="assts/js/bootstrap.min.js"></script>
    <script src="assts/js/owl.carousel.min.js"></script>
    <script src="assts/js/custom.js"></script> --}}

</body>

</html>