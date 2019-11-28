<?php
final class PacientesAddImagen2 extends Vista {
    
protected $mensaje="";
protected $data2 = null;

public function mostrarHTML() {

    $patolog = "";
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $resultados =  $this->getData();
    $resultados2 =  $this->getData2();
    $pathImagenes[8] = null;
    for ($i=0;$i<8;$i++){
        $pathImagenes[$i] = "web/img/pacientey.jpg";
    }
    $i =0;
    if ($resultados2 != null){
        foreach ($resultados2 as $clave ) {
            $pathImagenes[$i] = $clave[3];
            $i++;
        }
    }
    
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Registro de imágenes de paciente:</h2>             
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agregar nuevas imágenes para reconocimiento del Paciente: <br />
        </p>
        
         <p id="frmAltaAutores">
          
          <ul class="form-style-1">
            {mensaje}{error}
                <li>
                    <p><b>'.$resultados[0][1].'</b> DNI: '.$resultados[0][7].' 
                    Dirección: '.$resultados[0][2].' '.$resultados[0][3].' '.$resultados[0][4].'
                    </p>
                </li>
                <li>
                    <label>Seleccione Imagenes <span class="required">*</span></label>
                <li>
                    <img src="'.$pathImagenes[0].'" height="105" width="105" id=img1 style="border:1px solid black;"> &nbsp;&nbsp;&nbsp;
                    <img src="'.$pathImagenes[1].'" height="105" width="105" id=img2 style="border:1px solid black;"> &nbsp;&nbsp;&nbsp;
                    <img src="'.$pathImagenes[2].'" height="105" width="105" id=img3 style="border:1px solid black;"> &nbsp;&nbsp;&nbsp;
                    <img src="'.$pathImagenes[3].'" height="105" width="105" id=img4 style="border:1px solid black;"> &nbsp;&nbsp;&nbsp;
                </li>
                <li>
                    <img src="'.$pathImagenes[4].'" height="105" width="105" id=img5 style="border:1px solid black;"> &nbsp;&nbsp;&nbsp;
                    <img src="'.$pathImagenes[5].'" height="105" width="105" id=img6 style="border:1px solid black;"> &nbsp;&nbsp;&nbsp;
                    <img src="'.$pathImagenes[6].'" height="105" width="105" id=img7 style="border:1px solid black;"> &nbsp;&nbsp;&nbsp;
                    <img src="'.$pathImagenes[7].'" height="105" width="105" id=img8 style="border:1px solid black;"> &nbsp;&nbsp;&nbsp;
                </li>
                <form id="frmAutores" method="post" action="index.php" name="frmAutores" enctype="multipart/form-data" >
                <li>
                    <input type="file" id="imgInp" name="imgInp" style="visibility:hidden" />
                    <input type="submit" value="Guardar" id="frmGuardarImgs">
                    <input type="button" value="Volver" id="frmVolverUsuarioDet">
                    <input type="hidden" id="idImagen" name="idImagen" value="" >
                </li>
                <input type="hidden" id="id" name="id" value="'.$resultados[0][0].'" >
                <input type="hidden" id="metodo" name="metodo" value="addImagenesDo2" >
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
