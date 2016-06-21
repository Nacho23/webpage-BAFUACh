<?php
    include("conexion.php");
    $link = Conectarse();
    require_once('phpmailer/class.phpmailer.php');

    $rut = $_POST['rut'];
    $email = $_POST['email'];

    $query = "SELECT rut, correo FROM integrante WHERE rut = '$rut' AND correo = '$email'";
    $result = mysql_query($query, $link) or die(mysql_error());
    if(mysql_num_rows($result) != 0){

        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        $password = "";
        $longitudPass = 8;

        for($i=1 ; $i<=$longitudPass ; $i++){
            $pos=rand(0,$longitudCadena-1);
            $password .= substr($cadena,$pos,1);
        }

        $password_encryp = md5($password);
        
        print_r($rut."<br>");
        print_r($email."<br>");
        print_r($password_encryp."<br>");

        mysql_query("UPDATE cuenta SET clave = '$password_encryp' WHERE rut = $rut") or die(mysql_error());

        $correo = new PHPMailer();

        $subject = 'Recordar Contraseña';  
        $correo->Subject = $subject;

        $remite = 'administracion@bafuach.esy.es';
        $correo->SetFrom($remite, "Ballet Folclorico Universidad Austral de Chile");
        $correo->AddReplyTo($remite, "Ballet Folclorico Universidad Austral de Chile");

        $message = '<html><body>';
        $message .= '<b>Su nueva contraseña es: </b>';
        $message .= '<p><br><br>'.$password.'<br><br><br><br>No olvide actualizar su contraseña.<br></p>';
        $message .= '</body></html>';
        $correo->MsgHTML($message);

        $destino = $email;

        if($correo->Send()){
            echo '<script lenguage="javascript">
            alert ("Contraseña enviada Corresctamente");
            self.location = "recordar_pass.php";
            </script>';
        }else{
            echo '<script lenguage="javascript">
            alert ("No se pudo enviar la contraseña a su correo electrónico. Contactarse con Soporte.");
            self.location = "recordar_pass.php";
            </script>';
        }
    }else{
        echo '<script lenguage="javascript">
        alert ("Los datos no coinciden");
        self.location = "recordar_pass.php";
        </script>';
    }
mysql_free_result($result);
?>