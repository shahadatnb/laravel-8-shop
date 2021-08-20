<div>
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
    <section id="bardowncart" class="bardowncart">
        <div class="container">
            @if ($cart != '')
            <div class="row">
                <div class="col-md-8">
                    <div class="cartborright">
                        <form wire:submit.prevent="save" class="cartpage">
                            <table class="carttablew my-2">
                                <thead class="cart__row cart__header small--hide">
                                    <tr>
                                        <th></th>
                                        <th colspan="2" class="text-left">Product</th>
                                        <th class="small--hide">Price</th>

                                        <th class="text-center">Quantity</th>

                                        <th class="small--hide text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                    <tr class="cart__row">
                                        <td class="delete">
                                            <a href="javascript:void(0);" wire:click="itemRemove({{$item->id}})" title="Remove" class="btn cart__remove">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="cart__image-wrapper cart-flex-item">
                                            <a href="{{ CustomHelper::productLink($item->product_id)}}">
                                                <img width="100" class="cart__image img-thumbnail" src="{{ CustomHelper::productThumbById($item->product_id) }}">
                                            </a>
                                        </td>
                                        <td class="cart__meta small--text-left cart-flex-item">
                                            <div class="list-view-item__title">
                                                <a href="{{ CustomHelper::productLink($item->product_id)}}"> {{$item->name}} </a>
                                            </div>
                                        </td>
                                        <td class="cart__price-wrapper small--hide">
                                            {{config('settings.currencySymbol')}}{{$item->price}}
                                        </td>

                                        <td class="cart__update-wrapper">
                                            <div class="qtyField input-group">
                                                <a wire:click="quantityminus({{$item->id}})" class="input-group-text minus" href="javascript:void(0);">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </a>
                                                <input class="qty cart__qty-input form-control" type="text"
                                                    wire:model = "quantity.{{$item->id}}" value="{{$item->quantity}}" min="0" pattern="[0-9]*">
                                                <a wire:click="quantityplus({{$item->id}})" class="input-group-text plus" href="javascript:void(0);">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a>
                                            </div>
                                        </td>

                                        <td class="text-right-adoio">
                                            <p>{{config('settings.currencySymbol')}}{{$item->total}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row" id="coupon">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="input-group mb-3">
                                        <input wire:model="coupon_code" type="text" class="form-control">
                                        <div class="input-group-apend">
                                        <button wire:click="setCoupon()" type="button" class="btn btn-success">Update coupon</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="sidecart">
                        <div class="cartSummery">
                            <div class="cart-option cart-note">
                                <p class="cart-options-ttl">Special instructions for seller with your order</p>
                                <textarea name="note" id="CartSpecialInstructions" class="cart-note__input"
                                    spellcheck="false"></textarea>
                            </div>


                            <div class="bdr-box">

                                <div class="flex cart-subtotal-row">
                                    <span>Subtotal</span>
                                    <span class="cart__subtotal text-right">{{config('settings.currencySymbol')}}{{$cart->subTotal() }}</span>
                                </div>
                                @if ($cart->coupon_code != '')
                                    <div class="flex cart-coupon-row">
                                        <span>{{$cart->coupon_code}}</span>
                                        <span class="cart__coupon text-right">{{config('settings.currencySymbol')}}{{$cart->discount }}</span>
                                    </div>
                                @endif

                                <div class="flex cart-total-row">
                                    <span>Total</span>
                                    <span class="cart__total text-right">{{config('settings.currencySymbol')}}{{$cart->subTotal()-$cart->discount }}</span>
                                </div>


                                <p id="freeShipMsg" class="freeShipMsg" ><i
                                        class="ad ad-truck-l"></i> Spent <b class="freeShip"></b> more for free shipping
                                </p>
                                <p id="freeShipclaim" class="freeShipMsg freeShipclaim" style="display: block;"><i
                                        class="ad ad-truck-l"></i> You have got <b>FREE SHIPPING</b></p>
                                <p class="cart__shipping">Shipping &amp; taxes calculated at checkout</p>
                                {{-- <p class="cart_tearm">
                                    <input type="checkbox" name="tearm" id="cartTearm" class="checkbox custCheck"
                                        value="tearm" required="">
                                    <label for="cartTearm"><span class="checkbox"></span> I agree with the terms and
                                        conditions</label>
                                </p> --}}
                                <a href="{{route('checkout')}}" class="btn btn-success">Proceed to Checkout</a>
                                {{-- <input type="submit" name="checkout" id="cartCheckout" class="btn checkout"
                                    value="Proceed to Checkout" disabled="disabled"> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @else
                <p>No cart found.</p>
            @endif
        </div>
    </section>
</div>
