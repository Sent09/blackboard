<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::get("value");
$boton = Leer::get("boton");
$modeloNotificaciones = new ModeloNotificaciones($bd);
if (!isset($_SESSION["notificaciones"]) && $boton == 2 ){
    $_SESSION["notificaciones"]=0;
    $parametros["login"] = $login;
    $valor = "loginusuario=:login AND nuevosposts > 0";
    $notificaciones = $modeloNotificaciones->getListScroll($_SESSION["notificaciones"]+10,10,$valor,$parametros);
    if(count($notificaciones) == 0){
        $resultado = "nada";
    }else{
        $resultado = "";
        $_SESSION["notificaciones"] = $_SESSION["notificaciones"] + 10;
        foreach ($notificaciones as $key => $notificacion) {
            $modeloUsuario = new ModeloUsuario($bd);
            $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
            $resultado .= $usuario->getNombre()." ".$usuario->getApellidos()." ".$notificacion->getNuevosposts();
        }
    }
}elseif(isset($_SESSION["notificaciones"]) && $_SESSION["notificaciones"] != 0 && $boton == 1) {
    $_SESSION["notificaciones"] = $_SESSION["notificaciones"] - 10;
    $parametros["login"] = $login;
    $valor = "loginusuario=:login AND nuevosposts > 0";
    $notificaciones = $modeloNotificaciones->getListScroll($_SESSION["notificaciones"],10,$valor,$parametros);
    $resultado = "";
    foreach ($notificaciones as $key => $notificacion) {
        $modeloUsuario = new ModeloUsuario($bd);
        $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
        $resultado .= $usuario->getNombre()." ".$usuario->getApellidos()." ".$notificacion->getNuevosposts();
    }
}elseif($boton == 2) {
    $parametros["login"] = $login;
    $valor = "loginusuario=:login AND nuevosposts > 0";
    $notificaciones = $modeloNotificaciones->getListScroll($_SESSION["notificaciones"]+10,10,$valor,$parametros);
    if(count($notificaciones) == 0){
        $resultado = "nada";
    }else{
        $resultado = "";
        $_SESSION["notificaciones"] = $_SESSION["notificaciones"] + 10;
        foreach ($notificaciones as $key => $notificacion) {
            $modeloUsuario = new ModeloUsuario($bd);
            $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
            $resultado .= $usuario->getNombre()." ".$usuario->getApellidos()." ".$notificacion->getNuevosposts();
        }
    }
}else{
    $resultado = "nada";
}

echo $resultado;