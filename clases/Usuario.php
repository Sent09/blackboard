<?php

class Usuario {
    private $login, $clave, $nombre, $apellidos, $email, $fechaalta, $isactivo, $isroot, $rol, $fechalogin;
    function __construct($login=null, $clave=null, $nombre=null, $apellidos=null,
            $email=null, $fechaalta=null, $isactivo=0, $isroot=0, $rol='usuario', $fechalogin=null) {
        $this->login = $login;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->fechaalta = $fechaalta;
        $this->isactivo = $isactivo;
        $this->isroot = $isroot;
        $this->rol = $rol;
        $this->fechalogin = $fechalogin;
    }
    function set($datos, $inicio=0){
        $this->login = $datos[0+$inicio];
        $this->clave = $datos[1+$inicio];
        $this->nombre = $datos[2+$inicio];
        $this->apellidos = $datos[3+$inicio];
        $this->email = $datos[4+$inicio];
        $this->fechaalta = $datos[5+$inicio];
        $this->isactivo = $datos[6+$inicio];
        $this->isroot = $datos[7+$inicio];
        $this->rol = $datos[8+$inicio];
        $this->fechalogin = $datos[9+$inicio];
    }
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFechaalta() {
        return $this->fechaalta;
    }

    public function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    public function getIsactivo() {
        return $this->isactivo;
    }

    public function setIsactivo($isactivo=0) {
        $this->isactivo = $isactivo;
    }

    public function getIsroot() {
        return $this->isroot;
    }

    public function setIsroot($isroot=0) {
        $this->isroot = $isroot;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol='usuario') {
        $this->rol = $rol;
    }

    public function getFechalogin() {
        return $this->fechalogin;
    }

    public function setFechalogin($fechalogin) {
        $this->fechalogin = $fechalogin;
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
