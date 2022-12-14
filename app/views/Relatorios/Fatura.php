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
            <button type="button" id="imprime" style="margin-bottom: 20px" class="btn btn-light"><i class="fa fa-print" style="margin-right: 7px" aria-hidden="true"></i>Imprimir</button>
            <div class="portlet">
                <div class="portlet-header">
                    <h3><span  class="badge" style="background-color: #bdbdbd; padding-left: 11px; padding: 5px" onclick="history.back()"><i class="fa fa-arrow-left"></i></span>
                        <i class="fa fa-file-pdf-o"></i>
                        Fatura - <?php echo formataTelefone($numero) ?>
                    </h3>
                </div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="portlet">
                        <style type='text/css'>

                            /*Same as body*/
                            * {
                                margin: 0;
                                padding: 0;
                                font-family: Verdana, Arial;
                                color: #333;
                            }

                            .fatura {
                            }

                            .fontes {
                                font-family: Verdana, Arial, Helvetica, sans-serif;
                            }

                            .cabecalho {
                                font-size: 16px;
                            }

                            .titulo_superior {
                                font-size: 25px;
                                font-weight: bold;
                                text-align: center;
                                vertical-align: middle;
                                height: 80px;
                            }

                            .logotipo {
                                text-align: center;
                                width: 25%;
                                height: 100px;
                                float: left;
                            }

                            .pacotes_e_lancamentos {
                                font-size: 16px;
                                line-height: 16px;
                            }

                            .resumo {
                                line-height: 16px;
                                padding: 13px;
                            }

                            .gerenciamentos {
                            }

                            .gerenciamento_tipo {
                                padding: 10px;
                                border: 2px solid;
                                border-radius: 25px;
                            }

                            .borda_redonda {
                                padding: 10px;
                                border: 2px solid;
                                border-radius: 25px;
                            }

                            .dados_cliente_conta {
                                padding: 10px;
                                border: 2px solid;
                                border-radius: 25px;
                                min-height: 100px;
                                margin-top: 15px;
                            }

                            .dados_cliente {
                                width: 45%;
                                height: 100%;
                                float: left;
                                text-align: left;
                                vertical-align: middle;
                                line-height: 22px;
                            }

                            .dados_conta {
                                width: 50%;
                                height: 100%;
                                float: left;
                                text-align: left;
                                vertical-align: middle;
                                line-height: 22px;
                                margin-left: 25px;
                            }

                            .titulo1 {
                                font-size: 16px;
                                font-weight: bold;
                                border-bottom-style: solid;
                                border-bottom-color: #000000;
                                border-bottom-width: 1px;
                                line-height: 22px
                            }

                            .titulo2 {
                                font-size: 15px;
                                font-weight: bold;
                                border-bottom-style: solid;
                                border-bottom-color: #000000;
                                border-bottom-width: 1px;
                                line-height: 22px
                            }

                            .titulo3 {
                                font-size: 15px;
                                font-weight: bold;
                            }

                            .registro {
                                font-size: 13px;
                            }

                            .registro_detalhe {
                                font-size: 10px;
                                font-style: italic;
                            }

                            .valor_total {
                                font-size: 13px;
                                font-weight: bold;
                                border-top-style: solid;
                                border-top-color: #000000;
                                border-top-width: 1px;
                            }
                        </style>
                        <div style='width:98%;' id="fatura" class='fatura'>


                            <table width='100%' cellspacing='0' class='fontes cabecalho titulo_superior borda_redonda'>
                                <tbody>
                                <tr>
                                    <td>
                                        Demonstrativo da Cobrança de Serviços de Telecomunicações
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table width='100%' cellspacing='0' class='fontes cabecalho borda_redonda' style='margin-top:15px;'>
                                <tbody>
                                <tr>
                                    <td colspan='2'>
                                        <div class='dados_cliente'>
                                            Conta 1<br>
                                            Av. Rua da. Empresa, 710<br>
                                            Bairro<br>
                                            91130210 ACME - RS
                                        </div>
                                        <div class='dados_conta'>
                                            <table class='cabecalho'>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <nobr>Período de Referência:</nobr>
                                                    </td>
                                                    <td><b>
                                                            <?php $mes = substr($date, -2);
                                                            $ano = substr($date, 0, 4);

                                                            if($mes == 12){
                                                                $proxMes = 01;
                                                                $proxAno = ($ano + 1);
                                                            }else{
                                                                $proxMes = ($mes - 1);
                                                                $proxAno = $ano;
                                                            }

                                                            if (strlen($proxMes) < 2) {
                                                                $proxMes = '0' . $proxMes;
                                                            }
                                                            if (strlen($mes) < 2) {
                                                                $mes = '0' . $mes;
                                                            }


                                                            echo "02/" . $proxMes . "/" . $ano . " a 01/" .$mes. "/" . $proxAno;
                                                            ?>
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>Mês de referência:</td>
                                                    <td><b>
                                                            <?php $mes = substr($date, -2);
                                                            $ano = substr($date, 0, 4);
                                                            echo $mes . "/" . $ano;
                                                            ?>
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>Número:</td>
                                                    <td><b><?php echo formataTelefone($numero) ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Nome:</td>
                                                    <td><b><?php  if($nomeUser== "Nome não informado."){
                                                              echo "Nome não informado.";
                                                            } else{
                                                                  echo $nomeUser['nome'];
                                                            } ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Valor Total da Fatura:</td>
                                                    <td><b><?php
                                                            echo "R$ " . $valorTotal['valor']
                                                            ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Valor da Empresa:</td>
                                                    <td><b><?php
                                                            $telTipo = $dadosTel['tipo'];
                                                            if ($telTipo == 'empresa' || $telTipo == 'EMPRESA') {
                                                                echo "R$ " . $valorTotal['valor'];
                                                            }else{
                                                                echo 'R$ 0,00';
                                                            } ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Valor Particular:</td>
                                                    <td><b><?php
                                                            $telTipo = $dadosTel['tipo'];
                                                            if ($telTipo == 'particular' || $telTipo == 'PARTICULAR') {
                                                                echo "R$ " . $valorTotal['valor'];
                                                            }else{
                                                                echo 'R$ 0,00';
                                                            }
                                                            ?></b></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>


                            <table width='100%' cellspacing='0' class='fontes borda_redonda pacotes_e_lancamentos'>

                                <tbody>
                                <tr>
                                    <td colspan='5' class='titulo2'>INFORMAÇÕES DO PLANO</td>
                                </tr>
                                <?php if($chamadas == "Sem registros de consumo"):
                                            echo "<tr><td class='titulo3'> Sem registros de consumo</td></tr>";
                                        else:
                                ?>
                                <tr>
                                    <td class='titulo3' colspan='2' align='left' width='45%'>Nome</td>
                                    <td class='titulo3' align='left' width='25%'>Período</td>
                                    <td class='titulo3' align='left' width='15%'>Custo</td>
                                    <td class='titulo3' align='right' width='15%'>Valor</td>
                                </tr>

                                <?php $total = 0;
                                foreach ($infoPlano as $info): ?>
                                    <tr>
                                        <td class='registro' colspan='2' align='left'> <?php echo $info['descricao'] ?> </td>
                                        <td class='registro' align='left'>
                                            <nobr>
                                                <?php $mes = substr($chamadas[0]['date_fat'], -2);
                                                $ano = substr($chamadas[0]['date_fat'], 0, 4);

                                                $proxMes = ($mes + 1);

                                                if (strlen($proxMes) < 2) {
                                                    $proxMes = '0' . $proxMes;
                                                }

                                                echo "02/" . $mes . "/" . $ano . " a 01/" . $proxMes . "/" . $ano;
                                                ?>
                                            </nobr>
                                        </td>
                                        <td class='registro' align='left'>
                                            <nobr>
                                                <?php
                                                    $telTipo = $dadosTel['tipo'];
                                                    if ($telTipo == 'empresa' || $telTipo == 'EMPRESA') {
                                                        echo "EMPRESA";
                                                    } elseif($telTipo == 'particular' || $telTipo == 'PARTICULAR') {
                                                        echo "PARTICULAR";
                                                    }
                                                ?>

                                            </nobr>
                                        </td>
                                        <td class='registro' align='right'><?php echo $info['valor'] ?></td>
                                    </tr>
                                    <?php
                                    $total = $total + $info['valor'];
                                endforeach; ?>

                                <tr>
                                    <td class='valor_total' colspan='4' width='75%'>TOTAL:</td>
                                    <td class='valor_total' align='right' width='25%'><?php echo "R$ " . $total ?></td>
                                </tr>

                                </tbody>
                                <?php
                                    endif;
                                ?>
                            </table>


                            <!--

                            <br>
                            <table width='70%' class='fontes borda_redonda resumo'>
                            <tr>
                                <td colspan='3' class='titulo2'>
                    RESUMO DA FRANQUIA UTILIZADA
                    </td>
                            </tr>
                                <tr>
                                <td class='titulo3' align='left' width='70%'>Gerenciamento</td>
                                <td class='titulo3' align='right' width='15%'>Duração</td>
                                <td class='titulo3' align='right' width='15%'>Valor</td>
                                </tr>

                                            <tr>
                                <td class='registro' align='left'>PARA CELULARES DE OUTRAS OPERADORAS</td>
                                <td class='registro' align='right'>3:08</td>
                                <td class='registro' align='right'>R$ 0,00</td>
                                </tr>
                                            <tr>
                                <td class='registro' align='left'>PARA CELULARES VIVO</td>
                                <td class='registro' align='right'>7:37</td>
                                <td class='registro' align='right'>R$ 0,00</td>
                                </tr>
                                            <tr>
                                <td class='registro' align='left'>PARA FIXO DE OUTRAS OPERADORAS</td>
                                <td class='registro' align='right'>6:18</td>
                                <td class='registro' align='right'>R$ 0,00</td>
                                </tr>
                                            <tr>
                                <td class='registro' align='left'>PARA FIXO VIVO</td>
                                <td class='registro' align='right'>1:47</td>
                                <td class='registro' align='right'>R$ 0,00</td>
                                </tr>
                                            <tr>
                                <td class='registro' align='left'>GRATIS-SMS</td>
                                <td class='registro' align='right'>1:00</td>
                                <td class='registro' align='right'>R$ 0,00</td>
                                </tr>
                                            <tr>
                                <td class='registro' align='left'>INTERNET MOVEL 2</td>
                                <td class='registro' align='right'>768,44</td>
                                <td class='registro' align='right'>R$ 0,00</td>
                                </tr>


                            </table>


                            <br>
                            <table width='70%' class='fontes borda_redonda resumo'>
                            <tr>
                                <td colspan='3' class='titulo2'>
                    RESUMO DO CONSUMO EXCEDENTE
                    </td>
                            </tr>
                                <tr>
                                <td class='titulo3' align='left' width='70%'>Gerenciamento</td>
                                <td class='titulo3' align='right' width='15%'>Duração</td>
                                <td class='titulo3' align='right' width='15%'>Valor</td>
                                </tr>



                            </table>

                    -->

                            <br>
                            <table width='70%' class='fontes borda_redonda resumo'>
                                <tbody>
                                <tr>
                                    <td colspan='3' class='titulo2'>
                                        RESUMO DO CONSUMO DA FATURA
                                    </td>
                                </tr>
                                <tr>
                                    <td class='titulo3' align='left' width='70%'>Gerenciamento</td>
                                    <td class='titulo3' align='right' width='15%'>Duração</td>
                                    <td class='titulo3' align='right' width='15%'>Valor</td>
                                </tr>

                                <?php

                                function mintohora($minutos)
                                {

                                    $hora = floor($minutos / 60);
                                    $resto = $minutos % 60;
                                    if (strlen($resto) < 2) {
                                        $resto = '0' . $resto;
                                    }
                                    if (strlen($hora) < 2) {
                                        $hora = '0' . $hora;
                                    }

                                    return $hora . ':' . $resto;
                                }

                                foreach ($resumoPlano as $resumo): ?>
                                    <tr>
                                        <td class='registro' align='left'><?php print_r($resumo['desc_categoria']) ?></td>
                                        <td class='registro' align='right'>
                                            <?php
                                            echo mintohora($resumo['totChamadas'])
                                            ?>

                                        </td>
                                        <td class='registro' align='right'><?php
                                            $valor = $resumo['valorTot'];
                                            if (strlen($valor) < 4) {
                                                $valor = 'R$ 0' . $valor;
                                            }
                                            echo $valor;


                                            ?></td>
                                    </tr>

                                <?php endforeach; ?>
                                <tr>
                                    <td class='valor_total' colspan='2' width='75%'>TOTAL:</td>
                                    <td class='valor_total' align='right' width='25%'>R$ 0,00</td>
                                </tr>

                                </tbody>
                            </table>
                            <br><br>


                            <table width='100%' cellspacing='0' class='fontes gerenciamentos'>
                                <tbody>
                                <tr>
                                    <td colspan='7' class='titulo2'>
                                        DETALHAMENTO DE CONSUMO DA FATURA
                                    </td>
                                </tr>
                                <?php if($chamadas == "Sem registros de consumo"):
                                    echo "<tr><td class='titulo3'> Sem registros de consumo</td></tr>";
                                else:
                                ?>
                                <tr>
                                    <td class='titulo3' align='left'>Data/hora início</td>
                                    <td class='titulo3' align='center'>Tipo</td>
                                    <td class='titulo3' align='center'>Número destino</td>
                                    <td class='titulo3' align='center'>Duração</td>
                                    <td class='titulo3' align='right'>Valor</td>
                                </tr>
                                <?php foreach ($chamadas as $chamada): ?>
                                    <tr>
                                        <td class='registro' align='left'>
                                            <?php echo $chamada['data_hora_inicio'] ?>
                                        </td>
                                        <td class='registro' align='center'><?php echo $chamada['desc_categoria'] ?></td>
                                        <td class='registro' align='center'><?php echo $chamada['nro_telefone_chamado'] ?></td>
                                        <td class='registro' align='center'><?php echo mintohora($chamada['duracao_ligacao']) ?></td>
                                        <td class='registro' align='right'><?php
                                            $valorLig = $chamada['valor_ligacao'];
                                            if (strlen($valorLig) < 4) {
                                                $valorLig = 'R$ 0' . $valorLig;
                                            }
                                            echo $valorLig;

                                            ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan='7'>&nbsp;</td>
                                </tr>

                                <tr>
                                    <td class='titulo2' colspan='5'>
                                        TOTAL CONSUMO:
                                    </td>
                                    <td align='center' class='titulo2'>00:00</td>
                                    <td align='right' class='titulo2'>
                                        <nobr>R$ 0,00</nobr>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <table width='100%' cellspacing='0' class='fontes'>
                                <tbody>
                                <tr>
                                    <td colspan='5'>&nbsp;</td>
                                </tr>

                                <tr>
                                    <td colspan='4' align='left' class='titulo2' width='75%'>
                                        TOTAL FATURA:
                                    </td>
                                    <td align='right' class='titulo2' width='25%'><?php echo "R$ " . $valorTotal['valor'] ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <?php endif;?>

                        </div>
                        <div class='clear'></div>
                    </div>
                </div> <!-- /.portlet -->
            </div> <!-- /.portlet-content -->
        </div> <!-- /.portlet -->
    </div>
    </div> <!-- /#content-container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="http://localhost:8080/portaldev/includes/jquery.printElement.js" type="text/javascript"></script>

    <script type="text/javascript">
        $('#imprime').click(function () {
            $('#fatura').printThis({
                debug: false, // show the iframe for debugging
                importCSS: true, // import parent page css
                importStyle: true, // import style tags
                printContainer: true, // print outer container/$.selector
                loadCSS: "", // path to additional css file - use an array [] for multiple
                pageTitle: "", // add title to print page
                removeInline: false, // remove inline styles from print elements
                removeInlineSelector: "*", // custom selectors to filter inline styles. removeInline must be true
                printDelay: 222, // variable print delay
                header: null, // prefix to html
                footer: null, // postfix to html
                base: true, // preserve the BASE tag or accept a string for the URL
                formValues: true, // preserve input/form values
                canvas: false, // copy canvas content
                doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
                removeScripts: false, // remove script tags from print content
                copyTagClasses: true, // copy classes from the html & body tag
                beforePrintEvent: null, // callback function for printEvent in iframe
                beforePrint: null, // function called before iframe is filled
                afterPrint: null // function called before iframe is removed

            });

        });
    </script>
<?php include(FOOTER_TEMPLATE); ?>