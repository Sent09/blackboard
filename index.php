<?php 
    require 'require/comun2.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="js/js.js"></script>
        <script src="js/javascriptscroll.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/styles.css">
        <title>Blackboard</title>
    </head>
    <body>
        <?php
        if(!$sesion->isAutentificado()){
        ?>
        <div class="container-inicio">
                <div class="logoprincipal">
                    <img src="img/logoprincipal.png"/>
                </div>
                <div class="contenedor-central">
                        <div class="div-registro">
                            <div class="titulo">Registro</div>
                            <div class="registro">
                                <form id="form-registro" action="usuario/phpalta.php" method="POST">
                                <input type="text" class="form-control" id="login" name="login" placeholder="Usuario" required>
                                <input type="password" class="form-control" id="password" name="clave" placeholder="Contraseña" required>
                                <input type="password" class="form-control" id="repeat" name="clave2" placeholder="Repite contraseña" required>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                                <input type="email" class="form-control" id="correo" name="email" placeholder="Corre electrónico" required>
                                <input type="submit" class="form-control" id="enviar" name="boton" value="Regístrame" required>
                            </form>
                        </div>
                    </div>
                    <div class="div-entrar">
                        <div class="titulo">Entrar</div>
                        <div class="entrar">
                            <form id="form-entrar" action="usuario/phplogin.php" method="POST">
                                <input type="text" id="login" name="login" placeholder="Usuario" required>
                                <input type="password" id="password" name="clave" placeholder="Contraseña" required>
                                <input type="submit" id="enviar" value="Entrar">
                            </form>
                            <div class="olvido">¿Has olvidado tu contraseña? Recupérala <a href="usuario/viewolvido.php">aquí</a>.
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="rights">
            <div class="privacidad"><a href="#">Política de privacidad</a></div>
            <div class="derechos">Furo Web Graphics. Todos los derechos reservados. 2015</div>
        </div>
        <?php }else{ 
            unset($_SESSION["cantidadcargadas"]);
            unset($_SESSION["contador"]);
            unset($_SESSION["notificaciones"]);
            $sesionusuario = $sesion->getUsuario();
            $login = $sesionusuario->getLogin();
            $bd = new BaseDatos();
            $modeloPost = new ModeloPost($bd);
            $posts=$modeloPost->postYoSigo(0, 10, $login);

            $modeloNotificaciones = new ModeloNotificaciones($bd);
            $seguidoresmios = $modeloNotificaciones->count("loginusuarioseguido='$login'");
            $siguiendo = $modeloNotificaciones->count("loginusuario='$login'");
        ?>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="post/megusta.php">Me Gusta</a></li>
                <li><a href="post/mispost.php">Mis post</a></li>
                <li><a href="usuario/viewperfil.php">Panel de administración</a></li>
                <li><a href="usuario/phpcerrarsesion.php">Desloguear</a></li>
                <li>
                    <form action="javascript:enviarIndex(this.buscar)" name="buscar" method="post">
                        <input type="text" placeholder="Buscar" name="texto">
                    </form>
                </li>
            </ul>
        </nav>
        Nuevo post
        <form action="post/phpcrearpost.php" enctype="multipart/form-data" method="POST">
            <textarea name="mensaje"></textarea>
            <input type="file" name="archivos[]" multiple />
            <input type="submit"/>
        </form>
        Datos del usuario:<br>
        Nombre: <?php echo $sesionusuario->getNombre()." ".$sesionusuario->getApellidos(); ?>
        <img src="archivos/<?php echo $sesionusuario->getUrlfoto(); ?>"/><br>
        <a href="post/seguidores.php">Seguidores: <?php echo $seguidoresmios; ?></a><br>
        <a href="post/siguiendo.php">Siguiendo: <?php echo $siguiendo; ?></a><br><br>
        
        
        <h1>Posts</h1>
        <br><br>
        <div id="lista_posts">
            <?php 
            $contador = 0;
            if(count($posts) == 0) echo "No hay posts para mostrar"; 
            foreach ($posts as $key => $post) {
                $idpost = $post->getIdpost();
                $modeloArchivo = new ModeloArchivospost($bd);
                $archivos = $modeloArchivo->getListTotal($idpost);
                $megusta = new Megusta($login, $idpost);
                $modelomegusta = new ModeloMegusta($bd);
                $countmegusta = $modelomegusta->count($megusta);               
                $idelemento = "seguir".$contador;
                $modelousuariopost = new ModeloUsuario($bd);
                $usuariopost = $modelousuariopost->get($post->getLogin());
            ?>
            <div>
                <img width="30" src="archivos/<?php echo $usuariopost->getUrlfoto(); ?>">
                <a href="post/verusuario.php?login=<?php echo $post->getLogin(); ?>"><?php echo $usuariopost->getNombre()." ".$usuariopost->getApellidos(); ?></a>
                <a href="post/detallespost.php?id=<?php echo $post->getIdpost(); ?>"><?php echo $post->getFechapost(); ?></a><br>
                <?php echo $post->getDescripcion(); ?><br>
                <?php echo $post->getGusta(); ?>
                <?php if($countmegusta>0){ ?>
                    <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gustaindex('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')">No me gusta</a>
                <?php }else{ ?>
                    <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gustaindex('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')">Me gusta</a>
                <?php } ?>
            </div>
                <?php foreach ($archivos as $key => $archivo) { ?>
                    <a style="color:red;" target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
                <?php } ?>
            <?php
                $contador++;
            }
            if(count($posts) > 0){ 
            ?>
                <input type="button" id="mas" onclick="javascript:cargarIndex('<?php echo $login; ?>');" value="Cargar más">
            <?php } ?>
            </div>
            <h1>Notificaciones</h1>
            <div id="notificaciones">                
                <?php 
                $parametros["login"] = $login;
                $valor = "loginusuario=:login AND nuevosposts > 0";
                $notificaciones = $modeloNotificaciones->getListScroll(0,10,$valor,$parametros);
                foreach ($notificaciones as $key => $notificacion) {
                    $modeloUsuario = new ModeloUsuario($bd);
                    $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
                ?>
                <div>
                    <?php echo $usuario->getNombre(); ?>
                    <?php echo $usuario->getApellidos(); ?>
                    <?php echo $notificacion->getNuevosposts(); ?>
                </div>
                <?php } ?>
            </div>
            <input type="button" value="Atrás" id="notificacion_atras" onclick="javascript:cargarNotificaciones('<?php echo $login; ?>', 1)" ><input type="button" value="Siguiente" id="notificacion_siguiente" onclick="javascript:cargarNotificaciones('<?php echo $login; ?>', 2)"><input type="button" value="Borrar notificaciones">
        <?php $bd->closeConsulta(); }?>
    </body>
</html>