<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
 	$con = mysql_connect("mysql.hostinger.es","u221031495_baf","18653129a") or die("Sin conexion");
  	mysql_select_db("u221031495_baf"); 
  	$sql="SELECT id,titulo,mensaje FROM anuncio";// ORDER BY id ASC LIMIT 0,1";
  	$datos=array();
  	$rs=mysql_query($sql,$con);
  	while($row=mysql_fetch_object($rs)){
       $datos[] = $row;
  	}
  	echo json_encode($datos);
  	mysql_free_result($rs);
?>