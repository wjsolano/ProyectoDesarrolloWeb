<?php
require_once '../conexion.php';
//validar si se ´pasam los datos por el metodo GET, porque se envia por URL
if(isset($_GET['id']) && !empty(trim($_GET['id']))){ //trim elimina los espacios vacios al inicio y al final
//construir la consulta
    $query='SELECT * FROM usuario WHERE id_usuario=?';
    //preparar la sentencia
    if($stmt=$conexion->prepare($query)){
        $stmt->bind_param('i',$_GET['id']); //i porque pasa un entero
        //ejecutar la sentencia
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array(MYSQLI_ASSOC); //transofrmar en una entidad asociativa
                $nombre=$row['nombre'];
                $apellido=$row['apellido'];
                $direccion=$row['direccion'];
                $ciudad=$row['ciudad'];
                $telefono=$row['telefono'];
                $cedula=$row['cedula'];
                $tipousuario= $row['tipo_usuario'];
                $username=$row['username'];
                
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
    <title>Datos  del cliente</title>
    <style>
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-box">
    <div>
        <h1>Datos del Cliente</h1>
    </div>
        <div >
            <label>Nombres</label>
            <p><?php echo $nombre . " " . $apellido;?></p>
        </div>
        <div>
            <label>Dirección</label>
            <p><?php echo $direccion;?></p>
        </div>
        <div>
            <label>Ciudad</label>
            <p><?php echo $ciudad;?></p>
        </div>
        <div>
            <label>Teléfono</label>
            <p><?php echo $telefono;?></p>
        </div>
        <div>
            <label>Cédula</label>
            <p><?php echo $cedula;?></p>
        </div>
 
        <p><a href="../perfilCliente.php" id="loadMore">Regresar</a></p>
    </div>
</body>
<link rel="stylesheet" href="estilos/estiPerfil.css" >
</html>