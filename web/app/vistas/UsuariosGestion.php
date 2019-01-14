<?php
final class UsuariosGestion extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $resultados =  $this->getData();
    if (isset($resultados[0][1])) {
        $tabla = '<ul class="list">';
        $primero = true;
        foreach ($resultados as $clave ) {
            if ($primero){
                $tabla = $tabla .' <tr style="cursor:pointer" id="'.$clave[0].'" ><td>'.$clave[0].'</td><td>'.$clave[1].'</td><td>'.$clave[6].'</td><td>'.$clave[7].'</td><td>'.$clave[2].'</td><td>'.$clave[3].'</td><td>'.$clave[4].'</td><td>'.$clave[5].'</td><td><input type="checkbox" ></td><td><img src= ../web/img/delete.png id="delUsuario" title="Eliminar usuario" style="cursor:pointer" alt="X" ></img></td></tr>';
            }
            else {
                 $tabla = $tabla .'<li ><a href="#" title="'.$clave[2].'">'.$clave[1].'</a></li>';
            }
        }
        $tabla = $tabla . '</ul>';
    }
    else {
        $tabla = $resultados;
    }
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Gestión de usuarios:</h2>             
                    <p>
                        Listado de usuarios <br />
                    </p> 
                    {mensaje}{error}
                    <table style="width:80%" class="tabla-1" id="tablaUsuarios">
                    <tr >
                        <th>Número</th>
                        <th>Nombre</th>
                        <th>Login</th>
                        <th>Perfil</th>
                        <th>Dirección</th>
                        <th>Barrio</th>
                        <th>Localidad</th>
                        <th>Provincia</th>
                        <th> </th>
                        <th> </th>
                    </tr>'
                    .$tabla.
                '</table>
                <ul class="form-style-1">
                <li>
                    <input type="button" value="Nuevo Usuario" id="frmNuevoUsuario">
                    <input type="button" value="Modificar" id="frmVolverStaff">
                    <input type="button" value="Eliminar" id="frmVolverStaff">
                    <input type="button" value="Blanquear Clave" id="frmVolverStaff">
                    <input type="button" value="Volver" id="frmVolverStaff">
                </li>
                 </ul>
                </div>
                ',
            'mensajeError'  => $this->getMensaje(),
            'infoUsuario'   => $this->getinfoUsu(),
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
