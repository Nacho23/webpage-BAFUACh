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
        <title> BAFUACh - Administrar Grupos </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="imagenes/logo_bafuach.ico">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <!-- Estilos BOOTSTRAP -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Estilo Banner -->
        <link rel="stylesheet" href="css/banner.css">
        
        <link rel="stylesheet" href="css/fontello.css">

        <link rel="stylesheet" href="css/botones.css">
        
        <link rel="stylesheet" href="css/popup.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_tablasConsultas.css">
        
        <script lenguage = "javascript">
			function abrir(url, tipo){
                console.log(tipo);
                if(tipo != "Administrador"){
                    alert("No tiene permisos para realizar la funcion");
                }else{
                    window.open(url, "Formulario Usuario", "width=1250, height=650, top=10, left=50, scrollbars=yes");   
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
                window.open(url, "Modificar Contraseña", "width=600, height=500, top=50, left=50");
            }
            function administrarGrupos(){
                window.location.href="administrarGrupos.php";
            }
		</script>
        <script>
            function agregar(){
                var rutIntegrante = document.getElementById("listaIntegrantes").value;
                var nomGrupo = $("#listaGruposComboBox").val();
                $.ajax({
                    url: 'procesoAgregaIntegranteGrupo.php',
                    data: {rutIntegrante: rutIntegrante, nomGrupo: nomGrupo},
                    type: 'post',
                    success: function(data){
                        modificaListaGrupo();
                    }
                });
            }
            
            function eliminar(){
                var rutIntegrante = document.getElementById("listaGrupo").value;
                var nomGrupo = $("#listaGruposComboBox").val();
                console.log(rutIntegrante);
                console.log(nomGrupo);
                $.ajax({
                    url: 'procesoEliminaIntegranteGrupo.php',
                    data: {rutIntegrante: rutIntegrante, nomGrupo: nomGrupo},
                    type: 'post',
                    success: function(data){
                        modificaListaGrupo();
                    }
                });
            }
        </script>
        
    </head>
    
    <!-- CONSULTAS -->
    <?php
        include("conexion.php");
        $link = Conectarse();

        $query = "SELECT rut, nombre, apellido_p FROM integrante WHERE rut != 'root'";
        $result = mysql_query($query, $link);
    
        $query_grupos = "SELECT id, nombre FROM grupo WHERE visible = 'true'";
        $result_grupos = mysql_query($query_grupos, $link);
    
    ?>
    
    <!-- Rellena comboBox de Grupos con datos desde la BD -->
    <?php
    while($row_grupos = mysql_fetch_array($result_grupos)){?>
        <script>
            $(function(){
                var valor = "<?php echo $row_grupos['nombre'] ?>";
                $("#listaGruposComboBox").append("<option class='list-group-item' value='"+valor+"'>"+valor+"</option>");
            })
        </script><?php 
    }?>

    
    <!-- Define el arreglo -->
    <script> 
        var arregloIntegrantes = new Array();
        var arregloRutIntegrantes = new Array();
    </script>
    
    <!-- Rellena el arreglo con los datos obtenidos desde la BD -->
    <?php   
        while($row = mysql_fetch_array($result)){?>
        <script>
        $(function(){
            arregloIntegrantes.push("<?php echo $row['nombre'].' '.$row['apellido_p']?>");
            arregloRutIntegrantes.push("<?php echo $row['rut'] ?>");
        });
        </script>
        <?php }
    ?>
    
    <!-- Rellena la lista de Integrantes con los datos del arreglo -->
    <script>
        $(function (){
            for (var i = 0; i < arregloIntegrantes.length; i++){
                //console.log("hola");
                //$("#listaIntegrantes").append("<option class='list-group-item'>"+arregloIntegrantes[i]+"</option>");
                $("#listaIntegrantes").append("<option ondblclick='agregar();' class='list-group-item' value="+arregloRutIntegrantes[i]+" name="+arregloIntegrantes[i]+">"+arregloIntegrantes[i]+"</option>");
                //var htmlListaIntegrantes = document.getElementById("listaIntegrantes")
                //var option = document.createElement("option");
                //var valor = document.createTextNode(arregloIntegrantes[i]);
                //option.appendChild(valor);
                //htmlListaIntegrantes.appendChild(option);
            }
        });
    </script>
    
    <!-- Modifica lista del Grupo Seleccionado en el ComboBox -->
    <script>
        function modificaListaGrupo(){
            var grupo = $("#listaGruposComboBox").val();
            document.getElementById('tituloGrupo').innerHTML = grupo;
            $.ajax({
                url: 'procesoModificaIntegrante.php',
                data: {nombreGrupo: grupo},
                type: 'post',
                success: function(data){
                    $("#listaGrupo").html(data);
                }
            })
        }
    </script>
    
    <!-- Crea Nuevo Grupo -->
    <script>
        function crearGrupo(){
            var nuevoGrupo = $("#nombre-grupo").val();
            $.ajax({
                url: 'crearGrupo.php',
                data: {nuevoGrupo: nuevoGrupo},
                type: 'post',
                success: function(data){
                    alert(data);
                    window.location.reload();
                }
            })
        }
    </script>
    
    <!-- Elimina Grupo -->
    <script>
        function eliminarGrupo(){
            var grupo = $("#listaGruposComboBox").val();
            console.log(grupo);
            eliminar = confirm("¿Seguro desea eliminar el grupo "+grupo+"?");
            if(eliminar){
                $.ajax({
                    url: 'eliminaGrupo.php',
                    data: {grupo: grupo},
                    type: 'post',
                    success: function(data){
                        alert(data);
                        window.location.reload();
                    }
                })
            }
        }
    </script>
    
    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="menu.php">BAFUACh</a>
                </div>
            </div>
        </nav>
       
        
        <main>
        
            <div class="jumbotron jumbotron-img jum-home">  
                <div class="container text-left"></div>
            </div>
            
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Grupos</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-xs-5 selectContainer">
                                    <select id="listaGruposComboBox" class="form-control" onchange="modificaListaGrupo();">
                                        <option class='list-group-item' value="0" name="---">---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Opciones</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-xs-8 selectContainer">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearGrupo">Crear Grupo</button>
                                        <button type="button" onclick="eliminarGrupo();" class="btn btn-default">Eliminar Grupo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal para los Botones de Agregar y Eliminar Grupo -->
            <div class="modal fade" id="modalCrearGrupo" tabindex="-1" role="dialog" aria-labelledby="modalCrearGrupo">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="tituloModal">Nuevo Grupo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre-grupo" class="control-label">Nombre del Grupo</label>
                                <input type="text" class="form-control" id="nombre-grupo" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" onclick="crearGrupo();" class="btn btn-primary">Crear Grupo</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="list-group">
                            <a href="#" class="list-group-item disabled">
                                Integrantes
                            </a>
                            <select id="listaIntegrantes" class="form-control" MULTIPLE style="height: 300px">
                            </select>
                        </div>  
                    </div>
                    <div class="col-md-2">
                        <button onclick="agregar();" type="button" class="btn btn-primary btn-block">Agregar &#8594;</button>
                        <button onclick="eliminar();" type="button" class="btn btn-default btn-block">Eliminar</button>
                    </div>
                    <div class="col-md-5">
                        <div class="list-group">
                            <a href="#" id="tituloGrupo" class="list-group-item disabled">
                                "Nombre Grupo"
                            </a>
                            <select id="listaGrupo" class="form-control" MULTIPLE style="height: 300px">
                            </select>
                        </div>
                    </div>
                </div>
            </div>            
                
            <section id="base">
                <h3></h3>
                <div class="contenedor" style="height: 100px">
                    
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
        <script>
        $('#modalCrearGrupo').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Nuevo Grupo')
            modal.find('.modal-body input').val(recipient)
        })
        </script>
    </body>
    
    
    
</html>