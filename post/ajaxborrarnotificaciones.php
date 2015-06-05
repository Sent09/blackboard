<?php
/**
 * Pone todas las notificaciones a 0. Esto es utilizado para usuarios que no quieren
 * tener todas las notificaciones a la derecha en el index.
 */
require '../require/comun.php';
$bd = new BaseDatos();
unset($_SESSION["notificaciones"]);
$user = $sesion->getUsuario();
$login = $user->getLogin();
$modeloNotificaciones = new ModeloNotificaciones($bd);
$modeloNotificaciones->notificacionA0Total($login);

$bd->closeConexion();