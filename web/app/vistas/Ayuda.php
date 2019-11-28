<?php
final class Ayuda extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
   // $resultados =  $this->getData();
        $tabla = '<ul class="list">';
        $tabla = $tabla .'<li class="first"><a href="#">Manual de Usuario</a></li><li><a href="#">Ayuda en Línea</a></li>';
        $tabla = $tabla . '</ul>';
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Ayuda del Sistema</h2> '
                    .$tabla.
                '</div>
                ',
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
