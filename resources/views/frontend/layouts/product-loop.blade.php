<figure class="_inn_overhover m-0 border-1 p-2 bg-white">
  <a href="{{ route('singleProduct',$item->id)}}" class="text-decoration-none text-black-50">
    @if($item->thumbnail != '')
    <img class="img-fluid img-products" src="{{ asset('storage/' . $item->thumbnail) }}" alt="Product Image">
    @else
    <img src="{{asset('assets\front\img\product-demo.jpg')}}" alt="" srcset="" class="img-fluid">
    @endif
    <figcaption class="_in_plink">
      <h2>{{ $item->title }}</h2>

      <div class="priceBuy d-flex justify-content-between align-items-center">
        <div class="proPrice text-black">
          @if ($item->special_price > 0)
          <h4><span class="_sell">{{config('settings.currencySymbol')}}{{ $item->special_price }}</span> <del class="_peSell">{{config('settings.currencySymbol')}}{{ $item->price }} </del></h4>
          @else
          <h4><span class="_sell">{{config('settings.currencySymbol')}}{{ $item->price }}</span></h4>
          @endif
        </div>
        <div class="btnBuyNow">
          <p class="m-0" href="#">Buy Now</p>
        </div>
      </div>
    </figcaption>
  </a>

  <!-- <div class="_button-set">
    <a class="addto-wishlist" wire:click="addToWishlist({{$item->id}})" href="javascript:void(0);" rel="" tabindex="0" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

    <a class="quickShop" wire:click="addToCart({{$item->id}})" href="javascript:void(0);" rel="nofollow" tabindex="0" title="Quick Shop"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>

    <a href="" type="button" rel="nofollow" class="quick-view" tabindex="0" title="Quick View" data-toggle="modal" data-target="#productMpdalLong"></a>
    <a href="javascript:void(0);" class="quick-view" wire:click="quickView({{$item->id}})"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
  </div> -->

  <div class="_button-set">
    <a class="addto-wishlist" data-id="{{$item->id}}" href="javascript:void(0);" rel="" tabindex="0" title="Add to Wishlist"><i class="bi bi-heart"></i></a>

    <a class="quickShop" data-id="{{$item->id}}" href="javascript:void(0);" rel="nofollow" tabindex="0" title="Quick Shop">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
      </svg>
    </a>   
     
    <a href="javascript:void(0);" class="quick-view" wire:click="quickView({{$item->id}})"><i class="fa fa-search-plus" aria-hidden="true"></i></a>   
  </div>
</figure>

