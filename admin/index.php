<?php
//error_reporting(0);
require_once '../includes/class/Session.class.php';
require_once '../includes/database/db_config.php';
require_once '../includes/database/functions.php';
$sid = new Session;
$sid->start();
$db->conn();
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'iniciar-sesion">';
}else{
if ($_SESSION['node']['user_tip'] != 0){
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'inicio/">';
}
//     else{
//     echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'acceso-prohibido">';
// }
}
?>