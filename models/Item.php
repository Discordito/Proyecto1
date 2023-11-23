<?php

namespace Model;

class Item extends ActiveRecord {
    protected static $tabla = 'item';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'estandarid'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->estandarid = $args['estandarid'] ?? '';
    }
}