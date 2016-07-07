<?php

    include("conexion.php");
    $link = Conectarse();
    
    $rutIntegrante = $_POST['rutIntegrante'];
    $nomGrupo = $_POST['nomGrupo'];

    $query_grupo = "SELECT id FROM grupo WHERE nombre = '$nomGrupo'";
    $result_grupo = mysql_query($query_grupo, $link) or die(mysql_error());
    while($row_grupo = mysql_fetch_array($result_grupo)){
        $idGrupo = $row_grupo['id'];
    }

    $query_integrante = "SELECT id_integrante FROM integrante_grupo WHERE id_grupo = '$idGrupo'";
    $result_integrante = mysql_query($query_integrante, $link);

    $i = 0;
    
    while($row_integrante = mysql_fetch_array($result_integrante)){
        if($row_integrante['id_integrante'] == $rutIntegrante){
            $i = $i + 1;
        }
    }
    
    if($i == 1){
        echo "El Integrante ya está en el grupo seleccionado";
    }else{
        mysql_query("INSERT INTO integrante_grupo(id_integrante, id_grupo) VALUES ('$rutIntegrante', '$idGrupo');");
    }

    mysql_free_result($result_integrante);
    mysql_free_result($result_grupo);
?>