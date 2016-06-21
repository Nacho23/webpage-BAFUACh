<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	require_once 'config.php';

	mysql_connect(DB_HOST, DB_USER, DB_PASSWORD); 
	$db= mysql_select_db(DB_DATABASE); 
	$password=$_POST["password"]; 
	$username=$_POST["username"]; 

	$password_encry = md5($password);
	if (!empty($_POST)) { 
		if (empty($_POST['username']) || empty($_POST['password'])) { 
			// Create some data that will be the JSON response 
			$response["success"] = 0; 
			$response["message"] = " Uno o mas campos vacíos ."; 
			//die is used to kill the page, will not let the code below to be executed. It will also 
			//display the parameter, that is the json data which our android application will parse to be 
			//shown to the users 
			die(json_encode($response)); 
		} 
		$query = " SELECT * FROM cuenta WHERE rut = '$username' and clave = '$password_encry' "; 
		$sql1=mysql_query($query); 
		$row = mysql_fetch_array($sql1); 
		if (!empty($row)) { 
			$response["success"] = 1; 
			$response["message"] = " Ingresado Correctamente"; 
			die(json_encode($response)); 
		} 
		else{ 
			$response["success"] = 0; 
			$response["message"] = " Usuario o Contraseña Incorrecta "; 
			die(json_encode($response)); 
		} 
	} 
	else{ 
		$response["success"] = 0; 
		$response["message"] = " Uno o más campos vacíos "; 
		die(json_encode($response)); 
	} 
	mysql_close(); 
?>