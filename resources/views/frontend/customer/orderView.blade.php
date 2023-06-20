@extends('frontend.layouts.master')
@section('title','Customer Dashboard')
@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<link rel="stylesheet" href="{{asset('assets/front/css/inner_product.css')}}?v={{ time() }}" media="all">
@endsection
@section('content')
<section class="_inner_page_banner" {{--style="background-image: url()"--}}>
  <div class="container">
      <div class="_in_title_text">
          <h1>{{ auth('customer')->user()->first_name }} {{ auth('customer')->user()->last_name }}</h1>
      </div>
  </div>
</section>

<section class="_sub_nav">
  <div class="container">
      <div class="_nav_product_view">
          <nav>
              <ul>
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li><a href="#">My Order</a></li>
              </ul>
          </nav>
      </div>
  </div>
</section>

<!--    Our Product -->
<section class="_store_by_team">
  <div class="container-fluid">
      <div class="row justify-content-center">
          <div class="col-md-3 col-lg-3">
                @include('frontend.customer.menu')
          </div>

          <div class="col-md-8 col-lg-8">
            @if ($order)

            <div class="stepwizard mb-3">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step col-sm-3">
                        <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                        <p><small>Order Complite</small></p>
                    </div>
                    <div class="stepwizard-step col-sm-3">
                        <a href="#step-2" type="button" class="btn btn-circle @if ( $order->payment_status == 1) btn-success @else btn-outline-info disabled @endif " >2</a>
                        <p><small>Paymrnt</small></p>
                    </div>
                    <div class="stepwizard-step col-sm-3">
                        <a href="#step-3" type="button" class="btn btn-circle @if ( $order->shipping_status == 1) btn-success @else btn-outline-info disabled @endif ">3</a>
                        <p><small>Shipping</small></p>
                    </div>
                    <div class="stepwizard-step col-sm-3">
                        <a href="#step-4" type="button" class="btn btn-circle @if ( $order->status == 'Completed') btn-success @else btn-outline-info disabled @endif ">4</a>
                        <p><small>Delevered</small></p>
                    </div>
                </div>
            </div>

            <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>{{ config('app.name') }}</strong><br>
                {{ config('settings.appAddress') }}<br>
                Phone: {{ config('settings.appPhone') }}<br>
                Email: {{ config('settings.appEmail') }}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong>{{$order->shippingAddress->first_name}} {{$order->shippingAddress->last_name}}</strong><br>
                {{$order->shippingAddress->address1}} 
                @if ($order->shippingAddress->address1 != '')
                  {{$order->shippingAddress->address2}}
                @endif <br>
                {{$order->shippingAddress->city}}, {{$order->shippingAddress->state}} {{$order->shippingAddress->postcode}}<br>
                Phone: {{$order->shippingAddress->phone}}<br>
                Email: {{$order->shippingAddress->email}}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Order ID:</b> {{$order->id}}<br>
              <b>Invoice #{{sprintf("%07d", $order->id)}}</b><br>
              <b>Ordered Date:</b> {{ CustomHelper::prettyDate($order->created_at) }}<br>
              {{-- <b>Account:</b> 968-34567 --}}
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

            <table id="orders" class="table table-striped">
              <thead>
                  <tr>
                      <th>SL</th>
                      <th colspan="2">Product name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th class="text-end">Subtotal</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($order->orderItems as $key=>$item)
                  <tr>
                    <td>{{++$key}}</td>
                    <td><img width="50" src="{{$item->image}}" alt=""></td>
                    <td>{{$item->name}}</td>
                    <td>{{config('settings.currencySymbol')}}{{$item->price}}</td>
                    <td>{{$item->qty_ordered}}</td>
                    <td class="text-end">{{config('settings.currencySymbol')}}{{$item->total}}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        <div class="row d-flex justify-content-end">
          <div class="col-6">
            @if (config('settings.refund')=='on')                
            <a href="{{ route('customer.order.refund',$order->id) }}" class="btn btn-danger">Refund</a>
            @endif
          </div>
          <div class="col-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td class="text-end">{{config('settings.currencySymbol')}}{{$order->sub_total}}</td>
                </tr>
                <tr>
                  <th>Tax</th>
                  <td class="text-end">{{config('settings.currencySymbol')}}{{$order->tax_amount}}</td>
                </tr>
                <tr>
                  <th>Shipping:</th>
                  <td class="text-end">{{config('settings.currencySymbol')}}{{$order->shipping_amount}}</td>
                </tr>
                <tr>
                  <th>Discount:</th>
                  <td class="text-end">{{config('settings.currencySymbol')}}{{$order->discount_amount}}</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td class="text-end">{{config('settings.currencySymbol')}}{{$order->grand_total}}</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
          @else
          <p>Empty Order</p>
        @endif
          </div>
      </div>
  </div>
</section>
<!--    Our Product -->
@endsection
@section('js')
<script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script>
(function ($) {


    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
})(jQuery)
</script>
@endsection
