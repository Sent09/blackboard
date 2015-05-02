<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$claveConfirmada = Leer::post("clave2");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");

if($claveConfirmada != $clave){
    header("Location: viewalta.php?r=-1");
    exit();
}
$baseDatos = new BaseDatos();
$modelo = new ModeloUsuario($baseDatos);
$usuario = new Usuario($login, $clave, $nombre, $apellidos, $email);
$r = $modelo->add($usuario);
if($r==1){
    $id = md5($email.Configuracion::PEZARANA.$login);
    $enlace = Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id&login=$login");
    $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Alta en web", $enlace);
    header("Location: bienvenido.php?r=1");
    exit();
}else{
    header("Location: viewalta.php?r=-1");
} 