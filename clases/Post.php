<?php

class Usuario {
    private $idpost, $descripcion, $gusta, $fechapost, $idusuario, $login;
    function __construct($idpost, $descripcion, $gusta, $fechapost, $idusuario, $login) {
        $this->idpost = $idpost;
        $this->descripcion = $descripcion;
        $this->gusta = $gusta;
        $this->fechapost = $fechapost;
        $this->idusuario = $idusuario;
        $this->login = $login;
    }

    function set($datos, $inicio=0){
        $this->idpost = $datos[0+$inicio];
        $this->descripcion = $datos[1+$inicio];
        $this->gusta = $datos[2+$inicio];
        $this->fechapost = $datos[3+$inicio];
        $this->idusuario = $datos[4+$inicio];
        $this->login = $datos[5+$inicio];
    }
    
    function getIdpost() {
        return $this->idpost;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getGusta() {
        return $this->gusta;
    }

    function getFechapost() {
        return $this->fechapost;
    }

    function getIdusuario() {
        return $this->idusuario;
    }

    function getLogin() {
        return $this->login;
    }

    function setIdpost($idpost) {
        $this->idpost = $idpost;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setGusta($gusta) {
        $this->gusta = $gusta;
    }

    function setFechapost($fechapost) {
        $this->fechapost = $fechapost;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setLogin($login) {
        $this->login = $login;
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

?>
