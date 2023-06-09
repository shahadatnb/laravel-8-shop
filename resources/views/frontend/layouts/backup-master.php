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
    {{-- <link rel="stylesheet" href="{{asset('/assets/front')}}/css/bootstrap.min.css" /> --}}
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/assets/front/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/front/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/loading.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/front/css/style.css')}}?v={{time()}}" />
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
    <header class="_home_header">

        <div class="_headcontainer menus {{ (request()->routeIs('page','page')) ? 'bg-dark bg-gradient' : '' }}">
            <!--
            <div class="container">
                <div class="row justify-content-between">
-->

            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        @if(!empty(config('settings.appLogo')))
                            <figure class="_hmenu">
                                {{-- <img class="" src="{{asset('/assets/front')}}/img/menu-icon.png" alt="Menu Icon"> --}}
                                <img src="{{ asset('storage/'.config('settings.appLogo')) }}" alt="Logo">
                            </figure>
                        @else
                            {{ config('settings.appTitle') }}
                        @endif
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse _site_mega_menu" id="main_nav">
                        <ul class="navbar-nav _site_mega_menu_ul m-auto">
                            <li class="nav-item active"> <a class="nav-link" href="{{ route('/') }}">Home </a> </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('store') }}"> Products </a></li>
                            <li class="nav-item dropdown has-megamenu">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Mega menu </a>
                                <div class="dropdown-menu megamenu _site_mega_menu_div" role="menu">
                                    <div class="container">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-2 col-md-2">
                                            <div class="col-megamenu">
                                                <span class="_mg_title_img">More Sports</span>
                                                <ul class="list-unstyled">
                                                    <li><a href="#">Baseball Hall of Fame</a></li>
                                                    <li><a href="#">Boxing</a></li>
                                                    <li><a href="#">Cooperstown Teams</a></li>
                                                    <li><a href="#">Gridiron Classic Teams</a></li>
                                                    <li><a href="#">Hardwood Classic Teams</a></li>
                                                    <li><a href="#">Kentucky Derby</a></li>
                                                    <li><a href="#">NLL Lacrosse</a></li>
                                                    <li><a href="#">Olympics</a></li>
                                                </ul>
                                                <button><a href="#">View More</a></button>
                                            </div>
                                            <div class="col-megamenu">
                                                <span class="_mg_title_img">Top Searches</span>
                                                <ul class="list-unstyled">
                                                    <li><a href="#">Beast Mode</a></li>
                                                    <li><a href="#">Big & Tall</a></li>
                                                    <li><a href="#">Plus Sizes</a></li>
                                                    <li><a href="#">Cooperstown Collection</a></li>
                                                    <li><a href="#">Fanatics Presents</a></li>
                                                    <li><a href="#">Hardwood Classics</a></li>
                                                    <li><a href="#">Hat Brands For All Fans</a></li>
                                                    <li><a href="#">Vintage Clothing</a></li>
                                                </ul>
                                                <button><a href="#">View More</a></button>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="col-megamenu">
                                                <span class="_mg_title_img">National Teams</span>
                                                <ul class="list-unstyled">
                                                    <li><a href="#">Argentina National Team</a></li>
                                                </ul>
                                                <button><a href="#">View More</a></button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <div class="col-megamenu">
                                                <span class="_mg_title_img">International Clubs</span>
                                                <ul class="list-unstyled">
                                                    <li><a href="#">Arsenal</a></li>
                                                    <li><a href="#">Barcelona</a></li>
                                                    <li><a href="#">Bayern Munich</a></li>
                                                    <li><a href="#">FC Nurnberg</a></li>
                                                    <li><a href="#">AC Milan</a></li>
                                                    <li><a href="#">Arsenal</a></li>
                                                    <li><a href="#">Athletic Club Bilbao</a></li>
                                                    <li><a href="#">Atletico de Madrid</a></li>
                                                    <li><a href="#">AZ Alkmaar</a></li>
                                                    <li><a href="#">Boca Juniors</a></li>
                                                    <li><a href="#">Borussia Dortmund</a></li>
                                                    <li><a href="#">C.F. Pachuca</a></li>
                                                    <li><a href="#">Liverpool</a></li>
                                                    <li><a href="#">Manchester City</a></li>
                                                    <li><a href="#">Manchester United</a></li>
                                                    <li><a href="#">Newcastle United</a></li>
                                                    <li><a href="#">Olympique Marseille</a></li>
                                                    <li><a href="#">Premier League</a></li>
                                                    <li><a href="#">PSV Eindhoven</a></li>
                                                </ul>
                                                <button><a href="#">View More</a></button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <div class="col-megamenu">

                                                <figure>
                                                    <img class="img-fluid" src="{{asset('/assets/front')}}/img/q1.webp">
                                                </figure>
                                                <span class="_mg_title_img">New Arrival</span>
                                            </div>

                                            <div class="col-megamenu">
                                                <figure>
                                                    <img class="img-fluid" src="{{asset('/assets/front')}}/img/q2.webp">
                                                </figure>
                                                <span class="_mg_title_img">10% Off</span>
                                            </div>
                                        </div><!-- end col-3 -->

                                        <div class="col-lg-2 col-md-2">
                                            <div class="col-megamenu">

                                                <figure>
                                                    <img class="img-fluid" src="{{asset('/assets/front')}}/img/q3.webp">
                                                </figure>
                                                <span class="_mg_title_img">New Arrival</span>
                                            </div>

                                            <div class="col-megamenu">
                                                <figure>
                                                    <img class="img-fluid" src="{{asset('/assets/front')}}/img/q4.webp">
                                                </figure>
                                                <span class="_mg_title_img">10% Off</span>
                                            </div>
                                        </div>
                                    </div><!-- end row -->
                                    </div><!-- end container -->
                                </div> <!-- dropdown-mega-menu.// -->
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                          @guest('customer')
                            <li class="nav-item"><a class="btn btn-primary" href="{{route('customer.login')}}">Signin</a></li>
                            <li class="nav-item"><a class="btn btn-primary" href="{{route('customer.register')}}">Signup</a></li>
						@endguest
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
                            @livewire('mini-cart')
                        </ul>
                    </div> <!-- navbar-collapse.// -->
                </div> <!-- container-fluid.// -->
            </nav>
        </div>
    </header>
@yield('content')
    <footer class="_site_footer">

        <section class="_footer_section">
            <div class="container-fluid">
                <div class="row justify-content-center">

                    <div class="col-md-3 col-lg-3">
                        <div class="_address">
                            <h5>About soccer club</h5>
                            <p>{{ config('settings.footerDdescription', '') }}</p>
                            <div class="_loactions">
                                <h6>Contact Us</h6>
                                <p><b>Address:</b> {{ config('settings.appAddress', '') }}</p>
                                <p><b>Call Us:</b><a href="tel:{{ config('settings.appPhone', '') }}"> {{ config('settings.appPhone', '') }}</a></p>
                                <p><b>Email Us:</b><a href="mailto:{{ config('settings.appEmail', 'info@emailaddress.com') }}"> {{ config('settings.appEmail', 'info@emailaddress.com') }}</a></p>
                            </div>
                            <div class="_social">
                                <h6>Follow Us</h6>
                                <ul>
                                    @empty(!CustomHelper::SocialMenu('social'))
                                        @foreach (CustomHelper::SocialMenu('social') as $item)
                                        <li><a href="{{$item->menu_url}}"><i class="{{$item->menu_class}}" aria-hidden="true"></i></a></li>
                                        @endforeach
                                    @endempty
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <div class="_useful">
                            <h5>Quick shop</h5>
                            @empty(!CustomHelper::NaveMenu('quick-shop',[]))
                                {!! CustomHelper::NaveMenu('quick-shop',[]) !!}
                            @endempty
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <div class="_useful">
                            <h5>Useful links</h5>
                            @empty(!CustomHelper::NaveMenu('useful-links',[]))
                                {!! CustomHelper::NaveMenu('useful-links',[]) !!}
                            @endempty
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div class="_newsletter">
                            <h5>Sign up to receive our newsletter</h5>
                            <p>Some representative placeholder content for the first slide content for the.</p>
                                @livewire('subscribe-form')
                            <div class="_payment">
                                <img src="{{asset('/assets/front')}}/img/bank-logo.png" alt="">
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="_footer_copyright">
            <div class="container">
                <p>&copy; 2021. All Rights Reserved. Powered by {{ config('settings.appTitle','') }}.</p>
            </div>
        </section>
    </footer>

<!-- js section -->
<script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="{{asset('/assets/front/js/owl.carousel.min.js')}}"></script>
@yield('js')
@stack('scripts')
<!-- custom js -->
<script src="{{asset('/assets/front/js/custom.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>   


    {{-- <script src="assts/js/jquery.js"></script>
    <script src="assts/js/bootstrap.min.js"></script>
    <script src="assts/js/owl.carousel.min.js"></script>
    <script src="assts/js/custom.js"></script> --}}

</body>

</html>
