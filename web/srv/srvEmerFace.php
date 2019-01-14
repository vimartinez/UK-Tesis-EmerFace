<?php
require_once("../app/inc/modelo.php");

final class srvEmerFace extends Modelo {
    
   
    
    public function getFechaHora(){
        $sql = "SELECT NOW();";
        $res = array();
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
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $servicio = new srvEmerFace("");
    $servicio->getFechaHora();
}


