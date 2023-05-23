<?php

namespace App\Model;

use Exception;

use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{
    public $Id, $Nome, $Email, $Cpf, $Data_Nasc, $Senha;

    public function Save() : ?CorrentistaModel
    {
        return (new CorrentistaDAO())->Save($this);        
    }

    public function GetAllRows(string $query = null)
    {
        $dao = new CorrentistaDAO();

        $this->rows = ($query == null) ? $dao->Select() : $dao->Search($query);
    }

    public function Delete(int $id)
    {
        (new CorrentistaDAO())->Delete($id);
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