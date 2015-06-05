<?php
/**
 * Si el usuario no sigue al usuario que visita  pues lo empieza a seguir, en caso
 * contrario deja de seguirle.
 */
require '../require/comun.php';
$loginsesion = Leer::get("loginusuario");
$login = Leer::get("login");
$bd = new BaseDatos();
$modelo = new ModeloNotificaciones($bd);
$cantidad = $modelo->count("loginusuario='$loginsesion' AND loginusuarioseguido='$login'");
if($cantidad==0){
    $notificaciones = new Notificaciones(null, $loginsesion, $login, 0);
    $modelo->add($notificaciones);
    $r = "Siguiendo";
}else{
    $notificaciones = $modelo->getCondicion("loginusuario='$loginsesion' AND loginusuarioseguido='$login'");
    $modelo->delete($notificaciones);
    $r = "Seguir";
}
echo $r;
$bd->closeConexion();