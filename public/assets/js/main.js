/*=====================================================================
/  Theme Name: Eden Builder
/  Author: Script Eden
/  Author URI: http://www.scripteden.com
/  Description: Eden Builder
/  Version: 2.0
/*=====================================================================*/

(function($){
    jQuery('#btn-shorten').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: 'short',
            type: 'POST',
            data: {
                org_url: jQuery('#org_url').val(),
                custom_url: jQuery('#custom_url').val(),
            },
            success: function(result) {
                if(result.isError)
                {
                    editHtmlFailure(result.data);
                }
                else {
                    editHtmlSuccess(result.data);
                }
            },
        });
    });
    function editHtmlSuccess(data) {
        var htmlResultShortten = '';


        for (i = 0; i < data.length ; i++) {
            htmlResultShortten += `
                            <div class="row item">
                                <div class="col-md-8">
                                    <a target="_blank" href="` + data[i].url_original + `" id="short_generate">http://cus.dev.cybozu.xyz/` + data[i].url_shorten + `</a>
                               </div>
                                <div class="col-md-2">
                                     <a href="#"><i class="fa fa-files-o" aria-hidden="true" style="background-color: #688490"></i></a>
                                </div>
                                <div class="col-md-2">
                                     <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                                 </div>
                            </div>
                               `
        }
        var htmlURLShortener = '';
        var htmlResult = `<div class="form-group">
                                        <h4>Original URL</h4>
                                        <a target="_blank" class ="original-url" href="` + data[0].url_original + `">
                                           ` + data[0].url_original + `
                                        </a>
                                        <h4>URL Shortener</h4>
                                        <div class="row shortURL">
                                            ` + htmlResultShortten + ` 
                                          
                                        </div >
                                        <br/>
                                    </div>`;
        document.getElementById("result-short").innerHTML = htmlResult;
        document.getElementById("short-notify").innerHTML = '';
    }
    function editHtmlFailure(data) {
        var  htmlResult = `<p style="color:yellow"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;` + data + `</p>`;
        document.getElementById("short-notify").innerHTML = htmlResult;
        document.getElementById("result-short").innerHTML = '';
    }

})(jQuery);
