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

            $model->Save();
        }
        catch (Exception $e) 
        {
            parent::GetExceptionAsJSON($e);
        }
    }

    public static function EnviarPix()
    {
        try
        {

        }
        catch (Exception $e)
        {
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
            parent::GetExceptionAsJSON($e);
        }
    }
}