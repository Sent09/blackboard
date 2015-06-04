<?php

class ModeloMegusta {
    private $bd =null;
    private $tabla = "megusta";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function meGusta(Megusta $gusta){
        $consultaSql = "insert into $this->tabla values(:login, :idpost);";
        $parametros["login"] = $gusta->getLogin();
        $parametros["idpost"] = $gusta->getIdpost();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    
    function yaNoMeGusta(Megusta $gusta){
        $consultaSql = "delete from $this->tabla where login=:login AND idpost=:idpost";
        $parametros["login"] = $gusta->getLogin();
        $parametros["idpost"] = $gusta->getIdpost();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteByLogin($login){
        $consultaSql = "delete from $this->tabla where login=:login";
        $parametros["login"] = $login;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteByIdPost($idpost){
        $consultaSql = "delete from $this->tabla where idpost=:idpost";
        $parametros["idpost"] = $idpost;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function count(Megusta $gusta){
        $sql = "select count(*) from $this->tabla where login=:login AND idpost=:idpost";
        $parametros["login"] = $gusta->getLogin();
        $parametros["idpost"] = $gusta->getIdpost();
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            $resultado = $this->bd->getFila();
            return $resultado[0];
        }
        return -1;
    }
    function countMeGusta($login){
        $sql = "select count(*) from $this->tabla where login=:login";
        $parametros["login"] = $login;
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            $resultado = $this->bd->getFila();
            return $resultado[0];
        }
        return -1;
    }
    
}
