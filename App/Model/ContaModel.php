<?php

namespace App\Model;

use App\DAO\ContaDAO;

class ContaModel extends Model
{
    public $id, $tipo, $saldo, $limite, $id_correntista;

    public function Save()
    {
        $dao = new ContaDAO();

        if($this->id == null)
            return (new ContaDAO())->Insert($this); 
        else 
            return (new ContaDAO())->Update($this);
    }

    public function GetAllRows(string $query = null)
    {
        $dao = new ContaDAO();

        $this->rows = ($query == null) ? $dao->Select() : $dao->Search($query);
    }

    public function SearchCorrente($id_correntista) : ContaModel
    {
        return (new ContaDAO())->SearchCorrente($id_correntista);
    }

    public function SearchPoupanca($id_correntista) : ContaModel
    {
        return (new ContaDAO())->SearchCorrente($id_correntista);
    }

    public function SearchContas($id)
    {
        return $this->rows = (new ContaDAO())->SearchContas($id);
    }

    /*public function Delete(int $id)
    {
        (new ContaDAO())->Delete($id);
    }*/
}