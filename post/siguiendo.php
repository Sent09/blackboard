<?php
require '../require/comun.php';
$sesion->autentificado("../index.php");
unset($_SESSION["cantidadcargadas"]);
$bd = new BaseDatos();
$login = $sesion->getUsuario()->getLogin();
$modeloNotificaciones = new ModeloNotificaciones($bd);
$parametros["loginusuario"] = $login;
$condicion = "loginusuario=:loginusuario";
$notificaciones = $modeloNotificaciones->getListScroll(0, 10, $condicion, $parametros);
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
                    <form id="form-buscar" action="javascript:enviar(this.buscar)" name="buscar" method="post">
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
                        <form id="form-buscar" action="javascript:enviar2(this.buscar2)" name="buscar2" method="post">
                            <input type="search" placeholder="Buscar" id="busqueda" name="texto">
                        </form>
                    </div>
                </div>
            </aside>
            <section class="siguiendo2">
                <div class="titulo-estandar">Siguiendo</div>
                <div class="siguiendo-div" id="lista_posts">
                <?php if (count($notificaciones) == 0) { ?>
                    <h2>No hay usuarios</h2>
                    <?php
                } foreach ($notificaciones as $key => $notificacion) {
                    $modeloUsuario = new ModeloUsuario($bd);
                    $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
                    ?>
                        <div class="div-usuario">
                            <div class="div-foto">
                                <img src="../archivos/<?php echo $usuario->getUrlfoto(); ?>" />
                            </div>
                            <div class="nombre-poster">
                                <a href="verusuario.php?login=<?php echo $usuario->getLogin(); ?>"><?php echo $usuario->getNombre() . " " . $usuario->getApellidos(); ?></a>
                            </div>
                        </div>
                    <?php
                }
                ?>
                </div>
                <?php
                if (count($notificaciones) > 0) {
                    ?>
                    <div clas="div-cargar">
                        <button class="boton-cargar" id="mas" onclick="javascript:cargarSiguiendo('<?php echo $login; ?>');">Cargar más</button>
                    </div>
                <?php } ?>
            </section>
        </div>
    </body>
</html>
