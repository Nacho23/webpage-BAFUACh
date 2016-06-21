<?php

    include("conexion.php");
    $link = Conectarse();

    /*$data = json_decode($_POST['jObject'], true);
    for($i = 0; $i < 2; $i++){
        $rut = $data[$i];
        $email = $data[$i+1];
    }*/

    $rut = $_POST['rut'];
    $email = $_POST['email'];

    $res = mysql_query("SELECT rut, correo FROM integrante WHERE rut = '$rut' AND correo = '$email';", $link);
    
    if(mysql_num_rows($res) == 0) die ("Los datos no coinciden o no existe el registro");


    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena=strlen($cadena);

    $clave = "";
    $longitudPass = 8;

    for($i=1 ; $i<=$longitudPass ; $i++){
        $pos=rand(0,$longitudCadena-1);
        $clave .= substr($cadena,$pos,1);
    }

    $claveEncr = md5($clave);

    mysql_query("UPDATE cuenta SET clave='$claveEncr' WHERE rut='$rut';", $link);


    require_once('phpmailer/class.phpmailer.php');
    $correo = new PHPMailer();

    $subject = 'Recordar Contraseña';  
    $correo->Subject = $subject;

    $remite = 'administracion@bafuach.esy.es';
    $correo->SetFrom($remite, "Ballet Folclorico Universidad Austral de Chile");
    $correo->AddReplyTo($remite, "Ballet Folclorico Universidad Austral de Chile");

    $message = '<html><body>';
    $message .= '<b>Su nueva contraseña es: </b>';
    $message .= '<p><br><br>'.$clave.'<br><br><br><br><font color=#FF0000>No olvide actualizar su contraseña.</font><br></p>';
    $message .= '</body></html>';
    $correo->MsgHTML($message);

    $destino = $email;
    $correo->AddAddress($destino);

    mysql_free_result($res);

    if($correo->Send()){
        echo '<script lengauge="javascript">
        alert("La contraseña se envio a su correo electrónico");
        self.close();
        </script>';
    }else{
        echo '<script lengauge="javascript">
        alert("No se pudo enviar el correo, contacte a Soporte");
        self.close();
        </script>';
    }

?>