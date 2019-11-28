<?php

final class ModeloMedicos extends Modelo {

    public function getMedicos(){
        $sql = "SELECT `pac_id`, `pac_nombreApe`, `pac_direccion`, `pac_piso`, `pac_depto`, `pac_localidad`, p.tdoc_id, `pac_documento`, t.tdoc_descrip
                FROM `pacientes` p 
                INNER JOIN tipos_doc t on p.tdoc_id = t.tdoc_id
                WHERE 1
                ORDER BY 1;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[0] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function getPatologias(){
        $sql = "SELECT * FROM `patologias` WHERE 1 ;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[0] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
    
    
    
    
    
    
    public function addAutor($autor){
        $sql = "insert into autores (nombreApe,nacionalidad,eliminado) values('".$autor->getNombreApe()."','".$autor->getNacionalidad()."',0);";
        $res = "err";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function delAutor($autor){
        $conn = $this->conectarBD();
        $res = "err";
        $sql = "select * from libros where aut_id = ".$autor->getID()." and eliminado = 0;";
        if ($resultado = $conn->query($sql)) {
            if (sizeof($resultado->fetch_all(MYSQLI_NUM)) > 0){
                $res = "libro";
            } 
        else {
            $sql = "update autores set eliminado = 1 where aut_id = ".$autor->getID()." ;";  
            if ($resultado = $conn->query($sql)) {
                $res = "ok";
            } 
        }
    }
       
       $this->desconectarBD($conn);
       return $res;
    }
    public function autorAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select id, nombre as value from paises where nombre like   '" . $dato . "%'  ORDER BY nombre DESC";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
}

?>
