<?php

namespace app\models;

use app\databases\conectaBanco;
use app\models\UsuariosModel;

class DetalhesModel extends conectaBanco
{
    function detalhes($id, $acesso)
    {
        if ($acesso === "telefone") {
            $tabela = "nro_telefone";
        } else {
            $tabela = "id_" . $acesso;
        }

        switch ($acesso) {
            case 'celular':

                $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao as rl
                                                                        left join sgt.sgt_celular as cel on rl.id_celular = cel.id
                                                                        left join sgt.sgt_telefones as tel on rl.nro_telefone = tel.linha
                                                                        left join sgt.usuarios as users on rl.id_usuario = users.id
                                                                        where 
                                                                        rl.id_celular= :id and 
                                                                        rl.remove_celular is null");
                $stmt->execute(array(
                    ':id' => $id
                ));
                $retorno = $stmt->fetchAll();

                if (empty($retorno)) {

                    $stmt = conectaBanco::getConnection()->prepare('INSERT INTO sgt.sgt_relacao (id_celular) 
                                                            VALUES(:id_celular)');
                    $stmt->execute(array(
                        ':id_celular' => $id,
                    ));

                    $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao as rl
                                                                        left join sgt.sgt_celular as cel on rl.id_celular = cel.id
                                                                        left join sgt.sgt_telefones as tel on rl.nro_telefone = tel.linha
                                                                        left join sgt.usuarios as users on rl.id_usuario = users.id
                                                                        where 
                                                                        rl.id_celular= :id and 
                                                                        rl.remove_celular is null");
                    $stmt->execute(array(
                        ':id' => $id
                    ));
                    $retorno = $stmt->fetchAll();
                    return $retorno;

                } else {
                    return $retorno;
                }
                break;
            case 'telefone':
                $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao as rl
                                                                        left join sgt.sgt_celular as cel on rl.id_celular = cel.id
                                                                        left join sgt.sgt_telefones as tel on rl.nro_telefone = tel.linha
                                                                        left join sgt.usuarios as users on rl.id_usuario = users.id
                                                                        where 
                                                                        rl.tel.linha = :id and 
                                                                        rl.remove_telefone is null");
                $stmt->execute(array(
                    ':id' => $id
                ));
                return $stmt->fetchAll();
                break;
            case 'usuario':

                $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao as rl
                                                                        left join sgt.sgt_celular as cel on rl.id_celular = cel.id
                                                                        left join sgt.sgt_telefones as tel on rl.nro_telefone = tel.linha
                                                                        left join sgt.usuarios as users on rl.id_usuario = users.id
                                                                        where 
                                                                        rl.id_usuario = :id and 
                                                                        rl.remove_usuario is null");
                $stmt->execute(array(
                    ':id' => $id
                ));
                return $stmt->fetchAll();
                break;
        }
    }

    function updateUser($acesso, $idUser, $idWhere)
    {

        switch ($acesso) {
            case 'celular':
                $cont = $this->buscaUser($idUser);
                if ($cont <= 0) {
                    try {
                        $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_relacao SET
                                                                          id_usuario = :idUser WHERE id_celular = ' . $idWhere);

                        $stmt->bindParam(':idUser', $idUser);

                        $stmt->execute();
                        //$stmt->debugDumpParams();
                        return 1;
                    } catch (PDOException $e) {
                        return 2;
                    }
                } else {
                    try {
                        $stmt = conectaBanco::getConnection()->prepare('delete from sgt.sgt_relacao WHERE id_celular = ' . $idWhere);
                        $stmt->execute();

                        $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_relacao SET
                                                                          id_celular = :idUser WHERE id_usuario  = ' . $idUser);

                        $stmt->bindParam(':idUser', $idWhere);

                        $stmt->execute();


                        //$stmt->debugDumpParams();
                        return 1;
                    } catch (PDOException $e) {
                        return 2;
                    }
                }
                break;
            case 'linha':
                $cont = $this->buscaLinha($idWhere);

                $userModel = new \app\models\UsuariosModel();
                $idUsuario = $userModel->buscaIdMatricula($idUser)['id'];

                if($cont <= 0){

                    $stmt = conectaBanco::getConnection()->prepare('INSERT INTO sgt.sgt_relacao (id_usuario , nro_telefone) 
                                                            VALUES(:id_user, :id_celular)');
                    $stmt->execute(array(
                        ':id_user' => $idUsuario,
                        ':id_celular' => $idWhere,
                    ));

                }else{
                    try {
                        $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_relacao SET
                                                                          id_usuario = :idUser WHERE nro_telefone = ' . $idWhere);

                        $stmt->bindParam(':idUser', $idUsuario);

                        $stmt->execute();
                        //$stmt->debugDumpParams();
                        return 1;
                    } catch (PDOException $e) {
                        return 2;
                    }
                }
                break;
        }
    }

    function updateLinha($acesso, $nro_telefone, $idWhere)
    {

        switch ($acesso) {
            case 'celular':
                $cont = $this->buscaLinha($nro_telefone);
                if ($cont <= 0) {
                    try {
                        $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_relacao SET
                                                                      nro_telefone = :nro_telefone WHERE id_celular = ' . $idWhere);

                        $stmt->bindParam(':nro_telefone', $nro_telefone);

                        $stmt->execute();
                        //$stmt->debugDumpParams();
                        return 1;
                    } catch (PDOException $e) {
                        return 2;
                    }
                } else {
                    try {
                        $stmt = conectaBanco::getConnection()->prepare('delete from sgt.sgt_relacao WHERE id_celular = ' . $idWhere);
                        $stmt->execute();

                        $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_relacao SET
                                                                          id_celular = :idUser WHERE nro_telefone  = ' . $nro_telefone);

                        $stmt->bindParam(':idUser', $idWhere);

                        $stmt->execute();


                        //$stmt->debugDumpParams();
                        return 1;
                    } catch (PDOException $e) {
                        return 2;
                    }
                }
                    break;
                case
                    'telefone':

                break;
        }
        }

        function removeUserCel($cel)
        {
            $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_relacao SET
                                                                      id_usuario = :nro_telefone WHERE id_celular = ' . $cel);
            $vazio = " ";
            $stmt->bindParam(':nro_telefone', $vazio);

            $stmt->execute();
        }

        function removeTelCel($cel)
        {
            $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.sgt_relacao SET
                                                                      nro_telefone = :nro_telefone WHERE id_celular = ' . $cel);
            $vazio = " ";
            $stmt->bindParam(':nro_telefone', $vazio);

            $stmt->execute();
        }

        function buscaUser($idUSer)
        {
            $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao where id_usuario = " . $idUSer);
            $stmt->execute();
            return $stmt->rowCount();
        }

        function buscaUserMat($matricula)
        {
            $stmt = conectaBanco::getConnection()->prepare('SELECT id FROM sgt.usuarios where matricula = '.$matricula);
            $stmt->execute();
            $idUSer  = $stmt->fetch()['id'];


            $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao where id_usuario = " . $idUSer);
            $stmt->execute();
            return $stmt->rowCount();
        }

        function buscaLinha($idTelefone)
        {
            $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao where nro_telefone = " . $idTelefone);
            $stmt->execute();
            return $stmt->rowCount();
        }

        function buscaCel($idCel)
        {
            $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao where id_celular = " . $idCel);
            return $stmt->rowCount();
        }

    }