<?php

namespace App\Core;
use MF\Init\Bootstrap;

class Rotas extends Bootstrap{
    public function initRoutes() :void
    {   
        $rotas = [];
        $rotas['home'] = [
            "route" => "/",
            "controller" => "IndexController",
            "action" => "index"
        ];

        require_once "routers/Auth.php";
        require_once "routers/Produto.php";
        require_once "routers/Estoque.php";

        $this->__set('rotas', $rotas);
    }
}