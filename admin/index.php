<?php

require '../includes/app.php';

estaAutenticado();

use App\Propiedad;
use App\Vendedor;

//Implementar un metodo para obtener todas las propiedades
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();


//Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if ($id) {
        $tipo = $_POST['tipo'];

        if (validarTipoContenido($tipo)) {
            //Compara lo que vamos a eliminar
            if($tipo === 'propiedad'){
                $propiedad = Propiedad::find($id);
    
                $propiedad->eliminar();
            }else if($tipo === 'vendedor'){
                $vendedores = Vendedor::find($id);
    
                $vendedores->eliminar();
            }
        }
    }
}

//Incluye un template
incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php
            $mensaje = mostrarNotificaciones(intval($resultado));
            if ($mensaje){ ?>
            <p class="alerta exito"><?php echo sanitizar($mensaje);?></p>
        <?php } ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevx Vendedor</a>

        <h2>Propiedades</h2>

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
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id;?>">
                        </form>
                        <a class="boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($vendedores as $vendedor): ?>
                <tr> <!-- Mostrar los resultados -->
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input class="boton-rojo" type="submit" value="Eliminar">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id;?>">
                        </form>
                        <a class="boton-amarillo-block" href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>

<?php
    incluirTemplate('footer');
?>