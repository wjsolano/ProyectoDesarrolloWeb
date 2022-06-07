<?php
$conexion=new mysqli("localhost","root","","biblioteca");
if($conexion){
    echo "Conexion exitosa";
}else{
    echo "Conexion no exitosa";
}
?>