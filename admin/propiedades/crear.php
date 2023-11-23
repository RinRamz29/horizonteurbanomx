<?php

    require '../../includes/app.php';

    use App\Propiedad; 
    use Intervention\Image\ImageManagerStatic as Image;

    $auth = estaAutenticado();

    $db = conectarDB();

    $propiedad = new Propiedad;

    //Consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errors = Propiedad::getErrores();
    
    //Ejecutar el codigo despues de que el usuaior envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $propiedad = new Propiedad($_POST);

        //Subida de archivos
        //Generar nombre unico para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg"; 

        //Setea la imagen
        //Realiza un resize a la imagen
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        //Validamos
        $errores = $propiedad->validar();
 
        //Revisar que el arreglo de errores esté vacio
        if(empty($errors)){

            $propiedad->guardar(); 

            //Crear una carpeta
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            //Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
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

        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>