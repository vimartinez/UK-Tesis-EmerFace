<?php

require_once("Barcode2.php");

$num = $_GET["num"];

$num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '15101967';
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'Code39';
$imgtype = isset($_REQUEST['imgtype']) ? $_REQUEST['imgtype'] : 'png';

Image_Barcode2::draw($num, $type, $imgtype);
?>
