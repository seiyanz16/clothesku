@section('title', 'Orders ' . $order->order_no . ' |')
@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.orders') }}">Orders</a></li>
                    <li class="breadcrumb-item">Order Detail</li>
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
                        @if ($order->status == 'delivered')
                            <div class="alert alert-success mb-2" role="alert">
                                <h4 class="alert-heading"><i class="fas fa-thumbs-up"></i> Order Completed!</h4>
                                <p>Congratulations! Your order has been successfully processed and completed. We hope you
                                    enjoy
                                    your purchase. Thank you for shopping with us!</p>
                                <hr>
                                <p class="mb-0">We would love to hear your feedback. Please consider rating this product.
                                </p>
                            </div>
                        @endif
                        @if ($order->status == 'cancelled')
                            <div class="alert alert-danger mb-2" role="alert">
                                <h4 class="alert-heading">
                                    <i class="fas fa-times-circle"></i> Order Canceled
                                </h4>
                                <p>We're sorry to inform you that your order has been canceled. If you have any questions or
                                    need further assistance, please contact our support team. Thank you for your
                                    understanding.</p>
                                <hr>
                                <p class="mb-0">We hope to serve you better in the future.</p>
                            </div>
                        @endif

                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                        </div>

                        <div class="card-body pb-0">
                            <!-- Info -->
                            <div class="card card-sm">
                                <div class="card-body bg-light mb-3">
                                    <div class="row">
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Order No:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                {{ $order->order_no }}
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Shipped date:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                <time datetime="{{ $order->shipped_date }}">
                                                    @if (!empty($order->shipped_date))
                                                        {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M, Y') }}
                                                    @else
                                                        n/a
                                                    @endif
                                                </time>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Status:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                @if ($order->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($order->status == 'shipped')
                                                    <span class="badge bg-info">Shipped</span>
                                                @elseif($order->status == 'delivered')
                                                    <span class="badge bg-success">Delivered</span>
                                                @else
                                                    <span class="badge bg-danger">Canceled</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Payment Method:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                {{ $order->payment_method == 'transfer' ? 'KuPay Transfer' : 'COD' }}
                                                {{ $order->payment_status == 'not_paid' ? ' (Not Paid)' : '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-3">

                            <!-- Heading -->
                            <h6 class="mb-7 h5 mt-4">Address Detail</h6>

                            <!-- Divider -->
                            <hr class="my-3">

                            <div class="card card-lg mt-3">
                                <address class="card-body">
                                    <strong>{{ $order->first_name . ' ' . $order->last_name }}</strong><br> <br>
                                    Phone: {{ $order->mobile }}<br>
                                    Email: {{ $order->email }} <br>
                                    {{ $order->address }}<br>
                                    <p class="text-uppercase fw-bold">
                                        {{ $order->city }}, {{ $order->state }}, {{ $order->zip }} <br>
                                        {{ $order->countryName }}
                                    </p>
                                    @if ($order->notes)
                                        <strong>Notes:</strong>
                                        <p>
                                            {{ $order->notes }}
                                        </p>
                                    @endif
                                </address>
                            </div>
                        </div>
                        <div class="card-footer p-3">

                            <!-- Heading -->
                            <h6 class="mb-7 h5 mt-4">Order Items ({{ $orderItemsCount }})</h6>

                            <!-- Divider -->
                            <hr class="my-3">

                            <!-- List group -->
                            <ul>
                                @foreach ($orderItems as $item)
                                    <li class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-4 col-md-3 col-xl-2">
                                                <!-- Image -->
                                                @php
                                                    $productImage = getProductImage($item->product_id);
                                                @endphp

                                                @if (!empty($productImage->image))
                                                    <img src="{{ asset('uploads/product/small/' . $productImage->image) }}"
                                                        class="img-fluid">
                                                @else
                                                    <img src="{{ asset('admin/img/default-150x150.png') }}"
                                                        class="img-fluid">
                                                @endif
                                            </div>
                                            <div class="col">
                                                <!-- Title -->
                                                <p class="mb-4 fs-sm fw-bold">
                                                    <a class="text-body"
                                                        href="{{ route('front.product', $item->product->slug) }}">{{ $item->name . ' (' . $item->size . ', ' . $item->color . ') ' }}
                                                        x
                                                        {{ $item->qty }}</a>
                                                    <br>
                                                    <span class="text-muted">${{ number_format($item->total, 2) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card card-lg mb-5 mt-3">
                        <div class="card-body">
                            <!-- Heading -->
                            <h6 class="mt-0 mb-3 h5">Order Total</h6>

                            <!-- List group -->
                            <ul>
                                <li class="list-group-item d-flex">
                                    <span>Subtotal</span>
                                    <span class="ms-auto">${{ number_format($order->subtotal, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Discount
                                        {{ !empty($order->coupon_code) ? '(' . $order->coupon_code . ')' : '' }}</span>
                                    <span class="ms-auto">${{ number_format($order->discount, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Shipping</span>
                                    <span class="ms-auto">${{ number_format($order->shipping, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex fs-lg fw-bold">
                                    <span>Total</span>
                                    <span class="ms-auto">${{ number_format($order->grand_total, 2) }}</span>
                                </li>
                            </ul>

                            <div class="mt-4">
                                @if ($order->status == 'shipped')
                                    <button type="submit" class="btn btn-success btn-full-width mb-2"
                                        data-bs-toggle="modal" data-bs-target="#deliveredModal">Order Received</button>
                                @endif
                                @if ($order->status == 'pending')
                                    <button type="submit" class="btn btn-danger btn-full-width" data-bs-toggle="modal"
                                        data-bs-target="#cancelModal">Cancel Order</button>
                                @endif
                                @if ($order->status == 'delivered')
                                    <a href="{{ route('front.shop') }}" class="btn btn-success btn-full-width mb-2"> <i
                                            class="fas fa-shopping-cart"></i> Buy Again!</a>
                                @endif
                                @if ($order->status == 'cancelled')
                                    <button class="btn btn-danger btn-full-width mb-2" disabled>Order Canceled</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal --}}

    <!-- Delivered Modal -->
    <div class="modal fade" id="deliveredModal" tabindex="-1" aria-labelledby="deliveredModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deliveredModalLabel">Confirm Receivement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you have received this order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-success" id="confirmDelivered">Yes, Delivered</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Confirm Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel this order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-danger" id="confirmCancel">Yes, Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#confirmDelivered').click(function() {
                $.ajax({
                    url: "{{ route('account.orderUpdate', ['orderId' => $order->id, 'status' => 'delivered']) }}",
                    type: 'PUT',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#deliveredModal').modal('hide');

                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Failed to update order status');
                    }
                });
            });

            $('#confirmCancel').click(function() {
                $.ajax({
                    url: "{{ route('account.orderUpdate', ['orderId' => $order->id, 'status' => 'cancelled']) }}",
                    type: 'PUT',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#cancelModal').modal('hide');

                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Failed to update order status');
                    }
                });
            });
        });
    </script>
@endpush
