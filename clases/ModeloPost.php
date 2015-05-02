<?php

class ModeloPost {
    private $bd =null;
    private $tabla = "post";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function add(Post $post){
        $consultaSql = "insert into $this->tabla values(:idpost, :descripcion, :gusta, curdate(), :idusuario, 
            :login);";
        $parametros["idpost"] = $post->getIdpost();
        $parametros["descripcion"] = $post->getDescripcion();
        $parametros["gusta"] = $post->getGusta();
        $parametros["idusuario"] = $post->getIdusuario();
        $parametros["login"] = $post->getLogin();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    function delete(Post $post){
        $consultaSql = "delete from $this->tabla where idpost=:idpost";
        $arrayConsulta["idpost"] = $post->getIdpost();
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    
    function deleteForId($idpost){
        return $this->delete(new Post($idpost));
    }
    
    function get($idpost){
        $consultaSql = "select * from $this->tabla where idpost=:idpost";
        $arrayConsulta["idpost"] = $idpost;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $post = new Post();
            $post->set($this->bd->getFila());
            return $post;
        }else{
            return null;
        }
    }
    
    function count($condicion="1=1", $parametros=array()){
        $sql = "select count(*) from $this->tabla where $condicion";
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            $resultado = $this->bd->getFila();
            return $resultado[0];
        }
        return -1;
    }
    function getListJSON($pagina = 0, $rpp = 3, $condicion = "1=1", $parametros = array(), $orderby = "1"){
        $pos = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $pos, $rpp";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while($datos = $this->bd->getFila()){
            $post = new Post();
            $post->set($datos);
            $r .= $post->getJSON() . ",";
        }
        $r = substr($r, 0, -1)."]";
        return $r;
    }
    
    function getList($pagina=0, $rpp=10,$condicion="1=1",$parametros=array(), $orderby = "1"){
        $list = array();
        $principio = $pagina*$rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if($r){
            while($datos = $this->bd->getFila()){
                $post = new Post();
                $post->set($datos);
                $list[] = $post;
            }
        }else{
            return null;
        }
        return $list;
    }
}