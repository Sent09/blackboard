<!DOCTYPE html>
<?php
    require '../require/comun.php';
    $bd = new BaseDatos();
    $p = Leer::get("p");
    $modeloPost = new ModeloPost($bd);
    $posts=$modeloPost->getList($p, 10);
    $numeroRegistros = $modeloPost->count();    
    $lista = Util::getEnlacesPaginacion($p, 10, $numeroRegistros);
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
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
                <a style="color:red;" target="_blank" href="../img/<?php echo $archivo->getUrl(); ?>">archivico</a>
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