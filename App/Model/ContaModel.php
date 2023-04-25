<?php

namespace App\Model;

use App\DAO\ContaDAO;

class ContaModel extends Model
{
    public $Id, $Numero, $Tipo, $Senha, $Ativo;

    public function Save()
    {
        $dao = new ContaDAO();

        if(empty($this->Id))
        {
            $dao->Insert($this);

        } else {

            $dao->Update($this);
        } 
    }

    public function DesativarConta()
    {
        $dao = new ContaDAO();
        
        $dao->DesativarConta($this);
    }
}