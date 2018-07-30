

$(document).ready(function () {
    $("#btn-shorten").click(function () {
       /* $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });*/
        /*$.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:'/ajax',
            method: 'POST',
            data:'_token = <?php echo csrf_token() ?>',
            success: function(response){ // What to do if we succeed
                alert("xxx");
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });*/
        $.get('ajax', function () {
            alert('xxx');
        })
    });
});