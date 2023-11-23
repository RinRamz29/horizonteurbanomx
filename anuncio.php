<?php
    require './includes/app.php';

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if(!$id){
        header('Location: /');
    } 

    //Importar base de datos
    $db = conectarDB();

    //Consultar
    $query = "SELECT * FROM propiedades WHERE id = $id";

    //Leer resultado
    $resultado = mysqli_query($db, $query);

    if (!$resultado->num_rows){
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    //Incluir template
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>
        
        <img loading="lazy" width="200" height="300" src="/imagenes/<?php echo $propiedad['imagen'];?>" alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo number_format($propiedad['precio']); ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>
    </main>


<?php
    mysqli_close($db);

    incluirTemplate('footer');
?>