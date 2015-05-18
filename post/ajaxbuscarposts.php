<?php
require '../require/comun.php';
$bd = new BaseDatos();
$value = Leer::get("value");
if (!isset($_SESSION["cantidadcargadas"])) $_SESSION["cantidadcargadas"]=10;
$modeloPost = new ModeloPost($bd);
$parametros["value"] = "%$value%";
$condicion = "(descripcion like :value)";
$posts=$modeloPost->getListScroll($_SESSION["cantidadcargadas"], 10, $condicion, $parametros);
$resultado = "";
foreach ($posts as $key => $post) {
    $resultado .= $post->getDescripcion()."</br>";
}
if(count($posts) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $resultado .= "<input type='button' id='mas' onclick=javascript:cargarPosts('$value'); value='Cargar más'>";
}
echo $resultado;