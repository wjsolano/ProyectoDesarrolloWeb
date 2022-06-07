<?php
require_once 'php/conexion.php';

//1.Consultar los datos y los mostrarlos en el input
//validar si se estan pasando lo datos por el método get
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    //construir la consulta
    $query='SELECT * FROM usuario WHERE id_usuario=?';
    //preparar la sentencia
    if($stmt=$conn->prepare($query)){
        $stmt->bind_param('i', $_GET['id']);
        //ejecuto la sentencia
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array
                (MYSQLI_ASSOC);
                $nombre=$row['nombre'];
                $apellido=$row['apellido'];
                $direccion=$row['direccion'];
                $ciudad=$row['ciudad'];
                $telefono=$row['telefono'];
                $cedula=$row['cedula'];
                $tipousu=$row['tipo_usuario'];
                $username=$row['username'];
                $pass=$row['password'];
            }else{
                echo 'Error! No existen los resultados';
                exit();
            }
        }else{
            echo 'Error! Revise la conexión a la base de datos';
            exit();
        }
    }
    $stmt->close();
}else{
    header("location: index.html");
    exit();
}

//tomar si
//controlar si se han enviado datos por el POST
if($_SERVER['REQUEST_METHOD']=='POST'){
    //validar si se envian todo los datos
    if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['direccion'])
    && isset($_POST['ciudad']) && isset($_POST['telefono']) && isset($_POST['cedula']) 
    && isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['tipo_usuario'])){
        //construir una consulta
        $query="UPDATE usuario SET nombre =?, apellido =?,direccion=?,ciudad=?, telefono =?, cedula =?, 
         tipo_usuario=?, username=?, password =? WHERE id_usuario=?";
        //PREPARAR LA SENTENCIA
        if($stmt = $conn->prepare($query)){
            //si se realiza la consulta con exito hacer esto
            //ENVIAR LOS DATOS HACIENDO UN BINDING
            //van seis s porque van a ir seis string
            $stmt-> bind_param('ssssssssii', $_POST['nombres'], $_POST['apellidos'], $_POST['direccion'], 
            $_POST['ciudad'], $_POST['telefono'], $_POST['cedula'], $_POST['username'], 
            $_POST['pass'], $_POST['tipo_usuario'], $_GET['id']);
            //EJECUTAR LA SENTENCIA
            if($stmt-> execute()){
                header("location: index.php");
                exit();
            }else{
                echo "Error!!! no hay sistema";
            }
            //CERRAR LA SENTENCIA O STMT
            $stmt->close();
        }
    }
    $conn->close(); //CERRAR LA CONEXION
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>Formulario Registro</title>
</head>
<body>
  <form class="form-register" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
  <h4>Formulario Registro</h4>
    <input class="controls" type="text" name="nombres" value=<?php echo $nombre ?> required>
    <input class="controls" type="text" name="apellidos" value=<?php echo $apellido ?> required>
    <input class="controls" type="text" name="direccion" value=<?php echo $direccion ?> required>
    <input class="controls" type="text" name="ciudad" value=<?php echo $ciudad ?> required>
    <input class="controls" type="text" name="telefono" value=<?php echo $telefono ?> required>
    <input class="controls" type="text" name="cedula" value=<?php echo $cedula ?> required>
    <input class="controls" type="text" name="username" value=<?php echo $username ?> required>
    <input class="controls" type="password" name="pass" value=<?php echo $pass ?> required>
    <!--input class="controls" type="number" name="tipo_usuario" value=</*?php echo $tipousu ?> required-->
    <select class="controls" name="tipo_usuario" type="number" required>
        <?php
				$selectedAdmin = ($tipousu == 1) ? 'selected' : '';
				$selectedCliente = ($tipousu == 2) ? 'selected' : '';
				?>
                    <option value="" selected="selected">Seleccionar</option>
                    <option value=1 <?=$selectedAdmin ?>>Admin</option>
                    <option value=2 <?=$selectedCliente ?>>Cliente</option>
    </select>
    <input class="botons" type="submit" value="Registrar">
    <p>Estoy de acuerdo con <a href="index.html">Terminos y Condiciones</a></p>
    <p><a href="#">¿Ya tengo Cuenta?</a></p>
  </form>
</body>
</html>