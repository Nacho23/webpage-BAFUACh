<?php
error_reporting(E_ALL ^ E_DEPRECATED);
function Conectarse(){
	if(!($link = mysql_connect("mysql.hostinger.es","u221031495_baf","18653129a"))){
		echo "Error al conectar a la BD";
		exit();
	}
	if(!mysql_select_db("u221031495_baf", $link)){
		echo "Error al seleccionar la BD";
		exit();
	}
	return $link;
}
?>


