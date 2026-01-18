<?php
namespace App\Controller;
use MF\Controller\Action;
use MF\Model\Container;
use App\Core\Request;
use App\Model\SetorModel;

class EstoqueController extends Action{

    protected Request $request;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->request->preencherAttr($_SERVER['REQUEST_URI']);
        $this->view->setor['dados'] = $this->dadosForm();
    }   

    public function dadosForm() :array
    {
        return [
            'setor' => Container::getModel('Setor')->select(['SETOR_ID','STR_NOME'])->execute(),
            'produto' => Container::getModel('Produto')->select(['PRODUTO_ID','PRD_NOME'])->execute(),
            'formEstoqueAcao' => Container::getModel('Estoque')->firstOrFail('SETOR_ESTOQUE_ID',$this->request->getId()),
        ];
    }

    public function view() :void
    {
        $this->view->form['acao'] = 'Visualização';
        $this->view->form['action'] = '#';
        $this->render('formEstoque');
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
        $this->view->setor['dados']['btnFormVoltar'] = $view;
        var_dump($this->view->setor['dados']['btnFormVoltar']);
        // die();
        $_SESSION['setorProduto'] = $this->view->setorProduto['dados'];
        header('Location: /estoque?options-outlined='.$view);
    }

    public function formEditar():void
    {
        var_dump($this->view->setor['dados']['formEstoqueAcao']);
        $this->view->form['acao'] = 'Edição';
        $this->view->form['action'] = '/estoque/editar';
        $_SESSION['setor_produto_editando_id'] = $this->request->getId();
        $this->render('formEstoque');
    }

    public function editar() :void
    {
        echo '<pre>';
        print_r($_POST);
        echo "</pre>";
        try{
            $_SESSION['setorProduto'] = Container::getModel('Estoque')->editar($_POST,$_SESSION['setor_produto_editando_id'])[0];
        }catch(Exception $e){
            var_dump($e);
        }
        die();
        header("Location: /estoque/cadastro");
        exit();
    }
}