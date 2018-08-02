@extends('layout.layouts')
@section('body')
    <div id="page" class="page">

        <!-- header -->
        <header class="header8 chart" id="home">

            <nav role="navigation" class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <a href="/" class="navbar-brand brand"><img src="assets/images/ogp.png" alt="" height="40" width="50"><span>Cybozu</span><span>Company</span></a>
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
                                                    <a target="_blank" class="original-url" href=" {{$url_original_link}}" data-toggle="tooltip" data-placement="top" title="{{$url_original_link}}" id="original_link_chart">
                                                        {{$url_original_link}}
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    <button href="#" class=" fas fa-copy edit-btn btn btn-info btn-lg" id="btn_copy_original_link" onclick="copyToClipboard('#original_link_chart')">
                                                        copy
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-url form-group">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5>URL Shortener: </h5>
                                                    <a target="_blank" class="original-url" id="shorten_link_chart" href="{{$url_short_link}}">
                                                        http://cus.dev.cybozu.xyz/{{$url_short_link}}
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    <button href="#" class="fas fa-copy  edit-btn btn btn-info btn-lg" id="btn_copy_shorten_link" onclick="copyToClipboard('#shorten_link_chart')">
                                                        copy

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-url form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Time Created: </h5>
                                                    <p>{{$created_at}}</p>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="info-url form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Total Clicks: </h5>
                                                    <p>{{$countClickedTime}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row graph-chart">
                                <div class="row">

                                </div>
                                <div class="pull-left">
                                    <h2>Title</h2>
                                </div>
                                <div class="pull-right cbb-time">
                                    37 clicks
                                    <i class="fa fa-bar-chart" aria-hidden="true"> </i>
                                    <select>
                                        <option selected>Timeframe: (All time)</option>
                                        <option>2 hours</option>
                                        <option>Day</option>
                                        <option>Week</option>
                                        <option>Month</option>
                                        <option>All time</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <img src="assets/images/chart-2.png" alt="">
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
