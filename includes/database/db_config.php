<?php
require_once 'functions.php';

define('DB_HOST', 'localhost:3308');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'proyecto');

require 'mysql.php';

try {
	$db = new Mysqli_Manager();
} catch (Exception $err) {
	exit($err->getMessage());
}

$ruta="http://proyecto.pro:808/";
$rutaadmin="".$ruta."admin/";
$rutaadmintheme="".$rutaadmin."theme/system/";
$rutatheme="".$ruta."theme/system/";
$webmail="#";
$desarrollador="bonzai.pe";
$webdesarrollador="https://bonzai.pe/";
$logo=''.$ruta.'img/logo.jpg';
$nopic=''.$rutatheme.'img/nopic.png';
$upload=''.$ruta.'uploads/';

$db->conn();

$ex1 = $db->select_one('*', 'm_dato', "WHERE DATO_P_inCODDAT='1'");
if ($ex1 != null) {
$rsocial = textos($ex1['DATO_chRAZSOC']);
$slogan = textos($ex1['DATO_chSLOCOM']);
$claves = textos($ex1['DATO_chCLAPRI']);
$descripcion = textos($ex1['DATO_chDESEMP']);
$direccion = textos($ex1['DATO_chDIREMP']);
$ciudad = textos($ex1['DATO_chCIUEMP']);
$telefono = textos($ex1['DATO_chTELEMP']);
$correo = textos($ex1['DATO_chCOREMP']);
$twitter = textos($ex1['DATO_inTWIEMP']);
$instagram = textos($ex1['DATO_chINSEMP']);
$geoubicacion = textos($ex1['DATO_chGEOEMP']);
$facebook = textos($ex1['DATO_chFACEMP']);
	
	

}


