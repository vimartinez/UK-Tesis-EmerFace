<?php

final class LibrosClass {
    
    protected $lib_ID = 0;
    protected $aut_ID = null;
    protected $est_ID = null;
    protected $isbn = null;
    protected $nombre = null;
    protected $genero = null;
    protected $subgenero = null;
    protected $editorial = null;
    protected $resena = null;
    protected $copiaNro = 0;

    public function __construct($lib_ID = null, $aut_ID = null, $est_ID = null, $isbn = null, $nombre = null, $genero = null, $subgenero = null, $editorial = null, $resena = null ) {
        $this->lib_ID = $lib_ID;
        $this->aut_ID = $aut_ID;
        $this->est_ID = $est_ID;
        $this->isbn = $isbn;
        $this->nombre = $nombre;
        $this->genero = $genero;
        $this->subgenero = $subgenero;
        $this->editorial = $editorial;
        $this->resena = $resena;
    }
    public function getID() {
        return $this->lib_ID;
    }

    public function setID($lib_ID) {
        $this->lib_ID = $lib_ID;
    }
    public function getAut_ID() {
        return $this->aut_ID;
    }

    public function setAut_ID($aut_ID) {
        $this->aut_ID = $aut_ID;
    }

    public function getEst_ID() {
        return $this->est_ID;
    }
    public function setEst_ID($est_ID) {
        $this->est_ID = $est_ID;
    }
    public function getIsbn() {
        return $this->isbn;
    }
    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getGenero() {
        return $this->genero;
    }
    public function setGenero($genero) {
        $this->genero = $genero;
    }
    public function getSubgenero() {
        return $this->subgenero;
    }
    public function setSubgenero($subgenero) {
        $this->subgenero = $subgenero;
    }
    public function getEditorial() {
        return $this->editorial;
    }
    public function setEditorial($editorial) {
        $this->editorial = $editorial;
    }
    public function getCopiaNro() {
        return $this->copiaNro;
    }
    public function setCopiaNro($copiaNro) {
        $this->copiaNro = $copiaNro;
    }
    public function getResena() {
        return $this->resena;
    }
    public function setResena($resena) {
        $this->resena = $resena;
    }
}
?>
