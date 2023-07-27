<?php

namespace App\Model;

use Exception;

use App\DAO\CorrentistaDAO;
use App\DAO\ContaDAO;

class CorrentistaModel extends Model
{
    public $id, $nome, $cpf, $data_nasc, $senha, $email, $data_cadastro; //correntista
    public $rows_contas; //conta

    public function Save() : ?CorrentistaModel
    {
        $model_completa = (new CorrentistaDAO())->Save($this);

        if ($model_completa->id != null)
        {
            $conta_dao = new ContaDAO();

            //conta corrente
            $conta_corrente = new ContaModel();
            $conta_corrente->id_correntista = $model_completa->id;
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'C';
            $conta_corrente = $conta_dao->Insert($conta_corrente);

            $model_completa->rows_contas[] = $conta_corrente;

            //conta poupança
            $conta_poupanca = new ContaModel();
            $conta_poupanca->id_correntista = $model_completa->id;
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca->tipo = 'P';
            $conta_poupanca = $conta_dao->Insert($conta_poupanca);

            $model_completa->rows_contas[] = $conta_poupanca;
        }

        return $model_completa;
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