<?php

class Fotos {
    private $id, $idanuncio, $urlfoto, $destacada;
    function __construct($id=null, $idanuncio=null, $urlfoto=null, $destacada=0) {
        $this->id = $id;
        $this->idanuncio = $idanuncio;
        $this->urlfoto = $urlfoto;
        $this->destacada = $destacada;
    }
    function set($datos, $inicio=0){
        $this->id = $datos[0+$inicio];
        $this->idanuncio = $datos[1+$inicio];
        $this->urlfoto = $datos[2+$inicio];
        $this->destacada = $datos[3+$inicio];
    }
    function getId() {
        return $this->id;
    }

    function getIdanuncio() {
        return $this->idanuncio;
    }

    function getUrlfoto() {
        return $this->urlfoto;
    }

    function getDestacada() {
        return $this->destacada;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdanuncio($idanuncio) {
        $this->idanuncio = $idanuncio;
    }

    function setUrlfoto($urlfoto) {
        $this->urlfoto = $urlfoto;
    }

    function setDestacada($destacada) {
        $this->destacada = $destacada;
    }


}

?>
