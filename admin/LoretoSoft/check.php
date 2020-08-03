<?php 
@header( "Content-Type: text/html; charset=utf-8", true );
require_once '../../includes/database/db_config.php';
require_once '../../includes/class/Session.class.php';
require_once '../../includes/database/functions.php';
$db->conn();
$sid = new Session;
$sid->start();
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'error_login/'.dameURL().'">';
}else{
	if ($_SESSION['node']['estado'] != 1){
	echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'usuario_deshabilitado">';
	}
}
?>