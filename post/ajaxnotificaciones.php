<?php
/**
 * Devuelve las notificaciones al usuario. Antes de esto se compreba
 * que la acción se pueda realizar.
 */
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::get("value");
$boton = Leer::get("boton");
$modeloNotificaciones = new ModeloNotificaciones($bd);
if (!isset($_SESSION["notificaciones"]) && $boton == 2) {
    $_SESSION["notificaciones"] = 0;
    $parametros["login"] = $login;
    $valor = "loginusuario=:login AND nuevosposts > 0";
    $notificaciones = $modeloNotificaciones->getListScroll($_SESSION["notificaciones"] + 10, 10, $valor, $parametros);
    if (count($notificaciones) == 0) {
        $resultado = "nada";
    } else {
        $resultado = "";
        $_SESSION["notificaciones"] = $_SESSION["notificaciones"] + 10;
        foreach ($notificaciones as $key => $notificacion) {
            $modeloUsuario = new ModeloUsuario($bd);
            $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
            $resultado .= "<div class='notificacion'>" .
                    "<div class='foto-not'><img src='archivos/" . $usuario->getUrlfoto() . "'></div>" .
                    "<a href='post/phpvernotificacion.php?login=" . $usuario->getLogin() . "'>" .
                    "<div class='texto-not'><span>" . $notificacion->getNuevosposts() . "</span> nuevas publicaciones de " . $usuario->getNombre() . " " . $usuario->getApellidos() . "</div>" .
                    "</a>" .
                    "</div>";
        }
    }
} elseif (isset($_SESSION["notificaciones"]) && $_SESSION["notificaciones"] != 0 && $boton == 1) {
    $_SESSION["notificaciones"] = $_SESSION["notificaciones"] - 10;
    $parametros["login"] = $login;
    $valor = "loginusuario=:login AND nuevosposts > 0";
    $notificaciones = $modeloNotificaciones->getListScroll($_SESSION["notificaciones"], 10, $valor, $parametros);
    $resultado = "";
    foreach ($notificaciones as $key => $notificacion) {
        $modeloUsuario = new ModeloUsuario($bd);
        $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
        $resultado .= "<div class='notificacion'>" .
                "<div class='foto-not'><img src='archivos/" . $usuario->getUrlfoto() . "'></div>" .
                "<a href='post/phpvernotificacion.php?login=" . $usuario->getLogin() . "'>" .
                "<div class='texto-not'><span>" . $notificacion->getNuevosposts() . "</span> nuevas publicaciones de " . $usuario->getNombre() . " " . $usuario->getApellidos() . "</div>" .
                "</a>" .
                "</div>";
    }
} elseif ($boton == 2) {
    $parametros["login"] = $login;
    $valor = "loginusuario=:login AND nuevosposts > 0";
    $notificaciones = $modeloNotificaciones->getListScroll($_SESSION["notificaciones"] + 10, 10, $valor, $parametros);
    if (count($notificaciones) == 0) {
        $resultado = "nada";
    } else {
        $resultado = "";
        $_SESSION["notificaciones"] = $_SESSION["notificaciones"] + 10;
        foreach ($notificaciones as $key => $notificacion) {
            $modeloUsuario = new ModeloUsuario($bd);
            $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
            $resultado .= "<div class='notificacion'>" .
                    "<div class='foto-not'><img src='archivos/" . $usuario->getUrlfoto() . "'></div>" .
                    "<a href='post/phpvernotificacion.php?login=" . $usuario->getLogin() . "'>" .
                    "<div class='texto-not'><span>" . $notificacion->getNuevosposts() . "</span> nuevas publicaciones de " . $usuario->getNombre() . " " . $usuario->getApellidos() . "</div>" .
                    "</a>" .
                    "</div>";
        }
    }
} else {
    $resultado = "nada";
}

echo $resultado;

$bd->closeConsulta();
