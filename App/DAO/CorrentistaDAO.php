<?php

namespace App\DAO;

use Exception;

use App\Model\CorrentistaModel;
use Error;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function Save(CorrentistaModel $model) : CorrentistaModel
    {
        return ($model->id == null) ? $this->Insert($model) : $this->Update($model);
    }

    private function Insert(CorrentistaModel $model)
    {
        try 
        {
            //echo " DAO _____________________________________________________________";
            //var_dump($model);
            $sql = "INSERT INTO correntista (nome, cpf, data_nasc, email, senha, data_cadastro) VALUES (?, ?, ?, ?, SHA1(?), ?);";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->nome);
            $stmt->bindValue(2, $model->cpf);
            $stmt->bindValue(3, $model->data_nasc);
            $stmt->bindValue(4, $model->email);
            $stmt->bindValue(5, $model->senha);
            $stmt->bindValue(6, $model->data_cadastro);
            $stmt->execute();

            //echo "";
            //echo "_____________CADASTROU_____________";
            //echo "";

            $model->id = $this->conexao->lastInsertId();

            //echo " DAO _____________________________________________________________";
            //var_dump($model);

            return $model;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    private function Update(CorrentistaModel $model) : bool
    {
        try
        {
            $sql = "UPDATE correntista SET nome=?, cpf=?, data_nasc=?, email=?, senha=SHA1(?) WHERE id=?";

            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(1, $model->nome);
            $stmt->bindValue(2, $model->cpf);
            $stmt->bindValue(3, $model->data_nasc);
            $stmt->bindValue(4, $model->email);
            $stmt->bindValue(5, $model->senha);
            $stmt->bindValue(7, $model->id);

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

    public function SelectByCpfAndSenha($Cpf, $Senha) : CorrentistaModel
    {
        try
        {
            $sql = 'SELECT * FROM correntista WHERE cpf = ? AND senha = SHA1(?);';
            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(1, $Cpf);
            $stmt->bindValue(2, $Senha);
            $stmt->execute();

            $obj = $stmt->fetchObject('App\Model\CorrentistaModel');

            /*echo "____________________DAO_____________________________________";
            var_dump($obj);
            echo "_________________________________________________________";*/

            return is_object($obj) ? $obj : new CorrentistaModel();
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        
    }
}