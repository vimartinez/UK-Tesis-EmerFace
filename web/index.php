<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
function __autoload($name) {
      $pathIncludes 		= 'app/inc/'.$name.'.php';
      $pathControladores 	= 'app/controladores/'.$name.'.php';
      $pathModelos 		= 'app/modelos/'.$name.'.php';
      $pathVistas               = 'app/vistas/'.$name.'.php';

      if(file_exists($pathIncludes)) require_once($pathIncludes);
      if(file_exists($pathControladores)) require_once($pathControladores);
      if(file_exists($pathModelos)) require_once($pathModelos);
      if(file_exists($pathVistas)) require_once($pathVistas);

   }
session_start();
require_once 'app/inc/constantes.php';

if (!empty($_POST['controlador']))
        $controlador = $_POST['controlador'];
    else
        $controlador = "ControladorPrincipal";
if (!empty($_POST['metodo']))
    $metodo = $_POST['metodo'];
else
    $metodo = "bienvenida";

$controladorPath = "app/controladores/" . $controlador . '.php';
if (is_file($controladorPath))
    require $controladorPath;
else
    die("<br><br>No se encuentra el controlador $controlador.php - 404 not found");

if (is_callable(array($controlador, $metodo)) == false) 
    die("<br><br> No se encuentra el metodo <b>$metodo</b> en el controlador <b>$controlador</b>");

$ObjControlador = new $controlador();
$ObjControlador->$metodo();
var_dump( $_POST);
?>