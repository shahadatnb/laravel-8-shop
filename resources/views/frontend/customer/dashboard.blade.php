@extends('frontend.layouts.master')
@section('title','Customer Dashboard')
@section('css')
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
                  <li><a href="#">Dashboard</a></li>
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
              <div class="row">
                  <div class="col-sm-12 col-lg-6">
                      <ol class="list-group">
                          <li class="list-group-item d-flex justify-content-between align-items-start list-group-item-primary">
                              <div class="ms-2 me-auto">
                                  <div class="fw-bold"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                                  Total Ordered
                              </div>
                              <span class="badge bg-primary rounded-pill">{{$total_orders}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-start list-group-item-success">
                              <div class="ms-2 me-auto">
                                  <div class="fw-bold"><i class="fa fa-random" aria-hidden="true"></i></div>
                                  Total Processing
                              </div>
                              <span class="badge bg-primary rounded-pill">{{$total_processing}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-start list-group-item-danger">
                              <div class="ms-2 me-auto">
                                  <div class="fw-bold"><i class="fa fa-home" aria-hidden="true"></i></div>
                                  Total Completed
                              </div>
                              <span class="badge bg-primary rounded-pill">{{$total_completed}}</span>
                          </li>
                      </ol>
                  </div>
                  <div class="col-sm-12 col-lg-6">
                      <!-- PRODUCT LIST -->
                      <div class="card recent-product">
                          <div class="card-header text-dark bg-info">
                              <h3 class="card-title">Recently Added Products</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body p-0">
                              <ul class="products-list product-list-in-card px-2">
                                  @foreach($products as $item)
                                  <li class="item clearfix">
                                      <div class="product-img">
                                          <img src="{{ CustomHelper::productThumb($item) }}" alt="" class="img-size-50">
                                      </div>
                                      <div class="product-info">
                                          <a href="{{ url('/product',$item->id)}}" class="product-title">{{$item->title}}
                                              <span class="badge bg-info float-end">{{config('settings.currencySymbol')}}{{ $item->price }}</span></a>
                                          <span class="product-description">
{{--                        Samsung 32" 1080p 60Hz LED Smart HDTV.--}}
                      </span>
                                      </div>
                                  </li>
                                  <!-- /.item -->
                                  @endforeach
                              </ul>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer text-center">
                              <a href="{{ route('store')  }}" class="uppercase">View All Products</a>
                          </div>
                          <!-- /.card-footer -->
                      </div>
                      <!-- /.card -->
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<!--    Our Product -->
@endsection
