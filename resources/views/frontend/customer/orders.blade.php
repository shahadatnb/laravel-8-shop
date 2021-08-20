@extends('frontend.layouts.master')
@section('title','Customer Dashboard')
@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<link rel="stylesheet" href="{{asset('assets/front/css/inner_product.css')}}" media="all">
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
                  <li><a href="#">My Orders</a></li>
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
              <table id="orders" class="table table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Order No</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($orders as $item)
                      <tr>
                          <td><a href="{{ route('customer.order.show',$item->id) }}" class="btn btn-sm btn-circle btn-outline-info"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                          <td>#{{$item->id}}</td>
                          <td><span data-bs-toggle="tooltip" data-placement="top" title="{{ CustomHelper::prettyDateTime($item->created_at) }}">{{ CustomHelper::prettyDateS($item->created_at) }}</span></td>
                          <td>{{ $item->grand_total }}</td>
                          <td>{{ $item->status }}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
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
    $(document).ready(function() {
        $('#orders').DataTable( {
            //"paging":   false,
            "ordering": false,
        } );

    } );

    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
})(jQuery)
</script>
@endsection
