<?php
$controller = 'EstoqueController';

$rotas['ListagemEstoque'] = [
    'route' => '/estoque',
    'controller' => $controller,
    'action' => 'listagem'
];

$rotas['FiltroProdutoSetor'] = [
    'route' => '/estoque/filter',
    'controller' => $controller,
    'action' => 'produtoSetor'
];

$rotas['FormCadastro'] = [
    'route' => '/estoque/cadastro',
    'controller' => $controller,
    'action' => 'FormCadastro'
];

$rotas['CadastrarProdutoSetor'] = [
    'route' => '/estoque/cadastrar',
    'controller' => $controller,
    'action' => 'cadastrar'
];
