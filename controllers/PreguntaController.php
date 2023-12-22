<?php

namespace Controllers;

use Model\Pregunta;

class PreguntaController {
    
    public static function index(){
        $preguntas = Pregunta::all();
        echo json_encode(['preguntas' => $preguntas]);
    }
    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            $pregunta = Pregunta::where('url', $_POST['url']);
            if(!$pregunta || $pregunta->usuarios_id !== $_SESSION['id']){
                $respuesta =[ 
                    'tipo' => 'error',
                    'mensaje' => 'Error al actualizar la pregunta'
                ];
                echo json_encode($respuesta);
                return;
            }
            $pre = new Pregunta($_POST);
            $resultado = $pre->guardar();
            if($resultado){
                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => 'Actualizado Correctamente'
                ];
                echo json_encode(['respuesta' => $respuesta]);
            }           
        }
    }
    public static function responder(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            $pregunta = Pregunta::where('url', $_POST['url']);
            if(!$pregunta || $pregunta->usuarios_id !== $_SESSION['id']){
                $respuesta =[ 
                    'tipo' => 'error',
                    'mensaje' => 'Error al actualizar la pregunta'
                ];
                echo json_encode($respuesta);
                return;
            }
            $pre = new Pregunta($_POST);
            $resultado = $pre->guardar();
            if($resultado){
                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => 'Respuesta guardada correctamente'
                ];
                echo json_encode(['respuesta' => $respuesta]);
            }
        }
    }
}