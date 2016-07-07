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

    include("conexion.php");
    $link = Conectarse();

    $query = "SELECT rut,nombre,apellido_p,DATE_FORMAT(fecha_nac, '%d/%m/%Y') AS fecha_nac,actividad,responsabilidad,correo FROM integrante WHERE rut != 'root'";
    $result = mysql_query($query, $link) or die(mysql_error());

?>

<html lang="es">
    <head>
        <title> BAFUACh - Integrantes </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <!-- Estilos BOOTSTRAP -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Estilos FONTELLO -->
        <link rel="stylesheet" href="css/fontello.css">
        
        <link rel="stylesheet" href="css/estilos.css">
        <!--<link rel="stylesheet" href="css/menu.css">-->
        <link rel="stylesheet" href="css/banner.css">
        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" href="css/popup.css">
        
        <!--<link rel="stylesheet" type="text/css" href="css/estilo_tablasConsultas.css">-->
        
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
                window.open(url, "Modificar Contraseña", "width=600, height=400, top=50, left=50");
            }
            function administrarGrupos(){
                window.location="administrarGrupos.php";
            }
            function abrirPopup(id){
                var e = document.getElementById(id);
                if(e.style.display == 'block'){
                    e.style.display = 'none';
                }else{
                    e.style.display = 'block';
                }
            }
		</script>
        <script type="text/javascript">
            (function(document) {
              'use strict';

              var LightTableFilter = (function(Arr) {

                var _input;

                function _onInputEvent(e) {
                  _input = e.target;
                  var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                  Arr.forEach.call(tables, function(table) {
                    Arr.forEach.call(table.tBodies, function(tbody) {
                      Arr.forEach.call(tbody.rows, _filter);
                    });
                  });
                }

                function _filter(row) {
                  var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
                  row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
                }

                return {
                  init: function() {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function(input) {
                      input.oninput = _onInputEvent;
                    });
                  }
                };
              })(Array.prototype);

              document.addEventListener('readystatechange', function() {
                if (document.readyState === 'complete') {
                  LightTableFilter.init();
                }
              });

            })(document);
        </script>
    </head>
    
    <body>
        <div id="popup-box" class="popup-position">
            <div id="popup-wrapper">
                <div id="popup-container">
                    <button id="close" onclick="document.getElementById('popup-box').style.display='none'">X</button><br>
                    <div class="popup-text">
                        <h3>Acerca del Proyecto</h3>
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td><p align="center"><b>info-BAFUACh</b> es una herramienta sencilla que permite el fácil envío de mensajes, anuncios e información haciendo uso de tecnología Android y Web, proveyendo de acceso más inmediato, de forma rápida y segura del mensaje que se quiera entregar.</p></td>
                            </tr>
                        </table>
                        <br>
                        <table class="table table-striped table-bordered table-hover">
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
                    </div>
                </div>
            </div>
        </div>
        
        <header>
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
                        <a class="navbar-brand" href="menu.php">BAFUACh</a>
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
        </header>

        <main>
            <!-- BANNER -->
            <section id="banner">
                <img src="imagenes/fondo1.jpg" alt="">
            </section>
            
            <!-- TABLA INTEGRANTES -->
            <div class="container">
                <h2>Integrantes</h2>
                <div class="input-group" style="margin-bottom: 30px">
                    <span class="input-group-addon" id="basic-addon1">Buscar</span>
                    <input type="search" class="light-table-filter form-control" data-table="order-table" placeholder="Buscar Integrante" aria-describedby="basic-addon1">
                </div>
                <div class="datagrid">
                    <table id="tablaDatos" class="table order-table table-striped table-bordered table-hover">
                        <?php
                            if(mysql_num_rows($result) == 0) die ("No hay registros para mostrar");
                                echo "<tr>
                                    <th></th><th> Rut </th><th>Nombre</th><th>Apellido Paterno</th>
                                    <th>Fecha Nacimiento</th><th>Actividad</th><th>Responsabilidad</th>
                                    <th>Email</th><th></th>
                                </tr>";
                            while($row = mysql_fetch_array($result)){?>
                                <tr>
                                     <td><input type="checkbox" name="rutReg[]" id="rutReg" value="<?php echo $row['rut'] ?>" style="cursor: pointer"></td>
                                     <td align='right'><?php echo $row['rut'] ?></td>
                                     <td><?php echo $row['nombre'] ?></td>
                                     <td><?php echo $row['apellido_p'] ?></td>
                                     <td><?php echo $row['fecha_nac'] ?></td>
                                     <td><?php echo $row['actividad'] ?></td>
                                     <td><?php echo $row['responsabilidad'] ?></td>
                                     <td><?php echo $row['correo'] ?></td>
                                    <td><input type="submit" name="verFicha[]" id="verFicha" value="ver Ficha" onclick="abrirFicha('<?php echo $row['rut'] ?>');" class="btn btn-default"></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </table>
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
                    <!--<div class="botones">
                        <a href="" onclick="administrarGrupos();"><img src="imagenes/icoEliminaUsuario.png" alt=""></a>
                        <h4>Administrar Grupos</h4>
                    </div>-->
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
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>       
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Codigo JS extra -->
        
    </body>
</html>