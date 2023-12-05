<?php

namespace Controllers;

use Model\Pregunta;
use Model\Rol;
use MVC\Router;

class AdminController {
    public static function index(Router $router) {
        session_start();
        isAuth();
        $rol = Rol::where('usuarios_id', $_SESSION['id']);
        if($rol->nombre !== "Administrador"){
            header('Location: /dashboard');
        }
        

        $router->render('/dashboard/administrar',[
            'titulo' => 'Bienvenido'
        ]);
    }
}