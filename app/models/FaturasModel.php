<?php


namespace app\models;
use \app\databases\conectaBanco;
//require_once '../vendor/autoload.php';

class FaturasModel
{
    function buscaGrid($numero){
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_resumo where linha = '.$numero.' order by date_fat desc;');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function buscaValorTotal($numero, $mes){
        $stmt = conectaBanco::getConnection()->prepare('select valor from sgt.sgt_resumo where linha = :numero and date_fat = :mes');
        $stmt->execute(array(
            ':numero'=>$numero,
            ':mes'=>$mes
        ));
        return $stmt->fetch();
    }
    function buscaChamadas($numero, $data){
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_chamadas where date_fat = :data and linha = :numero order by data_hora_inicio desc;');
        $stmt->execute(array(
            ':numero'=>$numero,
            ':data'=>$data
        ));
        return $stmt->fetchAll();
    }
    function buscaInfoPlano($numero, $data){
        $stmt = conectaBanco::getConnection()->prepare('select descricao, valor from sgt.sgt_linha where linha = :numero and date_fat = :data order by date_fat;');
        $stmt->execute(array(
            ':numero'=>$numero,
            ':data'=>$data
        ));
        return $stmt->fetchAll();
    }
    function buscaResumo($numero, $data){
        $stmt = conectaBanco::getConnection()->prepare("
                                SELECT desc_categoria, SUM(duracao_ligacao) AS totChamadas,SUM(valor_ligacao) AS valorTot 
                                    FROM sgt.sgt_chamadas WHERE date_fat = ".$data." and linha = ".$numero." and desc_categoria IN
                                    (
                                        'Chamadas de Longa Distancia para Outros Estados',
                                        'INTERNET DIARIA VIVO',
                                        'INTERATIVIDADE SMS',
                                        'Para Fixo de Outras Operadoras',
                                        'DIARIA DFLT DL INC',
                                        'Para Celulares de Outras Operadoras',
                                        'Tons e Imagens',
                                        'VIVO BIS',
                                        'Para Fixo Vivo',
                                        'Adicional por Ligacoes Realizadas',
                                        'Para Celulares Vivo',
                                        'ADICIONAL',
                                        'GRATIS-SMS',
                                        'De Celulares Vivo',
                                        'INTERNET MOVEL 2',
                                        'VIVO WAP',
                                        'GEST?O DE CUSTO',
                                        'INTERNET MOVEL',
                                        'Servicos Prestados por Terceiros'
                                    ) 
                                    group by desc_categoria;
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}


