<?php

namespace app\models;

use \app\databases\conectaBanco;

class CelularesModel
{
    function celulares()
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_celular;');
        $stmt->execute();
        return $stmt->fetchALL();
    }

    function buscaCel($IMEI1, $IMEI2, $nroSerie)
    {
        $stmt = conectaBanco::getConnection()->
        prepare('select * from sgt.sgt_celular where (IMEI1 = :IMEI1 and IMEI2 = :IMEI2) || nroSerie = :nroSerie');
        $stmt->execute(array(
            ':IMEI1' => $IMEI1,
            ':IMEI2' => $IMEI2,
            ':nroSerie' => $nroSerie
        ));
        return $stmt->fetch();
    }

    function inserirCelular($dados)
    {
        try {
            $stmt = conectaBanco::getConnection()->prepare('INSERT INTO sgt.sgt_celular (marca,modelo,IMEI1,ICCID1,IMEI2,ICCID2,nroSerie,foto)
                                                            VALUES(:marca,:modelo,:IMEI1,:ICCID1,:IMEI2,:ICCID2,:nroSerie,:foto)');
            $stmt->execute(array(
                ':marca' => $dados['marca'],
                ':modelo' => $dados['modelo'],
                ':IMEI1' => $dados['IMEI1'],
                ':ICCID1' => $dados['ICCID1'],
                ':IMEI2' => $dados['IMEI2'],
                ':ICCID2' => $dados['ICCID2'],
                ':nroSerie' => $dados['nroSerie'],
                ':foto' => $dados['foto']

            ));
            return "<div class='alert alert-success' role='alert'>" . $dados['modelo'] . " Inserido com sucesso!</div>";
        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: " . $e->getMessage() . "</div>";
        }
    }

    function buscaPorId($id)
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_celular where id = :id ');
        $stmt->execute(array(
            ':id' => $id
        ));
        return $stmt->fetch();
    }

    function deleteCelular($numero)
    {
        try {
            $stmt = conectaBanco::getConnection()->prepare("DELETE FROM sgt.sgt_celular WHERE id = :id;");
            $stmt->execute(array(
                ':id' => $numero
            ));
            return "<div class='alert alert-success' role='alert'>" . $numero . " Deletado com sucesso!</div>";
        } catch (PDOException $e) {

            return "<div class='alert alert-success' role='alert'>Error: " . $e->getMessage() . "</div>";
        }
    }

    function editSaveCelular($dados)
    {
        try {
            $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_celular SET
                                                                        marca = :marca,
                                                                        modelo = :modelo,
                                                                        IMEI1 = :IMEI1,
                                                                        ICCID1 = :ICCID1,
                                                                        IMEI2 = :IMEI2,
                                                                        ICCID2 = :ICCID2,
                                                                        nroSerie = :nroSerie,
                                                                        foto = :foto
                                                                        WHERE id = ' . $dados['id']);

            $stmt->bindParam(':marca' ,$dados['marca']);
            $stmt->bindParam(':modelo',$dados['modelo']);
            $stmt->bindParam(':IMEI1',$dados['IMEI1']);
            $stmt->bindParam(':ICCID1',$dados['ICCID1']);
            $stmt->bindParam(':IMEI2',$dados['IMEI2']);
            $stmt->bindParam(':ICCID2',$dados['ICCID2']);
            $stmt->bindParam(':nroSerie',$dados['nroSerie']);
            $stmt->bindParam(':foto',$dados['foto']);
            $stmt->execute();
            //$stmt->debugDumpParams();
            return "<div class='alert alert-success' role='alert'>" . $dados['modelo'] . " Alterado com sucesso!</div>";
        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: " . $e->getMessage() . "</div>";
        }
    }
}