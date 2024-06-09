@section('title', 'Countries Reports')
@extends('admin.layouts.app')
@section('content')
    <?php
    foreach ($getCountry as $key => $val) {
        $dataPoints[$key]['label'] = $getCountry[$key]['country'];
        $dataPoints[$key]['y'] = $getCountry[$key]['count'];
    }
    
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registered Customers Countries Reports</h1>
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
        $(document).ready(function() {
        var chart;

        function renderChart(dataPoints) {
            chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Registered Customers Countries"
                },
                subtitles: [{
                    text: moment().format('YYYY')
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##\" Customers\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: dataPoints
                }]
            });
            chart.render();
        }

        function fetchChartData(startDate, endDate) {
            $.ajax({
                url: '{{ route("countries.fetch-data") }}',
                method: 'GET',
                data: {
                    start: startDate,
                    end: endDate
                },
                success: function(response) {
                    renderChart(response.dataPoints);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $('#daterange-btn').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end) {
            fetchChartData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });

        // Initial fetch for default date range
        fetchChartData(moment().subtract(29, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));
    });
    </script>
@endpush
