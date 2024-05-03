@section('title','Account Profile |')
@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a></li>
                    <li class="breadcrumb-item">Profile</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-12">
                    @include('front.account.common.message')
                </div>
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <form action="" name="profileForm" id="profileForm">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input value="{{ $user->name }}" type="text" name="name" id="name"
                                            placeholder="Enter Your Name" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input value="{{ $user->email }}" type="text" name="email" id="email"
                                            placeholder="Enter Your Email" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input value="{{ $user->phone }}" type="tel" name="phone" id="phone"
                                            placeholder="Enter Your Phone" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                        </div>
                        <form action="" name="addressForm" id="addressForm">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">First Name</label>
                                        <input value="{{ !empty($address) ? $address->first_name : '' }}" type="text" name="first_name" id="first_name"
                                            placeholder="Enter Your First Name" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Last Name</label>
                                        <input value="{{ !empty($address) ? $address->last_name : '' }}" type="text" name="last_name" id="last_name"
                                            placeholder="Enter Your Name" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input value="{{ !empty($address) ? $address->email : '' }}" type="text" name="email" id="email"
                                            placeholder="Enter Your Email" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile">Mobile</label>
                                        <input value="{{ !empty($address) ? $address->mobile : '' }}" type="tel" name="mobile" id="mobile"
                                            placeholder="Enter Your Mobile No." class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="country_id">Country</label>
                                        <select name="country_id" id="country_id" class="form-control">
                                            <option value="">Select a Country</option>
                                            @if ($countries->isNotEmpty())
                                                @foreach ($countries as $country)
                                                    <option
                                                        {{ !empty($address) && $address->country_id == $country->id ? 'selected' : '' }}
                                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address">Address</label>
                                        <textarea type="text" name="address" id="address" placeholder="Enter Your Address" class="form-control" cols="30" rows="3">{{ (!empty($address)) ? $address->address : '' }}</textarea>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="apartement">Apartement</label>
                                        <input value="{{ !empty($address) ? $address->apartement : '' }}" type="text" name="apartement" id="apartement"
                                            placeholder="Apartment, suite, unit, etc. (optional)" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city">City</label>
                                        <input value="{{ !empty($address) ? $address->city : '' }}" type="text" name="city" id="city"
                                            placeholder="Enter your city" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state">State</label>
                                        <input value="{{ !empty($address) ? $address->state : '' }}" type="text" name="state" id="state"
                                            placeholder="Enter your state" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="zip">Zip</label>
                                        <input value="{{ !empty($address) ? $address->zip : '' }}" type="text" name="zip" id="zip"
                                            placeholder="Enter your zip" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $('#profileForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route('account.updateProfile') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $('#profileForm #name').removeClass('is-invalid').siblings('p').html('').removeClass(
                            'invalid-feedback');
                        $('#profileForm #email').removeClass('is-invalid').siblings('p').html('').removeClass(
                            'invalid-feedback');
                        $('#profileForm #phone').removeClass('is-invalid').siblings('p').html('').removeClass(
                            'invalid-feedback');

                        window.location.href = '{{ route('account.profile') }}';
                    } else {
                        var errors = response.errors;
                        if (errors.name) {
                            $('#profileForm #name').addClass('is-invalid').siblings('p').html(errors.name).addClass(
                                'invalid-feedback');
                        } else {
                            $('#profileForm #name').removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }

                        if (errors.email) {
                            $('#profileForm #email').addClass('is-invalid').siblings('p').html(errors.email)
                                .addClass('invalid-feedback');
                        } else {
                            $('#profileForm #email').removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }

                        if (errors.phone) {
                            $('#profileForm #phone').addClass('is-invalid').siblings('p').html(errors.phone)
                                .addClass('invalid-feedback');
                        } else {
                            $('#profileForm #phone').removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                    }
                }
            })
        })

        $('#addressForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route('account.updateAddress') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $('#first_name').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                         $('#last_name').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        $('#addressForm #email').removeClass('is-invalid').siblings('p').html('').removeClass(
                            'invalid-feedback');

                        $('#mobile').removeClass('is-invalid').siblings('p').html('').removeClass(
                            'invalid-feedback');
                        
                        $('#country_id').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        
                        $('#address').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');

                        $('#city').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');

                        $('#state').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');

                        $('#zip').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');

                        window.location.href = '{{ route('account.profile') }}';
                    } else {
                        var errors = response.errors;
                        if (errors.first_name) {
                            $('#first_name').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.first_name);
                        } else {
                            $('#first_name').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (errors.last_name) {
                            $('#last_name').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.last_name);
                        } else {
                            $('#last_name').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (errors.email) {
                            $('#addressForm #email').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email);
                        } else {
                            $('#addressForm #email').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (errors.country) {
                            $('#country_id').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.country);
                        } else {
                            $('#country_id').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (errors.address) {
                            $('#address').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.address);
                        } else {
                            $('#address').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (errors.city) {
                            $('#city').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.city);
                        } else {
                            $('#city').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (errors.state) {
                            $('#state').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.state);
                        } else {
                            $('#state').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (errors.zip) {
                            $('#zip').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.zip);
                        } else {
                            $('#zip').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (errors.mobile) {
                            $('#mobile').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.mobile);
                        } else {
                            $('#mobile').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }
                    }
                }
            })
        })
    </script>
@endpush
