<?php
/**
 * Si los datos son correctos se cambia la contraseña.
 */
require '../require/comun.php';
$id = Leer::post("id");
$login = Leer::post("login");
$clave1 = Leer::post("clave1");
$clave2 = Leer::post("clave2");
$baseDatos = new BaseDatos();
$modelo = new ModeloUsuario($baseDatos);
$usuario = $modelo->get($login);
if($usuario->getEmail()!=""){
    $id2 = md5($usuario->getEmail().Configuracion::PEZARANA.$usuario->getLogin());
    if($id!=$id2){
        header("Location: viewolvido.php?r=-1");
    }else{
        if($clave1==$clave2){
            $claveCodificada = sha1($clave1);
            $usuario->setClave($claveCodificada);
            $resultado = $modelo->edit($usuario, $login);
            header("Location: viewolvido.php?r=$resultado");
        }else{
            header("Location: viewolvido.php?r=-1");
        }
    }
}else{
    header("Location: viewolvido.php?r=-1");
}