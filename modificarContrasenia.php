<html>
    <head>
        <title> BAFUACh - Modificar Contraseña </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        
        <!-- Estilos BOOTSTRAP -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Estilos FONTELLO -->
        <link rel="stylesheet" href="css/fontello.css">
        
        <link rel="stylesheet" href="css/estilos.css">
        <!--<link rel="stylesheet" href="css/menu.css">-->
        <!--<link rel="stylesheet" href="css/botones.css">-->
        
        <!--<link rel="stylesheet" type="text/css" href="css/estilo_formulario.css">-->
        
        <script src="http://pajhome.org.uk/crypt/md5/2.2/md5-min.js"></script>
        <script lenguage="javascript">
            function Cancelar(){
                window.close();
            }
            function guardarPass(usuario){
                var pass = document.getElementById("nuevaPass").value;
                var passRepeat = document.getElementById("nuevaPassRepeat").value;
                if(pass == passRepeat){
                    passEncr = hex_md5(pass);
                    alert("Contraseña modificada correctamente");
                    window.open('modPass.php?as='+passEncr+'&rut='+usuario);
                    window.close();
                }else{
                    alert("Las contraseñas no coinciden");
                    document.getElementById("nuevaPassRepeat").value="";
                }
            }
        </script>
    </head>
    
    <body>
        <main>
            <?php
                session_start();
                $usuario = $_SESSION['usuario'];
                $responsabilidad = $_SESSION['responsabilidad'];

                /*$usuario = $_GET['usuario'];
                $tipoEncr = $_GET['tipo'];*/
                $admEncr = md5("Administrador");
                $monEncr = md5("Monitor");
                $benEncr = md5("con Beneficio");
                /*if(strcmp($tipoEncr, $admEncr) == 0){ ?>*/
                if($_SESSION['responsabilidad'] != "Integrante"){ ?>
                <h2 class="text-center"> Modificar Contraseña </h2>
                    
                <div class="container" style="margin-top: 30px">
                    <form class="form-inline">
                        <div class="form-group">
                            <label>Rut: </label>
                            <label><?php echo $_SESSION['usuario']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">Email: </label>
                            <label><?php echo $_SESSION['responsabilidad']; ?></label>
                        </div>
                    </form>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Nueva Contraseña: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="nuevaPass" name="nuevaPass" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Repita Nueva Contraseña: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="nuevaPassRepeat" name="nuevaPassRepeat" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input id="input_pass" type="submit" class="btn btn-success" name="btnModPass" value="Modificar Contraseña" onclick="guardarPass('<?php echo $usuario ?>');">
                                <input  id="input_pass" type="submit" class="btn btn-default" name="btnCancelar" value="Cancelar" onclick="Cancelar();">
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                }else{
                    echo '<script lengauge="javascript">
                    alert("No tiene permismo para esta función");
                    self.location = "menu.php";
                    </script>';
                }
            ?>
        </main>
    </body>
</html>