<?php

final class ControladorPacientes extends Controlador {

    public function gestionPacientes($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new Pacientes($template, $scripts);
        $M = new ModeloPacientes("");
        $res = $M->getPacientes();
        if ($res[0]== "err"){
            $V->setMensaje("No se encontraron pacientes en el sistema");
        }
        else {
            $V->setData($res);
        }
        if (isset($_SESSION['datosUsu'])){
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addPaciente($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new PacientesAdd($template, $scripts);
        if (isset($_SESSION['datosUsu'])){
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
     public function listadoPatologias($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new Patologias($template, $scripts);
        $M = new ModeloPacientes("");
        $res = $M->getPatologias();
        if ($res[0]== "err"){
            $V->setMensaje("No se encontraron patologias en el sistema");
        }
        else {
            $V->setData($res);
        }
        if (isset($_SESSION['datosUsu'])){
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function detallePaciente($msg = null, $err = null, $copia = null) {
        $pacID = $_POST["id"];
        $res = array();
        $res2 = array();
        $res3 = array();
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $M = new ModeloPacientes("");
        $res = $M->getPacienteDet($pacID);
        $res2 = $M->getTratamientosXPaciente($pacID);
        $res3 = $M->getPersonasXPaciente($pacID);
        $V = new PacientesDet($template, $scripts);
        $V->setPacId($pacID);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles del Paciente");
        }
        else {
            $V->setData($res);
        }
        if ($res2[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles de patologia");
        }
        else {
            $V->setData2($res2);
        }
        if ($res3[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles de tratamiento");
        }
        else {
            $V->setData3($res3);
        }
        if (isset($_SESSION['datosUsu'])){
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    
    public function addPacienteDo() {
        $M = new ModeloPacientes("");
        $res = $M->addPaciente($_POST["frmNombre"],$_POST["frmDNI"],$_POST["frmMail"],$_POST["frmDireccion"],$_POST["frmBarrio"],$_POST["frmPiso"],$_POST["frmDepto"],$_POST["frmProvincia"],$_POST["frmLocalidad"]);
        if ($res == "ok"){
            $this->addPaciente("Se agregó el paciente correctamente",null);
        }
        else{
            $this->addPaciente(null,"No se pudo insertar el paciente");
        }
    }
    
    public function addPatologiaPaciente($msg = null, $err = null) {
        $pac_Id = $_POST["id"];
        $M = new ModeloPacientes("");
        $res = $M->getPacienteDet($pac_Id);
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new PacientesAddPatologia($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles del Paciente");
        }
        else {
            $V->setData($res[0]);
        }
        $res2 = $M->getPatologias();
        if ($res2[0]== "err"){
            $V->setMensaje("No se encontraron patologias en el sistema");
        }
        else {
            $V->setData2($res2);
        }
        if (isset($_SESSION['datosUsu'])){
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    
    public function addPatologiaPacienteDo() {
        $M = new ModeloPacientes("");
        $res = $M->addPatologiaPaciente($_POST["id"],$_POST["frmPat"]);
        if ($res == "ok"){
            $this->addPatologiaPaciente("Se agregó la patología correctamente",null);
        }
        else{
            $this->addPatologiaPaciente(null,"No se pudo insertar la patología");
        }
    }
}

?>
