<?php

final class UsuariosClass {
    
    protected $id = null;
    protected $nombreApe = null;
    protected $dni = null;
    protected $mail = null;
    protected $login = null;
    protected $clave = null;
    protected $direccion = null;
    protected $barrio = null;
    protected $provincia = null;
    protected $localidad = null;
    protected $perfil = null;

     public function __construct($id = null, $nombreApe = null, $dni = null, $mail = null, $login = null, $clave = null, $direccion = null, $barrio = null, $provincia = null, $localidad = null, $perfil = null) {
        $this->id           = $id;
        $this->nombreApe    = $nombreApe;
        $this->dni          = $dni;
        $this->mail         = $mail;
        $this->login        = $login;
        $this->clave        = $clave;
        $this->direccion    = $direccion;
        $this->barrio       = $barrio;
        $this->provincia    = $provincia;
        $this->localidad    = $localidad;
        $this->perfil    = $perfil;
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
    public function getDNI() {
        return $this->dni;
    }

    public function setDNI($dni) {
        $this->dni = $dni;
    }
     public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }
     public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }
     public function getClave() {
        return $this->clave;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }
     public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
     public function getBarrio() {
        return $this->barrio;
    }

    public function setBarrio($barrio) {
        $this->barrio = $barrio;
    }
     public function getProvincia() {
        return $this->provincia;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }
     public function getLocalidad() {
        return $this->localidad;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }
     public function getPerfil() {
        return $this->perfil;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }
}
?>
