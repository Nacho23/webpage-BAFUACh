<head>
	<script lenguage="javascript">
		function msgError(){
			alert("Debe llenar todos los campos !!")
		}
		function redireccionar(){
            window.location = "menu.php";
		}
		function msgConfirm(){
			alert("Enviado Correctamente")
		}
        
	</script>
</head>
<?php

	include("conexion.php");
	require_once('phpmailer/class.phpmailer.php');
	$link = Conectarse();
	if(isset($_POST['titulo']) && !empty($_POST['titulo']) &&
		isset($_POST['mensaje']) && !empty($_POST['mensaje'])){

		$now = getdate(time());

		$tituloAnuncio = $_POST['titulo'];
		$mensajeAnuncio = $_POST['mensaje'];
        $fecha = date("Y-m-d H:i:s",time()-14400);
        $codigo = md5('J7FSAD782HFSLKADFA823KJFLFASD9');
        #$fecha = $now['year'].'-'.$now['mon'].'-'.$now['mday'].' '.$now['hours'].':'.$now['minutes'].':'.$now['seconds'];
        
        $tipoMsje = $_POST['tipoMsje'];

        if(strcmp($tipoMsje, "Anuncio")){
            $mensajeAnuncioEvento = $mensajeAnuncio." (Evento)";
            mysql_query("INSERT INTO anuncio(titulo, mensaje, fecha) values ('$tituloAnuncio','$mensajeAnuncioEvento','$fecha')");
            $req = mysql_query("SELECT MAX(id) FROM anuncio");
            $rows = mysql_fetch_array($req);
            $id = $rows[0];
            mysql_query("INSERT INTO evento(id, nombre, descripcion) VALUES('$id','$tituloAnuncio','$mensajeAnuncioEvento');");
            mysql_free_result($req);
            
        }else{
            mysql_query("INSERT INTO anuncio(titulo, mensaje, fecha) values ('$tituloAnuncio','$mensajeAnuncio','$fecha')");
        }
        
        include_once 'android/sendNotification.php';
		     
        if(isset($_REQUEST['enviarEmail'])){
            $correo = new PHPMailer();
            
            $varname = $_FILES['inputFile']['name'];
            $vartemp = $_FILES['inputFile']['tmp_name'];

            $archivo = $_FILES['inputFile'];

            $rec = mysql_query("SELECT correo, nombre FROM integrante");

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
                if($row['correo'] != ""){
                    $destino = $row['correo'];
                    $correo->AddAddress($destino, "");
                }
            }
            

            if(!$correo->Send()){
                echo '<script lenguage="javascript">
                alert ("No se pudo enviar el mensaje a los correos electrónicos");
                self.location = "menu.php";
                </script>';
            }
            
            mysql_free_result($rec);
            
        }        
        
		?>
		<script lenguage="javascript">
			msgConfirm();
			redireccionar();
		</script>
		<?php
	}
	else
	{
		?>
		<script lenguage="javascript">
			msgError();
			redireccionar();
		</script>
		<?php
	}
?>