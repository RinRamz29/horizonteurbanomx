<?php
    //Importar base de datos
    $db = conectarDB();

    //Consultar
    $query = "SELECT * FROM propiedades LIMIT $limite";

    //Leer resultado
    $resultado = mysqli_query($db, $query);
?>


<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultado)):?>
    <div class="anuncio">
  
        <img loading="lazy" width="200" height="300" src="/imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio">
                
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo'];?></h3>
            <p><?php echo $propiedad['descripcion'];?></p>
            <p class="precio">$<?php echo number_format($propiedad['precio']);?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc'];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento'];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones'];?></p>
                </li>
            </ul>
            <a class="boton boton-amarillo-block" href="anuncio.php?id=<?php echo $propiedad['id'];?>">Ver Propiedad</a>
        </div> 
    </div> <!--Anuncio-->
    <?php endwhile; ?>
</div> <!--Contenido anuncios-->

<?php	

//Cerrar la conexión
mysqli_close($db);

?>