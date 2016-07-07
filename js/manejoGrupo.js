function open(){
<?php
        include("conexion.php");
        $link = Conectarse();

        $query = "SELECT rut, nombre, apellido_p FROM integrante WHERE rut != 'root'";

        $result = mysql_query($query, $link);?>
    
        <script> var arregloIntegrantes = new Array(); </script>
        <?php   
        while($row = mysql_fetch_array($result)){?>
        <script>
        $(function(){
            arregloIntegrantes.push("<?php echo $row['nombre'].' '.$row['apellido_p']?>");
        });
        </script>
        <?php }?>
        <script>
            $(function (){
                for (var i = 0; i < arregloIntegrantes.length; i++){
                    //$("#listaIntegrantes").append("<option class='list-group-item'></option>");
                    var htmlListaIntegrantes = document.getElementById("listaIntegrantes")
                    var option = document.createElement("option");
                    var valor = document.createTextNode(arregloIntegrantes[i]);
                    option.appendChild(valor);
                    htmlListaIntegrantes.appendChild(option);
                }
            });
        </script>
    <?php
    ?>
}