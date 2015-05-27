<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::get("value");
if (!isset($_SESSION["cantidadcargadas"])) $_SESSION["cantidadcargadas"]=10;
$modeloNotificaciones = new ModeloNotificaciones($bd);
$parametros["loginusuario"] = $login;
$condicion = "loginusuario=:loginusuario";
$notificaciones=$modeloNotificaciones->getListScroll($_SESSION["cantidadcargadas"], 10, $condicion, $parametros);
$resultado = "";
foreach ($notificaciones as $key => $notificacion) {
    $modeloUsuario = new ModeloUsuario($bd);
    $usuario = $modeloUsuario->get($notificacion->getLoginusuarioseguido());
    $resultado .= "<a href=verusuario.php?login=".$usuario->getLogin()." > ".$usuario->getNombre()." ".$usuario->getApellidos()."</a><small>".$usuario->getLogin()."</small></br>";
}
if(count($notificaciones) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $resultado .= "<input type='button' id='mas' onclick=javascript:cargarSiguiendo('$login'); value='Cargar más'>";
}
echo $resultado;