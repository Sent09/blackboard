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
$posts = $modeloPost->getList(0, 10, "login='$login'");

$modeloNotificaciones = new ModeloNotificaciones($bd);
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
        <script type="text/javascript" src="../js/main.js"></script>
        <link rel="stylesheet" type="text/css" href="../styles/styles2.css">
    </head>
    <body>
        <header>
            <div class="div-logo">
                <a href="../index.php"><img src="../img/logoprincipalm.png"/></a>
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
                                    <li><a href="../usuario/viewperfil.php"><span>C</span>Panel de control</a></li>
                                    <li><a href="../usuario/phpcerrarsesion.php"><span>e</span>Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <form id="form-buscar" action="javascript:enviar(this.buscar)" name="buscar" method="post">
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
                            <img width= "350px" height="250px" src="../archivos/<?php echo $usuario->getUrlfoto(); ?>"/>
                        </div>
                        <div class="usuario-nombre">
                            <?php echo $usuario->getNombre() . " " . $usuario->getApellidos(); ?>
                        </div>
                    </div>

                    <div class="linksm">
                        <div><a href="mispost.php"><span>Y</span>Mis posts</a></div>
                        <div><a href="megusta.php"><span>h</span>Me gustan</a></div>
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
                    <div class="div-seguir">
                        <button class="seguir">
                            <?php if ($comprobarsiguiendo == 1) { ?>
                                <a id="seguir" href="javascript:seguir('<?php echo $loginsesion; ?>','<?php echo $login; ?>')">Siguiendo</a>
                            <?php } else { ?>
                                <a id="seguir" href="javascript:seguir('<?php echo $loginsesion; ?>','<?php echo $login; ?>')">Seguir</a>
                            <?php } ?>
                        </button>
                    </div>
            </aside>
            <section id="lista_posts">
                <?php
                $contador = 0;
                if (count($posts) == 0)
                    echo "No hay posts para mostrar";
                foreach ($posts as $key => $post) {
                    $idpost = $post->getIdpost();
                    $modeloArchivo = new ModeloArchivospost($bd);
                    $archivos = $modeloArchivo->getListTotal($idpost);

                    $megusta = new Megusta($loginsesion, $idpost);
                    $modelomegusta = new ModeloMegusta($bd);
                    $countmegusta = $modelomegusta->count($megusta);
                    $idelemento = "gusta" . $contador;
                    $modelousuariopost = new ModeloUsuario($bd);
                    $usuariopost = $modelousuariopost->get($post->getLogin());
                    ?>
                    <article class="post">
                        <div class="bloq-sup-post">
                            <div class="div-foto">
                                <img src="../archivos/<?php echo $usuariopost->getUrlfoto(); ?>">
                            </div>
                            <div class="nombre-poster">
                                <a href="verusuario.php?login=<?php echo $post->getLogin(); ?>"><?php echo $usuariopost->getNombre() . " " . $usuariopost->getApellidos(); ?></a>
                            </div>
                        </div>
                        <div class="bloq-inf-post">
                            <div class="post-body">
                                <div class="fecha-post">
                                    <a href="detallespost.php?id=<?php echo $post->getIdpost(); ?>"><?php echo $post->getFechapost(); ?></a>
                                </div>
                                <div class="mensaje-post">
                                    <?php echo $post->getDescripcion(); ?><br>
                                    <?php echo $post->getGusta(); ?>
                                    <?php if ($countmegusta > 0) { ?>
                                        <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $loginsesion; ?>','<?php echo $idpost; ?>')"><img src="../img/megusta.png" /></a>
                                    <?php } else { ?>
                                        <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $loginsesion; ?>','<?php echo $idpost; ?>')"><img src="../img/nomegusta.png" /></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="archivos-box">
                                <?php
                                    foreach ($archivos as $key => $archivo) {
                                        if (strtolower($archivo->getExtension()) == ".jpg" || strtolower($archivo->getExtension()) == ".png" || strtolower($archivo->getExtension()) == ".gif" || strtolower($archivo->getExtension()) == ".jpeg") {
                                            ?>
                                            <div class="archivo"><a target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>"><img src="../img/ficheroicon.png"></a></div>
                                        <?php } ?>

                                        <?php
                                        if (strtolower($archivo->getExtension()) == ".doc" || strtolower($archivo->getExtension()) == ".docx" || strtolower($archivo->getExtension()) == ".pdf") {
                                            ?>
                                            <div class="archivo"><a target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>"><img src="../img/ficheroicon.png"></a></div>
                                        <?php } ?>

                                        <?php
                                        if (strtolower($archivo->getExtension()) == ".avi" || strtolower($archivo->getExtension()) == ".mp4") {
                                            ?>
                                            <div class="archivo"><a target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>"><img src="../img/videoicon.png"></a></div>
                                        <?php } ?>

                                        <?php
                                        if (strtolower($archivo->getExtension()) == ".mp3" || strtolower($archivo->getExtension()) == ".wav") {
                                            ?>
                                            <div class="archivo"><a target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>"><img src="../img/soundicon.png"></a></div>
                                        <?php } ?>

        <?php } ?>
                            </div>
                    </article>
                    <?php
                    $contador++;
                }
                if (count($posts) > 0) {
                    ?>
                    <button id="mas" onclick="javascript:cargarVerUsuario('<?php echo $login; ?>');" class="boton">Cargar más</button>
                    <?php
                }
                $bd->closeConsulta();
                ?>
            </section>  
        </div>
    </body>
</html>
