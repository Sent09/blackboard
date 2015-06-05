<?php 
/*
 * Se borra un usuario junto con sus posts, sus archivos, sus seguidores y los posts que le gustan.
 */
    require '../require/comun.php';
    $sesion->administrador("../index.php");
    $bd = new BaseDatos();
    $login = Leer::get("login");
    $modeloPost = new ModeloPost($bd);
    $posts = $modeloPost->getAll($login);
    $modeloArchivo = new ModeloArchivospost($bd);
    foreach ($posts as $key => $post) {
        $idpost = $post->getIdpost();        
        $archivos = $modeloArchivo->getListTotal($idpost);
        foreach ($archivos as $key => $archivo) {
            $url = $archivo->getUrl();
            unlink("../archivos/$url");
            $modeloArchivo->delete($archivo);
        }
    }
    $modeloPost->deleteByLogin($login);
    
    $modeloNotificaciones = new ModeloNotificaciones($bd);
    $modeloNotificaciones->deleteSeguidores($login);
    $modeloNotificaciones->deleteSiguiendo($login);
    
    $modeloMeGusta = new ModeloMegusta($bd);
    $modeloMeGusta->deleteByLogin($login);
    
    $modeloUsuarios = new ModeloUsuario($bd);
    $usuario = $modeloUsuarios->get($login);
    $modeloUsuarios->delete($usuario);
    
    header("Location: index.php");

