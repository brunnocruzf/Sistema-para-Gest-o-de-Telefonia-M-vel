<?php

namespace app\controllers;

use app\models\UsuariosModel;
use core\Controller;
use \PlugRoute\Http\Request;

class UsuariosController extends Controller
{

    function usuarios()
    {
        $userModel = new UsuariosModel();
        $usuarios = $userModel->usuarios();
        return $this->view("Usuarios/Usuarios", ['usuarios' => $usuarios]);
    }

    function delete(Request $request)
    {
        $numero = $request->parameter('nro');
        $userModel = new UsuariosModel();
        $userModel->deleteUsuario($numero);

        $results = array('mensagem' => 'Excluido com sucesso!');
        echo json_encode($results);
    }

    function novoUsuario()
    {
        $mensagem = '';
        if (!empty($_POST)) {
            $userModel = new UsuariosModel();
            $dados = $_POST;
            //Verifica se numero ja está cadastrado (Retorna quantidade de linhas se > )
            $seExiste = $userModel->buscaUser($_POST['matricula'], $_POST['empresa'], $_POST['login']);
            if ($seExiste == 0) {
                $mensagem = $userModel->inserirUsuario($dados);
                unset($_POST);
            } else {
                $mensagem = "<div class='alert alert-danger' role='alert'>Usuário ja casatrado</div>";
                unset($_POST);
            }
        }
        $this->view("Usuarios/NovoUsuario", ['mensagem' => $mensagem]);
    }

    function foto()
    {
        $this->view("upload_foto");
    }

    function editUser(Request $request){
        $numero = $request->parameter('nro');
        $userModel = new UsuariosModel();
        $user = $userModel->buscaPorId($numero);
        $this->view("Usuarios/EditUsuario", ['user' => $user]);
    }

    function editSaveUser(){
        $userModel = new UsuariosModel();
        $userModel->editarUser($_POST);
        header('Location: '.BASEURL.'usuarios');
      //  var_dump($_POST);
    }

    function buscaPorMatricula(Request $request){
        $matricula = $request->parameter('matricula');
        $userModel = new UsuariosModel();
        $user = $userModel->buscaPorMatricula($matricula);
        return json_encode(array('NOME'=>$user['nome'], 'EMAIL'=>$user['email']));
    }
    function processa(Request $request){
        $matricula = $request->parameter('matricula');
        $userModel = new UsuariosModel();
     $user = $userModel->processa($matricula);
        return json_encode($user);
    }
}