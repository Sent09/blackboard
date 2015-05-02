<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->login($login, $clave);
if($usuario == false){
    $sesion->cerrar();
    header("Location: ../index.php?r=-1");
}else{
    $sesion->setUsuario($usuario, $bd);
    header("Location: ../index.php ");
}