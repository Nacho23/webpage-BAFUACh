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

    mysql_query("DELETE FROM integrante_grupo WHERE id_integrante = '$rutIntegrante' AND id_grupo = '$idGrupo'",$link);
    

    mysql_free_result($result_grupo);
?>