<?php
require_once 'conexion.php'; /*TRAER LA CONEXION */
//consulta de los datos

$query = "SELECT id_usuario,nombre,apellido,direccion,ciudad,telefono,cedula,tipo_usuario,username FROM usuario";
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
            padding: 10px;
            text-align: left;
        }
    </style>
    <title>Index</title>
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
        <h1 align="center"> Perfil Administrador</h1>   
        <div id="tabla-contenedor">
        <table border="2" class="table table-fixed" align="center">
            <thead>
                <tr>
                    <th id="cabecera">#</th>
                    <th id="cabecera">Nombre</th>
                    <th id="cabecera">Apellido</th>
                    <th id="cabecera">Dirección</th>
                    <th id="cabecera">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($result-> num_rows>0){
                    //si tiene resultado hacer esto
                    while($row=$result-> fetch_assoc()){ //el resultado se transforme en matriz asociativa
                        // 'idusuario'= 1, 'nombreusuario'=luis
                        echo '<tr>'; //el unto es para oncatenar
                        echo '<td>' . $row['id_usuario'] .'</td>'; 
                        echo '<td>' . $row['nombre']  . '</td>'; 
                        echo '<td>' . $row['apellido'] .'</td>'; 
                        echo '<td>' . $row['direccion'] .'</td>'; 
                        echo '<td>';
                        echo '<a id="loadMore" href="admin/leerPerfilAdmin.php?id='.$row['id_usuario'].'">Leer</a>'; //para pasar es el ? segun donde de click
                        echo '<a id="loadMore" href="admin/actualizarUsuarios.php?id='.$row['id_usuario'].'">Editar</a>';
                        echo '<a id="loadMore" href="admin/eliminarPerfilAdmin.php?id='.$row['id_usuario'].'" onclick="return ConfirmDelate()">Eliminar</a>'; 
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
        <a href="bienvenidaAdmin.php" id="cerrar">Regresar</a>
    </div>
</body>
<link rel="stylesheet" href="css/estiPerfil.css">
</html>


