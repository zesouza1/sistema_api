<?php

require_once './core/Conexao.php';
require_once './core/ExceptionPdo.php';

class ProdutoModel{
    public static function show(){
        try{
            $pdo = Conexao::getInstance();

            $stmt = $pdo->prepare('SELECT * FROM produtos ORDER BY codigo');
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            throw new \Exception(ExceptionPdo::translateError($e->getMessage()));
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public static function find(int $codigo){
        try{
            $pdo = Conexao::getInstance();

            $stmt = $pdo->prepare('SELECT * FROM produtos WHERE codigo = ?');
            $stmt->execute([$codigo]);

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            throw new \Exception(ExceptionPdo::translateError($e->getMessage()));
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }


    }

    public static function insert(array $data){
        try{
            $pdo = Conexao::getInstance();

            $stmt = $pdo->prepare('INSERT INTO produtos (descricao, valor) VALUES (?,?)');
            $stmt->execute([$data['descricao'],$data['valor']]);

            return ($stmt->rowCount()>0);
        }catch (\PDOException $e){
            throw new \Exception(ExceptionPdo::translateError($e->getMessage()));
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    public static function update(array $data){
        try{
            $pdo = Conexao::getInstance();

            $stmt = $pdo->prepare('UPDATE produtos SET descricao = ?, valor = ? WHERE codigo = ?');
            $stmt->execute([$data['descricao'],$data['valor'],$data['codigo']]);

            return ($stmt->rowCount()>0);
        }catch (\PDOException $e){
            throw new \Exception(ExceptionPdo::translateError($e->getMessage()));
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public static function delete(int $codigo){
        try{
            $pdo = Conexao::getInstance();

            $stmt = $pdo->prepare('DELETE FROM produtos WHERE codigo = ?');
            $stmt->execute([$codigo]);

            return ($stmt->rowCount()>0);
        }catch (\PDOException $e){
            throw new \Exception(ExceptionPdo::translateError($e->getMessage()));
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public static function lastInsertId(){
        try{
            $pdo = Conexao::getInstance();

            return $pdo->lastInsertId();
        }catch (\PDOException $e){
            throw new \Exception(ExceptionPdo::translateError($e->getMessage()));
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}