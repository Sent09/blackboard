<?php
require '../require/comun.php';
$origen = Leer::post("origen");
$destino = Leer::post("destino");
$clave = Leer::post("clave");
$asunto = Leer::post("asunto");
$mensaje = Leer::post("mensaje");

$r = Correo::enviarGmail($origen, $destino, $clave, $asunto, $mensaje);
echo $r;