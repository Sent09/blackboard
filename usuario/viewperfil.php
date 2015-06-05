<!DOCTYPE html>
<?php
/**
 * Pantalla para ver los datos del perfil de usuario con 2 formularios utilizados
 * para cambiar datos de la cuenta del usuario.
 */
require '../require/comun.php';
if (!$sesion->get("__usuario") instanceof Usuario) {
    header("Location: index.php");
    exit();
}
$fila = $sesion->get("__usuario");
$login = $fila->getLogin();
$clave = $fila->getClave();
$nombre = $fila->getNombre();
$apellidos = $fila->getApellidos();
$email = $fila->getEmail();
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <title>Blackboard</title>
        <script type="text/javascript" src="../js/js.js"></script>
        <script type="text/javascript" src="../js/javascriptscroll.js"></script>
        <script type="text/javascript" src="../js/panelusuario.js"></script>
        <link rel="stylesheet" type="text/css" href="../styles/styles2.css">
    </head>
    <body>
        <header>
            <div class="div-logo">
                <a href="../index.php"><img src="../img/logoprincipalm.png"/></a>
                <div class="links">
                    <div><a href="../post/megusta.php"><span>h</span>Me gustan</a></div>
                    <div><a href="../post/mispost.php"><span>Y</span>Mis posts</a></div>
                </div>
            </div>
            <nav>
                <div class="search">
                    <div class="userpanel" id="primary_nav_wrap">
                        <ul>
                            <li>
                                <a href="#"><span>A</span></a>
                                <ul>
                                    <li><a href="viewperfil.php"><span>C</span>Panel de control</a></li>
                                    <li><a href="phpcerrarsesion.php"><span>e</span>Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <form id="form-buscar" action="javascript:enviarPerfil2(this.buscar)" name="buscar" method="post">
                        <input type="search" placeholder="Buscar" id="busqueda" name="texto">
                    </form>
                </div>
            </nav>
        </header>
        <aside id="manageinfo" class="manageinfo asideusuario">
                <div class="userinfo">
                    <div class="linksm">
                        <div><a href="../post/megusta.php"><span>h</span>Me gustan</a></div>
                        <div><a href="../post/mispost.php"><span>Y</span>Mis posts</a></div>
                    </div>
                </div>
                <div class="searchm">
                    <div class="userpanel" id="primary_nav_wrap">
                        <ul>
                            <li>
                                <a href="#"><span>A</span></a>
                                <ul>
                                    <li><a href="viewperfil.php"><span>C</span>Panel de control</a></li>
                                    <li><a href="phpcerrarsesion.php"><span>e</span>Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <form id="form-buscar" action="javascript:enviarPerfil(this.buscar2)" name="buscar2" method="post">
                        <input type="search" placeholder="Buscar" id="busqueda" name="texto">
                    </form>
                </div>
        </aside>
        <div class="contenedor-panelusuario">
            <div class="titulouser">Actualizar datos de usuario</div>
            <div class="div-registro">
                <div class="registro">
                    <form id="form-entrar" action="phpusuariodatos.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="login" value="<?php echo $login; ?>"/>
                        <div class="campo">
                            <input type="text" value="<?php echo $nombre; ?>" id="nombre" placeholder="Nombre" name="nombre" value="" required/>
                        </div>
                        <div class="campo">
                            <input type="text" value="<?php echo $apellidos; ?>" id="apellidos" placeholder="Apellidos" name="apellidos" value="" required/>
                        </div>
                        <div class="campo">
                            <input type="text" value="<?php echo $email; ?>" id="correo" placeholder="E-mail" name="email" value="" required/>
                        </div>
                        <div class="agregarfoto">
                            <span id="seleccionados">Cambiar foto...</span>
                            <input id="archivos" onchange="javascript:cambiar(this)" type="file" name="foto[]" />
                        </div>
                        <input type="submit" class="btn-login" value="Actualizar"/>
                    </form>
                </div>
            </div>
            <div class="titulouser">Cambiar clave de acceso</div>
            <div class="div-registro">
                <div class="registro">
                    <form class="form-registro" action="phpusuarioclave.php" method="POST">
                        <input type="hidden" name="login" value="<?php echo $login; ?>"/>
                        <div class="campo">
                            <input type="password"  id="password" name="clavevieja" placeholder="Clave anterior" value="" required/>
                        </div>
                        <div class="campo">
                            <input type="password"  id="password2" name="clave1" placeholder="Nueva clave" value="" required/>
                        </div>
                        <div class="campo">
                            <input type="password" id="repeat" class="form-control"  name="clave2" placeholder="Repite la clave" value="" required/>
                        </div>
                        <input type="submit" class="btn-login" value="Cambiar"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
