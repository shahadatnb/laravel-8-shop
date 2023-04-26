<div>
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
<!--    Our Product -->
<section class="_store_by_team">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-3 col-lg-3">
                <div class="side_navbar_stor">

                    <h6>Shop by Category</h6>

                    <div class="_your_selections">
                            <h5>Your Selections Items</h5>
                            {{-- @dump($this->cats) --}}
                        <ul>
                            @foreach ($fcats as $item)
                                <li><a href="javascript:void(0);" wire:click="removeCat({{$item->id}})">{{ $item->title }}</a></li>
                            @endforeach
                        </ul>
                        </div>
  <div class="side_navbar_css">
                    <div class="accordion" id="accordionExample">

  <!--
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingShop">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShop" aria-expanded="true" aria-controls="collapseShop">
                                     Clothing
                                </button>
                            </h2>
                            <div id="collapseShop" class="accordion-collapse collapse show" aria-labelledby="headingShop" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>



                                    </ul>
                                </div>
                            </div>
                        </div>
  -->

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Shop For
                                </button>
                            </h2>
                        </div>
                        @foreach ($categories as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    {{$item->title}}
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>
                                        @foreach ($item->child as $child)
                                            <li><a href="javascript:void(0);" wire:click="selectCat({{$child->id}})"><input type="radio"> {{$child->title}}</a></li>
                                            {{-- <li><input type="radio" wire:model="cats" name="{{$item->title}}[{{$child->id}}]" value="{{$child->id}}" id="c-{{$child->id}}" type="radio">
                                                <label for="c-{{$child->id}}">{{$child->title}}</label> </li> --}}
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-8">
                {{-- <div class="_search_by_category">
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Men</option>
                                    <option value="1">Women</option>
                                    <option value="2">Child</option>
                                    <option value="3">Old</option>
                                </select>
                            </div>

                            <div class="col-md-4 col-lg-4">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Color</option>
                                    <option class="cred" value="1"></option>
                                    <option class="blu" value="2"></option>
                                    <option class="grn" value="3"></option>
                                </select>
                            </div>

                            <div class="col-md-4 col-lg-4">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Size</option>
                                    <option value="1">Slim</option>
                                    <option value="2">Fat</option>
                                    <option value="3">M</option>
                                    <option value="3">XXL</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

   --}}


                @if ($products)
                <div class="row">
                    <!-- Productd -->

                    @foreach ($products as $item)

                    <div class="col-md-3 col-lg-3">
                        <figure class="_inn_overhover">
                            <a href="{{ route('singleProduct',$item->id)}}">
                                <img class="img-fluid img-products" src="{{ CustomHelper::productThumb($item) }}" alt="Product Image">
                                <figcaption class="_in_plink">
                                    <h3>{{ $item->title }}</h3>
                                    @include('frontend.layouts.price',['item',$item])
                                </figcaption>

                            </a>
                            <div class="_button-set">
                                <a class="addto-wishlist" wire:click="addToWishlist({{$item->id}})" href="javascript:void(0);" rel="" tabindex="0" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                <a class="quickShop" wire:click="addToCart({{$item->id}})" href="javascript:void(0);" rel="nofollow" tabindex="0" title="Quick Shop"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                <!-- <a href="" type="button" rel="nofollow" class="quick-view" tabindex="0" title="Quick View" data-toggle="modal" data-target="#productMpdalLong"></a>-->
                                <a href="javascript:void(0);" class="quick-view" wire:click="quickView({{$item->id}})"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                <!-- Button trigger modal -->
                            </div>
                        </figure>
                    </div>
                    @endforeach
                </div>
                {{ $products->links() }}
                @else
                    <p>Product not found</p>
                @endif
            </div>
        </div>
    </div>
  </section>

  <div class="modal fade" id="quickView" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if ($quickItem)
            {{-- @dd($quickItem) --}}
            <div class="modal-header">
                <h5 class="modal-title" id="quickViewLabel">{{$quickItem->title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="_main_view_of_product_image">
                    <figure>
                        <img class="_side_main_img img-fluid" src="{{ asset('storage/' . $quickItem->allphotos->first()->path) }}">
                    </figure>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('singleProduct',$quickItem->id)}}" class="btn btn-secondary">View</a>
                <button wire:click="addToCart({{$quickItem->id}})" type="button" class="btn btn-primary">Buy Now</button>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
