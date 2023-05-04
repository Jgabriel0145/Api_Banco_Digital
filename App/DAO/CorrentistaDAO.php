<?php

namespace App\DAO;

use Exception;

use App\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Insert(CorrentistaModel $model) : CorrentistaModel
    {
        try 
        {
            $sql = "INSERT INTO correntista(nome, cpf, data_nasc, email, senha, ativo) VALUES (?, ?, ?, ?, SHA1(?), ?);";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model->Cpf);
            $stmt->bindValue(3, $model->Data_Nasc);
            $stmt->bindValue(4, $model->Email);
            $stmt->bindValue(5, $model->Senha);
            $stmt->bindValue(6, $model->Ativo);
            $stmt->execute();

            $model->Id = $this->conexao->lastInsertId();
            return $model;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function Update(CorrentistaModel $model) : bool
    {
        try
        {
            $sql = "UPDATE correntista SET nome=?, cpf=?, data_nasc=?, email=?, senha=SHA1(?), ativo=? WHERE id=?";

            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model->Cpf);
            $stmt->bindValue(3, $model->Data_Nasc);
            $stmt->bindValue(4, $model->Email);
            $stmt->bindValue(5, $model->Senha);
            $stmt->bindValue(6, $model->Ativo);
            $stmt->bindValue(7, $model->Id);

            return $stmt->execute();
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function Select() : array
    {
        try
        {
            $sql = 'SELECT * FROM correntista';

            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(DAO::FETCH_CLASS, 'App\Model\CorrentistaModel');
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function Search(string $query) : array
    {
        try
        {
            $str_query = ['filtro' => '%' . $query . '%'];

            $sql = 'SELECT * FROM correntista WHERE nome LIKE :filtro';

            $stmt = $this->conexao->prepare($sql);
            $stmt->execute($str_query);

            return $stmt->fetchAll(DAO::FETCH_CLASS, 'App\Model\CorrentistaModel');
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function Delete(int $id) : bool
    {
        try
        {
            $sql = 'DELETE FROM correntista WHERE id = ?';

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $id);

            return $stmt->execute();
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    /*public function SelectUserAndSenha($json_obj)
    {
        $sql = 'SELECT * FROM correntista WHERE cpf = ? AND senha = sha1(?);';
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $json_obj->Cpf);
        $stmt->bindValue(2, $json_obj->Senha);
        $stmt->execute();

        return $stmt->fetchObject('App\Model\LoginModel');
    }*/
}