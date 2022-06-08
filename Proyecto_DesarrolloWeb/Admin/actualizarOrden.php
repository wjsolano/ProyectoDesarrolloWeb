<?php
require_once '../php/conexion.php';

if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    //construir la consulta
    $query='SELECT * FROM ordenes WHERE id_orden=?';
    //preparar la sentencia
    if($stmt=$conexion->prepare($query)){
        $stmt->bind_param('i', $_GET['id']);
        //ejecuto la sentencia
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array
                (MYSQLI_ASSOC);
                $idUsuario=$row['id_usuario'];
                $idLibro=$row['id_libro'];
                $fechaOrden=$row['fecha_orden'];
                $fechaEntrega=$row['fecha_entrega']; 
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
    header("location: ../php/perfilOA.php");
    
    exit();
}

//tomar si
//controlar si se han enviado datos por el POST
if($_SERVER['REQUEST_METHOD']=='POST'){
    //validar si se envian todo los datos
    if(isset($_POST['id_usuario']) && isset($_POST['id_libro']) && isset($_POST['fecha_entrega'])
    && isset($_POST['fecha_orden'])){
        $query="UPDATE ordenes SET id_usuario =?, id_libro =?, fecha_orden=?, fecha_entrega=? WHERE id_orden=?";
        if($stmt = $conexion->prepare($query)){
            $stmt-> bind_param('iissi', $_POST['id_usuario'], $_POST['id_libro'], $_POST['fecha_orden'], 
            $_POST['fecha_entrega'], $_GET['id']);
            if($stmt-> execute()){
                header("location: ../php/perfilOA.php");
                exit();
            }else{
                echo "Error!!! no hay sistema";
            }
            $stmt->close();
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
  <title>Formulario Actualizar</title>
</head>
<body>
  <form class="form-register" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
  <h4>Formulario Actualizar</h4>
    <input class="controls" type="text" name="id_usuario" value=<?php echo $idUsuario ?> required>
    <input class="controls" type="text" name="id_libro" value=<?php echo $idLibro ?> required>
    <input class="controls" type="text" name="fecha_orden" value=<?php echo $fechaOrden ?> required>
    <input class="controls" type="text" name="fecha_entrega" value=<?php echo $fechaEntrega ?> required>

    <input class="botons" type="submit" value="Actualizar">
    
    <button class="botons"><a href="../php/perfilOA.php" class="botons">Cancelar</a></button>
  </form>
</body>
</html>