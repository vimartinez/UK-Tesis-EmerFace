<?php
final class Bienvenida extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
        $diccionario = array(
            'areaTrabajo' => '
                 <div id="sidebar">
                    <div class="box">
                        <h3>Funcionalidades</h3>
                         Gestión de Pacientes
                         <br> Búsqueda de Pacientes 
                         <br> Asociar patología a Paciente
                         <br> Asociar Tratamiento a Paciente
                         <br> Asociar persona de contacto a Paciente
                         <br> Reconocimiento de Pacientes  
                         <br> Gestión de médicos
                         <br> Gestión de usuarios
                         <br> Recuperar información de Paciente.
                    </div>
                    <div class="box">
                    </div>
                    <div class="box">   
                    </div>
                </div>
                     <div id="content">
                        <div class="box">
                             <form id="frmPpal" name="frmPpal" action="index.php" method="post">
                                <input type="hidden" id="Controlador" name="Controlador" value="ControladorPrincipal" >
                                <input type="hidden" id="accion" name="accion" value="pantallaLogin" >
                                <div id="msgError" >{mensajeError}</div>
                            </form>
                            <img  src="web/img/logo2.png" alt="Universidad Kennedy" />   
                            <img class="alignleft" src="web/img/pic01.jpg" alt="" />
                            <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Licenciatura en Sistemas</h3>
                            <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trabajo Final Integrador</h4>
                            <p><b>EmerFace:</b> Sistema de identificación de personas en emergencias mediante técnicas de reconocimiento facial.
                              <h4>Victor Martinez </h4> 
                              <ul><li><a href="#" id="mnuLogin2">Ingresar</a></li> </ul>
                            </p>
                        </div>
                        <br class="clearfix" />
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
