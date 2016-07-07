<?php

    include("conexion.php");
    $link = Conectarse();

    $grupo = $_POST['grupo'];
    mysql_query("UPDATE grupo SET visible = 'false' WHERE nombre = '$grupo'");
    echo "Grupo $grupo eliminado exitosamente";
?>