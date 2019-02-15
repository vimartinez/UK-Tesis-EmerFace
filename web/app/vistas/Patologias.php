<?php
final class Patologias extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {

    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    foreach ($resultados as $clave ) {
            $patCrit = $clave[3]==1? "<b>Si</b>" : "No";
            $tabla = $tabla .' <tr id="'.$clave[0].'"><td>'.$clave[0].'</td><td>'.$clave[1].'</td><td>'.$clave[2].'</td><td>&nbsp;&nbsp;&nbsp;'.$patCrit.'</td>';
        }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Listado de Patologías:</h2>             
        <p>
            Muestra las patologías registradas en el sistema: <br />
        </p>
         <p id="frmAltaAutores">
             <table style="width:60%" class="tabla-1" id="tablaAutores">
             {mensaje}{error}
              <tr>
                <th>Patología</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Crítica</th>
              </tr>
              {tablaAutores}
            </table><br />
            <div align="Center"> ... 1 2 3 4 5 ... <br/>
            <ul class="form-style-1">
                <li>
                    <input type="button" value="Volver" id="frmVolverStaff">
                </li>
            </ul>
        </p>
    </div>',
        'mensajeError' => $this->getMensaje(),
        'infoUsuario' => $this->getinfoUsu(),
        'tablaAutores' => $tabla,
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
