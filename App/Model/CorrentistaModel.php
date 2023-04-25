<?php

namespace App\Model;

use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{
    public $Id, $Nome, $Cpf, $Data_Nasc, $Senha, $Ativo, $Id_Conta;

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
}