<?php
use App\Core\Request;    

$controller = "ProdutoController";

$rotas['FormularioCadastro'] = [
    "route" => "/produto/cadastro",
    "controller" => $controller,
    "action" => "cadastro"
];

$rotas['CadastrarProduto'] = [
    "route" => "/produto/cadastrar",
    "controller" => $controller,
    "action" => "cadastrar"
];

$rotas['VisualizarProduto'] = [
    "route" => "/produto/view",
    "controller" => $controller,
    "action" => "view"
];

$rotas['Listagem'] = [
    "route" => "/produto/listagem",
    "controller" => $controller,
    "action" => "listagem"
];
