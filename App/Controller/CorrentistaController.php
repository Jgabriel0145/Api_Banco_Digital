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

            $model = new CorrentistaModel();
            $model->Nome = $json_obj->Nome;
            $model->Cpf = $json_obj->Cpf;
            $model->Data_Nasc = $json_obj->Data_Nasc;
            $model->Senha = $json_obj->Senha;
            $model->Ativo = $json_obj->Ativo;
            $model->Id_Conta = $json_obj->Id_Conta;

            $model->Save();
        } 
        catch (Exception $e)
        {
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function Entrar()
    {
        try 
        {
            
        } 
        catch (Exception $e) 
        {
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function DesativarCorrentista()
    {
        try 
        {
            
        } 
        catch (Exception $e) 
        {
            parent::GetExceptionAsJSON($e);
        }
    }
}