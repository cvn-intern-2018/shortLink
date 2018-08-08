(function ($) {
    if (Number(clicked_time_total) === 0){
        $('#panel-chart').remove();
    }
    else {
        drawChart(arr_data_browser);
        jQuery('#time-frame').change(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: 'chart/sort',
                type: 'POST',
                data: {
                    time_select: $(this).val(),
                    url_shortener: url_shortener,
                },
                success: function (result) {
                    console.log('12321');
                    console.log(result);
                    drawChart(result.data);
                },
                error: function (result) {
                    alert('false');
                }
            });
        })
    }

})(jQuery);

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

function drawChart(arr_data) {

    $('#myChart').remove();
    $('#canvas-wrapper').append('<canvas id="myChart" width="400" height="400"></canvas>');

    var ctx = document.getElementById("myChart").getContext('2d');
    var labelsChart = [];
    var dataChart = [];
    arr_data.forEach(function (element) {
        labelsChart.push(element.browser_name);
        dataChart.push(element.clicked);
    });
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsChart,
            datasets: [{
                label: '# of Votes',
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
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.yLabel;
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
}
