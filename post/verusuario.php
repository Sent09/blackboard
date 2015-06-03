<?php 
    require '../require/comun.php';
    unset($_SESSION["cantidadcargadas"]);
    unset($_SESSION["contador"]);
    $sesion->autentificado("../index.php");
    $login = Leer::get("login");
    $bd = new BaseDatos();
    $modeloUsuario = new ModeloUsuario($bd);
    $usuario = $modeloUsuario->get($login);
    $modeloPost = new ModeloPost($bd);
    $posts=$modeloPost->getList(0, 10, "login='$login'");
    
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
        <title>Blackboard</title>
        <script type="text/javascript" src="../js/js.js"></script>
        <script type="text/javascript" src="../js/javascriptscroll.js"></script>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="#">Me Gusta</a></li>
                <li><a href="mispost.php">Mis post</a></li>
                <li><a href="../usuario/viewperfil.php">Panel de administración</a></li>
                <li><a href="../usuario/phpcerrarsesion.php">Desloguear</a></li>
                <li>
                    <form action="javascript:enviar(this.buscar)" name="buscar" method="post">
                        <input type="text" placeholder="Buscar" name="texto">
                    </form>
                </li>
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
        <div id="lista_posts">
            Posts:
            <?php 
            $contador = 0;
            if(count($posts) == 0) echo "No hay posts para mostrar";
            foreach ($posts as $key => $post) {
                $idpost = $post->getIdpost();
                $modeloArchivo = new ModeloArchivospost($bd);
                $archivos = $modeloArchivo->getListTotal($idpost);
                
                $megusta = new Megusta($loginsesion, $idpost);
                $modelomegusta = new ModeloMegusta($bd);
                $countmegusta = $modelomegusta->count($megusta);               
                $idelemento = "gusta".$contador;
                $modelousuariopost = new ModeloUsuario($bd);
                $usuariopost = $modelousuariopost->get($post->getLogin());
            ?>
            <div>
                <img width="30" src="../archivos/<?php echo $usuariopost->getUrlfoto(); ?>">
                <a href="verusuario.php?login=<?php echo $post->getLogin(); ?>"><?php echo $usuariopost->getNombre()." ".$usuariopost->getApellidos(); ?></a>
                <a href="detallespost.php?id=<?php echo $post->getIdpost(); ?>"><?php echo $post->getFechapost(); ?></a><br>
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
            if(count($posts) > 0){ 
            ?>
                <input type="button" id="mas" onclick="javascript:cargarVerUsuario('<?php echo $login; ?>');" value="Cargar más">
            <?php }
            $bd->closeConsulta(); ?>
        </div>   
    </body>
</html>
