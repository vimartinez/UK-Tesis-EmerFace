<?php

abstract class Modelo {
    
    protected $server = "127.0.0.1";
    protected $bd = "emerface"; //"emerface"; //biblio
    protected $usr ="root";
    protected $pass = "";

    public function __construct($server) {
        $this->server = $server;

    }
    public function conectarBD(){
        $conn = new mysqli($this->server, $this->usr, $this->pass, $this->bd);
        if (mysqli_connect_errno()) {
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }
        if (!$conn->set_charset("utf8")) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
            exit();
        }
        return $conn;
    }

    public function desconectarBD($mysqli){
        $mysqli->close();
    }
}
?>
