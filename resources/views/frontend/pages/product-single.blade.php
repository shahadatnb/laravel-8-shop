@extends('frontend.layouts.master')
@section('title',$product->title)
@section('css')
{{-- <link rel="stylesheet" href="{{asset('assets/front/slick/slick.min.css')}}" media="all">
<link rel="stylesheet" href="{{asset('1assets/front/slick/slick-theme.css')}}" media="all"> --}}
<link rel="stylesheet" href="{{asset('assets/admin/plugins/pic-zoomer/css/jquery-picZoomer.css')}}" media="all">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" />
<link rel="stylesheet" href="{{asset('assets/front/css/inner_product.css?v='.time())}}" media="all">
@endsection
@section('content')
<section class="_inner_page_banner">
	<div class="container">
		<div class="_in_title_text">
			<h1>{{$product->title}}</h1>
		</div>
	</div>
</section>

<section class="_sub_nav">
	<div class="container">
		<div class="_nav_product_view">
			<nav>
				<ul>
					<li><a href="{{url('/')}}">Home</a></li>
                    @if($product->categories)
					    <li><a href="#">{{ $product->categories[0]->title }}</a></li>
                    @endif
				</ul>
			</nav>
		</div>
	</div>
</section>


<section class="_prduct_details">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
                @php $photos = $product->allphotos @endphp
                @if($photos->count() > 0)
                <div class="row">
                    <div class="col-2">
                        <div id="single-product-slide-wrapper" >
                            {{--<img id="slideLeft" class="arrow" src="images/arrow-left.png">--}}
                            <div id="single-product-slider">
                                @foreach ($photos as $item)
                                    <img class="thumbnail" src="{{ asset('storage/' . $item->path) }}">
                                @endforeach
                            </div>
                            {{--<img id="slideRight" class="arrow" src="images/arrow-right.png">--}}
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="picZoomer">
                            <img id="featured" src="{{ asset('storage/' . $photos[0]->path) }}">
                        </div>
                    </div>
                </div>
                @endif
                {{--
                <div class="slider owl-carousel owl-theme">
					@foreach ($product->allphotos as $item)
					<div class="item" data-hash="d-{{$item->id}}"><img class="_side_1_img" width="100" src="{{ asset('storage/' . $item->path) }}"></div>
					@endforeach
				  </div>

				  <div class="slider2 owl-carousel owl-theme owl-carousel-vertical mt-2">
					@foreach ($product->allphotos as $item)
						<a href="#d-{{$item->id}}" class="item" data-hash="d-{{$item->id}}"><img class="_side_1_img" width="100" src="{{ asset('storage/' . $item->path) }}"></a>
					@endforeach
				  </div>
				  --}}
				{{-- <div class="slider-for">
					@foreach ($product->allphotos as $item)
					<div><img class="_side_1_img" width="100" src="{{ asset('storage/' . $item->path) }}"></div>
					@endforeach
				</div>
				<div class="slider-nav">
					@foreach ($product->allphotos as $item)
					<div><img class="_side_1_img" width="100" src="{{ asset('storage/' . $item->path) }}"></div>
					@endforeach
				</div> --}}
			</div>
			<div class="col-sm-12 col-lg-6">
				@livewire('product.single-product', ['product'=>$product])
			</div>
		</div>
{{--
		<div class="row">
			<div class="_share">
				<span>Share:</span> <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
			</div>
		</div>
--}}
		<div class="row_nav_tabs">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Product Details</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Reviews</button>
				</li>
                {{--
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Size &amp; Fit</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="contact" aria-selected="false">Shipping &amp; Return</button>
				</li>
				--}}
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="_descriptions">
						{!! $product->description !!}
					</div>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="ps-tab" id="tab-reviews">
						<div class="row">
							<div class="col-lg-6">


								<div class="block--product-reviews">
									<div class="r_header">
                                        @php $count = $product->reviews->count()  @endphp
                                        @if($count < 1)
                                            <h2>no review</h2>
                                        @elseif($count == 1)
                                            <h2>1 review</h2>
                                        @else
										    <h2>{{ $count }} reviews</h2>
                                        @endif
									</div>
									<div id="app" class="block__content">
										<div class="block__content">
											@foreach($product->reviews as $review)
											<div class="block--review">
												<div class="block__header">
													<div class="block__image">
                                                        <img src="{{ asset('assets/admin/img/avatar.png') }}" alt="{{$review->customer->first_name.' '.$review->customer->last_name}}" width="60">
                                                    </div>
													<div class="block__info">
														<div class="rating_wrap">
                                                            @for($i=0; $i < 5; $i++)
                                                                @if($i < $review->rating)
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                @else
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                @endif
                                                            @endfor
														</div>
														<p><strong>{{$review->customer->first_name.' '.$review->customer->last_name}}</strong> | {{ prettyDate($review->created_at) }}</p>
														<div class="block__content">
															<p>{{ $review->comment }}</p>
														</div>
													</div>
												</div>
											</div>
                                            @endforeach
										</div>
									</div>
								</div>

							</div>
							<div class="col-lg-6">
                                {!! Form::open(array('route'=>'product-review')) !!}
									<input type="hidden" name="product_id" value="{{$product->id}}">
									<h4>Submit Your Review</h4>
									<div class="form-group form-group__rating">
										<p>Your rating of this product</p>
                                        <div class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Meh">5 stars</label>
                                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Kinda bad">4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Kinda bad">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Sucks big tim">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                                        </div>
									</div>
									<div class="form-group">
										<textarea class="form-control" name="comment" id="txt-comment" rows="6" placeholder="Write your review"></textarea>
									</div>
									<div class="form-group submit">
										<button class="ps-btn  btn-disabled " type="submit">Submit Review</button>
									</div>
                                {!! Form::close() !!}
							</div>
						</div>

					</div>
				</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<h5>Size &amp; Fit</h5>
					<ul>
						<li>Neque porro quisquam velit</li>
						<li>est qui dolorem ipsum</li>
						<li>quia dolor sit amet</li>
						<li>consectetur adipisci</li>
						<li>consectetur adipisci</li>
						<li>consectetur adipisci</li>
					</ul>
				</div>
				<div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="contact-tab">
					<h5>Shipping &amp; Return</h5>
					<ul>
						<li>Neque porro quisquam velit</li>
						<li>est qui dolorem ipsum</li>
						<li>quia dolor sit amet</li>
						<li>consectetur adipisci</li>
						<li>consectetur adipisci</li>
						<li>consectetur adipisci</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>



<!--    Our Product -->
<section class="_product">
	<div class="container">
		<h2>Related products</h2>
		<div class="owl-carousel owl-theme" id="related_products">
			@foreach ($related_products as $item)
				<div class="item">
					@include('frontend.layouts.product-loop')
				</div>
			@endforeach
		</div>
	</div>
</section>
<!--    Our Product -->



<!--    Recommended Products -->
<section class="_product">
	<div class="container">
		<h2>Recommended Products</h2>
		<div class="owl-carousel owl-theme" id="recommended_products">
			@foreach ($recommended_products as $item)
				<div class="item">
					@include('frontend.layouts.product-loop')
				</div>
			@endforeach
		</div>
	</div>
</section>
<!--    Recommended Products -->
@endsection

@section('js')
{{-- <script src="{{asset('/assets/front')}}/slick/slick.min.js"></script> --}}
<script src="{{asset('assets/admin/plugins/pic-zoomer/src/jquery.picZoomer.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
<script>
	$('.slider').owlCarousel({
		loop:true,
		margin:10,
		items:1,
		dots:false,
		URLhashListener:true
	});

	$('.slider2').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		items:3,
		dots:false,
		center: true,
		URLhashListener:true
	});

    $('.picZoomer').picZoomer();

    /*
    $('.slider2').data('owl.carousel').difference = function(first, second) {
        return {
            x: first.x - second.x + (first.y - second.y),
            y: first.y - second.y
        };
    };
*/
	$('#related_products').owlCarousel({
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
	});

	$('#recommended_products').owlCarousel({
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
	});


	$('.addto-wishlist').click(function(){
		//console.log($(this).data('id'));
		var id = $(this).data('id');
		Livewire.emit('addToWishlist', { id : id} );
	});

	$('.quickShop').click(function(){
		//console.log($(this).data('id'));
		var id = $(this).data('id');
		Livewire.emit('addToCart', { id : id} );
	});

	// Product Slider
    let thumbnails = document.getElementsByClassName('thumbnail')

    let activeImages = document.getElementsByClassName('active')

    for (var i=0; i < thumbnails.length; i++){

        thumbnails[i].addEventListener('mouseover', function(){
            //console.log(activeImages)

            if (activeImages.length > 0){
                activeImages[0].classList.remove('active')
            }


            this.classList.add('active')
            document.getElementById('featured').src = this.src
        })
    }

/*
    let buttonRight = document.getElementById('slideRight');
    let buttonLeft = document.getElementById('slideLeft');

    buttonLeft.addEventListener('click', function(){
        document.getElementById('slider').scrollLeft -= 180
    })

    buttonRight.addEventListener('click', function(){
        document.getElementById('slider').scrollLeft += 180
    })
 */
</script>
@endsection
