<?php
final class Login extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Ingreso al sistema:</h2> 
                    <div class="msgError">{mensajeError} </div>                                
                     <form id="frmlogin" name="frmlogin" method="post" action="index.php" class="form-style-1">
                      <ul class="form-style-1">
                       <li>
                           <label>USUARIO <span class="required">*</span></label>
                           <input type="text" id="frmLoginUsu" name="frmLoginUsu" class="field-long" required/>
                        </li>
                        <li>
                           <label>CLAVE <span class="required">*</span></label>
                           <input type="password" id="frmLoginClave" name="frmLoginClave" class="field-long" required/>
                        </li>
                        <li>
                            <input type="submit" value="Ingresar" id="frmLoginEnviar">
                        </li>
                        <input type="hidden" id="metodo" name="metodo" value="" >
                        <input type="hidden" id="controlador" name="controlador" value="" >
                     </ul>
                    </form>
                    <p>
                        Si no está registrado debe solicitar un usuario al administrador del sistema.
                    </p>          
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
