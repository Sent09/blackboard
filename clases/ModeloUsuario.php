<?php

class ModeloUsuario {
    private $bd =null;
    private $tabla = "usuario";
    
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    
    function add(Usuario $usuario){
        $consultaSql = "insert into $this->tabla values(:login, :clave, :nombre, :apellidos, :email, curdate(), 
            :isactivo, :isroot, :rol, null, :urlfoto);";
        $parametros["login"] = $usuario->getLogin();
        $parametros["clave"] = sha1($usuario->getClave());
        $parametros["nombre"] = $usuario->getNombre();
        $parametros["apellidos"] = $usuario->getApellidos();
        $parametros["email"] = $usuario->getEmail();
        $parametros["isactivo"] =$usuario->getIsactivo();
        $parametros["isroot"] = $usuario->getIsroot();
        $parametros["rol"] = $usuario->getRol();
        $parametros["urlfoto"] = $usuario->getUrlfoto();
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $resultado;
    }
    function delete(Usuario $usuario){
        $consultaSql = "delete from $this->tabla where login=:login";
        $arrayConsulta["login"] = $usuario->getLogin();
        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function deleteForLogin($login){
        return $this->delete(new Usuario($login));
    }
    function edit(Usuario $usuario, $loginpk){        
        $consultaSql = "update $this->tabla set login=:login, clave=:clave,
            nombre=:nombre, apellidos=:apellidos, email=:email,
            isactivo=:isactivo, isroot=:isroot, rol=:rol, urlfoto=:urlfoto where login=:loginpk;";
        $parametros["login"] = $usuario->getLogin();
        $parametros["clave"] = $usuario->getClave();
        $parametros["nombre"] = $usuario->getNombre();
        $parametros["apellidos"] = $usuario->getApellidos();
        $parametros["email"] = $usuario->getEmail();
        $parametros["isactivo"] =$usuario->getIsactivo();
        $parametros["isroot"] = $usuario->getIsroot();
        $parametros["rol"] = $usuario->getRol();
        $parametros["urlfoto"] = $usuario->getUrlfoto();
        $parametros["loginpk"] = $loginpk;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    function actualizarFechaLogin(Usuario $usuario, $fechalogin){        
        $consultaSql = "update $this->tabla set fechalogin=:fechalogin where login=:login;";
        $parametros["login"] = $usuario->getLogin();
        $parametros["fechalogin"] = $fechalogin;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
//    function editPK(Persona $objetoOriginal, Persona $objetoNuevo){
//        $consultaSql = "update $this->tabla set id= :id nombre = :nombre, apellidos = :apellidos where id=:idpk;";
//        $arrayConsulta["nombre"] = $objetoNuevo->getNombre();
//        $arrayConsulta["apellido"] = $objetoNuevo->getApellido();
//        $arrayConsulta["id"] = $objetoNuevo->getId();
//        $arrayConsulta["idpk"] = $objetoOriginal->getId();
//        $resultado = $this->bd->setConsulta($consultaSql, $arrayConsulta);
//        if(!$resultado){
//            return -1;
//        }
//        return $this->bd->getNumeroFila();
//    }
//    
    function get($login){
        $consultaSql = "select * from $this->tabla where login=:login";
        $arrayConsulta["login"] = $login;
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
            $usuario = new Usuario();
            $usuario->set($datos);
            $r .= $usuario->getJSON() . ",";
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
                $usuario = new Usuario();
                $usuario->set($datos);
                $list[] = $usuario;
            }
        }else{
            return null;
        }
        return $list;
    }
    
//    function selectHtml($id,$name,$condicion, $parametros, $valorSeleccionado="",$blanco=true, $textoBlanco="&nbsp;"){
//        $select = "<select name='$name' id='$id'>";
//        if($blanco){
//            $select .= "<option value=''>$textoBlanco</option>";
//        }
//        $lista = $this->getList($condicion, $parametros, $orderby);
//        foreach($lista as $objeto){
//            $select .= "<option value='".$objeto->getId()."'>".$objeto->getApellido().", ".$objeto->getNombre()."</option>";
//        }
//        
//        $select .= "</select>";
//        return "<select id='' name=''><option>...</option>";
//    }
    
    function activa($id){        
        $consultaSql = "update $this->tabla set isactivo=1 where isactivo=0 and  md5(concat(email,'".Configuracion::PEZARANA."', login))=:id;";
        $parametros["id"] = $id;
        $resultado = $this->bd->setConsulta($consultaSql, $parametros);
        if(!$resultado){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    /***
     * Comprueba que el usuario exista y esté activo. En ese caso se efectua el login.
     */
    function login($login, $clave){
        $sql = "select * from $this->tabla where login=:login and clave=:clave and isactivo=1";
        $parametros["login"] = $login;
        $parametros["clave"] = sha1($clave);
        $r = $this->bd->setConsulta($sql, $parametros);
        if($r){
            $datos = $this->bd->getFila();
            if($datos!=null){
                $usuario = new Usuario();
                $usuario->set($datos);
                return $usuario;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    function editSinClave(Usuario $objeto, $login, $claveold){
        $asignacion = "login = :login, nombre=:nombre, apellidos=:apellidos, email=:email";
        $condicion = "login=:login and clave=:claveold";
        $parametros["login"]= $objeto->getLogin();
        $parametros["nombre"]= $objeto->getNombre();
        $parametros["apellidos"]= $objeto->getApellidos();
        $parametros["email"]= $objeto->getEmail();
        $parametros["loginpk"]= $login;
        $parametros["claveold"]= sha1($claveold);
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    function editConClave(Usuario $objeto, $login, $claveold){
        $asignacion = "login = :login, clave = :clave,"
                   . "nombre=:nombre, apellidos=:apellidos, "
                   . "email= :email";
        $condicion = "login = :loginpk and clave = :claveold";
        $parametros["login"]= $objeto->getLogin();
        $parametros["clave"]= sha1($objeto->getClave());
        $parametros["nombre"]= $objeto->getNombre();
        $parametros["apellidos"]= $objeto->getApellidos();
        $parametros["email"]= $objeto->getEmail();
        $parametros["loginpk"]= $login;
        $parametros["claveold"]= sha1($claveold);
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    function editConsulta($asignacion, $condicion="1-1", $parametros = array()){
        $sql = "update $this->tabla set $asignacion where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    
}