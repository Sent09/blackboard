<?php

class SesionSingleton {

    private static $instancia;

    private function __construct($nombre="") {
        if ($nombre !== "") {
            session_name($nombre);
        }
        session_start();
    }

    public static function getSesion($nombre="") {
        if (is_null(self::$instancia)) {
            self::$instancia = new self($nombre);
        }
        return self::$instancia;
    }

    function cerrar() {
        session_unset();
        session_destroy();
    }
    
    function set($variable, $valor) {
        $_SESSION[$variable] = $valor;
    }
    
    function delete($variable=""){
        if($variable===""){
            unset($_SESSION);
        } else {
            unset($_SESSION[$variable]);
        }
    }

    function get($variable) {
        if (isset($_SESSION[$variable]))
            return $_SESSION[$variable];
        return null;
    }
    
    function getNombres(){
        $array = array();
        foreach ($_SESSION as $key => $value) {
            $array[] = $key;
        } 
        return $array;
    }

    function isSesion(){
        return count($_SESSION)>0;
    }

    function isAutentificado(){
//        if(Entorno::getNavegadorCliente()!=$this->get("__navegador") || Entorno::getIpCliente()!=$this->get("__ip")){
//            $this->cerrar();
//            return false;
//        }
//        if(time()-$this->get("__timeout")>Configuracion::TIMEOUT){
//            $this->cerrar();
//            return false; 
//        }
//        $this->set("__timeout", time());
        return isset($_SESSION["__usuario"]);
    }

    function setUsuario($usuario, $bd){
        if($usuario instanceof Usuario){
            $this->set("__usuario",$usuario);
//            $this->set("__ip", Entorno::getIpCliente());
//            $this->set("__navegador", Entorno::getNavegadorCliente());
//            $this->set("__timeout", time());
            $mdusuario = new ModeloUsuario($bd);
            $mdusuario->actualizarFechaLogin($usuario, date("Y-m-d"));
        }
    }
    
    function getUsuario(){
        if($this->get("__usuario")!=null)
            return $this->get("__usuario");
        return null;
    }
    function autentificado($destino="index.php"){
        if(!$this->isAutentificado()){
            $this->redirigir($destino);
        }
    }
    function administrador($destino="login.php"){
        $usuario = $this->getUsuario();
        if(!$this->isAutentificado() || !$usuario->getIsroot())
            $this->redirigir($destino);
    }
    function comprobarAdministrador(){
        $usuario = $this->getUsuario();
        if($this->isAutentificado() && $usuario->getIsroot())
            return true;
        else
            return false;
    }
    function redirigir($destino="index.php"){
        header("Location:".$destino);
        exit;
    }
}