<!DOCTYPE html>
<?php
    require '../require/comun.php';
    unset($_SESSION["cantidadcargadas"]);
    $sesion->autentificado("../index.php");
    $bd = new BaseDatos();
    $modeloPost = new ModeloPost($bd);
    $usuario = $sesion->getUsuario();
    $login = $usuario->getLogin();
    $posts=$modeloPost->getList(0, 10, "login='$login'");
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../js/js.js"></script>
        <script type="text/javascript" src="../js/javascriptscroll.js"></script>
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
        if(count($posts) == 0) echo "No hay posts para mostrar";
        foreach ($posts as $key => $post) {
            $idpost = $post->getIdpost();
            $modeloArchivo = new ModeloArchivospost($bd);
            $archivos = $modeloArchivo->getListTotal($idpost);
        ?>
        <div>
            <?php echo $post->getFechapost(); ?><br>
            <?php echo $post->getDescripcion(); ?><br>
            <?php echo $post->getGusta(); ?>
            <a href="phpborrarpost.php?idpost=<?php echo $post->getIdpost(); ?>">Borrar</a>
        </div>
            <?php foreach ($archivos as $key => $archivo) { ?>
                <a style="color:red;" target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
            <?php } ?>
        <?php
        }
        if(count($posts) > 0){
        ?>
            <input type="button" id="mas" onclick="javascript:cargarMisPosts('<?php echo $login; ?>');" value="Cargar más">
        <?php    
        }
        $bd->closeConsulta(); ?>
        </div>
    </body>
</html>
<?php $bd->closeConexion(); ?>