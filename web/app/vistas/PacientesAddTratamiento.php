<?php
final class PacientesAdd extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {

    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Pacientes:</h2>             
        <p>
            Nuevo Paciente: <br />
        </p>
         <p id="frmAltaAutores">
          <form id="frmAutores" method="post" action="index.php" name="frmMenu" >
          <ul class="form-style-1">
            {mensaje}{error}
                <li>
                    <label>Datos Personales <span class="required">*</span></label>
                    <input type="text" id="frmNombre" name="frmNombre" class="field-long" placeholder="Nombre" required />
                </li>
                 <li>
                   <input type="number" id="frmDNI" name="frmDNI" class="field-divided" placeholder="DNI" min="1000000" max="99000000" required/>&nbsp;
                   <input type="email" id="frmMail" name="frmMail" class="field-divided" placeholder="Mail" required/>
                </li>        
                <li>
                   <label>Dirección <span class="required">*</span></label>
                   <input type="text" id="frmDireccion" name="frmDireccion" class="field-divided" placeholder="Calle y número" required/>&nbsp;
                   <input type="text" id="frmBarrio" name="frmBarrio" class="field-divided" placeholder="Barrio"/>
                   </li>
                <li>
                   <input type="text" id="frmDireccion" name="frmDireccion" class="field-divided" placeholder="Piso" required/>&nbsp;
                   <input type="text" id="frmBarrio" name="frmBarrio" class="field-divided" placeholder="Departamento"/>
                   </li>
                <li>
                    <select name="frmProvincia" id="frmProvincia" class="field-divided">
                    <option value="0">Provincia</option>
                    {provincias}
                    </select>&nbsp;
                    <input type="text" id="frmLocalidad" name="frmLocalidad" class="field-divided" placeholder="Localidad" required/>
                </li>
                <li>
                    <input type="submit" value="Guardar" id="frmGuardarUsuario2">
                    <input type="button" value="Volver" id="frmVolverUsuario">
                </li>
                <input type="hidden" id="metodo" name="metodo" value="" >
                <input type="hidden" id="controlador" name="controlador" value="" >
            </ul>
           </form>
        </p>
    </div>
    ',
        'mensajeError' => $this->getMensaje(),
        'infoUsuario' => $this->getinfoUsu(),
        'mensaje'       => $mensaje, 
        'error'         => $error

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
