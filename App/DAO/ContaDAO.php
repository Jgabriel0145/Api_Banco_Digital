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
            $sql = "INSERT INTO conta(numero, tipo, senha, ativo, id_correntista) VALUES (?, SHA1(?), ?, ?, ?);";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->Numero);
            $stmt->bindValue(2, $model->Tipo);
            $stmt->bindValue(3, $model->Senha);
            $stmt->bindValue(4, $model->Ativo);
            $stmt->bindValue(5, $model->Id_correntista);
            $stmt->execute();

            $model->Id = $this->conexao->lastInsertId();
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
            $sql = "UPDATE conta SET numero=?, tipo=?, senha=SHA1(?), ativo=?, id_correntista=? WHERE id=?";
            
            $stmt = $this->conexao->prepare($sql);
            
            $stmt->bindValue(1, $model->Numero);
            $stmt->bindValue(2, $model->Tipo);
            $stmt->bindValue(3, $model->Senha);
            $stmt->bindValue(4, $model->Ativo);
            $stmt->bindValue(5, $model->Id_correntista);
            $stmt->bindValue(6, $model->Id);

            return $stmt->execute();
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
    }*/
}