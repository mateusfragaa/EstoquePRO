<?php
namespace App\Controller;
use MF\Controller\Action;
use MF\Model\Container;
use App\Core\Request;

class ProdutoController extends Action
{   
    public function __construct()
    {
        parent::__construct();
        Request::preencherAttr($_SERVER['REQUEST_URI']);
    }

    public function cadastro() :void
    {   
        $this->view->form['acao'] = 'Cadastro';
        $this->view->form['action'] = '/produto/cadastrar';
        $this->render('formProduto');
    }

    public function cadastrar() :void
    {
        $prod = Container::getModel('Produto');
        // Uso de try catch para capturar erros vindo da procedure de cadastro
        try{
            $_SESSION['produto'] = $prod->cadastroProduto($_POST)[0];
        }catch(Exeption $e){
            var_dump("$e");
        }
        header('Location: /produto/cadastro');
        exit();
    }

    public function listagem() :void
    {   
        $prod = Container::getModel('Produto');
        $this->view->listProducts = $prod->select()->execute();
        $this->render('listaProduto');
    }
    
    public function view() :void
    {
        $prod = Container::getModel('Produto');
        $this->view->form['data'] = $prod->firstOrFail('produto_id',Request::getId());
        $this->view->form['acao'] = 'Visualização';
        $this->view->form['action'] = '/produto/cadastrar';
        $this->render('formProduto');
    }
}