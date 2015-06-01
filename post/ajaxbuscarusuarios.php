<?php
require '../require/comun.php';
$bd = new BaseDatos();
$value = Leer::get("value");
if (!isset($_SESSION["cantidadcargadas"])) $_SESSION["cantidadcargadas"]=10;
$modeloUsuario = new ModeloUsuario($bd);
$parametros["value"] = "%$value%";
$condicion = "(login like :value or nombre like :value or apellidos like :value)";
$usuarios=$modeloUsuario->getListScroll($_SESSION["cantidadcargadas"], 10, $condicion, $parametros);
$resultado = "";
foreach ($usuarios as $key => $usuario) {
    $resultado .= "<a href=verusuario.php?login=".$usuario->getLogin()." > ".$usuario->getNombre()." ".$usuario->getApellidos()."</a><small>".$usuario->getLogin()."</small></br>";
}
if(count($usuarios) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $resultado .= "<input type='button' id='mas' onclick=javascript:cargarUsuarios('$value'); value='Cargar más'>";
}
echo $resultado;

$bd->closeConsulta();