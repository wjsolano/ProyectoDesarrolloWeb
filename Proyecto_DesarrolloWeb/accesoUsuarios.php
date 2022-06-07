<?php
//recibir datos desde el formulario
$user=$_POST['username'];
$pass=$_POST['password'];

//me permite verificar si es que tiene un valor
//dentro de user
if(isset($user)){
    //Conexión a la base datos
    //constantes de conexion
    define('SERVERNAME','localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DBNAME', 'biblioteca');

    //conexion a la base de datos
    $conn=mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME) or
    die("Error en la conexión");

    //iniciar sesión
    session_start();

    //consultar si los datos estan en la base
    $query="SELECT * FROM biblioteca WHERE username='$user' AND
    password='$pass'";

    //ejecutar la consulta
    $resultado=mysqli_query($conn, $query) or 
    die(mysqli_query_errono());

    //almacenar el/los datos en un arreglo y tomo el siguiente
    $fila=mysqli_fetch_array($resultado);

    //controlar si en verad llegan datos
    if($fila['id_usuario']==null){
        //redirigir el mismo index
        header("location:index.html");
    }else{
        //definimos las variables de sesion y reedirigimos a la
        //pagina de usuario
        $_SESSION['id']=$fila['id_usuario'];
        $_SESSION['nombre']=$fila['nombre'];
        header("location:paginaUsuario.php");
    }
}else{
    header("location:index.html");
}
?>