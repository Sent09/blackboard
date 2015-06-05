<?php
/**
 * Esta pantalla es para hacer el registro de usuario.
 */
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$claveConfirmada = Leer::post("clave2");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
if(empty($login) || empty($clave) || empty($claveConfirmada) || empty($nombre) || empty($apellidos) || empty($email)){
    header("Location: viewerror.php?r=3");
    exit();
}
if($claveConfirmada != $clave){
    header("Location: viewerror.php?r=2");
    exit();
}
$baseDatos = new BaseDatos();
$modelo = new ModeloUsuario($baseDatos);
$usuario = new Usuario($login, $clave, $nombre, $apellidos, $email, null, 0, 0, 'usuario', null, "default.png");
$r = $modelo->add($usuario);
if($r==1){
    $id = md5($email.Configuracion::PEZARANA.$login);
    $enlace = Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id&login=$login");
    $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Alta en web", $enlace);
    header("Location: ../index.php?r=1");
    exit();
}else{
    header("Location: viewerror.php?r=1");
} 