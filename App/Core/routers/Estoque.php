<?php
$controller = 'EstoqueController';

$rotas['ListagemEstoque'] = [
    'route' => '/estoque',
    'controller' => $controller,
    'action' => 'listagem'
];

$rotas['teste'] = [
    'route' => '/estoque/view',
    'controller' => $controller,
    'action' => 'produtoSetor'
];
