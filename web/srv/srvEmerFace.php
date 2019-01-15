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
        $sql = "select * from pacientes where pac_id = $pacId ;";
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
                    "estado" => 2,
                    "mensaje" => "Ha ocurrido un error"
                ));
            }
       $this->desconectarBD($conn);
       //return json_encode($res);   
    }
    public function getPatologiasPaciente($pacId){
        $sql = "select * from pacientes_patologias pp inner join patologias p on pp.pat_id = p.pat_id where pac_id = $pacId ;";
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
                    "mensaje" => "No se registran patologias"
                ));
            }
       $this->desconectarBD($conn);   
    }
    
    public function getTragamientosPaciente($pacId){
        $sql = "select * from pac_pat_tratam where pac_id = $pacId ;";
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
                    "mensaje" => "No se registran Tratamientos"
                ));
            }
       $this->desconectarBD($conn);   
    }
    public function getPersContPaciente($pacId){
        $sql = "select * from personas_contacto where pac_id = $pacId ;";       
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
                    "mensaje" => "No se registran Personas de contacto"
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


