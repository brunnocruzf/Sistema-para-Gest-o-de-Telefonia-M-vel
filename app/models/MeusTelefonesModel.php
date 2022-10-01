<?php


namespace app\models;
use \app\databases\conectaBanco;
//require_once '../vendor/autoload.php';

class MeusTelefonesModel
{
    function buscaTelefones($matricula)
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_telefones left join sgt.usuarios on sgt.sgt_telefones.matricula = usuarios.matricula where sgt_telefones.matricula = '.$matricula);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}