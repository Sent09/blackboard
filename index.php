<?php 
    require 'require/comun2.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/js.js"></script>
        <script src="js/javascriptscroll.js"></script>
        <script src="js/main.js"></script>
        <?php if(!$sesion->isAutentificado()){ ?>
        <link rel="stylesheet" type="text/css" href="styles/styles.css">
        <?php }else{ ?>
        <link rel="stylesheet" type="text/css" href="styles/styles2.css">        
        <?php } ?>        
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
            $condicionmisposts = "login=:login";
            $parametrosmisposts["login"] = $login;
            $misposts = $modeloPost->count($condicionmisposts, $parametrosmisposts);
            
        ?>        
        <header>
            <div class="div-logo">
                <a href="index.php"><img src="img/logoprincipalm.png"/></a>
                <div class="links">
                   <div><a href="post/megusta.php"><span>h</span>Me gustan</a></div>
                   <div><a href="post/mispost.php"><span>Y</span>Mis posts</a></div>
                </div>
            </div>
            <nav>
                <div class="search">
                    <div class="userpanel" id="primary_nav_wrap">
                        <ul>
                            <li>
                                <a href="#"><span>A</span></a>
                                <ul>
                                    <li><a href="usuario/viewperfil.php"><span>C</span>Panel de control</a></li>
                                    <li><a href="usuario/phpcerrarsesion.php"><span>e</span>Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <form id="form-buscar" action="javascript:enviarIndex(this.buscar)" name="buscar" method="post">
                        <input type="search" placeholder="Buscar" id="busqueda" name="texto">
                    </form>
                </div>
            </nav>
        </header>
        <div class="contenedor-main">
            <aside id="manageinfo" class="manageinfo">
                <div class="bloque">
                    <div class="bloqueusuario">
                        <div class="fotoprincipal">
                            <img  width= "350px" height="250px" src="archivos/<?php echo $sesionusuario->getUrlfoto(); ?>">
                        </div>
                        <div class="usuario-nombre"><?php echo $sesionusuario->getNombre()." ".$sesionusuario->getApellidos(); ?></div>
                    </div>
                    <div class="userinfo">
                        <div class="links-top">
                            <a href="post/mispost.php"><div class="misposts"><img src="img/postsicon2.png"/><span><?php echo $misposts; ?></span></div></a>
                            <a href="post/seguidores.php"><div class="misseguidores"><img src="img/smileicon.png"/><span><?php echo $seguidoresmios; ?></span></div></a>
                            <a href="post/siguiendo.php"><div class="siguiendo"><img src="img/staricon.png"/><span><?php echo $siguiendo; ?></span></div></a>
                        </div>
                        <div class="linksm">
                           <div><a href="post/megusta.php"><span>h</span>Me gustan</a></div>
                           <div id="notificaciones-toggle" class="notificaciones-toggle"><span>T</span>Notificaciones</div>
                        </div>
                    </div>
                    <div class="searchm">
                        <div class="userpanel" id="primary_nav_wrap">
                            <ul>
                                <li>
                                    <a href="#"><span>A</span></a>
                                    <ul>
                                        <li><a href="usuario/viewperfil.php"><span>C</span>Panel de control</a></li>
                                        <li><a href="usuario/phpcerrarsesion.php"><span>e</span>Cerrar sesión</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <form id="form-buscar" action="javascript:enviarIndex2(this.buscar2)" name="buscar2" method="post">
                            <input type="search" placeholder="Buscar" id="busqueda" name="texto">
                        </form>
                    </div>
                    
                </div>
                <div id="notificaciones-list" class="notificaciones-list">
                    <div id="notificacionesmv"> 
                        <?php 
                        $parametros["login"] = $login;
                        $valor = "loginusuario=:login AND nuevosposts > 0";
                        $notificaciones = $modeloNotificaciones->getListScroll(0,10,$valor,$parametros);
                        foreach ($notificaciones as $key => $notificacion) {
                            $modeloUsuario = new ModeloUsuario($bd);
                            $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
                        ?>
                        <div class="notificacion">
                            <div class="foto-not"><img src="archivos/<?php echo $usuario->getUrlfoto(); ?>"></div>
                            <a href="post/phpvernotificacion.php?login=<?php echo $usuario->getLogin(); ?>"><div class="texto-not"><span><?php echo $notificacion->getNuevosposts(); ?></span> nuevas publicaciones de <?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></div></a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="botonesnotificaciones">
                        <input class="atras" type="button" id="notificacion_atras" onclick="javascript:cargarNotificaciones('<?php echo $login; ?>', 1, 2)" >
                        <input class="adelante" type="button" id="notificacion_siguiente" onclick="javascript:cargarNotificaciones('<?php echo $login; ?>', 2, 2)">
                    </div>                
                    <input class="borrar" type="button" onclick="javascript:borrarNotificaciones(2)" value="Borrar notificaciones">
                </div>
                <div>
                    <div class="posttitle">Nuevo post</div>
                    <div class="postbox">
                        <form action="post/phpcrearpost.php" enctype="multipart/form-data" method="POST">
                            <textarea name="mensaje" type="text" placeholder="Comparte una nueva publicación..." id="post"></textarea>
                            <div class="agregararchivos">
                                <span id="seleccionados">Agregar archivos...</span>
                                <input type="file" onchange="javascript:cambiar(this)" name="archivos[]" id="archivos" multiple>
                            </div>
                            <button class="enviar" type="submit">Publicar</button>
                        </form>
                    </div>
                </div>
                
            </aside>
            <section id="lista_posts">
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
                <article class="post">
                    <div class="bloq-sup-post">
                        <div class="div-foto"><img src="archivos/<?php echo $usuariopost->getUrlfoto(); ?>"></div>
                        <div class="nombre-poster"><a href="post/verusuario.php?login=<?php echo $post->getLogin(); ?>"><?php echo $usuariopost->getNombre()." ".$usuariopost->getApellidos(); ?></a></div>
                    </div>
                    <div class="bloq-inf-post">
                        <div class="post-body">
                            <div class="fecha-post"><a href="post/detallespost.php?id=<?php echo $post->getIdpost(); ?>"><?php echo $post->getFechapost(); ?></a></div>
                            <div class="mensaje-post">
                                <?php echo $post->getDescripcion(); ?><br>
                                <div class="gusta">
                                    <?php echo $post->getGusta(); ?>
                                    <?php if($countmegusta>0){ ?>
                                    <a id="<?php echo $idelemento; ?>" href="javascript:gustaindex('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')"><img src="img/megusta.png" /></a>
                                    <?php }else{ ?>
                                    <a id="<?php echo $idelemento; ?>" href="javascript:gustaindex('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')"><img src="img/nomegusta.png" /></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="archivos-box">
                            <?php foreach ($archivos as $key => $archivo) { 
                                if(strtolower($archivo->getExtension()) == ".jpg" || strtolower($archivo->getExtension()) == ".png" || strtolower($archivo->getExtension()) == ".gif" || strtolower($archivo->getExtension()) == ".jpeg" ){
                            ?>
                                    <div class="archivo"><a target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>"><img src="img/ficheroicon.png"></a></div>
                                <?php } ?>
                                    
                                <?php
                                    if(strtolower($archivo->getExtension()) == ".doc" || strtolower($archivo->getExtension()) == ".docx" || strtolower($archivo->getExtension()) == ".pdf"){
                                ?>
                                    <div class="archivo"><a target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>"><img src="img/ficheroicon.png"></a></div>
                                <?php } ?>
                                
                                <?php
                                    if(strtolower($archivo->getExtension()) == ".avi" || strtolower($archivo->getExtension()) == ".mp4"){
                                ?>
                                    <div class="archivo"><a target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>"><img src="img/videoicon.png"></a></div>
                                <?php } ?>
                                
                                <?php
                                    if(strtolower($archivo->getExtension()) == ".mp3" || strtolower($archivo->getExtension()) == ".wav"){
                                ?>
                                    <div class="archivo"><a target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>"><img src="img/soundicon.png"></a></div>
                                <?php } ?>
                            
                            <?php } ?>

                            
                        </div>
                    </div>
                </article>
                
                <?php
                $contador++;
                }
                if(count($posts) > 0){ 
                ?>
                    <button id="mas" onclick="javascript:cargarIndex('<?php echo $login; ?>');" class="boton">Cargar más</button>
                <?php } ?>
            </section>
            <aside class="div-notificaciones" >
                <div id="notificaciones"> 
                <?php 
                $parametros["login"] = $login;
                $valor = "loginusuario=:login AND nuevosposts > 0";
                $notificaciones = $modeloNotificaciones->getListScroll(0,10,$valor,$parametros);
                foreach ($notificaciones as $key => $notificacion) {
                    $modeloUsuario = new ModeloUsuario($bd);
                    $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
                ?>
                <div class="notificacion">
                    <div class="foto-not"><img src="archivos/<?php echo $usuario->getUrlfoto(); ?>"></div>
                    <a href="post/phpvernotificacion.php?login=<?php echo $usuario->getLogin(); ?>"><div class="texto-not"><span><?php echo $notificacion->getNuevosposts(); ?></span> nuevas publicaciones de <?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></div></a>
                </div>
                <?php } ?>
                </div>
                <div class="botonesnotificaciones">
                    <input class="atras" type="button" id="notificacion_atras" onclick="javascript:cargarNotificaciones('<?php echo $login; ?>', 1, 1)" >
                    <input class="adelante" type="button" id="notificacion_siguiente" onclick="javascript:cargarNotificaciones('<?php echo $login; ?>', 2, 1)">
                </div>                
                <input class="borrar" type="button" onclick="javascript:borrarNotificaciones(1)" value="Borrar notificaciones">
            </aside>
        </div>
        <?php $bd->closeConsulta(); }?>
    </body>
</html>
