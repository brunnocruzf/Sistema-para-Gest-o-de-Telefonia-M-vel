<?php
require_once('C:\xampp\htdocs\sgt\config.php');
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
        <h1>SISTEMA DE GESTÃO DE TELEFONIA</h1>
    </div> <!-- #content-header -->
    <div id="content-container">
        <div class="portlet">
            <div class="portlet-header">
                <h3>
                    <i class="fa fa-table"></i>
                    SISTEMA DE GESTÃO DE TELEFONIA
                </h3>
            </div> <!-- /.portlet-header -->
            <div class="portlet-content">
                <div class="portlet" id="portlet">
                    <?php
                    //  echo json_encode($dates[0]);
                    //    echo  json_encode($dates);
                    //   $datas = json_decode($dates[0]);
                    ?>

                    <!--Div that will hold the pie chart
                    <div id="chart_div"></div>-->
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

    google.charts.load('current', {packages: ['corechart', 'bar']});


    google.charts.setOnLoadCallback(drawTitleSubtitle);

    function drawTitleSubtitle() {

        <?php
            $i = 0;
            foreach ($dates as $data):
            //var_dump($i);
            $i++;
        ?>

        var json = <?php echo json_encode($data);?>;
        var dates = [];
        var sums = [];
        var junta = [['Linha', 'Valor']];
        for (var i of json) {
            if (dates.indexOf(i["linha"]) < 0) {
                dates.push(i["linha"]);
                sums.push(0);

            }
            sums[dates.indexOf(i["linha"])] += parseFloat(i["valor"]);
            //junta[dates.indexOf(i["linha"])] += ['linha'> parseInt(i['linha']),'valor'> parseFloat(i["valor"])]

            junta.push(["'" + parseInt(i['linha']) + "'", parseFloat(i["valor"])]);
        }
        console.log(dates);
        console.log(sums);


        var data = google.visualization.arrayToDataTable(junta);

        var materialOptions = {
            chart: {
                title: '',
                subtitle: ''
            },
            hAxis: {
                title: 'Valores',
                minValue: 0,
            },
            vAxis: {
                title: 'Linhas'
            },
            bars: 'horizontal'
        };
        document.getElementById("portlet").innerHTML = "<div id='chart_div<?=$i?>'></div>";
        var materialChart = new google.charts.Bar(document.getElementById('chart_div<?=$i?>'));


        setTimeout(function () {
            materialChart.draw(data, materialOptions);
        }, 500);
        <?php endforeach;?>
    }



</script>
