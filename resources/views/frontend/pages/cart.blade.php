@extends('frontend.layouts.master')
@section('title','Cart')
@section('css')
<link rel="stylesheet" href="{{asset('assets/front/css/inner_product.css?v='.time())}}" media="all">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" />
@endsection
@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>    
@endsection
@section('content')
<section class="_inner_page_banner" {{--style="background-image: url()"--}}>
  <div class="container">
      <div class="_in_title_text">
          <h1>Cart</h1>
      </div>
  </div>
</section>

<section class="_sub_nav">
  <div class="container">
      <div class="_nav_product_view">
          <nav>
              <ul>
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li><a href="#">Cart</a></li>
              </ul>
          </nav>
      </div>
  </div>
</section>
@livewire('checkout-cart')
@endsection