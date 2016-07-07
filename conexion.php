<?php
error_reporting(E_ALL ^ E_DEPRECATED);
function Conectarse(){
	if(!($link = mysql_connect("localhost","root",""))){
		echo "Error al conectar a la BD";
		exit();
	}
	if(!mysql_select_db("infobafuach", $link)){
		echo "Error al seleccionar la BD";
		exit();
	}
	return $link;
}
?>


