<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title') {{ config('app.name') }}</title>
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />

    <meta property="og:locale" content="en_AU" />
    <meta property="og:type" content="website" />
    <meta property="fb:admins" content="" />
    <meta property="fb:app_id" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:image:alt" content="" />

    <meta name="twitter:title" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:image:alt" content="" />
    <meta name="twitter:card" content="summary_large_image" />


    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/ion.rangeSlider.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/plugins/fontawesome-free/css/all.min.css') }}" />

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
        rel="stylesheet">

    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('logo.png')}}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body data-instant-intensity="mousedown">

    <header class="bg-white my-3">
        <div class="container">
            <nav class="navbar navbar-expand-xl gap-5" id="navbar">
                <a href="{{ route('front.home') }}" class="text-decoration-none">
                    <span class="h4 text-uppercase fw-bold text-dark" style="letter-spacing: 2px;">Clothes<span
                            class="text-danger">.Ku</span></span>
                    {{-- <img src="{{ asset('front/images/logo.png') }}" alt="logo" style="max-width: 150px;"> --}}
                </a>
                <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="navbar-toggler-icon fas fa-bars text-dark"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if (getCategories()->isNotEmpty())
                            @foreach (getCategories() as $category)
                                <li class="nav-item dropdown">
                                    <button class="btn btn-dark dropdown-toggle text-dark" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $category->name }}
                                    </button>
                                    @if ($category->sub_category->isNotEmpty())
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            @foreach ($category->sub_category as $subcategory)
                                                <li><a class="dropdown-item nav-link"
                                                        href="{{ route('front.shop', [$category->slug, $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="navbar-right py-0 d-flex gap-3 align-items-center">
                    <form action="{{ route('front.shop') }}" method="get">
                        <div class="input-group rounded">
                            <input value="{{ Request::get('search') }}" type="text"
                                placeholder="Search For Products" class="form-control rounded" name="search"
                                id="search" aria-describedby="search-addon" />
                            <button type="submit" class="input-group-text input-group-text border-0"
                                id="search-addon">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('account.wishlist') }}" class="ml-3 d-flex">
                        <i class="far fa-heart text-dark"></i>
                    </a>
                    <a href="{{ route('front.cart') }}" class="ml-3 d-flex">
                        <i class="fas fa-shopping-cart text-dark"></i>
                    </a>
                    <div class="dropdown ml-3">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user text-dark"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                            @if (Auth::check())
                                <li><a class="dropdown-item" href="{{ route('account.profile') }}">My Account</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('account.logout') }}">Logout</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('account.login') }}">Login/Register</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-5">
        <div class="container pb-5 pt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>Get In Touch</h3>
                        <p>Jl. Karadenan No. 7 <br>
                            021-1234 Kab. Bogor, <br>
                            Jawa Barat, Indonesia, 16211 <br>
                            info@clothes.ku <br>
                            +62 123-567-986</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>Important Links</h3>
                        <ul>
                            @if (staticPage()->isNotEmpty())
                                @foreach (staticPage() as $page)
                                    <li><a href="{{ route('front.page', $page->slug) }}"
                                            title="{{ $page->name }}">{{ $page->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>My Account</h3>
                        @if (Auth::check())
                            <ul>
                                <li><a href="{{ route('account.orders') }}" title="Contact Us">My Orders</a></li>
                                <li><a href="{{ route('account.logout') }}" title="Contact Us">Logout</a></li>
                            </ul>
                        @else
                            <ul>
                                <li><a href="{{ route('account.login') }}" title="Sell">Login</a></li>
                                <li><a href="{{ route('account.register') }}" title="Advertise">Register</a></li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="copy-right text-center">
                            <p>© Copyright 2024 Zaskia. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- wishlist Modal -->
    <div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Success</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('front/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('front/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('front/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('front/js/slick.min.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    <script src="{{ asset('front/js/ion.rangeSlider.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }

        function addWishtlist(id) {
            $.ajax({
                url: '{{ route('front.addWishlist') }}',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $('#wishlistModal .modal-body').html(response.message);
                        $('#wishlistModal').modal('show');
                    } else {
                        window.location.href = "{{ route('account.login') }}"
                        // alert(response.message);
                    }
                }
            })
        }
    </script>
    @stack('scripts')
</body>

</html>
