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


    <div class="modal fade" id="quickView" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @if ($quickItem)
                {{-- @dd($quickItem) --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="quickViewLabel">{{$quickItem[0]->title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="_main_view_of_product_image">
                        <figure>
                            <img class="_side_main_img img-fluid" src="{{ asset('storage/' . $quickItem[0]->allphotos->first()->path) }}">
                        </figure>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/product',$quickItem[0]->id)}}" class="btn btn-secondary">View</a>
                    <button wire:click="addToCart({{$quickItem[0]->id}})" type="button" class="btn btn-primary">Buy Now</button>
                </div>
                @endif
            </div>
        </div>
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
