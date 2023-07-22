@extends('frontend.layouts.master')
@section('content')

<section class="products py-4">
    <div class="container-fluid px-sm-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="sectionTitle">Search Result</h4>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-start justify-items-start">
            @foreach ($products as $item)
            <div class="col my-3 productCard" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                <div class="productItem border border-secondary-subtle">
                    @include('frontend.layouts.product-loop')
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection


@section('js')
<script>
    $('.addto-wishlist').click(function() {
        //console.log($(this).data('id'));
        var id = $(this).data('id');
        Livewire.emit('addToWishlist', {
            id: id
        });
    });

    $('.quickShop').click(function() {
        //console.log($(this).data('id'));
        var id = $(this).data('id');
        Livewire.emit('addToCart', {
            id: id,
            qty: 1
        });
    });
</script>
@endsection
