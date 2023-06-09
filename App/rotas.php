<?php

use App\Controller\{ChavePixController, ContaController, CorrentistaController, TransacaoController};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url)
{
    case '/correntista/save':
        CorrentistaController::Save();
        break;

    case '/correntista':
        CorrentistaController::List();
        break;

    case '/correntista/search':
        CorrentistaController::Search();
        break;

    case '/correntista/login':
        CorrentistaController::Login();
        break;

    /*case '/correntista/delete':
        CorrentistaController::Delete();
        break;*/

    /*case '/correntista/login':
        CorrentistaController::Login();
        break;

    case '/conta/pix/enviar':
        ContaController::EnviarPix();
        break;

    case '/conta/pix/receber':
        ContaController::ReceberPix();
        break;

    case '/conta/extrato':
        ContaController::Extrato();
        break;*/

    default:
        http_response_code(403);
        break;
}