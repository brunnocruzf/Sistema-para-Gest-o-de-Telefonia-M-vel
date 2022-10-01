<?php

namespace app\controllers;
use app\models\CelularesModel;
use core\Controller;
use \PlugRoute\Http\Request;

class CelularesController extends Controller
{
    function celulares(){
        $celModel = new CelularesModel();
        $celulares = $celModel->celulares();
        $this->view("Celulares/Celulares", ['celulares' => $celulares]);
    }
    function novoCelulares(){
        $mensagem = '';
        if (!empty($_POST)) {
            $celModel = new CelularesModel();
            $dados = $_POST;
            //Verifica se Celulares ja está cadastrado (Retorna quantidade de linhas se > )
            $seExiste = $celModel->buscaCel($_POST['IMEI1'], $_POST['IMEI2'], $_POST['nroSerie']);
            if ($seExiste == 0) {
                $mensagem = $celModel->inserirCelular($dados);
                unset($_POST);
            } else {
                $mensagem = "<div class='alert alert-danger' role='alert'>Celular ja casatrado</div>";
                unset($_POST);
            }
        }
        $this->view("Celulares/NovoCelulares", ['mensagem' => $mensagem]);
    }
    function delete(Request $request){
        $numero = $request->parameter('nro');
        $celModel = new CelularesModel();
        $celModel->deleteCelular($numero);

        $results = array('mensagem' => 'Excluido com sucesso!');
        echo json_encode($results);
    }
    function foto(){
        $this->view("upload_foto");
    }
    function editCelular(Request $request){
        $numero = $request->parameter('nro');
        $celModel = new CelularesModel();
        $celulares = $celModel->buscaPorId($numero);
        $this->view("Celulares/EditCelular", ['celulares' => $celulares]);
    }
    function editSaveCelular(){
        $celModel = new CelularesModel();
        $celulares = $celModel->editSaveCelular($_POST);
        header('Location: '.BASEURL.'celulares');
    }
}