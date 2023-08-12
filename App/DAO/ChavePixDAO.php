<?php

namespace App\DAO;

use App\Model\ChavePixModel;

use \PDO;

class ChavePixDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Save(ChavePixModel $model) : ?ChavePixModel
    {
        return ($model->id !== null) ? $this->Insert($model) : $this->Update($model);
    }

    public function Insert(ChavePixModel $model) : ?ChavePixModel
    {
        $sql = "INSERT INTO chavepix (chave, tipo, id_conta)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->chave);
        $stmt->bindValue(2, $model->tipo);
        $stmt->bindValue(3, $model->id_conta);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function Update(ChavePixModel $model) : ?ChavePixModel
    {
        $sql = "UPDATE chave_pix SET chave = ?, tipo = ?, id_conta = ? WHERE id = ?;";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->chave);
        $stmt->bindValue(2, $model->tipo);
        $stmt->bindValue(3, $model->id_conta);
        $stmt->bindValue(4, $model->id);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function Select(int $id_correntista)
    {
        $sql = 'SELECT * FROM chave_pix cp JOIN conta c ON (cp.id_conta = c.id) WHERE c.id_ccorrentista = ?';

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id_correntista);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function Delete(ChavePixModel $model) : bool
    {
        $sql = 'DELETE FROM chave_pix WHERE id = ? AND id_conta = ?';

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->id);
        $stmt->bindValue(2, $model->id_conta);

        return $stmt->execute();
    }
}