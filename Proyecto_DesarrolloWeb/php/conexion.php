<?php
//Datos de la base de datos
define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'biblioteca');

//Creación de la conexión a la base de datos con mysqli
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

//Controlar el éxito de la conexión
if($conn -> connect_error){
    die('Conexión fallida: ' . $conn -> connect_error);
}
?>