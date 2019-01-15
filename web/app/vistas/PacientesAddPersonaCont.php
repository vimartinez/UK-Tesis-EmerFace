<?php
final class PacientesAddPersonaCont extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {

    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $resultados =  $this->getData();
    $provincias = "<option value=1>Buenos Aires</option>
		<option value=2>Buenos Aires-GBA</option>
                <option value=3>Capital Federal</option>
		<option value=4>Catamarca</option>
	 	<option value=5>Chaco</option>
	 	<option value=6>Chubut</option>
	 	<option value=7>Córdoba</option>
	 	<option value=8>Corrientes</option>
	 	<option value=9>Entre Ríos</option>
	 	<option value=10>Formosa</option>
	 	<option value=11>Jujuy</option>
	 	<option value=12>La Pampa</option>
		<option value=13>La Rioja</option>
	 	<option value=14>Mendoza</option>
	 	<option value=15>Misiones</option>
		<option value=16>Neuquén</option>
		<option value=17>Río Negro</option>
	 	<option value=18>Salta</option>
	 	<option value=19>San Juan</option>
		<option value=20>San Luis</option>
	 	<option value=21>Santa Cruz</option>
		<option value=22>Santa Fe</option>
		<option value=23>Santiago del Estero</option>
	 	<option value=24>Tierra del Fuego</option>
	 	<option value=25>Tucumán</option>";
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Pacientes:</h2>             
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agregar persona de contacto para el Paciente: <br />
        </p>
         <p id="frmAltaAutores">
          <form id="frmAutores" method="post" action="index.php" name="frmMenu" >
          <ul class="form-style-1">
            {mensaje}{error}
            <li>
                    <p><b>'.$resultados[0][1].'</b> DNI: '.$resultados[0][7].' 
                    Dirección: '.$resultados[0][2].' '.$resultados[0][3].' '.$resultados[0][4].'
                    </p>
                </li>
                <li>
                    <label>Ingrese los datos de la persona de contacto <span class="required">*</span></label>
                    <input type="text" id="frmNombre" name="frmNombre" class="field-long" placeholder="Nombre" required />
                </li>
                 <li>
                   <input type="number" id="frmDNI" name="frmDNI" class="field-divided" placeholder="DNI" min="1000000" max="99000000" required/>&nbsp;
                   <input type="email" id="frmMail" name="frmMail" class="field-divided" placeholder="Mail" required/>
                </li>  
                <li>
                   <input type="text" id="frmTel" name="frmTel" class="field-divided" placeholder="Teléfono"  required/>&nbsp;
                   <input type="text" id="frmRelacion" name="frmRelacion" class="field-divided" placeholder="Relación - Parentezco" required/>
                </li>  
                <li>
                   <label>Dirección <span class="required">*</span></label>
                   <input type="text" id="frmDireccion" name="frmDireccion" class="field-divided" placeholder="Calle y número" required/>&nbsp;
                   <input type="text" id="frmBarrio" name="frmBarrio" class="field-divided" placeholder="Barrio"/>
                   </li>
                <li>
                   <input type="text" id="frmPiso" name="frmPiso" class="field-divided" placeholder="Piso" />&nbsp;
                   <input type="text" id="frmDepto" name="frmDepto" class="field-divided" placeholder="Departamento"/>
                   </li>
                <li>
                    <select name="frmProvincia" id="frmProvincia" class="field-divided">
                    <option value="0">Provincia</option>
                    {provincias}
                    </select>&nbsp;
                    <input type="text" id="frmLocalidad" name="frmLocalidad" class="field-divided" placeholder="Localidad" required/>
                </li>
                <li>
                    <input type="submit" value="Guardar" id="frmGuardarPesContact">
                    <input type="button" value="Volver" id="frmVolverUsuario">
                </li>
                <input type="hidden" id="id" name="id" value="'.$resultados[0][0].'" >
                <input type="hidden" id="metodo" name="metodo" value="addPersonContactoDo" >
                <input type="hidden" id="controlador" name="controlador" value="ControladorPacientes" >
            </ul>
           </form>
        </p>
    </div>
    ',
        'mensajeError' => $this->getMensaje(),
        'infoUsuario' => $this->getinfoUsu(),
        'mensaje'       => $mensaje, 
        'error'         => $error,
        'provincias'    => $provincias

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
