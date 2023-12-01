<?php

function conectarDB() : mysqli{
    $db = new mysqli('82.165.211.7', 'rinBienes', '1Kyrp080*', 'bienesraicesDB');

    if(!$db) {
        echo "No se pudo conectar a la base de datos";  // mensaje en caso de error
        exit;
    }

    return $db;
}