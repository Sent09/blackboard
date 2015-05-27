<?php
    require '../require/comun.php';
    $sesion->autentificado("../index.php");
    unset($_SESSION["cantidadcargadas"]);
    $bd = new BaseDatos();
    $value = Leer::get("value");
    $modeloPost = new ModeloPost($bd);
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
            foreach ($posts as $key => $post) {
            ?>

            <?php echo $post->getDescripcion(); ?></br>

            <?php
            } 
            if(count($posts) > 0){ 
            ?>
                <input type="button" id="mas" onclick="javascript:cargarPosts('<?php echo $value; ?>');" value="Cargar más">
            <?php } ?>
        </div>
    </body>
</html>
