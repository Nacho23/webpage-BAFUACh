<head>
	<script lenguage="javascript">
		function msgError(){
			alert("Debe llenar todos los campos !!")
		}
		function msgError2(){
			alert("El Usuario ya Existe")
		}
		function redireccionar(){
			window.history.back();
		}
		function msgConfirm(){
			alert("Guardado Correctamente")
		}
	</script>
</head>
<?php
	include("conexion.php");
	$link = Conectarse();

	if(isset($_POST['rut']) && !empty($_POST['rut']) &&
        isset($_POST['pasaporte']) && !empty($_POST['pasaporte']) &&
		isset($_POST['nombre']) && !empty($_POST['nombre']) &&
		isset($_POST['apellido_p']) && !empty($_POST['apellido_p']) &&
		isset($_POST['apellido_m']) && !empty($_POST['apellido_m']) &&
		isset($_POST['fecha_nac_dia']) && !empty($_POST['fecha_nac_dia']) &&
        isset($_POST['fecha_nac_mes']) && !empty($_POST['fecha_nac_mes']) &&
        isset($_POST['fecha_nac_anio']) && !empty($_POST['fecha_nac_anio']) &&
		isset($_POST['direccion_origen']) && !empty($_POST['direccion_origen']) &&
		isset($_POST['direccion_valdivia']) && !empty($_POST['direccion_valdivia']) &&
        isset($_POST['telefono_celular']) && !empty($_POST['telefono_celular']) &&
        isset($_POST['familiar']) && !empty($_POST['familiar']) &&
        isset($_POST['correo']) && !empty($_POST['correo']) &&
        isset($_POST['facebook']) && !empty($_POST['facebook']) &&
        isset($_POST['actividad']) && !empty($_POST['actividad']) &&
        isset($_POST['elenco']) && !empty($_POST['elenco']) &&
		isset($_POST['fecha_ingreso']) && !empty($_POST['fecha_ingreso']) &&
        isset($_POST['responsabilidad']) && !empty($_POST['responsabilidad'])){

            $rec = mysql_query("SELECT * FROM integrante");
            $verifica_usuario = 0;

            while($result = mysql_fetch_object($rec)){
                if($result->rut == $_POST['rut']){
                    $verifica_usuario = 1;
                }
            }

            if($verifica_usuario == 0){
                $rut = $_POST['rut'];
                $pasaporte = $_POST['pasaporte'];
                $nombre = $_POST['nombre'];
                $apellido_p = $_POST['apellido_p'];
                $apellido_m = $_POST['apellido_m'];
                $fecha_nac_dia = $_POST['fecha_nac_dia'];
                $fecha_nac_mes = $_POST['fecha_nac_mes'];
                $fecha_nac_anio = $_POST['fecha_nac_anio'];
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
                $responsabilidad = $_POST['responsabilidad'];

                $fecha_nac = $fecha_nac_anio."-".$fecha_nac_mes."-".$fecha_nac_dia;

                $clave = substr($rut,0,strlen($rut)-2);
                $claveEncr = md5($clave);
            

                mysql_query("INSERT INTO integrante values ('$rut','$pasaporte','$nombre','$apellido_p','$apellido_m','$fecha_nac','$direccion_origen','$direccion_valdivia','$telefono_celular','$telefono_casa','$familiar','$telefono_familiar','$remedio_cont','$correo','$facebook','$actividad','$elenco','$fecha_ingreso','$fecha_egreso','$motivo_egreso','$responsabilidad')");
                mysql_query("INSERT INTO cuenta values('$rut', '$claveEncr', '$responsabilidad')");
                ?>
                <script lenguage="javascript">
                    msgConfirm();
                    window.close();
                </script>
                <?php
            }else{
                ?>
                <script lenguage="javascript">
                    msgError2();
                    redireccionar();
                </script>
                <?php
            }
        }else{
		?>
		<script lenguage="javascript">
			msgError();
			redireccionar();
		</script>
		<?php
	}
?>