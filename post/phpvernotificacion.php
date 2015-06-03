<?php
require '../require/comun.php';
$bd = new BaseDatos();
$loginseguido = Leer::get("login");
$user = $sesion->getUsuario();
$login = $user->getLogin();
$modeloNotificaciones = new ModeloNotificaciones($bd);
$modeloNotificaciones->notificacionA0($login, $loginseguido);

header("Location: verusuario.php?login=$loginseguido");
$bd->closeConexion();