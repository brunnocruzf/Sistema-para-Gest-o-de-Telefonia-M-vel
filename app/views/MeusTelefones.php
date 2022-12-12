<?php
require_once('././config.php');

require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';

include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);
$_SESSION['menu'] = 'SGT';
//require_once '../vendor/autoload.php';

use \app\controllers\TelefonesController;

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
            <br>
            <div class="portlet">
                <div class="portlet-header">
                    <h3>
                        <i class="fa fa-phone-square" style="transform: rotate(90deg);"></i>
                            Minhas Linhas
                    </h3>
                </div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="portlet">
                        <table
                            class="table table-striped table-bordered table-hover table-highlight table-checkable"

                            data-display-rows="15"
                            data-info="false"
                            data-paginate="false"
                        >
                            <thead>
                            <tr>
                                <th data-filterable="false" data-sortable="false">Faturas</th>
                                <th data-filterable="false" data-sortable="true">Número</th>
                                <th data-filterable="false" data-sortable="true" data-direction="asc">Nome</th>
                                <th data-filterable="false" data-sortable="true">Matricula</th>
                                <th data-filterable="false" data-sortable="true">Plano</th>
                                <th data-filterable="false" data-sortable="true">CC</th>
                                <th data-filterable="false" data-sortable="true">Tipo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($telefones as $telefone): ?>
                                <tr>
                                    <td>
                                        <center>
                                            <a href="<?php echo BASEURL ?>faturas/<?php echo $telefone['linha'] ?>"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:black;"></i></a>
                                        </center>
                                    </td>
                                    <td><input type="hidden" value="" id="numero"><?php echo $telefone['linha'] ?></td>
                                    <td><?php echo $telefone['nome'] ?></td>
                                    <td><?php echo $telefone['matricula'] ?></td>
                                    <td><?php echo $telefone['plano'] ?></td>
                                    <td><?php
                                        $telcontroller = new TelefonesController();
                                        $CCLinha = $telcontroller->buscaCClinha($telefone['linha']);

                                        if($telefone['cc_descricao'] == ''){
                                            echo $CCLinha['cc'];
                                        }else{
                                            echo $telefone['cc_descricao'];
                                        }
                                        ?></td>
                                    <td><?php echo $telefone['tipo'] ?></td>
                                    <!-- <td style="display: none"></td>-->
                                </tr>
                            <?php endforeach ?>

                            </tbody>
                        </table>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php include(FOOTER_TEMPLATE); ?><?php
