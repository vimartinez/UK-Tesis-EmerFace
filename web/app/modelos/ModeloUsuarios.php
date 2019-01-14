<?php

final class ModeloUsuarios extends Modelo {

    public function getSocios(){
        $sql = "SELECT u.usu_ID, u.nombreApe, u.direccion, u.barrio, u.localidad, p.provincia, u.login "
                . " FROM usuarios u"
                . " left join provincias p on u.provincia = p.id "
                . "where perf_id=3 "
                . "and u.eliminado =0;";
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
    public function getProvincias(){
        $sql = "select id, provincia from provincias order by 1 ;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
   public function socioAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select id, localidad as value from localidades where localidad like   '" . $dato . "%'  ORDER BY localidad DESC";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function addSocio($socio){    
        $sql = "INSERT INTO usuarios (perf_ID, nombreApe, login, clave, fechaAlta, fechaBaja, direccion, barrio, localidad, provincia, mail, dni, eliminado) "
                . " VALUES ('"
                                .$socio->getPerfil()."','"
                                .$socio->getNombreApe()."','"
                                .$socio->getLogin()."','"
                                .$socio->getClave()."',sysdate(),null,'"
                                .$socio->getDireccion()."','"
                                .$socio->getBarrio()."','"
                                .$socio->getLocalidad()."','"
                                .$socio->getProvincia()."','"
                                .$socio->getMail()."','"
                                .$socio->getDNI()."',0);"; 
        $res = "err";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function delSocio($socio){
        $conn = $this->conectarBD();
        $res = "err";
        $sql = "update usuarios set eliminado = 1 where usu_id = ".$socio->getID()." ;";  
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
        }   
       $this->desconectarBD($conn);
       return $res;
    }
    public function getSocio($soc_id,$soc_nombre){      
        $sql = 'SELECT u.usu_ID, u.nombreApe, u.dni, u.direccion, u.barrio, u.localidad, p.provincia, s.san_id, s.pres_id, s.tip_id, s.fechaIni, DATE_FORMAT(s.fechaFin, "%e/%m/%Y"), IF(fechafin  > curdate(), 1, 0) as activa 
                FROM usuarios u 
                left join provincias p on u.provincia = p.id 
                left join sanciones s on u.usu_id = s.usu_id
                where u.eliminado = 0 ';
        if ($soc_id != "") $sql = $sql . " and u.usu_ID =".$soc_id;
        if ($soc_nombre != "") $sql = $sql . " and u.nombreApe ='".$soc_nombre."';";
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
    public function socioAutocomplete2($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select usu_id as id, nombreApe as value from usuarios where nombreApe like '" . $dato . "%' and eliminado = 0 order by nombreApe desc;";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function getReservas($soc_id){      
        $sql = 'select r.res_id, r.usu_id, r.cop_id, r.fechaini, DATE_FORMAT(r.fechafin, "%e/%m/%Y"), l.isbn, l.nombre, l.genero, l.subgenero, l.editorial, a.nombreApe, c.copia, c.calle, c.pasillo, c.estante
                from reservas r 
                inner join libros l on r.lib_id = l.lib_id 
                inner join autores a on l.aut_id = a.aut_id 
                inner join copias c on l.lib_id = c.lib_id
                where r.usu_id = '.$soc_id.' 
                and r.fechaFin > sysdate() 
                and r.realizada = 0
                and r.cop_id = c.cop_id
                and r.usu_id = '.$soc_id.';';
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[0] = "No se encontraron reservas activas para este socio.";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function getSociosDeudores(){
        $sql = 'select p.pres_ID , p.usu_ID, p.lib_ID, p.cop_id, DATE_FORMAT(p.fechaIni, "%e/%m/%Y") as Desde, DATE_FORMAT(p.fechaFin, "%e/%m/%Y")as Hasta, l.aut_ID, l.nombre, a.nombreApe, u.nombreApe, c.copia
                from prestamos p
                inner join libros l on p.lib_id = l.lib_id 
                inner join usuarios u on p.usu_id = u.usu_id
                inner join autores a on l.aut_id = a.aut_id 
                inner join copias c on p.cop_id = c.cop_id 
                where devuelto = 0
                and TIMESTAMPDIFF(DAY, p.fechaFin, CURDATE()) >=1;';
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
    public function addSancion($soc_id, $diasSancion){
        $res = "err";
        $conn = $this->conectarBD();
        $sql = 'INSERT INTO sanciones
                (pres_ID,tip_ID,usu_ID,fechaIni,fechaFin)
                VALUES(null,1,'.$soc_id.',sysdate(),DATE_ADD(CURDATE(), INTERVAL '.$diasSancion.' DAY));';
        $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $res = "ok";
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function getUsuarios(){
        $sql = "SELECT u.usu_ID, u.nombreApe, u.direccion, u.barrio, u.localidad, p.provincia, u.login, pe.nombre 
                 FROM usuarios u 
                 inner join perfiles pe on u.perf_id = pe.perf_id 
                 left join provincias p on u.provincia = p.id 
                where  u.eliminado =0;";
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
    public function getPerfiles(){
        $sql = "select perf_id, nombre from perfiles order by 1";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
}

?>
