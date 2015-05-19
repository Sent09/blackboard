<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::get("value");
if (!isset($_SESSION["cantidadcargadas"])) $_SESSION["cantidadcargadas"]=10;
$modeloPost = new ModeloPost($bd);
$parametros["login"] = "$login";
$condicion = "login='$login'";
$posts=$modeloPost->getListScroll($_SESSION["cantidadcargadas"], 10, $condicion, $parametros);
$resultado = "";
foreach ($posts as $key => $post) {
    $idpost = $post->getIdpost();
    $modeloArchivo = new ModeloArchivospost($bd);
    $archivos = $modeloArchivo->getListTotal($idpost);
    
    $resultado .= "<div>".$post->getFechapost()."</br>".$post->getDescripcion().
            "</br>".$post->getGusta()."<a href='phpborrarpost.php?idpost=".$post->getIdpost()."'>Borrar</a></div>";
    foreach ($archivos as $key => $archivo) { 
         $resultado .= "<a style='color:red;' target='_blank' href='../archivos/".$archivo->getUrl()."'>archivico</a> ";
    }
}
if(count($posts) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $resultado .= "<input type='button' id='mas' onclick=javascript:cargarMisPosts('$login'); value='Cargar más'>";
}
echo $resultado;