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
                        <center><h2>Contrato de telefonia móvel</h2></center><br>
                        <center><iframe style="width: 80%; height: 420px" src="<?php echo BASEURL_SGT.'app/views/fotos/contrato.pdf'?>"></iframe></center>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
<?php include(FOOTER_TEMPLATE); ?>
