<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';

    estaAutenticado();

    //Validar que sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Consulta para obtener los datos de las propiedades
    $propiedad = Propiedad::find($id);

    //Consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errors = Propiedad::getErrores();
    
    //Ejecutar el codigo despues de que el usuaior envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
        //Asignar los atributos
        $args = [];
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        //Validacion
        $errors = $propiedad->validar();

        //Subida de archivos
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        //Revisar que el arreglo de errores esté vacio
        if(empty($errors)){
            //Almacenar la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $propiedad->guardar();
        }
    }
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php' ?>
            <input type="submit" value="Actualizar Propiedad " class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>