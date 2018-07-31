function updateUrlInfo($url_shorten) {
    if ($url_shorten == null) {
        return;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'home/ajax/url',
        data: {
            url_shorten: $url_shorten,
        },
        success: function (data) {
            //alert(data);
            console.log(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
};