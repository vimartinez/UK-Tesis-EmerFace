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
                . "LEFT JOIN provincias pr on p.prov_id = pr.id "
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
                . "LEFT JOIN provincias pp on pc.prov_id = pp.id "
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
    
    public function addPaciente($frmNombre,$frmDNI,$frmMail,$frmDireccion,$frmBarrio,$frmPiso,$frmDepto,$frmProvincia,$frmLocalidad, $grupoSanguineo, $fechaNac, $sexo){
        //$res = array();
        $conn = $this->conectarBD();
        
        $sql = "select max(pac_id) from pacientes;";
        $resultado = $conn->query($sql);
         if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
              }  
        $pacID =  (int)$res[0][0]+1 ;   
        $sql = "INSERT INTO pacientes(pac_id, pac_nombreApe, pac_direccion, pac_piso, pac_depto, pac_localidad, tdoc_id, pac_documento, Pac_grupoSang, pac_FechaNac, pac_sexo, prov_id) "
                . "VALUES ($pacID,'$frmNombre','$frmDireccion','$frmPiso','$frmDepto','$frmLocalidad',1,$frmDNI,'$grupoSanguineo','$fechaNac','$sexo',$frmProvincia);";
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
    
   public function addTratamiento($pacienteID,$patologiaID,$tratamNombre,$tratamDescrip){
        //$res = array();
        $conn = $this->conectarBD();       
        $sql = "INSERT INTO pac_pat_tratam(pat_id, pac_id, trat_nombre, trat_descrip) VALUES ($patologiaID,$pacienteID,'$tratamNombre','$tratamDescrip')";
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
    
    public function addPersonaContacto($nombre,$dNI,$mail,$direccion,$barrio,$provincia,$localidad,$pacId,$tel,$relacion,$piso,$depto){
        //$res = array();
        $conn = $this->conectarBD(); 
        $sql = "select max(pers_id) from personas_contacto;";
        $resultado = $conn->query($sql);
         if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
              }  
        $persId =  (int)$res[0][0]+1 ;       
        $sql = "INSERT INTO personas_contacto(pers_id, pac_id, pers_nombreApe, pers_documento, pers_telefono, pers_relacion, pers_mail, pers_direccion, pers_piso, pers_depto, pers_localidad, prov_id, tdoc_id) "
                . "VALUES ($persId,$pacId,'$nombre','$dNI','$tel','$relacion','$mail','$direccion','$piso','$depto','$localidad',$provincia,1);";
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
    
    public function addImagenes($pacienteID,$imgagenes){
        //$res = array();
       //   return $res = "ok";
        $conn = $this->conectarBD();
        $sql = "select max(img_id) from img_pacientes;";
        $resultado = $conn->query($sql);
         if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
              }  
        $imgId =  (int)$res[0][0]+1 ;
        for ($i=0;$i<8;$i++){
            if ($imgagenes[$i] != ""){
                $sql = "INSERT INTO img_pacientes(img_id, pac_id, img_img, img_path) "
                        . "VALUES ($imgId,$pacienteID,'$imgagenes[$i]','')";
                //var_dump($sql); die();
                if ($resultado = $conn->query($sql)) {
                    $res = "ok";
                    $imgId = $imgId +1;
                }
                else {
                    $error = 1;
                }
            }
        }
        if ($error == 1) {
            $res[0] = "err";
        }  
        $this->desconectarBD($conn);
       
       return $res;
    }
    
    public function addImagenes2($idPaciente,$imgNombre,$imgTmpNombre){
        $rutaImg = "web/imgPacientes/". $idPaciente ;
        
        if (!file_exists($rutaImg)){
            mkdir($rutaImg);
        }
        $rutaImg = $rutaImg  . "/" . $imgNombre;
        $resultadoCopia = @move_uploaded_file($imgTmpNombre, $rutaImg);
        $res[0] = "err";
        if (!empty($resultadoCopia)){
            $conn = $this->conectarBD();
            $sql = "select max(img_id) from img_pacientes;";
            $resultado = $conn->query($sql);
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
              }  
            $imgId = (int)$res[0][0]+1;
            $sql = "INSERT INTO img_pacientes(img_id, pac_id, img_img, img_path) "
                        . "VALUES ($imgId,$idPaciente,'','$rutaImg')";
            if ($resultado = $conn->query($sql)) {
                    $res = "ok";
                }
            $this->desconectarBD($conn);
        }  
       return $res;
    }
    
    public function getImagenesPaciente($idPaciente){
        $conn = $this->conectarBD();
        $res[0] = "err";
        $sql = "select * from img_pacientes where pac_id = $idPaciente;";
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0){
            $res = $resultado->fetch_all(MYSQLI_NUM);
            $resultado->close();
          }  
        $this->desconectarBD($conn);
       return $res;
    }
}

?>
