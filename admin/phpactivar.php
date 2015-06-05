<?php 
/**
 * Activa un usuario de forma manual.
 */
    require '../require/comun.php';
    $sesion->administrador("../index.php");
    $bd = new BaseDatos();
    $login = Leer::get("login");
    $modeloUsuarios = new ModeloUsuario($bd);
    $usuario = $modeloUsuarios->get($login);
    $usuario->setIsactivo("1");
    $modeloUsuarios->edit($usuario, $login);
    
    header("Location: index.php");

