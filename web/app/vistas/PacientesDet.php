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
       
    foreach ($resultados2 as $clave ) {
            if ($clave[12] != ""){
                $trat = $trat . "<b>" .$clave[15] . "</b>". ": ". $clave[14] . '<br>';
            }
        }
    if ($trat == "") $trat = "No se registran tratamientos para este paciente";
    foreach ($resultados3 as $clave ) {
        //var_dump($clave);
            if ($clave[12] != ""){
                $pers = $pers ."<b>". $clave[14] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> DNI:". $clave[15] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tel:<b>'.$clave[16].  '</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>'.$clave[17].  '</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '. ' mail: '. $clave[18] .' Dirección: ' .$clave[19] .' '. $clave[20].' '. $clave[21] .' - '. $clave[22].' - '. $clave[26].'<br>' ;
            }
        }
    if ($pers == "") $pers = "No se registran personas de contacto para este paciente";

    foreach ($resultados as $clave ) {
            //var_dump($clave);
            if ($clave[12] != ""){
                $pat = $pat . $clave[15] .  '<br>';
            }
        }
    if ($pat == "") $pat = "No se registran patologías para este paciente";
    
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Detalle de Paciente:</h2>             
        <p>
           Nombre: <b>'.$clave[1].'</b> DNI: '.$clave[7].' Fecha de nacimiento '.$clave[9].'<br />
           Dirección: '.$clave[2].' '.$clave[3].' '.$clave[4].' - '.$clave[5].' - '.$clave[19].'
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

            <ul class="form-style-1" >
                <li>
                 <input type="button" value="Nueva Patología" id="frmNuevaPat">
                 <input type="button" value="Nuevo Tratamiento" id="frmNuevoTrat">
                 <input type="button" value="Nuevo Contacto" id="frmNuevaPersCont">
                 <input type="button" value="Ingresar Fotos" id="frmNuevaImagen">
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
