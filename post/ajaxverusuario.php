<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::get("value");
if (!isset($_SESSION["cantidadcargadas"])) $_SESSION["cantidadcargadas"]=10;
if (!isset($_SESSION["contador"])) $_SESSION["contador"]=10;
$modeloPost = new ModeloPost($bd);
$posts=$modeloPost->getListScroll($_SESSION["cantidadcargadas"], 10, "login='$login'");
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
    
    $resultado .=  "<div>"."<img width='30' src='../archivos/".$usuariopost->getUrlfoto()."'/>".
            "<a href='verusuario.php?login=".$post->getLogin()."'>".$usuariopost->getNombre()." ".$usuariopost->getApellidos()."</a> ".
            "<a href='detallespost.php?id=".$post->getIdpost()."'>".$post->getFechapost()."</a></br>".
            $post->getDescripcion()."</br>".
            $post->getGusta();
    if($countmegusta>0){
        $resultado .= "<a style='color:blue;' id='$idelemento' href=javascript:gusta('$idelemento','$login','$idpost')>No me gusta</a>";
    }else{
        $resultado .= "<a style='color:blue;' id='$idelemento' href=javascript:gusta('$idelemento','$login','$idpost')>Me gusta</a>";
    }
    $resultado .= "</div>";
    
    foreach ($archivos as $key => $archivo) {
        $resultado .= "<a style='color:red;' target='_blank' href='archivos/".$archivo->getUrl()."'>archivico</a>";
    }
    $contador++;
}
if(count($posts) == 0){
    $resultado = "final";
}else{
    $_SESSION["cantidadcargadas"]+=10;
    $_SESSION["contador"]=$contador;
    $resultado .= "<input type='button' id='mas' onclick=javascript:cargarVerUsuario('$login'); value='Cargar más'>";
}

echo $resultado;

$bd->closeConsulta();