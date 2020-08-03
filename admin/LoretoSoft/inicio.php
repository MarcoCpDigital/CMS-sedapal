<?php
// error_reporting(0);
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=alfanumerico($_GET["id"]);

if ($_GET["accion"]!="cargar"){
	header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>
<img src="<?=$rutaadmintheme?>dist/img/logo-sedapal-blanco.png" alt="<?=$rsocial?>">
<?php }?>