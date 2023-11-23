<?php

    if (!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizonte Urbano</title>

    <link rel="preload" href="/build/css/app.css" as="style">
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="icon" type="image/x-icon" href="../../src/img/favicon.ico">
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <h1>Horizonte Urbano</h1>
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu resposive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Dark Mode">
                    <nav class="navegacion">
                        <a href="nosotros">Nosotros</a>
                        <a href="anuncios">Anuncios</a>
                        <a href="blog">Blog</a>
                        <a href="contacto">Contacto</a>
                        <?php if ($auth): ?>
                            <a href="cerrar-sesion">Cerrar Sesión</a>
                        <?php endif;?>
                    </nav>
                </div>
             
            </div> <!--Barra-->

            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php }?>
        </div>
    </header>