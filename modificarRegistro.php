<head>
    <script lenguage="javascript">
        function msgConfirm(){
            alert("Registro Modificado Correctamente");
        }
        function redireccionar(){
            window.history.back();
            window.reload();
        }
    </script>
</head>
<?php
    
    include("conexion.php");
    $link = Conectarse();

    $rut = $_POST['rut'];
    $pasaporte = $_POST['pasaporte'];
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $fecha_nac = $_POST['fecha_nac'];
    $direccion_origen = $_POST['direccion_origen'];
    $direccion_valdivia = $_POST['direccion_valdivia'];
    $telefono_celular = $_POST['telefono_celular'];
    $telefono_casa = $_POST['telefono_casa'];
    $familiar = $_POST['familiar'];
    $telefono_familiar = $_POST['telefono_familiar'];
    $remedio_cont = $_POST['remedio_cont'];
    $correo = $_POST['correo'];
    $facebook = $_POST['facebook'];
    $actividad = $_POST['actividad'];
    $elenco = $_POST['elenco'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_egreso = $_POST['fecha_egreso'];  
    $motivo_egreso = $_POST['motivo_egreso'];  
    $responsabilidad = $_POST['tipoUsuario'];

    $fecha_nac_mod = substr($fecha_nac,-4)."-".substr($fecha_nac,3,-5)."-".substr($fecha_nac,0,-8);

    mysql_query("UPDATE u221031495_baf.integrante SET pasaporte='$pasaporte', nombre='$nombre', apellido_p='$apellido_p',apellido_m='$apellido_m',fecha_nac='$fecha_nac_mod',direccion_origen='$direccion_origen', direccion_valdivia='$direccion_valdivia',telefono_celular='$telefono_celular',telefono_casa='$telefono_casa',familiar='$familiar',telefono_familiar='$telefono_familiar',remedio_cont='$remedio_cont',correo='$correo',facebook='$facebook',actividad='$actividad',elenco='$elenco',fecha_ingreso='$fecha_ingreso',fecha_egreso='$fecha_egreso',motivo_egreso='$motivo_egreso',responsabilidad='$responsabilidad' WHERE integrante.rut = '$rut';");
    mysql_query("UPDATE u221031495_baf.cuenta SET responsabilidad='$responsabilidad' WHERE cuenta.rut='$rut';");


    ?>
    <script lenguage="javascript">
	   msgConfirm();
	   redireccionar();
    </script>
    <?php

?>
