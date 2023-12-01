<?php

namespace App;

class Vendedor extends ActiveRecord{

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
     {   
         $this->id = $args['vendedor']['id'] ?? null;
         $this->nombre = $args['vendedor']['nombre'] ?? '';
         $this->apellido = $args['vendedor']['apellido'] ?? '';
         $this->telefono = $args['vendedor']['telefono'] ?? '';
     }

     public function validar(){
        if(!$this->nombre){
            self::$errores[] = "Nombre del vendedor requerido";
        }

        if(!$this->apellido){
            self::$errores[] = "Apellido del vendedor requerido";
        }

        if(!$this->telefono){
            self::$errores[] = "Telefono del vendedor requerido";
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Formato de telefono incorrecto";
        }

        return self::$errores;
    }

}