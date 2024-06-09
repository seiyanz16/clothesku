@section('title', 'Orders')
@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6 text-right">
                    {{-- <a href="{{ route('orders.create') }}" class="btn btn-primary">New order</a> --}}
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card pt-3">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="" class="btn btn-info export-pdf">Export PDF</a>
                        </div>
                        <div class="card-tools d-flex">
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword"
                                    class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='{{ route('orders.index') }}'"
                                class="btn btn-default btn-sm ml-3">Reset</button>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">Orders No</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Payment Method</th>
                                <th>Product x Qty</th>
                                <th width="100">Status</th>
                                <th>Total</th>
                                <th>Date Ordered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isNotEmpty())
                                @foreach ($orders as $order)
                                    <tr>
                                        <td><a href="{{ route('orders.detail', $order->id) }}">{{ $order->order_no }}</a>
                                        </td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->mobile }}</td>
                                        <td>{{ $order->payment_method == 'transfer' ? 'KuPay Transfer' : 'COD' }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($order->items as $item)
                                                    <li>{{ $item->name . ' (' . $item->size . ', ' . $item->color . ') ' }}
                                                        x
                                                        {{ $item->qty }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($order->status == 'shipped')
                                                <span class="badge bg-info">Shipped</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @else
                                                <span class="badge bg-danger">Canceled</span>
                                            @endif

                                        </td>
                                        <td>${{ number_format($order->grand_total, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">Records Not Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

    <script>
        document.querySelector('.export-pdf').addEventListener('click', function(event) {
            event.preventDefault();

            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF('landscape');

            doc.text("Orders", 14, 22);

            doc.autoTable({
                startY: 30,
                head: [
                    ['Orders No', 'Customer', 'Email', 'Phone', 'Payment Method', 'Product x Qty',
                        'Status', 'Total', 'Date Ordered'
                    ]
                ],
                body: [
                    @foreach ($orders as $order)
                        [
                            "{{ $order->order_no }}",
                            "{{ $order->name }}",
                            "{{ $order->email }}",
                            "{{ $order->mobile }}",
                            "{{ $order->payment_method == 'transfer' ? 'KuPay Transfer' : 'COD' }}",
                            "{!! implode(
                                '<br>',
                                $order->items->map(fn($item) => $item->name . ' (' . $item->size . ', ' . $item->color . ') x ' . $item->qty)->toArray(),
                            ) !!}",
                            @if ($order->status == 'pending')
                                "Pending"
                            @elseif ($order->status == 'shipped')
                                "Shipped"
                            @elseif ($order->status == 'delivered')
                                "Delivered"
                            @else
                                "Canceled"
                            @endif ,
                            "${{ number_format($order->grand_total, 2) }}",
                            "{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}"
                        ],
                    @endforeach
                ],
                styles: {
                    overflow: 'linebreak'
                }
            });

            doc.save('orders.pdf');
        });
    </script>
@endpush
