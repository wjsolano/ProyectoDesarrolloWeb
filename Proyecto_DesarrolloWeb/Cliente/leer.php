<?php
require_once '../php/conexion.php';
//validar si se ´pasam los datos por el metodo GET, porque se envia por URL
if(isset($_GET['id']) && !empty(trim($_GET['id']))){ //trim elimina los espacios vacios al inicio y al final
//construir la consulta
    $query='SELECT * FROM ordenes WHERE id_orden=?';
    //preparar la sentencia
    if($stmt=$conexion->prepare($query)){
        $stmt->bind_param('i',$_GET['id']); //i porque pasa un entero
        //ejecutar la sentencia
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array(MYSQLI_ASSOC); //transofrmar en una entidad asociativa
                $idUsuario=$row['id_usuario'];
                $idLibro=$row['id_libro'];
                $fechaOrden=$row['fecha_orden'];
                $fechaEntrega=$row['fecha_entrega'];
            }else{
                echo 'Error! No existen resultados :o';
                exit();
            }
        }
        else{
            echo 'Error! Revise la conexion con la BD :o';
            exit();
        }
    }
    $stmt->close();
    $conexion -> close();
}else{
    echo 'Error! Intente mas tarde :o';
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos  del Libro</title>
    <style>
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-box">
        <div>
            <label>ID Usuario</label>
            <p><?php echo $idUsuario;?></p>
        </div>
        <div >
            <label>ID Libro</label>
            <p><?php echo $idLibro;?></p>
        </div>
        <div>
            <label>Fecha Orden</label>
            <p><?php echo $fechaOrden;?></p>
        </div>
        <div>
            <label>Fecha Entrega</label>
            <p><?php echo $fechaEntrega;?></p>
        </div>
        <p><a href="../php/perfilOC.php" id="loadMore">Regresar</a></p>
    </div>
</body>
<link rel="stylesheet" href="estilos/estiPerfil.css" >
</html>