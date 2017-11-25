@extends('backend.master')

@section('content-admin')
<div class="right_col" role="main">

    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Centroid</span>
            <div class="count">{{ $count_centroid }}</div>
            <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-file-text"></i> Total Article</span>
            <div class="count">{{ $count_article }}</div>
            <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-rss"></i> Total Feed</span>
            <div class="count">{{ $count_feed }}</div>
            <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>-->
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-font"></i> Total Word</span>
            <div class="count">{{ $count_word }}</div>
            <!--<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>-->
        </div>

    </div>
    <!-- /top tiles -->

    <!-- statistik berita - start -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>Article Statistics</h3>
                    </div>
                    <div class="col-md-6">
                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                    <div style="width: 100%;">
                        <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                    <div class="x_title">
                        <h2>Top 4 Feed</h2>
                        <div class="clearfix"></div>
                    </div>

                    @foreach($count_article_by_feed as $caf)
                    <div class="col-md-12 col-sm-12 col-xs-6">
                        <div>
                            <p>{{ $caf->title }}</p>
                            <div class="">
                                <div class="progress progress_sm" >
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{ ($caf->count_article / $count_article) * 100  }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <!-- statistik berita - end -->

    <br />

    <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>App Versions</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h4>App Usage across versions</h4>

                    <div class="widget_summary">
                        <div class="w_left w_25">
                            <span>0.1.5.2</span>
                        </div>
                        <div class="w_center w_55">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                    <span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>123k</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                    <h2>Device Usage</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="" style="width:100%">
                        <tr>
                            <th style="width:37%;">
                                <p>Top 5</p>
                            </th>
                            <th>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <p class="">Device</p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <p class="">Progress</p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                            </td>
                            <td>
                                <table class="tile_info">
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square blue"></i>IOS </p>
                                        </td>
                                        <td>30%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square green"></i>Android </p>
                                        </td>
                                        <td>10%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square purple"></i>Blackberry </p>
                                        </td>
                                        <td>20%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square aero"></i>Symbian </p>
                                        </td>
                                        <td>15%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square red"></i>Others </p>
                                        </td>
                                        <td>30%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@stop

@section('footer-library')
<!-- Flot -->
<script>
//    $(document).ready(function () {
//        var data1 = [
//            [gd(2012, 1, 1), 17],
//            [gd(2012, 1, 2), 74],
//            [gd(2012, 1, 3), 6],
//            [gd(2012, 1, 4), 39],
//            [gd(2012, 1, 5), 20],
//            [gd(2012, 1, 6), 85],
//            [gd(2012, 1, 7), 7],
//            [gd(2012, 1, 8), 7],
//            [gd(2012, 1, 9), 7],
//            [gd(2012, 1, 10), 7],
//        ];
//
//        var optionCanvas = {
//            series: {
//                lines: {
//                    show: false,
//                    fill: true
//                },
//                splines: {
//                    show: true,
//                    tension: 0.4,
//                    lineWidth: 1,
//                    fill: 0.4
//                },
//                points: {
//                    radius: 0,
//                    show: true
//                },
//                shadowSize: 2
//            },
//            grid: {
//                verticalLines: true,
//                hoverable: true,
//                clickable: true,
//                tickColor: "#d5d5d5",
//                borderWidth: 1,
//                color: '#fff'
//            },
//            colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
//            xaxis: {
//                tickColor: "rgba(51, 51, 51, 0.06)",
//                mode: "time",
//                tickSize: [1, "day"],
//                //tickLength: 10,
//                axisLabel: "Date",
//                axisLabelUseCanvas: true,
//                axisLabelFontSizePixels: 12,
//                axisLabelFontFamily: 'Verdana, Arial',
//                axisLabelPadding: 10
//            },
//            yaxis: {
//                ticks: 8,
//                tickColor: "rgba(51, 51, 51, 0.06)",
//            },
//            tooltip: true
//        };
//        
//        $.plot($("#canvas_dahs"), [
//            data1
//        ], optionCanvas);
//
//        function gd(year, month, day) {
//            return new Date(year, month - 1, day).getTime();
//        }
//
//    });
</script>
<!-- /Flot -->

<!-- Doughnut Chart -->
<script>
    $(document).ready(function () {
        var options = {
            legend: false,
            responsive: false
        };

        new Chart(document.getElementById("canvas1"), {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
                labels: [
                    "Symbian",
                    "Blackberry",
                    "Other",
                    "Android",
                    "IOS"
                ],
                datasets: [{
                        data: [15, 20, 30, 10, 30],
                        backgroundColor: [
                            "#BDC3C7",
                            "#9B59B6",
                            "#E74C3C",
                            "#26B99A",
                            "#3498DB"
                        ],
                        hoverBackgroundColor: [
                            "#CFD4D8",
                            "#B370CF",
                            "#E95E4F",
                            "#36CAAB",
                            "#49A9EA"
                        ]
                    }]
            },
            options: options
        });
    });
</script>
<!-- /Doughnut Chart -->

<!-- bootstrap-date range picker -->
<script>
    $(document).ready(function () {

        var cb = function (start, end, label) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        loadCountArticleByDate(moment().subtract(10, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));

        var optionSet1 = {
            startDate: moment().subtract(30, 'days'),
            endDate: moment(),
            minDate: '01/01/2016',
            maxDate: moment(),
            dateLimit: {
                days: 30
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
//            ranges: {
//                'Today': [moment(), moment()],
//                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//                'This Month': [moment().startOf('month'), moment().endOf('month')],
//                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Clear',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        };
        $('#reportrange span').html(moment().subtract(30, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function () {
//            console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function () {
//            console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
//            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            loadCountArticleByDate(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
        });
        $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
//            console.log("cancel event fired");
        });
        $('#options1').click(function () {
            $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function () {
            $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function () {
            $('#reportrange').data('daterangepicker').remove();
        });
        
    });

    function loadCountArticleByDate(start1, end1) {

        var optionCanvas = {
            series: {
                lines: {
                    show: true,
                    fill: false
                },
                splines: {
                    show: false,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                verticalLines: true,
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#fff'
            },
            colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
            xaxis: {
                tickColor: "rgba(51, 51, 51, 0.06)",
                mode: "time",
                tickSize: [1, "day"],
//                tickLength: 10,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10
            },
            yaxis: {
//                ticks: 8,
                tickColor: "rgba(51, 51, 51, 0.06)",
            },
            tooltip: true
        };
        
//        var dataa = [
//            [gd(2012, 1, 1), 17],
//            [gd(2012, 1, 2), 74],
//            [gd(2012, 1, 3), 6],
//            [gd(2012, 1, 4), 39],
//            [gd(2012, 1, 5), 20],
//            [gd(2012, 1, 6), 85],
//            [gd(2012, 1, 7), 7],
//            [gd(2012, 1, 8), 7],
//            [gd(2012, 1, 9), 7],
//            [gd(2012, 1, 10), 7],
//        ];
        
        $.ajax({
            type: 'GET',
            dataType: "json",
            url: '{{ URL::asset("/admin/article/data_bydate/") }}' + '/' + start1 + '/' + end1,
            success: function (data) {
                data = eval(data);
                console.log(data);
                $.plot($("#canvas_dahs"), [data], optionCanvas);
            }
        });

    }
    
    function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
    }
</script>
<!-- /bootstrap-date range picker -->
@stop