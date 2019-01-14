<?php
final class PacientesAddPatologia extends Vista {
    
protected $mensaje="";
protected $data2 = null;

public function mostrarHTML() {

    $patolog = "";
    $resultados =  $this->getData();
    $resultados2 =  $this->getData2();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    foreach ($resultados2 as $clave ) {
            $patolog = $patolog . "<option value=".$clave[0].">".$clave[1]."</option>";
        }
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Pacientes:</h2>             
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Se asociará una nueva patología al Paciente: <br />
        </p>
        
         <p id="frmAltaAutores">
          <form id="frmAutores" method="post" action="index.php" name="frmMenu" >
          <ul class="form-style-1">
            {mensaje}{error}
                <li>
                    <p><b>'.$resultados[1].'</b> DNI: '.$resultados[7].' 
                    Dirección: '.$resultados[2].' '.$resultados[3].' '.$resultados[4].'
                    </p>
                </li>
                <li>
                    <label>Seleccione Patología <span class="required">*</span></label>
                <li>
                    <select name="frmPat" id="frmPat" class="field-divided">
                    <option value="0">Seleccione</option>
                    {patologias}
                    </select>&nbsp;
                    <input type="submit" value="Guardar" id="frmGuardarPatologia">
                </li>
                <li>
                    
                    <input type="button" value="Volver" id="frmVolverUsuarioDet">
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
