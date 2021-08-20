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
                  <li><a href="#">Wishlist</a></li>
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
              @if ($wishlist)
                  <table id="orders" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlist->cartItems as $item)
                        <tr>
                            <td><a href="{{route('customer.removeWishlist',$item->id)}}"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>Empty Wishlist</p>
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
