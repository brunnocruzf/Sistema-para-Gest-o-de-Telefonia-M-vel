<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/sgt/config.php');
require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';

include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);

//require_once '../vendor/autoload.php';

use \app\controllers\FaturasController;

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
                        <i class="fa fa-file-pdf-o"></i>
                        Faturas - <?php echo formataTelefone($numero[0]['linha']); ?>
                    </h3>
                </div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="portlet">
                        <table
                                class="table table-striped table-bordered table-hover table-highlight table-checkable"
                                data-display-rows="15"
                                data-info="true"
                                data-paginate="true"
                        >
                            <thead>
                            <tr>
                                <th data-filterable="false" data-sortable="false">Opções</th>
                                <th data-filterable="true" data-sortable="true">Mês referência</th>
                                <th data-filterable="true" data-sortable="true" data-direction="asc">Pacotes</th>
                                <th data-filterable="true" data-sortable="true">Valor Total Fatura</th>
                                <th data-filterable="true" data-sortable="true">Valor Particular</th>
                                <th data-filterable="true" data-sortable="true">Valor Empresa</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($numero as $numero): ?>
                                <tr>
                                    <td>
                                        <center>
                                           <a href="../fatura/<?php echo $numero['linha'] . "/" . $numero['date_fat'] ?>"><i class="fa fa-folder-open-o ui-tooltip" data-toggle="tooltip" data-placement="top" title="Exibir Fatura" aria-hidden="true" style="color:#000000;"></i></a>
                                            <!--  <a href="../printFatura/<?php  //  echo $numero['linha'] . "/" . $numero['date_fat'] ?>"><i class="fa fa-file-pdf-o  ui-tooltip" data-toggle="tooltip" data-placement="top" title="PDF" aria-hidden="true" style="color:black;"></i></a>-->
                                            <center>
                                    </td>
                                    <td>
                                        <?php $mes = substr($numero['date_fat'], -2);
                                            $ano = substr($numero['date_fat'], 0, 4);
                                            echo $mes . "/" . $ano;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $telcontroller = new FaturasController();
                                            echo $telcontroller->qtdePlanos($numero['linha'], $numero['date_fat']);
                                        ?>
                                    </td>
                                    <td><?php echo 'R$ ' . $numero['valor'] ?></td>
                                    <td><?php
                                        if ($telTipo == 'particular' || $telTipo == 'PARTICULAR') {
                                            echo 'R$ ' . $numero['valor'];
                                        } else {
                                            echo 'R$ 0,00';
                                        }
                                        ?></td>
                                    <td><?php
                                        if ($telTipo == 'empresa' || $telTipo == 'EMPRESA') {
                                            echo 'R$ ' . $numero['valor'];
                                        } else {
                                            echo 'R$ 0,00';
                                        }
                                        ?></td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                </div>
            </div> <!-- /.portlet -->
        </div> <!-- /.portlet-content -->
    </div> <!-- /.portlet -->
    </div>
    </div> <!-- /#content-container -->
<?php include(FOOTER_TEMPLATE); ?>