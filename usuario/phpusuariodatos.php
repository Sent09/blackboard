<?php
require_once '../require/comun.php';
$login = Leer::post("login");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->get($login);
$usuario->setNombre($nombre);
$usuario->setApellidos($apellidos);
$subir = new Subir("foto");
$nombres = $subir->subir();
foreach($nombres as $key => $urlfoto) {
    if($usuario->getUrlfoto() != "default.png"){
        unlink("../archivos/".$usuario->getUrlfoto());
    }
    $usuario->setUrlfoto($urlfoto);
}
if($usuario->getEmail() != $email){
    $usuario->setEmail($email);
    $usuario->setIsactivo(0);
    $resultado = $modelo->edit($usuario, $login);
    $id = md5($email.Configuracion::PEZARANA.$login);
    $enlace = Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id&login=$login");
    $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Reactivar cuenta", $enlace);
    $sesion->cerrar();
    header("Location: ../index.php?r=2");
    exit();
}
$resultado = $modelo->edit($usuario, $login);
$sesion->setUsuario($usuario, $bd);
header("Location: viewperfil.php?r=$resultado");


