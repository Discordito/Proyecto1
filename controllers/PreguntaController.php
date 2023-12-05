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
            
        }
    }
}