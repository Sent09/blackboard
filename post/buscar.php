<?php
    require '../require/comun.php';
    $bd = new BaseDatos();
    $value = Leer::get("value");
    $p = Leer::get("p");
    $modeloPost = new ModeloPost($bd);
    $usuario = $sesion->getUsuario();
    $login = $usuario->getLogin();
    $posts=$modeloPost->getList($p, 10, "login='$login'");
    $numeroRegistros = $modeloPost->count();    
    $lista = Util::getEnlacesPaginacion($p, 10, $numeroRegistros);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
