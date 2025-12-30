<?php
$controller = "AuthController";
$rotas['login'] = [
    "route" => "/login",
    "controller" => $controller,
    "action" => "login"
];

$rotas['autenticar'] = [
    "route" => "/login/autenticar",
    "controller" => $controller,
    "action" => "autenticar"
];

$rotas['logout'] = [
    "route" => "/logout",
    "controller" => $controller,
    "action" => "logout"
];
