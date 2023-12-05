<?php 

namespace Model;

class Pregunta extends ActiveRecord {
    protected static $tabla = 'pregunta';
    protected static $columnasDB = ['id', 'descripcion', 'usuarios_id', 'estandar_id', 'url', 'titulo', 'respuesta', 'estado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->usuarios_id = $args['usuarios_id'] ?? null;       
        $this->estandar_id = $args['estandar_id'] ?? null;       
        $this->url = $args['url'] ?? '';       
        $this->titulo = $args['titulo'] ?? '';       
        $this->respuesta = $args['respuesta'] ?? '';       
        $this->estado = $args['estado'] ?? 0;       
    }
}

?>