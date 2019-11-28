<?php

final class ControladorUsuarios extends Controlador {

    public function gestionSocios($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/socios.js"></script>';
        $V = new SociosGestion($template, $scripts);
        $M = new ModeloUsuarios("");
        $res = $M->getSocios();
        if ($res[0]== "err"){
            $V->setMensaje("No se encontraron Socios en el sistema");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addSocio($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/socios.js"></script>';
        $res = array();
        $M = new ModeloUsuarios("");
        $res = $M->getProvincias();
        $V = new SociosAdd($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar las provincias");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
     public function socioAutocomplete(){
        $search = $_POST["term"];
        $res ="";
        $M = new ModeloUsuarios("");
        $res = $M->socioAutocomplete($search);
        echo json_encode($res);
    }
    public function addSocioDo() {
        $soc = new UsuariosClass(
                    0,
                    $_POST["frmNombre"],
                    $_POST["frmDNI"],
                    $_POST["frmMail"],
                    $_POST["frmLogin"],
                    $_POST["frmClave"],
                    $_POST["frmDireccion"],
                    $_POST["frmBarrio"],
                    $_POST["frmProvincia"],
                    $_POST["frmLocalidad"],
                    3
                );
        $M = new ModeloUsuarios("");
        $res = $M->addSocio($soc);
        if ($res == "ok"){
            $this->gestionSocios("Se agregó el socio correctamente",null);
        }
        else{
            $this->gestionSocios(null,"No se pudo insertar el socio");
        } 
    }
    public function delSocio() {
        $usu = new UsuariosClass($_POST["id"]);
        $M = new ModeloUsuarios("");
        $res = $M->delSocio($usu);
        if ($res == "ok"){
            $this->gestionSocios("Se eliminó el socio",null);
        }
        else{
            $this->gestionSocios(null,"No se pudo eliminar el socio");        
        }    
    }
    public function socioAutocomplete2(){
        $search = $_POST["term"];
        $res ="";
        $M = new ModeloUsuarios("");
        $res = $M->socioAutocomplete2($search);
        echo json_encode($res);
    }
    public function getSociosDeudores($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/socios.js"></script>';
        $V = new SociosDeudores($template, $scripts);
        $M = new ModeloUsuarios("");
        $res = $M->getSociosDeudores();
        if ($res[0]== "err"){
            $V->setMensaje("No se encontraron Socios deudores en el sistema");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addSancion() {
        $soc_id = "";
        $soc_nombre = "";
        $diasSancion = 0;
        $res = array();
        if (isset($_POST["frmSancion"])) $diasSancion = $_POST["frmSancion"];
        if (isset($_POST["frmNombreSocio"])) $soc_nombre = $_POST["frmNombreSocio"];
        if (isset($_POST["id"])) $soc_id = $_POST["id"];
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/socios.js"></script>';
        $V = new SociosSancion($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($soc_id != "" || $soc_nombre != ""){
            $M = new ModeloUsuarios("");
            $res = $M->getSocio($soc_id, $soc_nombre);
            if ($res[0] == "err"){
                $V->setMensaje("No se encontró un socio con los datos ingresados");
            }
            else {
                $V->setData($res);
            }
        }
        if ($diasSancion > 0){
            if (isset($M)){
                if ($M->addSancion($soc_id, $diasSancion) == "err"){
                    $V->setError("No se pudo generar la sanción");
                }
                else {
                    $V->setMensaje("Se generó la sanción correctamente");
                }
            }
            else{
                $V->setMensaje("Debe ingresar un socio para generar una sanción");
            }
        }
        $V->mostrarHTML();
    }
    public function gestionUsuarios($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/socios.js"></script>';
        $V = new UsuariosGestion($template, $scripts);
        $M = new ModeloUsuarios("");
        $res = $M->getUsuarios();
        if ($res[0]== "err"){
            $V->setMensaje("No se encontraron Socios en el sistema");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addUsuario($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/socios.js"></script>';
        $res = array();
        $M = new ModeloUsuarios("");
        $res = $M->getProvincias();
        $V = new UsuarioAdd($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar las provincias");
        }
        else {
            $V->setData($res);
        }
        $res = $M->getPerfiles();
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los perfiles");
        }
        else {
            $V->setData2($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addUsuarioDo() {
        $soc = new UsuariosClass(
                    0,
                    $_POST["frmNombre"],
                    $_POST["frmDNI"],
                    $_POST["frmMail"],
                    $_POST["frmLogin"],
                    $_POST["frmClave"],
                    $_POST["frmDireccion"],
                    $_POST["frmBarrio"],
                    $_POST["frmProvincia"],
                    $_POST["frmLocalidad"],
                    $_POST["frmPerfil"]
                );
        $M = new ModeloUsuarios("");
        $res = $M->addSocio($soc);
        if ($res == "ok"){
            $this->gestionUsuarios("Se agregó el usuario correctamente",null);
        }
        else{
            $this->gestionUsuarios(null,"No se pudo insertar el usuario");
        } 
    }
    public function delUsuario() {
        $usu = new UsuariosClass($_POST["id"]);
        $M = new ModeloUsuarios("");
        $res = $M->delSocio($usu);
        if ($res == "ok"){
            $this->gestionUsuarios("Se eliminó el usuario",null);
        }
        else{
            $this->gestionUsuarios(null,"No se pudo eliminar el usuario");        
        }    
    }
}

?>
