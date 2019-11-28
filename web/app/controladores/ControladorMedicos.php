<?php

final class ControladorMedicos extends Controlador {

    public function gestionMedicos($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/medicos.js"></script>';
        $V = new Medicos($template, $scripts);
        $M = new ModeloMedicos("");
        $res = $M->getMedicos();
        if ($res[0]== "err"){
            $V->setMensaje("No se encontraron medicos en el sistema");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addPaciente($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/pacientes.js"></script>';
        $V = new PacientesAdd($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
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
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    
    
    
    
    
    
    
    
    
    public function addAutorDo() {
        $aut = new AutoresClass(0,$_POST["frmNombre"],$_POST["autPais"]);
        $M = new ModeloAutores("");
        $res = $M->addAutor($aut);
        if ($res == "ok"){
            $this->addAutor("Se agregó el autor correctamente",null);
        }
        else{
            $this->addAutor(null,"No se pudo insertar el autor");
        }
        
    }
    public function delAutor() {
        $aut = new AutoresClass($_POST["id"],null,null);
        $M = new ModeloAutores("");
        $res = $M->delAutor($aut);
        if ($res == "ok"){
            $this->gestionAutores("Se eliminó el autor",null);
        }
        else{
            if ($res == "libro"){
                $this->gestionAutores("No se puede eliminar un autor si tiene libros en el sistema",null);
            }
            else {
                $this->gestionAutores(null,"No se pudo eliminar el autor");
            }      
        }    
    }
    public function autorAutocomplete(){
        $search = $_POST["term"];
        $res ="";
        $M = new ModeloAutores("");
        $res = $M->autorAutocomplete($search);
        echo json_encode($res);
    }
}

?>
