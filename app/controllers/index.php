<?php


namespace app\controllers;

use app\models\DetalhesModel;
use \PlugRoute\Http\Request;
use \app\databases\conectaBanco;

//require_once '../vendor/autoload.php';
use core\Controller;
use app\models\UsuariosModel;

class index extends Controller
{
    public $request;

    function ola(Request $request)
    {
        //trazendo parametos da rota
        $nome = $request->parameter('nome');
        $sobrenome = $request->parameter('sobrenome');
        echo "ola " . $nome . ' ' . $sobrenome;
    }

    function teste()
    {
        $acesso = 'celular';
        $nro = '3';
        $user = '4';

        $dateModel = new DetalhesModel();
        $dateModel->updateUser($acesso, $user, $nro);
    }

    function login()
    {
        return $this->view('login');
    }

    function loga()
    {
        $dados = $_POST;
        $userModel = new UsuariosModel();
        $result = $userModel->login($dados);

        $count = count($result);
        if ($count > 0) {
            if (session_status() != PHP_SESSION_ACTIVE) {
                ob_start();
                session_start();
                session_cache_expire(60);
                $_SESSION['conectado'] = true;
                $_SESSION['menu'] = "sgt";

                $_SESSION['empresa'] = $result['empresa'];
                $_SESSION['nome'] = $result['nome'];
                $_SESSION['cc_descricao'] = $result['cc_descricao'];
                $_SESSION['matricula'] = $result['matricula'];
                $_SESSION['login'] = $result['login'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['admin'] = $result['admin'];
                $_SESSION['foto'] = $result['foto'];


                if (!empty($url)) {
                    header("Location: {$url}");
                } else {
                    header('Location: ' . BASEURL_SGT . 'meusTelefones/'.$_SESSION['matricula']);
                }
                header('Location: ' . BASEURL_SGT . 'meusTelefones/4085');
            }

        } else {
            $mensagem = 'Login ou senha incorretos!!!';
            return $this->view('login', ['mensagem' => $mensagem]);
        }
        header('Location: ' . BASEURL_SGT . 'meusTelefones/4085');
    }

    function logout(){
            session_start();
            session_unset();
            unset($_SESSION);
            session_destroy();
            header('Location: ' . BASEURL_SGT);
    }
}