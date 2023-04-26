<div>
@include('admin.layouts._message_noty')
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
    <li class="nav-item mini-cart d-inline-block">
        <a class="nav-link cart-icon"  href="#">
        {{-- <a class="nav-link" href="{{route('cart')}}">  --}}
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            <span>{{ Cart::getTotalQuantity()}}</span>
        </a>

    </li>
    @if(auth('customer'))
    <li class="nav-item mini-cart d-inline-block">
        <a class="nav-link" href="{{route('customer.wishlist')}}">
            <i class="fa fa-heart-o" aria-hidden="true"></i>
            <span>{{ $wishlist }}</span>
        </a>
    </li>
    @endif
    <div id="cart-sidebar" style="display: none;">
        @if ($cartItems)

            <div class="card">
                <div class="card-header text-dark bg-info d-flex justify-content-between">
                    <span><a href="{{route('cart')}}">Cart</a></span>
                    <span><a href="{{route('checkout')}}">Checkout</a></span>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0 recent-product">
                    <ul class="products-list product-list-in-card px-2">
                        @foreach($cartItems as $item)
                            <li class="item clearfix">
                                <div class="product-img">
                                    <img src="{{ CustomHelper::productThumbById($item['id']) }}" alt="" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="{{ CustomHelper::productLink($item['id'])}}" class="product-title">{{$item['name']}}
                                        <span class="badge bg-info float-end">{{config('settings.currencySymbol')}}{{ $item['price'] }}</span></a>
                                    <span class="product-description"> </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Sub Total: {{config('settings.currencySymbol')}}{{ Cart::getTotal() }}
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            {{--


        <div class="d-flex justify-content-between p-3">
            <span><a href="{{route('cart')}}">Cart</a></span>
            <span><a href="{{route('checkout')}}">Checkout</a></span>
        </div>
        <table class="table">
            @foreach ($cart->cartItems as $item)
            <tr>
            <td>{{$item->name}} </td>
            </tr>
            @endforeach
        </table>
        --}}
        @endif
    </div>


</div>
@push('scripts')
<script>
    (function ($) {
    $(document).ready(function(){
        $('.cart-icon').click( function (){
            //$('#cart-sidebar').toggleClass('d-none');
            $('#cart-sidebar').fadeToggle();
            //$('#cart-sidebar');
        });
    });
    })(jQuery)

</script>
@endpush
