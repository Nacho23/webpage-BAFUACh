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
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/banner.css">
        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" type="text/css" href="css/login.css">
        
        <script lenguage="javascript">
            function recordar_pass(url){
                window.open(url, "Recordar Contraseña", "width=700, height=400, top=50, left=50");
            }
        </script>
        
    </head>
    
    <body>
        <header>
            <div class="contenedor">
                <h1 class="icon-bafuach">BAFUACh</h1>
                <input type="checkbox" id="menu-bar">
                <!--<label class="icon-menu" for="menu-bar">menu</label>
                <nav class="menu">
                    <a href="">INICIO</a>
                    <a href="">INICIO 2</a>
                </nav>-->
            </div>
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
                    <center>
                        <form action="validar.php" method="POST">
                            <h2>Bienvenido</h2>
                            <input type="text" placeholder="&#128272; Usuario" name="usuario" required></input>
                            <input type="password" placeholder="&#128272; Contraseña" name="clave" required></input>
                            <input type="submit" value="Ingresar"></input>
                        </form>
                        <br>
                        <a href="javascript:void(0)" onclick="recordar_pass('recordarPass.php');"><label>¿Olvidaste tu contraseña?</label></a>
                    </center>
                </div>
            </section>   
            
            <!--<section id="base">
                <h3>cuaquier titulo</h3>
                <div class="contenedor">
                    <div class="botones">
                        <img src="imagenes/icoAnuncios.png" alt="">
                        <h4>boton 1</h4>
                    </div>
                    <div class="botones">
                        <img src="imagenes/icoUsuario.png" alt="">
                        <h4>boton 2</h4>
                    </div>
                    <div class="botones">
                        <img src="imagenes/icoSalir.png" alt="">
                        <h4>boton 3 </h4>
                    </div>
                </div>
            </section>-->
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