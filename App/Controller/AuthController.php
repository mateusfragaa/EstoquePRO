<?php
namespace App\Controller;
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action{

    public function login() :void
    {   
        $this->render('login');
    }

    public function autenticar() :void
    {   
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $usuarioModel = Container::getModel('usuario');
        $usuarioModel = $usuarioModel->firstOrFail('us_login',$usuario);

        if(!empty($usuarioModel) && password_verify($senha, $usuarioModel['US_SENHA']) && $usuarioModel['US_STATUS_ID'] == 1){
            $_SESSION['usuarioLogin'] = [
                'userID' => $usuarioModel['USUARIO_ID'],
                'userNome' => $usuarioModel['US_NOME'],
                'userNivel' => $usuarioModel['US_PERFIL_ID']
            ];
            header('Location: /');
            exit();
        }else{
            $_SESSION['error'] = "Login ou senha inválidos";
            header('Location: /login');
            exit();
        };
    }

    public function logout() :void
    {
        unset($_SESSION['usuarioLogin']);
        header('Location: /');
        exit();
    }
}
