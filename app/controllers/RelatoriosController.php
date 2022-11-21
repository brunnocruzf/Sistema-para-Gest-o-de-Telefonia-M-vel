<?php


namespace app\controllers;

use app\models\RelatoriosModel;
use League\Csv\Writer;
use League\Csv\Reader;
use \PlugRoute\Http\Request;
use core\Controller;

class RelatoriosController extends Controller
{
    function instanciaRelModel(){
        return $relModel = new RelatoriosModel();
    }

    function index()
    {
        $this->view('Relatorios/Relatorios');
    }

    function relatoriosFat()
    {
        $relModel = new RelatoriosModel();
        $dadosFat = $relModel->fatGrid();
        $this->view('Relatorios/RelatoriosFat', ['dadosFat' => $dadosFat]);
    }

    function datesFat(){
        return $this->instanciaRelModel()->datesFat();
    }



    function maiorConsumo(){
        return $this->view('Relatorios/MaiorConsumo',['dates'=>$this->consumos()]);
    }

    function consumos(){
        $mes = $this->datesFat();
        //$this->instanciaRelModel()->topConsumoMes();
        $consumo = array();
        foreach ($mes as $m){
            array_push($consumo, $this->instanciaRelModel()->topConsumoMes($m['date_fat']));
        }
        return json_encode($consumo);
    }

    function detalhesFat(Request $request)
    {
        $date = $request->parameter('date');
        $relModel = new RelatoriosModel();
        $valEmpresa = $relModel->buscaValorEmpresa($date);
        $valParticular = $relModel->buscaValorParticular($date);
        $valTotFat = $relModel->buscaValorTotEVencFat($date);
        $this->view('Relatorios/DetalhesFat', ['dateFat' => $date, 'valEmpresa' => $valEmpresa, 'valParticular' => $valParticular, 'valEmpresa' => $valEmpresa, 'valTotFat' => $valTotFat]);
    }

    function exportRateioCC(Request $request)
    {
        $date = $request->parameter('date');
        $relModel = new RelatoriosModel();
        $dadosRateio = $relModel->rateioCC($date);
        $valTotFat = $relModel->buscaValorTotEVencFat($date);
        $total = $valTotFat['valor_total'];

        $csv = Writer::createFromString('');
        $csv->setDelimiter(';');
        $csv->setOutputBOM(Reader::BOM_UTF8);
        $csv->insertOne([
            "Nome_CC",
            "Valor_Empresa",
            "Percentual_Empresa"
        ]);


        foreach ($dadosRateio as $dados) {
            str_replace('.',',',$dados['valorTipo']);
            $percent = ceil(($dados['valorTipo'] / $total) * 100) . '%';;
            $csv->insertOne([
                $dados['CC'],
                $dados['valorTipo'],
                $percent
            ]);
        }
        $csv->output('Rateio_Telefonia_' . $date . '.csv');
    }

    function exportRH(Request $request)
    {
        $date = $request->parameter('date');
        $relModel = new RelatoriosModel();
        $dadosRH = $relModel->exportRH($date);

        $csv = Writer::createFromString('');
        $csv->setOutputBOM(Reader::BOM_UTF8);

        foreach ($dadosRH as $dados) {

            $ano = substr($dados['date_fat'], 0, 4);
            $mes = (substr($dados['date_fat'], -2) + 1);
            if (strlen($mes) < 2) {
                $mes = '0' . $mes;
            }
            $matricula = $dados['matricula'];
            if (strlen($matricula) == 3) {
                $matricula = '0' . $matricula;
            } elseif (strlen($matricula) == 2) {
                $matricula = '00' . $matricula;
            }
            $valorFat = str_replace(".", "", $dados['valor']);
            $v1 = '0101';
            $v4 = '21';
            $v6 = '000000';
            $linha = $v1 . $ano . $mes . $v4 . $matricula . $v6 . $valorFat;

            $csv->insertOne([
                $linha
            ]);
        }
        $csv->output('export' . $date . '.txt');
    }

    function valorLinha(Request $request){
        $date = $request->parameter('date');
        $relModel = new RelatoriosModel();
        $dadosLinha = $relModel->valorLinha($date);

        $csv = Writer::createFromString('');
        $csv->setDelimiter(';');
        $csv->setOutputBOM(Reader::BOM_UTF8);
        $csv->insertOne([
            "Numero",
            "Matricula",
            "Nome",
            "CC",
            "Valor",
            "Data Vencimento",
        ]);

        foreach ($dadosLinha as $dados) {
            $csv->insertOne([
                $dados['linha'],
                $dados['matricula'],
                $dados['nome'],
                $dados['CC'],
                $dados['valor'],
                $dados['data_vencimento']
            ]);
        }
        $csv->output('ValorLinha_' . $date . '.csv');

    }
}