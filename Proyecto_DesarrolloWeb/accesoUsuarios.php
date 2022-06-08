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
    

    //consultar si los datos estan en la base
    $query="SELECT * FROM usuario WHERE username='$user' AND
    password='$pass'";

    
    //ejecutar la consulta
    $resultado=mysqli_query($conn, $query) or 
    die(mysqli_query_errono());

    //almacenar el/los datos en un arreglo y tomo el siguiente
    $fila=mysqli_fetch_array($resultado);
   // $n1=2
    //$_Proceso = $_POST["Proceso"];
    //header("Location: cliente/perfilCliente.php?proceso=" . $_POST['Proceso']);

    session_start();
    $_SESSION['user']=$fila['id_usuario'];
    $_SESSION['usernameusar']=$fila['username'];

    //controlar si en verad llegan datos
    if($fila['id_usuario']==null){
        //redirigir el mismo index
        header("location:index.html");
    }else if($fila['tipo_usuario']==1){
        //definimos las variables de sesion y reedirigimos a la
        //pagina de usuario
        $_SESSION['id']=$fila['id_usuario'];
        $_SESSION['nombre']=$fila['nombre'];
        header("location:bienvenidaAdmin.php");
    }else if ($fila['tipo_usuario']==2){
        $_SESSION['id']=$fila['id_usuario'];
        $_SESSION['nombre']=$fila['nombre'];
        header("location:bienvenidaCliente.php");
    }
}else{
    header("location:index.html");
}
?>