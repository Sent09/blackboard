<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::get("value");
if (!isset($_SESSION["cantidadcargadas"])) $_SESSION["cantidadcargadas"]=10;
if (!isset($_SESSION["contador"])) $_SESSION["contador"]=10;
$modeloPost = new ModeloPost($bd);
$posts=$modeloPost->postMeGustanScroll($_SESSION["cantidadcargadas"], 10, $login);
$resultado = "";
$contador = $_SESSION["contador"];
foreach ($posts as $key => $post) {
    $idpost = $post->getIdpost();
    $modeloArchivo = new ModeloArchivospost($bd);
    $archivos = $modeloArchivo->getListTotal($idpost);

    $megusta = new Megusta($login, $idpost);
    $modelomegusta = new ModeloMegusta($bd);
    $countmegusta = $modelomegusta->count($megusta);
    $idelemento = "gusta".$contador;
    $modelousuariopost = new ModeloUsuario($bd);
    $usuariopost = $modelousuariopost->get($post->getLogin());
    
    $resultado .= 
        "<article class='post'>".
        "<div class='bloq-sup-post'>".
        "<div class='div-foto'>".
        "<img width='30' src='../archivos/".$usuariopost->getUrlfoto()."'>".
        "</div>".
        "<div class='nombre-poster'>".
        "<a href='verusuario.php?login=".$post->getLogin()."'>".$usuariopost->getNombre() . " " . $usuariopost->getApellidos()."</a>".
        "</div>".
        "</div>".
        "<div class='bloq-inf-post'>".
        "<div class='post-body'>".
        "<div class='fecha-post'>".
        "<a href='detallespost.php?id=".$post->getIdpost()."'>".$post->getFechapost()."</a>".
        "</div>".
        "<div class='mensaje-post'>".$post->getDescripcion().
        "</div>".
        "<div class='div-megusta'>".$post->getGusta();
        $numerogusta = 2;
        if ($countmegusta > 0) {
            $resultado .= "<a class='megusta-numero' id='$idelemento' href=javascript:gusta('".$idelemento."','".$login."','".$idpost."','".$numerogusta."')><img src='../img/megusta.png' /></a>";
        } else {
            $resultado .= "<a class='megusta-icono' id='".$idelemento."' href=javascript:gusta('".$idelemento."','".$login."','".$idpost."','".$numerogusta."')><img src='../img/nomegusta.png' /></a>";
        }
        $resultado .= "</div></div></div>".
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
        $resultado .= "</div></article>";
    $contador++;
}
if(count($posts) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $_SESSION["contador"]=$contador;
    $resultado .= "<div class='div-cargar' id='mas'>".
    "<button class='boton-cargar'  onclick=javascript:cargarMeGusta('".$login."')>Cargar más</button>".
    "</div>";
}

echo $resultado;

$bd->closeConsulta();