<?php
	include("conexion.php");
        require_once('phpmailer/class.phpmailer.php');

	$link = Conectarse();
	$data = json_decode($_POST['jObject'], true);
	for($i = 0; $i < count($data); $i++) {
		echo $data[$i];
		echo "\n";
        
        $rec = mysql_query("SELECT correo, nombre FROM integrante");

        $correo = new PHPMailer();

        $subject = 'Mensaje reenviado';  
        $correo->Subject = $subject;

        $remite = 'administracion@bafuach.esy.es';
        $correo->SetFrom($remite, "Ballet Folclorico Universidad Austral de Chile");
        $correo->AddReplyTo($remite, "Ballet Folclorico Universidad Austral de Chile");
            
        $message = '<html><body>';
        $message .= '<b>MENSAJE REENVIADO</b>';
        $message .= '<p><br><br>'.$data[$i].'<br><br><br><br><br><font color=#848484>Enviado: '.$fecha.'</font></p>';
        $message .= '</body></html>';
        $correo->MsgHTML($message);

        while($row = mysql_fetch_array($rec)){
            $destino = $row['correo'];
            $correo->AddAddress($destino, "");
        }

        if($correo->Send()){
            echo '<script lenguage="javascript">
            alert ("Enviado Corresctamente");
            self.location = "menu.php";
            </script>';
        }else{
            echo '<script lenguage="javascript">
            alert ("No se pudo enviar el mensaje a los correos electrÃ³nicos");
            self.location = "menu.php";
            </script>';
        }
        
        mysql_free_result($rec);
	}
?>
	