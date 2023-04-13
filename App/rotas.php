<?php

use App\Controller\{ChavePixController, ContaController, CorrentistaController, TransacaoController};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url)
{
    case '':
        break;

    case '';
        break;

    case '':
        break;

    case '':
        break;

    default:
        http_response_code(403);
        break;
}