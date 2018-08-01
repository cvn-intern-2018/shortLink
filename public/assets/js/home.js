function updateUrlInfo($id) {
    if ($id == null) {
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
            id: $id,
        },
        success: function (data) {
            //console.log(data.data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //console.log(textStatus);
        }
    });
};
