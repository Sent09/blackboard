<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
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
    </body>
</html>
