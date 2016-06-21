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
        <title> BAFUACh - Pantalla Principal </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/banner.css">
        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_formulario.css">
        
        <script type="text/javascript" src="validaciones.js"></script>
        <script type="text/javascript">
            function onRutBlur(obj){
                if(!verificaRut(obj.value)){
                    alert("Rut Incorrecto");
                    obj.value = "";
                }
            }
            function soloNumeros(obj){
                if(obj.value.match(/[a-zA-Z]/)){
                    alert("Ingrese solo numeros");
                    obj.value = "";
                }
            }
            function soloLetras(obj){
                if(obj.value.match(/[0-9]/)){
                    alert("Ingrese solo letras");
                    obj.value = "";
                }
            }
            function soloTipo(obj){
                if(!obj.value.match("Administrador") && !obj.value.match("Monitor") && !obj.value.match("con Beneficio") && !obj.value.match("Integrante")){
                    alert("Ingrese solo 'Administrador','Monitor','con Beneficio','Integrante'");
                    obj.value = "";
                }
            }
            function soloCargo(obj){
                if(!obj.value.match("Musico") && !obj.value.match("Danza")){
                    alert("Ingrese solo 'Musico','Danza'");
                    obj.value = "";
                }
            }
            function cerrar(){
                window.close();
            }
        </script>
        
    </head>
    
    <body>
        
        <header>
            <div class="contenedor">
                <h1 class="icon-bafuach">BAFUACh</h1>
                <input type="checkbox" id="menu-bar">
                <label class="icon-menu" for="menu-bar"></label>
                <nav class="menu">
                    <a href="" onclick="modPass('modificarContrasenia.php');">Cambiar Contraseña</a>
                    <a href="">Acerca del proyecto</a>
                </nav>
            </div>
        </header>
        
        <main>
            <section id="banner">
                <img src="imagenes/fondo1.jpg" alt="">
                <div class="contenedor">
                    <!--<img src="imagenes/logo2.png" alt="">-->
                </div>
            </section>
            
            <section id="login">
                <div class="contenedor">
                    <center>
                        <form action="formularioIngresado.php" method="POST">
                            <h2>Formulario Datos Integrante</h2>
                            <table width="80%" border="0" cellpadding="5px" cellspacing="5px">
                              <tr>
                                <td>Rut: </td>
                                <td><input name="rut" size="45" placeholder=" xxxxxxxx-x" onblur="onRutBlur(this);" required ></input></td>
                              </tr>
                              <tr>
                                <td>Pasaporte: </td>
                                <td><input name="pasaporte" size="45" required ></input></td>
                              </tr>
                              <tr>
                                <td id="p">Nombre: </td>
                                <td><input name="nombre" size="45" onblur="soloLetras(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Apellido Paterno: </td>
                                <td><input name="apellido_p" size="45" onblur="soloLetras(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Apellido Materno: </td>
                                <td><input name="apellido_m" size="45" onblur="soloLetras(this);" required></input></td>
                              </tr>
                              <tr>
                                <td id="p">Fecha Nacimiento: </td>
                                <td><input name="fecha_nac_dia" size="5" placeholder=" DD" onblur="soloNumeros(this);" required></input> - <input name="fecha_nac_mes" size="5" placeholder=" MM" onblur="soloNumeros(this);" required></input> - <input name="fecha_nac_anio" size="10" placeholder=" AAAA" onblur="soloNumeros(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Direccion Origen : </td>
                                <td><input name="direccion_origen" size="45" required></input></td>
                              </tr>
                              <tr>
                                <td>Dirección Valdivia : </td>
                                <td><input name="direccion_valdivia" size="45" required></input></td>
                              </tr>
                              <tr>
                                <td>Teléfono Celular : </td>
                                <td><input name="telefono_celular" size="45" placeholder=" 9XXXXYYYY" onblur="soloNumeros(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Teléfono Casa : </td>
                                <td><input name="telefono_casa" size="45" onblur="soloNumeros(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Nombre Familiar : </td>
                                <td><input name="familiar" size="45" required></input></td>
                              </tr>
                              <tr>
                                <td>Teléfono Familiar : </td>
                                <td><input name="telefono_familiar" size="45" onblur="soloNumeros(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Remedios Contraindicados : </td>
                                <td><input name="remedio_cont" size="45" required></input></td>
                              </tr>
                              <tr>
                                <td>Email : </td>
                                <td><input name="correo" size="45" placeholder=" correo@gmail.com" required></input></td>
                              </tr>
                              <tr>
                                <td>Facebook : </td>
                                <td><input name="facebook" size="45" value="www.facebook.com/" required></input></td>
                              </tr>
                              <tr>
                                <td>Actividad: </td>
                                <td><input name="actividad" size="45" onblur="soloLetras(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Elenco : </td>
                                <td><input name="elenco" size="45" placeholder=" Musico, Danza" onblur="soloCargo(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Año de Ingreso: </td>
                                <td><input name="fecha_ingreso" size="10" placeholder=" AAAA" onblur="soloNumeros(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Año de Egreso: </td>
                                <td><input name="fecha_egreso" size="10" placeholder=" AAAA" onblur="soloNumeros(this);" required></input></td>
                              </tr>
                              <tr>
                                <td>Motivo Egreso: </td>
                                <td><input name="motivo_egreso" size="45" required></input></td>
                              </tr>
                              <tr>
                                <td>Responsabilidad : </td>
                                <td><input name="responsabilidad" size="45" placeholder=" Administrador, Monitor, con Beneficio, Integrante" onblur="soloTipo(this);" required></input></td>
                              </tr> 
                              <tr>
                              <td></td>
                                <td><input id="btnRegistrar" type = "submit" name="BotonRegistrar" value="Registrar"></input></td>
                              </tr>
                            </table>
                        </form>
                    </center>
                </div>
            </section>   
            
            <section id="base">
                <h3></h3>
                <div class="contenedor">
                    <div class="botones">
                        <a href="" onclick="cerrar();"><img src="imagenes/icoCancelar.png" alt=""></a>
                        <h4>Cancelar</h4>
                    </div>
                </div>
            </section>
        </main>

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
    </body>
</html>