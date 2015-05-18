<!DOCTYPE html>
<?php
    require '../require/comun.php';
    $bd = new BaseDatos();
    $p = Leer::get("p");
    $modeloPost = new ModeloPost($bd);
    $usuario = $sesion->getUsuario();
    $login = $usuario->getLogin();
    $posts=$modeloPost->postMeGustan($p, 10, $login);
    $numeroRegistros = $modeloPost->count();    
    $lista = Util::getEnlacesPaginacion($p, 10, $numeroRegistros);
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
        <?php 
        foreach ($posts as $key => $post) {
            $idpost = $post->getIdpost();
            $modeloArchivo = new ModeloArchivospost($bd);
            $archivos = $modeloArchivo->getListTotal($idpost);
        ?>
        <div>
            <?php echo $post->getFechapost(); ?><br>
            <?php echo $post->getDescripcion(); ?><br>
            <?php echo $post->getGusta(); ?>
        </div>
            <?php foreach ($archivos as $key => $archivo) { ?>
                <a style="color:red;" target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
            <?php } ?>
        <?php
        }
        $bd->closeConsulta(); ?>
        <br><br>
        <ul>
            <?php 
                echo $lista["inicio"];
                echo $lista["anterior"];
                echo $lista["primero"];
                echo $lista["segundo"]; 
                echo $lista["actual"]; 
                echo $lista["cuarto"];
                echo $lista["quinto"]; 
                echo $lista["siguiente"];
                echo $lista["ultimo"];
                $bd->closeConexion();
            ?>

        </ul>
    </body>
</html>
<?php $bd->closeConexion(); ?>