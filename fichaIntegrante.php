<!DOCTYPE html>

<!-- Verifica que exista una sesion iniciada -->

<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo "<script>window.location = 'login.php';</script>";
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BAFUACh - Ficha de Integrante</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/botones.css">
        <link rel="stylesheet" href="css/estilos.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_ficha.css">
        
    </head>
    
    <body>
        
        <header>
            <div class="contenedor">
                <a href="usuarios.php"><h1 class="icon-bafuach"><font color=#fff>BAFUACh</font></h1></a>
                <!--<input type="checkbox" id="menu-bar">
                <label class="icon-menu" for="menu-bar">menu</label>
                <nav class="menu">
                    <a href="">INICIO</a>
                    <a href="">INICIO 2</a>
                </nav>-->
            </div>
        </header>
        
        <?php
            $rut=$_GET['rut']; 
        ?>
        <?php
            include("conexion.php");
            $link = Conectarse();
        
            $query = "SELECT rut,pasaporte,nombre,apellido_p,apellido_m,DATE_FORMAT(fecha_nac, '%d-%m-%Y') AS fecha_nac,direccion_origen,direccion_valdivia,telefono_celular,telefono_casa,familiar,telefono_familiar,remedio_cont,correo,facebook,actividad,elenco,fecha_ingreso,fecha_egreso,motivo_egreso,responsabilidad FROM integrante WHERE rut='$rut'";
            $result = mysql_query($query, $link) or die(mysql_error());
            if(mysql_num_rows($result) == 0) die ("No hay registros para mostrar");
            $row = mysql_fetch_array($result);
        ?>
        
        <section id="banner_ficha">
            <img src="imagenes/fondo_ficha.jpg" alt="fondo_ficha"/>
            <div class="contenedor_ficha">
                <h2><?php echo $rut ?></h2>
                <p><?php echo $row['nombre']." ".$row['apellido_p']." ".$row['apellido_m'] ?></p>
            </div>
        </section>
        
        <p>&nbsp;</p>
        <form name="form1" method="POST" action="modificarRegistro.php">

            <!-- Tipo de Usuario -->
            <div class="inicio">
                <table width="80%" border="0" callpadding="5px" cellspacing="5px">
                    <tr>
                      <td align='right'><label for="select">Tipo de Usuario </label></td>
                      <td><select id="selector" name="tipoUsuario" size="1" id="tipoUsuario">
                        <option><?php echo $row['responsabilidad'] ?></option>
                        <option>Administrador</option>
                        <option>Monitor</option>
                        <option>con Beneficio</option>
                        <option>Integrante</option>
                      </select></td>
                    </tr>
                </table>
            </div>

            <!-- Datos Personales -->
            <div class="datos_personales">
                <table id="datos_personales" width="90%" border="0" callpadding="0px" cellspacing="0px">
                    <tr>
                        <td><h3>1.- Datos Personales</h3></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Rut</label></td>
                        <td><input class="RO" name="rut" placeholder=" xxxxxxxx-x" readonly="readonly"  value="<?php echo $rut ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Pasaporte</label></td>
                        <td><input name="pasaporte" value="<?php echo $row['pasaporte'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Nombre</label></td>
                        <td><input name="nombre" value="<?php echo $row['nombre'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Apellido Paterno</label></td>
                        <td><input name="apellido_p" value="<?php echo $row['apellido_p'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Apellido Materno</label></td>
                        <td><input name="apellido_m" value="<?php echo $row['apellido_m'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Fecha Nacimiento</label></td>
                        <td><input name="fecha_nac" value="<?php echo $row['fecha_nac']?>" required></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Actividad</label></td>
                        <td><input name="actividad" value="<?php echo $row['actividad'] ?>"></td>
                    </tr>
                </table>
            </div>

            <!-- Datos Institucionales -->
            <div class="datos_institucionales">
                <table width="80%" border="0" callpadding="5px" cellspacing="5px">
                    <tr>
                        <td><h3>2.- Datos Institucionales</h3></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Elenco</label></td>
                        <td><input name="elenco" placeholder="Danza o Musica (sin tilde)" value="<?php echo $row['elenco'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Responsabilidad</label></td>
                        <td><input class="RO" name="responsabilidad" readonly="readonly" value="<?php echo $row['responsabilidad'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Año de Ingreso</label></td>
                        <td><input name="fecha_ingreso" value="<?php echo $row['fecha_ingreso'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Año de Egreso</label></td>
                        <td><input name="fecha_egreso" value="<?php echo $row['fecha_egreso'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Motivo de Egreso</label></td>
                        <td><input name="motivo_egreso" value="<?php echo $row['motivo_egreso'] ?>"></td>
                    </tr>
                </table>
            </div>

            <!-- Datos de Contacto -->
            <div class="datos_contacto">
                <table width="80%" border="0" callpadding="5px" cellspacing="5px">
                    <tr>
                        <td><h3>3.- Datos de Contacto</h3></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Direccion Origen</label></td>
                        <td><input name="direccion_origen" placeholder="" value="<?php echo $row['direccion_origen'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Direccion Valdivia</label></td>
                        <td><input name="direccion_valdivia" value="<?php echo $row['direccion_valdivia'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Teléfono Celular</label></td>
                        <td><input name="telefono_celular" value="<?php echo $row['telefono_celular'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Teléfono Casa</label></td>
                        <td><input name="telefono_casa" value="<?php echo $row['telefono_casa'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Correo electrónico</label></td>
                        <td><input name="correo" value="<?php echo $row['correo'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Facebook</label></td>
                        <td><input name="facebook" value="<?php echo $row['facebook'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Familiar</label></td>
                        <td><input name="familiar" value="<?php echo $row['familiar'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Telefono Familiar</label></td>
                        <td><input name="telefono_familiar" value="<?php echo $row['telefono_familiar'] ?>"></td>
                    </tr>
                    <tr>
                        <td align='right'><label>Remedios Contraindicados</label></td>
                        <td><input name="remedio_cont" value="<?php echo $row['remedio_cont'] ?>"></td>
                    </tr>
                </table>
            </div>

            <!-- BOTONES -->
            <center>
                <table width="50%" border="0" callpadding="1px" cellspacing="1px">
                    <td><input id="boton" type="submit" name="guardar_datos" value="Guardar Datos"></td>
                </table>
            </center>
        </form>
        <form action="usuarios.php">
            <center>
                <table width="50%" border="0" callpadding="1px" cellspacing="1px">
                    <tr>
                        <td><input id="boton" type="submit" name="cancelar" value="Cancelar"></td>
                    </tr>
                </table>
            </center>
        </form>

        <!-- Limpia la memoria de la consulta anterior **/ -->
        <?php mysql_free_result($result); ?>
    </body>

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

</html>