<?php

namespace App\Controller;

use Exception;

use App\Model\CorrentistaModel;

class CorrentistaController extends Controller
{
    public static function Save(): void
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            //var_dump($json_obj);
            //exit;

            $model = new CorrentistaModel();
            
            /*foreach (get_object_vars($json_obj) as $key => $value)
            {
                $prop_letra_minuscula = strtolower($key);;

                $model->$prop_letra_minuscula = $value;
            }*/

            $model->Nome = $json_obj->Nome;
            $model->Cpf = $json_obj->Cpf;
            $model->Data_Nasc = $json_obj->Data_Nasc;
            $model->Senha = $json_obj->Senha;
            $model->Email = $json_obj->Email;
            $model->Data_Cadastro = $json_obj->Data_Cadastro;

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
            $model = new CorrentistaModel();

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
            $model = new CorrentistaModel();

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

            (new CorrentistaModel())->Delete ( (int) $id);
        }
        catch (Exception $e)
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }*/

    public static function Login()
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            
            parent::GetResponseAsJSON($model->GetByCpfAndSenha($json_obj->Cpf, $json_obj->Senha));
        } 
        catch (Exception $e) 
        {
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }
    }

    /*public static function DesativarCorrentista()
    {
        try 
        {
            
        } 
        catch (Exception $e) 
        {
            parent::GetExceptionAsJSON($e);
        }
    }*/
}