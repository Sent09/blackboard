<?php

class ModeloFotos {
    private $bd =null;
    private $tabla = "fotos";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    
    function add(Fotos $fotos){
        $consultaSql = "insert into $this->tabla values(null, :idanuncio, :urlfoto, :destacada);";
        $parametros["idanuncio"] = $fotos->getIdanuncio();
        $parametros["urlfoto"] = $fotos->getUrlfoto();
        $parametros["destacada"] = $fotos->getDestacada();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    function delete(Fotos $fotos){
        $consultaSql = "delete from $this->tabla where id=:id";
        $arrayConsulta["id"] = $fotos->getId();
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteForIdAnuncio($idanuncio){
        $consultaSql = "delete from $this->tabla where idanuncio=:idanuncio";
        $arrayConsulta["idanuncio"] = $idanuncio;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteForId($id){
        return $this->delete(new Fotos($id));
    }
    function edit(Fotos $fotos, $idpk){        
        $consultaSql = "update $this->tabla set idanuncio=:idanuncio, urlfoto=:urlfoto,
            destacada=:destacada where id=:idpk;";
        $parametros["idanuncio"] = $fotos->getIdanuncio();
        $parametros["urlfoto"] = $fotos->getUrlfoto();
        $parametros["destacada"] = $fotos->getDestacada();
        $parametros["idpk"] = $idpk;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    
    function get($id){
        $consultaSql = "select * from $this->tabla where id=:id";
        $arrayConsulta["id"] = $id;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $usuario = new Usuario();
            $usuario->set($this->bd->getFila());
            return $usuario;
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
    
    function getList($idanuncio, $orderby = "1"){
        $list = array();
        $sql = "select * from $this->tabla where idanuncio=:idanuncio order by $orderby";
        $parametros["idanuncio"] = $idanuncio;
        $r = $this->bd->setConsulta($sql, $parametros);
        if($r){
            while($fila = $this->bd->getFila()){
                $foto = new Fotos();
                $foto->set($fila);
                $list[] = $foto;
            }
        }else{
            return null;
        }
        return $list;
    } 

}