<?php
/**
 * Si los datos son correctos se hace un login y en la sesión se introduce
 * el objeto usuario.
 */
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