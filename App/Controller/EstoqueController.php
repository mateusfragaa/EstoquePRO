<?php
namespace App\Controller;
use MF\Controller\Action;
use MF\Model\Container;
use App\Core\Request;

class EstoqueController extends Action{
    public function listagem() :void
    {
        $this->render('estoque');    
    }

    public function teste() :void
    {
        echo '<pre>';
        print_r($_GET);
        echo "</pre>";   
    }
}