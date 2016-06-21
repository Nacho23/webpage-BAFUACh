<head>
    <script lenguage="javascript">
		function msgError(){
			alert("Los Datos no Coinciden o no tiene permiso para ingresar")
		}
		function redireccionar(){
			window.location="login.php";
		}
		function msgConfirm(){
			alert("Guardado Correctamente")
		}
	</script>
</head>
<?php
    include("conexion.php");
	$link = Conectarse();

    if(!isset($_SESSION)){
        session_start();
    }

    $usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
    $claveEncr = md5($clave);

	$query = "SELECT * FROM cuenta WHERE rut='".$usuario."' and clave='".$claveEncr."' and responsabilidad!='Integrante';";
	$res = mysql_query($query);
    $row = mysql_fetch_object($res);
	$filas = mysql_num_rows($res);
	if($filas == 0){
        ?>
		<script lenguage="javascript">
			msgError();
			redireccionar();
		</script>
		<?php
	}else{
        
        /** Encripta el rut del usuario y el tipo
        para pasar como parametro a la siguiente pagina **/
        $_SESSION['usuario'] = $row->rut;
        $_SESSION['responsabilidad'] = $row->responsabilidad;
        $responsabilidad = ($row->responsabilidad);
        header("location:menu.php");
		/**header("location:menu.php?usuario=$usuario&tipo=$tipo");**/
	}
	mysql_free_result($res);
?>