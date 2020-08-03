<?php
error_reporting(0);
@header( "Content-Type: text/html; charset=utf-8", true );
require_once '../../includes/database/db_config.php';
require_once '../../includes/class/Session.class.php';
require_once '../../includes/database/functions.php';
if ( isset( $_GET['salir'] ) && !empty( $_GET['salir'] ) )
{
    $sid = new Session;
    $sid->start();
    $sid->destroy();
	$resultado  = '<div class="alert alert-info text-center" role="alert">Se cerró sesión correctamente.</div>';
}
if ( $_GET['url'] )
{
	$resultado  = '<div class="alert alert-danger text-center" role="alert">Por favor, inicie sesión para ingresar al sistema.</div>';
}
if ( $_GET['pc_no_autorizado'] )
{
	$resultado  = '<div class="alert alert-danger text-center" role="alert">La computadora que está utilizando no esta autorizada. Por favor contáctese con el administrador.</div>';
}
if ( isset( $_GET['acceso_prohibido'] ) && !empty( $_GET['acceso_prohibido'] ) )
{
	$resultado  = '<div class="alert alert-danger text-center" role="alert">Se detecto un ingreso no autorizado, por favor vuelva a intentarlo.</div>';
}
if ( isset( $_GET['usuario_deshabilitado'] ) && !empty( $_GET['usuario_deshabilitado'] ) )
{
	$resultado  = '<div class="alert alert-danger text-center" role="alert">Disculpe, Su usuario esta deshabilitado, coordine con un administrador del sistema.</div>';
	//borramos los datos de sesión 
	$sid = new Session;
    $sid->start();
    $sid->destroy();

}

if ( isset( $_GET['cambio'] ) && !empty( $_GET['cambio'] ) )
{
    $sid = new Session;
    $sid->start();
    $sid->destroy();
	 $resultado  = '<div class="alert alert-info text-center" role="alert">Se cambio su clave con exito, Por favor inicie sesión nuevamente.</div>';
}

if ( isset( $_POST['usuario'] ) && isset( $_POST['password'] ) && !empty( $_POST['usuario'] ) && !empty( $_POST['password'] ) )
{
		
    $usuario = seguridad($_POST['usuario']);
    $password = seguridad($_POST['password']);
    $url = $_POST['url'];
	$db->conn();
	$password = hash_password($password, $salt);
     
	$user = $db->select('*', 'm_usua', "where USUA_chLOGUSU = '".$usuario."' and USUA_chPASUSU = '".$password."'");

    if ( $user->num_rows >= 1 )
    {
		while ($user_dat = $user->fetch_assoc()) {

        $sid = new Session;
        $sid->start();
        $sid->init( 36000 );
        $sid->addNode( 'start', date( 'd/m/Y - h:i' ) );
        $sid->addNode( 'id_user', ''.$user_dat["USUA_P_inCODUSU"].'' );
        $sid->addNode( 'usuario', ''.$user_dat["USUA_chLOGUSU"].'' );
        $sid->addNode( 'password', ''.$user_dat["USUA_chPASUSU"].'' );
        $sid->addNode( 'nombre', ''.$user_dat["USUA_chNOMUSU"].'' );
        // $sid->addNode( 'apellido', ''.$user_dat["USUA_chAPEUSU"].'' );
        $sid->addNode( 'user_tip', ''.$user_dat["TIPO_F_inCODUSU"].'' );
        $sid->addNode( 'tipo_sistema', ''.$user_dat["USUA_inTIPSIS"].'' );
        $sid->addNode( 'estado', ''.$user_dat["USUA_inESTUSU"].'' );
		}
		if ($url==null){$ir="".$rutaadmin."inicio/";}else{$ir=$url;}
        $resultado  = '<div class="alert alert-success text-center" role="alert">Datos correctos, Bienvenido al sistema.</div><meta http-equiv="Refresh" content="2;url='.$ir.'">';

    }
    else
    {
 $resultado  = '<center><div class="notificacion rojo"><span>Error al iniciar sesión, por favor, revise sus datos.</span></div></center>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width --> 
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$rutaadmintheme?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=$rutaadmintheme?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$rutaadmintheme?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=$rutaadmintheme?>index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicie sesión para continuar</p>
<?php
		if(!$_POST and !$_GET){
			echo '<p class="text-center text-condensedLight">Inicie sesión para entrar al sistema</p>';
		}else{echo '<p class="text-center text-condensedLight">'.$resultado.'</p>';}
		?>
      <form action="<?=$rutaadmin?>iniciar-sesion" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
            <?php if ($_GET["url"]){echo "<input type=\"hidden\" name=\"url\" value=\"".$_SERVER['HTTP_REFERER']."\">";}?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=$rutaadmintheme?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=$rutaadmintheme?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=$rutaadmintheme?>dist/js/adminlte.min.js"></script>

</body>
</html>