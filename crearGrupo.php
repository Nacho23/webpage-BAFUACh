<?php

    include("conexion.php");
    $link = Conectarse();
    
    $grupo = $_POST['nuevoGrupo'];

    $query = "SELECT * FROM grupo WHERE nombre = '$grupo'";
    $result = mysql_query($query, $link) or die(mysql_error());

    if(mysql_num_rows($result) == 0){
        mysql_query("INSERT INTO grupo(nombre, visible) VALUES ('$grupo','true');");
        echo "Grupo creado exitosamente";
    }else{
        mysql_query("UPDATE grupo SET visible = 'true' WHERE nombre = '$grupo'");
        echo "CREADO CORRECTAMENTE\r\nYa existía un grupo con llamado $grupo, por lo que se cargaron los datos que existían anteriormente.";
    }  

    mysql_free_result($result);
?>