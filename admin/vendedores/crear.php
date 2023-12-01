<?php

    require '../../includes/app.php';

    use App\Vendedor;

    estaAutenticado();

    $vendedores = new Vendedor;

    // Arreglo con mensajes de errores
    $errors = Vendedor::getErrores();
    
    //Ejecutar el codigo despues de que el usuaior envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $vendedores = new Vendedor($_POST);

        //Validamos
        $errors = $vendedores->validar();
 
        //Revisar que el arreglo de errores esté vacio
        if(empty($errors)){

            $vendedores->guardar(); 
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Registar Vendedores</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form action="/admin/vendedores/crear.php" class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>