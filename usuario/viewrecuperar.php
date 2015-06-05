<?php
/*
 * Pantalla que se muestra tras recibir el mail que se pide cuando no recuerdas
 * tu contraseña. Aquí se cambia la contraseña por una nueva.
 */
require '../require/comun.php';
$id = Leer::get("id");
$login = Leer::get("login");
$baseDatos = new BaseDatos();
$modelo = new ModeloUsuario($baseDatos);
$usuario = $modelo->get($login);
if ($usuario->getEmail() != "") {
    $id2 = md5($usuario->getEmail() . Configuracion::PEZARANA . $usuario->getLogin());
    if ($id != $id2) {
        header("Location: viewolvido.php?r=-1");
    }
} else {
    header("Location: viewolvido.php?r=-1");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
        <title>Blackboard</title>
    </head>
    <body>
        <div class="container-inicio">
            <div class="logoprincipal">
                <a href="../index.php"><img src="../img/logoprincipal.png"/></a>
            </div>
            <div class="div-recuperar-superior">
                <div class="titulo-recuperar">Cambiar clave</div>
            </div>
            <div class="div-recuperar-inferior">
                <form id="form-registro" action="phpcambiarclave.php" method="post">
                    <input  value="<?php echo $id; ?>" type="hidden" name="id" />
                    <input  value="<?php echo $login; ?>" type="hidden" name="login" />
                    <input id="password" placeholder="Escribe la nueva clave" class="form-control" type="password" name="clave1"/>
                    <input id="repeat" placeholder="Repite la nueva clave" class="form-control" type="password" name="clave2"/>
                    <input type="submit" class="btn btn-success" value="Enviar"/> 
                </form>
            </div>
        </div>
    </body>
</html>