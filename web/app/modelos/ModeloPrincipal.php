<?php

final class ModeloPrincipal extends Modelo {

    public function iniciarSesion($Usu, $clave) {
        $conn = $this->conectarBD();
       
        $consulta = "SELECT * from usuarios u 
                    inner join perfiles p on u.perf_ID = p.perf_ID 
                    where u.login='" . $Usu . "' and u.clave='".$clave."' ";

        if ($resultado = $conn->query($consulta)) {
            if($resultado->num_rows>0){
                while ($fila = $resultado->fetch_row()) {
                    $_SESSION['idUsuario'] =$fila[0]; 
                    $_SESSION['idPerfil'] =$fila[1]; 
                    $_SESSION['usuNombre'] =$fila[2];
                    $_SESSION['usuLogin'] =$fila[3];
                    $_SESSION['perfNombre'] =$fila[15];
                    $_SESSION['datosUsu'] = $_SESSION['usuNombre'] . " (".$_SESSION['usuLogin'] . ")" . " <br> " . $_SESSION['perfNombre'];
                   
                }
                $resultado->close();
                $msg = "ok";
                } 
            else {  
                $msg = "Usuario o clave incorrectos";
            }
        }
       $this->desconectarBD($conn);
       return $msg;       
    }
    public function getFuncionalidades($idPerfil){
        $sql = "select f.func_ID, f.descripcion, f.comentario from perf_funcionalidad pf
                inner join funcionalidades f ON pf.func_ID = f.func_ID
                WHERE pf.per_ID =$idPerfil
                 AND pf.eliminado =0;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "No se encontraron resultados";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function getCatalogo($libro){
        if ($libro != null){
            $sql = "select l.lib_ID, l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial , l.isbn , l.resena, count(*)
            from libros l 
            inner join autores a on l.aut_id = a.aut_id  
            inner join copias c on l.lib_ID = c.lib_ID
            where l.eliminado = 0 
            and c.est_id =  2 ";
            if ($libro->getAut_ID()!= 0) $sql = $sql . " and a.aut_id = " . $libro->getAut_ID();
            if ($libro->getIsbn()!= "") $sql = $sql . " and l.isbn = '" . $libro->getIsbn() ."'";
            if ($libro->getNombre()!= "") $sql = $sql . " and l.nombre = '" . $libro->getNombre()."'";
            if ($libro->getGenero()!= "") $sql = $sql . " and l.genero = '" . $libro->getGenero()."'";
            if ($libro->getSubgenero()!= "") $sql = $sql . " and l.subgenero = '" . $libro->getSubgenero()."'";
            if ($libro->getEditorial()!= "") $sql = $sql . " and l.editorial = '" . $libro->getEditorial()."'";
            $sql = $sql ." group by l.lib_ID, l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial , l.isbn , l.resena
            order by 1;";
        }
        else {
            $sql = "select l.lib_ID, l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial , l.isbn , l.resena, count(*)
            from libros l 
            inner join autores a on l.aut_id = a.aut_id  
            inner join copias c on l.lib_ID = c.lib_ID
            where l.eliminado = 0 
            and c.est_id =  2
            group by l.lib_ID, l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial , l.isbn , l.resena
            order by 1;";
        }
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
