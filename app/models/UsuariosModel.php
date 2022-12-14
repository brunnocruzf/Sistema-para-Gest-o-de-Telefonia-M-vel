<?php

namespace app\models;

use \app\databases\conectaBanco;

class UsuariosModel
{
    function buscaUsuarios()
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.sgt_telefones as a inner join sgt.usuarios as u on a.matricula = u.matricula');
        $stmt->execute();
        return $usuarios = $stmt->fetchALL();
    }

    function login($dados)
    {
        $senha = md5($dados['inputsenha']);
        //$senha = $dados['inputsenha'];
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.usuarios where login = :login and senha = :senha');
        $stmt->execute(array(
            ':login' => $dados['inputuser'],
            ':senha' => $senha
        ));
        return $stmt->fetch();
    }

    function todosIdNomes()
    {
        $stmt = conectaBanco::getConnection()->prepare('select id, nome from sgt.usuarios order by nome');
        $stmt->execute();
        return $usuarios = $stmt->fetchALL();
    }

    function buscaPorId($id)
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.usuarios where id = :id');
        $stmt->execute(array(
            ':id' => $id
        ));
        return $stmt->fetch();
    }

    function usuarios()
    {
        $stmt = conectaBanco::getConnection()->prepare('select * from sgt.usuarios;');
        $stmt->execute();
        return $stmt->fetchALL();
    }

    function buscaNome($matricula)
    {
        $stmt = conectaBanco::getConnection()->prepare('select nome from sgt.sgt_telefones as a left join sgt.usuarios as u on a.matricula = u.matricula where a.matricula =' . $matricula);
        $stmt->execute();
        return $stmt->fetch();
    }

    function buscaCC()
    {
        $stmt = conectaBanco::getConnection()->prepare('select  cc_descricao from sgt.usuarios group by cc_descricao order by cc_descricao');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function deleteUsuario($numero)
    {
        try {
            $stmt = conectaBanco::getConnection()->prepare('DELETE FROM sgt.usuarios WHERE id = :id');
            $stmt->execute(array(
                ':id' => $numero
            ));
            return "<div class='alert alert-success' role='alert'>" . $numero . " Deletado com sucesso!</div>";
        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: " . $e->getMessage() . "</div>";
        }
    }

    function buscaUser($matricula, $empresa, $login)
    {
        $stmt = conectaBanco::getConnection()->
        prepare('select * from sgt.usuarios where (matricula = :matricula and empresa = :empresa) || login = :login');
        $stmt->execute(array(
            ':matricula' => $matricula,
            ':empresa' => $empresa,
            ':login' => $login
        ));
        return $stmt->fetch();
    }

    function inserirUsuario($dados)
    {
        try {
            $stmt = conectaBanco::getConnection()->prepare('INSERT INTO sgt.usuarios (empresa,nome,cc_descricao,matricula,login,email,senha,foto,admin)
                                                            VALUES(:empresa, :nome, :cc_descricao, :matricula, :login, :email, :senha, :foto, :admin)');
            $stmt->execute(array(
                ':empresa' => $dados['empresa'],
                ':nome' => $dados['nome'],
                ':cc_descricao' => $dados['cc_descricao'],
                ':matricula' => $dados['matricula'],
                ':login' => $dados['login'],
                ':email' => $dados['email'],
                ':senha' => md5($dados['senha']),
                ':foto' => $dados['foto'],
                ':admin' => $dados['admin']
            ));
            return "<div class='alert alert-success' role='alert'>" . $dados['matricula'] . " Inserido com sucesso!</div>";
        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: " . $e->getMessage() . "</div>";
        }
    }

    function buscaPorMatricula($matricula)
    {
        $stmt = conectaBanco::getConnection()->prepare('select matricula,nome,email from sgt.usuarios where matricula = :matricula ');
        $stmt->execute(array(
            ':matricula' => $matricula
        ));
        return $stmt->fetch();
    }

    function editarUser($dados)
    {
        try {
            $stmt = conectaBanco::getConnection()->prepare('UPDATE sgt.usuarios 
                                                                        SET
                                                                            empresa=:empresa,nome=:nome,cc_descricao=:cc_descricao,matricula=:matricula,login=:login,email=:email,senha=:senha,foto=:foto,admin=:admin
                                                                        WHERE id=' . $dados['id']);
            $stmt->execute(array(
                ':empresa' => $dados['empresa'],
                ':nome' => $dados['nome'],
                ':cc_descricao' => $dados['cc_descricao'],
                ':matricula' => $dados['matricula'],
                ':login' => $dados['login'],
                ':email' => $dados['email'],
                ':senha' => md5($dados['senha']),
                ':foto' => $dados['foto'],
                ':admin' => $dados['admin']
            ));
            return "<div class='alert alert-success' role='alert'>" . $dados['login'] . " Alterado com sucesso!</div>";
        } catch (PDOException $e) {
            return "<div class='alert alert-success' role='alert'>Error: " . $e->getMessage() . "</div>";
        }
    }

    function processa($matricula){
        $stmt = conectaBanco::getConnection()->prepare("select matricula as MATRICULA,nome as NOME,''  as CodCC, cc_descricao as CC, email as EMAIL from sgt.usuarios where matricula =:matricula ");
        $stmt->execute(array(
            ':matricula' => $matricula
        ));
        return $stmt->fetchObject();
    }
    function buscaIdMatricula($matricula){
        $stmt = conectaBanco::getConnection()->prepare("select id from sgt.usuarios where matricula =:matricula ");
        $stmt->execute(array(
            ':matricula' => $matricula
        ));
        return $stmt->fetch();
    }

}