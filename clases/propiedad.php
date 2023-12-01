<?php

namespace App;

class Propiedad extends ActiveRecord{

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];
    public $id;
    public $titulo; 
    public $precio; 
    public $imagen; 
    public $descripcion; 
    public $habitaciones; 
    public $wc;
    public $estacionamiento; 
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {   
        $this->id = $args['propiedad']['id'] ?? null;
        $this->titulo = $args['propiedad']['titulo'] ?? '';
        $this->precio = $args['propiedad']['precio'] ?? '';
        $this->imagen = $args['propiedad']['imagen'] ?? '';
        $this->descripcion = $args['propiedad']['descripcion'] ?? '';
        $this->habitaciones = $args['propiedad']['habitaciones'] ?? '';
        $this->wc = $args['propiedad']['wc'] ?? '';
        $this->estacionamiento = $args['propiedad']['estacionamiento'] ?? '';
        $this->creado = date('Y-m-d');
        $this->vendedores_id = $args['propiedad']['vendedores_id'] ?? '';
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Nombre del inmueble requerido";
        }

        if(!$this->precio){
            self::$errores[] = "Precio del inmueble requerido";
        }

        if(strlen($this->descripcion) < 50){
            self::$errores[] = "Descripción demasiado corta, mínimo 50 caracteres.";
        }
        else if(!$this->descripcion){
            self::$errores[] = "La descripción es obligatoria";
        }

        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc){
            self::$errores[] = "El número de baños es obligatorio";
        }

        if(!$this->estacionamiento){
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if(!$this->vendedores_id){
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "Selecciona una imagen para tu inmueble";
        }

        return self::$errores;
    }
}
