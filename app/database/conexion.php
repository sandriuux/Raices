<?php
    $servername = "localhost";
    $dbname = "tfg";
    $username = "root";
    $password = "";

    // Crea la conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Confirma la conexión a la base de datos
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    } 

?>
