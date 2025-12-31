<?php
namespace App\Controller;
use MF\Controller\Action;
use MF\Model\Container;
use App\Core\Request;

class ProdutoController extends Action
{   
    protected Request $request;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->request->preencherAttr($_SERVER['REQUEST_URI']);
        $this->view->form['dados'] = $this->dadosForm();
    }

    private function dadosForm() :array
    {
        return [
            'setor' => Container::getModel('Setor')->select()->execute(),
            'finalidade'=>  Container::getModel('GrupoFinalidade')->select()->execute(),
            'categoria' =>  Container::getModel('Categoria')->select()->execute(),
            'formProdutoAcao' => Container::getModel('Produto')->firstOrFail('produto_id',$this->request->getId())  
        ];
    }

    public function formcadastro() :void
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
        $this->view->form['dados']['produto'] = Container::getModel('Produto')->select()->execute();
        $this->render('listaProduto');
    }
    
    public function view() :void
    {
        $this->view->form['acao'] = 'Visualização';
        $this->view->form['action'] = '#';
        $this->render('formProduto');
    }
}