<?php
require_once($_SERVER['DOCUMENT_ROOT'].'\sgt\config.php');
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
            <h1>SISTEMA DE GESTÃO DE TELEFONIA</h1>
        </div> <!-- #content-header -->
        <div id="content-container">
            <div class="portlet">
                <div class="portlet-header">
                    <h3>
                        <i class="fa fa-line-chart"></i>
                        SISTEMA DE GESTÃO DE TELEFONIA
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
                                <th data-filterable="true" data-sortable="true" data-direction="asc">Mês referência</th>
                                <th data-filterable="true" data-sortable="true">Valor</th>
                                <th data-filterable="true" data-sortable="true">Linhas</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($dadosFat as $dados): ?>
                                <tr>
                                    <td>
                                        <center>
                                            <a  href="faturas/<?php echo $dados['date_fat'] ?>"><button class="btn btn-sm">Detalhes</button></a>
                                        <center>
                                    </td>
                                    <td>
                                        <?php
                                            $mes = substr($dados['date_fat'], -2);
                                            $ano = substr($dados['date_fat'], 0, 4);
                                            echo $mes . "/" . $ano;
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo 'R$ '.$dados['valor_total']; ?>
                                    </td>
                                    <td>
                                        <?php echo $dados['qntlinhas']; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
<?php include(FOOTER_TEMPLATE); ?><?php
