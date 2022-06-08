<?php
define('SERVERNAME','localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'biblioteca');

//conexion a la base de datos
$conn=mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME) or
die("Error en la conexión");

//iniciar sesión
session_start();

//validar si se esta ingresando directamete sin loggueo
if(!$_SESSION){
    header("location:index.html");
}

$id_usuario=$_SESSION['id'];
$consulta="SELECT nombre, apellido, direccion, ciudad, telefono,
cedula, username, password, tipo_usuario FROM usuario WHERE 
id_usuario=$id_usuario";

//ejecuta la consulta
$resultado=mysqli_query($conn, $consulta) or 
die(mysqli_query_errono());

//alamacenar los datos en una arreglo asociativo
$fila=mysqli_fetch_array($resultado);
$nombre=$fila['nombre'];
$apellido=$fila['apellido'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido administrador</title>
</head>
<body>
    <h1 align="center">Bienvenido <?php echo $nombre?> <?php echo $apellido?></h1>
    <div id="medi">
        <div id="ce">
            <div id="otr">
                <h2>Usuarios Biblioteca</h2>
            </div>
            <a href="perfilAdmin.php">
                <img src="img/perfil.png" alt="perfil" height="150px" width="150px">
            </a>
        </div>
 
        <div id="ce">
            <div id="otr">
                <h2>Ordenes</h2>
            </div>
            <a href="php/PerfilOA.php">
                <img src="img/lista-de-verificacion.png" alt="perfil" height="150px" width="150px">
            </a>
        </div>

        <div id="ce">
            <div id="otr">
                <h2>Libros</h2>
            </div>
            <a href="librosAdmin.php">
                <img src="img/libro.png" alt="perfil" height="150px" width="150px">
            </a>
        </div>

    </div>
    <a href="cerrarSesion.php" id="cerrar">Cerrar Sesión</a>
</body>
<link rel="stylesheet" href="css/estiPerfil.css">

<link rel="stylesheet" href="css/bienve.css">

</html>