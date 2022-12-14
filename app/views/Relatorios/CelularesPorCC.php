<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/sgt/config.php');
require_once(DBAPI);
abresessao();
include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);
$_SESSION['menu'] = 'Telefonia';
?>
    <style>
        .table-condensed {
            font-size: 10px;
        }
    </style>
    <div id="content">
        <div id="content-header">
            <h1>SGT - SISTEMA PARA GESTÃO DE TELEFONIA MÓVEL</h1>
        </div> <!-- #content-header -->
        <div id="content-container">
            <div class="portlet">
                <div class="portlet-header">
                    <h3><span  class="badge" style="background-color: #bdbdbd; padding-left: 11px; padding: 5px" onclick="history.back()"><i class="fa fa-arrow-left"></i></span>
                        <i class="fa fa-table"></i>
                        SGT - SISTEMA PARA GESTÃO DE TELEFONIA MÓVEL
                    </h3>
                </div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="portlet">
                        <CENTER><H3>QUANTIDADE DE CELULARES POR CENTRO DE CUSTO</H3></CENTER>
                        <br/>
                        <br/>
                        <div id="container"></div>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
<?php include(FOOTER_TEMPLATE); ?>


<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

</script>

<script type="text/javascript">

    // console.log(json.stringify(junta));
    google.charts.load('current', {packages: ['corechart']});

        function drawChart() {
            var json = <?php echo json_encode($dados);?>;
            var dates = [];
            var sums = [];
            var junta = [['Quantidade', 'Centro de Custo']];
            for (var i of json) {
                if (dates.indexOf(i["qtde"]) < 0) {
                    dates.push(i["cc_descricao"]);
                    sums.push(0);

                }
                sums[dates.indexOf(i["qtde"])] += i["cc_descricao"];
                //junta[dates.indexOf(i["linha"])] += ['linha'> parseInt(i['linha']),'valor'> parseFloat(i["valor"])]

                junta.push([i["cc_descricao"],parseInt(i['qtde'])]);
            }
        console.log(junta)
            // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable(junta);

        var options = {title: ''};

        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('container'));
        chart.draw(data, options);
    }
        google.charts.setOnLoadCallback(drawChart);
</script>

