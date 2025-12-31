<?php
namespace App\Controller;
use MF\Controller\Action;
use MF\Model\Container;
use App\Core\Request;

class ProdutoController extends Action
{   
    // Todos os dados inseridos aqui se tornam acessíveis nas views
    protected array $dependencias = [];
    protected Request $request;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->request->preencherAttr($_SERVER['REQUEST_URI']);
        $this->initDependencias();
    }

    public function initDependencias() :void
    {
        $this->dependencias['setor'] = Container::getModel('Setor');
        $this->dependencias['finalidade'] =  Container::getModel('GrupoFinalidade');
        $this->dependencias['categoria'] =  Container::getModel('Categoria');
        $this->dependencias['produto'] =  Container::getModel('Produto');
        $this->dependencias['form']['produtoId'] = $this->request->getId();
    }

    public function cadastro() :void
    {   
        $this->dependencias['form']['acao'] = 'Cadastro';
        $this->dependencias['form']['action'] = '/produto/cadastrar';
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
        $this->render('listaProduto');
    }
    
    public function view() :void
    {
        $this->dependencias['form']['acao'] = 'Visualização';
        $this->dependencias['form']['action'] = '/produto/cadastrar';
        $this->render('formProduto');
    }
}