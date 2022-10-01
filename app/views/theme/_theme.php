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

                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
<?php include(FOOTER_TEMPLATE); ?>