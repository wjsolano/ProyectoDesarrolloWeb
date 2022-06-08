<?php
//conexion a la base de datos
require_once '<div class="">
<php>conexion.php';

//Saber si se llama por post
if($_SERVER['REQUEST_METHOD']=='POST'){
    //Almacenar post en variables
    $titulo = $_POST['titulo'];
    $nombreA = $_POST['nombre_autor'];
    $apellidoA = $_POST['apellido_autor'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];

    //Verificar si se estan enviando todos los datos
    if(isset($titulo) && !empty(trim($titulo)) && isset($nombre_autor) && !empty(trim($apellido_autor)) 
    && isset($categoria) && isset($precio) ){
        //Generar la consulta
        $consulta = "INSERT INTO libro (id_usuario, id_orden, fecha_orden, fecha_entrega) VALUES (?, ?, ?, ?)";
        //preparar la insercion
        if($stmt = $conn -> prepare($consulta)){
            $stmt -> bind_param('ssssss', $idUsuario, $idOrden, $fechaEntrega, $fechaOrden);
            //Validar si se ejecuta el stmt
            if($stmt -> execute()){
                header("location: index.php");
                exit();
            }else{
                echo "Error! Por favor intente mas tarde";
            }
            $stmt -> close();
        }
    }
    $conn -> close();
}

require_once 'ordenesAdmin.html'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Orden</title>
</head>
<body>
    <div>
        <h2>Agregar un Usuario</h2>
        <p>Llene este formulario para agregar un usuario al sistema</p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div>
                <label></label>
                <input type="text" name="id_usuario" require>
            </div>
            <div>
                <label>Apellido</label>
                <input type="text" name="apellidousuario" require>
            </div>
            <div>
                <label>Cedula</label>
                <input type="text" name="cedulausuario" require>
            </div>
            <div>
                <label>Telefono</label>
                <input type="text" name="telefonousuario" require>
            </div>
            <div>
                <label>Direccion</label>
                <input type="text" name="direccionusuario" require>
            </div>
            <div>
                <label>Correo</label>
                <input type="text" name="correousuario" require>
            </div>
            <input type="submit" value="Agregar">
            <a href="index.php">Cancelar</a>
        </form>
    </div>
</body>
</html>