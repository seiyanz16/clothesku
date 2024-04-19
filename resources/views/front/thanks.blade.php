@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">Thanks</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-7 pt-3 mb-3">

    <div class="container">
        <div class="col-md-12 text-center  py-5">
            @if (Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! Session::get('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            <h1>Thank You!</h1>
            <p>Your Order No is: <a href="{{route('account.orderDetail', $id)}}"> {{$orderNo}}  </a></p>
        </div>
    </div>
    </section>
@endsection