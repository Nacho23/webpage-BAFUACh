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
        <link rel="icon" href="imagenes/logo_android.ico">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <!-- Estilos BOOTSTRAP -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Estilos Bootstrap Calendar -->
        <link rel="stylesheet" href="css/jquery.datetimepicker.css">
        
        <!-- Estilo Banner -->
        <link rel="stylesheet" href="css/banner.css">
        
        <!-- Estilo Fontello (Fonts) -->
        <link rel="stylesheet" href="css/fontello.css">
        
        <link rel="stylesheet" href="css/estilos.css">
        
        <!-- Estilo Botones circulares -->
        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" href="css/popup.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_tablasConsultas.css">
          
        <!-- FUNCIONES JS -->
        <script lenguage="javascript">
            
            //Abrir ventana para modificar contraseña
            function modPass(url){
                window.open(url, "Modificar Contraseña", "width=600, height=400, top=50, left=50");
            }
            
            //Comprobar check del CheckButton para enviar correo electrónico
            function enviarMsg(){
                var checkboxValues = new Array();
                if(document.getElementById('enviarEmail').checked){
                    document.getElementById('msgAdv').innerHTML = 'Esta función puede tardar unos minutos...';
                }else{
                    document.getElementById('msgAdv').innerHTML = '';
                }  
            }
            
            //Abrir Popup de inforamción del proyecto
            function abrirPopup(id){
                var e = document.getElementById(id);
                if(e.style.display == 'block'){
                    e.style.display = 'none';
                }else{
                    e.style.display = 'block';
                }
            }
            
            //Enviar Notificaciones a los smartphones
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
        <script type="text/javascript">
            //Muestra Popup de "lugar" y "fecha" cuando se selecciona que es un evento
            $(document).ready(function(){
                $("#tipoMsje").change(function(){
                    var tipoMsje = $('#tipoMsje').val();
                    if(tipoMsje.localeCompare("Evento") == 0){
                        $('#myModal').modal('show'); 
                    }
                });
            });
        </script>
        <script>
            //Ingresa datos del formulario para sr enviados.
            function ingresado(){
                var fecha_evento = $("#datetimepicker").val();
                var lugar_evento = $("#inputLugar").val();
                var titulo = $("#txtTit").val();
                var mensaje = $("#txtArea").val();
                var tipoMsje = $("#tipoMsje").val();
                var listaComboBox = $("#listaComboBox").val();
                $.ajax({
                    url: 'ingresado.php',
                    data: {fecha_evento: fecha_evento,
                          lugar_evento: lugar_evento,
                          titulo:titulo,
                          mensaje:mensaje,
                          tipoMsje:tipoMsje,
                          listaComboBox:listaComboBox},
                    type: 'post',
                    success: function(data){
                        alert(data);
                    }
                });
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
            
            $query_grupos = "SELECT id, nombre FROM grupo WHERE visible = 'true'";
            $result_grupos = mysql_query($query_grupos, $link);
            while($row_grupos = mysql_fetch_array($result_grupos)){?>
                <script>
                    $(function(){
                        var valor = "<?php echo $row_grupos['nombre'] ?>";
                        $("#listaComboBox").append("<option class='list-group-item' value='"+valor+"'>"+valor+"</option>");
                    })
                </script><?php 
            }
            mysql_free_result($result_grupos);
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
        <section id="banner">
            <img src="imagenes/fondo1.jpg" alt="">
        </section>
            
        <!-- INFORMACIÓN MOMENTANEA EN LA PAGINA -->
        <div class="container">
            <center>
                <span class="label label-danger" style="font-size: 12px">Se habilitó la opción de crear "grupos" en la ventana de "INTEGRANTES", para poder enviar el anuncio</span>
                <span class="label label-danger" style="font-size: 12px">No agregar mas de 9 integrantes por grupo, ya que el hosting gratis no deja enviar más de 9 correo al mismo tiempo</span>
            </center>
        </div>
        
        <!-- MODAL -->
        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Feha y Lugar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-2 text-center">
                                <img src="imagenes/icoDateTime.png" alt="icoDateTime" class="img-responsive" style="width: 80px">
                            </div>
                            <div id="modal-content" class="col-md-9 text-center">
                                <input id="inputLugar" type="text" class="form-control" placeholder="Lugar" style="margin-bottom: 10px">
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input type="text" class="form-control" id="datetimepicker" placeholder="Fecha/Hora" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="guardarDateTime();" data-dismiss="modal">Aceptar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- FORMULARIO ENVIAR ANUNCIO -->
        <div class="container-fluid no-padding no-margin background-gray">
            <div class="container margin-top-button container-center">
                <form enctype="multipart/form-data">
                    <div class="row"> 
                        <div class="form-group"></div>
                            <div class="col-md-4 col-md-offset-2">
                                <label></label>
                                <input id="txtTit" type="text" name="titulo" required class="form-control" placeholder="Título Mensaje">
                            </div>
                        <div class="col-md-2">
                            <label></label>
                            <select id="tipoMsje" class="form-control" name="tipoMsje" size="1">
                                <option>Anuncio</option>
                                <option>Evento</option>
                            </select>
                        </div>
                        <div class="col-md-2 text-left">
                            <label>Enviar a: </label>
                            <select id="listaComboBox" class="form-control" name="listaComboBox">
                                <option class='list-group-item' value='Todos'>Todos</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <textarea id="txtArea" name="mensaje" required class="form-control" rows="10" placeholder="Escribe aquí tu mensaje" ></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-2 text-left">
                            <input id="enviarEmail" type="checkbox" name="enviarEmail[]" onclick="enviarMsg();" value=""><a id="msgCheckbox"> enviar correo electrónico</a>
                        </div>
                        <div class="col-md-3 text-left">
                            <label id="msgAdv"></label>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2 text-left">
                            <label for="exampleInputFile" style="color:rgb(255,255,255)">Adjuntar Archivo</label>
                            <input type="file" id="inputFile" name="inputFile">
                            <p class="help-block" style="color:rgb(170,170,170)">Adjuntar Archivo (Opcional)</p>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" onclick="ingresado();" class="btn btn-default btn-lg" id="btnEnviar" name="BotonEnviar">Enviar</button>
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
        <!-- Moment (necessary for Bootstrap calendar) -->
        <script src="js/jquery.datetimepicker.full.js"></script>
        <!-- Codigo JS extra -->
        
        <!-- Captura la fecha y hora y lo muestra en el input id=datetimepicker -->
        <script>
            var actual = $('#datetimepicker').datetimepicker()
            $('#datetimepicker').datetimepicker({value:actual, format:'d-m-Y H:i'});
        </script>
        
    </body>
</html>