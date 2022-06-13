<?php
require_once '../php/conexion.php';

//validar si se ´pasam los datos por el metodo GET, porque se envia por URL
if(isset($_GET['id']) && !empty(trim($_GET['id']))){ //trim elimina los espacios vacios al inicio y al final
//construir la consulta
    $query='SELECT o.id_orden, o.id_usuario, o.id_libro, o.fecha_orden, o.fecha_entrega, l.titulo, u.nombre 
    FROM ordenes as o JOIN usuario as u ON o.id_usuario=u.id_usuario JOIN libros l ON o.id_libro=l.id_libro WHERE id_orden=?';
    //preparar la sentencia
    if($stmt=$conexion->prepare($query)){
        $stmt->bind_param('i',$_GET['id']); //i porque pasa un entero
        //ejecutar la sentencia
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array(MYSQLI_ASSOC); //transofrmar en una entidad asociativa
                $id_usuario=$row['id_usuario'];
                $id_libro=$row['id_libro'];
                $fechaOrden=$row['fecha_orden'];
                $fechaEntrega=$row['fecha_entrega'];
                $nombreusua=$row['nombre'];
                $titulo=$row['titulo'];
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
    <title>Datos  de una Orden</title>
    <style>
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-box">
    <div>
        <h1>Datos del Ordenes</h1>
    </div>
    <div align="center">
        <div>
            <label class="lab">ID Usuario</label>
            <label class="textopa"><?php echo $nombreusua?></label>
        </div>
        <div >
            <label class="lab">ID Libro</label>
            <label class="textopa"><?php echo $titulo?></label>
        </div>
        <div>
            <label class="lab">Fecha Orden</label>
            <label class="textopa"><?php echo $fechaOrden;?></label>
        </div>
        <div>
            <label class="lab">Fecha Entrega</label>
            <label class="textopa"><?php echo $fechaEntrega;?></label>
        </div>
        <p><a href="../php/perfilOC.php" class="btnR">Regresar</a></p>
    </div>
</div>
</body>
<link rel="stylesheet" href="../css/estiPerfil.css" >
</html>