<?php

use App\Vendedor;
require '../../includes/app.php';

estaAutenticado();

    //Validar que sea un id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}

$vendedores = Vendedor::find($id);

// Arreglo con mensajes de errores
$errors = Vendedor::getErrores();
    
//Ejecutar el codigo despues de que el usuaior envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
    //Asignar los atributos
    $args = [];
    $args = $_POST['vendedor'];

    $vendedores->sincronizar($args);

    //Validacion
    $errors = $vendedores->validar();

    //Revisar que el arreglo de errores esté vacio
    if(empty($errors)){
        $vendedores->guardar();
    }
}
    
incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Vendedor</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php' ?>
            <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>