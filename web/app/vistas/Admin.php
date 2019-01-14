<?php
final class Admin extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
    $resultados =  $this->getData();
    if (isset($resultados[0][1])) {
        $tabla = '<h3>Opciones de usuario '.$_SESSION['perfNombre'].'</h3>' . '<ul class="list">';
        $primero = true;
        foreach ($resultados as $clave ) {
            if ($primero){
                 $tabla = $tabla .'<li class="first"><a href="#" id="func-'.$clave[0].'" title="'.$clave[2].'">'.$clave[1].'</a></li>';
                 $primero = false; 
            }
            else {
                 $tabla = $tabla .'<li ><a href="#" id="func-'.$clave[0].'" title="'.$clave[2].'">'.$clave[1].'</a></li>';
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
                    <h2>Contenido disponible para integrantes de nuestro staff</h2>'
                    .$tabla.
                '</div>
                ',
            'mensajeError' => $this->getMensaje(),
            'infoUsuario' => $this->getinfoUsu()
        );



/*
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Contenido disponible para integrantes de nuestro staff</h2>
                    <div id="contenidoNoLogin" >  
                        <p >
                            Para visualizar estos contenidos debe iniciar sesión como miembro de nuestra empresa<br /><br />
                            <br /> &nbsp; <br />
                        </p>
                    </div>
                    <div id="contenidoLogin"  >   
                        <div class="box">
                            <h3>Opciones de usuario '.$_SESSION['perfNombre'].'</h3>
                            <ul class="list">
                                <li class="first"><a href="#">Gestión de usuarios</a></li>
                                <li><a href="gestionLibros.aspx">Gestión de catálogo</a></li>
                                <li><a href="PrestamoLibros.aspx">Préstamo de libros</a></li>
                                <li><a href="verConsultas.aspx">Revisar Consultas</a></li>
                                <li><a href="#">Devolución de libros</a></li>
                                <li><a href="#">Listado de libros en biblioteca</a></li>
                                <li><a href="#">Listado de libros prestados</a></li>
                                <li><a href="#">Listado de socios deudores</a></li>
                            </ul>
                        </div>
                    </div>
                </div>',
            'mensajeError' => $this->getMensaje(),
            'infoUsuario' => $this->getinfoUsu()
        );*/
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
