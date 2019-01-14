<?php

final class AutoresClass {
    
    protected $id = null;
    protected $nombreApe = null;
    protected $nacionalidad = null;

    /*public function __construct() {
        $this->id = 0;
    }*/
     public function __construct($id, $nombreApe, $nacionalidad) {
        $this->id = $id;
        $this->nombreApe = $nombreApe;
        $this->nacionalidad = $nacionalidad;
    }
    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }
    public function getNombreApe() {
        return $this->nombreApe;
    }

    public function setNombreApe($nombreApe) {
        $this->nombreApe = $nombreApe;
    }
    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }
}
?>
