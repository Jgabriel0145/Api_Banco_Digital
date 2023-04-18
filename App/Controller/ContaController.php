<?php

namespace App\Controller;

use Exception;

class ContaController extends Controller
{
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
}