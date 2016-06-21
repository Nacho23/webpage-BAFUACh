<?php
    session_start();

    if($_SESSION['usuario']){
        session_destroy();
        echo '<script lenguage="javascript">
        alert ("Sesion cerrada corectamente");
        self.location = "login.php";
        </script>';
    }else{
        echo '<script lenguage="javascript">
        alert("No ha iniciado ninguna sesion");
        self.location = "login.php";
        </script>';
    }
?>