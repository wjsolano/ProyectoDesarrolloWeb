<?php
require_once 'php/conexion.php';

//controlar si se enviaron datos por el post
if($_SERVER['REQUEST_METHOD']=='POST'){
    //VALIDAD si se enviaron todos los datos
    if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['direccion'])
     && isset($_POST['ciudad']) && isset($_POST['telefono']) && isset($_POST['cedula']) 
     && isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['tipo_usuario'])){
        //construir la consulta
        $query="INSERT INTO usuario (nombre, apellido, direccion, ciudad, telefono,
         cedula, username, password, tipo_usuario) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //preparar sentencia
        if($stmt = $conn->prepare($query)){
            //enviar los datos haciendo un binding
            $stmt->bind_param('ssssssssi', $_POST['nombres'], $_POST['apellidos'], $_POST['direccion'], 
            $_POST['ciudad'], $_POST['telefono'], $_POST['cedula'], $_POST['username'], 
            $_POST['pass'], $_POST['tipo_usuario']);
            //ejecutar la sentencia
            if($stmt -> execute()){
                header("location: index.html  ");
                exit();
            }else{
                echo "Error! Por favor intente más tarde";
            }
            //cerrar la sentencia o stmt
            $stmt->close();
        }else{
          echo "Error! Por favor intente más tarde2";
      }

    }
    $conn->close();
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
  <form class="form-register" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
  <h4>Formulario Registro</h4>
    <input class="controls" type="text" name="nombres" placeholder="Ingrese su Nombre" required>
    <input class="controls" type="text" name="apellidos" placeholder="Ingrese su Apellido" required>
    <input class="controls" type="text" name="direccion" placeholder="Ingrese su Dirección" required>
    <input class="controls" type="text" name="ciudad" placeholder="Ingrese su Ciudad" required>
    <input class="controls" type="text" name="telefono" placeholder="Ingrese su Número de Telefono" required>
    <input class="controls" type="text" name="cedula"placeholder="Ingrese su Número de Cédula" required>
    <input class="controls" type="text" name="username" placeholder="Ingrese un Nombre de usuario" required>
    <input class="controls" type="password" name="pass" placeholder="Ingrese su Contraseña" required>
    <input class="controls" type="number" name="tipo_usuario" placeholder="Ingrese el tipo de usuario" required>
    <input class="botons" type="submit" value="Registrar">
    <p>Estoy de acuerdo con <a href="index.html">Terminos y Condiciones</a></p>
    <p><a href="#">¿Ya tengo Cuenta?</a></p>
  </form>
</body>
</html>