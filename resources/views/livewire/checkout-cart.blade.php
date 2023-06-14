<div>
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
    <section id="bardowncart" class="bardowncart">



<div class="container">
	@if ($cartItems != '')
  <div class="row">
    <div class="col-md-10 table-responsive">
      <table class="table align-middle border mb-0 ">
        <thead>
          <tr>
            <th>SKU CODE</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
					{{-- @dd($cartItems) --}}
					@foreach ($cartItems as $item)
          <tr>
            <td style="width: 10%;">
            <img src="{{ $item->attributes->image }}" alt="w-list" class="img-fluid">
            </td>

            <td class="w-50">
                <p><a href="{{ CustomHelper::productLink($item->id)}}">{{ $item->name }}</a></p>
                {{-- <p>
                    <span>Color: <b>Blue berry</b></span> <span>Size: <b>M</b></span>
                </p> --}}
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
            <td>{{config('settings.currencySymbol')}}{{$item->price}}</td>
            <td style="width: 15%;">
              <div class="d-flex justify-content-between border py-1">
                <button wire:click="quantityminus({{$item->id}})" type="button" class="btn">-</button>
                <input readonly type="text" min="0" pattern="[0-9]*"	wire:model = "quantity.{{$item->id}}" class="border w-50" value="{{$item->quantity}}" style="text-align: center;">
                <button wire:click="quantityplus({{$item->id}})" type="button" class="btn">+</button>
              </div>
            </td>
						<td class="text-right">{{config('settings.currencySymbol')}}{{$item->price * $item->quantity}}</td>
            <td style="width: 5%;">
              <div class="actionBtn text-center py-1">
								<a href="javascript:void(0);" wire:click="itemRemove({{$item->id}})"><i class="bi bi-x-circle"></i></a>
              </div>
            </td>
          </tr>
					@endforeach
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
              <td>{{config('settings.currencySymbol')}} {{Cart::getTotal()}}</td>
            </tr>
            {{-- <tr>
              <td>Shipping</td>
              <td>৳ 70</td>
            </tr> --}}
            <tr>
              <td>Total</td>
              <td>{{config('settings.currencySymbol')}}{{Cart::getTotal() }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mb-3">
        <a href="{{route('checkout')}}" class="btn btn-dark">Proceed To Checkout</a>
			</div>
    </div>
  </div>
	@else
		<p>No cart found.</p>
@endif
</div>


    </section>      
</div>