<?php
final class PacientesAddTratamiento extends Vista {
    
protected $mensaje="";
protected $data2 = null;

public function mostrarHTML() {

    $patolog = "";
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $resultados =  $this->getData();
    $resultados2 =  $this->getData2();
    foreach ($resultados as $clave ) {
        //var_dump($clave);
            $patolog = $patolog . "<option value=".$clave[14].">".$clave[15]."</option>";
        }
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Pacientes:</h2>             
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agregar nuevo tratamiento para una patología del Paciente: <br />
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
                    <label>Seleccione Patología <span class="required">*</span></label>
                <li>
                    <select name="frmPat" id="frmPat" class="field-long">
                    <option value="0">Seleccione</option>
                    {patologias}
                    </select>&nbsp;      
                </li>
                <li>
                <label>Ingrese tratamiento<span class="required">*</span></label>
                    <input type="text" id="tratamDescr" name="tratamDescr" class="field-long" placeholder="Nombre" required/>
                </li>
                <li>
                    <textarea name="tratam" id="tratam" placeholder="Descripción" class="field-long" required></textarea>  
                </li>
                <li>
                    <input type="submit" value="Guardar" id="frmGuardarTratam">
                    <input type="button" value="Volver" id="frmVolverUsuarioDet">
                </li>
                <input type="hidden" id="id" name="id" value="'.$resultados[0][0].'" >
                <input type="hidden" id="metodo" name="metodo" value="addTratamientoDo" >
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
        'patologias'    => $patolog

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
    
    public function getData2() {
        return $this->data2;
    }

    public function setData2($data2) {
        $this->data2 = $data2;
    }

}
?>
