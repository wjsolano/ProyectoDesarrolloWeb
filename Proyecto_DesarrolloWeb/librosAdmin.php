<?php
require_once 'conexion.php'; /*TRAER LA CONEXION */
//consulta de los datos

$query = "SELECT id_libro,titulo,nombre_autor,apellido_autor,categoria,precio FROM libros";
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
    <title>Index</title>
</head>
<script type="text/javascript">
    function ConfirmDelate(){
        var respuesta = confirm("¿De verdad desea eliminar el Libro?");
        if(respuesta==true){
            return true;
        }else{
            return false;
        }
    }
</script>
<body>
    <div>
        <h1 align="center"> LIBROS </h1>
        <h4 style="width: 300px"><button class="buttons"><a href="admin/agregarLibro.php">
            <b>Agregar Libro</b></a></button>
        </h4>   
        <div id="tabla-contenedor">
        <table border="2" class="table table-fixed">
            <thead>
                <tr>
                    <th id="cabecera">#</th>
                    <th id="cabecera">Título</th>
                    <th id="cabecera">Nombre del Autor</th>
                    <th id="cabecera">Apellido del autor</th>
                    <th id="cabecera">Categoria</th>
                    <th id="cabecera">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($result-> num_rows>0){
                    //si tiene resultado hacer esto
                    while($row=$result-> fetch_assoc()){ //el resultado se transforme en matriz asociativa
                        // 'idusuario'= 1, 'titulousuario'=luis
                        echo '<tr>'; //el unto es para oncatenar
                        echo '<td>' . $row['id_libro'] .'</td>'; 
                        echo '<td>' . $row['titulo']  . '</td>'; 
                        echo '<td>' . $row['nombre_autor'] .'</td>'; 
                        echo '<td>' . $row['apellido_autor'] .'</td>';
                        echo '<td>' . $row['categoria'] .'</td>'; 
                        echo '<td>' . $row['precio'] .'</td>';  
                        echo '<td>';
                        echo '<a id="loadMore" href="admin/leerLibro.php?id='.$row['id_libro'].'">Leer</a>'; //para pasar es el ? segun donde de click
                        echo '<a id="loadMore" href="admin/actualizarLibro.php?id='.$row['id_libro'].'">Editar</a>';
                        echo '<a id="loadMore" href="admin/eliminarLibro.php?id='.$row['id_libro'].'" onclick="return ConfirmDelate()">Eliminar</a>';
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