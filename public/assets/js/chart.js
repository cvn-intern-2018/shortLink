
(function($){
    jQuery('#time-frame').change(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: 'chart/arrangetime',
            type: 'POST',
            data: {
                time_selected: $( this ).val()
            },
            success: function(result) {
                console.log(result.data);
                alert(result);
            },
            error:function(data){
                alert('The request timed out error');
            }
        });
        
    })

})(jQuery);
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}