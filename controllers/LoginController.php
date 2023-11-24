<?php
namespace Controllers;

use Clases\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router)  {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();
            if(empty($alertas)){
                //verificar que el usuario exista
                $usuario = Usuario::where('email', $usuario->email);
                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error', 'El Usuario no Existe o no esta Confirmado.');
                }else {
                    //el usuario si existe
                    if(password_verify($_POST['password'], $usuario->password)){
                        //iniciar sesion
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccion
                        header('Location: /dashboard');
                    }else {
                        Usuario::setAlerta('error', 'Contraseña Incorrecta.');
                    }
                }

            }
        }
        $alertas = Usuario::getAlertas();
        //Reender a la Vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesion',
            'alertas' => $alertas
        ]);
    }
    public static function logout()  {
        session_start();
        $_SESSION = [];
        header('Location: /');
        
    }
    public static function crear(Router $router)  {
        $alertas = [];
        $usuario = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if(empty($alertas)){
                $existeUsusario = Usuario::where('email', $usuario->email);

                if($existeUsusario){
                    Usuario::setAlerta('error', 'El usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                }else {
                    //Hash password
                    $usuario->hashPassword();

                    //eliminar password2
                    unset($usuario->password2);

                    //generar token
                    $usuario->crearToken();

                    //crear nuevo usuario
                    $resultado = $usuario->guardar();

                    //enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
            
        }
        //Render a la Vista
        $router->render('auth/crear', [
            'titulo' => 'Crea tu Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function olvide(Router $router)  {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();
            if(empty($alertas)){
                //buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);
                if($usuario && $usuario->confirmado){
                    //Generar nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    //actualizar usuario
                    $usuario->guardar();

                    //imprimir la alerta
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu emial');

                    //enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                }else {
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        //Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Contraseña',
            'alertas' => $alertas
        ]);
    }
    public static function reestablecer(Router $router)  {
        $token =s($_GET['token']);
        $mostrar = true;
        if(!$token) header('Location: /');
        //identificar el usuario con ese token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no valido.');
            $mostrar = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //añadir el nuevo password
            $usuario->sincronizar($_POST);

            //validar el password
            $alertas = $usuario->validarPassword();
            if(empty($alertas)) {
                //hash nuevo password
                $usuario->hashPassword();

                //eliminar el token
                $usuario->token = null;

                //guardar en la base de datos
                $resultado = $usuario->guardar();

                //redireccion
                if($resultado){
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        //Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Contraseña',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }
    public static function mensaje(Router $router)  {
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente '
        ]);
    }
    public static function confirmar(Router $router)  {
        $token = s($_GET['token']);
        if(!$token) header('Location: /');

        //encontrar al usuario
        $usuario =Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no Valido');
        }else {
            //confirmar cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);

            //guardar en la BD
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu Cuenta',
            'alertas' => $alertas
        ]);
    }
}