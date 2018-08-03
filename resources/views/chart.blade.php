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
                                                        {{config('constants.domain')}}/{{$url_short_link}}
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
                                                    <h5>Time Created <p>(dd-mm-yyyy)</p>: </h5>
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
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                    Dashboard
                                                    37 clicks
                                                    <i class="fa fa-bar-chart" aria-hidden="true"> </i>
                                                    <select id="time-frame">
                                                        <option value= {{config('constants.timeframe.2hours')}}>2 hours</option>
                                                        <option value= {{config('constants.timeframe.day')}}>Day</option>
                                                        <option value= {{config('constants.timeframe.week')}}>Week</option>
                                                        <option value= {{config('constants.timeframe.month')}}>Month</option>
                                                        <option selected value= {{config('constants.timeframe.alltime')}}>All time</option>
                                                    </select>
                                            </div>
                                            <div class="panel-body">
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
    <script src="{{asset('assets/js/chart.js')}}"></script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
@endsection

