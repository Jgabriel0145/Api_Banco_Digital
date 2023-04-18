<?php

namespace App\Controller;

use Exception;

class CorrentistaController extends Controller
{
    public static function Save(): void
    {
        try 
        {

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