<?php

namespace App\Controller;

use App\Model\ChavePixModel;
use Exception;

class ChavePixController extends Controller
{
    public static function SalvarChavePix() : void
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new ChavePixModel();

            $model->chave = $json_obj->chave;
            $model->tipo = $json_obj->tipo;
            $model->id_conta = $json_obj->id_conta;

            parent::GetResponseAsJSON($model->Save());
        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function ExcluirChavePix() : void
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new ChavePixModel();

            $model->id = $json_obj->id;
            $model->id_conta = $json_obj->id_conta;
        } 
        catch (Exception $e) 
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function ListarChavePix() : void
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new ChavePixModel();

            parent::GetResponseAsJSON($model->GetAllRows($json_obj->id_correntista));
        } 
        catch (Exception $e) 
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }
}