<!DOCTYPE html>

<!-- Verifica que exista una sesion iniciada -->
<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
         echo "<script>window.location = 'login.php';</script>";
    }else{
        $usuario = $_SESSION['usuario'];
        $responsabilidad = $_SESSION['responsabilidad'];   
    }
?>

<html lang="es">
    <head>
        <title> BAFUACh - Pantalla Principal </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        
        <!-- Estilos BOOTSTRAP -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Estilo Banner -->
        <link rel="stylesheet" href="css/banner.css">
        
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
        <!--<link rel="stylesheet" href="css/menu.css">-->
        
        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" href="css/popup.css">
        
        <!--<link rel="stylesheet" type="text/css" href="css/estilo_menu.css">-->
        <link rel="stylesheet" type="text/css" href="css/estilo_tablasConsultas.css">
          
        <script lenguage="javascript">
            function modPass(url){
                window.open(url, "Modificar Contraseña", "width=700, height=500, top=50, left=50");
            }
            function enviarMsg(){
                var checkboxValues = new Array();
                if(document.getElementById('enviarEmail').checked){
                    document.getElementById('msgAdv').innerHTML = 'Esta función puede tardar unos minutos...';
                }else{
                    document.getElementById('msgAdv').innerHTML = '';
                }  
            }
            function abrirPopup(id){
                var e = document.getElementById(id);
                if(e.style.display == 'block'){
                    e.style.display = 'none';
                }else{
                    e.style.display = 'block';
                }
            }
            function sendPushNotification(id){
                var data = $('form#'+id).serialize();
                $('form#'+id).unbind('submit');                
                $.ajax({
                    url: "./android/send_message.php",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {

                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("");
                    },
                    error: function(xhr, textStatus, errorThrown) {

                    }
                });
                return false;
            }
        </script>
    </head>
    
    <body>
        <?php
            include("conexion.php");
            $link = Conectarse();
            $query = "SELECT rut, nombre, apellido_p FROM integrante WHERE rut='$usuario'";
            $result = mysql_query($query, $link) or die(mysql_error());
            $row = mysql_fetch_array($result);
        
            $nombre = $row['nombre'];
            $apellido_p = $row['apellido_p'];
            
            mysql_free_result($result);
        
        ?>
        
        <!-- Popup Decripcion Proyecto -->
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
        
        <!-- NAVBAR -->
        <nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-webEmpresa-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">Bienvenido <?php echo $nombre." ".$apellido_p ?></a>
                </div>

                <div class="collapse navbar-collapse navbar-right" id="bs-webEmpresa-navbar-collapse-1">
                    <ui class="nav navbar-nav">
                        <li><a href="javascript:void(0)" onclick="modPass('modificarContrasenia.php');">Cambiar Contraseña</a></li>
                        <li><a href="javascript:void(0)" onclick="abrirPopup('popup-box');">Acerca del Proyecto</a></li>
                    </ui>
                </div>
            </div>
            <script lenguage="javascript">
                document.getElementById('popup-box').style.display='none';
            </script>
        </nav>
        

        <!-- BANNER -->
        <div class="jumbotron jumbotron-img jum-home">  
            <div class="container text-left"></div>
        </div>
            
        <div class="container">
            <center>
                <span class="label label-danger" style="font-size: 12px">Por el momento NO activar el checkbutton "enviar correos electrónicos", se está trabajando en el envío de correos masivos. Muchas Gracias</span>
            </center>
        </div>
        
        <!-- FORMULARIO ENVIAR ANUNCIO -->
        <div class="container-fluid no-padding no-margin background-gray">
            <div class="container margin-top-button container-center">
                <form action="ingresado.php" method="POST" enctype="multipart/form-data">
                    <div class="row"> 
                        <div class="col-md-3 form-group"></div>
                        <div class="col-md-5 text-rigth">
                            <input id="txtTit" type="text" name="titulo" required class="form-control" placeholder="Título Mensaje">
                        </div>
                        <div class="col-md-1 text-left">
                            <select name="tipoMsje" size="1" id="tipoMsje">
                                <option>Anuncio</option>
                                <option>Evento</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <textarea id="txtArea" name="mensaje" required class="form-control" rows="10" placeholder="Escribe aquí tu mensaje" style="margin-top: 25px"></textarea>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3 text-left">
                            <input id="enviarEmail" type="checkbox" name="enviarEmail[]" onclick="enviarMsg();" value=""><a id="msgCheckbox"> enviar correo electrónico</a>
                        </div>
                        <div class="col-md-3 text-left">
                            <label id="msgAdv"></label>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-4 text-left">
                            <label for="exampleInputFile" style="color:rgb(255,255,255)">Adjuntar Archivo</label>
                            <input type="file" id="inputFile" name="inputFile">
                            <p class="help-block" style="color:rgb(170,170,170)">Adjuntar Archivo (Opcional)</p>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-default btn-lg" id="btnEnviar" name="BotonEnviar">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            
        <!-- BOTONES CIRCULARES -->
        <section id="base">
            <h3></h3>
            <div class="contenedor">
                <div class="botones">
                    <a href="anuncios.php"><img src="imagenes/icoAnuncios.png" alt=""></a>
                    <h4>Mensajes enviados</h4>
                </div>
                <div class="botones">
                    <a href="usuarios.php"><img src="imagenes/icoUsuario.png" alt=""></a>
                    <h4>Integrantes registrados</h4>
                </div>
                <div class="botones">
                    <a href="logout.php"><img src="imagenes/icoSalir.png" alt=""></a>
                    <h4>Cerrar Sesión </h4>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer>
            <div class="contenedor">
                <p class="copy">BAFUACh &copy; 2016</p>
                <div class="sociales">
                    <a class="icon-facebook-squared" href="https://www.facebook.com/BAFUACh/"></a>
                    <a class="icon-twitter" href="https://twitter.com/Bafuach"></a>
                    <a class="icon-website" href="http://bafuach.jimdo.com/"></a>
                </div>
            </div>
        </footer>
    
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>       
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Codigo JS extra -->
    </body>
</html>