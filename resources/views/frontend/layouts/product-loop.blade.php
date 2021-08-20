<figure class="_inn_overhover">
    <a href="{{ url('/product',$item->id)}}">
      @if($item->allphotos->first())
        <img class="img-fluid img-products" src="{{ asset('storage/' . $item->allphotos->first()->path) }}" alt="Product Image">
      @endif
        <figcaption class="_in_plink">
            <h3>{{ $item->title }}</h3>
            @if ($item->special_price > 0)
                <h4><span class="_sell">{{config('settings.currencySymbol')}}{{ $item->special_price }}</span> <del class="_peSell">{{config('settings.currencySymbol')}}{{ $item->price }} </del></h4>
              @else
              <h4><span class="_sell">{{config('settings.currencySymbol')}}{{ $item->price }}</span></h4>
            @endif
            
        </figcaption>

    </a>
    <div class="_button-set">
        <a class="addto-wishlist" data-id="{{$item->id}}" href="javascript:void(0);" rel="" tabindex="0" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
        <a class="quickShop" data-id="{{$item->id}}" href="javascript:void(0);" rel="nofollow" tabindex="0" title="Quick Shop"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
        <!--                                    <a href="" type="button" rel="nofollow" class="quick-view" tabindex="0" title="Quick View" data-toggle="modal" data-target="#exampleModalLong"></a>-->
        {{-- <a href="#" class="quick-view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-search-plus" aria-hidden="true"></i></a> --}}
        <!-- Button trigger modal -->
    </div>
</figure>