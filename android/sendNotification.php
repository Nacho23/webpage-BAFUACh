<?php

$titulo = $tituloAnuncio;
$mensaje = $mensajeAnuncio;
$cod = $codigo;

error_reporting(E_ALL ^ E_DEPRECATED);
require_once 'config.php';

$url = 'https://fcm.googleapis.com/fcm/send';
$serverKey = 'AIzaSyDMJwXjAdbsFoWg2jMGRrzKM3zX4I3GhI4';

$title = $titulo;
$text = $mensaje;

$ch = curl_init($url);

mysql_connect(DB_HOST, DB_USER, DB_PASSWORD); 
$db = mysql_select_db(DB_DATABASE); 


$query = " SELECT * FROM integrante_dispositivo "; 
$result= mysql_query($query);

if (mysql_num_rows($result) == 0) {
    echo "No Registration tokens.";
    exit;
}

$fila = mysql_fetch_assoc($result);
    
$registration_ids = array($fila["registration_token"]);

while ($fila = mysql_fetch_assoc($result)) {
    $temp_array = array($fila["registration_token"]);
    $registration_ids = array_merge($registration_ids,$temp_array);
}

$jsonData = array(
    'notification' => array(
        'title' => $title,
        'body' => $text,
        'icon' => 'myicon',
        'sound' => 'default',
        'color' => '#FF0000'
    ),
    'registration_ids' => $registration_ids
);
 
//creamos el json a partir de nuestro arreglo
$jsonDataEncoded = json_encode($jsonData);
 
curl_setopt($ch, CURLOPT_POST, 1);
 
 //para que la peticion no imprima el resultado como un echo comun, y podamos manipularlo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: key=AIzaSyDMJwXjAdbsFoWg2jMGRrzKM3zX4I3GhI4',
    'Content-Type: application/json'));

#if($cod == md5('J7FSAD782HFSLKADFA823KJFLFASD9')){

$response = curl_exec($ch);

/**
if($response === FALSE){
    die(curl_error($ch));
}

// Decode the response
$responseData = json_decode($response, TRUE);

// Print the date from the response
echo $response;**/

#}
#else{
#echo "Sin autorización";
#}
?>	
