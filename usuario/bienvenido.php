<?php 
    require '../require/comun.php';
    $resultado = Leer::get("r");    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
        
        <title>Bienvenido a Blackboard</title>
    </head>
    <body>
        <div  class="container-inicio">
            <div class="logoprincipal">
                    <a href="index.php"><img src="../img/logoprincipal.png"/></a>
                </div>
        <?php
         if(1==1){ ?>
            <div  class="contenedor-central">
                <div class="titulo-estandar">
                    El usuario ha sido creado con exito, verifiquelo con el email que le hemos enviado.
                </div>
            </div>
        <?php
         }
        ?>
            <div class="contenedor-central">
                <div class="titulo-estandar">
                    <a href="../index.php">Ir a pagina de inicio</a>
                </div>
            </div>
        </div>
    </body>
</html>
