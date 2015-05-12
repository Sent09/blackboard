<?php
require '../require/comun.php';
$login = Leer::get("loginusuario");
$idpost = Leer::get("idpost");
$bd = new BaseDatos();
$modelo = new ModeloMegusta($bd);
$gusta = new Megusta($login, $idpost);

$modeloPost = new ModeloPost($bd);
$post = $modeloPost->get($idpost);

$cantidad = $modelo->count($gusta);
if($cantidad==0){
    $modelo->meGusta($gusta);
    $post->setGusta($post->getGusta()+1);
    $r = "No me gusta";
}else{
    $modelo->yaNoMeGusta($gusta);
    $post->setGusta($post->getGusta()-1);
    $r = "Me gusta";
}
$modeloPost->edit($post);
echo $r;
$bd->closeConexion();