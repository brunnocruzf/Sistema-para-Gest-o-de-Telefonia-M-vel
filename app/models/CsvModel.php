<?php


namespace app\models;

use \app\databases\conectaBanco;

//require_once '../vendor/autoload.php';

class CsvModel
{
    private $conexao;

    private function getConexao()
    {
        $this->conexao = conectaBanco::getConnection();
        return $this->conexao;
    }

    function importCsvChamada($numero, $date, $registros)
    {
        set_time_limit(900);

        foreach ($registros as $registro) {

            if($registro['valor']==''){
                $registro['valor']=0;
            }


            try {
                $stmt = $this->getConexao()->prepare('INSERT INTO sgt.sgt_chamadas (date_fat, linha, data_hora_inicio,nro_telefone_chamado, duracao_ligacao,desc_categoria,valor_ligacao)
                                                            VALUES(:date_fat, :linha, :data_hora_inicio, :nro_telefone_chamado, :duracao_ligacao, :desc_categoria, :valor_ligacao)');
                $stmt->execute(array(
                    ':date_fat' => $date,
                    ':linha' => $numero,
                    ':data_hora_inicio' => $registro['data_hora_inicio'],
                    ':nro_telefone_chamado' => str_replace(' ', '', $registro['nro_telefone_chamado']),
                    ':duracao_ligacao' => $registro['duracao_ligacao'],
                    ':desc_categoria' => $registro['desc_categoria'],
                    ':valor_ligacao' => $registro['valor']
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    function importCsvResumo($registros)
    {
        foreach ($registros as $registro) {
            try {
                $stmt = $this->getConexao()->prepare('INSERT INTO sgt.sgt_resumo (cod_fat, date_fat, cnpj, razao_social, desc_forma_pagamento, valor_total, data_vencimento, linha, valor)
                                                            VALUES(:cod_fat, :date_fat, :cnpj, :razao_social, :desc_forma_pagamento, :valor_total, :data_vencimento, :linha, :valor)');
                $stmt->execute(array(
                    ':cod_fat' => $registro['cod_objeto'],
                    ':date_fat' => $registro['anomes'],
                    ':cnpj' => $registro['documento'],
                    ':razao_social' => $registro['razao_social'],
                    ':desc_forma_pagamento' => $registro['desc_forma_pagamento'],
                    ':valor_total' => $registro['valor_total'],
                    ':data_vencimento' => $registro['data_vencimento'],
                    ':linha' => $registro['nro_telefone'],
                    ':valor' => $registro['valor'],
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    function importCsvLinha($registros)
    {
        foreach ($registros as $registro) {
            try {
                $stmt = $this->getConexao()->prepare('INSERT INTO sgt.sgt_linha (cod_fat, date_fat, cnpj, razao_social, desc_forma_pagamento, valor_total, data_vencimento, linha, desc_tipo_servico, descricao, data_inicio, data_fim, valor)
                                                            VALUES(:cod_fat, :date_fat, :cnpj, :razao_social, :desc_forma_pagamento, :valor_total, :data_vencimento, :linha, :desc_tipo_servico, :descricao, :data_inicio, :data_fim, :valor)');
                $stmt->execute(array(
                    ':cod_fat' => $registro['cod_fatura'],
                    ':date_fat' => $registro['anomes'],
                    ':cnpj' => $registro['documento'],
                    ':razao_social' => $registro['razao_social'],
                    ':desc_forma_pagamento' => $registro['desc_forma_pagamento'],
                    ':valor_total' => $registro['valor_total'],
                    ':data_vencimento' => $registro['data_vencimento'],
                    ':linha' => $registro['nro_telefone'],
                    ':desc_tipo_servico' => $registro['desc_tipo_servico'],
                    ':descricao' => $registro['descricao'],
                    ':data_inicio' => $registro['data_inicio'],
                    ':data_fim' => $registro['data_fim'],
                    ':valor' => $registro['valor']
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}