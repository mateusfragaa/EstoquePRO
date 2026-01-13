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
            'setor' => Container::getModel('Setor')->select()->execute()
        ];
    }

    public function listagem() :void
    {
        $this->render('estoque');    
    }

    public function produtoSetor() :void
    {
        echo "Entrou aqui";
        echo '<pre>';
        print_r($_GET);
        echo "</pre>";
        $estoqueModel = Container::getModel('Estoque');

        $view = '';
        if (getGet('options-outlined') == 'setor') {
            $view = 'setor';
            $this->view->setorProduto['dados'] = $estoqueModel->setorProdutos(getGet('setor'));
            // die();
        }elseif (getGet('options-outlined') == 'produto') {
            $view = 'produto';
            $this->view->setorProduto['dados'] = $estoqueModel->selectView('setores_produto')->execute();
        }
        
        $_SESSION['setorProduto'] = $this->view->setorProduto['dados'];
        header('Location: /estoque?options-outlined='.$view);

    }
}