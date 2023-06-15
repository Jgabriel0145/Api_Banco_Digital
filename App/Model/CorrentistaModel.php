<?php

namespace App\Model;

use Exception;

use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{
    public $id, $nome, $cpf, $data_nasc, $senha, $email, $data_cadastro;

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

    public function GetByCpfAndSenha($Cpf, $Senha) : CorrentistaModel
    {
        return (new CorrentistaDAO())->SelectByCpfAndSenha($Cpf, $Senha);
    }
}