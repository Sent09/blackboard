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
    $resultado .= "<div class='div-usuario'>".
    "<div class='div-foto'>".
    "<img src='../archivos/".$usuario->getUrlfoto()."' />".
    "</div>".
    "<div class='nombre-poster'>".
    "<a href='verusuario.php?login=".$usuario->getLogin()."'>".$usuario->getNombre() . " " . $usuario->getApellidos()."</a>".
    "</div>".
    "</div>";
    
}
if(count($notificaciones) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $resultado .= "<div class='div-cargar' id='mas'>".
    "<button class='boton-cargar' id='mas' onclick=javascript:cargarSiguiendo('".$login."')>Cargar más</button>".
    "</div>";
}
echo $resultado;

$bd->closeConsulta();