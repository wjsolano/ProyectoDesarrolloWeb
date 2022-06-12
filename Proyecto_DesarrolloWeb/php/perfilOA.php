<?php
require_once 'conexion.php'; /*TRAER LA CONEXION */
//consulta de los datos

$query = "SELECT o.id_orden, o.id_usuario, o.id_libro, o.fecha_orden, o.fecha_entrega, l.titulo, u.nombre 
FROM ordenes as o JOIN usuario as u ON o.id_usuario=u.id_usuario JOIN libros l ON o.id_libro=l.id_libro";
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
    <title>Agregar Orden</title>
</head>
<script type="text/javascript">
    function ConfirmDelate(){
        var respuesta = confirm("¿De verdad desea eliminar al usuario?");
        if(respuesta==true){
            return true;
        }else{
            return false;
        }
    }
</script>
<body>
    <div>
    <h1 align="center"> Ordenes</h1>   
        <div id="tabla-contenedor">
        <table border="2" class="table table-fixed" align="center">
            <thead>
                <tr>
                    <th id="cabecera">Usuario</th>
                    <th id="cabecera">Orden</th>
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
                        echo '<td>' . $row['nombre'] .'</td>'; 
                        echo '<td>' . $row['titulo']  . '</td>'; 
                        echo '<td>' . $row['fecha_orden'] .'</td>'; 
                        echo '<td>' . $row['fecha_entrega'] .'</td>'; 
                        echo '<td>';
                        echo '<a id="loadMore" href="../admin/leerOrden.php?id='.$row['id_orden'].'">Leer</a>'; //para pasar es el ? segun donde de click
                        echo '<a id="loadMore" href="../admin/actualizarOrden.php?id='.$row['id_orden'].'">Editar</a>';
                        echo '<a id="loadMore" href="../admin/eliminarOrden.php?id='.$row['id_orden'].'" onclick="return ConfirmDelate()">Eliminar</a>'; 
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
        <a href="../bienvenidaAdmin.php" id="cerrar">Regresar</a>
    </div>
</body>
<link rel="stylesheet" href="../css/estiPerfil.css">
</html>
