<?php

final class PrestamosClass {
    
    protected $id = null;
    protected $soc_id = null;
    protected $lib_id = null;
    protected $cop_id = null;
    protected $duracion = null;

     public function __construct($id = null, $soc_id = null, $lib_id = null, $cop_id = null) {
        $this->id = $id;
        $this->soc_id = $soc_id;
        $this->lib_id = $lib_id;
        $this->cop_id = $cop_id;
        $this->duracion = DURACION_PRESTAMO;
    }
    function getId() {
        return $this->id;
    }

    function getSoc_id() {
        return $this->soc_id;
    }

    function getLib_id() {
        return $this->lib_id;
    }

    function getCop_id() {
        return $this->cop_id;
    }

    function getDuracion() {
        return $this->duracion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSoc_id($soc_id) {
        $this->soc_id = $soc_id;
    }

    function setLib_id($lib_id) {
        $this->lib_id = $lib_id;
    }

    function setCop_id($cop_id) {
        $this->cop_id = $cop_id;
    }

    function setDuracion($duracion) {
        $this->duracion = $duracion;
    }


}
?>
