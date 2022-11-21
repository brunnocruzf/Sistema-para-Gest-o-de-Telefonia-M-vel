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
                    <div class="portlet">
                        <?php
                            echo $dates;

                            var_dump(json_decode($dates[0]));
                        ?>

                        <!--Div that will hold the pie chart-->
                        <div id="chart_div"></div>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
<?php include(FOOTER_TEMPLATE); ?>

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawTitleSubtitle);

    function drawTitleSubtitle() {
        var data = google.visualization.arrayToDataTable([
            ['City', '2010 Population'],
            ['New York City, NY', 8175000],
            ['Los Angeles, CA', 3792000],
            ['Chicago, IL', 2695000],
            ['Houston, TX', 2099000],
            ['Philadelphia, PA', 1526000]
        ]);

        var materialOptions = {
            chart: {
                title: 'Population of Largest U.S. Cities',
                subtitle: 'Based on most recent and previous census data'
            },
            hAxis: {
                title: 'Total Population',
                minValue: 0,
            },
            vAxis: {
                title: 'City'
            },
            bars: 'horizontal'
        };
        var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
        materialChart.draw(data, materialOptions);
    }
</script>
