<?php

class ModeloAnuncio {
    private $bd =null;
    private $tabla = "anuncio";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    
    function add(Anuncio $anuncio){
        $consultaSql = "insert into $this->tabla values(null, :titulo, :precio, :tipo, :extras,
                :descripcion, curdate(), :ciudad, :localizacion, :habitaciones, :servicios, :metros );";
        $parametros["titulo"] = $anuncio->getTitulo();
        $parametros["precio"] = $anuncio->getPrecio();
        $parametros["tipo"] = $anuncio->getTipo();
        $parametros["extras"] = $anuncio->getExtras();
        $parametros["descripcion"] = $anuncio->getDescripcion();
        $parametros["ciudad"] = $anuncio->getCiudad();
        $parametros["localizacion"] = $anuncio->getLocalizacion();
        $parametros["habitaciones"] = $anuncio->getHabitaciones();
        $parametros["servicios"] = $anuncio->getServicios();
        $parametros["metros"] = $anuncio->getMetros();        
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    function delete(Anuncio $anuncio){
        $consultaSql = "delete from $this->tabla where idanuncio=:idanuncio";
        $arrayConsulta["idanuncio"] = $anuncio->getIdanuncio();
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteForId($idanuncio){
        return $this->delete(new Anuncio($idanuncio));
    }
    function edit(Anuncio $anuncio, $idanuncioPK){        
        $consultaSql = "update $this->tabla set titulo=:titulo, precio=:precio, tipo=:tipo, extras=:extras,
                descripcion=:descripcion, ciudad=:ciudad, localizacion=:localizacion, habitaciones=:habitaciones, servicios=:servicios, 
                metros=:metros where idanuncio=:idanunciopk;";
        $parametros["titulo"] = $anuncio->getTitulo();
        $parametros["precio"] = $anuncio->getPrecio();
        $parametros["tipo"] = $anuncio->getTipo();
        $parametros["extras"] = $anuncio->getExtras();
        $parametros["descripcion"] = $anuncio->getDescripcion();
        $parametros["ciudad"] = $anuncio->getCiudad();
        $parametros["localizacion"] = $anuncio->getLocalizacion();
        $parametros["habitaciones"] = $anuncio->getHabitaciones();
        $parametros["servicios"] = $anuncio->getServicios();
        $parametros["metros"] = $anuncio->getMetros();   
        $parametros["idanunciopk"] = $idanuncioPK;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return true;
    }

    function get($idanuncio){
        $consultaSql = "select * from $this->tabla where idanuncio=:idanuncio";
        $arrayConsulta["idanuncio"] = $idanuncio;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $anuncio = new Anuncio();
            $anuncio->set($this->bd->getFila());
            return $anuncio;
        }else{
            return null;
        }
    }

    
     function count($condicion="1=1", $parametros=array()){
        $sql = "select count(*) from $this->tabla where $condicion";
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            $cantidad = $this->bd->getFila();
            return $cantidad[0];
        }
        return -1;
    }
    
    function getList($pagina=0, $rpp=10, $condicion="1=1",$parametros=array(), $orderby = "1"){
        $list = array();
        $principio = $pagina*$rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if($r){
            while($fila = $this->bd->getFila()){
                $anuncio = new Anuncio();
                $anuncio->set($fila);
                $list[] = $anuncio;
            }
        }else{
            return null;
        }
        return $list;
    } 

}