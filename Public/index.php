<?php
define('PATH_BASE', dirname(__DIR__));
session_start();
// echo '<pre>';
//     print_r($_SESSION);
// echo "</pre>";
require __DIR__."/../vendor/autoload.php";
require __DIR__."/../App/helper/helper.php";

use App\Core\Rotas;
use App\Core\Ambiente;
use App\Core\Conexao;

Ambiente::load();
$rota = new Rotas();
