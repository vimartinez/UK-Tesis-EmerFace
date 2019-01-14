<?php
final class PacientesDet extends Vista {

    protected $data2 = null;
    protected $data3 = null;
    protected $pacId = null;
    public function mostrarHTML() {

    $resultados =  $this->getData();
    $resultados2 =  $this->getData2();
    $resultados3 =  $this->getData3();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    $pat = "";
    $trat = "";
    $pers = "";
    foreach ($resultados as $clave ) {
            if ($clave[8] != ""){
                $pat = $pat . $clave[11] . '<br>';
            }
        }
    foreach ($resultados2 as $clave ) {
            if ($clave[8] != ""){
                $trat = $trat . $clave[10] . ": ". $clave[11] . '<br>';
            }
        }
    foreach ($resultados3 as $clave ) {
            if ($clave[8] != ""){
                $pers = $pers . $clave[10] . " DNI ". $clave[11] . ' Tel:'.$clave[12].  ' - '.$clave[13]. '<br> mail: '. $clave[14] .' Dirección: ' .$clave[15] .' '. $clave[16] ;
            }
        }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Detalle de Paciente:</h2>             
        <p>
           Nombre:<b>'.$clave[1].'</b> DNI: '.$clave[7].'<br />
           Dirección: '.$clave[2].' '.$clave[3].' '.$clave[4].'
        </p>
        <div class="box2">
            <h2>Patologías:</h2>
            <p>'.$pat.'</p>
        </div>
        <div class="box2">
            <h2>Tratamientos:</h2>
            <p>'.$trat.'</p>
        </div>
        <div class="box2">
            <h2>Personas de contacto:</h2>
            <p>'.$pers.'</p>
        </div>

            <ul class="form-style-1">
                <li>
                 <input type="button" value="Agregar Patología" id="frmNuevaPat">
                 <input type="button" value="Agregar Tratamiento" id="frmNuevoTrat">
                 <input type="button" value="Agregar Persona de contacto" id="frmNuevaPersCont">
                 <input type="button" value="Volver" id="frmVolverLibro">
                 <input type="hidden"  value="'.$this->getPacId().'" id="pacId" name="pacId">
                </li>
            </ul>
        </p>
    </div>',
        'mensajeError' => $this->getMensaje(),
        'infoUsuario' => $this->getinfoUsu(),
        'tablaLibros' => $tabla,
        'mensaje'       => $mensaje, 
        'error'         => $error

    );
    foreach ($diccionario as $clave=>$valor){
        $this->template = str_replace('{'.$clave.'}', $valor, $this->template);
    }
    print $this->template;
    } 
    public function getData2() {
        return $this->data2;
    }

    public function setData2($data2) {
        $this->data2 = $data2;
    }
    public function getData3() {
        return $this->data3;
    }

    public function setData3($data3) {
        $this->data3 = $data3;
    }
    function getPacId() {
        return $this->pacId;
    }

    function setPacId($pacId) {
        $this->pacId = $pacId;
    }


}
?>
