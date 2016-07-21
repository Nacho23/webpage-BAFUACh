<?php
	include("conexion.php");
	require_once('phpmailer/class.phpmailer.php');
    require 'phpmailer/PHPMailerAutoload.php';

	$link = Conectarse();

	if(isset($_POST['titulo']) && !empty($_POST['titulo']) &&
		isset($_POST['mensaje']) && !empty($_POST['mensaje'])){

		$now = getdate(time());

		$tituloAnuncio = $_POST['titulo'];
		$mensajeAnuncio = $_POST['mensaje'];
        $fecha = date("Y-m-d H:i:s",time()-14400);
        $codigo = md5('J7FSAD782HFSLKADFA823KJFLFASD9');
        
        $fecha_evento = $_POST['fecha_evento'];
        $lugar_evento = $_POST['lugar_evento'];
        
        $fecha_evento_mod = substr($fecha_evento,6,4)."-".substr($fecha_evento,3,2)."-".substr($fecha_evento,0,2)." ".substr($fecha_evento,10,9);
        
        $tipoMsje = $_POST['tipoMsje'];
        $enviarGrupo = $_POST['listaComboBox'];
        
        $query_id = "SELECT id FROM grupo WHERE nombre = '$enviarGrupo'";
        $result_id = mysql_query($query_id, $link);
        while($row_id = mysql_fetch_array($result_id)){
            $idGrupo = $row_id['id'];
        }
        mysql_free_result($result_id);
        
        
        if(strcmp($enviarGrupo, "Todos") == 0){
            $correo = new PHPMailer();
            $correo->IsSMTP();
            if(strcmp($tipoMsje, "Anuncio")){ #Si la opcion es de tipo "Evento"
                
                $mensajeAnuncioEvento = $mensajeAnuncio." (Evento)";
                mysql_query("INSERT INTO anuncio(titulo, mensaje, fecha) values ('$tituloAnuncio','$mensajeAnuncioEvento','$fecha')");
                $req = mysql_query("SELECT MAX(id) FROM anuncio");
                $rows = mysql_fetch_array($req);
                $id = $rows[0];
                mysql_query("INSERT INTO evento(id, nombre, descripcion, lugar, fecha_inicio) VALUES('$id','$tituloAnuncio','$mensajeAnuncioEvento', '$lugar_evento', '$fecha_evento_mod');");
                mysql_free_result($req);

            }else{
                mysql_query("INSERT INTO anuncio(titulo, mensaje, fecha) values ('$tituloAnuncio','$mensajeAnuncio','$fecha')");
            }

            #include_once './android/sendNotification.php';
        }

        if(isset($_REQUEST['enviarEmail']) or strcmp($enviarGrupo, "Todos") != 0){
            $correo = new PHPMailer();
            #$correo->IsSMTP();
            $correo->Host = "smtp.example.com";
            
            $varname = $_FILES['inputFile']['name'];
            $vartemp = $_FILES['inputFile']['tmp_name'];

            $archivo = $_FILES['inputFile'];

            if(strcmp($enviarGrupo, "Todos") == 0){
                $rec = mysql_query("SELECT correo, nombre FROM integrante");
            }else{
                $rec = mysql_query("SELECT I.nombre, correo FROM integrante I, integrante_grupo A, grupo G WHERE I.rut = A.id_integrante AND A.id_grupo = G.id AND G.nombre = '$enviarGrupo'");  
            }

            $subject = $tituloAnuncio;  
            $correo->Subject = $tituloAnuncio;

            $remite = 'administracion@bafuach.esy.es';
            $correo->SetFrom($remite, "Ballet Folclorico Universidad Austral de Chile");
            $correo->AddReplyTo($remite, "Ballet Folclorico Universidad Austral de Chile");

            if($archivo['name'] != ""){
                $correo->AddAttachment($vartemp, $varname);   
            }


            $message = '<html><body>';
            $message .= '<p><br><br>'.$mensajeAnuncio.'<br><br><br><br><br><font color=#848484>Enviado: '.$fecha.'</font></p>';
            $message .= '</body></html>';
            $correo->MsgHTML($message);

            while($row = mysql_fetch_array($rec)){                
                $destino = $row['correo'];
                $correo->AddAddress($destino, "");
            }

            if(!$correo->Send()){
                echo "Mailer Error (" . $correo->ErrorInfo . '<br />';
                #break; //Abandon sending
                echo "No se pudo enviar el mensaje a los correos electrónicos";
            }

            mysql_free_result($rec);
            $correo->clearAddresses();
            $correo->clearAttachments();
            
        }   
        echo "Enviado Correctamente";
    }
    else{
        echo "Debe llenar todos los campos";
    }

?>