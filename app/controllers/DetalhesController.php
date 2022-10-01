<?php

namespace app\controllers;

use app\models\DetalhesModel;
use PlugRoute\Http\Request;

class DetalhesController extends \core\Controller
{
    function DetalhesModel(){
        return $model = new DetalhesModel();
    }

    function detalhes(Request $request){
        $acesso = $request->parameter('acesso');
        $nro = $request->parameter('nro');

        $dados = $this->DetalhesModel()->detalhes($nro, $acesso);

        $celular[] = array();
        $celularAtivo[] = array();
        $linhas[] = array();
        $linhasAtiva[] = array();
        $usuarios[] = array();
        $usuariosAtivo[] = array();
        $g = 0;

        foreach ($dados as $d) {
           // var_dump($d);
            echo "dados da celular:";
            echo "<br>";

            $i = 10;
            for ($i == 10; $i < 19; $i++) {
                echo $d[$i] . ',';
                $celular[$g][] = $d[$i];
            }
            if($d['remove_celular']===null){
                for ($i == 10; $i < 19; $i++) {
                    echo $d[$i] . ',';
                    $celularAtivo[$g][] = $d[$i];
                }
            }
            echo "<br>";
            echo "dados da Linha:";
            echo "<br>";
            $j = 19;
            for ($j == 19; $j < 31; $j++) {
                echo $d[$j] . ',';
                $linhas[$g][] = $d[$j];
                if($d['remove_telefone']===null){
                    $linhasAtiva[$g] =  $d[$j];
                }

            }
            echo "<br>";
            echo "dados do usuario:";
            echo "<br>";
            $h = 31;
            for ($h == 31; $h < 40; $h++) {
                echo $d[$h] . ',';
                $usuarios[$g][] = $d[$h];
            }
            if($d['remove_usuario']===null){
                for ($h == 31; $h < 40; $h++) {
                    echo $d[$h] . ',';
                    $usuariosAtivo[$g][] = $d[$h];
                }
            }
            echo "<br>";
            echo "<br>";
            $g++;
        }

        echo '<pre>';
        var_dump($celular);
        echo '</pre>';

        echo '<pre>';
        var_dump($linhas);
        echo '</pre>';

        echo '<pre>';
        var_dump($usuarios);
        echo '</pre>';

        echo '<h1>';
        echo 'ATIVOS';
        echo '</h1>';

        echo '<pre>';
        var_dump($celularAtivo);
        echo '</pre>';

        echo '<pre>';
        var_dump($linhasAtiva);
        echo '</pre>';

        echo '<pre>';
        var_dump($usuariosAtivo);
        echo '</pre>';


        // return  $this->view("Detalhes/Detalhes", ["dados"=> $dados]);
    }


}