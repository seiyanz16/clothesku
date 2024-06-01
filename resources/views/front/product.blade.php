@section('title', $product->title . ' |')
@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">{{ $product->title }}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row">
                @include('front.account.common.message')
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">
                            @if ($product->product_images)
                                @foreach ($product->product_images as $key => $productImage)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="w-100 h-100"
                                            src="{{ asset('uploads/product/large/' . $productImage->image) }}"
                                            alt="{{ $product->title }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-white col-md-7">
                    <div class="py-5 right">
                        @php
                            $discount = (($product->compare_price - $product->price) / $product->compare_price) * 100;
                        @endphp
                        <span class="bg-danger text-white px-2">
                            <small>{{ round($discount, 0) }}% Off</small>
                        </span>
                        <h1 class="mt-2">{{ $product->title }}</h1>
                        {{-- star rating  --}}
                        <div class="d-flex mb-3">
                            <div class="star-rating product mt-2" title="{{ $avgRatingPer }}%">
                                <div class="back-stars">
                                    <small class="fa fa-star" aria-hidden="true"></small>
                                    <small class="fa fa-star" aria-hidden="true"></small>
                                    <small class="fa fa-star" aria-hidden="true"></small>
                                    <small class="fa fa-star" aria-hidden="true"></small>
                                    <small class="fa fa-star" aria-hidden="true"></small>

                                    <div class="front-stars" style="width: {{ $avgRatingPer }}%">
                                        <small class="fa fa-star" aria-hidden="true"></small>
                                        <small class="fa fa-star" aria-hidden="true"></small>
                                        <small class="fa fa-star" aria-hidden="true"></small>
                                        <small class="fa fa-star" aria-hidden="true"></small>
                                        <small class="fa fa-star" aria-hidden="true"></small>
                                    </div>
                                </div>
                            </div>
                            <small class="pt-1 ps-2">({{ $product->product_ratings_count }} Reviews)</small>
                        </div>
                        {{-- star rating end  --}}
                        <div class="d-flex gap-2">
                            @if ($product->compare_price > 0)
                                <h2 class="price text-secondary"><del>${{ $product->compare_price }}</del></h2>
                            @endif
                            <h2 class="price ">${{ $product->price }}</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <p class="text-secondary">SKU: {{ $product->sku }}-{{ $product->barcode }}</p>
                            @if ($product->track_qty == 'yes')
                                <p class="text-secondary">Available Stock: {{ $product->qty }}</p>
                            @else
                                <p></p>
                            @endif
                        </div>
                        {{-- Variant option --}}
                        @php
                            $sizes = explode(',', $product->size);
                            $colors = explode(',', $product->color);
                        @endphp
                        <div class="product__details__option mb-3">
                            <div class="product__details__option__size form-check-inline">
                                <span class="me-3 text-secondary">Size:</span>
                                @foreach ($sizes as $size)
                                    <label class="form-check-label" for="{{ $size }}">{{ $size }}
                                        <input class="form-check-input" type="radio" name="size"
                                            id="{{ $size }}" value="{{ $size }}" />
                                    </label>
                                @endforeach
                            </div>
                            <div class="my-3 product__details__option__color form-check-inline">
                                <span class="me-3 text-secondary">Color:</span>
                                @foreach ($colors as $color)
                                    <label class="form-check-label" for="{{ $color }}">{{ $color }}
                                        <input class="form-check-input" type="radio" name="color"
                                            id="{{ $color }}" value="{{ $color }}" />
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        {{-- variant option end --}}
                        <div class="d-flex gap-3 align-items-center" style="letter-spacing: 1px">
                            @if (Auth::check())
                                @if ($product->track_qty == 'yes')
                                    @if ($product->qty > 0)
                                        <a class="btn btn-dark" href="javascript:void(0);"
                                            onclick="addToCart({{ $product->id }})">
                                            <i class="fa fa-shopping-cart"></i> &nbsp;ADD TO CART
                                        </a>
                                    @else
                                        <a class="btn btn-dark" href="javascript:void(0);">
                                            Out of Stock
                                        </a>
                                    @endif
                                @else
                                    <a class="btn btn-dark" href="javascript:void(0);"
                                        onclick="addToCart({{ $product->id }})">
                                        <i class="fa fa-shopping-cart"></i> &nbsp;ADD TO CART
                                    </a>
                                @endif
                            @else
                                <a class="btn btn-dark" href="{{ route('account.login') }}">
                                    <i class="fa fa-shopping-cart"></i> &nbsp;ADD TO CART
                                </a>
                            @endif
                            <a class="btn link" href="javascript:void(0);" onclick="addWishtlist({{ $product->id }})"
                                class="whishlist" href="222"><i class="fa fa-heart"></i> ADD TO WISHLIST</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab"
                                    aria-controls="description" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab"
                                    data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping"
                                    aria-selected="false">Shipping &
                                    Returns</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                    type="button" role="tab" aria-controls="reviews"
                                    aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p>
                                    {!! $product->description !!}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                <p>
                                    {!! $product->shipping_returns !!}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="col-md-8">
                                    <div class="row">
                                        @if (Auth::check())
                                            <form action="" method="post" name="reviewForm" id="reviewForm">
                                                <h3 class="h4 pb-3">Write a Review</h3>
                                                {{-- <div class="form-group col-md-6 mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Name">
                                                <p></p>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" name="email" id="email"
                                                    placeholder="Email">
                                                <p></p>
                                            </div> --}}
                                                <div class="form-group mb-3">
                                                    <label for="rating">Rating</label>
                                                    <br>
                                                    <div class="rating" style="width: 10rem">
                                                        <input id="rating-5" type="radio" name="rating"
                                                            value="5" /><label for="rating-5"><i
                                                                class="fas fa-3x fa-star"></i></label>
                                                        <input id="rating-4" type="radio" name="rating"
                                                            value="4" /><label for="rating-4"><i
                                                                class="fas fa-3x fa-star"></i></label>
                                                        <input id="rating-3" type="radio" name="rating"
                                                            value="3" /><label for="rating-3"><i
                                                                class="fas fa-3x fa-star"></i></label>
                                                        <input id="rating-2" type="radio" name="rating"
                                                            value="2" /><label for="rating-2"><i
                                                                class="fas fa-3x fa-star"></i></label>
                                                        <input id="rating-1" type="radio" name="rating"
                                                            value="1" /><label for="rating-1"><i
                                                                class="fas fa-3x fa-star"></i></label>
                                                    </div>
                                                    <p class="product-rating-error text-danger"></p>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="review">How was your overall experience?</label>
                                                    <textarea name="comment" id="comment" class="form-control" cols="30" rows="10"
                                                        placeholder="How was your overall experience?"></textarea>
                                                    <p></p>
                                                </div>
                                                <div>
                                                    <button class="btn btn-dark">Submit</button>
                                                </div>
                                            </form>
                                        @else
                                            <h6 class="text-secondary"> <a href="{{ route('account.login') }}">Login</a>
                                                for Write a Review</h6>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <div class="overall-rating mb-3">
                                        <div class="d-flex">
                                            <h1 class="h3 pe-3">{{ $avgRating }}</h1>
                                            <div class="star-rating mt-2" title="{{ $avgRatingPer }}%">
                                                <div class="back-stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>

                                                    <div class="front-stars" style="width: {{ $avgRatingPer }}%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-2 ps-2">({{ $product->product_ratings_count }} Reviews)</div>
                                        </div>

                                    </div>
                                    @if ($product->product_ratings->isNotEmpty())
                                        @foreach ($product->product_ratings as $rating)
                                            @php
                                                $ratingPer = ($rating->rating * 100) / 5;
                                            @endphp
                                            <div class="rating-group mb-4">
                                                <span> <strong>{{ $rating->username }} </strong>
                                                    <small>({{ $rating->email }})</small></span>
                                                <div class="star-rating mt-2" title="{{ $ratingPer }}%">
                                                    <div class="back-stars">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        <div class="front-stars" style="width: {{ $ratingPer }}%">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <p>{{ $rating->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!empty($relatedProducts))
        <section class="pt-5 section-8">
            <div class="container">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
                <div class="col-md-12">
                    <div id="related-products" class="carousel">
                        @foreach ($relatedProducts as $relProduct)
                            @php
                                $productImage = $relProduct->product_images->first();
                            @endphp
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <div class="product-img">
                                        @php
                                            $discount =
                                                (($relProduct->compare_price - $relProduct->price) /
                                                    $relProduct->compare_price) *
                                                100;
                                        @endphp
                                        <span class="position-absolute badge bg-danger text-white px-2 m-2">
                                            <small>{{ round($discount, 0) }}% Off</small>
                                        </span>

                                        @if (!empty($productImage->image))
                                            <img class="card-img-top"
                                                src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('admin/img/default-150x150.png') }}"
                                                class="card-img-topl">
                                        @endif
                                    </div>
                                    <a href="javascript:void(0);" onclick="addWishtlist({{ $relProduct->id }})"
                                        class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                    <div class="product-action">
                                        @if ($relProduct->track_qty == 'yes')
                                            @if ($relProduct->qty > 0)
                                                <a class="btn btn-dark"
                                                    href="{{ route('front.product', $relProduct->slug) }}">
                                                    <i class="fa fa-info-circle"></i> More
                                                </a>
                                            @else
                                                <span class="btn btn-dark">
                                                    Out of Stock
                                                </span>
                                            @endif
                                        @else
                                            <a class="btn btn-dark"
                                                href="{{ route('front.product', $relProduct->slug) }}">
                                                <i class="fa fa-info-circle"></i> More
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link"
                                        href="{{ route('front.product', $relProduct->slug) }}">{{ $relProduct->title }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{ $relProduct->price }}</strong></span>
                                        @if ($relProduct->compare_price > 0)
                                            <span
                                                class="h6 text-underline"><del>${{ $relProduct->compare_price }}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@push('scripts')
    <script>
        function addToCart(id) {
            size = $('input[name="size"]:checked').val();
            color = $('input[name="color"]:checked').val();

            if (!size || !color) {
                alert('Please select size or color.');
                return;
            }
            $.ajax({
                url: '{{ route('front.addToCart') }}',
                type: 'post',
                data: {
                    id: id,
                    size: size,
                    color: color,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('front.cart') }}"
                    } else {
                        alert(response.message);
                    }
                }
            })
        }
        $('#reviewForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route('front.saveRating', $product->id) }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    var errors = response.errors;

                    if (response.status == false) {
                        if (errors.name) {
                            $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors.name);
                        } else {
                            $('#name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors.email) {
                            $('#email').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.email);
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors.comment) {
                            $('#comment').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.comment);
                        } else {
                            $('#comment').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors.rating) {
                            $('.product-rating-error').html(errors.rating);
                        } else {
                            $('.product-rating-error').html('');
                        }
                    } else {
                        window.location.href = '{{ route('front.product', $product->slug) }}'
                    }
                }
            })
        })
        /*-------------------
        		Radio Btn
        	--------------------- */
        $(".product__details__option__size label").on('click',
            function() {
                $(".product__details__option__size label")
                    .removeClass('active');
                $(this).addClass('active');
            });
        $(".product__details__option__color label").on('click',
            function() {
                $(".product__details__option__color label")
                    .removeClass('active');
                $(this).addClass('active');
            });
    </script>
@endpush
