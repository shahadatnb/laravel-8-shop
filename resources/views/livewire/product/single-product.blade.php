<div>
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
    <form class="add-to-cart-form" wire:submit.prevent="addToCart" >
    {{-- <form class="add-to-cart-form" action="{{url('add-to-cart')}}" method="POST" > --}}
        {{ csrf_field() }}
        <div class="_details_pro_informations">
            <h2>{{$product->title}} {{ $attribute_size }} {{ $attribute_color_label }} </h2>
            <span>{{ $stock }} | SKU: {{$sku}}</span>
            @if ($special_price > 0)
                <h3>Price: <span class="_doller">{{config('settings.currencySymbol')}}{{$special_price}}</span> <del class="_peSell">{{config('settings.currencySymbol')}}{{ $price }} </del></h3>
            @else
                <h3>Price: <span class="_doller">{{config('settings.currencySymbol')}}{{$price}}</span></h3>
            @endif
        </div>
        @if (count($sizes) > 0)
        <div class="_info_siz">
            <div class="_swatches_wrapper" data-type="text">
                <label class="attribute-name">Size</label>
                <div class="_size_attribute_values">
                    <ul class="_text-swatch">
                        @foreach ($sizes as $size)
                        <li data-slug="s" class="_attribute-swatch">
                            <label>
                                <input class="product-filter-item" wire:model="attribute_size" type="radio" name="attribute_size" value="{{$size}}">
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
        <div class="_product_color" data-type="visual">
            <label class="attribute-name">Color</label>
            <div class="attribute-values">
                <ul class="_color_swatch">
                    @foreach ($colors as $color)
                    <li data-slug="green" class="attribute-swatch-item" title="Green">
                        <div class="custom-radio">
                            <label>
                                <input class="product-filter-item" type="radio" wire:model="attribute_color" name="attribute_color" value="{{$color}}">
{{--                                <span class="mr-2">{{$color}}</span>--}}
                                 <span style="background-color: {{$color}};"></span>
                            </label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif


        <div class="_wish_list">
            <div class="_add_wish">
                <figure>
                    <a class="js-add-to-wishlist-button" href="javascript:void(0);" wire:click="addToWishlist({{$product->id}})"><i class="fa fa-heart-o" aria-hidden="true"></i> <span>Add to wishlist</span></a>
                </figure>
            </div>
            {{--
            <div class="_delivey_wish">
                <figure>
                    <a class="js-add-to-Delivery-button" href="" title="Delivery &amp; Feture"><img src="img/add.png" alt=""> <span>Delivery &amp; Feture</span></a>
                </figure>
            </div>

            <div class="_delivey_wish">
                <figure>
                    <a class="js-add-to-compare-button" href="" title="Compare"><img src="img/add.png" alt=""> <span>Compare</span></a>
                </figure>
            </div>
            --}}
        </div>
        <div class="_add_cart">
            <div class="form-group--number product__qty">
                <button wire:click="quantityminus" class="down" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                <input class="qty-input" type="text" wire:model="productquantity" name="productquantity" readonly="">
                <button  wire:click="quantityplus" class="up" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>

            </div>
            <div class="_product_catr">
                <button class="ps-btn ps-btn--black" @if ($product_type == 'variant' ) disabled @endif type="submit">Add to cart</button>

            </div>

        </div>
        <div class="_buyit">
            <button class="ps-btn" type="submit" @if ($product_type == 'variant' ) disabled @endif name="checkout">Buy it now</button>
            <p>spant $100.00 more far free shipping</p>
            {{-- <h6>Cstmated delivery between monday 23 march and friday 26 March</h6> --}}
        </div>
    </form>
</div>

<script>
    $('.product-filter-item').on('click', function (e) {
        Livewire.emit('productFilter')
    });
</script>
