<?php

    include("conexion.php");
    $link = Conectarse();
    
    $grupo = $_POST['nombreGrupo'];

    #$query = "SELECT rut, nombre, apellido_p FROM integrante WHERE rut = (SELECT id_integrante FROM integrante_grupo WHERE id_grupo = (SELECT id FROM grupo WHERE nombre = '$grupo'));";
    $query = "SELECT id_integrante FROM integrante_grupo WHERE id_grupo = (SELECT id FROM grupo WHERE nombre = '$grupo');";
    $result = mysql_query($query, $link) or die(mysql_error());
    
    while($row = mysql_fetch_array($result)){
        $rut = $row['id_integrante'];
        $query2 = "SELECT rut, nombre, apellido_p FROM integrante WHERE rut = '$rut'";
        $result2 = mysql_query($query2, $link) or die(mysql_error());
        while($row2 = mysql_fetch_array($result2)){
            echo "<option class='list-group-item' ondblclick='eliminar();' value='".$row2['rut']."'>".$row2['nombre']." ".$row2['apellido_p']."</option>";
        }
        #echo "<option class='list-group-item' value='".$row['id_integrante']."'>".$row['id_integrante']."</option>";
    }

    mysql_free_result($result2);
    mysql_free_result($result);

?>