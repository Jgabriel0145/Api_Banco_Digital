<?php

namespace App\Model;

use App\DAO\ContaDAO;

class ContaModel extends Model
{
    public $Id, $Numero, $Tipo, $Senha, $Ativo, $Id_correntista;

    public function Save()
    {
        $dao = new ContaDAO();

        if($this->Id == null)
            return (new ContaDAO())->insert($this); 
        else 
            return (new ContaDAO())->update($this);
    }

    public function GetAllRows(string $query = null)
    {
        $dao = new ContaDAO();

        $this->rows = ($query == null) ? $dao->Select() : $dao->Search($query);
    }

    /*public function Delete(int $id)
    {
        (new ContaDAO())->Delete($id);
    }*/
}