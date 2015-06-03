<?php
    require '../require/comun.php';
    $sesion->autentificado("../index.php");
    unset($_SESSION["cantidadcargadas"]);
    unset($_SESSION["contador"]);
    $bd = new BaseDatos();
    $value = Leer::get("value");
    $modeloPost = new ModeloPost($bd);
    $usuario = $sesion->getUsuario();
    $login = $usuario->getLogin();
    $parametros["value"] = "%$value%";
    $condicion = "(descripcion like :value)";
    $posts=$modeloPost->getList(0, 10, $condicion, $parametros);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Blackboard</title>
        <script type="text/javascript" src="../js/javascriptscroll.js"></script>
        <script type="text/javascript" src="../js/js.js"></script>

    </head>
    <body>
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="megusta.php">Me Gusta</a></li>
                <li><a href="mispost.php">Mis post</a></li>
                <li><a href="../usuario/viewperfil.php">Panel de administración</a></li>
                <li><a href="../usuario/phpcerrarsesion.php">Desloguear</a></li>
                <li>
                    <form action="javascript:enviarPost(this.buscar)" name="buscar" method="post">
                        <input type="text" placeholder="Buscar" name="texto">
                    </form>
                </li>
            </ul>
        </nav>
        <a href="buscaruser.php?value=<?php echo $value; ?>">Buscar usuarios</a>
        <div id="lista_posts">
            <?php 
            if(count($posts) == 0) echo "No hay coincidencias"; 
            $contador = 0;
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
        ?>
        <div>
            <img width="30" src="../archivos/<?php echo $usuariopost->getUrlfoto(); ?>">
            <a href="verusuario.php?login=<?php echo $post->getLogin(); ?>"><?php echo $usuariopost->getNombre()." ".$usuariopost->getApellidos(); ?></a>
            <a href="detallespost.php?id=<?php echo $post->getIdpost(); ?>"><?php echo $post->getFechapost(); ?></a><br>
            <?php echo $post->getDescripcion(); ?><br>
            <?php echo $post->getGusta(); ?>
            <?php if($countmegusta>0){ ?>
                <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')">No me gusta</a>
            <?php }else{ ?>
                <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gusta('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')">Me gusta</a>
            <?php } ?>
        </div>
        <?php foreach ($archivos as $key => $archivo) { ?>
            <a style="color:red;" target="_blank" href="../archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
        <?php } ?>
        <?php
        $contador++;
            } 
            if(count($posts) > 0){ 
            ?>
                <input type="button" id="mas" onclick="javascript:cargarPosts('<?php echo $value; ?>');" value="Cargar más">
            <?php } $bd->closeConsulta();?>
        </div>
    </body>
</html>
