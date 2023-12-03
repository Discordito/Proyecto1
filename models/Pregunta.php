<?php 

namespace Model;

class Pregunta extends ActiveRecord {
    protected static $tabla = 'pregunta';
    protected static $columnasDB = ['id', 'descripcion', 'usuarios_id', 'estandar_id', 'url'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->usuarios_id = $args['usuarios_id'] ?? null;       
        $this->estandar_id = $args['estandar_id'] ?? null;       
        $this->url = $args['url'] ?? '';       
    }
}

?>