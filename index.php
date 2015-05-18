<?php 
    require 'require/comun2.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="js/js.js"></script>
        <title></title>
    </head>
    <body>
        <?php
        if(!$sesion->isAutentificado()){
        ?>
        Login
        <form action="usuario/phplogin.php" method="POST">            
            User<input type="text" name="login" value="" />
            Pass<input type="password" name="clave" value="" /> 
            <input class="btn btn-success" style="margin-top: 7px;" type="submit" value="Entrar" />
        </form>
        Has olvidao la cuenta o argo vieo? Tira <a href="usuario/viewolvido.php">pacá</a><br><br>
        
        Registro
        <table>
            <form action="usuario/phpalta.php" method="POST">
                <tr>
                    <td><label>Login: </label></td>
                    <td><input type="text" class="form-control" id="login" name="login" value="" required/><span id="dato"></span></td>
                </tr>
                <tr>
                    <td><label>Clave: </label></td>
                    <td><input type="password" class="form-control" name="clave" value="" required/></td>
                </tr>
                <tr>
                    <td><label>Confirmar clave: </label></td>
                    <td><input type="password" class="form-control" name="clave2" value="" required/></td>
                </tr>
                <tr>
                    <td><label>Nombre: </label></td>
                    <td><input type="text" class="form-control" name="nombre" value="" required/></td>
                </tr>
                <tr>
                    <td><label>Apellidos: </label></td>
                    <td><input type="text" class="form-control" name="apellidos" value="" required/></td>
                </tr>
                <tr>
                    <td><label>E-Mail: </label></td>
                    <td><input type="email" class="form-control" name="email" value="" required/></td>
                </tr>
                <tr>
                    <td><input type="submit" class="btn btn-success" name="boton" value="Enviar" required/></td>
                </tr>
            </form>        
        </table>
        <?php }else{ 
            $sesionusuario = $sesion->getUsuario();
            $login = $sesionusuario->getLogin();
            $bd = new BaseDatos();
            $p = Leer::get("p");
            $modeloPost = new ModeloPost($bd);
            $posts=$modeloPost->postYoSigo($p, 10, $login);
            $numeroRegistros = $modeloPost->count();    
            $lista = Util::getEnlacesPaginacion($p, 10, $numeroRegistros);
            $modeloNotificaciones = new ModeloNotificaciones($bd);
            $seguidoresmios = $modeloNotificaciones->count("loginusuarioseguido='$login'");
            $siguiendo = $modeloNotificaciones->count("loginusuario='$login'");
        ?>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="post/megusta.php">Me Gusta</a></li>
                <li><a href="post/mispost.php">Mis post</a></li>
                <li><a href="#">Panel de administración</a></li>
                <li><a href="usuario/phpcerrarsesion.php">Desloguear</a></li>
                <li>
                    <form action="javascript:enviarIndex(this.buscar)" name="buscar" method="post">
                        <input type="text" placeholder="Buscar" name="texto">
                    </form>
                </li>
            </ul>
        </nav>
        Nuevo post
        <form action="post/phpcrearpost.php" enctype="multipart/form-data" method="POST">
            <textarea name="mensaje"></textarea>
            <input type="file" name="archivos[]" multiple />
            <input type="submit"/>
        </form>
        Datos del usuario:<br>
        Nombre: <?php echo $sesionusuario->getNombre()." ".$sesionusuario->getApellidos(); ?>
        <img src="archivos/<?php echo $sesionusuario->getUrlfoto(); ?>"/><br>
        Seguidores: <?php echo $seguidoresmios; ?><br>
        Siguiendo: <?php echo $siguiendo; ?><br><br>
        
        
        Posts:
        <br><br>
            <?php 
            $contador = 0;
            foreach ($posts as $key => $post) {
                $idpost = $post->getIdpost();
                $modeloArchivo = new ModeloArchivospost($bd);
                $archivos = $modeloArchivo->getListTotal($idpost);
                
                $megusta = new Megusta($login, $idpost);
                $modelomegusta = new ModeloMegusta($bd);
                $countmegusta = $modelomegusta->count($megusta);               
                $idelemento = "seguir".$contador;
            ?>
            <div>
                <?php echo $post->getFechapost(); ?><br>
                <?php echo $post->getDescripcion(); ?><br>
                <?php echo $post->getGusta(); ?>
                <?php if($countmegusta>0){ ?>
                    <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gustaindex('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')">No me gusta</a>
                <?php }else{ ?>
                    <a style="color:blue;" id="<?php echo $idelemento; ?>" href="javascript:gustaindex('<?php echo $idelemento; ?>','<?php echo $login; ?>','<?php echo $idpost; ?>')">Me gusta</a>
                <?php } ?>
            </div>
                <?php foreach ($archivos as $key => $archivo) { ?>
                    <a style="color:red;" target="_blank" href="archivos/<?php echo $archivo->getUrl(); ?>">archivico</a>
                <?php } ?>
            <?php
                $contador++;
            }
            $bd->closeConsulta(); ?>
            <br><br>
            <ul>
                <?php 
                    echo $lista["inicio"];
                    echo $lista["anterior"];
                    echo $lista["primero"];
                    echo $lista["segundo"]; 
                    echo $lista["actual"]; 
                    echo $lista["cuarto"];
                    echo $lista["quinto"]; 
                    echo $lista["siguiente"];
                    echo $lista["ultimo"];
                    $bd->closeConexion();
                ?>
            </ul>
        
        
        
        
        
        
        
        
        
        
        
        <?php }?>
        <script src="../js/js.js" ></script>
    </body>
</html>
