<div>
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
    <section id="bardowncart" class="bardowncart">



    <div class="container">
  <div class="row">
    <div class="col-md-10 table-responsive">
      <table class="table align-middle border mb-0 ">
        <thead>
          <tr>
            <th>SKU CODE</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>

            <td style="width: 10%;">
            <img src="http://localhost/laravel-8-shop/public/storage/product/2023/06/fe6911cb0382373d7abcafa573115ff7.jpg"
                alt="w-list" class="img-fluid">
            </td>

            <td class="w-50">
                <p><a href="#">Adjustable Full supportive and Anti Shaking Sports Bra-Blue</a></p>
                <p>
                    <span>Color: <b>Blue berry</b></span> <span>Size: <b>M</b></span>
                </p>
        </td>
            <td>1290</td>
            <td style="width: 15%;">
              <div class="d-flex justify-content-between border py-1">
                <button type="button" class="btn">-</button>
                <input disabled="" class="border w-50" value="2" style="text-align: center;">
                <button type="button" class="btn">+</button>
              </div>
            </td>
            <td style="width: 5%;">
              <div class="actionBtn text-center py-1">
                <i class="bi bi-x-circle"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-2">
      <div class="table-responsive">
        <table class="table border">
          <thead>
            <tr>
              <th>Cart</th>
              <th>totals</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Subtotal</td>
              <td>৳ 2580</td>
            </tr>
            <tr>
              <td>Shipping</td>
              <td>৳ 70</td>
            </tr>
            <tr>
              <td>Total</td>
              <td>৳ 2650</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mb-3"><button type="button" class="btn btn-dark">Proceed To
          Checkout</button></div>
    </div>
  </div>

</div>






















<!-- Up Ahasan New Code -->

        <div class="container">
            @if ($cartItems != '')
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
                                            <a href="javascript:void(0);" wire:click="itemRemove({{$item['id']}})" title="Remove" class="btn cart__remove">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="cart__image-wrapper cart-flex-item">
                                            <a href="{{ CustomHelper::productLink($item['id'])}}">
                                                <img width="100" class="cart__image img-thumbnail" src="{{ CustomHelper::productThumbById($item['id']) }}">
                                            </a>
                                        </td>
                                        <td class="cart__meta small--text-left cart-flex-item">
                                            <div class="list-view-item__title">
                                                <a href="{{ CustomHelper::productLink($item['id'])}}"> {{$item['name']}} </a>
                                            </div>
                                        </td>
                                        <td class="cart__price-wrapper small--hide">
                                            {{config('settings.currencySymbol')}}{{$item['price']}}
                                        </td>

                                        <td class="cart__update-wrapper">
                                            {{$item['quantity']}}
                                            {{-- <div class="qtyField input-group">
                                                <a wire:click="quantityminus({{$item['id']}})" class="input-group-text minus" href="javascript:void(0);">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </a>
                                                <input class="qty cart__qty-input form-control" type="text"
                                                    wire:model = "quantity.{{$item['id']}}" value="{{$item['quantity']}}" min="0" pattern="[0-9]*">
                                                <a wire:click="quantityplus({{$item['id']}})" class="input-group-text plus" href="javascript:void(0);">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a>
                                            </div> --}}
                                        </td>

                                        <td class="text-right-adoio">
                                            <p>{{config('settings.currencySymbol')}}{{$item['quantity']*$item['price']}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="row" id="coupon">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="input-group mb-3">
                                        <input wire:model="coupon_code" type="text" class="form-control">
                                        <div class="input-group-apend">
                                        <button wire:click="setCoupon()" type="button" class="btn btn-success">Update coupon</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
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
                                    <span class="cart__subtotal text-right">{{config('settings.currencySymbol')}}{{Cart::getTotal()}}</span>
                                </div>
                                {{-- @if ($cart->coupon_code != '')
                                    <div class="flex cart-coupon-row">
                                        <span>{{$cart->coupon_code}}</span>
                                        <span class="cart__coupon text-right">{{config('settings.currencySymbol')}}{{$cart->discount }}</span>
                                    </div>
                                @endif --}}

                                <div class="flex cart-total-row">
                                    <span>Total</span>
                                    <span class="cart__total text-right">{{config('settings.currencySymbol')}}{{Cart::getTotal()-0 }}</span>
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
