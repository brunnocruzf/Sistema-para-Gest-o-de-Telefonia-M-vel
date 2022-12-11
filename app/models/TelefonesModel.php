<?php


namespace app\models;
use \app\databases\conectaBanco;
use app\models\DetalhesModel;
//require_once '../vendor/autoload.php';

class TelefonesModel
{
    function buscaTelefones()
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_telefones left join sgt.usuarios on sgt_telefones.matricula = usuarios.matricula');
        $stmt->execute();
        return $telefones = $stmt->fetchAll();
    }

    //retorna todas as linhas
    function todasAsLinhas(){
        $stmt = conectaBanco::getConnection()->prepare('select linha from sgt.sgt_telefones');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function buscaCC($numero){
        $stmt = conectaBanco::getConnection()->prepare('select cc from sgt.sgt_telefones where linha ='.$numero);
        $stmt->execute();
        return $stmt->fetch();
    }

    function buscaTelefone($numero)
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_telefones where linha = '.$numero);
        $stmt->execute();
        return $stmt->fetch();
    }

    function buscaQntdTelefone($numero)
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_telefones where linha = '.$numero);
        $stmt->execute();
        $count = count($stmt->fetchAll());
        return $count;
    }

    function buscaMatricula($numero)
    {
        $stmt = conectaBanco::getConnection()->prepare('select usuarios.matricula from sgt.sgt_telefones join sgt.usuarios on sgt.sgt_telefones.matricula = usuarios.matricula where linha ='.$numero);
        $stmt->execute();
        return $stmt->fetch();
    }

    function inserirTelefone($dados){
        if(empty($dados['iccid'])){$dados['iccid']=0;}
        if(empty($dados['cota'])){$dados['cota']=0;}
        try {
            $stmt = conectaBanco::getConnection()->prepare('INSERT INTO sgt.sgt_telefones (empresa, conta,linha, iccid,plano,tipo, observacao ,matricula,ativo,cota,CC) 
                                                            VALUES(:empresa, :conta, :linha, :iccid, :plano, :tipo, :observacao, :matricula, :ativo, :cota, :CC)');
            $stmt->execute(array(
                ':empresa' => $dados['empresa'],
                ':conta' => $dados['conta'],
                ':linha' => $dados['numero'],
                ':iccid' => $dados['iccid'],
                ':plano' => $dados['plano'],
                ':tipo' => $dados['tipo'],
                ':observacao' => $dados['observacoes'],
                ':matricula' => str_pad($dados['matricula'] , 4 , '0' , STR_PAD_LEFT),
                ':ativo' => $dados['ativo'],
                ':cota' => $dados['cota'],
                ':CC'=>$dados['CC']
            ));
            return "<div class='alert alert-success' role='alert'>".$dados['numero']." Inserido com sucesso!</div>";
        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: ".$e->getMessage()."</div>";
        }
    }

    function editarTelefone($dados){
        if(empty($dados['iccid'])){$dados['iccid']=0;}
        if(empty($dados['cota'])){$dados['cota']=0;}

        if(isset($dados['ativo']))
        {
            $dados['ativo'] = "SIM";
        }
        else
        {
            $dados['ativo'] = "NAO";
        }

        try {
            $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_telefones SET empresa= :empresa, conta = :conta, linha= :linha, iccid = :iccid, plano= :plano, tipo = :tipo, observacao = :observacao, matricula= :matricula, ativo= :ativo, cota= :cota, CC = :CC
                                                                        WHERE linha='.$dados['linhaAntiga']);
            $stmt->execute(array(
                ':empresa' => $dados['empresa'],
                ':conta' => $dados['conta'],
                ':linha' => $dados['numero'],
                ':iccid' => $dados['iccid'],
                ':plano' => $dados['plano'],
                ':tipo' => $dados['tipo'],
                ':observacao' => $dados['observacoes'],
                ':matricula' => str_pad($dados['matricula'] , 4 , '0' , STR_PAD_LEFT),
                ':ativo' => $dados['ativo'],
                ':cota' => $dados['cota'],
                ':CC' => $dados['CC']
            ));

            if(!empty($dados['matricula'])){
                $detalhes = new DetalhesModel();
                //busca a linha
                //update where linha

                $detalhes->updateUser('linha', $dados['matricula'], $dados['numero']);
            }

            return "<div class='alert alert-success' role='alert'>".$dados['numero']." Alterado com sucesso!</div>";
        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: ".$e->getMessage()."</div>";
        }


    }

    function deleteTelefone($numero){
        try {
            $stmt = conectaBanco::getConnection()->prepare('DELETE FROM sgt.sgt_telefones WHERE linha = '.$numero);
            $stmt->execute();
            return "<div class='alert alert-success' role='alert'>".$numero." Deletado com sucesso!</div>";
        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: ".$e->getMessage()."</div>";
        }
    }

    function buscaSincLinhas(){
        try {
            $stmt = conectaBanco::getConnection()->prepare('select date_fat from sgt.sgt_resumo order by date_fat desc LIMIT 1');
            $stmt->execute();
            $ultimoMes = $stmt->fetch()['date_fat'];

            $stmt = conectaBanco::getConnection()->prepare('select linha from sgt.sgt_resumo where date_fat = :ultimoMes group by linha;');
            $stmt->execute(array(
                ':ultimoMes' => $ultimoMes
            ));
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: ".$e->getMessage()."</div>";
        }
    }
}




