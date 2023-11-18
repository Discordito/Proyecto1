<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //Validar login de usuarios
    public function validarLogin(){
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio.';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no valido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es Obligatoria.';
        }
        return self::$alertas;
    }

    //Validacion para cuentas nuevas
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre de Usuario es Obligatorio.';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio.';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es Obligatoria.';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe tener mas de 6 caracteres';
        }
        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Las Contraseñas son diferentes';
        }
        return self::$alertas;
    }

    //valida un email
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no valido';
        }
        return self::$alertas;
    }

    public function nuevo_password() {
        if(!$this->password_actual){
            self::$alertas['error'][] = 'La contraseña actual no puede estar vacio';
        }
        if(!$this->password_nuevo){
            self::$alertas['error'][] = 'La contraseña nueva no puede estar vacia';
        }
        if(strlen($this->password_nuevo) < 6){
            self::$alertas['error'][] = 'La contraseña debe contener mas de 6 caracteres';
        }
        return self::$alertas;
    }

    //comprobar el password
    public function comprobar_password() {
        return password_verify($this->password_actual, $this->password );
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

    }

    //validar password
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es Obligatoria.';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe tener mas de 6 caracteres';
        }
        return self::$alertas;
    }
    public function validarPerfil() {
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }

    //generar token
    public function crearToken(){
        $this->token = uniqid();    
    }
}