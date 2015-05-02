<?php 
    require '../require/comun.php';
    $resultado = Leer::get("r");    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         if($resultado==1){
             echo "El usuario ha sido creado con exito, verifiquelo con el email que le hemos enviado.";
         }
        ?>
        <a href="../index.php">Ir a pagina de inicio</a>
    </body>
</html>
