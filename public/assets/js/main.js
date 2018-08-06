(function ($) {
    jQuery('#btn-shorten').click(function (e) {
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
            success: function (result) {
                if (result.isError) {
                    editHtmlFailure(result.data);
                }
                else {
                    editHtmlSuccess(result.data, result.domain);
                }
            },
            error: function (result) {
                editHtmlFailure('The request timed out error');
            }
        });
    });

    function editHtmlSuccess(data, domain) {
        var htmlResultShortten = '';

        for (i = 0; i < data.length; i++) {
            htmlResultShortten += `
                            <div class="row item">
                                <div class="col-md-8" style="min-width: 300px">
                                    <a target="_blank" href="` + data[i].url_shorten + `" id="short_generate">` + domain + `/` + data[i].url_shorten + `</a>
                               </div>
                                <div class="col-md-2">
                                     <a id="btnCopy" onclick="return copyTextToClipboard('` + domain + `/` + data[i].url_shorten + `')">
                                     <i class="fas fa-copy" style="background-color: #688490"></i>
                                    </a>

                                </div>
                                <div class="col-md-2">
                                     <a  href="` + data[i].url_shorten + `+"><i class="fas fa-chart-bar"></i></i></a>
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
        var htmlResult = `<p style="color:red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;` + data + `</p>`;
        document.getElementById("short-notify").innerHTML = htmlResult;
        document.getElementById("result-short").innerHTML = '';
    }
})(jQuery);

function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }
    document.body.removeChild(textArea);
}

function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function () {
        console.log('Async: Copying to clipboard was successful!');
    }, function (err) {
        console.error('Async: Could not copy text: ', err);
    });
}