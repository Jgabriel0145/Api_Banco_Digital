<?php

namespace App\Controller;

use Exception;

class ChavePixController extends Controller
{
    public static function CriarChavePix()
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