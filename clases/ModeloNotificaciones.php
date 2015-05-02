<?php

class ModeloNotificaciones {
    private $bd =null;
    private $tabla = "notificaciones";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function add(Notificaciones $notificaciones){
        $consultaSql = "insert into $this->tabla values(:idnotificaciones, :loginusuario, :loginanuncioseguido, :nuevosposts);";
        $parametros["idnotificaciones"] = $notificaciones->getIdnotificaciones();
        $parametros["loginusuario"] = $notificaciones->getIdarchivospost();
        $parametros["loginanuncioseguido"] = $notificaciones->getUrl();
        $parametros["nuevosposts"] = $notificaciones->getExtension();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    function delete(Notificaciones $notificaciones){
        $consultaSql = "delete from $this->tabla where idnotificaciones=:idnotificaciones";
        $arrayConsulta["idnotificaciones"] = $notificaciones->getIdnotificaciones();
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    
    function deleteForIdPost($idnotificaciones){
        return $this->delete(new Notificaciones($idnotificaciones));
    }
    
    function get($idnotificaciones){
        $consultaSql = "select * from $this->tabla where idnotificaciones=:idnotificaciones";
        $arrayConsulta["idarchivospost"] = $idnotificaciones;
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $notificaciones = new Notificaciones();
            $notificaciones->set($this->bd->getFila());
            return $notificaciones;
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
            $notificaciones = new Notificaciones();
            $notificaciones->set($datos);
            $r .= $notificaciones->getJSON() . ",";
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
                $notificaciones = new Notificaciones();
                $notificaciones->set($datos);
                $list[] = $notificaciones;
            }
        }else{
            return null;
        }
        return $list;
    }
    function notificar($loginusuario){        
        $consultaSql = "update $this->tabla set nuevosposts=nuevosposts+1 where loginanuncioseguido=:loginusuario;";
        $parametros["loginpk"] = $loginusuario;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    
    function notificacionA0($loginusuario, $loginanuncioseguido){        
        $consultaSql = "update $this->tabla set nuevosposts=0 where (loginusuario=:loginusuario) AND (loginanuncioseguido=:loginanuncioseguido);";
        $parametros["loginusuario"] = $loginusuario;
        $parametros["loginanuncioseguido"] = $loginanuncioseguido;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
}
