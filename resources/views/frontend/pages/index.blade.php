@extends('frontend.layouts.master')
@section('content')

<div class="_home_carousel">
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
              <img src="{{asset('storage/'.$slide->image)}}" class="img-fluid _carouselImg" alt="Banner Image">
              <div class="carousel-caption _carousel_caption">
                  <div class="_carousel_caption_text">
                      <h2>{!! $slide->title !!}</h2>
                      {!! $slide->body !!}
                      <button class="_btn_banner"><a href="#">Learn More <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a></button>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
      @endif
  </div>
</div>
</header>


<section class="_clients">
<div class="container">

  <div class="owl-carousel owl-theme" id="owl-slider">
      @php $client_logo = CustomHelper::posts(['post_type'=>'client-logo','orderBy'=>'sort']) @endphp
      @if($client_logo)
      @foreach($client_logo as $key=>$logo)
      <div class="item">
          <figure>
              <img class="" src="{{asset('storage/'.$logo->image)}}" alt="">
          </figure>
      </div>
      @endforeach
      @endif
  </div>

</div>

</section>

<section class="_product">
    <div class="container">
        <h3>We Produce</h3>
    </div>

    <div class="container-fluid py-3">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 justify-content-between">
            <div class="col my-md-4 my-2" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50"
                data-aos-duration="1000">
                <figure class="m-0 border position-relative">
                    <div class="quickview position-absolute top-0 end-0"><a class="quebtn text-black"
                            data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i
                                class="bi bi-eye-fill"></i></a>
                    </div>
                    <img class="img-fluid" src="img/Black-Acid-Washed-Jeans-58.jpg" alt="">
                    <figcaption class="p-2 text-center">
                        <h2 class="fstitle fs-6">Premium Quality Full sleeve Padded Crop Top</h2>
                        <div class="productprice d-flex align-items-center justify-content-between">
                            <span class="saleprice">$9999.00</span> <a href="#" class="buynow">Buy Now</a>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>
<!--    Our Product -->

<!--    Our Product -->
<section class="_product">
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
</section>
<!--    Our Product -->

<!--    Why Us -->
<section class="_why-us">
@php $why_us_center = CustomHelper::posts(['post_type'=>'why-us','cat'=>['center'],'single'=>true,'orderBy'=>'id']) @endphp
@if($why_us_center)
<div class="container">
  <div class="_us_title">
      <h2>{{ $why_us_center->title }}</h2>
      {!! $why_us_center->body !!}
  </div>
</div>
<div class="container">
  <div class="row justify-content-between">
      <div class="col-md-4 col-lg-4">
        @php $why_us = CustomHelper::posts(['post_type'=>'why-us','cat'=>['left'],'take'=>3,'orderBy'=>'sort']) @endphp
          @if($why_us)
          @foreach($why_us as $key=>$item)
          <div class="_text_title">
              <div class="title_left_image">
                  <h3>{{ $item->title }}</h3>
                  <figure>
                      <img src="{{asset('storage/'.$item->image)}}" alt="">
                  </figure>
              </div>
              <div class="_club_text text-end">
                {!! $item->body !!}
              </div>
          </div>
        @endforeach
      @endif
      </div>

      <div class="col-md-4 col-lg-4">
          <figure>
              <img class="img-fluid" src="{{asset('storage/'.$why_us_center->image)}}" alt="">
          </figure>
      </div>

      <div class="col-md-4 col-lg-4">
        @php $why_us = CustomHelper::posts(['post_type'=>'why-us','cat'=>['right'],'take'=>3,'orderBy'=>'sort']) @endphp
        @if($why_us)
          @foreach($why_us as $key=>$item)
          <div class="_text_title_right">
              <div class="title_right_image">
                  <figure>
                      <img src="{{asset('storage/'.$item->image)}}" alt="">
                  </figure>
                  <h3>{{ $item->title }}</h3>
              </div>
              <div class="_club_text_right  text-start">
                {!! $item->body !!}
              </div>
          </div>
        @endforeach
      @endif
      </div>
  </div>
</div>
@endif
</section>
<!--    Why Us -->

<section class="_register">
    @livewire('contact-form')
</section>

<section class="_clients_testimonial">
<div class="container">
  <div class="_testimonial_title">
      <h2>clients testimonial</h2>
      <p>Some representative placeholder content for the first slide content for the.</p>
  </div>
</div>

<div class="container">
  <div class="owl-carousel owl-theme" id="owl-clients">
      @php $testimonials = CustomHelper::posts(['post_type'=>'testimonial','orderBy'=>'sort']) @endphp
      @if($testimonials)
      @foreach($testimonials as $key=>$testimonial)
      <div class="item">
          <div class="_clients_box">
              <div class="_client_name_image">
                  <figure>
                      <img class="img-fluid img-clients" src="{{asset('storage/'.$testimonial->image)}}" alt="">
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
            loop:true,
            margin:10,
            nav:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>
@endsection
