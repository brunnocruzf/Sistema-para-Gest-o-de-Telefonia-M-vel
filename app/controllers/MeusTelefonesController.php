<?php

namespace app\controllers;

use app\models\MeusTelefonesModel;
use \core\Controller;
use PlugRoute\Http\Request;

class MeusTelefonesController extends Controller
{
    function index(Request $request)
    {
        $matricula = $request->parameter('mat');
        //var_dump($_SESSION);
        $telefonesModel = new  MeusTelefonesModel();
        $telefones = $telefonesModel->buscaTelefones($matricula);
        $this->view("MeusTelefones", ['telefones' => $telefones]);
    }


}