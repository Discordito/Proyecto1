<?php

namespace Model;

class Estandar extends ActiveRecord {
    protected static $tabla = 'estandar';
    protected static $columnasDB = ['id', 'nombre', 'descripcion'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
    }
}