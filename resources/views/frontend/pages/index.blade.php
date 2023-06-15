@extends('frontend.layouts.master')
@section('content')



<section class="_home_carousel">
    <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
        @php $slides = CustomHelper::posts(['post_type'=>'slide','orderBy'=>'sort']) @endphp
        @if($slides)
        <div class="carousel-indicators">
            @foreach($slides as $key=>$slide)
            <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="{{$key}}" @if($key==0) class="active" @endif aria-current="true" aria-label="Slide 1"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($slides as $key=>$slide)
            <div class="carousel-item @if($key==0) active @endif ">
                <img src="{{asset('storage/'.$slide->image)}}" class="w-100 _carouselImg" alt="Banner Image">
                <!-- <div class="carousel-caption _carousel_caption">
                    <div class="_carousel_caption_text">
                        <h2>{!! $slide->title !!}</h2>
                        {!! $slide->body !!}
                        <button class="_btn_banner"><a href="#">Learn More <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a></button>
                    </div>
                </div> -->
            </div>
            @endforeach
        </div>
        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button> -->
        @endif
    </div>
</section>



<section class="_clientsBrands py-5">
    <div class="container-fluid px-sm-5">
        <div class="owl-carousel owl-theme" id="owl-slider">
            @php $client_logo = CustomHelper::posts(['post_type'=>'client-logo','orderBy'=>'sort']) @endphp
            @if($client_logo)
            @foreach($client_logo as $key=>$logo)
            <div class="item">
                <img class="" src="{{asset('storage/'.$logo->image)}}" alt="">
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<!--    Our Product Start -->
<section class="products py-4">
    <div class="container-fluid px-sm-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="sectionTitle">new <span>arrivals</span></h4>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-start justify-items-start">
            @foreach ($feature_products as $item)
            <div class="col my-2 productCard" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="productItem border border-secondary-subtle">
                    @include('frontend.layouts.product-loop')
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--    Our Product End-->

<!--    Our Product Start -->
<section class="products py-4">
    <div class="container-fluid px-sm-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="sectionTitle">best <span>selling products</span></h4>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-start justify-items-start">
            @foreach ($feature_products as $item)
            <div class="col my-2 productCard" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="productItem border border-secondary-subtle">
                    @include('frontend.layouts.product-loop')
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--    Our Product End-->


<!--    Our Product Start -->
<section class="products py-4">
    <div class="container-fluid px-sm-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="sectionTitle">featured <span>Products</span></h4>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-start justify-items-start">
            @foreach ($feature_products as $item)
            <div class="col my-2 productCard" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="productItem border border-secondary-subtle">
                    @include('frontend.layouts.product-loop')
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--    Our Product End-->

<!--    Our Categories -->
<!-- <section class="_product">
    <div class="container">
        <h2>Categories</h2>
        @if($categories)
        <div class="owl-carousel owl-theme" id="produces">
            @foreach($categories as $key=>$category)
            <figure class="_overhover">
                <img class="img-fluid img-products" src="{{asset('storage/'.$category->image)}}" alt="{{$category->title}}">
                <figcaption class="_plink">
                    <a href="#"><i class="fa fa-search-plus" aria-hidden="true"></i>{{$category->title}}</a>
                </figcaption>
            </figure>
            @endforeach
            @endif
        </div>
    </div>
</section> -->

<article class="products py-5 aos-init aos-animate" data-aos="fade-up" data-aos-duration="4000">

    <div class="container-fluid px-sm-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="sectionTitle">Top <span>categories</span></h4>
            </div>
        </div>
    </div>

    <div class="container-fluid px-sm-5">
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-start justify-items-start">
            <div class="col-md-3 col-6 col-sm-4 my-3 aos-init aos-animate" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="container-fluid">
                    <div class="row align-items-center bg-white leftRignt py-2">
                        <div class="col-md-6 order-sm-2 imageCate text-center"><img class="img-fluid" src="https://res.cloudinary.com/dpkigct8u/image/upload/v1679277566/u5tyfvlvxabrfze2bwam.jpg" alt="category" style="max-height: 100px;"></div>
                        <div class="col-md-6 py-3 textSide">
                            <h5 class="m-0 py-2 fs-6">Sports leggings</h5>
                            <div class="btoffer text-center"><a class="btnoffer" href="/">View All</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 col-sm-4 my-3 aos-init aos-animate" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="container-fluid">
                    <div class="row align-items-center bg-white leftRignt py-2">
                        <div class="col-md-6 order-sm-2 imageCate text-center"><img class="img-fluid" src="https://res.cloudinary.com/dpkigct8u/image/upload/v1679277442/bkkeuywwuhi4nnvwhjzr.jpg" alt="category" style="max-height: 100px;"></div>
                        <div class="col-md-6 py-3 textSide">
                            <h5 class="m-0 py-2 fs-6">Sports leggings</h5>
                            <div class="btoffer text-center"><a class="btnoffer" href="/">View All</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 col-sm-4 my-3 aos-init aos-animate" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="container-fluid">
                    <div class="row align-items-center bg-white leftRignt py-2">
                        <div class="col-md-6 order-sm-2 imageCate text-center"><img class="img-fluid" src="https://res.cloudinary.com/dpkigct8u/image/upload/v1662788653/l22jzur4vkqtiig0biar.jpg" alt="category" style="max-height: 100px;"></div>
                        <div class="col-md-6 py-3 textSide">
                            <h5 class="m-0 py-2 fs-6">Sports leggings</h5>
                            <div class="btoffer text-center"><a class="btnoffer" href="/">View All</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 col-sm-4 my-3 aos-init aos-animate" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="container-fluid">
                    <div class="row align-items-center bg-white leftRignt py-2">
                        <div class="col-md-6 order-sm-2 imageCate text-center">
                            <img class="img-fluid" src="https://res.cloudinary.com/dpkigct8u/image/upload/v1662345094/kcz7zvfwo7u0tug9ankk.jpg" alt="category" style="max-height: 100px;">
                        </div>
                        <div class="col-md-6 py-3 textSide">
                            <h5 class="m-0 py-2 fs-6">Sports leggings</h5>
                            <div class="btoffer text-center"><a class="btnoffer" href="/">View All</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 col-sm-4 my-3 aos-init aos-animate" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="container-fluid">
                    <div class="row align-items-center bg-white leftRignt py-2">
                        <div class="col-md-6 order-sm-2 imageCate text-center"><img class="img-fluid" src="https://res.cloudinary.com/dpkigct8u/image/upload/v1662788653/l22jzur4vkqtiig0biar.jpg" alt="category" style="max-height: 100px;"></div>
                        <div class="col-md-6 py-3 textSide">
                            <h5 class="m-0 py-2 fs-6">Sports leggings</h5>
                            <div class="btoffer text-center"><a class="btnoffer" href="/">View All</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="viewMoreBtn text-center">
        <a href="/">View All</a>
    </div> -->
</article>
<!--    Our Categories End -->

<section class="_clients_testimonial bg-white py-5">

    <div class="container-fluid px-sm-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="sectionTitle">clients <span>testimonial</span></h4>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="owl-carousel owl-theme" id="owl-clients">
            @php $testimonials = CustomHelper::posts(['post_type'=>'testimonial','orderBy'=>'sort']) @endphp
            @if($testimonials)
            @foreach($testimonials as $key=>$testimonial)
            <div class="item">
                <div class="_clients_box text-center">
                    <div class="_client_name_image">
                        <figure>
                            <!-- <img class="img-fluid img-clients" src="{{asset('storage/'.$testimonial->image)}}" alt=""> -->
                            <img src="assets\front\img\Clens-testimonial-user.png" class="w-25 mx-auto" alt="Company Logo">
                        </figure>
                        <div class="_client_bio">
                            <h6>{{ $testimonial->title }}</h6>
                            <strong>{{ $testimonial->postMeta->where('meta_key','designation')->pluck('meta_value')->first() }}</strong>
                        </div>
                    </div>
                    {!! $testimonial->body !!}
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>


@endsection


@section('js')
<script>
    $('#produces').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    $('.addto-wishlist').click(function() {
        //console.log($(this).data('id'));
        var id = $(this).data('id');
        Livewire.emit('addToWishlist', {
            id: id
        });
    });

    $('.quickShop').click(function() {
        //console.log($(this).data('id'));
        var id = $(this).data('id');
        Livewire.emit('addToCart', {
            id: id,
            qty: 1
        });
    });
</script>
@endsection