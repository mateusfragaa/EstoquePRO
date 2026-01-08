<?php
$controller = 'EstoqueController';

$rotas['ListagemEstoque'] = [
    'route' => '/estoque',
    'controller' => $controller,
    'action' => 'listagem'
];

$rotas['teste'] = [
    'route' => '/teste',
    'controller' => $controller,
    'action' => 'teste'
];