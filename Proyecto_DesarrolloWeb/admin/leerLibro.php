<?php
require_once '../conexion.php';
//validar si se ´pasam los datos por el metodo GET, porque se envia por URL
if(isset($_GET['id']) && !empty(trim($_GET['id']))){ //trim elimina los espacios vacios al inicio y al final
//construir la consulta
    $query='SELECT * FROM libros WHERE id_libro=?';
    //preparar la sentencia
    if($stmt=$conexion->prepare($query)){
        $stmt->bind_param('i',$_GET['id']); //i porque pasa un entero
        //ejecutar la sentencia
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array(MYSQLI_ASSOC); //transofrmar en una entidad asociativa
                $titulo=$row['titulo'];
                $nombre=$row['nombre_autor'];
                $apellido=$row['apellido_autor'];
                $categoria=$row['categoria'];
                $precio=$row['precio'];
                
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
        <h1>Datos del Libro</h1>
    </div>
    <div align="center">
        <div>
            <label class="lab">Titulo</label>
            <label class="textopa"><?php echo $titulo;?></label>
        </div>
        <div >
            <label class="lab">Nombres</label>
            <label class="textopa"><?php echo $nombre . " " . $apellido;?></label>
        </div>
        <div>
            <label class="lab">Categoria</label>
            <label class="textopa"><?php echo $categoria;?></label>
        </div>
        <div>
            <label class="lab">Precio</label>
            <label class="textopa"><?php echo $precio." $";?></label>
        </div>
        <p><a href="../librosAdmin.php" id="cerrar">Regresar</a></p>
    </div>
    </div>
</body>
<link rel="stylesheet" href="../css/estiPerfil.css">
</html>