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
        <title>Blackboard</title>
        <script src="../js/js.js"></script>
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
                <div clas="post">
                    <div class="bloq-sup-post">
                        <div class="div-foto">
                            <img src="../archivos/<?php echo $usuario->getUrlfoto(); ?>">
                        </div>
                        <div class="nombre-poster">
                            <a href="verusuario.php?login=<?php echo $post->getLogin(); ?>"><?php echo $usuario->getNombre() . " " . $usuario->getApellidos(); ?></a>
                        </div>
                    </div>
                    <div class="post-body">
                        <div class="fecha-post">
                            <?php echo $post->getFechapost(); ?>
                        </div>
                        <div class="mensaje-post">
                            <?php echo $post->getDescripcion(); ?>
                        </div>
                        <div class="div-megusta">
                            Me gusta: <?php echo $post->getGusta(); ?>
                        </div>
                        <div>
                            <?php if ($countmegusta > 0) { ?>
                                <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $id; ?>')">No me gusta</a>
                            <?php } else { ?>
                                <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $id; ?>')">Me gusta</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="archivos-box">
                        <?php
                        $modeloArchivo = new ModeloArchivospost($bd);
                        $archivos = $modeloArchivo->getListTotal($id);
                        ?>
                        <?php foreach ($archivos as $key => $archivo) { ?>
                            <a style="color:red;" target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
                        <?php } $bd->closeConsulta(); ?>
                    </div>
                </div>
            </section>
    </body>
</html>
