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
            $model->Id = $json_obj->Id;
            $model->Tipo = $json_obj->Tipo;
            $model->Senha = $json_obj->Senha;
            $model->Ativo = $json_obj->Ativo;
            $model->Id_correntista = $json_obj->Id_correntista;

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