<?php

class ModeloPost {
    private $bd =null;
    private $tabla = "post";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function add(Post $post){
        $consultaSql = "insert into $this->tabla values(:idpost, :descripcion, :gusta, curdate(), :login);";
        $parametros["idpost"] = $post->getIdpost();
        $parametros["descripcion"] = $post->getDescripcion();
        $parametros["gusta"] = $post->getGusta();
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
        $sql = "select * from $this->tabla where $condicion order by idpost DESC limit $principio, $rpp";
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
    
    function getListScroll($pagina=0, $rpp=10,$condicion="1=1",$parametros=array(), $orderby = "1"){
        $list = array();
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $pagina, $rpp";
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
    
    function postYoSigo($pagina=0, $rpp=10,$login=null, $parametros=array()){
        $list = array();
        $principio = $pagina*$rpp;
        $sql = "select * from post INNER JOIN notificaciones ON post.login=notificaciones.loginusuarioseguido where notificaciones.loginusuario='$login' order by post.fechapost DESC limit $principio, $rpp";
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
    
    function postYoSigoScroll($pagina=0, $rpp=10,$login=null, $parametros=array()){
        $list = array();
        $sql = "select * from post INNER JOIN notificaciones ON post.login=notificaciones.loginusuarioseguido where notificaciones.loginusuario='$login' order by post.fechapost DESC limit $pagina, $rpp";
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
    
    function postMeGustan($pagina=0, $rpp=10,$login=null, $parametros=array()){
        $list = array();
        $principio = $pagina*$rpp;
        $sql = "select * from post INNER JOIN megusta ON post.idpost=megusta.idpost where megusta.login='$login' order by post.fechapost DESC limit $principio, $rpp";
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
    
    function postMeGustanScroll($pagina=0, $rpp=10,$login=null, $parametros=array()){
        $list = array();
        $sql = "select * from post INNER JOIN megusta ON post.idpost=megusta.idpost where megusta.login='$login' order by post.fechapost DESC limit $pagina, $rpp";
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
    
    function edit(Post $post){        
        $consultaSql = "update $this->tabla set gusta=:gusta where idpost=:idpost;";
        $parametros["gusta"] = $post->getGusta();
        $parametros["idpost"] = $post->getIdpost();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
}
