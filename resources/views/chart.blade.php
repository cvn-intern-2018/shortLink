@extends('layout.layouts')
@section('body')
    <div id="page" class="page">

        <!-- header -->
        <header class="header8 chart" id="home">

            <nav role="navigation" class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <a href="/" class="navbar-brand brand"><img src="assets/images/ogp.png" alt="" height="40"
                                                                    width="50"><span>Cybozu</span><span>Company</span></a>
                    </div>
                </div>
            </nav>

            <div class="intro center-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
                            <h1 class="pull-stop text-center">Statistics and Chart</h1>
                            <div class=" login-reg subscribe text-center form-inline" id="frm-short">
                                <div class=" col-md-offset-2 group-info-chart row margin-bottom-0">
                                    <div class="col-md-10 col-sm-10">
                                        <div class="info-url form-group">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5>Original Link: </h5>
                                                    <a target="_blank" class="original-url"
                                                       href=" {{$obj_info_url_shortener->url_original}}"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="{{$obj_info_url_shortener->url_original}}"
                                                       id="original_link_chart">
                                                        {{$obj_info_url_shortener->url_original}}
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    <button href="#" class=" fas fa-copy edit-btn btn btn-info btn-lg"
                                                            id="btn_copy_original_link"
                                                            onclick="copyToClipboard('#original_link_chart')">
                                                        copy
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-url form-group">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5>URL Shortener: </h5>
                                                    <a target="_blank" class="original-url" id="shorten_link_chart"
                                                       href="{{$obj_info_url_shortener->url_short}}">
                                                        {{$domain}}/{{$obj_info_url_shortener->url_short}}
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    <button href="#" class="fas fa-copy  edit-btn btn btn-info btn-lg"
                                                            id="btn_copy_shorten_link"
                                                            onclick="copyToClipboard('#shorten_link_chart')">
                                                        copy

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-url form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Time Created <p>(dd-mm-yyyy)</p>:</h5>
                                                    <p>{{$obj_info_url_shortener->created_at}}</p>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="info-url form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Total Clicks: </h5>
                                                    <p>{{ $obj_info_url_shortener->clicked_time_total }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row graph-chart" id="panel-chart">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 style="display: inline">Chart</h3>
                                                <div style="display: inline" class="pull-right"><i class="far fa-chart-bar" style="font-size: 20px; vertical-align: middle"></i>
                                                    {{$obj_info_url_shortener->clicked_time_total}} clicks
                                                     </i>
                                                    <select id="time-frame">
                                                        <option value= {{config('constants.timeframe.2hours')}}>2
                                                            hours
                                                        </option>
                                                        <option value= {{config('constants.timeframe.day')}}>Day
                                                        </option>
                                                        <option value= {{config('constants.timeframe.week')}}>Week
                                                        </option>
                                                        <option value= {{config('constants.timeframe.month')}}>Month
                                                        </option>
                                                        <option selected
                                                                value= {{config('constants.timeframe.alltime')}}>All
                                                            time
                                                        </option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="panel-body" id="canvas-wrapper">
                                                <canvas id="myChart" width="400" height="400"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- row -->

                </div><!-- intro -->

            </div><!-- container -->

        </header><!-- header -->
        <footer class="footer8">
            <div class="container">
                <div class="col-md-12">
                    <p class="pull-left small">© Copyright - 2018</p>
                    <p class="pull-right small">Made with <i class="fa fa-heart"></i> in Cybozu</p>
                </div>
            </div>
        </footer>
    </div><!-- /#page -->
@endsection
@section('script')
    <script>
        var url_shortener = '<?php echo $obj_info_url_shortener->url_short; ?>';
        var arr_data_browser = '<?php echo json_encode($arr_data_browser); ?>';
        var clicked_time_total = '<?php echo $obj_info_url_shortener->clicked_time_total; ?>';
        arr_data_browser = JSON.parse(arr_data_browser);

    </script>
    <script src="{{asset('assets/js/chart.js')}}"></script>
@endsection

