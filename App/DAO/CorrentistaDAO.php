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

    public function Insert(CorrentistaModel $model)
    {
        try 
        {
            $sql = "INSERT INTO conta(nome, cpf, data_nasc, senha, ativo, id_conta) VALUES (?, ?, ?, SHA1(?), ?, ?);";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model->Cpf);
            $stmt->bindValue(3, $model->Data_Nasc);
            $stmt->bindValue(4, $model->Senha);
            $stmt->bindValue(5, $model->Ativo);
            $stmt->bindValue(6, $model->Id_Conta);

            $stmt->execute();
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function Update()
    {
        try
        {

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