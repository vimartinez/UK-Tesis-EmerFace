<?php

abstract class Controlador {

    private $modelo = null;
    protected $idUsuario;
    protected $login;



    function __construct() {

    }

    public function getModelo() {
        return $this->modelo;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }


}

?>
