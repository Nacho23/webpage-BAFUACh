<?php
    include("conexion.php");
    $link = Conectarse();

    $idAnuncio = $_POST['idAnuncio'];
    

    $query = "SELECT rut,I.nombre,apellido_p FROM integrante I, asistencia A, evento E WHERE I.rut = A.id_integrante AND A.id_evento = E.id AND E.id = '$idAnuncio' AND A.respuesta = 'No Asistir';";

    $result = mysql_query($query, $link) or die(mysql_error());

    if(mysql_num_rows($result) != 0){
        $resultado =  "<b>No Asistirán</b><br>";
        while($row = mysql_fetch_array($result)){
            $resultado .= "<p class='text-left'>".$row['nombre']." ".$row['apellido_p']."</p>";
        }
        echo $resultado;
    }else{
        $resultado = "No hay respuestas";
        echo $resultado;
    }

    $resultado = "";
    mysql_free_result($result);
?>