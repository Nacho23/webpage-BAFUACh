<html>
    <head>
        <script lenguage="javascript">
            function salir(){
                window.close();
            }
        </script>
    </head>
    <main>
        <?php
            $clave = $_GET['as'];
            $usuario = $_GET['rut'];

            echo $clave."<br>";
            echo $usuario;

            include("conexion.php");
            $link = Conectarse();

            mysql_query("UPDATE cuenta SET clave='$clave' WHERE rut='$usuario';");

            echo "<script>";
            echo "salir();";
            echo "</script>";
        ?>
    </main>
</html>