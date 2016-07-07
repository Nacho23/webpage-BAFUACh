<?php

    include("conexion.php");
    $link = Conectarse();
    
    $query_grupos = "SELECT id, nombre FROM grupo WHERE visible = 'true'";
    $result_grupos = mysql_query($query_grupos, $link);

    while($row_grupos = mysql_fetch_array($result_grupos)){
        $valor = $row_grupos['nombre'];
        echo "<option class='list-group-item' value='$$valor'>$valor</option>"
    }
?>