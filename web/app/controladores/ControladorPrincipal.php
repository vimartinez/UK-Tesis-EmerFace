<?php

final class ControladorPrincipal extends Controlador {

    public function bienvenida($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $V = new Bienvenida($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }
      
    public function ayuda($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $V = new Ayuda($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
      public function servicios($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $V = new Servicios($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function catalogo($msg = null, $err = null) {
        $libro = null;
        if(isset($_POST["frmAutor"])){
            if ($_POST["frmAutor"]!=0 || $_POST["frmISBN"] != "" || $_POST["frmNombrelibro"]!="" || $_POST["frmGenero"] != "" || $_POST["frmSubgenero"] != "" || $_POST["frmEditorial"] != ""){
                $libro = new LibrosClass(0,$_POST["frmAutor"],1,$_POST["frmISBN"],$_POST["frmNombrelibro"],$_POST["frmGenero"],$_POST["frmSubgenero"],$_POST["frmEditorial"],null);
            }
        }
        $res = array();
        $M = new ModeloPrincipal("");
        $res = $M->getCatalogo($libro);
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/catalogo.js"></script>';
        $V = new Catalogo($template, $scripts);
        if(isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $MA = new ModeloAutores("");
        $V->setData2($MA->getAutores());
        if ($res[0] == "err"){
            $V->setMensaje("No se encontraron libros con el criterio elegido.");
        }
        else {
            $V->setData($res);
        }
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }

    public function links() {
        $template = file_get_contents('web/principal.html');
        $V = new Links($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function login() {
        $template = file_get_contents('web/principal.html');
        $V = new Login($template);
        if (isset($_SESSION['datosUsu'])){
            $V->setMensaje("ATENCIÓN: Usted ya ingresó la sistema, no es necesario volver a iniciar sesión.");
            $V->setinfoUsu($_SESSION['datosUsu']);
        } 
        $V->mostrarHTML();
    }

    public function loginDo() {
        $usr = $_POST["frmLoginUsu"];
        $clave = $_POST["frmLoginClave"];
        $M = new ModeloPrincipal("");
        $res = $M->iniciarSesion($usr,$clave);
        $template = file_get_contents('web/principal.html');
        if ($res != "ok"){
            $V = new Login($template);
            $V->setMensaje($res);
        }
        else {
            $V = new Bienvenida($template);
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        $V->mostrarHTML();
    }

    public function contacto() {
        $template = file_get_contents('web/principal.html');
        $V = new Contacto($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function acercaDe() {
        $template = file_get_contents('web/principal.html');
        $V = new AcercaDe($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function admin() {
        $template = file_get_contents('web/principal.html');
        $V = new Admin($template);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloPrincipal("");
            $res = $M->getFuncionalidades($_SESSION['idPerfil']);
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
    public function socios() {
        $template = file_get_contents('web/principal.html');
        $V = new Socios($template);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloPrincipal("");
            $res = $M->getFuncionalidades(3);
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
    public function salir() {
        session_destroy();

        $template = file_get_contents('web/principal.html');
        $V = new Bienvenida($template);
        $V->mostrarHTML();
    }
}

?>
