<?php
    $servername = "localhost";
    $username = "alu4606";
    $password = "2BX4wI";
    $database = "alu4606";

    //Establecemos la conexión
    $db = new mysqli($servername, $username, $password, $database);
    
    //Comprobando la conexión
    if ($db->connect_error) {
        die("Imposible establecer conexion con la base de datos" . $db->connect_error);
    }
?>
