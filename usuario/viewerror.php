<!DOCTYPE html>
<?php 
require '../require/comun.php';
$error = Leer::get("r");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if($error == 1){ ?>
        Error en usuario o algo
        <?php } ?>
        <?php if($error == 2){ ?>
        Las contraseñas no coinciden
        <?php } ?>
    </body>
</html>
