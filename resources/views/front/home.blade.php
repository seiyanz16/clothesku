@extends('front.layouts.app')

@section('content')
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
            data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front/images/carousel-1-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front/images/hero/hero-2.jpg') }}" />
                        <img src="{{ asset('front/images/hero/hero-2.jpg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 mb-3">Trendy Collection</h1>
                            <p class="mx-md-5 px-5">A specialist label creating luxury essentials. Ethically crafted with an
                                unwavering
                                commitment to exceptional quality.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front/images/carousel-2-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front/images/hero/hero-1.jpg') }}" />
                        <img src="{{ asset('front/images/hero/hero-1.jpg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 mb-3">Fashion Always Changing</h1>
                            <p class="mx-md-5 px-5">A specialist label creating luxury essentials. Ethically crafted with an
                                unwavering
                                commitment to exceptional quality.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front/images/carousel-3-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front/images/hero/hero-3.png') }}" />
                        <img src="{{ asset('front/images/hero/hero-3.png') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 mb-3">Shop Online at Flat 20% off.
                            </h1>
                            <p class="mx-md-5 px-5">A specialist label creating luxury essentials. Ethically crafted with an
                                unwavering
                                commitment to exceptional quality</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section-3 mt-5">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>
            <div class="row pb-3">
                @if (getCategories()->isNotEmpty())
                    @foreach (getCategories() as $category)
                        <div class="col-lg-3">
                            <a href="{{ route('front.shop', $category->slug) }}" class="text-decoration-none">
                                <div class="card cat-card">
                                    @if ($category->image != '')
                                        <img src="{{ asset('uploads/category/thumb/' . $category->image) }}"
                                            alt="{{ $category->name }}" class="card-img-top">
                                    @endif
                                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                        <div class="overlay-content text-center text-white">
                                            <h2 class="card-title">{{ $category->name }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="d-flex justify-content-between section-title">
                <h2>Featured Products</h2>
                <a href="{{ route('front.shop') }}" class="h5 link link-secondary">See All Product</a>

            </div>
            <div class="row pb-3">
                @if ($featuredProducts->isNotEmpty())
                    @foreach ($featuredProducts as $product)
                        @php
                            $productImage = $product->product_images->first();
                        @endphp
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <div class="product-img">
                                        @php
                                            $discount =
                                                (($product->compare_price - $product->price) /
                                                    $product->compare_price) *
                                                100;
                                        @endphp
                                        <div class="position-absolute badge bg-danger text-white px-2 m-2">
                                            <small>{{ round($discount, 0) }}% Off</small>
                                        </div>
                                        @if (!empty($productImage->image))
                                            <img src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                                class="card-img-topl">
                                        @else
                                            <img src="{{ asset('admin/img/default-150x150.png') }}" class="card-img-topl">
                                        @endif
                                    </div>
                                    <a href="javascript:void(0);" onclick="addWishtlist({{ $product->id }})"
                                        class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                    <div class="product-action">
                                        @if ($product->track_qty == 'yes')
                                            @if ($product->qty > 0)
                                                <a class="btn btn-dark" href="{{ route('front.product', $product->slug) }}">
                                                    <i class="fa fa-info-circle"></i> More
                                                </a>
                                            @else
                                                <span class="btn btn-dark">
                                                    Out of Stock
                                                </span>
                                            @endif
                                        @else
                                            <a class="btn btn-dark" href="{{ route('front.product', $product->slug) }}">
                                                <i class="fa fa-info-circle"></i> More
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="{{ route('front.product', $product->slug) }}">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{ $product->price }}</strong></span>
                                        @if ($product->compare_price > 0)
                                            <span
                                                class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section-2">
        <div class="container">
            <div class="section-title">
                <h2>Our Service:</h2>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg d-flex justify-content-center align-items-center">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg d-flex justify-content-center align-items-center">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Worldwide Shipping</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg d-flex justify-content-center align-items-center">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg d-flex justify-content-center align-items-center">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
