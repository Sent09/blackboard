<?php
/**
 * Devuelve los 10 siguientes posts que devuelve un join de todos los posts de los
 * la gente que sigue el usuario.
 */
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::get("value");
if (!isset($_SESSION["cantidadcargadas"])) $_SESSION["cantidadcargadas"]=10;
if (!isset($_SESSION["contador"])) $_SESSION["contador"]=10;
$modeloPost = new ModeloPost($bd);
$posts=$modeloPost->postYoSigoScroll($_SESSION["cantidadcargadas"], 10, $login);
$resultado = "";
$contador = $_SESSION["contador"];
foreach ($posts as $key => $post) {
    $idpost = $post->getIdpost();
    $modeloArchivo = new ModeloArchivospost($bd);
    $archivos = $modeloArchivo->getListTotal($idpost);

    $megusta = new Megusta($login, $idpost);
    $modelomegusta = new ModeloMegusta($bd);
    $countmegusta = $modelomegusta->count($megusta);
    $idelemento = "seguir".$contador;
    $modelousuariopost = new ModeloUsuario($bd);
    $usuariopost = $modelousuariopost->get($post->getLogin());
    
    //Contenido del post
    $resultado .= "<article class='post'>".
            "<div class='bloq-sup-post'>".
            "<div class='div-foto'><img src='archivos/".$usuariopost->getUrlfoto()."'></div>".
            "<div class='nombre-poster'><a href='post/verusuario.php?login=".$post->getLogin()."'>".$usuariopost->getNombre()." ".$usuariopost->getApellidos()."</a></div>".
            "</div>".
            "<div class='bloq-inf-post'>".
            "<div class='post-body'>".
            "<div class='fecha-post'><a href='post/detallespost.php?id=".$post->getIdpost()."'>".$post->getFechapost()."</a></div>".
            "<div class='mensaje-post'>".
            $post->getDescripcion()."<br>".
            $post->getGusta();
    $numerogusta = 1;
    if($countmegusta>0){
       $resultado .= "<a style='color:blue;' id='".$idelemento."' href=javascript:gustaindex('".$idelemento."','".$login."','".$idpost."','".$numerogusta."')><img src='img/megusta.png' /></a>";
    }else{
       $resultado .= "<a style='color:blue;' id='".$idelemento."' href=javascript:gustaindex('".$idelemento."','".$login."','".$idpost."','".$numerogusta."')><img src='img/nomegusta.png' /></a>";
    }
    $resultado .= "</div>".
            "</div>".
            "<div class='archivos-box'>";
    
    foreach ($archivos as $key => $archivo) { 
        if(strtolower($archivo->getExtension()) == ".jpg" || strtolower($archivo->getExtension()) == ".png" || strtolower($archivo->getExtension()) == ".gif" || strtolower($archivo->getExtension()) == ".jpeg" ){
            $resultado .= "<div class='archivo'><a target='_blank' href='archivos/".$archivo->getUrl()."'><img src='img/imgicon.png'></a></div>";
        }                                    
        if(strtolower($archivo->getExtension()) == ".doc" || strtolower($archivo->getExtension()) == ".docx" || strtolower($archivo->getExtension()) == ".pdf"){
            $resultado .= "<div class='archivo'><a target='_blank' href='archivos/".$archivo->getUrl()."'><img src='img/ficheroicon.png'></a></div>";
        }
        if(strtolower($archivo->getExtension()) == ".avi" || strtolower($archivo->getExtension()) == ".mp4"){
            $resultado .= "<div class='archivo'><a target='_blank' href='archivos/".$archivo->getUrl()."'><img src='img/videoicon.png'></a></div>";
        }
        if(strtolower($archivo->getExtension()) == ".mp3" || strtolower($archivo->getExtension()) == ".wav"){
            $resultado .= "<div class='archivo'><a target='_blank' href='archivos/".$archivo->getUrl()."'><img src='img/soundicon.png'></a></div>";
        }                            
    }
    
    $resultado .= "</div></div></article>";
            
    $contador++;       
}
if(count($posts) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $_SESSION["contador"]=$contador;
    $resultado .= "<button id='mas' onclick=javascript:cargarIndex('".$login."') class='boton'>Cargar más</button>";
}



echo $resultado;

$bd->closeConsulta();