<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div style="margin:0 auto;width: 400px;" >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa"></i> Recordar clave</h3>
                </div>
                <div class="panel-body">
                    <form action="phpolvido.php" method="post">
                        <table>
                            <tr>
                                <td>Login: </td>
                                <td><input class="form-control" type="text" name="login"/></td>
                            </tr>
                            <tr>
                                <td><input type="submit" class="btn btn-success" value="Enviar"/></td>
                            </tr>
                        </table>  
                   </form>
                </div>
            </div>
        </div>
        </div>
        <div  style="margin:0 auto;width: 400px;" >
            <h3 class="panel-title">Recordar login</h3>
                <form action="phpolvido.php" method="post">
                    <table>
                        <tr>
                            <td>Email: </td>
                            <td><input class="form-control" type="email" name="email"/></td>
                        </tr>
                        <tr>
                            <td><input type="submit" class="btn btn-success" value="Enviar"/></td>
                        </tr>
                    </table>  
                </form>
        </div>
    </body>
</html>