<?php

namespace app\controllers;

use app\models\DetalhesModel;
use \core\Controller;
use PlugRoute\Http\Request;

class DetalhesController extends Controller
{
    function DetalhesModel(){
        return $model = new DetalhesModel();
    }

    function detalhes(Request $request){
        //$this->view("Detalhes/Detalhes");

        $acesso = $request->parameter('acesso');
        $nro = $request->parameter('nro');

        $dados = $this->DetalhesModel()->detalhes($nro, $acesso);

        foreach ($dados as $d) {

            $i = 10;
            for ($i == 10; $i < 19; $i++) {     
                echo $d[$i] . ',';
                $celular[$g][] = $d[$i];
            }

            $j = 19;
            for ($j == 19; $j < 31; $j++) {
                echo $d[$j] . ',';
                $linhas[$g][] = $d[$j];
                if($d['remove_telefone']===null){
                    $linhasAtiva[$g] =  $d[$j];
                }
            }

            $h = 31;
            for ($h == 31; $h < 40; $h++) {
                echo $d[$h] . ',';
                $usuarios[$g][] = $d[$h];
            }
            $g++;
        }

        return  $this->view("Detalhes/Detalhes", ["dados"=> $dados]);
    }
}