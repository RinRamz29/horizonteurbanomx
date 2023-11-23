<?php

namespace App;

class Propiedad{

    //Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    //Validacion
    protected static $errores = [];

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

    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y-m-d');
        $this->vendedores_id = $args['vendedores_id'] ?? 1;
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

        $query = "INSERT INTO propiedades ( $keys ) VALUES ( '$values' );";

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

        $query = "UPDATE propiedades SET " . join(', ', $valores) . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        
        $resultado = self::$db->query($query);

         //Insertar en la base de datos
        if($resultado){
            //Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
    }

    public function eliminar(){
        //Elimina la propiedad
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    //Identificar y unir los atributos a la BD
    public function atributos(){
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
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
        return self::$errores;
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

    //Lista todas las registros
    public static function all() {
        $query = "SELECT * FROM propiedades";
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca registro por su ID
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = $id";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);

    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array; 
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

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
