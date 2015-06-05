<?php
/**
 * Muestra los 10 siguientes posts que ha puesto el usuario junto con sus
 * archivos y la cantidad de me gusta que tienen los posts.
 */
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
    
    $resultado .= "<article class='post'>".
        "<a href='phpborrarpost.php?idpost=".$post->getIdpost()."'><img src='../img/close-circled.png' class='borrarpost'></a>".
        "<div class='bloq-inf-post'>".
        "<div class='post-body'>".
        "<div class='fecha-post'>".
        "<a href='detallespost.php?id=".$post->getIdpost()."'>".$post->getFechapost()."</a>".
        "</div>".
        "<div class='mensaje-post'>".$post->getDescripcion().
        "</div>".
        "<div class='div-megusta'>".
        "<img src='../img/megusta.png'>".$post->getGusta().
        "</div>".
        "</div>".
        "<div class='archivos-box'>";
        foreach ($archivos as $key => $archivo) {
            if (strtolower($archivo->getExtension()) == ".jpg" || strtolower($archivo->getExtension()) == ".png" || strtolower($archivo->getExtension()) == ".gif" || strtolower($archivo->getExtension()) == ".jpeg") {
                $resultado .= "<div class='archivo'><a target='_blank' href='../archivos/".$archivo->getUrl()."'><img src='../img/imgicon.png'></a></div>";
            }
            if (strtolower($archivo->getExtension()) == ".doc" || strtolower($archivo->getExtension()) == ".docx" || strtolower($archivo->getExtension()) == ".pdf") {
                $resultado .= "<div class='archivo'><a target='_blank' href='../archivos/".$archivo->getUrl()."'><img src='../img/ficheroicon.png'></a></div>";
            }
            if (strtolower($archivo->getExtension()) == ".avi" || strtolower($archivo->getExtension()) == ".mp4") {
                $resultado .= "<div class='archivo'><a target='_blank' href='../archivos/".$archivo->getUrl()."'><img src='../img/videoicon.png'></a></div>";
            }
            if (strtolower($archivo->getExtension()) == ".mp3" || strtolower($archivo->getExtension()) == ".wav") {
                $resultado .= "<div class='archivo'><a target='_blank' href='../archivos/".$archivo->getUrl()."'><img src='../img/soundicon.png'></a></div>";
            }
        }
        $resultado .= "</div></div></article>";

}
if(count($posts) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $resultado .= "<div class='div-cargar' id='mas'>".
    "<button class='boton-cargar' onclick=javascript:cargarMisPosts('".$login."')>Cargar más</button>".
    "</div>";
}
echo $resultado;

$bd->closeConsulta();