<?php
require_once '../conexion.php';
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
$nombreusu=$fila['nombre'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    //VALIDAD si se enviaron todos los datos
    if(isset($_POST['id_usuario']) && isset($_POST['id_libro']) && isset($_POST['fecha_orden'])
     && isset($_POST['fecha_entrega'])){
        //construir la consulta
        $query="INSERT INTO ordenes (id_usuario, id_libro, fecha_orden, fecha_entrega)
        VALUES (?, ?, ?, ?)";
        //preparar sentencia
        if($stmt = $conexion->prepare($query)){
            //enviar los datos haciendo un binding
            $stmt->bind_param('iiss', $_POST['id_usuario'], $_POST['id_libro'], $_POST['fecha_orden'], 
            $_POST['fecha_entrega']);
            //ejecutar la sentencia
            if($stmt -> execute()){
                header("location: ../php/perfilOC.php ");
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
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/style.css"> 
  <title>Formulario Orden</title>
</head>
<body>
  <form class="form-register" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <h4>Formulario Orden</h4>
        <select required class="controls" name="id_usuario">
          <option value="<?php echo $id_usuario ?>"><?php echo $nombreusu ?></option>
        </select>
        <!--input class="controls" type="text" name="id_usuario" value="<//?php echo $id_usuario ?>" required-->
        <!--input class="controls" type="text" name="id_libro" placeholder="Ingrese id de libro" required!-->
        <select required class="controls" name="id_libro">
  <?php 
  $mysqli= mysqli_connect("localhost","root","","biblioteca");
  $resultado=mysqli_query($mysqli,"SELECT * from libros");    
        while($file=$resultado->fetch_assoc()):
           $id=$file['id_libro'];
           $nombre=$file['titulo'];
           echo "<option value=$id>$nombre</option>";
        endwhile;
        ?>
</select>


        
        <input class="controls" type="text" name="fecha_orden" placeholder="Ingrese la Fecha de Orden" required>
        <input class="controls" type="text" name="fecha_entrega" placeholder="Ingrese la Fecha de Entrega">
        <input class="botons" type="submit" value="Agregar Orden">
  </form>
</body>
</html>