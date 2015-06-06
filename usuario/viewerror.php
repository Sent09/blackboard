<!DOCTYPE html>
<?php
require '../require/comun.php';
$error = Leer::get("r");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
        <title>Blackboard</title>
    </head>
    <body>
        <div class="container-inicio">
            <div class="logoprincipal">
                <a href="index.php"><img src="../img/logoprincipal.png"/></a>
            </div>
            <?php if ($error == 1) { ?>
                <div class="div-error">
                    El usuario ya existe
                </div>
            <?php } ?>
            <?php if ($error == 2) { ?>
                <div class="div-error">
                    Las contraseñas no coinciden
                </div>
            <?php } ?>
            <?php if ($error == 3) { ?>
                <div class="div-error">
                    Hay campos vacíos, por favor, rellénalos
                </div>
            <?php } ?>
            <div class="div-volver">
                Haz click <a href="../index.php">aquí</a> para volver
            </div>
        </div>
    </body>
</html>
