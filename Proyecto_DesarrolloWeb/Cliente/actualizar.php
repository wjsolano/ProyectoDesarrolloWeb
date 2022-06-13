<?php
require_once '../php/conexion.php';
session_start();
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    //construir la consulta
    $query='SELECT o.id_orden, o.id_usuario, o.id_libro, o.fecha_orden, o.fecha_entrega, l.titulo, u.nombre 
    FROM ordenes as o JOIN usuario as u ON o.id_usuario=u.id_usuario JOIN libros l ON o.id_libro=l.id_libro WHERE id_orden=?';
    //preparar la sentencia
    if($stmt=$conexion->prepare($query)){
        $stmt->bind_param('i', $_GET['id']);
        //ejecuto la sentencia
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array
                (MYSQLI_ASSOC);
                $id_usuario=$row['id_usuario'];
                $id_libro=$row['id_libro'];
                $fechaOrden=$row['fecha_orden'];
                $fechaEntrega=$row['fecha_entrega']; 
                $nombreusua=$row['nombre'];
                $titulo=$row['titulo'];
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
    header("location: ../php/perfilOC.php");
    
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
                header("location: ../php/perfilOC.php");
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
  <select class="controls" name="id_usuario">
          <option value="<?php echo $id_usuario ?>"><?php echo $nombreusua ?></option>
    </select>
    <select class="controls" name="id_libro">
  <?php 
$mysqli= mysqli_connect("localhost","root","","biblioteca");
$resultado=mysqli_query($mysqli,"SELECT * from libros");   
      while($file=$resultado->fetch_assoc()):
         $id=$file['id_libro'];
         $nombre=$file['titulo'];
         if($nombre==$titulo){
            echo "<option value=$id selected=selected>$titulo</option>";
         }else{
            echo "<option value=$id>$nombre</option>";
         }
      endwhile;
      ?>
        
</select>
    <input class="controls" type="text" name="fecha_orden" placeholder="Ingrese fecha orden" value=<?php echo $fechaOrden ?> required>
    <input class="controls" type="text" name="fecha_entrega" placeholder="Ingrese fecha de entrega" value=<?php echo $fechaEntrega ?> >

    <input class="botons" type="submit" value="Actualizar">
    
    <button class="botons"><a href="../php/perfilOC.php" class="botons">Cancelar</a></button>
  </form>
</body>
</html>