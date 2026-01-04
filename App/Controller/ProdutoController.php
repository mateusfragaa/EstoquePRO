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
        try{
            $_SESSION['produto'] = Container::getModel('Produto')->cadastroProduto($_POST)[0];
        }catch(Exeption $e){
            var_dump("Erro");
        }
        header('Location: /produto/cadastro');
        exit();
    }

    public function listagem() :void
    {   
        $this->view->form['dados']['produto'] = Container::getModel('Produto')->selectView('listagem_produto')->execute();
        $this->render('listaProduto');
    }
    
    public function view() :void
    {
        $this->view->form['acao'] = 'Visualização';
        $this->view->form['action'] = '#';
        $this->render('formProduto');
    }

    public function formEditar() :void
    {       
        $this->view->form['acao'] = 'Edição';
        $this->view->form['action'] = '/produto/editar';
        $_SESSION['produto_editando_id'] = $this->request->getId();
        $this->render('formProduto');
    }

    public function editar() :void
    {   
        try{
            $_SESSION['produto'] = Container::getModel('Produto')->editarProduto($_POST,session('produto_editando_id'))[0];

        }catch(Exeption $e){
            var_dump("$e");
        }
        header('Location: /produto/listagem');
        exit();
    }

    public function formExcluir() :void
    {
        $this->view->form['acao'] = 'Exclusão';
        $this->view->form['action'] = '/produto/excluir';
        $_SESSION['produto_editando_id'] = $this->request->getId();
        $this->render('formProduto');
    }

    public function excluir() :void
    {
        Container::getModel('Produto')->excluirProduto(session('produto_editando_id'));
        header('Location: /produto/listagem?exclusao=1');
        exit();
    }
}