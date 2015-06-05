<!DOCTYPE html>
<?php
/**
 * Muestra los posts que le gustan al usuario y da la posibilidad de quitarle el "me gusta"
 */
require '../require/comun.php';
$sesion->autentificado("../index.php");
unset($_SESSION["cantidadcargadas"]);
unset($_SESSION["contador"]);
$bd = new BaseDatos();
$modeloPost = new ModeloPost($bd);
$usuario = $sesion->getUsuario();
$login = $usuario->getLogin();
$posts = $modeloPost->postMeGustan(0, 10, $login);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Blackboard</title>
        <script type="text/javascript" src="../js/js.js"></script>
        <script type="text/javascript" src="../js/javascriptscroll.js"></script>
        <script src="../js/main2.js"></script>
        <link rel="stylesheet" type="text/css" href="../styles/styles2.css">
    </head>
    <body>
        <header>
            <div class="div-logo">
                <a href="../index.php"><img src="../img/logoprincipalm.png"/></a>
                <div class="links">
                    <div><a href="megusta.php"><span>h</span>Me gustan</a></div>
                    <div><a href="mispost.php"><span>Y</span>Mis posts</a></div>
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
                        <input type="search" placeholder="Buscar usuarios" id="busqueda" name="texto">
                    </form>
                </div>
            </nav>
        </header>
        <div class="contenedor-main">
            <aside id="manageinfo2" class="manageinfo2">
                <div class="bloque">
                    <div class="userinfo">
                        <div class="linksm">
                            <div><a href="megusta.php"><span>h</span>Me gustan</a></div>
                            <div><a href="mispost.php"><span>Y</span>Mis posts</a></div>
                        </div>
                    </div>
                    <div class="searchm">
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
                        <form id="form-buscar" action="javascript:enviar2(this.buscar2)" name="buscar2" method="post">
                            <input type="search" placeholder="Buscar usuarios" id="busqueda" name="texto">
                        </form>
                    </div>
                </div>
            </aside>
            <section class="siguiendo2" id="lista_posts">
                <div class="titulo-estandar">Posts que me gustan</div>
                <?php
                if (count($posts) == 0)
                    echo "No hay posts para mostrar";
                $contador = 0;
                foreach ($posts as $key => $post) {
                    $idpost = $post->getIdpost();
                    $modeloArchivo = new ModeloArchivospost($bd);
                    $archivos = $modeloArchivo->getListTotal($idpost);
                    $megusta = new Megusta($login, $idpost);
                    $modelomegusta = new ModeloMegusta($bd);
                    $countmegusta = $modelomegusta->count($megusta);
                    $idelemento = "gusta" . $contador;
                    $modelousuariopost = new ModeloUsuario($bd);
                    $usuariopost = $modelousuariopost->get($post->getLogin());
                    ?>
                    <article class="post">
                        <div class="bloq-sup-post">
                            <div class="div-foto">
                                <img width="30" src="../archivos/<?php echo $usuariopost->getUrlfoto(); ?>">
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
                                    <?php echo $post->getDescripcion(); ?>
                                </div>
                                <div class="div-megusta">
                                    <?php echo $post->getGusta(); ?>
                                    <?php if ($countmegusta > 0) { ?>
                                        <a class="megusta-numero" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>', '2')"><img src="../img/megusta.png" /></a>
                                    <?php } else { ?>
                                        <a class="megusta-icono" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>', '2')"><img src="../img/nomegusta.png" /></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="archivos-box">
                            <?php
                            foreach ($archivos as $key => $archivo) {
                                if (strtolower($archivo->getExtension()) == ".jpg" || strtolower($archivo->getExtension()) == ".png" || strtolower($archivo->getExtension()) == ".gif" || strtolower($archivo->getExtension()) == ".jpeg") {
                                    ?>
                                    <div class="archivo"><a target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>"><img src="../img/imgicon.png"></a></div>
                                <?php } ?>

                                <?php
                                if (strtolower($archivo->getExtension()) == ".doc" || strtolower($archivo->getExtension()) == ".docx" || strtolower($archivo->getExtension()) == ".pdf") {
                                    ?>
                                    <div class="archivo"><a target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>"><img src="../img/ficheroicon.png"></a></div>
                                <?php } ?>

                                <?php
                                if (strtolower($archivo->getExtension()) == ".avi" || strtolower($archivo->getExtension()) == ".mp4") {
                                    ?>
                                    <div class="archivo"><a target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>"><img src="../img/videoicon.png"></a></div>
                                <?php } ?>

                                <?php
                                if (strtolower($archivo->getExtension()) == ".mp3" || strtolower($archivo->getExtension()) == ".wav") {
                                    ?>
                                    <div class="archivo"><a target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>"><img src="../img/soundicon.png"></a></div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </article>
                        <?php
                        $contador++;
                    }
                    $bd->closeConsulta();
                    ?>
                
                <?php if (count($posts) > 0) {
                    ?>
                    <div class="div-cargar" id="mas">
                        <button class="boton-cargar" onclick="javascript:cargarMeGusta('<?php echo $login; ?>');">Cargar más</button>
                    </div>
                <?php } ?>
            </section>
    </body>
</html>
<?php $bd->closeConexion(); ?>