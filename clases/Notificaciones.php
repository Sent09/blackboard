<?php

class Notificaciones {
    private $idnotificaciones, $loginusuario, $loginusuarioseguido, $nuevosposts;
    function __construct($idnotificaciones=null, $loginusuario=null, $loginusuarioseguido=null, $nuevosposts=null) {
        $this->idnotificaciones = $idnotificaciones;
        $this->loginusuario = $loginusuario;
        $this->loginusuarioseguido = $loginusuarioseguido;
        $this->nuevosposts = $nuevosposts;
    }
    function set($datos, $inicio=0){
        $this->idnotificaciones = $datos[0+$inicio];
        $this->loginusuario = $datos[1+$inicio];
        $this->loginusuarioseguido = $datos[2+$inicio];
        $this->nuevosposts = $datos[3+$inicio];
    }
    
    function getIdnotificaciones() {
        return $this->idnotificaciones;
    }

    function setIdnotificaciones($idnotificaciones) {
        $this->idnotificaciones = $idnotificaciones;
    }

        function getLoginusuario() {
        return $this->loginusuario;
    }

    function getLoginusuarioseguido() {
        return $this->loginusuarioseguido;
    }

    function getNuevosposts() {
        return $this->nuevosposts;
    }

    function setLoginusuario($loginusuario) {
        $this->loginusuario = $loginusuario;
    }

    function setLoginusuarioseguido($loginusuarioseguido) {
        $this->loginusuarioseguido = $loginusuarioseguido;
    }

    function setNuevosposts($nuevosposts) {
        $this->nuevosposts = $nuevosposts;
    }
    
    public function getJSON(){
        $prop = get_object_vars($this);//todas las variables de instancia de esta clase
        $resp = '{';
        foreach ($prop as $key => $value){
            $resp.='"' . $key . '":'.json_encode(htmlspecialchars_decode($value)).',';
        }
        $resp = substr($resp, 0, -1)."}";
        return $resp;
    }


}
