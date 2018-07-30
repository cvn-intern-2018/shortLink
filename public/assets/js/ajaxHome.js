//
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
// $(document).ready(function () {
//     $("#btn-shorten").click(function () {
//
//         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
//         $.ajax({
//             url:'ajax',
//             type: 'POST',
//             data: {_token: CSRF_TOKEN},
//             success: function($data){ // What to do if we succeed
//                 alert('ssss');
//             },
//             error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
//                alert(textStatus);
//             }
//         });
//
//     });
// });