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
        <title> BAFUACh - Mensajes Enviados </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/banner.css">
        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" href="css/popup.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_tablasConsultas.css">
        
        <script language="javascript">
            function modPass(url){
                    window.open(url, "Modificar Contraseña", "width=600, height=500, top=50, left=50");
                }
            function abrirPopup(id){
                var e = document.getElementById(id);
                if(e.style.display == 'block'){
                    e.style.display = 'none';
                }else{
                    e.style.display = 'block';
                }
            }
            function reenviar(){
				var checkboxValues = new Array();
				$('input[name="anuncioReg[]"]:checked').each(function(){
						checkboxValues.push($(this).val());
					})        
				if(checkboxValues.length == 1){
					reenviar = confirm("¿Seguro desea reenviar el anuncio?");
					if(reenviar){
						var jObject={};
						for(var i=0;i<checkboxValues.length;i++){
							jObject[i] = checkboxValues[i];
						}       
						jObject = JSON.stringify(jObject);
						$.ajax({
							type: 'post',
							cache: false,
							url: 'reenviarAnuncio.php',
							data: {jObject: jObject},
						});
					}else{
						alert('No se pudo enviar el anuncio');
					}
				}else if(checkboxValues.length > 1){
					alert('Seleccione solo un anuncio.');
				}else{
                    alert('No se ha seleccionado ningun registro.');
                }
			}
        </script>
        
    </head>
    
    <body>
        
        <div id="popup-box" class="popup-position">
            <div id="popup-wrapper">
                <div id="popup-container">
                    <button id="close" onclick="document.getElementById('popup-box').style.display='none'">X</button><br>
                    <section id="popup-text">
                        <h3>Acerca del Proyecto</h3>
                        <table cellpadding=10>
                            <tr>
                                <td><p align="center"><b>info-BAFUACh</b> es una herramienta sencilla que permite el fácil envío de mensajes, anuncios e información haciendo uso de tecnología Android y Web, proveyendo de acceso más inmediato, de forma rápida y segura del mensaje que se quiera entregar.</p></td>
                            </tr>
                        </table >
                        <br>
                        <table cellpadding=10>
                            <tr>
                                <td><b>OBJETIVO PRINCIPAL:</b></td>
                                <td>- Optimizar la entrega de información a los integrantes proporcionando una herramienta focalizada en el trabajo que debe realizar.</td>
                            </tr>
                            <tr>
                                <td><b>OBJETIVOS SECUNDARIOS:</b></td>
                                <td>- Depender en menor proporción de herramientas complejas y de uso universal como Facebook.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>- Ser puntapié inicial para futuras funcionalidades del Sistema.</td>
                            </tr>
                            <tr>
                                <td><b>FUNCIONALIDAD PRINCIPAL:</b></td>
                                <td>- Envío de anuncios y/o mensajes desde una página web y que ésta sea recibida por todos los integrantes en sus teléfonos móviles.</td>
                            </tr>
                            <tr>
                                <td><b>PRÓXIMO DESAFÍO:</b></td>
                                <td>- Incorporar un calendario de actividades en donde aparte de ingresar los eventos contraídos por el grupo, exista un medio para registrar aquellos integrantes que participen de ellas.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>- Hacer uso de los datos obtenidos en la función anterior para un control estadístico de lo que se considere pertinente.</td>
                            </tr>
                            <tr>
                                <td><b>RESTRICCIONES:</b></td>
                                <td>- En primera instancia, la aplicación móvil estará disponible solo para sistemas operativos Android 4.0 en adelante.</td>
                            </tr>
                        </table>
                        <br>
                        <table cellpadding=10>
                            <tr>
                                <td align="center"><font color="#333">Sistema privado de uso exclusivo del Ballet Folclórico de la Universidad Austral de Chile.</font></td>
                            </tr>
                        </table>
                    </section>
                </div>
            </div>
        </div>
        
        <header>
            <div class="contenedor">
                <a href="menu.php"><h1 class="icon-bafuach"><font color="ffffff">BAFUACh</font></h1></a>
                <input type="checkbox" id="menu-bar">
                <label class="icon-menu" for="menu-bar"></label>
                <nav class="menu">
                    <a href="" onclick="modPass('modificarContrasenia.php');">Cambiar Contraseña</a>
                    <a href="javascript:void(0)" onclick="abrirPopup('popup-box');">Acerca del proyecto</a>
                    <!--<a href="calendario.php">Calendario</a>-->
                </nav>
            </div>
            <script lenguage="javascript">
                document.getElementById('popup-box').style.display='none';
            </script>
        </header>
        
        <main>
            <section id="banner">
                <img src="imagenes/fondo1.jpg" alt="">
                <div class="contenedor">
                    <!--<img src="imagenes/logo2.png" alt="">
                </div>-->
            </section>
            
            <section id="login">
                <div class="contenedor">
                    <h2>Mensajes Enviados</h2>
                    <center>
                        <table id="tablaDatos">
				<?php
					include("conexion.php");
					$link = Conectarse();
					$query = "SELECT id,titulo,mensaje,DATE_FORMAT(fecha, '%d/%m/%Y') AS date,DATE_FORMAT(fecha, '%H:%i:%s') AS hours FROM anuncio";
					$result = mysql_query($query, $link) or die(mysql_error());
					if(mysql_num_rows($result) == 0) die ("No hay registros para mostrar");
					echo "<table cellpadding=10 cellspacing=1>";
					echo "<tr>
					        <th></th><th> ID </th><th>Título</th><th>Mensaje</th>
					        <th>Fecha</th><th>Hora</th>
					      </tr>";

					while($row = mysql_fetch_array($result)){
						echo "<tr id='X'>
								 <td><input type='checkbox' name='anuncioReg[]' value='Titulo: $row[titulo] , Mensaje: $row[mensaje]'></td>
						         <td align='center'> $row[id] </td>
						         <td> $row[titulo] </td>
						         <td> $row[mensaje] </td>
						         <td> $row[date] </td>
                                 <td> $row[hours] </td>
						      </tr>";
					}
                mysql_free_result($result);
				?>
			</table>
                    </center>
                </div>
            </section>   
            
            <section id="base">
                <h3></h3>
                <div class="contenedor">
                    <div class="botones">
                        <a href="" onclick="reenviar();"><img src="imagenes/icoReenviar.png" alt=""></a>
                        <h4>Reenviar</h4>
                    </div>
                    <div class="botones">
                        <a href="menu.php"><img src="imagenes/icoVolver.png" alt=""></a>
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