<?php

class Anuncio {
    private $idanuncio, $titulo, $precio, $tipo, $extras, $descripcion, $fechaalta, $ciudad, $localizacion, $habitaciones, $servicios, $metros;
    function __construct($idanuncio=null, $titulo=null, $precio=null, $tipo = 'venta', $extras =null, $descripcion=null, 
            $fechaalta=null, $ciudad=null, $localizacion=null, $habitaciones=0, $servicios=0, $metros=null){
        $this->idanuncio = $idanuncio;
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->extras = $extras;
        $this->descripcion = $descripcion;
        $this->fechaalta = $fechaalta;
        $this->ciudad = $ciudad;
        $this->localizacion = $localizacion;
        $this->habitaciones = $habitaciones;
        $this->servicios = $servicios;
        $this->metros = $metros;
    }

    function set($datos, $inicio=0){
        $this->idanuncio = $datos[0+$inicio];
        $this->titulo = $datos[1+$inicio];
        $this->precio = $datos[2+$inicio];
        $this->tipo = $datos[3+$inicio];
        $this->extras = $datos[4+$inicio];
        $this->descripcion = $datos[5+$inicio];
        $this->fechaalta = $datos[6+$inicio];
        $this->ciudad = $datos[7+$inicio];
        $this->localizacion = $datos[8+$inicio];
        $this->habitaciones = $datos[9+$inicio];
        $this->servicios = $datos[10+$inicio];
        $this->metros = $datos[11+$inicio];
    }
    function getIdanuncio() {
        return $this->idanuncio;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getExtras() {
        return $this->extras;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFechaalta() {
        return $this->fechaalta;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getLocalizacion() {
        return $this->localizacion;
    }

    function getHabitaciones() {
        return $this->habitaciones;
    }

    function getServicios() {
        return $this->servicios;
    }

    function getMetros() {
        return $this->metros;
    }

    function setIdanuncio($idanuncio) {
        $this->idanuncio = $idanuncio;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setExtras($extras) {
        $this->extras = $extras;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setLocalizacion($localizacion) {
        $this->localizacion = $localizacion;
    }

    function setHabitaciones($habitaciones) {
        $this->habitaciones = $habitaciones;
    }

    function setServicios($servicios) {
        $this->servicios = $servicios;
    }

    function setMetros($metros) {
        $this->metros = $metros;
    }


}

?>
