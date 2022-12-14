<?php


namespace app\models;

use \app\databases\conectaBanco;

//require_once '../vendor/autoload.php';

class RelatoriosModel
{
    function fatGrid()
    {
        $stmt = conectaBanco::getConnection()->prepare('select COUNT(linha) as qntlinhas, date_fat, valor_total from sgt.sgt_resumo group by date_fat,valor_total order by date_fat desc;');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function datesFat()
    {
        $stmt = conectaBanco::getConnection()->prepare('SELECT date_fat FROM sgt.sgt_resumo group by date_fat order by date_fat desc;');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function topConsumoMes($m)
    {
        $stmt = conectaBanco::getConnection()->prepare('SELECT linha,valor FROM sgt.sgt_resumo where date_fat = :data and linha <> 0 order by valor desc limit 5;');
        $stmt->execute(array(
            ':data' => $m
        ));
        return $stmt->fetchAll();
    }

    function celularesporcc()
    {
        $stmt = conectaBanco::getConnection()->prepare('SELECT count(id_celular) as qtde, cc_descricao FROM sgt.sgt_relacao as rel
                                                                inner join sgt.usuarios as us on rel.id_usuario = us.id
                                                                where id_celular is not null
                                                                group by cc_descricao');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function buscaValorEmpresa($data)
    {
        $empresa = "EMPRESA";
        $stmt = conectaBanco::getConnection()->prepare('select SUM(r.valor) as valorTipo from sgt.sgt_telefones as t inner join sgt.sgt_resumo as r on t.linha = r.linha where r.date_fat = :data and tipo = :empresa group by tipo;');
        $stmt->execute(array(
            ':empresa' => $empresa,
            ':data' => $data
        ));
        return $stmt->fetch();
    }

    function buscaValorParticular($data)
    {
        $particular = "PARTICULAR";
        $stmt = conectaBanco::getConnection()->
        prepare('select SUM(r.valor) as valorTipo from sgt.sgt_telefones as t inner join sgt.sgt_resumo as r on t.linha = r.linha where r.date_fat = :data and tipo = :particular group by tipo;');
        $stmt->execute(array(
            ':particular' => $particular,
            ':data' => $data
        ));
        return $stmt->fetch();
    }

    function buscaValorTotEVencFat($data)
    {
        $stmt = conectaBanco::getConnection()->
        prepare('select valor_total, data_vencimento from sgt.sgt_resumo where date_fat = :data group by valor_total,data_vencimento;');
        $stmt->execute(array(
            ':data' => $data
        ));
        return $stmt->fetch();
    }

    function rateioCC($data)
    {
        $empresa = "EMPRESA";
        $stmt = conectaBanco::getConnection()->prepare('select t.tipo, t.CC, SUM(r.valor) as valorTipo from sgt.sgt_telefones as t inner join      
                                                                                    sgt.sgt_resumo as r on t.linha = r.linha
                                                                                    where r.date_fat = :data and t.tipo = :empresa group by t.CC, t.tipo;');
        $stmt->execute(array(
            ':empresa' => $empresa,
            ':data' => $data
        ));
        return $stmt->fetchAll();
    }

    function exportRH($data)
    {
        $particular = "PARTICULAR";
        $stmt = conectaBanco::getConnection()->
        prepare('select r.date_fat, t.matricula, r.valor from sgt.sgt_telefones as t 
                            inner join sgt.sgt_resumo as r on t.linha = r.linha where r.date_fat = :data and tipo = :particular');
        $stmt->execute(array(
            ':particular' => $particular,
            ':data' => $data
        ));
        return $stmt->fetchAll();
    }

    function valorLinha($data)
    {
        $stmt = conectaBanco::getConnection()->
        prepare('select t.linha, t.matricula, (select nome from sgt.usuarios where matricula = t.matricula) as nome,
                            t.CC, r.valor, r.data_vencimento
                            from sgt.sgt_telefones as t
                            inner join sgt.sgt_resumo as r on t.linha = r.linha WHERE date_fat = :data');
        $stmt->execute(array(
            ':data' => $data
        ));
        return $stmt->fetchAll();
    }
}