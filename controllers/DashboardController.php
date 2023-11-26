<?php

namespace Controllers;

use Model\Estandar;
use Model\Item;
use Model\Proyecto;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

use function PHPSTORM_META\type;

class DashboardController {
    public static function index(Router $router) {
        session_start();
        isAuth();
        $estandares = Estandar::all();
        $router->render('dashboard/index',[
            'titulo' => 'Estandares',
            'estandares' => $estandares
        ]);
    }
    public static function estandar(Router $router){
        session_start();
        $ro = [];
        $registro = new Registro();
        $id = $_GET['id'];
        $estandares = Estandar::where('id', $id);
        $items = Item::belognsTo('estandarid', $id);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){          
            $ro = $_POST;      
            foreach($ro as $key => $value){
                if(gettype($key) === gettype('')){
                    $registro->date = $value;  
                                      
                }else {
                    $registro->usuarios_id = $_SESSION['id'];
                    $registro->item_id = $key;
                    if($key === 1){
                        $registro->puntaje = $value*0.2;
                    }
                    if($key === 2){
                        $registro->puntaje = $value*0.6;
                    }
                    if($key === 3){
                        $registro->puntaje = $value*0.5;
                    }
                    if($key === 4){
                        $registro->puntaje = $value*0.2;
                    }
                    if($key === 5){
                        $registro->puntaje = $value*0.1;
                    }
                    if($key === 6){
                        $registro->puntaje = $value*0.2;
                    }
                    if($key === 7){
                        $registro->puntaje = $value*0.2;
                    }
                    if($key === 8){
                        $registro->puntaje = $value*0.5;
                    }
                    if($key === 9){
                        $registro->puntaje = $value*0.5;
                    }
                    if($key === 10){
                        $registro->puntaje = $value*1;
                    }
                    var_dump($registro);
                }
                
                  
                
                // $registro->date = $key;
                
            } 
            
              
        }
        $router->render('dashboard/estandar',[
            'titulo' => $estandares->nombre,
            'id' => $estandares,
            'items' => $items
        ]);
    }
    public static function perfil(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPerfil();

            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);
                if($existeUsuario && $existeUsuario->id !== $usuario->id){
                    //mensaje de error
                    Usuario::setAlerta('error', 'Email no valido');
                    $alertas = $usuario->getAlertas();
                }else {
                    //guardar el registro
                    $usuario->guardar();

                    Usuario::setAlerta('exito', 'Guardado Correcto');
                    $alertas = $usuario->getAlertas();
                    $_SESSION['nombre'] = $usuario->nombre;
                }              
            }
        }
        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function cambiar_password(Router $router){
        session_start();
        isAuth();

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = Usuario::find($_SESSION['id']);

            //sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);
            $alertas = $usuario->nuevo_password();
            if(empty($alertas)){
                $resultado = $usuario->comprobar_password();

                if($resultado){                    
                    $usuario->password = $usuario->password_nuevo;

                    //eliminar propiedades no necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    //hashear el nuevo password
                    $usuario->hashPassword();

                    //actualizar
                    $resultado = $usuario->guardar();
                    if($resultado){
                        Usuario::setAlerta('exito', 'Contraseña Guardada Exitosamente');
                        $alertas = $usuario->getAlertas();
                    }
                }else {
                    Usuario::setAlerta('error', 'Contraseña Incorrecta');
                    $alertas = $usuario->getAlertas();
                }
            }
        }
        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Cambiar Contraseña',
            'alertas' => $alertas,
            ''
        ]);
    }
    public static function registro(Router $router){
        session_start(); 
    }
}