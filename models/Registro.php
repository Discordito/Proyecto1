<?php 

namespace Model;

class Registro extends ActiveRecord {
    protected static $tabla = 'registro';
    protected static $columnasDB = ['id', 'puntaje', 'date', 'usuarios_id', 'estandar_id'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->puntaje = $args['puntaje'] ?? '';
        $this->date = $args['date'] ?? '';
        $this->usuarios_id = $args['usuarios_id'] ?? '';
        $this->estandar_id = $args['estandar_id'] ?? '';
    }
}

?>