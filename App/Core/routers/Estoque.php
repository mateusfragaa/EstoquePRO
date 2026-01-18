<?php
$controller = 'EstoqueController';

// ============================================== \\
//       Tela principal de listagem e os filtros                                         
// ============================================== \\

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

// ============================================== \\
//       Rotas de Cadastro                                                                
// ============================================== \\

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

// ============================================== \\
//       Rotas de Visualização                                     
// ============================================== \\

$rotas['VisualizarProdutoSetor'] = [
    'route' => '/estoque/view',
    'controller' => $controller,
    'action' => 'view'
];

// ============================================== \\
//       Rotas de Edição                        
// ============================================== \\

$rotas['FormularioEditar'] = [
    'route' => '/estoque/edicao',
    'controller' => $controller,
    'action' => 'formEditar'
];

$rotas['EditarSetorProduto'] = [
    'route' => '/estoque/editar',
    'controller' => $controller,
    'action' => 'editar'
];

// ============================================== \\
//       Rotas de Exclusão                       
// ============================================== \\

/*$rotas['FormularioExcluir'] = [
    'route' => '/estoque/exclusao',
    'controller' => $controller,
    'action' => 'formExcluir'
];

$rotas['EditarSetorProduto'] = [
    'route' => '/estoque/excluir',
    'controller' => $controller,
    'action' => 'excluir'
];*/