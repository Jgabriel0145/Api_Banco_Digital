<?php

namespace App\Model;

use Exception;

use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{
    public $Id, $Nome, $Cpf, $Data_Nasc, $Senha, $Email, $Ativo, $Id_Conta;

    public function Save()
    {
        $dao = new CorrentistaDAO();

        if(empty($this->Id))
        {
            $dao->Insert($this);

        } else {

            $dao->Update($this);
        } 
    }

    /*public function SelectUserAndSenha($json_obj)
    {
        try 
        {
            $dao = new CorrentistaDAO();

            $dados_usuario_logado = $dao->SelectUserAndSenha($json_obj);

            if (is_object($dados_usuario_logado))
                return $dados_usuario_logado;
            else
                null; 
        } 
        catch (Exception $e) 
        {
            throw new Exception($e->getMessage());
            return false;
        }

    }*/
}