
(function($){    
    drawChart(arr_data_browser);
    jQuery('#time-frame').change(function (e) {                 
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: 'chart/statistics',
            type: 'POST',
            data: {
                time_select: $( this ).val(),
                arr_data_browser: arr_data_browser,
            },
            success: function(result) {
                console.log('sucessfull');
                console.log(result);
            },
            error:function(result){
                console.log(result);
                console.log('error');
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
function drawChart(arr_data_browser){
    var ctx = document.getElementById("myChart").getContext('2d');
    var labelsChart = [];
    var dataChart = [];     
    arr_data_browser.forEach(function(element){
        labelsChart.push(element.browser_name);
        dataChart.push(element.total_click);
    });       
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsChart,
            datasets: [{                
                data: dataChart,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
}   
