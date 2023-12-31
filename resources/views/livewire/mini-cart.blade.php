<div class="d-flex justify-content-center text-end">
@include('admin.layouts._message_noty')
    
    <div class="pe-1 text-end">
        <div class="wishCartList">
                    <a href="{{route('customer.wishlist')}}" class="text-body-secondary">
                        <i class="bi bi-heart-fill"></i>
                    </a>
        </div>
    </div>

    <div class="ps-1 text-end">
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
        <div class="productCategories">
            <span class="btnOffcanvas" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasHomeCart" aria-controls="offcanvasHomeCart">
                <i class="bi bi-bag-fill"></i><sup>{{$cartItems? count($cartItems):0}}</sup>
            </span>

            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasHomeCart" aria-labelledby="offcanvasHomeCartLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasHomeCartLabel">Your Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="cartTableArea">
                        <div class="gr">
                            <div class="g">
                                <div class="border">
                                    <div class="table-responsive">
                                        <table class="text-start mb-0 table align-middle">
                                            <tbody>
                                                @foreach($cartItems as $item)
                                                <tr class="align-content-center">
                                                    <td style="width: 30%;"><img src="{{ $item->attributes->image }}" alt="w-list" class="w-100">
                                                        <div class="actionBtn text-center py-1">
                                                           <a  href="javascript:void(0);" wire:click="cartItemRemove({{$item->id}})"><i class="bi bi-x-circle"></i></a>
                                                        </div>
                                                    </td>
                                                    <td style="width: 70%;"><a href="{{ CustomHelper::productLink($item->id)}}">{{$item->name}}</a> {{-- <span> Size: <b>M</b></span> <span>Color: <b>Blue</b></span> --}}
                                                        <div class="py-1 d-flex justify-content-between"> <span>{{config('settings.currencySymbol')}}{{ $item->price }} x {{$item->quantity}}</span>  <span>Price: <b>{{config('settings.currencySymbol')}}{{ $item->quantity*$item->price }}</b></span></div>
                                                        {{-- <div class="d-flex justify-content-between border py-1">
                                                            <button type="button" class="btn">-</button>
                                                            
                                                            <input disabled="" class="border w-50" value="2" style="text-align: center;">
                                                            
                                                            <button type="button" class="btn">+</button>
                                                        </div> --}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="cartSideHome">
                                    <div class="border text-center my-2">
                                            <h3 class="m-0 p-1">Totals: {{config('settings.currencySymbol')}} {{ Cart::getTotal() }}</h3>                                                 
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <a href="{{route('checkout')}}" class="btn rounded-0 border">Checkout</a>
                                        <a href="{{route('cart')}}" class="btn rounded-0 border">View Cart</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    (function ($) {
    $(document).ready(function(){
        //$('.cart-icon').click( function (){
        $(".nav-item").on('click', '.cart-icon', function() {
            //$('#cart-sidebar').toggleClass('d-none');
            $('#cart-sidebar').fadeToggle();
            //$('#cart-sidebar');
        });
    });

        $("#cart").on("click", function() {
            $(".shopping-cart").fadeToggle( "fast");
        });

    })(jQuery)

</script>
@endpush
