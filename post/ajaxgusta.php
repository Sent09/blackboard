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
    $r = '<img src="img/megusta.png" />';
}else{
    $modelo->yaNoMeGusta($gusta);
    $post->setGusta($post->getGusta()-1);
    $r = '<img src="img/nomegusta.png" />';
}
$modeloPost->edit($post);
echo $r;
$bd->closeConexion();