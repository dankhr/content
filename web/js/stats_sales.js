$(document).ready(function () {
    var objData_timeline;

    // Статистика продаж
    $.ajax({
        url: '/admin/statssales',
        type: 'POST',
        dataType: 'json',
        success: function (response) {			// При успешном получении данных заполняем #diagram_timeline
            if (response != "") {
                objData_timeline = response;
                $('#diagram_timeline').show();
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(draw_timeline);
            }
        },
        error: function (response) {
            console.log(response);
        }
    });

    function draw_timeline() {
        var data = google.visualization.arrayToDataTable(objData_timeline);

        var options = {
            title: 'Продажи (руб.)',
            legend: { position: 'bottom' },
            hAxis: { textPosition: 'none' },
            lineWidth: 5,
            series: {
                0: {color: '#d3362d'}
            }
        };

        var chart_timeline = new google.visualization.LineChart(document.getElementById('diagram_timeline'));
        // Convert the Classic options to Material options.
        chart_timeline.draw(data, options);

    }
    
});