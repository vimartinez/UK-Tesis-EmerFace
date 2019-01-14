<?php

final class CopiasClass {
    
    protected $id = null;
    protected $idLibro = null;
    protected $estado = null;
    protected $calle = null;
    protected $pasillo = null;
    protected $estante = null;

    public function __construct($id, $estado, $calle, $pasillo, $estante, $idLibro) {
        $this->id = $id;
        $this->estado = $estado;
        $this->calle = $calle;
        $this->pasillo = $pasillo;
        $this->estante = $estante;
        $this->idLibro = $idLibro;
    }
    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCalle() {
        return $this->calle;
    }

    public function setCalle($calle) {
        $this->calle = $calle;
    }

    public function getPasillo() {
        return $this->pasillo;
    }

    public function setPasillo($pasillo) {
        $this->pasillo = $pasillo;
    }

    public function getEstante() {
        return $this->estante;
    }

    public function setEstante($estante) {
        $this->estante = $estante;
    }
     public function getidLibro() {
        return $this->idLibro;
    }

    public function setidLibro($idLibro) {
        $this->idLibro = $idLibro;
    }
}
?>
