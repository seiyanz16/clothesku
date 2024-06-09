@section('title', 'Orders Reports')
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
    $dataPoints = [['y' => $ordersCount[3], 'label' => $months[3]], ['y' => $ordersCount[2], 'label' => $months[2]], ['y' => $ordersCount[1], 'label' => $months[1]], ['y' => $ordersCount[0], 'label' => $months[0]]];
    
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders Reports</h1>
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
        //         exportEnabled: true,
        //         theme: "light1", // "light1", "light2", "dark1", "dark2"
        //         title: {
        //             text: "Orders Count Report"
        //         },
        //         axisY: {
        //             includeZero: true
        //         },
        //         data: [{
        //             type: "column", //change type to bar, line, area, pie, etc
        //             //indexLabel: "{y}", //Shows y value on all Data Points
        //             indexLabelFontColor: "#5A5757",
        //             indexLabelPlacement: "outside",
        //             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        //         }]
        //     });
        //     chart.render();

        // }
        $(function() {
            //Date range as a button
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
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'));
                    fetchChartData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                }
            );

            function fetchChartData(startDate, endDate) {
                $.ajax({
                    url: '{{ route('orders.fetch-data') }}',
                    method: 'GET',
                    data: {
                        start: startDate,
                        end: endDate
                    },
                    success: function(data) {
                        renderChart(data);
                    }
                });
            }

            function renderChart(data) {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "light1",
                    title: {
                        text: "Orders Count Report"
                    },
                    subtitles: [{
                        text: moment().format('YYYY')
                    }],
                    axisY: {
                        includeZero: true
                    },
                    data: [{
                        type: "column",
                        indexLabelFontColor: "#5A5757",
                        indexLabelPlacement: "outside",
                        dataPoints: data
                    }]
                });
                chart.render();
            }

            // Initial fetch with default date range
            fetchChartData(moment().subtract(29, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));
        });
    </script>
@endpush
