<!-- Formularios para recordar via mail los datos de usuario y por otro lado un link para recuperar la clave -->
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <title>Blackboard</title>
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
    </head>
    <body>
        <div class="container-inicio">
            <div class="logoprincipal">
                <a href="../index.php"><img src="../img/logoprincipal.png"/></a>
            </div>
            <div class="contenedor-central">
                <div class="div-registro">
                    <div class="titulo"><i class="fa"></i> Recordar clave</div>
                    <div class="registro">
                        <form id="form-registro" action="phpolvido.php" method="post">
                            <input id="login" placeholder="Introduce tu login" class="form-control" type="text" name="login"/>
                            <input type="submit" class="btn btn-success" value="Enviar"/>
                        </form>
                    </div>
                </div>
                <div class="div-entrar">
                    <div class="titulo">Recordar login</div>
                    <div class="entrar">
                        <form id="form-entrar" action="phpolvido.php" method="post">
                            <input id="correo" placeholder="Introduce tu e-mail" class="form-control" type="email" name="email"/>
                            <input type="submit" class="btn btn-success" value="Enviar"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>