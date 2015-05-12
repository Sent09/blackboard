<?php 
    require '../require/comun.php';
    $login = Leer::get("login");
    $bd = new BaseDatos();
    $modeloUsuario = new ModeloUsuario($bd);
    $usuario = $modeloUsuario->get($login);
    
    $p = Leer::get("p");
    $modeloPost = new ModeloPost($bd);
    $posts=$modeloPost->getList($p, 10, "login='$login'");
    $numeroRegistros = $modeloPost->count();    
    $lista = Util::getEnlacesPaginacion($p, 10, $numeroRegistros, "?login=$login");
    
    $modeloNotificaciones = new ModeloNotificaciones($bd);
    $seguidoresmios = $modeloNotificaciones->count("loginusuarioseguido='$login'");
    $siguiendo = $modeloNotificaciones->count("loginusuario='$login'");
    
    $loginsesion = $sesion->getUsuario()->getLogin();
    $comprobarsiguiendo = $modeloNotificaciones->count("loginusuario='$loginsesion' and loginusuarioseguido='$login'");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="#">Me Gusta</a></li>
                <li><a href="mispost.php">Mis post</a></li>
                <li><a href="#">Panel de administración</a></li>
                <li><a href="../usuario/phpcerrarsesion.php">Desloguear</a></li>
            </ul>
        </nav>
        <div>
            Datos del usuario:
            Nombre:<?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?>
            <img src="../archivos/<?php echo $usuario->getUrlfoto(); ?>"/><br>
            Seguidores: <?php echo $seguidoresmios; ?><br>
            Siguiendo: <?php echo $siguiendo; ?><br><br>
            <?php if($comprobarsiguiendo == 1){ ?>
            <a id="seguir" href="javascript:seguir('<?php echo $loginsesion; ?>','<?php echo $login; ?>')">Siguiendo</a>
            <?php }else{ ?>
            <a id="seguir" href="javascript:seguir('<?php echo $loginsesion; ?>','<?php echo $login; ?>')">Seguir</a>
            <?php } ?>
        </div>
        <div>
            Posts:
            <?php 
            $contador = 0;
            foreach ($posts as $key => $post) {
                $idpost = $post->getIdpost();
                $modeloArchivo = new ModeloArchivospost($bd);
                $archivos = $modeloArchivo->getListTotal($idpost);
                
                $megusta = new Megusta($loginsesion, $idpost);
                $modelomegusta = new ModeloMegusta($bd);
                $countmegusta = $modelomegusta->count($megusta);               
                $idelemento = "seguir".$contador;
            ?>
            <div>
                <?php echo $post->getFechapost(); ?><br>
                <?php echo $post->getDescripcion(); ?><br>
                <?php echo $post->getGusta(); ?>
                <?php if($countmegusta>0){ ?>
                    <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $loginsesion; ?>','<?php echo $idpost; ?>')">No me gusta</a>
                <?php }else{ ?>
                    <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $loginsesion; ?>','<?php echo $idpost; ?>')">Me gusta</a>
                <?php } ?>
            </div>
                <?php foreach ($archivos as $key => $archivo) { ?>
                    <a style="color:red;" target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
                <?php } ?>
            <?php
                $contador++;
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
        </div>   
        <script src="../js/jquery-1.7.2.min.js" ></script>
        <script src="../js/js.js" ></script>
    </body>
</html>
