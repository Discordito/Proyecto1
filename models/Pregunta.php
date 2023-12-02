<?php 

namespace Model;

class Pregunta extends ActiveRecord {
    protected static $tabla = 'pregunta';
    protected static $columnasDB = ['id', 'descripcion', 'usuario_id', 'estandar_id'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? null;       
        $this->estandar_id = $args['estandar_id'] ?? null;       
    }
}

?>