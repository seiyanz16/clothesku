@section('title', 'Revenue Reports')
@extends('admin.layouts.app')
@section('content')
    <?php
    $months = [];
    $count = 0;
    while ($count <= 3) {
        $months[] = date('M Y', strtotime('-' . $count . ' month'));
        $count++;
    }
    // echo '<pre>';print_r($months); die;
    $dataPoints = [
        ['y' => $revenueSum[3], 'label' => $months[3]], 
        ['y' => $revenueSum[2], 'label' => $months[2]], 
        ['y' => $revenueSum[1], 'label' => $months[1]], 
        ['y' => $revenueSum[0], 'label' => $months[0]]
    ];
    
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Revenue Reports</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
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

        <!-- Default box -->
        <div class="container-fluid">
            <div class="card overflow-auto">
                <div id="chartContainer" class="m-5" style="height: 370px; width: 90%;"></div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script>
        // window.onload = function() {

        //     var chart = new CanvasJS.Chart("chartContainer", {
        //         animationEnabled: true,
        //         title: {
        //             text: "Company Revenue by Month"
        //         },
        //         axisY: {
        //             title: "Revenue in USD",
        //             valueFormatString: "#0,,.",
        //             suffix: "mn",
        //             prefix: "$"
        //         },
        //         data: [{
        //             type: "spline",
        //             markerSize: 5,
        //             xValueFormatString: "YYYY-MM",
        //             yValueFormatString: "$#,##0.##",
        //             xValueType: "dateTime",
        //             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        //         }]
        //     });

        //     chart.render();

        // }
        $(function() {
            $('#daterange-btn').daterangepicker({
                ranges: {
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,'month').endOf('month')],
                    'Last 3 Months': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')],
                    'Last 6 Months': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')],
                    'Last 12 Months': [moment().subtract(11, 'month').startOf('month'), moment().endOf('month')]
                },
                startDate: moment().subtract(5, 'month').startOf('month'),
                endDate: moment().endOf('month')
            }, function(start, end) {
                $('#reportrange span').html(start.format('MMMM YYYY') + ' - ' + end.format('MMMM YYYY'));
                fetchChartData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            });

            function fetchChartData(startDate, endDate) {
                $.ajax({
                    url: '{{ route('revenue.fetch-data') }}',
                    method: 'GET',
                    data: {
                        start: startDate,
                        end: endDate
                    },
                    success: function(response) {
                        renderChart(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            function renderChart(dataPoints) {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Company Revenue by Month"
                    },
                    axisY: {
                        title: "Revenue in USD",
                        valueFormatString: determineFormatString(dataPoints),
                        prefix: "$"
                    },
                    data: [{
                        type: "spline",
                        markerSize: 5,
                        xValueFormatString: "MMM YYYY",
                        yValueFormatString: "$#,##0.##",
                        dataPoints: dataPoints
                    }]
                });

                chart.render();
            }

             function determineFormatString(dataPoints) {
                let maxY = Math.max(...dataPoints.map(dp => dp.y));
                if (maxY >= 1000000) {
                    return "#0,,.##M";
                } else if (maxY >= 1000) {
                    return "#0,.#K";
                } else {
                    return "#,##0";
                }
            }


            // Initial fetch with default date range
            fetchChartData(moment().subtract(5, 'month').startOf('month').format('YYYY-MM-DD'), moment().endOf('month').format('YYYY-MM-DD'));
        });
    </script>
@endpush
