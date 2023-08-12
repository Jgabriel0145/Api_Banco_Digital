<?php

namespace App\Model;

use App\DAO\ChavePixDAO;

class ChavePixModel extends Model
{
    public $id, $chave, $tipo, $id_conta;

    public function Save() : ?ChavePixModel
    {
        return (new ChavePixDAO())->Save($this);
    }

    public function GetAllRows(int $id_correntista) : array
    {
        return (new ChavePixDAO())->Select($id_correntista);        
    }

    public function Delete() : bool
    {
        return (new ChavePixDAO())->Delete($this);        
    }
}