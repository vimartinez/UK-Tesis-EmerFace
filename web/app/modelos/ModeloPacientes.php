<?php

final class ModeloPacientes extends Modelo {

    public function getPacientes(){
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
    
    public function getPacienteDet($PacID){
        $sql = "SELECT * FROM pacientes p "
                . "LEFT JOIN pacientes_patologias pp ON p.pac_id = pp.pac_id "
                . "LEFT JOIN patologias pa ON pa.pat_id = pp.pat_id "
                . "WHERE p.pac_id = ".$PacID." ;";
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
    
     public function getTratamientosXPaciente($PacID){
        $sql = "SELECT * FROM pacientes p "
                . "LEFT JOIN pac_pat_tratam ppt on p.pac_id = ppt.pac_id "
                . "WHERE p.pac_id = ".$PacID." ;";
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
    
    public function getPersonasXPaciente($PacID){
        $sql = "SELECT * FROM pacientes p "
                . "LEFT JOIN personas_contacto pc on p.pac_id = pc.pac_id "
                . "WHERE p.pac_id = ".$PacID." ;";
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
    
    public function addPaciente($frmNombre,$frmDNI,$frmMail,$frmDireccion,$frmBarrio,$frmPiso,$frmDepto,$frmProvincia,$frmLocalidad){
        //$res = array();
        $conn = $this->conectarBD();
        
        $sql = "select max(pac_id) from pacientes;";
        $resultado = $conn->query($sql);
         if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
              }  
        $pacID =  (int)$res[0][0]+1 ;   
        $sql = "INSERT INTO pacientes(pac_id, pac_nombreApe, pac_direccion, pac_piso, pac_depto, pac_localidad, tdoc_id, pac_documento) "
                . "VALUES ($pacID,'$frmNombre','$frmDireccion','$frmPiso','$frmDepto','$frmLocalidad',1,$frmDNI);";
        //var_dump($sql); die();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            $this->desconectarBD($conn);
        }
        else {  
                $res[0] = "err";
                $this->desconectarBD($conn);
            }
       
       return $res;
    }
    
    public function addPatologiaPaciente($pacienteID,$patologiaID){
        //$res = array();
        $conn = $this->conectarBD();
        
           
        $sql = "INSERT INTO pacientes_patologias(pat_id, pac_id) VALUES ($patologiaID,$pacienteID)";
        //var_dump($sql); die();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            $this->desconectarBD($conn);
        }
        else {  
                $res[0] = "err";
                $this->desconectarBD($conn);
            }
       
       return $res;
    }
}

?>
