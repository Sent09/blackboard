<?php

class ModeloArchivospost {
    private $bd =null;
    private $tabla = "archivospost";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function add(Archivospost $archivospost){
        $consultaSql = "insert into $this->tabla values(:idarchivospost, :url, :extension, :idpost);";
        $parametros["idarchivospost"] = $archivospost->getIdarchivospost();
        $parametros["url"] = $archivospost->getUrl();
        $parametros["extension"] = $archivospost->getExtension();
        $parametros["idpost"] = $archivospost->getIdpost();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    function delete(Archivospost $archivospost){
        $consultaSql = "delete from $this->tabla where idpost=:idpost";
        $arrayConsulta["idpost"] = $archivospost->getIdpost();
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    
    function deleteForIdPost($idpost){
        return $this->delete(new Archivospost(null, null, null, $idpost));
    }
    
    function get($idarchivospost){
        $consultaSql = "select * from $this->tabla where idarchivospost=:idarchivospost";
        $arrayConsulta["idarchivospost"] = $idarchivospost;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $archivospost = new Archivospost();
            $archivospost->set($this->bd->getFila());
            return $archivospost;
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
            $archivospost = new Archivospost();
            $archivospost->set($datos);
            $r .= $archivospost->getJSON() . ",";
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
                $archivospost = new Archivospost();
                $archivospost->set($datos);
                $list[] = $archivospost;
            }
        }else{
            return null;
        }
        return $list;
    }
}
