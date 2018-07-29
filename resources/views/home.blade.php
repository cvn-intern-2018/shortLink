@extends('layout.layouts')
@section('body')
<div id="page" class="page">

    <!-- header -->
    <header class="header8" id="home">

        <nav role="navigation" class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand brand"><img src="assets/images/ogp.png" alt="" height="40" width="50"><span>Cybozu</span><span>Company</span></a>
                </div>
            </div>
        </nav>

        <div class="intro center-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
                        <div class="email text-center"><i class="fa fa-link" aria-hidden="true"></i></div>
                        {{-- <p class="tag-line text-center">Quality, more value of a link</p> --}}
                        <h1 class="pull-stop text-center">Cybozu URL Shortener</h1>
                        <form class="login-reg subscribe text-center form-inline" id="frm-short" method="post" action="short">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row margin-bottom-0">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-lg" id="org_url" placeholder="Your URL here" name="org_url" required>
                                    </div>
                                    <div class="customize form-group">
                                        <h4>Customize short URL (Optional)</h4>
                                        <p>http://cus.dev.cybozu.xyz/</p><input maxlength="20" type="text" id="custom_url" name="custom_url" placeholder="Max length is 20 letters">
                                    </div>
                                    <div class="btn-shorten form-group">
                                        <button  id="btn-shorten" type="submit" class="btn btn-info button" name="btn-shorten">Shorten</button>
                                    </div>
                                    @if(isset($data))
                                    <div class="form-group" id="result-short">
                                        <h4>Original URL</h4>
                                        <a target="_blank" class ="original-url" href="{{$data->url_original}}">
                                            {{$data->url_original}}
                                        </a>
                                        <h4>URL Shortener</h4>
                                        <div class="row shortURL">
                                            <div class="col-md-8">
                                                <a target="_blank" href="{{$data->url_original}}" id="short_generate">http://cus.dev.cybozu.xyz/{{$data->url_shorten}}</a>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#"><i class="fa fa-files-o" aria-hidden="true" style="background-color: #688490"></i></a>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                                            </div>
                                        </div >
                                        <br/>
                                        <div class="row shortURL">
                                            <div class="col-md-8">
                                                <a target="_blank" href="#" id="short_customize">http://cus.dev.cybozu.xyz/Customize</a>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#"><i class="fa fa-files-o" aria-hidden="true" style="background-color: #688490"></i></a>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

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
