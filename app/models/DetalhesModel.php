<?php

namespace app\models;

use app\databases\conectaBanco;

class DetalhesModel extends conectaBanco
{
    function detalhes($id, $acesso)
    {
        if($acesso === "telefone"){
            $tabela = "nro_telefone";
        }else{
            $tabela = "id_".$acesso;
        }

        switch ($acesso) {
            case 'celular':
                $stmt = conectaBanco::getConnection()->prepare("SELECT * FROM sgt.sgt_relacao as rl
                                                                        left join sgt.sgt_celular as cel on rl.id_celular = cel.id
                                                                        left join sgt.sgt_telefones as tel on rl.nro_telefone = tel.linha
                                                                        left join sgt.usuarios as users on rl.id_usuario = users.id
                                                                        where 
                                                                        id_celular= :id and 
                                                                        remove_celular is null");
                $stmt->execute(array(
                    ':id' => $id
                ));
                return $stmt->fetchAll();
            case 'telefone':
                echo "i equals 1";
                break;
            case 'usuario':
                echo "i equals 2";
                break;
        }
    }
}