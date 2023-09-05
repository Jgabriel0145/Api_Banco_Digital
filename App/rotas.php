<?php

use App\Controller\{ChavePixController, ContaController, CorrentistaController, TransacaoController};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url)
{
    //Correntista
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


    //Conta
    case '/conta/searchcorrente':
       
        ContaController::SearchCorrente();
        break;

    case '/conta/searchpoupanca':
        ContaController::SearchPoupanca();
        break;
    
    case '/chavepix/salvar':
        ChavePixController::SalvarChavePix();
        break;

    case '/chavepix/listar':
        ChavePixController::ListarChavePix();
        break;

    case '/chavepix/excluir':
        ChavePixController::ExcluirChavePix();
        break;

        

    default:
        http_response_code(403);
        break;
}