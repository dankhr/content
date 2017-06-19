$(document).ready(function () {
    var objData_mb;
    var objData_video;
    var objData_cpu;
    var objData_memory;

    $.ajax({
        url: '/admin/statsmb',
        type: 'POST',
        dataType: 'json',
        success: function (response) {			// При успешном получении данных заполняем #diagram_mb
            if (response != "") {
                objData_mb = response;
                $('#diagram_mb').show();
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(draw_mb);
            }
        },
        error: function (response) {
            console.log(response);
        }
    });

    function draw_mb() {
        var data = google.visualization.arrayToDataTable(objData_mb);

        var options = {
            title: 'Материнские платы',
            legend: { textStyle: {fontSize: 14}},
            bar: { groupWidth: "50%" }
        };

        var chart_mb = new google.charts.Bar(document.getElementById('diagram_mb'));
        // Convert the Classic options to Material options.
        chart_mb.draw(data, google.charts.Bar.convertOptions(options));
    }


    // Видеокарты
    $.ajax({
        url: '/admin/statsvideo',
        type: 'POST',
        dataType: 'json',
        success: function (response) {			// При успешном получении данных заполняем #diagram_video
            if (response != "") {
                objData_video = response;
                $('#diagram_video').show();
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(draw_video);
            }
        },
        error: function (response) {
            console.log(response);
        }
    });

    function draw_video() {
        var data = google.visualization.arrayToDataTable(objData_video);

        var options = {
            title: 'Видеокарты',
            legend: { textStyle: {fontSize: 14}},
            bar: { groupWidth: "50%" },
            series: {
                0: {color: '#d3362d'}
            }

        };

        var chart_video = new google.charts.Bar(document.getElementById('diagram_video'));
        // Convert the Classic options to Material options.
        chart_video.draw(data, google.charts.Bar.convertOptions(options));
    }


    // ЦП
    $.ajax({
        url: '/admin/statscpu',
        type: 'POST',
        dataType: 'json',
        success: function (response) {			// При успешном получении данных заполняем #diagram_cpu
            if (response != "") {
                objData_cpu = response;
                $('#diagram_cpu').show();
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(draw_cpu);
            }
        },
        error: function (response) {
            console.log(response);
        }
    });

    function draw_cpu() {
        var data = google.visualization.arrayToDataTable(objData_cpu);

        var options = {
            title: 'ЦП',
            legend: { textStyle: {fontSize: 14}},
            bar: { groupWidth: "50%" },
            series: {
                0: {color: '#0F751C'}
            }

        };

        var chart_cpu = new google.charts.Bar(document.getElementById('diagram_cpu'));
        // Convert the Classic options to Material options.
        chart_cpu.draw(data, google.charts.Bar.convertOptions(options));
    }

    // ОЗУ
    $.ajax({
        url: '/admin/statsmemory',
        type: 'POST',
        dataType: 'json',
        success: function (response) {			// При успешном получении данных заполняем #diagram_memory
            if (response != "") {
                objData_memory = response;
                $('#diagram_memory').show();
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(draw_memory);
            }
        },
        error: function (response) {
            console.log(response);
        }
    });

    function draw_memory() {
        var data = google.visualization.arrayToDataTable(objData_memory);

        var options = {
            title: 'ОЗУ',
            legend: { textStyle: {fontSize: 14}},
            bar: { groupWidth: "50%" },
            series: {
                0: {color: '#ECE600'}
            }
        };

        var chart_memory = new google.charts.Bar(document.getElementById('diagram_memory'));
        // Convert the Classic options to Material options.
        chart_memory.draw(data, google.charts.Bar.convertOptions(options));
    }

});