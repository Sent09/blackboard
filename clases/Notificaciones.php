<?php

class Notificaciones {
    private $idnotificaciones, $loginusuario, $loginanuncioseguido, $nuevosposts;
    function __construct($idnotificaciones, $loginusuario, $loginanuncioseguido, $nuevosposts) {
        $this->idnotificaciones = $idnotificaciones;
        $this->loginusuario = $loginusuario;
        $this->loginanuncioseguido = $loginanuncioseguido;
        $this->nuevosposts = $nuevosposts;
    }
    function set($datos, $inicio=0){
        $this->idnotificaciones = [0+$inicio];
        $this->loginusuario = [1+$inicio];
        $this->loginanuncioseguido = [2+$inicio];
        $this->nuevosposts = [3+$inicio];
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

    function getLoginanuncioseguido() {
        return $this->loginanuncioseguido;
    }

    function getNuevosposts() {
        return $this->nuevosposts;
    }

    function setLoginusuario($loginusuario) {
        $this->loginusuario = $loginusuario;
    }

    function setLoginanuncioseguido($loginanuncioseguido) {
        $this->loginanuncioseguido = $loginanuncioseguido;
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
