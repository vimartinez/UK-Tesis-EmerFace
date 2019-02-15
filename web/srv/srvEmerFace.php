<?php
require_once("../app/inc/modelo.php");

final class srvEmerFace extends Modelo {
    
    protected $res = array();
    
    public function getFechaHora($pp){
        $sql = "SELECT NOW();";
        $conn = $this->conectarBD();
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0){
            $res = $resultado->fetch_all(MYSQLI_NUM);
            $resultado->close();
            
            $datos["estado"] = 1;
            $datos["fechaHora"] = $res[0];
            print json_encode($datos);
            } 
            else {
                print json_encode(array(
                    "estado" => 2,
                    "mensaje" => "Ha ocurrido un error"
                ));
            }
       $this->desconectarBD($conn);
       return json_encode($res);   
    }
    
     public function getPaciente($pacId){
        $sql = "SELECT pac_id, pac_nombreApe, pac_direccion, pac_piso, pac_depto, pac_localidad, tdoc_id, pac_documento, Pac_grupoSang, DATE_FORMAT(pac_FechaNac,'%d/%m/%Y') as fec_nac, pac_sexo, pp.provincia FROM pacientes p inner join provincias pp on p.prov_id = pp.id WHERE pac_id = $pacId ;";
        $conn = $this->conectarBD();
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0){
            $res = $resultado->fetch_array(MYSQLI_NUM);
            $resultado->close();
            
            $datos["estado"] = 1;
            $datos["resultados"] = $res;
            print json_encode($datos);
            } 
            else {
                print json_encode(array(
                    "estado" => 2,
                    "mensaje" => "Ha ocurrido un error"
                ));
            }
       $this->desconectarBD($conn);
       //return json_encode($res);   
    }
    public function getPatologiasPaciente($pacId){
        $sql = "select * from pacientes_patologias pp inner join patologias p on pp.pat_id = p.pat_id where pac_id = $pacId  order by pat_critica desc;";
        $conn = $this->conectarBD();
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0){
            $res = $resultado->fetch_all(MYSQLI_NUM);
            $resultado->close();
            
            $datos["estado"] = 1;
            $datos["resultados"] = $res;
            print json_encode($datos);
            } 
            else {
                print json_encode(array(
                    "estado" => 1,
                    "mensaje" => "No se registran patologías para este paciente"
                ));
            }
       $this->desconectarBD($conn);   
    }
    
        public function getTragamientosPaciente($pacId){
        $sql = "select * from pac_pat_tratam ppt inner join patologias p on ppt.pat_id = p.pat_id where ppt.pac_id = $pacId order by pat_critica desc;";
        $conn = $this->conectarBD();
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0){
            $res = $resultado->fetch_all(MYSQLI_NUM);
            $resultado->close();
            
            $datos["estado"] = 1;
            $datos["resultados"] = $res;
            print json_encode($datos);
            } 
            else {
                print json_encode(array(
                    "estado" => 1,
                    "mensaje" => "No se registran Tratamientos para este paciente."
                ));
            }
       $this->desconectarBD($conn);   
    }
    public function getPersContPaciente($pacId){
        $sql = "select * from personas_contacto pc inner join provincias p on pc.prov_id = p.id where pac_id = $pacId ;";       
        $conn = $this->conectarBD();
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0){
            $res = $resultado->fetch_all(MYSQLI_NUM);
            $resultado->close();
            
            $datos["estado"] = 1;
            $datos["resultados"] = $res;
            print json_encode($datos);
            } 
            else {
                print json_encode(array(
                    "estado" => 1,
                    "mensaje" => "No se registran Personas de contacto para este paciente."
                ));
            }
       $this->desconectarBD($conn);   
    }
    
    public function getImgPaciente($pacId){
        $sql = "select img_path from img_pacientes where pac_id = $pacId  LIMIT 1;";       
        $conn = $this->conectarBD();
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0){
            $res = $resultado->fetch_all(MYSQLI_NUM);
            $resultado->close();
            
            $datos["estado"] = 1;
            $datos["resultados"] = $res[0][0]; //$_SERVER['SERVER_ADDR']."/".$res[0][0];
            print json_encode($datos);
            } 
            else {
                print json_encode(array(
                    "estado" => 1,
                    "mensaje" => "No se imagenes"
                ));
            }
       $this->desconectarBD($conn);   
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $metodo = $_GET["metodo"];
    $pacId =  $_GET["pacId"];
    $servicio = new srvEmerFace("");
    $servicio->$metodo($pacId);
}


