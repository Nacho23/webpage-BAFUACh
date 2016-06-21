<?php

	$rut = $_REQUEST["rut"];
	$mensaje = $_REQUEST["mensaje"];

	include("conexion.php");
    require_once('phpMailer/class.phpmailer.php');

	$link = Conectarse();
    
    $rec = mysql_query("SELECT correo, nombre FROM integrante WHERE rut = '{$rut}'");

    $correo = new PHPMailer();

    $row = mysql_fetch_array($rec);

    $subject = 'Mensaje Soporte info-BAFUACh';  
    $correo->Subject = $subject;

    $remite = $row['correo'];
    $correo->SetFrom($remite, $row['nombre']);
    $correo->AddReplyTo($remite, $row['nombre']);
        
    $message = '<html><body>';
    $message .= '<b>Enviado por </b>'.$row['nombre'].' - '.$rut;
    $message .= '<p><br><br>'.$mensaje.'<br><br><br><br><br></p>';
    $message .= '</body></html>';
    $correo->MsgHTML($message);

    $destino = "marcelotorres23.mt@gmail.com";
    $correo->AddAddress($destino, "");

    if($correo->Send()){
        $output[] = ["con", "1"];
    }else{
        $output[] = ["con", "0"];
    }
    
    print(json_encode($output));
    mysql_free_result($rec);


?>