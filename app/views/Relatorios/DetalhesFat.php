<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/sgt/config.php');
require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';
include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);

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
            <a href="../exportRateio/<?php echo $dateFat; ?>" class="btn btn-sm btn-success" style="margin-bottom: 15px"><i class="fa fa-file-excel-o" style="margin-right: 10px"></i>Exportar Rateio CC</a>
            <a href="../exportRH/<?php echo $dateFat; ?>" class="btn btn-sm btn-success" style="margin-bottom: 15px"><i class="fa fa-file-excel-o" style="margin-right: 10px"></i>Exportar para RH</a>
            <a href="../valorLinha/<?php echo $dateFat; ?>" class="btn btn-sm btn-success" style="margin-bottom: 15px"><i class="fa fa-file-excel-o" style="margin-right: 10px"></i>Exportar Valor por linha</a>
            <div class="portlet">
                <div class="portlet-header">
                    <h3><span  class="badge" style="background-color: #bdbdbd; padding-left: 11px; padding: 5px" onclick="history.back()"><i class="fa fa-arrow-left"></i></span>
                        <i class="fa fa-table"></i>
                        Fatura - <?php $mes = substr($dateFat, -2);
                        $ano = substr($dateFat, 0, 4);
                        echo $mes . "/" . $ano;
                        ?>
                    </h3>
                </div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="portlet">
                        <div style="float: left">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="background-color: #fcfcfc">Mês Referência</th>
                                    <td>
                                        <?php $mes = substr($dateFat, -2);
                                        $ano = substr($dateFat, 0, 4);
                                        echo $mes . "/" . $ano;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="background-color: #fafafa">Período Referência</th>
                                    <td>
                                        <?php
                                        $mes = substr($dateFat, -2);
                                        $ano = substr($dateFat, 0, 4);
                                        echo "02/" . str_pad(($mes - 1),2 , '0' , STR_PAD_LEFT) . "/" . $ano . " a 01/" . $mes . "/" . $ano;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="background-color: #fafafa">Empresa referente</th>
                                    <td>ACME SA</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #fafafa">Conta referente</th>
                                    <td>Conta 1</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #fafafa">Valor total da fatura</th>
                                    <td><?php echo  "R$ ".number_format($valTotFat['valor_total'],2,",","."); ?></td>
                                </tr>
                                <tr>
                                    <th style="background-color: #fafafa">Valor Fatura Particular</th>
                                    <td>
                                        <?php
                                            if(empty($valParticular['valorTipo'])){
                                                echo 'N/A';
                                            }else{
                                                echo  "R$ ".number_format($valParticular['valorTipo'],2,",",".");
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="background-color: #fafafa">Valor Fatura Empresa</th>
                                    <td>
                                        <?php
                                            if(empty($valParticular['valorTipo'])){
                                                echo 'N/A';
                                            }else{
                                                echo  "R$ ".number_format(($valTotFat['valor_total'] - $valParticular['valorTipo']),2,",",".");
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="background-color: #fafafa">Data vencimento boleto Operadora</th>
                                    <td><?php
                                            $valorVenc = explode("-", $valTotFat['data_vencimento']);
                                            echo $valorVenc[2] . "/" . $valorVenc[1] . "/" . $valorVenc[0];
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
<?php include(FOOTER_TEMPLATE); ?><?php
