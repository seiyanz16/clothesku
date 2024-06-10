@extends('admin.layouts.app')

@section('title', 'Best Selling Products')

@section('content')
    <?php
    $dataPoints = [];
    foreach ($bestSellingProducts as $product) {
        $dataPoints[] = [
            'label' => $product->name,
            'y' => $product->total_qty,
            'total_price' => $product->total_price,
        ];
    }
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Best Selling Products</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Date and time range -->
        <div class="form-group">
            <div class="input-group">
                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                    <i class="far fa-calendar-alt"></i> Date range picker
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
        </div>

        <!-- Chart container -->
        <div class="container-fluid">
            <div class="card overflow-auto">
                <div id="chartContainer" class="m-5" style="height: 370px; width: 85%;"></div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // window.onload = function() {

        //     var chart = new CanvasJS.Chart("chartContainer", {
        //         animationEnabled: true,
        //         theme: "light2",
        //         title: {
        //             text: "Gold Reserves"
        //         },
        //         axisY: {
        //             title: "Gold Reserves (in pcs)"
        //         },
        //         data: [{
        //             type: "column",
        //             yValueFormatString: "#,##0.## pcs",
        //             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        //         }]
        //     });
        //     chart.render();

        // }
        $(function() {
            // Initialize date range picker
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'));

                    fetchChartData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                }
            );

            function fetchChartData(start, end) {
                $.ajax({
                    url: '{{ route('products.fetch-data') }}',
                    data: {
                        start: start,
                        end: end
                    },
                    success: function(data) {
                        var dataPoints = data.map(function(product) {
                            return {
                                label: product.name + " $" + product.total_price,
                                y: Number(product.total_qty)//INI MASALAH BANGET SEHARIAN CUMA GEGARA NIH STRING ASU ASU, solv: Number()
                            };
                        });
                        renderChart(dataPoints);
                    }
                });
            }

            function renderChart(dataPoints) {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "    light2",
                    title: {
                        text: "Best Selling Products"
                    },
                    axisY: {
                        title: "Quantity Sold"
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0 pcs",
                        dataPoints: dataPoints
                    }]
                });
                chart.render();
            }

            fetchChartData(moment().subtract(29, 'days').format('YYYY-MM-DD'), moment().format(
                'YYYY-MM-DD'));
        });
    </script>
@endpush
