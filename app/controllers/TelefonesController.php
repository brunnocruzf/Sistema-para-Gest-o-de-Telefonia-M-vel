<?php

namespace app\controllers;

use app\models\TelefonesModel;
use app\models\UsuariosModel;
use core\Controller;
use app\models\FaturasModel;
use \PlugRoute\Http\Request;

//require_once '../vendor/autoload.php';

class TelefonesController extends Controller
{
    function telefones()
    {
        $telefonesModel = new  TelefonesModel();
        $telefones = $telefonesModel->buscaTelefones();
        $this->view("Telefones", ['telefones' => $telefones]);
    }

    function novoTelefone()
    {
        $mensagem = '';
        if (!empty($_POST)) {
            $telModel = new TelefonesModel();
            $dados = $_POST;
            //Verifica se numero ja está cadastrado (Retorna quantidade de linhas se > )
            $seExiste = $telModel->buscaQntdTelefone($_POST['numero']);
            if ($seExiste == 0) {
                $mensagem = $telModel->inserirTelefone($dados);
            } else {
                $mensagem = "<div class='alert alert-danger' role='alert'>Linha já cadastrada</div>";
            }
        }
        $this->view("NovoTelefone", ['mensagem' => $mensagem]);
    }

    function editTelefone(Request $request)
    {
        $numero = $request->parameter('nro');
        $telModel = new TelefonesModel();
        $telefone = $telModel->buscaTelefone($numero);
        $userModel = new UsuariosModel();
        $CC = $userModel->buscaCC();
        $this->view("editTelefone", ['telefone' => $telefone, 'CCs' => $CC]);
    }

    function editSavalTelefone()
    {
        $telModel = new TelefonesModel();
        $dados = $_POST;
        $numero = $_POST['numero'];
        $telefone = $telModel->buscaTelefone($numero);
        $mensagem = $telModel->editarTelefone($dados);
        $this->view("editTelefone", ['telefone' => $telefone, 'mensagem' => $mensagem]);
    }

    function deleteTelefone(Request $request)
    {
        $numero = $request->parameter('nro');
        $fatModel = new FaturasModel();
        $seExiste = count($fatModel->buscaGrid($numero));

        if ($seExiste >= 1) {
            $results = array('mensagem' => 'Existem faturas associadas à esta linha, não é possivel excluir!');
            echo json_encode($results);
        } else {
            $telModel = new TelefonesModel();
            $telModel->deleteTelefone($numero);
            $results = array('mensagem' => 'Excluido com sucesso!');
            echo json_encode($results);
        }
    }

    function buscaCC()
    {
        $userModel = new UsuariosModel();
        return $userModel->buscaCC();
    }

    function buscaCClinha($numero)
    {
        $telModel = new TelefonesModel();
        return $telModel->buscaCC($numero);
    }

    function sincLinhas()
    {
        $telModel = new TelefonesModel();
        $linhas = $telModel->buscaSincLinhas();

        foreach ($linhas as $linha) {
            $numero = $linha['linha'];
            $seExiste = $telModel->buscaQntdTelefone($numero);
            if ($seExiste == 0) {
                $dados = array(
                    'empresa' => '',
                    'conta' => '',
                    'matricula' => '',
                    'CC' => '',
                    'numero' => $numero,
                    'iccid' => '',
                    'tipo' => '',
                    'plano' => '',
                    'cota' => '',
                    'observacoes' => 'Importado via sincronização automática.',
                    'ativo' => 'SIM'
                );
                $telModel->inserirTelefone($dados);
            }
        }
    }
}