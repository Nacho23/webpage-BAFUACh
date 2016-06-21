<html>
    <head>
        <title> BAFUACh - Recordar Contraseña </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/estilos.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_formulario.css">
        
        <script lenguage="javascript">
            function Cancelar(){
                window.close();
            }
        </script>
    </head>
    
    <body>
        <main>
            <div class="cont_pass">
                <center>
                    <form action="recordar_pass_metodo.php" method="POST">
                        <h2>Recordar Contraseña</h2>
                        <table width="80%" border="0" cellpadding="5px" cellspacing="5px">
                            <tr>
                                <td>Rut: </td>
                                <td><input type="text" id="rut" name="rut" required></input></td>
                            </tr>
                            <tr>
                                <td>Correo Electrónico: </td>
                                <td><input type="text" id="email" name="email" required></input></td>
                            </tr>
                        </table>
                        <input id="input_pass" type="submit" name="btnEnvPass" value="Enviar Contraseña"></input>
                    </form>
                    <input id="input_pass" type="submit" name="btnCancelar" value="Cancelar" onclick="Cancelar();"></input>
                </center>
            </div>
        </main>  
    </body>
</html>