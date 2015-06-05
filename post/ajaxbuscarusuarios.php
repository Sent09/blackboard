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
    $resultado .= "<div class='div-usuario'>".
"<div class='div-foto'>".
"<img src='../archivos/".$usuario->getUrlfoto()."'>".
"</div>".
"<div class='nombre-poster'>".
"<a href='verusuario.php?login=".$usuario->getLogin()."'>".$usuario->getNombre() . " " . $usuario->getApellidos()."</a>".
"</div>".
"</div>";
    
    
    
}
if(count($usuarios) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $resultado .= "<div class='div-cargar' id='mas' >".
            "<button class='boton-cargar' onclick=javascript:cargarUsuarios('".$value."')>Cargar más</button>".
            "</div>";
}
echo $resultado;

$bd->closeConsulta();