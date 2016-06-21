<html>
    <head>
        <title> BAFUACh - Recordar Contraseña </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_formulario.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <script lenguage="javascript">
            function Cancelar(){
                window.close();
            }
            /*function recordarPass(){
                var arregloDatos = new Array();
                
                var rut = document.getElementById("rut").value;
                var email = document.getElementById("email").value;
                if(rut != "" && email != ""){
                    
                    arregloDatos.push(rut);
                    arregloDatos.push(email);
                    
                    var jObject = {};
                    for(var i = 0; i < arregloDatos.length; i++){
                        jObject[i] = arregloDatos[i];
                    }
                    jObject = JSON.stringify(jObject);
                    $.ajax({
                        type: 'POST',
                        cache: false,
                        url: 'enviarRecordarPass.php',
                        data: {jObject: jObject},
                    });
                    
                    alert("Contraseña enviada a su correo electrónico.");
                    
                }else{
                    alert("Uno o ambos campos esta vacío.");
                }
            }*/
        </script>
    </head>
    
    <body>
        <main>
            <?php
                if(true){ ?>
                    <div class="cont_pass">
                        <center>
                            <h2>Recordar Contraseña</h2>
                            <form action="enviarRecordarPass.php" method="post">
                                <table width="80%" border="0" cellpadding="5px" cellspacing="5px">
                                    <tr>
                                        <td>Rut: </td>
                                        <td><input type="text" id="rut" name="rut" required></input></td>
                                    </tr>
                                    <tr>
                                        <td>Correo electrónico: </td>
                                        <td><input type="text" id="email" name="email" required></input></td>
                                    </tr>
                                </table>
                                <input id="input_pass" type="submit" name="btnModPass" value="Recordar Contraseña"></input>
                            </form>
                            <input  id="input_pass" type="submit" name="btnCancelar" value="Cancelar" onclick="Cancelar();"></input>
                        </center>
                    </div>
                <?php
                }
            ?>
        </main>
    </body>
</html>