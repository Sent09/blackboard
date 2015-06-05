<?php
/**
 * Segun los datos que llegan manda un mail con los login del usuario o 
 * un link para cambiar la contraseña.
 */
require '../require/comun.php';
$login = Leer::post("login");
$email = Leer::post("email");
$baseDatos = new BaseDatos();
$modelo = new ModeloUsuario($baseDatos);
if($login=="" && $email==""){
    header("Location: viewolvido.php?r=-1");
}
if($login!="" && $email==""){
    $usuario = $modelo->get($login);
    if($usuario->getEmail()!=""){
        $id = md5($usuario->getEmail().Configuracion::PEZARANA.$usuario->getLogin());
        $enlace = Entorno::getEnlaceCarpeta("viewrecuperar.php?id=$id&login=$login");
        $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $usuario->getEmail(), Configuracion::CLAVEGMAIL, "Enlace para cambiar la clave: ", $enlace);   
        header("Location: viewolvido.php?r=$r&op=login");        
    }else{
        header("Location: viewolvido.php?r=-1&op=login");
    }
}
if($login=="" && $email!=""){//terminar
    $condicion = "email=:email";
    $parametros["email"]=$email;
    if($modelo->count($condicion, $parametros)>0){
        $logins = $modelo->getList(0,10,$condicion, $parametros);    
        $loginLista = "";
        foreach ($logins as $key => $value) {
            $loginLista.= "Login: ".$value->getLogin()."\n";
        }
        $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Recordatorio logins", $loginLista);
        header("Location: viewolvido.php?r=$r&op=mail");
    }else{
        header("Location: viewolvido.php?r=-1&op=mail");
    }

}