<?php
	$host = "mysql.hostinger.es";
	$user = "u221031495_test";
	$pw = "test123";
	$db_name = "u221031495_test";

	$name = $_POST['name'];
	$age = $_POST['age'];

	$con = mysql_connect($host,$user,$pw);
	mysql_select_db($db_name,$con);
	mysql_query("INSERT INTO user(name,age) VALUES('$name',$age)",$con);
?>