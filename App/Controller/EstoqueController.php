<?php
namespace App\Controller;
use MF\Controller\Action;
use MF\Model\Container;
use App\Core\Request;
use App\Model\SetorModel;

class EstoqueController extends Action{

    public function __construct()
    {
        parent::__construct();
        $this->view->setor['dados'] = $this->dadosForm();
    }

    public function dadosForm() :array
    {
        return [
            'setor' => Container::getModel('Setor')->select(['SETOR_ID','STR_NOME'])->execute(),
            'produto' => Container::getModel('Produto')->select(['PRODUTO_ID','PRD_NOME'])->execute()
        ];
    }

    public function listagem() :void
    {
        $this->render('estoque');    
    }

    public function formcadastro():void
    {
        $this->view->form['acao'] = 'Cadastro';
        $this->view->form['action'] = '/estoque/cadastrar';
        $this->render('formEstoque');
    }

    public function cadastrar():void
    {
        try{
            $_SESSION['setorProduto'] = Container::getModel('Estoque')->cadastrar($_POST)[0];
        }catch(Exception $e){
            var_dump($e);
        }
        header("Location: /estoque/cadastro");
        exit();
    }

    public function produtoSetor() :void
    {
        $estoqueModel = Container::getModel('Estoque');
        $view = '';
        if (getGet('options-outlined') == 'setor') {
            $view = 'setor';
            $this->view->setorProduto['dados'] = $estoqueModel->setorProdutos(getGet('setor'));
        }elseif (getGet('options-outlined') == 'produto') {
            $view = 'produto';
            $this->view->setorProduto['dados'] = $estoqueModel->selectView('setores_produto')->execute();
        }
        $_SESSION['setorProduto'] = $this->view->setorProduto['dados'];
        header('Location: /estoque?options-outlined='.$view);
    }
}