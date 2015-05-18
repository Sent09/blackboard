<?php
    require '../require/comun.php';
    unset($_SESSION["cantidadcargadas"]);
    $bd = new BaseDatos();
    $value = Leer::get("value");
    $modeloUsuario = new ModeloUsuario($bd);
    $parametros["value"] = "%$value%";
    $condicion = "(login like :value or nombre like :value or apellidos like :value)";
    $usuarios=$modeloUsuario->getList(0, 10, $condicion, $parametros);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../js/javascriptscroll.js"></script>
        <script type="text/javascript" src="../js/js.js"></script>

    </head>
    <body>
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="megusta.php">Me Gusta</a></li>
                <li><a href="mispost.php">Mis post</a></li>
                <li><a href="#">Panel de administración</a></li>
                <li><a href="../usuario/phpcerrarsesion.php">Desloguear</a></li>
                <li>
                    <form action="javascript:enviar(this.buscar)" name="buscar" method="post">
                        <input type="text" placeholder="Buscar" name="texto">
                    </form>
                </li>
            </ul>
        </nav>
        <a href="buscarposts.php?value=<?php echo $value; ?>">Buscar posts</a>
        <div id="lista_posts">
            <?php
                if(count($usuarios) == 0) echo "No hay coincidencias"; 
                foreach ($usuarios as $key => $usuario) {
            ?>
            <a href="verusuario.php?login=<?php echo $usuario->getLogin(); ?>"><?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></a><small><?php echo $usuario->getLogin(); ?></small></br>
            <?php
                }
                if(count($usuarios) > 0){
            ?>
                <input type="button" id="mas" onclick="javascript:cargarUsuarios('<?php echo $value; ?>');" value="Cargar más">
            <?php } ?>
        </div>
    </body>
</html>
