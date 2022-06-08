<?php
require_once 'conexion.php'; /*TRAER LA CONEXION */
//consulta de los datos

$query = "SELECT id_orden, id_usuario, id_libro, fecha_orden, fecha_entrega FROM ordenes";
//ejecutar consulta
$result= $conexion -> query($query); //todos los campos de la consulta
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilos.css">
    <style>
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td{
            padding: 5px;
            text-align: left;
        }
    </style>
    <title>Ordenes Cliente</title>
</head>
<script type="text/javascript">
    function ConfirmDelate(){
        var respuesta = confirm("¿De verdad desea eliminar la orden?");
        if(respuesta==true){
            return true;
        }else{
            return false;
        }
    }
</script>
<body>
    <div>
    <h1 align="center"> ORDENES </h1>
        <h4 style="width: 300px"><button class="buttons"><a href="../php/agregarOC.php">
            <b>Agregar orden</b></a></button>
        </h4>   
        <div id="tabla-contenedor">
        <div>
        <table border="2" class="table table-fixed" align="center">
            <thead>
                <tr>
                    <th id="cabecera">#</th>
                    <th id="cabecera">Id Orden</th>
                    <th id="cabecera">Fecha Entrega</th>
                    <th id="cabecera">Fecha Orden</th>
                    <th id="cabecera">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($result-> num_rows>0){
                    //si tiene resultado hacer esto
                    while($row=$result-> fetch_assoc()){ //el resultado se transforme en matriz asociativa
                        echo '<tr>';
                        echo '<td>' . $row['id_usuario'] .'</td>'; 
                        echo '<td>' . $row['id_libro']  . '</td>'; 
                        echo '<td>' . $row['fecha_orden'] .'</td>'; 
                        echo '<td>' . $row['fecha_entrega'] .'</td>'; 
                        echo '<td>';
                        echo '<a id="loadMore" href="../Cliente/leer.php?id='.$row['id_orden'].'">Leer</a>'; //para pasar es el ? segun donde de click
                        echo '<a id="loadMore" href="../Cliente/actualizar.php?id='.$row['id_orden'].'">Editar</a>';
                        echo '<a id="loadMore" href="../Cliente/eliminar.php?id='.$row['id_orden'].'" onclick="return ConfirmDelate()">Eliminar</a>'; 
                        echo '</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<p><em>No existen datos registrados</em></p>';
                }
                ?>
            </tbody>
        </table>
        </div>
        <a href="../bienvenidaCliente.php" id="cerrar">Regresar</a>
    </div>
</body>
<link rel="stylesheet" href="../css/estiPerfil.css">
</html>
