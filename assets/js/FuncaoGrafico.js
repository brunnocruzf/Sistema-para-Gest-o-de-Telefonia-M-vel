var conta = 0;
var realizado1 = 0;
var realizado2 = 0;
var realizado3 = 0;
var realizado4 = 0;
var realizado5 = 0;
var realizado6 = 0;
var realizado7 = 0;
var realizado8 = 0;
var realizado9 = 0;
var realizado10 = 0;
var realizado11 = 0;
var realizado12 = 10;
var meta1 = 0;
var meta2 = 0;
var meta3 = 0;
var meta4 = 0;
var meta5 = 0;
var meta6 = 0;
var meta7 = 0;
var meta8 = 0;
var meta9 = 0;
var meta10 = 0;
var meta11 = 0;
var meta12 = 10;
var dados;
var vcolor = 'green';

window.onload = function () {

    if (document.getElementById('period').value == 'mensal') {
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            $.ajax({
                type: "POST",
                url: 'buscadadosgrafico.php?id=' + document.getElementById('nindic').value + '&periodicidade=' + document.getElementById('period').value,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    realizado1 = parseFloat(data.real_1);
                    realizado2 = parseFloat(data.real_2);
                    realizado3 = parseFloat(data.real_3);
                    realizado4 = parseFloat(data.real_4);
                    realizado5 = parseFloat(data.real_5);
                    realizado6 = parseFloat(data.real_6);
                    realizado7 = parseFloat(data.real_7);
                    realizado8 = parseFloat(data.real_8);
                    realizado9 = parseFloat(data.real_9);
                    realizado10 = parseFloat(data.real_10);
                    realizado11 = parseFloat(data.real_11);
                    realizado12 = parseFloat(data.real_12);
                    meta1 = parseFloat(data.meta1);
                    meta2 = parseFloat(data.meta2);
                    meta3 = parseFloat(data.meta3);
                    meta4 = parseFloat(data.meta4);
                    meta5 = parseFloat(data.meta5);
                    meta6 = parseFloat(data.meta6);
                    meta7 = parseFloat(data.meta7);
                    meta8 = parseFloat(data.meta8);
                    meta9 = parseFloat(data.meta9);
                    meta10 = parseFloat(data.meta10);
                    meta11 = parseFloat(data.meta11);
                    meta12 = parseFloat(data.meta12);
                    cor1 = data.cor1;
                    cor2 = data.cor2;
                    cor3 = data.cor3;
                    cor4 = data.cor4;
                    cor5 = data.cor5;
                    cor6 = data.cor6;
                    cor7 = data.cor7;
                    cor8 = data.cor8;
                    cor9 = data.cor9;
                    cor10 = data.cor10;
                    cor11 = data.cor11;
                    cor12 = data.cor12;
                    peri1 = data.per1;
                    peri2 = data.per2;
                    peri3 = data.per3;
                    peri4 = data.per4;
                    peri5 = data.per5;
                    peri6 = data.per6;
                    peri7 = data.per7;
                    peri8 = data.per8;
                    peri9 = data.per9;
                    peri10 = data.per10;
                    peri11 = data.per11;
                    peri12 = data.per12;

                    dados = [
                        ['Meses', 'Desempenho', {
                            role: 'style'
                        }, 'Meta'],
                        [peri1, realizado1, cor1, meta1],
                        [peri2, realizado2, cor2, meta2],
                        [peri3, realizado3, cor3, meta3],
                        [peri4, realizado4, cor4, meta4],
                        [peri5, realizado5, cor5, meta5],
                        [peri6, realizado6, cor6, meta6],
                        [peri7, realizado7, cor7, meta7],
                        [peri8, realizado8, cor8, meta8],
                        [peri9, realizado9, cor9, meta9],
                        [peri10, realizado10, cor10, meta10],
                        [peri11, realizado11, cor11, meta11],
                        [peri12, realizado12, cor12, meta12]
                    ];
                    var dat = google.visualization.arrayToDataTable(dados);
                    var options = {
                        title: 'Medições por meses',
                        hAxis:{ slantedText:true, slantedTextAngle:45},
                        vAxis: { gridlines: { count: 10 },minValue:0},
                        seriesType: 'bars',
                        colors: ['#0092FD', 'red'],
                        legend:{position:'bottom'},
                        series: {
                            1: {
                                type: 'line'
                            }
                        },
                        
                    };
                    var chart = new google.visualization.ComboChart(document.getElementById('graf'));
                    chart.draw(dat, options);
                },
                error: function () {
                    //alert("Não Foi Possível Abrir o Indicador");
                }
            });
        }
    }
    else if (document.getElementById('period').value == 'trimestral') {
        document.getElementById('col1').style.display = 'none';
        document.getElementById('col2').style.display = 'none';
        document.getElementById('col4').style.display = 'none';
        document.getElementById('col5').style.display = 'none';
        document.getElementById('col7').style.display = 'none';
        document.getElementById('col8').style.display = 'none';
        document.getElementById('col10').style.display = 'none';
        document.getElementById('col11').style.display = 'none';

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {

            $.ajax({
                type: "POST",
                url: 'buscadadosgrafico.php?id=' + document.getElementById('nindic').value + '&periodicidade=' + document.getElementById('period').value,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    realizado1 = parseFloat(data.real_3);
                    realizado2 = parseFloat(data.real_6);
                    realizado3 = parseFloat(data.real_9);
                    realizado4 = parseFloat(data.real_12);

                    meta1 = parseFloat(data.meta3);
                    meta2 = parseFloat(data.meta6);
                    meta3 = parseFloat(data.meta9);
                    meta4 = parseFloat(data.meta12);

                    cor1 = data.cor3;
                    cor2 = data.cor6;
                    cor3 = data.cor9;
                    cor4 = data.cor12;
                    peri1 = data.per3;
                    peri2 = data.per6;
                    peri3 = data.per9;
                    peri4 = data.per12;



                    dados = [
                        ['Meses', 'Desempenho', {
                            role: 'style'
                        }, 'Meta'],
                        [peri1, realizado1, cor1, meta1],
                        [peri2, realizado2, cor2, meta2],
                        [peri3, realizado3, cor3, meta3],
                        [peri4, realizado4, cor4, meta4]
                    ];
                    var dat = google.visualization.arrayToDataTable(dados);
                    var options = {
                        title: 'Medições por meses',
                        hAxis:{ slantedText:true, slantedTextAngle:45},
                        vAxis: { gridlines: { count: 10 },minValue:0},
                        seriesType: 'bars',
                        colors: ['#0092FD', 'red'],
                        legend:{position:'bottom'},
                        series: {
                            1: {
                                type: 'line'
                            }
                        },
                        
                    };
                    var chart = new google.visualization.ComboChart(document.getElementById('graf'));
                    chart.draw(dat, options);
                },
                error: function () {
                    //alert("Não Foi Possível Abrir o Indicador");
                }
            });


        }

    }
    else if (document.getElementById('period').value == 'bimestral') {
        document.getElementById('col1').style.display = 'none';
        document.getElementById('col3').style.display = 'none';
        document.getElementById('col5').style.display = 'none';
        document.getElementById('col7').style.display = 'none';
        document.getElementById('col9').style.display = 'none';
        document.getElementById('col11').style.display = 'none';
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {

            $.ajax({
                type: "POST",
                url: 'buscadadosgrafico.php?id=' + document.getElementById('nindic').value + '&periodicidade=' + document.getElementById('period').value,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    realizado1 = parseFloat(data.real_2);
                    realizado2 = parseFloat(data.real_4);
                    realizado3 = parseFloat(data.real_6);
                    realizado4 = parseFloat(data.real_8);
                    realizado5 = parseFloat(data.real_10);
                    realizado6 = parseFloat(data.real_12);
                    meta1 = parseFloat(data.meta2);
                    meta2 = parseFloat(data.meta4);
                    meta3 = parseFloat(data.meta6);
                    meta4 = parseFloat(data.meta8);
                    meta5 = parseFloat(data.meta10);
                    meta6 = parseFloat(data.meta12);
                    cor1 = data.cor2;
                    cor2 = data.cor4;
                    cor3 = data.cor6;
                    cor4 = data.cor8;
                    cor5 = data.cor10;
                    cor6 = data.cor12;
                    peri1 = data.per2;
                    peri2 = data.per4;
                    peri3 = data.per6;
                    peri4 = data.per8;
                    peri5 = data.per10;
                    peri6 = data.per12;
                    
                    
                    
                    
                    
                    
                    dados = [
                        ['Meses', 'Desempenho', {
                            role: 'style'
                        }, 'Meta'],
                        [peri1, realizado1, cor1, meta1],
                        [peri2, realizado2, cor2, meta2],
                        [peri3, realizado3, cor3, meta3],
                        [peri4, realizado4, cor4, meta4],
                        [peri5, realizado5, cor5, meta5],
                        [peri6, realizado6, cor6, meta6]
                    ];
                    var dat = google.visualization.arrayToDataTable(dados);
                    var options = {
                        title: 'Medições por meses',
                        hAxis:{ slantedText:true, slantedTextAngle:45},
                        vAxis: { gridlines: { count: 10 },minValue:0},
                        seriesType: 'bars',
                        colors: ['#0092FD', 'red'],
                        legend:{position:'bottom'},
                        series: {
                            1: {
                                type: 'line'
                            }
                        },
                        
                    };
                    var chart = new google.visualization.ComboChart(document.getElementById('graf'));
                    chart.draw(dat, options);
                },
                error: function () {
                    //alert("Não Foi Possível Abrir o Indicador");
                }
            });
        }
    }
    else if (document.getElementById('period').value == 'quadrimestral') {
        document.getElementById('col1').style.display = 'none';
        document.getElementById('col2').style.display = 'none';
        document.getElementById('col3').style.display = 'none';
        document.getElementById('col5').style.display = 'none';
        document.getElementById('col6').style.display = 'none';
        document.getElementById('col7').style.display = 'none';
        document.getElementById('col9').style.display = 'none';
        document.getElementById('col10').style.display = 'none';
        document.getElementById('col11').style.display = 'none';
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {

            $.ajax({
                type: "POST",
                url: 'buscadadosgrafico.php?id=' + document.getElementById('nindic').value + '&periodicidade=' + document.getElementById('period').value,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    realizado1 = parseFloat(data.real_4);
                    realizado2 = parseFloat(data.real_8);
                    realizado3 = parseFloat(data.real_12);

                    meta1 = parseFloat(data.meta4);
                    meta2 = parseFloat(data.meta8);
                    meta3 = parseFloat(data.meta12);

                    cor1 = data.cor4;
                    cor2 = data.cor8;
                    cor3 = data.cor12;
                    peri1 = data.per4;
                    peri2 = data.per8;
                    peri3 = data.per12;



                    dados = [
                        ['Meses', 'Desempenho', {
                            role: 'style'
                        }, 'Meta'],
                        [peri1, realizado1, cor1, meta1],
                        [peri2, realizado2, cor2, meta2],
                        [peri3, realizado3, cor3, meta3]

                    ];
                    var dat = google.visualization.arrayToDataTable(dados);
                    var options = {
                        title: 'Medições por meses',
                        hAxis:{ slantedText:true, slantedTextAngle:45},
                        vAxis: { gridlines: { count: 10 },minValue:0},
                        seriesType: 'bars',
                        colors: ['#0092FD', 'red'],
                        legend:{position:'bottom'},
                        series: {
                            1: {
                                type: 'line'
                            }
                        },
                        
                    };
                    var chart = new google.visualization.ComboChart(document.getElementById('graf'));
                    chart.draw(dat, options);
                },
                error: function () {
                    //alert("Não Foi Possível Abrir o Indicador");
                }
            });
        }

    }
    else if (document.getElementById('period').value == 'semestral') {
        document.getElementById('col1').style.display = 'none';
        document.getElementById('col2').style.display = 'none';
        document.getElementById('col3').style.display = 'none';
        document.getElementById('col4').style.display = 'none';
        document.getElementById('col5').style.display = 'none';
        document.getElementById('col7').style.display = 'none';
        document.getElementById('col8').style.display = 'none';
        document.getElementById('col9').style.display = 'none';
        document.getElementById('col10').style.display = 'none';
        document.getElementById('col11').style.display = 'none';

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {

            $.ajax({
                type: "POST",
                url: 'buscadadosgrafico.php?id=' + document.getElementById('nindic').value + '&periodicidade=' + document.getElementById('period').value,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    realizado1 = parseFloat(data.real_6);
                    realizado2 = parseFloat(data.real_12);

                    meta1 = parseFloat(data.meta6);
                    meta2 = parseFloat(data.meta12);

                    cor1 = data.cor6;
                    cor2 = data.cor12;
                    peri1 = data.per6;
                    peri2 = data.per12;


                    dados = [
                        ['Meses', 'Desempenho', {
                            role: 'style'
                        }, 'Meta'],
                        [peri1, realizado1, cor1, meta1],
                        [peri2, realizado2, cor2, meta2]
                    ];
                    var dat = google.visualization.arrayToDataTable(dados);
                    var options = {
                        title: 'Medições por meses',
                        hAxis:{ slantedText:true, slantedTextAngle:45},
                        vAxis: { gridlines: { count: 10 },minValue:0},
                        seriesType: 'bars',
                        colors: ['#0092FD', 'red'],
                        legend:{position:'bottom'},
                        series: {
                            1: {
                                type: 'line'
                            }
                        },
                        
                    };
                    var chart = new google.visualization.ComboChart(document.getElementById('graf'));
                    chart.draw(dat, options);
                },
                error: function () {
                    //alert("Não Foi Possível Abrir o Indicador");
                }
            });
        }
    }
    else if (document.getElementById('period').value == 'anual') {
        document.getElementById('col2').style.display = 'none';
        document.getElementById('col3').style.display = 'none';
        document.getElementById('col4').style.display = 'none';
        document.getElementById('col5').style.display = 'none';
        document.getElementById('col6').style.display = 'none';
        document.getElementById('col7').style.display = 'none';
        document.getElementById('col8').style.display = 'none';
        document.getElementById('col9').style.display = 'none';
        document.getElementById('col10').style.display = 'none';
        document.getElementById('col11').style.display = 'none';
        document.getElementById('col1').style.display = 'none';


        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {

            $.ajax({
                type: "POST",
                url: 'buscadadosgrafico.php?id=' + document.getElementById('nindic').value + '&periodicidade=' + document.getElementById('period').value,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    realizado1 = parseFloat(data.real_12);

                    meta1 = parseFloat(data.meta12);

                    cor1 = data.cor12;
                    peri1 = data.per12;


                    dados = [
                        ['Meses', 'Desempenho', {
                            role: 'style'
                        }, 'Meta'],
                        [peri1, realizado1, cor1, meta1]

                    ];
                    var dat = google.visualization.arrayToDataTable(dados);
                    var options = {
                        title: 'Medições por meses',
                        hAxis:{ slantedText:true, slantedTextAngle:45},
                        vAxis: { gridlines: { count: 10 },minValue:0},
                        seriesType: 'bars',
                        colors: ['#0092FD', 'red'],
                        legend:{position:'bottom'},
                        series: {
                            1: {
                                type: 'line'
                            }
                        },
                        
                    };
                    var chart = new google.visualization.ComboChart(document.getElementById('graf'));
                    chart.draw(dat, options);
                },
                error: function () {
                    //alert("Não Foi Possível Abrir o Indicador");
                }
            });
        }

    }
    else if (document.getElementById('period').value == 'bianual') {
        document.getElementById('col2').style.display = 'none';
        document.getElementById('col3').style.display = 'none';
        document.getElementById('col4').style.display = 'none';
        document.getElementById('col5').style.display = 'none';
        document.getElementById('col6').style.display = 'none';
        document.getElementById('col7').style.display = 'none';
        document.getElementById('col8').style.display = 'none';
        document.getElementById('col9').style.display = 'none';
        document.getElementById('col10').style.display = 'none';
        document.getElementById('col11').style.display = 'none';
        document.getElementById('col1').style.display = 'none';
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {

            $.ajax({
                type: "POST",
                url: 'buscadadosgrafico.php?id=' + document.getElementById('nindic').value + '&periodicidade=' + document.getElementById('period').value,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    realizado1 = parseFloat(data.real_12);

                    meta1 = parseFloat(data.meta12);

                    cor1 = data.cor12;
                    peri1 = data.per12;

                    dados = [
                        ['Meses', 'Desempenho', {
                            role: 'style'
                        }, 'Meta'],
                        [peri1, realizado1, cor1, meta1]

                    ];
                    var dat = google.visualization.arrayToDataTable(dados);
                    var options = {
                        title: 'Medições por meses',
                        hAxis:{ slantedText:true, slantedTextAngle:45},
                        vAxis: { gridlines: { count: 10 },minValue:0},
                        seriesType: 'bars',
                        colors: ['#0092FD', 'red'],
                        legend:{position:'bottom'},
                        series: {
                            1: {
                                type: 'line'
                            }
                        },
                        
                    };
                    var chart = new google.visualization.ComboChart(document.getElementById('graf'));
                    chart.draw(dat, options);
                },
                error: function () {
                    //alert("Não Foi Possível Abrir o Indicador");
                }
            });
        }
    }
}