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
                        <p class="tag-line text-center">Quality, more value of a link</p>
                        <h1 class="pull-stop text-center">Cybozu URL Shortener</h1>
                        <form class="login-reg subscribe text-center form-inline" id="frm-short">
                            <div class="row margin-bottom-0">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-lg" id="exampleInputEmail2" placeholder="Your URL here">
                                    </div>
                                    <div class="customize form-group">
                                        <h4>Customize short URL (Optional)</h4>
                                        <p>http://cus.dev.cybozu.xyz/</p><input type="text" class="" placeholder="Customize URL here">
                                    </div>
                                    <div class="btn-shorten form-group">
                                        <a href="#" id="btn-shorten"   type="submit" class="btn btn-info button">Shorten</a>
                                    </div>
                                    <div class="form-group" id="result-short">
                                        <h4>Original URL</h4>
                                        <a class ="original-url" href="#">
                                            https://web.archive.org/web/20111110004006/http://www.seomofo.com/experiments/title-and-h1-of-this-post-but-for-the-sake-of-keyword-prominence-stuffing-im-going-to-mention-it-again-using-various-synonyms-stemmed-variations-and-of-coursea-big-fat-prominent-font-size-heres-the-stumper-that-stumped-me-what-is-the-max-number-of-chars-in-a-url-that-google-is-willing-to-crawl-and-index-for-whatever-reason-i-thought-i-had-read-somewhere-that-googles-limit-on-urls-was-255-characters-but-that-turned-out-to-be-wrong-so-maybe-i-just-made-that-number-up-the-best-answer-i-could-find-was-this-quote-from-googles-webmaster-trends-analyst-john-mueller-we-can-certainly-crawl-and-index-urls-over-1000-characters-long-but-that-doesnt-mean-that-its-a-good-practice-the-setup-for-this-experiment-is-going-to-be-pretty-simple-im-going-to-edit-the-permalink-of-this-post-to-be-really-really-long-then-im-going-to-see-if-google-indexes-it-i-might-even-see-if-yahoo-and-bing-index-iteven-though-no-one-really-cares-what-those-assholes-are-doing-url-character-limits-unrelated-to-google-the-question-now-is-how-many-characters-should-i-make-the-url-of-this-post-there-are-a-couple-of-sources-ill-reference-to-help-me-make-this-decision-the-first-is-this-quote-from-the-microsoft-support-pages-microsoft-internet-explorer-has-a-maximum-uniform-resource-locator-url-length-of-2083-characters-internet-explorer-also-has-a-maximum-path-length-of-2048-characters-this-limit-applies-to-both-post-request-and-get-request-urls-the-second-source-ill-cite-is-the-http-11-protocol-which-says-the-http-protocol-does-not-place-any-a-priori-limit-on-the-length-of-a-uri-servers-must-be-able-to-handle-the-uri-of-any-resource-they-serve-and-should-be-able-to-handle-uris-of-unbounded-length-if-they-provide-get-based-forms-that-could-generate-such-uris-a-server-should-return-414-request-uri-too-long-status-if-a-uri-is-longer.html
                                        </a>
                                        <h4>URL Shortener</h4>
                                        <div class="row shortURL">
                                            <div class="col-md-8">
                                                <a href="#">http://cus.dev.cybozu.xyz/abcdef</a>
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
                                                <a href="#">http://cus.dev.cybozu.xyz/Customize</a>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#"><i class="fa fa-files-o" aria-hidden="true" style="background-color: #688490"></i></a>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

                                    </div>

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
