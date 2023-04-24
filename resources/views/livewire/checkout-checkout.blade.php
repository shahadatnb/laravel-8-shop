<div>
    <section id="bardowncheckout" class="bardowncheckout">
        {!! Form::model($user,['route'=>['placeOrder'], 'method'=>'POST']) !!}
            {{-- <input type="hidden" name="cart_id" value="{{$cart->id}}"> --}}
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="chkborright">

                        <div class="checkprocess">
                            <h2>Company Logo</h2>
                            <div class="ckcrtshipay">
                                <a href="#">Cart</a> <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                <a href="#">Information</a> <span><i class="fa fa-angle-right" aria-hidden="true"></i>
                                </span><a href="#">Shipping</a> <span><i class="fa fa-angle-right"
                                        aria-hidden="true"></i></span> <a href="#">Payment</a>
                            </div>
                            <div class="expresscheckout">
                                <h3>Express checkout</h3>
                                <a href="#">shop Pay</a>
                                <a href="#">Paypal</a>
                                <a href="#">G Pay</a>
                            </div>
                        </div>

                        <div class="ShippingaddressCheck">
                            <h6>Shipping Address</h6>
                            <div class="row g-4">
                                <div class="col-6">
                                    {{ Form::text('first_name',null,array('class'=>'form-control','required'=>'','placeholder'=>'First name')) }}
                                </div>
                                <div class="col-6">
                                    {{ Form::text('last_name',null,array('class'=>'form-control','required'=>'','placeholder'=>'Last name')) }}
                                </div>
                                <div class="col-6">
                                    {{ Form::email('email',null,array('class'=>'form-control','required'=>'','placeholder'=>'Email')) }}
                                </div>
                                <div class="col-6">
                                    {{ Form::text('phone',null,array('class'=>'form-control','required'=>'','placeholder'=>'Phone')) }}
                                </div>
                                <div class="col-12">
                                    {{ Form::text('address1',null,array('class'=>'form-control','required'=>'','placeholder'=>'Address')) }}
                                </div>
                                <div class="col-12">
                                    {{ Form::text('address2',null,array('class'=>'form-control','required'=>'','placeholder'=>'Apartment, suite, etc. (optional)')) }}
                                </div>
                                <div class="col-6">
                                    {{ Form::text('city',null,array('class'=>'form-control','required'=>'','placeholder'=>'City')) }}
                                </div>
                                <div class="col-6">
                                    {{ Form::text('postcode',null,array('class'=>'form-control','required'=>'','placeholder'=>'Postal Code')) }}
                                </div>

                                <!-- </div>
                        <div class="row g-4"> -->

                                <div class="col-md" wire:ignore>
                                    {{ Form::select('country',$countries,null,array('class'=>'form-control select2','id'=>'country','data-url'=>route('stateApi'),'placeholder'=>'Select Country')) }}
                                </div>

                                <div class="col-md" wire:ignore>
                                    {{ Form::select('state',$states,null,array('class'=>'form-control select2','id'=>'state','placeholder'=>'Select State')) }}
                                </div>
                            </div>
                        </div>

                        <div class="continueto-shipping">
                            {{-- <button class="continuetoshippingbtn"><a href="#">Continueto Shipping</a></button> --}}
                            <a class="btn btn-secondary" href="{{ route('cart')}}">Return to cart</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="chkborleft">
                        <div class="porv-scoral">

                            <table class="proaligny">

                                <tbody>
                                    @foreach ($cartItems as $item)
                                    <tr class="protrtab">
                                        <td>
                                            <div class="procartimg">
                                                <div class="procartimgdsd">
                                                    <img src="{{ CustomHelper::productThumbById($item['id']) }}" alt="{{$item['name']}}">
                                                </div>
                                                <span class="countproscart">{{$item['quantity']}}</span>
                                            </div>
                                        </td>
                                        <td class="product__description" scope="row">
                                            <div class="cartproname">
                                                <h2>{{$item['name']}}</h2>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cartpriceck">
                                                <p>{{config('settings.currencySymbol')}}{{Cart::getTotal()}}</p>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        {{-- <div class="goftcart mb-3">
                            <div class="row">
                                <form class="row g-3">
                                    <div class="col-9">
                                        <input wire:model="coupon_code" type="text" class="form-control" id="coupon_code" placeholder="Coupon">
                                    </div>
                                    <div class="col-3">
                                        <button wire:click="setCoupon()" type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div> --}}

                        <div class="needsubbordar">

                            <table class="proaligny">
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>
                                            <div class="text-right-tba">
                                                <p>{{config('settings.currencySymbol')}}{{Cart::getTotal() }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- @if ($cart->coupon_code != '')
                                        <tr>
                                            <td>{{$cart->coupon_code}}</td>
                                            <td>
                                                <p class="text-right-tbass">{{config('settings.currencySymbol')}}{{$cart->discount }}</p>
                                            </td>
                                        </tr>
                                    @endif --}}
                                    {{-- <tr>
                                        <td>Tax</td>
                                        <td>
                                            <input wire:model="tax_total" value="{{$cart->tax_total }}" name="tax_total" type="hidden">
                                            <p class="text-right-tbass">{{config('settings.currencySymbol')}}{{$cart->tax_total }}</p>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td>Shipping</td>
                                        <td>
                                            <p class="text-right-tbass"></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="totalmhisab">
                            <table class="proaligny">
                                <tbody>
                                    <tr>
                                        <td>
                                            Total
                                        </td>
                                        <td>
                                            <div class="text-right-tbacad">
                                                <p>{{config('settings.currencyCode')}} {{config('settings.currencySymbol')}}{{Cart::getTotal() }}</p>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <br>
                            <button class="btn btn-success" type="submit">Place Order</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    </section><!-- End About Us Section -->
</div>
@push('scripts')
<script>
    //$('#country').change(function(){
    $('body').on('load | change', '#country', function() {
        $.get($(this).data('url'), {
                option: $(this).val()
            },
            function(data) {
                var subcat = $('#state');
                subcat.empty();
                subcat.append("<option value=''>Select State</option>")
                $.each(data, function(index, element) {
                    subcat.append("<option value='"+ element.name +"'>" + element.name + "</option>");
                });
            });
        var country = $(this).val();
        @this.set('country', country);
    });

$('#state').on('change', function(event) {
    var state = $(this).val();
    //console.log(state);
    @this.set('state', state);
    //Livewire.emit('setTax');
});

</script>
@endpush
