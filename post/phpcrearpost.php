<?php
/**
 * Crea el post con el texto correspondiente y subiendo todos los archivos.
 * Tras esto, se notifica a todos los usuarios que siguen al usuario creador
 * del post.
 */
require '../require/comun.php';
$mensaje = Leer::post("mensaje");
if(!empty($mensaje) && strlen($mensaje) < 201){
$usuario = $sesion->getUsuario();
$baseDatos = new BaseDatos();
$modelo = new ModeloPost($baseDatos);
$post = new Post(null, $mensaje, 0, null, $usuario->getLogin());
$modelo->add($post);
$postinsertado = $baseDatos->getAutonumerico();
$subir = new Subir("archivos");
$nombres = $subir->subir();
$modeloNotificar = new ModeloNotificaciones($baseDatos);
$modeloNotificar->notificar($usuario->getLogin());
foreach($nombres as $key => $urlfoto) {
    $modeloArchivo = new ModeloArchivospost($baseDatos);
    $extension = substr($urlfoto, strpos($urlfoto, "."));
    $archivo = new Archivospost(null, $urlfoto, $extension, $postinsertado);
    $modeloArchivo->add($archivo);
}
$baseDatos->closeConexion();
}
header("Location: ../index.php");

