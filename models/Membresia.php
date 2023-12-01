<?php 

namespace Model;

class Membresia extends ActiveRecord {
    protected static $tabla = 'membresia';
    protected static $columnasDB = ['id', 'membresia', 'i_date', 'f_date', 'usuario_id','estado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->membresia = $args['membresia'] ?? '';
        $this->i_date = $args['i_date'] ?? '';
        $this->f_date = $args['f_date'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? null;        
        $this->estado = $args['estado'] ?? 0;        
    }
}

?>