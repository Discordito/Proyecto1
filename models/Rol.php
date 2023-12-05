<?php

namespace Model;

class Rol extends ActiveRecord {
    protected static $tabla = 'rol';
    protected static $columnasDB = ['id', 'nombre', 'usuarios_id'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->usuarios_id = $args['usuarios_id'] ?? null;
    }
}