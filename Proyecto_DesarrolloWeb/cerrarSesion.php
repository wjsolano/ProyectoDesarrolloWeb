<?php
//inicializar la sesión
session_start();

//controlar si se ingresa directamente sin loggueo
if($_SESSION['id_usuario']!=null){
    session_destroy();
    header("location:index.html");
}else{
    session_destroy();
    header("location:index.html");
}

?>