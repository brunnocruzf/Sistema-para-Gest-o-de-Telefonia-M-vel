<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/sgt/config.php');
require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';

include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);
$_SESSION['menu'] = 'SGT';
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
                    <h3>
                        <i class="fa fa-line-chart"></i>
                        Relatórios
                    </h3>
                </div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="portlet">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6 col-md-1">
                                    <a href="relatorios/faturas" class="btn btn-default btn-lg" role="button"><i class="glyphicon glyphicon-list-alt"></i> <br/>Relatórios de <br/> Faturas<br/></a>
                                </div>

                                <div class="col-lg-1"></div>

                                <div class="col-xs-6 col-md-1" style="padding-left: 0px;">
                                    <a href="relatorios/maiorConsumo" class="btn btn-default btn-lg" role="button"><i class="fa fa-bar-chart" aria-hidden="true"></i> <br/>Linhas com <br> maior consumo</a>
                                </div>

                                <div class="col-lg-1"></div>

                                <div class="col-xs-6 col-md-1">
                                    <a href="relatorios/celularesporcc" class="btn btn-default btn-lg" role="button"><i class="fa fa-mobile" aria-hidden="true"></i> <br/>Quantidade de<br> Celulares por CC</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
<?php include(FOOTER_TEMPLATE); ?>