<?php
namespace App\Controller;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action{
    public function index() :void
    {   
        $this->render('index');
    }
}