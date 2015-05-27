<?php
require_once '../require/comun.php';
$claveVieja = Leer::post("clavevieja");
$login = Leer::post("login");
$clave1 = Leer::post("clave1");
$clave2 = Leer::post("clave2");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->get($login);
if(sha1($claveVieja)==$usuario->getClave() && $clave1 == $clave2){
    $claveCodificada = sha1($clave1);
    $usuario->setClave($claveCodificada);
    $resultado = $modelo->edit($usuario, $login);
    header("Location: viewperfil.php?r=$resultado");
}else{
    header("Location: viewperfil.php?r=-1");
}

