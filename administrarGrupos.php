<!DOCTYPE html>

<!-- Verifica que exista una sesion iniciada -->

<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo "<script>window.location = 'login.php';</script>";
    }
?>

<html lang="es">
    <head>
        <title> BAFUACh - Administrar Grupos </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <!-- Estilos BOOTSTRAP -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Estilo Banner -->
        <link rel="stylesheet" href="css/banner.css">
        
        <link rel="stylesheet" href="css/fontello.css">

        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" href="css/popup.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_tablasConsultas.css">
        
        <script lenguage = "javascript">
			function abrir(url, tipo){
                console.log(tipo);
                if(tipo != "Administrador"){
                    alert("No tiene permisos para realizar la funcion");
                }else{
                    window.open(url, "Formulario Usuario", "width=1250, height=650, top=10, left=50, scrollbars=yes");   
                }
			}
			function eliminarUsuario(){
				var checkboxValues = new Array();
				$('input[name="rutReg[]"]:checked').each(function(){
						checkboxValues.push($(this).val());
					})                  
				if(checkboxValues.length != 0){
					eliminar = confirm("¿Seguro desea eliminar el registro?");
					if(eliminar){
						var jObject={};
						for(var i=0;i<checkboxValues.length;i++){
							jObject[i] = checkboxValues[i];
						}       
						jObject = JSON.stringify(jObject);
						$.ajax({
							type: 'POST',
							cache: false,
							url: 'eliminarRegistro.php',
							data: {jObject: jObject},
						});

					}else{
						alert('No se pudo eliminar el registro');
					}
				}else{
					alert('No se ha seleccionado ningun registro.');
				}
			}
            function abrirFicha(rut){
                url ="fichaIntegrante.php?rut="+rut;
                window.location.href=url;
            }
            function volver(){
                window.location.href="menu.php";
            }
            function modPass(url){
                window.open(url, "Modificar Contraseña", "width=600, height=500, top=50, left=50");
            }
            function administrarGrupos(){
                window.location.href="administrarGrupos.php";
            }
		</script>
        <script>
            function agregar(){
                //var integrante = document.getElementById("elementoListaIntegrante").value;
                //console.log(integrante);
                $("listaGrupo").append("<button id='elementoListaGrupo' type='button' class='list-group-item'>"integrante"</button>");  
            }
        </script>
    </head>
    
    <?php
        include("conexion.php");
        $link = Conectarse();

        $query = "SELECT rut, nombre, apellido_p FROM integrante WHERE rut != 'root'";

        $result = mysql_query($query, $link);

        while($row = mysql_fetch_array($result)){?>
        <script>
        $(function(){
            $("#listaIntegrantes").append("<button id='elementoListaIntegrante' type='button' class='list-group-item' value='<?php echo $row['nombre'].' '.$row['apellido_p']?>'><?php echo $row['nombre'].' '.$row['apellido_p']?></button>");
        });
        </script>
        <?php }
    ?>
    
    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="menu.php">BAFUACh</a>
                </div>
            </div>
        </nav>
       
        
        <main>
        
            <div class="jumbotron jumbotron-img jum-home">  
                <div class="container text-left"></div>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="list-group">
                            <a href="#" class="list-group-item disabled">
                                Integrantes
                            </a>
                            <div id="listaIntegrantes">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button onclick="agregar();" type="button" class="btn btn-primary btn-block">Agregar &#8594;</button>
                        <button type="button" class="btn btn-default btn-block">&#8592; Eliminar</button>
                    </div>
                    <div class="col-md-5">
                        <div class="list-group">
                            <a href="#" class="list-group-item disabled">
                                "Nombre Grupo"
                            </a>
                            <div id="listaGrupo">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
                
            <section id="base">
                <h3></h3>
                <div class="contenedor">
                    <div class="botones">
                        <a href="" onclick="abrir('formularioUsuario.php','<?php echo $_SESSION['responsabilidad'] ?>');"><img src="imagenes/icoUsuario.png" alt=""></a>
                        <h4>Agregar Integrante</h4>
                    </div>
                    <div class="botones">
                        <a href="" onclick="eliminarUsuario();"><img src="imagenes/icoEliminaUsuario.png" alt=""></a>
                        <h4>Eliminar Integrante</h4>
                    </div>
                    <div class="botones">
                        <a href="usuarios.php"><img src="imagenes/icoVolver.png" alt=""></a>
                        <h4>Atrás</h4>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <br>
            <div class="contenedor">
                <p class="copy">BAFUACh &copy; 2016</p>
                <div class="sociales">
                    <a class="icon-facebook-squared" href="https://www.facebook.com/BAFUACh/"></a>
                    <a class="icon-twitter" href="https://twitter.com/Bafuach"></a>
                    <a class="icon-website" href="http://bafuach.jimdo.com/"></a>
                </div>
            </div>
        </footer>
    </body>
    
    
    
</html>