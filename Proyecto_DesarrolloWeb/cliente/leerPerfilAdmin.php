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
    <div align="center">
        <div >
            <label class="lab">Nombres: </label>
            <label class="textopa"><?php echo $nombre . " " . $apellido;?></label>
        </div>
        <br>
        <div>
            <label class="lab">Dirección: </label>
            <label class="textopa"><?php echo $direccion;?></label>
        </div>
        <br>
        <div>
            <label class="lab">Ciudad: </label>
            <label class="textopa"><?php echo $ciudad;?></label>
        </div>
        <br>
        <div>
            <label class="lab">Teléfono: </label>
            <label class="textopa"><?php echo $telefono;?></label>
        </div>
        <br>
        <div>
            <label class="lab">Cédula: </label>
            <label class="textopa"><?php echo $cedula;?></label>
        </div>
        <br>
        <div>
            <label class="lab">Tipo de usuario: </label>
            <label class="textopa"><?php echo $tipousuario;?></label>
        </div>
        <br>
        <div>
            <label class="lab">Username: </label>
            <label class="textopa"><?php echo $username;?></label>
        </div>
        </div>
        <p><a href="../perfilCliente.php" id="loadMore">Regresar</a></p>
    </div>
</body>
<link rel="stylesheet" href="../css/estiPerfil.css">

</html>