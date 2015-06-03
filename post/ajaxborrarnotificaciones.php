<?php
require '../require/comun.php';
$bd = new BaseDatos();
unset($_SESSION["notificaciones"]);
$user = $sesion->getUsuario();
$login = $user->getLogin();
$modeloNotificaciones = new ModeloNotificaciones($bd);
$modeloNotificaciones->notificacionA0Total($login);

$bd->closeConexion();