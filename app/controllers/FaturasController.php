<?php


namespace app\controllers;

use core\Controller;
use app\models\FaturasModel;
use app\models\UsuariosModel;
use app\models\TelefonesModel;
use \Mpdf\Mpdf;
use \PlugRoute\Http\Request;

class FaturasController extends Controller
{
    public $request;

    function index(Request $request)
    {
        $numero = $request->parameter('nro');
        $fatModel = new FaturasModel();

        $grid = $fatModel->buscaGrid($numero);
        $tel = new TelefonesModel();

        $dadosTel = $tel->buscaTelefone($numero);
        $telTipo = $dadosTel['tipo'];

        $this->view("Relatorios/GridFaturas", ['numero' => $grid, 'telTipo' => $telTipo]);
    }

    function qtdePlanos($numero, $date)
    {
        $fatModel = new FaturasModel();
        $infoPlano = $fatModel->buscaInfoPlano($numero, $date);
        return $qtdePlanos = count($infoPlano);
    }

    function viewFatura(Request $request)
    {
        $numero = $request->parameter('nro');
        $date = $request->parameter('date');

        $fatModel = new FaturasModel();
     //   $dados = $fatModel->buscaChamadas($numero, $date);
        if(count($fatModel->buscaChamadas($numero, $date))> 0){
            $dados = $fatModel->buscaChamadas($numero, $date);
        }else{
            $dados = "Sem registros de consumo";
        }
        $valorTotal = $fatModel->buscaValorTotal($numero, $date);
        $infoPlano = $fatModel->buscaInfoPlano($numero, $date);
        $resumoPlano = $fatModel->buscaResumo($numero, $date);

        $telModel = new TelefonesModel();
        $matricula = $telModel->buscaMatricula($numero);
        $dadosTel = $telModel->buscaTelefone($numero);

        $userModel = new UsuariosModel();
        if($matricula <> false){
            $nomeUser = $userModel->buscaNome($matricula[0]);
        }else{
            $nomeUser = "Nome não informado.";
        }
        $this->view("Relatorios/fatura", ['date'=>$date,'numero'=>$numero,'chamadas' => $dados, 'nomeUser' => $nomeUser, 'valorTotal' => $valorTotal, 'infoPlano' => $infoPlano, 'resumoPlano' => $resumoPlano, 'dadosTel' => $dadosTel]);
    }

    function printFatura(Request $request)
    {
        //error_reporting(0);
        //ini_set('display_errors', 0);
        $numero = $request->parameter('nro');
        $date = $request->parameter('date');

        $fatModel = new FaturasModel();
        $dados = $fatModel->buscaChamadas($numero, $date);
        $valorTotal = $fatModel->buscaValorTotal($numero, $date);
        $infoPlano = $fatModel->buscaInfoPlano($numero, $date);
        $resumoPlano = $fatModel->buscaResumo($numero, $date);

        $telModel = new TelefonesModel();
        $matricula = $telModel->buscaMatricula($numero);
        $dadosTel = $telModel->buscaTelefone($numero);

        $userModel = new UsuariosModel();
        $nomeUser = $userModel->buscaNome($matricula[0]);
        $html = '
        <div class="portlet">
                        <style type="text/css">

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
                        <div style="width:98%;" id="fatura" class="fatura">


                            <table width="100%" cellspacing="0" class="fontes cabecalho titulo_superior borda_redonda">
                                <tbody>
                                <tr>
                                    <td>
                                        Demonstrativo da Cobrança de Serviços de Telecomunicações
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table width="100%" cellspacing="0" class="fontes cabecalho borda_redonda" style="margin-top:15px;">
                                <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="dados_cliente">
                                            AXOON TMSA<br>
                                            Av. Bernardino S. Pastoriza, 710<br>
                                            Sarandi<br>
                                            91160310 AXOON TMSA - RS
                                        </div>

                                        <div class="dados_conta">
                                            <table class="cabecalho">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <nobr>Período de Referência:</nobr>
                                                    </td>
                                                    <td><b>';

                                                             $mes = substr($dados[0]['date_fat'], -2);
                                                            $ano = substr($dados[0]['date_fat'], 0, 4);

                                                            $proxMes = ($mes + 1);

                                                            if (strlen($proxMes) < 2) {
                                                                $proxMes = '0' . $proxMes;
                                                            }

                                                            $html .='02/'. $mes . '/' . $ano . 'a 01/' .$proxMes. '/' . $ano.'
                                                            
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>Mês de referência:</td>
                                                    <td><b>';
                                                            $mes = substr($dados[0]['date_fat'], -2);
                                                            $ano = substr($dados[0]['date_fat'], 0, 4);
                                                            $html .= $mes . '/' . $ano.'
                                                            
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>Número:</td>
                                                    <td><b> '.$dados[0]['linha'].' </b></td>
                                                </tr>
                                                <tr>
                                                    <td>Nome:</td>
                                                    <td><b>'.$nomeUser['nome'].'</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Valor Total da Fatura:</td>
                                                    <td><b>R$ '. $valorTotal['valor'].'
                                                </tr>
                                                <tr>
                                                            
                                                    <td>Valor da Empresa:</td>
                                                    <td><b>';$telTipo = $dadosTel['tipo'];
                                                            if ($telTipo == 'empresa' || $telTipo == 'EMPRESA') :
                                                               $html .= 'R$ ' . $valorTotal['valor'];
                                                            else:
                                                                $html .= 'R$ 0,00';
                                                            endif;
                                                            $html .='</b></td>
                                                </tr>
                                                <tr>
                                                            
                                                    <td>Valor Particular:</td>
                                                    <td><b>';
                                                            $telTipo = $dadosTel['tipo'];
                                                            if ($telTipo == 'particular' || $telTipo == 'PARTICULAR') :
                                                                $html .= 'R$'. $valorTotal['valor'];
                                                            else:
                                                                $html .='R$ 0,00';
                                                            endif;
                                                   $html .= '</b></td>
                                                            
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <table width="100%" cellspacing="0" class="fontes borda_redonda pacotes_e_lancamentos">

                                <tbody>
                                <tr>
                                    <td colspan="5" class="titulo2">INFORMAÇÕES DO PLANO</td>
                                </tr>
                                <tr>
                                    <td class="titulo3" colspan="2" align="left" width="45%">Nome</td>
                                    <td class="titulo3" align="left" width="25%">Período</td>
                                    <td class="titulo3" align="left" width="15%">Custo</td>
                                    <td class="titulo3" align="right" width="15%">Valor</td>
                                </tr>';
                                    $total = 0;
                                    foreach ($infoPlano as $info):
                                      $html .= '<tr>
                                            <td class="registro" colspan="2" align="left">'.$info['descricao'].'</td>
                                            <td class="registro" align="left">
                                                <nobr>'
                                                    .$mes = substr($dados[0]['date_fat'], -2);
                                                    $ano = substr($dados[0]['date_fat'], 0, 4);

                                                    $proxMes = ($mes + 1);

                                                    if (strlen($proxMes) < 2) {
                                                        $proxMes = '0' . $proxMes;
                                                    }

                                                  $html .=  '02/' . $mes . '/' . $ano . ' a 01/' . $proxMes . '/' . $ano.'


                                                </nobr>
                                            </td>

                                            <td class="registro" align="left">
                                                <nobr>';

                                                        $telTipo = $dadosTel['tipo'];
                                                        if ($telTipo == 'empresa' || $telTipo == 'EMPRESA') {
                                                            $html .= "EMPRESA";
                                                        } elseif($telTipo == 'particular' || $telTipo == 'PARTICULAR') {
                                                             $html .=  "PARTICULAR";
                                                        }


                                             $html .= ' </nobr>
                                            </td>
                                            <td class="registro" align="right">'.$info['valor'] .'</td>
                                        </tr>';

                                        $total = $total + $info['valor'];
                                    endforeach;


                        $html .= '
                                    <tr>
                                        <td class="valor_total" colspan="4" width="75%">TOTAL:</td>
                                        <td class="valor_total" align="right" width="25%">R$ '. $total.'</td>
                                    </tr>

                                    </tbody>
                                </table>

                                <br>
                                <table width="70%" class="fontes borda_redonda resumo">
                                    <tbody>
                                    <tr>
                                        <td colspan="3" class="titulo2">
                                            RESUMO DO CONSUMO DA FATURA
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="titulo3" align="left" width="70%">Gerenciamento</td>
                                        <td class="titulo3" align="right" width="15%">Duração</td>
                                        <td class="titulo3" align="right" width="15%">Valor</td>
                                    </tr>';

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

                                            foreach ($resumoPlano as $resumo):
                                        $html .='        <tr>
                                                    <td class="registro" align="left">'.print_r($resumo['desc_categoria']).'</td>
                                                    <td class="registro" align="right">'.
                                                       mintohora($resumo['totChamadas']).'
                                                    </td>
                                                    <td class="registro" align="right">';
                                                        $valor = $resumo['valorTot'];
                                                        if (strlen($valor) < 4) {
                                                            $valor = 'R$ 0' . $valor;
                                                        }
                                                        $html .= $valor;


                                                        $html .= '</td>
                                                </tr>';

                                            endforeach;

                                           $html .=' <tr>
                                                <td class="valor_total" colspan="2" width="75%">TOTAL</td>
                                                <td class="valor_total" align="right" width="25%">R$ 0,00</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <br><br>';



                                         $html .='   <table width="100%" cellspacing="0" class="fontes gerenciamentos">
                                                <tbody>
                                                <tr>
                                                    <td colspan="7" class="titulo2">
                                                        DETALHAMENTO DE CONSUMO DA FATURA
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="titulo3" align="left">Data/hora início</td>
                                                    <td class="titulo3" align="center">Tipo</td>
                                                    <td class="titulo3" align="center">Número destino</td>
                                                    <td class="titulo3" align="center">Duração</td>
                                                    <td class="titulo3" align="right">Valor</td>
                                                </tr>';
        /*

                                                       foreach ($dados as $chamada):
                                                               $html .='<tr>
                                                                    <td class="registro" align="left">
                                                                        '.$chamada['data_hora_inicio'].'
                                                                    </td>
                                                                    <td class="registro" align="center">'.$chamada['desc_categoria'].'</td>
                                                                    <td class="registro" align="center">'. $chamada['nro_telefone_chamado'] .'</td>
                                                                    <td class="registro" align="center">'. mintohora($chamada['duracao_ligacao']) .'</td>
                                                                    <td class="registro" align="right">';

                                                                        $valorLig = $chamada['valor_ligacao'];
                                                                        if (strlen($valorLig) < 4) {
                                                                            $valorLig = 'R$ 0'. $valorLig;
                                                                        }
                                                                        $html .= $valorLig;

                                                                      $html .= '</td>
                                                                </tr>';
                                                             endforeach;
                                                            $html = '<tr>
                                                                <td colspan="7">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="titulo2" colspan="5">
                                                                    TOTAL CONSUMO:
                                                                </td>
                                                                <td align="center" class="titulo2">00:00</td>
                                                                <td align="right" class="titulo2">
                                                                    <nobr>R$ 0,00</nobr>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>';


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


                                                                  </div>
                                                                  <div class='clear'></div>
                                                              </div>
                                                          </div> /.portlet -->
                                                          */






        $mpdf=new mPDF();
        $mpdf->SetDisplayMode('fullpage');
        // $css = file_get_contents("css/estilo.css");
        // $mpdf->WriteHTML($css,1);
        ob_clean();
        $mpdf->WriteHTML($html);
        $mpdf->Output();

        exit;
    }
}