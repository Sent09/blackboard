<?php

class Megusta {
    private $login, $idpost;
    function __construct($login=null, $idpost=null) {
        $this->login = $login;
        $this->idpost = $idpost;
    }
    function getLogin() {
        return $this->login;
    }

    function getIdpost() {
        return $this->idpost;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setIdpost($idpost) {
        $this->idpost = $idpost;
    }
}
