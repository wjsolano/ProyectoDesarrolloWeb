<?php
require_once '../conexion.php';

//1.Consultar los datos y los mostrarlos en el input
//validar si se estan pasando lo datos por el método get
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    //construir la consulta
    $query='SELECT * FROM libros WHERE id_libro=?';
    //preparar la sentencia
    if($stmt=$conexion->prepare($query)){
        $stmt->bind_param('i', $_GET['id']);
        //ejecuto la sentencia
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array
                (MYSQLI_ASSOC);
                $titulo=$row['titulo'];
                $nombre=$row['nombre_autor'];
                $apellido=$row['apellido_autor'];
                $categoria=$row['categoria'];
                $precio=$row['precio'];
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
    header("location: ../librosAdmin.php");
    exit();
}

//tomar si
//controlar si se han enviado datos por el POST
if($_SERVER['REQUEST_METHOD']=='POST'){
    //validar si se envian todo los datos
    if(isset($_POST['titulo']) && isset($_POST['nombre_autor']) && isset($_POST['apellido_autor'])
    && isset($_POST['categoria']) && isset($_POST['precio'])){
        //construir una consulta
        $query="UPDATE libros SET titulo =?, nombre_autor =?, apellido_autor=?, categoria=?, precio=?
        WHERE id_libro=?";
        //PREPARAR LA SENTENCIA
        if($stmt = $conexion->prepare($query)){
            //si se realiza la consulta con exito hacer esto
            //ENVIAR LOS DATOS HACIENDO UN BINDING
            //van 4 s tring una d doble y una int
            $stmt-> bind_param('ssssdi', $_POST['titulo'], $_POST['nombre_autor'], $_POST['apellido_autor'], 
            $_POST['categoria'], $_POST['precio'], $_GET['id']);
            //EJECUTAR LA SENTENCIA
            if($stmt-> execute()){
                header("location: ../librosAdmin.php");
                exit();
            }else{
                echo "Error!!! no hay sistema";
            }
            //CERRAR LA SENTENCIA O STMT
            $stmt->close();
        }
    }
    $conexion->close(); //CERRAR LA CONEXION
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/style.css">
  <title>Formulario Libro</title>
</head>
<body>
  <form class="form-register" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
  <h4>Formulario Libro</h4>
    <input class="controls" type="text" name="titulo" value=<?php echo $titulo?> required>
    <input class="controls" type="text" name="nombre_autor" value=<?php echo $nombre ?> required>
    <input class="controls" type="text" name="apellido_autor" value=<?php echo $apellido ?> required>
    <input class="controls" type="text" name="categoria" value=<?php echo $categoria ?> required>
    <input class="controls" type="text" name="precio" value=<?php echo $precio ?> required>
    <input class="botons" type="submit" value="Registrar">
    
    <button class="botons"><a href="../librosAdmin.php" class="botons">Cancelar</a></button>
    
    
  </form>
</body>
</html>