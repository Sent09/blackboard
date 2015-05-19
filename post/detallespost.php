<?php
    require '../require/comun.php';
    $sesion->autentificado("../index.php");
    $bd = new BaseDatos();
    $id = Leer::get("id");
    $modeloPost = new ModeloPost($bd);
    $post = $modeloPost->get($id);
    $modeloUsuario = new ModeloUsuario($bd);
    $usuario = $modeloUsuario->get($post->getLogin());
    $login = $sesion->getUsuario()->getLogin();
    $megusta = new Megusta($login, $id);
    $modelomegusta = new ModeloMegusta($bd);
    $countmegusta = $modelomegusta->count($megusta);               
    $idelemento = "seguir0";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../js/js.js"></script>
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
        <a href="verusuario.php?login=<?php echo $post->getLogin();?>"><?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></a><br>
        <div>
            <?php echo $post->getFechapost(); ?><br>
            <?php echo $post->getDescripcion(); ?><br>
            <?php echo $post->getGusta(); ?>
            <?php if($countmegusta>0){ ?>
                <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $id; ?>')">No me gusta</a>
            <?php }else{ ?>
                <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $id; ?>')">Me gusta</a>
            <?php } ?>
        </div>
        <?php             
            $modeloArchivo = new ModeloArchivospost($bd);
            $archivos = $modeloArchivo->getListTotal($id);
        ?>
        <?php foreach ($archivos as $key => $archivo) { ?>
            <a style="color:red;" target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
        <?php } ?>
    </body>
</html>
