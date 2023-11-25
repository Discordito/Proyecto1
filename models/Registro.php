<?php 

namespace Model;

class Registro extends ActiveRecord {
    protected static $tabla = 'registro';
    protected static $columnasDB = ['id', 'puntaje', 'date', 'usuarios_id', 'item_id'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->puntaje = $args['id'] ?? '';
        $this->date = $args['id'] ?? '';
        $this->usuarios_id = $args['id'] ?? '';
        $this->item_id = $args['id'] ?? '';
    }
}

?>