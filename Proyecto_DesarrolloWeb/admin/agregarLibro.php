<?php
require_once '../conexion.php';

//controlar si se enviaron datos por el post
if($_SERVER['REQUEST_METHOD']=='POST'){
    //VALIDAD si se enviaron todos los datos
    if(isset($_POST['titulo']) && isset($_POST['nombre_autor']) && isset($_POST['apellido_autor'])
     && isset($_POST['categoria']) && isset($_POST['precio'])){
        //construir la consulta
        $query="INSERT INTO libros (titulo, nombre_autor, apellido_autor, categoria, precio) 
        VALUES (?, ?, ?, ?, ?)";
        //preparar sentencia
        if($stmt = $conexion->prepare($query)){
            //enviar los datos haciendo un binding
            $stmt->bind_param('ssssd', $_POST['titulo'], $_POST['nombre_autor'], $_POST['apellido_autor'], 
            $_POST['categoria'], $_POST['precio']);
            //ejecutar la sentencia
            if($stmt -> execute()){
                header("location: ../librosAdmin.php ");
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
  <link rel="stylesheet" href="css/style.css">
  <title>Formulario Libro</title>
</head>
<body>
  <form class="form-register" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <h4>Formulario Libro</h4>
        <input class="controls" type="text" name="titulo" placeholder="Título del Libro" required>
        <input class="controls" type="text" name="nombre_autor" placeholder="Nombre del autor" required>
        <input class="controls" type="text" name="apellido_autor" placeholder="Apellido del autor" required>
        <input class="controls" type="text" name="categoria" placeholder="Categoria" required>
        <input class="controls" type="text" name="precio" placeholder="Precio" required>
        <input class="botons" type="submit" value="Agregar Libro">
  </form>
</body>
</html>