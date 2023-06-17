<div>
    <div wire:loading>
        {{-- @include('admin/layouts/_loading') --}}
    </div>
    <form class="add-to-cart-form" wire:submit.prevent="addToCart">
        {{-- <form class="add-to-cart-form" action="{{url('add-to-cart')}}" method="POST" > --}}
        {{ csrf_field() }}
        <div class="_details_pro_informations">
            <div class="d-flex gap-5">

                <div class="rwviews">
                    <p><a href="#">Review 0</a></p>
                </div>
                <div class="sold">Sold 0</div>
            </div>
            <h2 class="fw-bolder fs-5 text-capitalize py-3">{{$product->title}} {{ $attribute_size }} {{ $attribute_color_label }} </h2>
            <div class="skucode">SKU: {{$sku}}</div>

            @if ($special_price > 0)
            <h3>Price: <span class="_doller">{{config('settings.currencySymbol')}}{{$special_price}}</span> <del class="_peSell">{{config('settings.currencySymbol')}}{{ $price }} </del></h3>
            @else
            <h3 class="fw-bolder fs-3 py-3">Tk: <span class="_doller">{{config('settings.currencySymbol')}}{{$price}}</span></h3>
            @endif
        </div>
        @if (count($sizes) > 0)
        <div class="_info_siz">
            <div class="_swatches_wrapper d-flex gap-2" data-type="text">
                <div class="attribute-name">Size: </div>
                <div class="_size_attribute_values">
                    <ul class="_text-swatch list-unstyled m-0 p-0 d-flex fw-bold gap-3">
                        @foreach ($sizes as $size)
                        <li data-slug="s" class="_attribute-swatch">
                            <label>
                                <input class="product-filter-item fs-3" wire:model="attribute_size" type="radio" name="attribute_size" value="{{$size}}">
                                <span>{{$size}}</span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        @if (count($colors) > 0)
        <div class="_product_color d-flex gap-2" data-type="visual">
            <label class="attribute-name">Color: </label>
            <div class="attribute-values">
                <ul class="_color_swatch list-unstyled m-0 p-0 d-flex fw-bold gap-3">
                    @foreach ($colors as $key=>$color)
                    <li data-slug="green" class="attribute-swatch-item" title="Green">
                        <div class="custom-radio">
                            <label>
                                <input {{$key==0? 'checked':''}} class="product-filter-item fs-3" type="radio" wire:model="attribute_color" name="attribute_color" value="{{$color}}">
                                {{-- <span class="mr-2 p-3">{{$color}}</span>--}}
                                <span style="background-color: {{$color}};"></span>
                            </label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="_add_cart d-flex py-3">
            <div class="form-group--number product__qty w-50">
                <button wire:click="quantityminus" class="down" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                <input class="qty-input" type="text" wire:model="productquantity" name="productquantity" readonly="">
                <button wire:click="quantityplus" class="up" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>

            </div>
            <div class="inStock w-25">
                <p class="m-0 fs-5 fw-bold">{{ $stock }} in stock</p>
            </div>
        </div>



        <div class="_wish_list d-flex align-items-center justify-content-between pt-4">
            <div class="_product_catr">
                <button class="ps-btn ps-btn--black" @if ($product_type=='variant' ) disabled @endif type="submit">Add to cart</button>

            </div>
            <div class="_buyit">
                <button class="ps-btn" type="submit" @if ($product_type=='variant' ) disabled @endif name="checkout">Buy it now</button>
            </div>

            <div class="_add_wish">
                <button>
                    <a class="js-add-to-wishlist-button" href="javascript:void(0);" wire:click="addToWishlist({{$product->id}})"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    $('.product-filter-item').on('click', function(e) {
        Livewire.emit('productFilter')
    });
</script>