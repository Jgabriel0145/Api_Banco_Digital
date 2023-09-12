<?php

namespace App\Controller;

use Exception;

use App\Model\ContaModel;

class ContaController extends Controller
{
    public static function Save() : void
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new ContaModel();
            $model->id = $json_obj->id;
            $model->tipo = $json_obj->tipo;
            $model->saldo = $json_obj->saldo;
            $model->limite = $json_obj->limite;
            $model->id_correntista = $json_obj->id_correntista;

            parent::GetResponseAsJSON($model->Save());
        }
        catch (Exception $e) 
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function List() : void
    {
        try
        {
            $model = new ContaModel();

            $model->GetAllRows();

            parent::GetResponseAsJSON($model->rows);
        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function SearchCorrente() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $id_correntista = $json_obj->id;

            parent::GetResponseAsJSON((new ContaModel())->SearchCorrente($id_correntista));
        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function SearchPoupanca() : void
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $id_correntista = $json_obj->id;

            parent::GetResponseAsJSON((new ContaModel())->SearchPoupanca($id_correntista));
        } 
        catch (Exception $e) 
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function Search() : void
    {
        try
        {
            $model = new ContaModel();

            $q = json_decode(file_get_contents('php://input'));
        
            $model->GetAllRows($q);

            parent::GetResponseAsJSON($model->rows);
        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function SearchContas() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));
            
            $model = new ContaModel();

            $model->SearchContas($json_obj->id);

            //var_dump($model->rows);
            parent::GetResponseAsJSON($model->rows);
        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    /*public static function Delete() : void
    {
        try
        {
            $id = json_decode(file_get_contents('php://input'));

            (new ContaModel())->Delete( (int) $id);
        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }*/

    /*public static function EnviarPix()
    {
        try
        {

        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function ReceberPix()
    {
        try
        {

        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function Extrato()
    {
        try
        {

        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function DesativarConta()
    {
        try 
        {
            
        } 
        catch (Exception $e) 
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }*/
}