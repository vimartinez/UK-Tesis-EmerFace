<?php
final class AcercaDe extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Acerca de...</h2>     
                    <p>
                        <h2>EmerFace 1.0</h2>
                        Sistema de identificación de personas mediante técnicas de reconocimiento facial.
                        <br><b>Trabajo final para la carrera Licenciatura en Sistemas - Universidad Kennedy (marzo 2019)</b> <br />
                        Desarrollado con PHP, MySQL  y java <br />
                        enero 2018  - marzo 2019 <br /><br /> <br />
                        <img  src="web/img/logo2.png" alt="Universidad Kennedy" /> 
                        <br /> <br />
                       <h4> Victor Martinez</h4>
                         
                        Buenos Aires - Argentina -2019<br /><br /> <br /><br>
                        Íconos de <a href="http://www.famfamfam.com/" target="_blank">FAMFAMFAM</a>.<br>
                        Diseño web obtenido de <a href="https://templated.co/" target="_blank">TEMPLATED</a>.

                    </p>
                </div>',
            'mensajeError' => $this->getMensaje(),
            'infoUsuario' => $this->getinfoUsu()
        );
        foreach ($diccionario as $clave=>$valor){
            $this->template = str_replace('{'.$clave.'}', $valor, $this->template);
        }
        print $this->template;
    } 
    public function getMensaje() {
        return $this->mensaje;
    }

    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }


}
?>
