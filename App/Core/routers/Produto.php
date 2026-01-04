<?php

$controller = "ProdutoController";

$rotas['FormularioCadastro'] = [
    "route" => "/produto/cadastro",
    "controller" => $controller,
    "action" => "formcadastro"
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

$rotas['ListagemProduto'] = [
    "route" => "/produto/listagem",
    "controller" => $controller,
    "action" => "listagem"
];

$rotas['FormularioEditar'] = [
    "route" => "/produto/edicao",
    "controller" => $controller,
    "action" => "formEditar"
];

$rotas['EditarProduto'] = [
    "route" => "/produto/editar",
    "controller" => $controller,
    "action" => "editar"
];

$rotas['FormularioExcluir'] = [
    "route" => "/produto/exclusao",
    "controller" => $controller,
    "action" => "formExcluir"
];

$rotas['ExcluirProduto'] = [
    "route" => "/produto/excluir",
    "controller" => $controller,
    "action" => "excluir"
];
