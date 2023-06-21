<div>
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
    <!--    Our Product -->
    <section class="_store_by_team">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-3 col-md-2 col-lg-2">


                    <div class="sideSearch">

                        <form>
                            <div class="wrapper">
                                <div class="rangeHeader">
                                    <h2>Price Range</h2>
                                </div>
                                <div class="price-input pb-3 d-flex justify-content-between">
                                    <div class="field w-50 text-start">
                                        <input type="number" class="input-min" value="{{$priceMin}}">
                                    </div>
                                    <div class="field w-50 text-end">
                                        <input type="number" class="input-max" value="{{$priceMax}}">
                                    </div>
                                </div>
                                <div class="slider">
                                    <div class="progress" style="left:{{$priceMin/$rangeMax*100}}%; right:{{100-($priceMax/$rangeMax*100)}}%"></div>
                                </div>
                                <div class="range-input">
                                    <input wire:model.lazy="priceMin" type="range" class="range-min" min="{{$rangeMin}}" max="{{$rangeMax}}" value="{{$priceMin}}" step="100">
                                    <input wire:model.lazy="priceMax" type="range" class="range-max" min="{{$rangeMin}}" max="{{$rangeMax}}" value="{{$priceMax}}" step="100">
                                </div>
                            </div>

                        </form>

                        <form class="py-2" style="border-top: 1px solid rgb(221, 221, 221);">
                            <div class="rangeHeader">
                                <h2>Category</h2>
                            </div>
                            @foreach ($categories as $item)
                                <div>
                                    <div class="form-check d-flex justify-content-between">
                                        <div>
                                            {{-- <a href="javascript:void(0);" wire:click="removeCat({{$item->id}})"></a> --}}
                                            <input wire:model="cats.{{$item->id}}" type="checkbox" id="{{ $item->slug }}" class="form-check-input" value="{{ $item->id }}"><label title="{{ $item->title }}" for="{{ $item->slug }}" class="form-check-label">{{ $item->title }}</label>
                                        </div>
                                        <div>
                                            <span class="filterNo">{{$item->products_count}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-3">
                                @foreach ($item->child as $cat)
                                    <div class="form-check d-flex justify-content-between">
                                        <div>
                                            {{-- <a href="javascript:void(0);" wire:click="removeCat({{$item->id}})"></a> --}}
                                            <input wire:model="cats.{{$cat->id}}" type="checkbox" id="{{ $cat->slug }}" class="form-check-input" value="{{ $cat->id }}"><label title="{{ $cat->title }}" for="{{ $cat->slug }}" class="form-check-label">{{ $cat->title }}</label>
                                        </div>
                                        <div>
                                            {{-- <span class="filterNo">{{$cat->products_count}}</span> --}}
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            @endforeach
                        </form>

                        <form class="py-2" style="border-top: 1px solid rgb(221, 221, 221);">
                            <div class="rangeHeader">
                                <h2>Size</h2>
                            </div>
                            <div class="designClass">
                            @foreach ($sizes as $item)
                                <div class="form-check d-flex justify-content-between">
                                    <div>                                        
                                        <input wire:model="size.{{$item->name}}" name="size[]" type="checkbox" id="size{{$item->name}}" class="form-check-input" value="{{$item->name}}"><label title="" for="size{{$item->name}}" class="form-check-label">{{$item->name}}</label>
                                    </div>
                                    <div>
                                        {{-- <span class="filterNo">111</span> --}}
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </form>
                        <form class="py-2" style="border-top: 1px solid rgb(221, 221, 221);">
                            <div class="rangeHeader">
                                <h2>Color</h2>
                            </div>
                            @foreach ($colors as $item)
                            <div class="form-check d-flex justify-content-between">
                                <div>
                                    <input wire:model="color.{{$item->name}}" name="color[]" type="checkbox" id="{{$item->name}}" class="form-check-input" value="{{$item->name}}"><label for="{{$item->name}}" class="form-check-label">{{$item->name}}</label>
                                </div>
                                <div>
                                    <span class="filterNo px-3" style="background-color: {{$item->label}}">  </span>
                                </div>
                            </div>
                            @endforeach
                        </form>

                    </div>
        
                </div>

                <div class="col-sm-9 col-md-10 col-lg-10">
                    {{-- @dd($categories) --}}
                    @if ($products)
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5 justify-content-start justify-items-start">
                        <!-- Productd -->

                        @foreach ($products as $item)

                        <div class="col my-3 productCard">
                            <div class="productItem border border-secondary-subtle">
                                <figure class="_inn_overhover m-0 p-2 bg-white">
                                    <a href="{{ route('singleProduct',[$item->id,$item->slug])}}" class="text-decoration-none text-black-50">
                                        <img class="img-fluid img-products" src="{{ CustomHelper::productThumb($item) }}" alt="Product Image">
                                        <figcaption class="_in_plink">
                                            <h2>{{ $item->title }}</h2>
                                            <div class="priceBuy d-flex justify-content-between align-items-center">
                                                <div class="proPrice text-black">
                                                    @include('frontend.layouts.price',['item',$item])
                                                </div>
                                                <div class="btnBuyNow">
                                                    <p class="m-0" href="#">Buy Now</p>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </a>
                                    <div class="_button-set">
                                        <a class="addto-wishlist" wire:click="addToWishlist({{$item->id}})" href="javascript:void(0);" rel="" tabindex="0" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                        <a class="quickShop" wire:click="addToCart({{$item->id}})" href="javascript:void(0);" rel="nofollow" tabindex="0" title="Quick Shop"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                        <!-- <a href="" type="button" rel="nofollow" class="quick-view" tabindex="0" title="Quick View" data-toggle="modal" data-target="#productMpdalLong"></a>-->
                                        <a href="javascript:void(0);" class="quick-view" wire:click="quickView({{$item->id}})"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                        <!-- Button trigger modal -->
                                    </div>
                                </figure>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $products->links() }}
                    @else
                    <p>Product not found</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="quickView" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @if ($quickItem)
                {{-- @dd($quickItem) --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="quickViewLabel">{{$quickItem->title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="_main_view_of_product_image">
                        <figure>
                            <img class="_side_main_img img-fluid" src="{{ asset('storage/' . $quickItem->allphotos->first()->path) }}">
                        </figure>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('singleProduct',[$quickItem->id,$quickItem->slug])}}" class="btn btn-secondary">View</a>
                    <button wire:click="addToCart({{$quickItem->id}})" type="button" class="btn btn-primary">Buy Now</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Rang Js
const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);
    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

// Rang Js
</script>
@endpush