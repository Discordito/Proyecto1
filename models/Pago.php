<?php 

namespace Model;

class Pago extends ActiveRecord {
    protected static $tabla = 'pagos';
    protected static $columnasDB = ['id', 'transaccion', 'usuario_id', 'descripcion', 'date'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->transaccion = $args['transaccion'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->date = $args['date'] ?? '';
    }
}

?>