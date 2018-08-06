

(function($){    
    drawChart(arr_data_browser);
    jQuery('#time-frame').change(function () {
        var time_select =  $( this ).val();
        var time_now = Date.now();
        var time_line = time_now - time_select*conts_hours_to_milliseconds;
        if (time_select == 0){
            time_line = 0;
        }
        drawChart(filterDataByTime(arr_data_browser,time_line));
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

    $('#myChart').remove();
    $('#canvas-wrapper').append('<canvas id="myChart" width="400" height="400"></canvas>');

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
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 150, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 150, 0.2)'
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

function filterDataByTime(arr_data_browser,time_line){
    arr_data_browser.forEach(function (element) {
        if (element.total_click > 0){
            element.arr_click_time = element.arr_click_time.filter(item => (item >= time_line));
            element.total_click = element.arr_click_time.length;
        }
    });
    return arr_data_browser;
}