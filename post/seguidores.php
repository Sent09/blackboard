<?php
    require '../require/comun.php';
    $sesion->autentificado("../index.php");
    unset($_SESSION["cantidadcargadas"]);
    $bd = new BaseDatos();
    $login = $sesion->getUsuario()->getLogin();
    $modeloNotificaciones = new ModeloNotificaciones($bd);
    $parametros["loginusuarioseguido"] = $login;
    $condicion = "loginusuarioseguido=:loginusuarioseguido";
    $notificaciones=$modeloNotificaciones->getListScroll(0, 10, $condicion, $parametros);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Blackboard</title>
        <script type="text/javascript" src="../js/javascriptscroll.js"></script>
        <script type="text/javascript" src="../js/js.js"></script>

    </head>
    <body>
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="megusta.php">Me Gusta</a></li>
                <li><a href="mispost.php">Mis post</a></li>
                <li><a href="#">Panel de administración</a></li>
                <li><a href="../usuario/phpcerrarsesion.php">Desloguear</a></li>
                <li>
                    <form action="javascript:enviar(this.buscar)" name="buscar" method="post">
                        <input type="text" placeholder="Buscar" name="texto">
                    </form>
                </li>
            </ul>
        </nav>
        <div id="lista_posts">
            <?php
                if(count($notificaciones) == 0) echo "No hay usuarios"; 
                foreach ($notificaciones as $key => $notificacion) {
                    $modeloUsuario = new ModeloUsuario($bd);
                    $usuario = $modeloUsuario->get($notificacion->getLoginusuario());
            ?>
            <a href="verusuario.php?login=<?php echo $usuario->getLogin(); ?>"><?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></a><small><?php echo $usuario->getLogin(); ?></small></br>
            <?php
                }
                if(count($notificaciones) > 0){
            ?>
                <input type="button" id="mas" onclick="javascript:cargarSeguidores('<?php echo $login; ?>');" value="Cargar más">
            <?php } ?>
        </div>
    </body>
</html>
