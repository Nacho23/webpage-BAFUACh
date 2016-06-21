<html>
    <head>
        <title> BAFUACh - Modificar Contraseña </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_formulario.css">
        
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
                    <div class="cont_pass">
                        <center>
                            <h2>Modificar Contraseña</h2>
                            <table width="80%" border="0" cellpadding="5px" cellspacing="5px">
                                <tr>
                                    <td><label>Rut: </label></td>
                                    <td><label><?php echo $_SESSION['usuario']; ?></label></td>
                                </tr>
                                <tr>
                                    <td><label>Tipo: </label></td>
                                    <td><label><?php echo $_SESSION['responsabilidad']; ?></label></td>
                                </tr>
                                <tr>
                                    <td>Nueva Contraseña: </td>
                                    <td><input type="password" id="nuevaPass" name="nuevaPass" required></input></td>
                                </tr>
                                <tr>
                                    <td>Repita Nueva Contraseña: </td>
                                    <td><input type="password" id="nuevaPassRepeat" name="nuevaPassRepeat" required></input></td>
                                </tr>
                            </table>
                            <input id="input_pass" type="submit" name="btnModPass" 
                                   value="Modificar Contraseña" onclick="guardarPass('<?php echo $usuario ?>');"></input>
                            <input  id="input_pass" type="submit" name="btnCancelar" 
                                   value="Cancelar" onclick="Cancelar();"></input>
                        </center>
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