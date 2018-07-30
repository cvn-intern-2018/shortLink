@extends('layout.layouts')
@section('body')
    <div id="page" class="page">

        <!-- header -->
        <header class="header8" id="home">

            <nav role="navigation" class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand brand"><img src="assets/images/ogp.png" alt="" height="40"
                                                                    width="50"><span>Cybozu</span><span>Company</span></a>
                    </div>
                </div>
            </nav>

            <div class="intro center-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
                            <div class="email text-center"><i class="fa fa-link" aria-hidden="true"></i></div>
                            <h1 class="pull-stop text-center">Cybozu URL Shortener</h1>
                            <form class="login-reg subscribe text-center form-inline" id="frm-short" method="post"
                                  action="short">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row margin-bottom-0">
                                    <div class="col-md-12 col-sm-12">
                                        @if (isset($invalid_url))
                                            <div style="color:red">
                                                {{$invalid_url}}
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <input type="text" class="form-control input-lg" id="org_url"
                                                   placeholder="Your URL here" name="org_url" required>
                                        </div>
                                        <div class="customize form-group">
                                            <h4>Customize short URL (Optional)</h4>
                                            <p>http://cus.dev.cybozu.xyz/</p><input maxlength="20" type="text"
                                                                                    id="custom_url" name="custom_url"
                                                                                    placeholder="Max length is 20 letters">
                                        </div>
                                        @if (isset($notify_error))
                                            <p style="color:yellow">{{$notify_error}}</p>
                                        @endif

                                        <div class="btn-shorten form-group">
                                            <button id="btn-shorten" type="submit" class="btn btn-info button"
                                                    name="btn-shorten">Shorten
                                            </button>
                                        </div>
                                        @if(isset($data))
                                            <div class="form-group" id="result-short">
                                                <h4>Original URL</h4>
                                                <a target="_blank" class="original-url"
                                                   href=" {{$data[0]->url_original}}">
                                                    {{$data[0]->url_original}}
                                                </a>
                                                <h4>URL Shortener</h4>
                                                @foreach ($data as $dt)
                                                    <div class="row shortURL">
                                                        <div class="col-md-8 shortURL-click">
                                                            <a target="_blank"
                                                               onclick="updateUrlInfo('{{$dt->url_shorten}}')" href="{{$dt->url_original}}" >http://cus.dev.cybozu.xyz/{{$dt->url_shorten}}</a>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="#"><i class="fa fa-files-o" aria-hidden="true"
                                                                           style="background-color: #688490"></i></a>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="#"><i class="fa fa-bar-chart"
                                                                           aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                @endforeach

                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </form>
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