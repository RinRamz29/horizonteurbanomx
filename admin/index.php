<?php

    require '../includes/app.php';

    estaAutenticado();

    use App\Propiedad;

    //Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();


    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); 

        if ($id) {
            $propiedad = Propiedad::find($id);

            $propiedad->eliminar();

        
        }
    }

    //Incluye un template
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if (intval($resultado) === 1) { ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php }else if(intval($resultado) === 2){?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php }else if(intval($resultado) === 3){?>
            <p class="alerta exito">Anuncio Eliminado  Correctamente</p>
        <?php }?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($propiedades as $propiedad): ?>
                <tr> <!-- Mostrar los resultados -->
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="oa"></td>
                    <td><?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input class="boton-rojo" type="submit" value="Eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id;?>">
                        </form>
                        <a class="boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php

    //Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer');
?>