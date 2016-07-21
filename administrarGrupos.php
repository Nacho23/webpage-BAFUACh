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
        <link rel="icon" href="imagenes/logo_android.ico">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <!-- Estilos BOOTSTRAP -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Estilo Banner -->
        <link rel="stylesheet" href="css/banner.css">
        
        <!-- Estilo Fontello (Fonts) -->
        <link rel="stylesheet" href="css/fontello.css">
        
        <link rel="stylesheet" type="text/css" href="css/estilo_tablasConsultas.css">
        
        <!-- FUNCIONES JS -->
        <script>
            //Agrega integrantes a un grupo
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
            //Elimina integrantes de un grupo
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
                $("#listaIntegrantes").append("<option ondblclick='agregar();' class='list-group-item' value="+arregloRutIntegrantes[i]+" name="+arregloIntegrantes[i]+">"+arregloIntegrantes[i]+"</option>");
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
            <!-- BANNER -->
            <section id="banner">
                <img src="imagenes/fondo1.jpg" alt="">
            </section>
            
            <!-- Panel de Grupos -->
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
                                <div class="col-xs-6 selectContainer">
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

            <!-- Panel de lista de integrantes -->
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
                                Grupo
                            </a>
                            <select id="listaGrupo" class="form-control" MULTIPLE style="height: 300px">
                            </select>
                        </div>
                    </div>
                </div>
            </div>            
        </main>

        <!-- FOOTER -->
        <footer>
            <div style="background: #333">
                <label style="padding: 50px"></label>
            </div>
        </footer>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>       
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Codigo JS extra -->
        <script>
        $('#modalCrearGrupo').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var recipient = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-title').text('Nuevo Grupo');
            modal.find('.modal-body input').val(recipient);
        })
        </script>
    </body>
    
    
    
</html>