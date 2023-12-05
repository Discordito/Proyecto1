<?php

namespace Controllers;

use DateInterval;
use DateTime;
use DateTimeZone;
use Model\Estandar;
use Model\Item;
use Model\Membresia;
use Model\Pago;
use Model\Pregunta;
use Model\Proyecto;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

use function PHPSTORM_META\type;

class DashboardController {
    public static function index(Router $router) {
        session_start();
        $estandares = Estandar::all();
        $router->render('dashboard/index',[
            'titulo' => 'Estandares',
            'estandares' => $estandares
        ]);
    }
    public static function pregunta(Router $router) {
        session_start();
        isAuth();
        $pregunta = [];
        $id = $_GET['id'];
        $items = Item::belognsTo('estandarid', $id);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
            $pregunta['descripcion'] = $_POST['consulta'];
            $pregunta['usuarios_id'] = $_SESSION['id'];
            $pregunta['estandar_id'] = $id;
            $hash = md5(uniqid());
            $pregunta['url'] = $hash;
            $pregunta['titulo'] = $_POST['titulo'];

            $pre = new Pregunta($pregunta);
            
            $pre->guardar();
            header('Location: /pregunta_usuario?id=' . $pre->url);
        }
        $router->render('dashboard/pregunta',[
            'titulo' => 'Preguntar',
            'items' => $items,
            'alertas' => $alerta
        ]);
    }
    public static function pregunta_usuario(Router $router){
        session_start();
        isAuth();
        
        $url = $_GET['id'];
        if(!$url) header('Location: /dashboard');
        $pregunta = Pregunta::where('url', $url);
        if($pregunta->usuarios_id !== $_SESSION['id']){
            header('Location: /dashboard');
        }

        $router->render('dashboard/pregunta_usuario',[
            'titulo' => $pregunta->titulo,
            'descripcion' => $pregunta->descripcion
        ]);
    }
    public static function preguntas(Router $router) {
        session_start();
        isAuth();
        $pregunta = [];
        $id = $_GET['id'];
        $preguntas = Pregunta::belognsTo('usuarios_id', $_SESSION['id']);
        
        $router->render('dashboard/preguntas',[
            'titulo' => 'Preguntas',
            'preguntas' => $preguntas
        ]);
    }
    public static function estandar(Router $router){
        session_start();
        $suma = 0;
        $ro = [];
        $estadoMembresia = 0;
        $idUsuario = 0;
        $registro = new Registro();
        $id = $_GET['id'];
        $estandares = Estandar::where('id', $id);
        $items = Item::belognsTo('estandarid', $id);
        //datos para saber si tiene membresia
        $membresia = Membresia::belognsTo('usuario_id', $_SESSION['id']);
        foreach($membresia as $m){
            if($m->estado === '1'){
                $idEstandar = $id;
                $estadoMembresia = $m->estado;
            }
        }       

        if($_SERVER['REQUEST_METHOD'] === 'POST'){  
            $ro = $_POST;      
            foreach($ro as $key => $value){
                if(gettype($key) === gettype('')){
                    $registro->date = $value;                                        
                }else {
                    $registro->usuarios_id = intval($_SESSION['id']);
                    $registro->estandar_id = intval($id);
                    if($id === '1'){
                        if($key === 1){$suma = $value*0.2;}
                        if($key === 3){$suma = $suma + ($value*0.5); }
                        if($key === 4){$suma = $suma + ($value*0.2);  }
                        if($key === 5){$suma = $suma + ($value*0.1);  }
                    }
                    if($id === '2') {
                        if($key === 2){$suma = $suma + ($value*0.6);}
                        if($key === 6){$suma = $suma + ($value*0.2);}
                        if($key === 7){$suma = $suma + ($value*0.2);}
                    }
                    if($id === '3') {
                        if($key === 8){$suma = $value*0.5;}
                        if($key === 9){$suma = $suma + ($value*0.5);}
                    }
                    if($id === '4') {
                        if($key === 10){$suma = $value*1;}
                    }
                    $suma = floor($suma);
                    $registro->puntaje = $suma;
                }
                // $registro->date = $key;
                
            }             
            // var_dump($registro);
            $registro->guardar();
            Estandar::setAlerta('exito', 'Registro guardado correctamente');
        }
        $alertas = Estandar::getAlertas();
        $router->render('dashboard/estandar',[
            'titulo' => $estandares->nombre,
            'id' => $estandares,
            'items' => $items,
            'alertas' => $alertas,
            'estado' => $estadoMembresia,
            'idEstandar' => $idEstandar
        ]);
    }
    public static function registro(Router $router){
        session_start();
        isAuth();
        $id = $_SESSION['id'];
        $registros = Registro::belognsTo('usuarios_id', $id);
        foreach($registros as $reg){
            $nwDate = $reg->date;
            $fnDate = date("d-m-Y H:i:s", strtotime($nwDate)); 
            $reg->date = $fnDate;          
        }
        $router->render('dashboard/registro',[
            'titulo' => 'Registros',
            'registros' => $registros
        ]);
    }
    public static function membresia (Router $router){
        session_start();
        isAuth();
        $id = $_SESSION['id'];
        $membresia = 'No tiene membresia activa';
        $membresiaEstado = '';
        $membresiaInicio = '';
        $membresiaTermino = '';
        $tiempo = '';
        $verificarPago = Pago::where('usuario_id', $id);
        $verificarmembresia = Membresia::belognsTo('usuario_id', $id);
        foreach($verificarmembresia as $estado){
            
            if($estado->estado === '1'){
                $membresiaEstado = '1';
                $membresiaInicio = $estado->i_date;
                $membresiaTermino = $estado->f_date;
                $membresia = $estado->membresia;

                $timeZone = new \DateTimeZone("America/Santiago");      
                $nowDate = new \DateTime('now', $timeZone);
                $nwFecha = new DateTime($estado->f_date);
                $dif = $nwFecha->diff($nowDate);
                
                if($dif->invert === 1){
                    $tiempo = $dif->days;
                    
                }
            }else {
                $membresiaEstado = '0';
            }            
        }        
       
             
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){   
            session_start();
            $datoMembresia = []; 
            //valida que no venga vacio
            if(empty($_POST)){
                echo json_encode([]);
                return;
            }
            $datos = $_POST;
            $datos['usuario_id'] = $_SESSION['id'];            
            $datoMembresia['usuario_id'] = $_SESSION['id'];            
            $datoMembresia['membresia'] = $datos['descripcion'];            
            foreach($datos as $key => $value){
                if($key === 'date'){
                    
                    $zona = new \DateTimeZone("America/Santiago");      
                    $fechita = new \DateTime('now', $zona);
                    $fechi = $fechita->format('Y-m-d H:i:s');
                    $datos['date']= $fechi; 
                    $fechi = $fechita->format('Y-m-d');
                    $datoMembresia['i_date'] = $fechi;
                    $fechita->add(new DateInterval('P30D'));  
                    $f_date =  $fechita->format('Y-m-d');
                    $datoMembresia['f_date'] = $f_date;  
                    $datoMembresia['estado'] = 1;  

                }
            }     
            try{
                $pago = new Pago($datos);
                $pago->guardar();
                $mem = new Membresia($datoMembresia);
                $mem->guardar();
            } catch (\Throwable $th) {
                echo 'error';
            }
            
        }
        $router->render('dashboard/membresia', [
            'titulo' => 'Membresia',
            'membresia' => $membresia,
            'estado' => $membresiaEstado,
            'inicio' => $membresiaInicio,
            'termino' => $membresiaTermino,
            'tiempo' => $tiempo
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
            'alertas' => $alertas,
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
}