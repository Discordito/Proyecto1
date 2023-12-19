<?php

namespace Model;

class Recomendacion extends ActiveRecord{
    protected static $tabla = 'recomendacion';
    protected static $columnasDB = ['id', 'descripcion', 'opcion', 'item_id'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->opcion = $args['opcion'] ?? null;       
        $this->item_id = $args['item_id'] ?? null; 
    }
}
?>