<?php
require '../require/comun.php';
$idpost = Leer::get("idpost");
$bd = new BaseDatos();
$modeloPost = new ModeloPost($bd);
$post = new Post($idpost);
$postBuscado = $modeloPost->get($idpost);
$usuario = $sesion->getUsuario();
if($postBuscado->getLogin() == $usuario->getLogin()){
    $modeloArchivos = new ModeloArchivospost($bd);
    $arrayArchivos = $modeloArchivos->getListTotal($idpost);
    foreach ($arrayArchivos as $key => $archivo) {
        $url = $archivo->getUrl();
        unlink("../archivos/$url");
        $modeloArchivos->delete($archivo);
    }
    $modeloPost2 = new ModeloPost($bd);
    $modeloPost2->delete($postBuscado);
}else{
    header("Location: ../index.php");
}
