<?php 

//Importar la conexión 
require 'includes/config/app.php';
$db = conectarDB();

//Crear un email y password
$email = "correo@correo.com";
$password = "1234567890";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

//Agregarlo a la base de datos
$resultado = mysqli_query($db, $query);