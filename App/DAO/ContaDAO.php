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

    public function Insert(ContaModel $model)
    {
        try 
        {
            $sql = "INSERT INTO conta(numero, tipo, senha, ativo) VALUES (?, SHA1(?), ?, ?);";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->Numero);
            $stmt->bindValue(2, $model->Tipo);
            $stmt->bindValue(3, $model->Senha);
            $stmt->bindValue(4, $model->Ativo);

            $stmt->execute();
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function Update()
    {

    }

    public function DesativarConta(ContaModel $model)
    {
        $sql = "UPDATE INTO conta SET ativo = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->Ativo);
        $stmt->bindValue(2, $model->Id);
    }
}