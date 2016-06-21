<?php

	$id_evento = $_REQUEST["id_evento"];
	$rut = $_REQUEST["rut"];
    $respuesta = $_REQUEST["respuesta"];

	include("conexion.php");

	$link = Conectarse();

    $rec = mysql_query("SELECT id_evento, id_integrante FROM asistencia WHERE id_evento = '$id_evento' AND id_integrante = '$rut'");

    if(mysql_num_rows($rec) != 0){
        mysql_query("UPDATE asistencia SET respuesta='$respuesta' WHERE id_evento = '$id_evento' AND id_integrante = '$rut'");
    }else{
        mysql_query("INSERT INTO asistencia VALUES ('$id_evento','$rut','$respuesta')");
    }
    
    mysql_free_result($rec);

    print($id_evento." - ".$rut." - ".$respuesta);
?>