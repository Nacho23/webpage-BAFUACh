<?php
	include("conexion.php");
	$link = Conectarse();
	$data = json_decode($_POST['jObject'], true);
	$cont = 0;
	for($i = 0; $i < count($data); $i++) {
		echo $data[$i];
		echo "\n";
        mysql_query("DELETE FROM cuenta WHERE rut ='$data[$i]'",$link);
        mysql_query("DELETE FROM integrante WHERE rut ='$data[$i]'", $link);
	}
?>

				