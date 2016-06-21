<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
	require_once 'config.php';

	mysql_connect(DB_HOST, DB_USER, DB_PASSWORD); 
	$db = mysql_select_db(DB_DATABASE); 

	$rut = $_POST["rut"];
	$token = $_POST["token"];
    
    $query = " SELECT * FROM integrante_dispositivo WHERE rut = '$rut' and registration_token = '$token' "; 
    $sql1=mysql_query($query); 
    $row = mysql_fetch_array($sql1); 
    if (empty($row)) {
        mysql_query("INSERT INTO integrante_dispositivo(rut,registration_token) VALUES('$rut','$token')");
        
        $response["message"] = "Registrado"; 
        die(json_encode($response)); 
    } 
    else{

        $response["message"] = "Ya estas registrado";
        die(json_encode($response));
        mysql_close();
    }
?>