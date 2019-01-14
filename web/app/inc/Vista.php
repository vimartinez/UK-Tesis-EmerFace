<?php

abstract class Vista {

    protected $template = null;
    protected $mensaje = "";
    protected $error = "";
    protected $infoUsu = null;
    protected $data = null;


    public function __construct($template, $scripts = null) {
        $this->template = $template;
        if(!is_null($scripts) ) {
            $this->template = str_replace('<!-- Scripts -->',$scripts,  $this->template);
        }

    }

    public function getMensaje() {
        return $this->mensaje;
    }

    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    public function getError() {
        return $this->error;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public function getTemplate() {
        return $this->template;
    }

    public function setTemplate($template) {
        $this->template = $template;
    }
    public function getinfoUsu() {
        return $this->infoUsu;
    }

    public function setinfoUsu($infoUsu) {
        $this->infoUsu = $infoUsu;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function mostrarMensaje($mensaje){
        return '<div class="ui-widget" >
                <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em; ">
                    <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>Mensaje:</strong> '.$mensaje.'</p>
                </div>
            </div>';
    }

    public function mostrarError($error){
        return '<div class="ui-widget">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                    <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>Error:</strong> '.$error.'</p>
                </div>
            </div>';
    }

    abstract public function mostrarHTML();
}

?>
