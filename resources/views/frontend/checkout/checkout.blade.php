@extends('frontend.layouts.master')
@section('title','Checkout')
@section('css')
<link rel="stylesheet" href="{{asset('assets/front/css/inner_product.css?v='.time())}}" media="all">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
    <script>
        $(function () {
            'use strict'
            $(document).ready(function() {
                $('.select2').select2();
                $('.select2-multi').select2();         //{ width: '300px' }
            });


        });
    </script>
@endsection
@section('content')
<section class="_inner_page_banner" {{--style="background-image: url()"--}}>
  <div class="container">
      <div class="_in_title_text">
          <h1>Checkout</h1>
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
@livewire('checkout-checkout',['countries'=>$countries,'states'=>$states,'user'=>$user])
{{-- @livewire('checkout-cart') --}}
@endsection
