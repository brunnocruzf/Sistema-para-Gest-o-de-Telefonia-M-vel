<?php

namespace app\controllers;

use app\models\DetalhesModel;
use core\Controller;
use PlugRoute\Http\Request;
use app\models\TelefonesModel;
use app\models\UsuariosModel;

//error_reporting(0);


//require_once('C:\xampp\htdocs\sgt\config.php');
//require_once(DBAPI);
//abresessao();

class DetalhesController extends Controller
{
    function DetalhesModel()
    {
        return $model = new DetalhesModel();
    }

    function detalhes(Request $request)
    {
        $acesso = $request->parameter('acesso');
        $nro = $request->parameter('nro');

        if(empty($this->DetalhesModel()->detalhes($nro, $acesso)[0])){
            $dados = null;
        }else{
            $dados = $this->DetalhesModel()->detalhes($nro, $acesso)[0];
        }


            $b = 0;
            for ($a = 10; $a < 19; $a++) {
                $calulares[$b] = $dados[$a];
                $b++;
            }

            $c = 0;
            for ($d = 19; $d < 31; $d++) {
                $telefones[$c] = $dados[$d];
                $c++;
            }

            $e = 0;
            for ($f = 31; $f < 40; $f++) {
                $usuario[$e] = $dados[$f];
                $e++;
            }


        return $this->view("Detalhes/Detalhes", ["celulares" => $calulares, "telefones" => $telefones, "usuario" => $usuario, "celular" => $nro]);
    }

    function detalhesEditUser(Request $request)
    {
        $acesso = $request->parameter('acesso');
        $nro = $request->parameter('nro');
        $user = $request->parameter('user');

        $dateModel = new DetalhesModel();
        $retorno = $dateModel->updateUser($acesso, $user, $nro);
        if ($retorno == 1) {
            return json_encode($retorno);
        } else {
            return 'erro ao salvar';
        }

    }

    function detalhesEditLinha(Request $request)
    {
        $acesso = $request->parameter('acesso');
        $nro = $request->parameter('nro');
        $user = $request->parameter('user');

        $dateModel = new DetalhesModel();
        $retorno = $dateModel->updateLinha($acesso, $user, $nro);
        if ($retorno == 1) {
            return json_encode($retorno);
        } else {
            return 'erro ao salvar';
        }

    }

    function dadosLinha()
    {
        $telModel = new TelefonesModel();
        return $telModel->todasAsLinhas();
    }

    function dadosUser()
    {
        $userModel = new UsuariosModel();
        return $userModel->todosIdNomes();
    }
}