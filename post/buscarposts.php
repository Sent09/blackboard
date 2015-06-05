<?php
require '../require/comun.php';
$sesion->autentificado("../index.php");
unset($_SESSION["cantidadcargadas"]);
unset($_SESSION["contador"]);
$bd = new BaseDatos();
$value = Leer::get("value");
$modeloPost = new ModeloPost($bd);
$usuario = $sesion->getUsuario();
$login = $usuario->getLogin();
$parametros["value"] = "%$value%";
$condicion = "(descripcion like :value)";
$posts = $modeloPost->getList(0, 10, $condicion, $parametros);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Blackboard</title>
        <script type="text/javascript" src="../js/javascriptscroll.js"></script>
        <script type="text/javascript" src="../js/js.js"></script>
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
                    <form id="form-buscar" action="javascript:enviarPost(this.buscar)" name="buscar" method="post">
                        <input type="search" placeholder="Buscar" id="busqueda" name="texto">
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
                        <form id="form-buscar" action="javascript:enviarPost2(this.buscar2)" name="buscar2" method="post">
                            <input type="search" placeholder="Buscar" id="busqueda" name="texto">
                        </form>
                    </div>
                </div>
            </aside>
            <section id="lista_posts">
                <div class="titulo-estandar">Resultado de la búsqueda de posts</div>
                <div class="siguiendo-div">
                    <span style="margin-right: 5px; text-align: center;">¿No has encontrado lo que querías? Prueba buscando</span><a href="buscaruser.php?value=<?php echo $value; ?>">usuarios</a>
                </div>
                <?php
                if (count($posts) == 0)
                    echo "No hay coincidencias";
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
                                    Me gusta: <?php echo $post->getGusta(); ?>
                                    <?php if ($countmegusta > 0) { ?>
                                        <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')">No me gusta</a>
                                    <?php } else { ?>
                                        <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')">Me gusta</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="archivos-box">
                                <?php foreach ($archivos as $key => $archivo) { ?>
                                    <a style="color:red;" target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        $contador++;
                    }
                    ?>
                </article>
                <?php
                if (count($posts) > 0) {
                    ?>
                <div class="div-cargar">
                    <button class="boton-cargar" id="mas" onclick="javascript:cargarPosts('<?php echo $value; ?>');">Cargar más</button>
                <?php } $bd->closeConsulta(); ?>
                </div>
            </section>
    </body>
</html>
