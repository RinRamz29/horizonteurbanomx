<?php

namespace App;

use mysqli_stmt;

class ActiveRecord{
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

     //Validacion
    protected static $errores = [];
 
    public static function setDB($database){
        self::$db = $database;
    }
 
    public function guardar(){
        if(!is_null($this->id)){
            //Actualizar
            $this->actualizar();
        }else{
            //Crear
            $this->crear();
        }
    }
 
    public function crear(){
 
        $atributos = $this->sanitizarAtributos();
         
        $keys = join(', ', array_keys($atributos));
        $values = join("', '", array_values($atributos));
 
        $query = "INSERT INTO " . static::$tabla .  " ( $keys ) VALUES ( '$values' );";

        $resultado = self::$db->query($query);
 
         //Mensaje de exito
        if($resultado){
            //Redireccionar al usuario
            header("Location: /admin?resultado=1");
        }
    }
 
    public function actualizar(){
        $atributos = $this->sanitizarAtributos();
 
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key='$value'";
        }
 
        $query = "UPDATE " . static::$tabla .  " SET " . join(', ', $valores) . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
         
        $resultado = self::$db->query($query);
 
        //Insertar en la base de datos
        if($resultado){
            //Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
    }
 
    //Eliminar el registro
    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
 
        $resultado = self::$db->query($query);
 
        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }
 
    //Identificar y unir los atributos a la BD
    public function atributos(){
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
 
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
 
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
 
        return $sanitizado;
         
    }   
 
     //Subida de archivos
     public function setImagen($imagen){
         //Elimina la imagen previa
         if(!is_null($this->id)){
             $this->borrarImagen();
         }
         
         //Asignar al atributo imagen el nombre de la imagen
         if($imagen){
             $this->imagen = $imagen;
         }
     }
 
     //Eliminar imagen
     public function borrarImagen(){
         //Elimina el archivo
         $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
 
         if($existeArchivo){
             unlink(CARPETA_IMAGENES . $this->imagen);
         }
     }
 
     //Validacion
     public static function getErrores(){
         return static::$errores;
     }
 
     public function validar(){
 
        static::$errores = [];
         return static::$errores;
     }
 
     //Lista todas las registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
         
        $resultado = self::consultarSQL($query);
 
        return $resultado;
    }

    //Obtiene determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT $cantidad";
         
        $resultado = self::consultarSQL($query);
 
        return $resultado;
    }
 
     //Busca registro por su ID
     public static function find($id){
         $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
 
         $resultado = self::consultarSQL($query);
 
         return array_shift($resultado);
 
     }
 
     public static function consultarSQL($query){
         //Consultar la base de datos
         $resultado = self::$db->query($query);
 
         //Iterar los resultados
         $array = [];
         while($registro = $resultado->fetch_assoc()){
             $array[] = static::crearObjeto($registro);
         }
 
         //Liberar la memoria
         $resultado->free();
 
         //Retornar los resultados
         return $array; 
     }
 
     protected static function crearObjeto($registro){
         $objeto = new static;
 
         foreach($registro as $key => $value){
             if(property_exists($objeto, $key)){
                 $objeto->$key = $value;
             }
         }
 
         return $objeto;
     }
 
     //Sincronizar - Sincroniza el objeto en memoria con los cambios realizados por el usuario
     public function sincronizar($args = []){
         foreach ($args as $key => $value) {
             if(property_exists($this, $key) && !is_null($value)){
                 $this->$key = $value;
             }
         }
     }
}