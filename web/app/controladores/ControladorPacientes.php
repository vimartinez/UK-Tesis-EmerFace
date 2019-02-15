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
        $res = $M->addPaciente($_POST["frmNombre"],$_POST["frmDNI"],$_POST["frmMail"],$_POST["frmDireccion"],$_POST["frmBarrio"],$_POST["frmPiso"],$_POST["frmDepto"],$_POST["frmProvincia"],$_POST["frmLocalidad"],$_POST["frmGrpSang"],$_POST["frmFechaNac"],$_POST["frmSexo"]);
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
    
    public function addTratamiento($msg = null, $err = null) {
        $pac_Id = $_POST["id"];
        $M = new ModeloPacientes("");
        $res = $M->getPacienteDet($pac_Id);
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new PacientesAddTratamiento($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles del Paciente");
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
    
    public function addTratamientoDo() {
        $M = new ModeloPacientes("");
        $res = $M->addTratamiento($_POST["id"],$_POST["frmPat"],$_POST["tratam"],$_POST["tratamDescr"]);
        if ($res == "ok"){
            $this->addTratamiento("Se agregó el tratamiento correctamente",null);
        }
        else{
            $this->addTratamiento(null,"No se pudo insertar el tratamiento");
        }
    }
    
    public function addPersonContacto($msg = null, $err = null) {
        $pac_Id = $_POST["id"];
        $M = new ModeloPacientes("");
        $res = $M->getPacienteDet($pac_Id);
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new PacientesAddPersonaCont($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles del Paciente");
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
    
    public function addPersonContactoDo() {
        $M = new ModeloPacientes("");
        $res = $M->addPersonaContacto($_POST["frmNombre"],$_POST["frmDNI"],$_POST["frmMail"],$_POST["frmDireccion"],$_POST["frmBarrio"],$_POST["frmProvincia"],$_POST["frmLocalidad"],$_POST["id"],$_POST["frmTel"],$_POST["frmRelacion"],$_POST["frmPiso"],$_POST["frmDepto"]);
        if ($res == "ok"){
            $this->addPersonContacto("Se agregó la persona de contacto correctamente",null);
        }
        else{
            $this->addPersonContacto(null,"No se pudo insertar la persona de contacto");
        }
    }
    
    public function addImagenes($msg = null, $err = null) {
        $pac_Id = $_POST["id"];
        $M = new ModeloPacientes("");
        $res = $M->getPacienteDet($pac_Id);
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new PacientesAddImagen($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles del Paciente");
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
    
    public function addImagenesDo() {
        $imagenes = array();
        $imagenes[0] = $_POST["pathimg1"];
        $imagenes[1] = $_POST["pathimg2"];
        $imagenes[2] = $_POST["pathimg3"];
        $imagenes[3] = $_POST["pathimg4"];
        $imagenes[4] = $_POST["pathimg5"];
        $imagenes[5] = $_POST["pathimg6"];
        $imagenes[6] = $_POST["pathimg7"];
        $imagenes[7] = $_POST["pathimg8"];
        $M = new ModeloPacientes("");
        $res = $M->addImagenes($_POST["id"],$imagenes);
        if ($res == "ok"){
            $this->addImagenes("Se registraron las imágenes correctamente",null);
        }
        else{
            $this->addImagenes(null,"No se pudieron registrar las imágenes del paciente");
        }
    }
     public function addImagenes2($msg = null, $err = null) {
        $pac_Id = $_POST["id"];
        $M = new ModeloPacientes("");
        $res = $M->getPacienteDet($pac_Id);
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new PacientesAddImagen2($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles del Paciente");
        }
        else {
            $V->setData($res);
        }
        $res2 = $M->getImagenesPaciente($pac_Id);
        if ($res2[0] == "err"){
            $V->setMensaje("El paciente no tiene imágenes registradas.");
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
    
    public function addImagenesDo2() {
        //var_dump($_FILES); echo "<BR><BR>";
        //var_dump($_POST); die();
        $imgNombre = $_FILES['imgInp']['name'];
        $imgTmpNombre = $_FILES['imgInp']['tmp_name'];
        $idPaciente = $_POST["id"];
        $M = new ModeloPacientes("");
        $res = $M->addImagenes2($idPaciente,$imgNombre,$imgTmpNombre);
        if ($res == "ok"){
            $this->addImagenes2("Se registró las imágen correctamente",null);
        }
        else{
            $this->addImagenes(null,"No se pudo registrar las imagen del paciente");
        }
        
    }
}

?>
