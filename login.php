<!DOCTYPE html>

<!-- Verifica que exista una sesion iniciada -->
<?php
    session_start();
    if(isset($_SESSION['usuario'])){
         echo "<script>window.location = 'menu.php';</script>";
    }
?>

<html lang="es">
    <head>
        <title> BAFUACh </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="icon" href="imagenes/logo_android.ico">
        
        <!-- Estilos Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Estilo Fontello (fonts) -->
        <link rel="stylesheet" href="css/fontello.css">
        
        <link rel="stylesheet" href="css/estilos.css">
        
        <!-- Estilo Banner -->
        <link rel="stylesheet" href="css/banner.css">
        
        <!-- Estilo formulario login -->
        <link rel="stylesheet" type="text/css" href="css/login.css">
        
        <!-- Funciones JS -->
        <script lenguage="javascript">
            function recordar_pass(url){
                window.open(url, "Recordar Contraseña", "width=700, height=400, top=50, left=50");
            }
        </script>
        
    </head>
    
    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">BAFUACh</a>
                </div>
            </div>
        </nav>
        
        <main>
            <!-- BANNER -->
            <section id="banner">
                <img src="imagenes/fondo1.jpg" alt="">
            </section>
            
            <!-- FORMULARIO LOGIN -->
            <section id="login">
                <div class="container">
                    <center>
                        <form action="validar.php" method="POST" style="margin-bottom: 15px">
                            <h2>Bienvenido</h2>
                            <input type="text" class="form-control" name="usuario" placeholder="&#128272; Usuario"  required>
                            <input type="password" class="form-control" name="clave" placeholder="&#128272; Contraseña" required>
                            <input type="submit" value="Ingresar">
                        </form>
                        <a href="javascript:void(0)" onclick="recordar_pass('recordarPass.php');"><label>¿Olvidaste tu contraseña?</label></a>
                    </center>
                </div>
            </section>   
        </main>

        <!-- FOOTER -->
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