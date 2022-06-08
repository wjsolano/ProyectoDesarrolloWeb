<?php
require_once '../conexion.php';

//validar si se ´pasam los datos por el metodo GET, porque se envia por URL
if(isset($_GET['id']) && !empty(trim($_GET['id']))){ //trim elimina los espacios vacios al inicio y al final
//construir la consulta
  $query='DELETE  FROM libros WHERE id_libro=?';
   //preparar la sentencia
   if($stmt=$conexion->prepare($query)){
    $stmt->bind_param('i', $_GET['id']); //i porque pasa un entero
    //ejecutar la sentencia
     if($stmt->execute()){
        header("location:../librosAdmin.php");
        exit();
    }else{
        echo 'Error! No existen resultados :o';
        exit();
    }
}else{
    echo 'Error! Revise la conexion con la BD :o';
    exit();
}$stmt->close();
$conexion -> close();
}else{
    echo 'Error! Intente mas tarde :o';
    exit();
}



?>