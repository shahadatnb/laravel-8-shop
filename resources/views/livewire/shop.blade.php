<div>
    <div wire:loading>
        @include('admin/layouts/_loading')
    </div>
    <!--    Our Product -->
    <section class="_store_by_team">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-3 col-md-2 col-lg-2">


                    <div class="sideSearch">

                        <form class="py-2" style="border-top: 1px solid rgb(221, 221, 221);">
                            <p style="border-bottom: 1px solid rgb(138, 138, 138); width: fit-content;">Price</p>
                            <div class="d-flex align-items-center"><input placeholder="min" type="number" class="form-control"><input placeholder="max" type="number" class="form-control"></div>
                        </form>
                        <form class="py-2" style="border-top: 1px solid rgb(221, 221, 221);">
                            <p style="border-bottom: 1px solid rgb(138, 138, 138); width: fit-content;">Category</p>
                            <div class="form-check"><input name="Plus size" type="checkbox" id="default-checkbox" class="form-check-input" value="Plus size"><label title="" for="default-checkbox" class="form-check-label">Plus size</label></div>

                        </form>
                        <form class="py-2" style="border-top: 1px solid rgb(221, 221, 221);">
                            <p style="border-bottom: 1px solid rgb(138, 138, 138); width: fit-content;">Size</p>
                            <div class="designClass d-flex gap-2">
                                <div class="form-check">
                                    <input name="S" type="checkbox" id="default-checkbox" class="form-check-input" value="S"><label title="" for="default-checkbox" class="form-check-label">S</label>
                                </div>
                                <div class="form-check">
                                    <input name="S" type="checkbox" id="default-checkbox" class="form-check-input" value="S"><label title="" for="default-checkbox" class="form-check-label">S</label>
                                </div>
                            </div>
                        </form>
                        <form class="py-2" style="border-top: 1px solid rgb(221, 221, 221);">
                            <p style="border-bottom: 1px solid rgb(138, 138, 138); width: fit-content;">Color family</p>
                            <div class="form-check"><input name="Black" type="checkbox" id="default-checkbox" class="form-check-input" value="Black"><label title="" for="default-checkbox" class="form-check-label">Black</label></div>
                        </form>

                    </div>

                    <!-- <div class="side_navbar_stor">

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
                    </div> -->
                </div>

                <div class="col-sm-9 col-md-10 col-lg-10">
                    
                    @if ($products)
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-start justify-items-start">
                        <!-- Productd -->

                        @foreach ($products as $item)

                        <div class="col my-3 productCard" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000">
                            <figure class="_inn_overhover m-0 border-1 p-2 bg-white">
                                <a href="{{ route('singleProduct',$item->id)}}">
                                    <img class="img-fluid img-products" src="{{ CustomHelper::productThumb($item) }}" alt="Product Image">
                                    <figcaption class="_in_plink">
                                        <h2>{{ $item->title }}</h2>
                                        <div class="priceBuy d-flex justify-content-between align-items-center">
                                            <div class="proPrice text-black">
                                                @include('frontend.layouts.price',['item',$item])
                                            </div>
                                            <div class="btnBuyNow">
                                                <p class="m-0" href="#">Buy Now</p>
                                            </div>
                                        </div>
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
        <div class="modal-dialog modal-lg">
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