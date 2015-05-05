<?php

class Archivospost {
    private $idarchivospost, $url, $extension, $idpost;
    function __construct($idarchivospost=null, $url=null, $extension=null, $idpost=null) {
        $this->idarchivospost = $idarchivospost;
        $this->url = $url;
        $this->extension = $extension;
        $this->idpost = $idpost;
    }

    function set($datos, $inicio=0){
        $this->idarchivospost = $datos[0+$inicio];
        $this->url = $datos[1+$inicio];
        $this->extension = $datos[2+$inicio];
        $this->idpost = $datos[3+$inicio];

    }
    function getIdarchivospost() {
        return $this->idarchivospost;
    }

    function getUrl() {
        return $this->url;
    }

    function getExtension() {
        return $this->extension;
    }

    function getIdpost() {
        return $this->idpost;
    }

    function setIdarchivospost($idarchivospost) {
        $this->idarchivospost = $idarchivospost;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setExtension($extension) {
        $this->extension = $extension;
    }

    function setIdpost($idpost) {
        $this->idpost = $idpost;
    }

        public function getJSON(){
        $prop = get_object_vars($this);//todas las variables de instancia de esta clase
        $resp = '{';
        foreach ($prop as $key => $value){
            $resp.='"' . $key . '":'.json_encode(htmlspecialchars_decode($value)).',';
        }
        $resp = substr($resp, 0, -1)."}";
        return $resp;
    }

}

?>
