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

            <div class="intro center-content" style="background-color: #2a88bd">
                <section class="error_section">
                    <p class="error_section_subtitle">Opps Page is not available !</p>
                    <h1 class="error_title" style="font-size: 300px;">
                        404
                    </h1>
                    <div class="error_row">
                        <a href="/" class="error_btn">Back to home</a>
                    </div>
                </section>

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
