<?php 
namespace Controllers;
use MVC\Router;
use Models\Admin;


class LoginController{
    public static function login(Router $router) {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {
                //si el usuario existe
              $resultado =  $auth->existeUsuario();

              if(!$resultado){
                $errores = Admin::getErrores();
              }else{
                //clave coincide
               $autenticado = $auth->comprobarPass($resultado);
                //autorizar al usuario
                if ($autenticado) {
                    $auth->autenticarUsuario();
                } else {
                    $errores= Admin::getErrores();
                }
                
              }
            }
        }
        $router->Render('auth/login',[
            'errores' => $errores
        ]);
    }
    public static function logout() {
        session_start();

        $_SESSION = [];

        header('Location:/');
    }



}

?>