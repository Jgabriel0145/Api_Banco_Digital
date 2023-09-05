<?php

namespace App\DAO;

use Exception;
use App\Model\ContaModel;

class ContaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Insert(ContaModel $model) : ContaModel
    {
        try 
        {
            $sql = "INSERT INTO conta(tipo, saldo, limite, id_correntista) VALUES (?, ?, ?, ?);";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->tipo);
            $stmt->bindValue(2, $model->saldo);
            $stmt->bindValue(3, $model->limite);
            $stmt->bindValue(4, $model->id_correntista);
            $stmt->execute();

            $model->id = $this->conexao->lastInsertId();
            return $model;
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
            $sql = 'SELECT * FROM conta';

            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(DAO::FETCH_CLASS, 'App\Model\ContaModel');
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

            $sql = 'SELECT * FROM conta WHERE numero LIKE :filtro';

            $stmt = $this->conexao->prepare($sql);
            $stmt->execute($str_query);

            return $stmt->fetchAll(DAO::FETCH_CLASS, 'App\Model\ContaModel');
        }
        
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function Update(ContaModel $model) : bool
    {
        try 
        {
            $sql = "UPDATE conta SET  id_correntista=? WHERE id=?";
            
            $stmt = $this->conexao->prepare($sql);
            
            $stmt->bindValue(1, $model->tipo);
            $stmt->bindValue(2, $model->saldo);
            $stmt->bindValue(3, $model->limite);
            $stmt->bindValue(4, $model->id_correntista);
            $stmt->bindValue(5, $model->id);

            return $stmt->execute();
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function SearchCorrente($id_correntista) : ContaModel
    {
        try
        {
            $sql = "SELECT * FROM conta WHERE tipo = 'C' AND id_correntista = ?";

            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(1, $id_correntista);

            $stmt->execute();

            $obj = $stmt->fetchObject(DAO::FETCH_CLASS, 'APP\Model\ContaModel');

            return is_object($obj) ? $obj : new ContaModel();
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function SearchPoupanca($id_correntista) : ContaModel
    {
        try
        {
            $sql = "SELECT * FROM conta WHERE tipo = 'P' AND id_correntista = ?";

            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(1, $id_correntista);

            $stmt->execute();

            $obj = $stmt->fetchObject(DAO::FETCH_CLASS, 'APP\Model\ContaModel');

            return is_object($obj) ? $obj : new ContaModel();
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    /*public function Delete(int $id) : bool
    {
        $sql = "DELETE FROM conta WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
        test
    }*/
}