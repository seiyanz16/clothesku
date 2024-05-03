@section('title', 'Shop |')
@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.shop') }}" class="breadcrumb-item active">Shop</a>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">

                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $key => $category)
                                        <div class="accordion-item">
                                            @if ($category->sub_category->isNotEmpty())
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne-{{ $key }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapseOne-{{ $key }}">
                                                        {{ $category->name }}
                                                    </button>
                                                </h2>
                                            @else
                                                <a href="{{ route('front.shop', $category->slug) }}"
                                                    class="nav-item nav-link {{ $categorySelected == $category->id ? 'text-primary' : '' }}">{{ $category->name }}</a>
                                            @endif

                                            @if ($category->sub_category->isNotEmpty())
                                                <div id="collapseOne-{{ $key }}"
                                                    class="accordion-collapse collapse {{ $categorySelected == $category->id ? 'show' : '' }}"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="navbar-nav">
                                                            @foreach ($category->sub_category as $sub_category)
                                                                <a href="{{ route('front.shop', [$category->slug, $sub_category->slug]) }}"
                                                                    class="nav-item nav-link {{ $subCategorySelected == $sub_category->id ? 'text-primary' : '' }}">{{ $sub_category->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Brand</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @if ($brands->isNotEmpty())
                                @foreach ($brands as $brand)
                                    <div class="form-check mb-2">
                                        <input {{ in_array($brand->id, $brandsArray) ? 'checked' : '' }}
                                            class="form-check-input brand-label" type="checkbox" name="brand[]"
                                            value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                        <label class="form-check-label" for="brand-{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Price</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="js-range-slider" name="my_range" value="" />
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4 gap-3">
                                <div>
                                    <a href="{{ route('front.shop') }}" class="link link-secondary">See All Product</a>
                                </div>
                                <div class="ml-2">
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                                        <option value="low" {{ $sort == 'low' ? 'selected' : '' }}>Price Low</option>
                                        <option value="high" {{ $sort == 'high' ? 'selected' : '' }}>Price High</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @if ($products->isNotEmpty())
                            @foreach ($products as $product)
                                @php
                                    $productImage = $product->product_images->first();
                                @endphp
                                <div class="col-md-4">
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
                                                        class="card-img-top">
                                                @else
                                                    <img src="{{ asset('admin/img/default-150x150.png') }}"
                                                        class="card-img-top">
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
                        @else
                            <div class="col-md-8">
                                <h1>No Product Found.</h1>
                            </div>
                        @endif

                        <div class="col-md-12 pt-5">
                            {{ $products->withQueryString()->links() }}
                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        rangeSlider = $(".js-range-slider").ionRangeSlider({
            type: 'double',
            min: 0,
            max: 1000,
            from: {{ $priceMin }},
            step: 10,
            to: {{ $priceMax }},
            skin: 'round',
            max_postfix: '+',
            prefix: '$',
            onFinish: function() {
                apply_filters()
            }
        });

        var slider = $('.js-range-slider').data('ionRangeSlider');

        $('.brand-label').change(function() {
            apply_filters();
        });

        $('#sort').change(function() {
            apply_filters();
        })

        function apply_filters() {
            var brands = [];

            $('.brand-label').each(function() {
                if ($(this).is(':checked') == true) {
                    brands.push($(this).val());
                }
            });

            console.log(brands.toString());

            var url = '{{ url()->current() }}?'
            // brand
            if (brands.length > 0) {
                url += '&brand=' + brands.toString();
            }

            // price 

            url += '&price_min=' + slider.result.from + '&price_max=' + slider.result.to;

            // sorting
            var keyword = $('#search').val();

            if (keyword.length > 0) {
                url += '&search=' + keyword;
            }
            url += '&sort=' + $('#sort').val();

            window.location.href = url;
        }
    </script>
@endpush
