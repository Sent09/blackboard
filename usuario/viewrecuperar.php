<?php
require '../require/comun.php';
$id = Leer::get("id");
$login = Leer::get("login");
$baseDatos = new BaseDatos();
$modelo = new ModeloUsuario($baseDatos);
$usuario = $modelo->get($login);
if($usuario->getEmail()!=""){
    $id2 = md5($usuario->getEmail().Configuracion::PEZARANA.$usuario->getLogin());
    if($id!=$id2){
        header("Location: viewolvido.php?r=-1");
    }
}else{
    header("Location: viewolvido.php?r=-1");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div  style="margin:0 auto;width: 400px;" >
            <h3 class="panel-title">Cambiar clave</h3>
            <form action="phpcambiarclave.php" method="post">
                <table>
                    <tr>
                        <input value="<?php echo $id; ?>" type="hidden" name="id" />
                        <input value="<?php echo $login; ?>" type="hidden" name="login" />
                        <td>Nueva clave: </td>
                        <td><input class="form-control" type="password" name="clave1"/></td>
                    </tr>
                    <tr>
                        <td>Repite la nueva clave: </td>
                        <td><input class="form-control" type="password" name="clave2"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn btn-success" value="Enviar"/></td>
                    </tr>
                </table>  
            </form>
        </div>
    </body>
</html>