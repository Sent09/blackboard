<!DOCTYPE html>
<?php
    require '../require/comun.php';
    if(!$sesion->get("__usuario") instanceof Usuario){
        header("Location: index.php");
        exit();
    }
    $fila = $sesion->get("__usuario");
    $login = $fila->getLogin();
    $clave = $fila->getClave();
    $nombre = $fila->getNombre();
    $apellidos = $fila->getApellidos();
    $email = $fila->getEmail();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blackboard</title>
    <script type="text/javascript" src="../js/js.js"></script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../post/megusta.php">Me Gusta</a></li>
            <li><a href="../post/mispost.php">Mis post</a></li>
            <li><a href="viewperfil.php">Panel de administración</a></li>
            <li><a href="phpcerrarsesion.php">Desloguear</a></li>
            <li>
                <form action="javascript:enviarUsuario(this.buscar)" name="buscar" method="post">
                    <input type="text" placeholder="Buscar" name="texto">
                </form>
            </li>
        </ul>
    </nav>
    <div class="panel-body">
        <form action="phpusuariodatos.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="login" value="<?php echo $login; ?>"/>
            <label>Nombre: </label><input type="text" value="<?php echo $nombre;?>" class="form-control" placeholder="Nombre" name="nombre" value="" required/><br>
            <label>Apellidos: </label><input type="text" value="<?php echo $apellidos;?>" class="form-control" placeholder="Apellidos" name="apellidos" value="" required/><br>
            <label>E-Mail: </label><input type="text" value="<?php echo $email;?>" class="form-control" placeholder="E-mail" name="email" value="" required/><br>
            <label>Foto: <input type="file" name="foto[]" /></label><br>
            <input type="submit" class="btn btn-info" value="Actualizar"/>
        </form>
    </div>
    <div class="panel-body">
        <form action="phpusuarioclave.php" method="POST">
            <input type="hidden" name="login" value="<?php echo $login; ?>"/>
            <label>Clave vieja: </label><input type="password"  class="form-control" name="clavevieja" value="" required/><br>
            <label>Clave nueva: </label><input type="password"  class="form-control" name="clave1" value="" required/><br>
            <label>Repite la clave nueva: </label><input type="password"  class="form-control"  name="clave2" value="" required/><br>
            <input type="submit" class="btn btn-info" value="Cambiar"/>
        </form>
    </div>
</body>
</html>
