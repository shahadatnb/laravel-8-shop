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
          <h1>{{ auth::user()->first_name }} {{ auth::user()->last_name }}</h1>
      </div>
  </div>
</section>

<section class="_sub_nav">
  <div class="container">
      <div class="_nav_product_view">
          <nav>
              <ul>
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li><a href="#">Order Refund</a></li>
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
            <table id="orders" class="table table-striped">
              <thead>
                  <tr>
                      <th>SL</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th class="text-end">Subtotal</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($order->orderItems as $key=>$item)
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>
                      @if ($item->qty_refunded > 0)
                          Refunded
                      @else
                          {!! Form::open(['route'=>['customer.order.item.refund',$item->id],'method'=>'POST']) !!}
                          <div class="input-group">
                          {!! Form::number('qty_refunded',$item->qty_ordered,['class'=>'form-control input-sm','required'=>'','min'=>'1','max'=>$item->qty_ordered]) !!}
                          {!! Form::submit('Refund', ['class'=>'btn btn-danger']) !!}
                          </div>
                          {!! Form::close() !!}
                      @endif

                    </td>
                    <td class="text-end">{{$item->total}}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        <div class="row d-flex justify-content-end">
          <div class="col-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td class="text-end">{{$order->sub_total}}</td>
                </tr>
                <tr>
                  <th>Tax</th>
                  <td class="text-end">{{$order->tax_amount}}</td>
                </tr>
                <tr>
                  <th>Shipping:</th>
                  <td class="text-end">{{$order->shipping_amount}}</td>
                </tr>
                <tr>
                  <th>Discount:</th>
                  <td class="text-end">{{$order->discount_amount}}</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td class="text-end">{{$order->grand_total}}</td>
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
