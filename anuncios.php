<?php
    require './includes/app.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Casas y Depas en Venta</h1>
    
        <<?php
            $limite = 9;
            include 'includes/templates/anuncios';
        ?>
    </main>


<?php
    incluirTemplate('footer');
?>