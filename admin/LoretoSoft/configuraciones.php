<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="empresa" and $_GET["accion"]!="actualizarempresa" and $_GET["accion"]!="perfil" and $_GET["accion"]!="actualizarperfil"){
	header("Location: ".$ruta."error/");
}

//ver perfil de usuario
if ($_GET["accion"]=="perfil"){
    // echo $_SESSION['node']['id_user'];
$regusu = $db->select('*', 'm_usua', "where USUA_P_inCODUSU=".$_SESSION['node']['id_user']."");
		while ($regusu_dat = $regusu->fetch_assoc()) {
?>
<script>
	$("#btn_enviar").click(function(){
	var url = "<?=$rutaadmin?>configuraciones/actualizarperfil";
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formulario").serialize(),
           beforeSend: function(objeto){
			$('#btn_enviar').html('Enviando...');
            $('#btn_enviar').attr("disabled", true);
		  },
        	success: function(data)
           {
           	$('#btn_enviar').html('Guardar');
            $("#resultado").html(data);
            var resultado=data.indexOf("Error") > -1;
if(resultado==false){
$('#btn_enviar').attr("disabled", true);
}else{
$('#btn_enviar').attr("disabled", false);
}
            //cargar("clientes");
           }
         });
    return false;
 });
</script>
<div class="row">
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Editar perfil</h4>
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="usuario" class="col-sm-3 control-label">Usuario</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" value="<?=$regusu_dat["USUA_chLOGUSU"]?>" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 control-label">Contraseña</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-key"></i>
                                                    </span>
                                                </div>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" value="<?=$regusu_dat["USUA_chPASUSU"]?>">
                                                <input type="hidden" name="passwordold" id="passwordold" value="<?=$regusu_dat["USUA_chPASUSU"]?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" value="<?=$regusu_dat["USUA_chNOMUSU"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="apellidos" class="col-sm-3 control-label">Apellidos</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" value="<?=$regusu_dat["USUA_chAPEUSU"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dni" class="col-sm-3 control-label">DNI</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-credit-card"></i>
                                                    </span>
                                                </div>
                                                <input type="number" name="dni" class="form-control" id="dni" placeholder="DNI" value="<?=$regusu_dat["USUA_chDOCIDE"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="direccion" class="col-sm-3 control-label">Dirección</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-location-pin"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" value="<?=$regusu_dat["USUA_chDIRUSU"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="celular" class="col-sm-3 control-label">Celular</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-agenda"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-control" name="celular" id="celular" placeholder="Celular" value="<?=$regusu_dat["USUA_chCELUSU"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="correo" class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-email"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control" name="correo" id="correo" placeholder="Email" value="<?=$regusu_dat["USUA_chCORUSU"]?>">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                                    <div id="resultado"></div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <center><button class="btn btn-info waves-effect waves-light" id="btn_enviar">Guardar</button></center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</div>
<?php }}
//actualizar clientes
if ($_GET["accion"]=="actualizarperfil"){

    $nombre = text( $_POST['nombre'] );
    $apellidos = text( $_POST['apellidos'] );
    $dni = text( $_POST['dni'] );
    $usuario = text( $_POST['usuario'] );
    $password =  text($_POST['password']) ;
    $passwordold =  text($_POST['passwordold']) ;
    $email = text( $_POST['correo'] );
    $celular = text( $_POST['celular'] );
    $direccion = text( $_POST['direccion'] );
if ($usuario != null and $password != null and $passwordold != null and $nombre != null){

if($password==$passwordold){
    $passwordnew=$password;
}else{
    $passwordnew = hash_password($password, $salt);
}
$datcat = array(
    'USUA_chNOMUSU' => "".$nombre."",
    'USUA_chAPEUSU' => "".$apellidos."",
    'USUA_chDOCIDE' => "".$dni."",
    'USUA_chLOGUSU' => "".$usuario."",
    'USUA_chPASUSU' => "".$passwordnew."",
    'USUA_chCORUSU' => "".$email."",
    'USUA_chCELUSU' => "".$celular."",
    'USUA_chDIRUSU' => "".$direccion."",
);
$agrCat = $db->update('m_usua', $datcat, 'WHERE USUA_P_inCODUSU='.$_SESSION['node']['id_user'].'');

if ($agrCat) {
    echo '<center><div class="alert alert-success notificacion" role="alert"><span><strong>Item guardado con éxito</strong></span></div>
</center><script>
			   setTimeout(function(){
   $("#ModalSystem").modal("toggle");
}, 1000);
</script>';	
}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error al grabar item, por favor intente nuevamente</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>';	
	}
}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error: Falta ingresar dato, por favor intente de nuevo.</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>';	
	}
}


//editar clientes 
if ($_GET["accion"]=="empresa"){
$regempr = $db->select('*', 'm_dato', "WHERE DATO_P_inCODDAT=1");
        while ($regempr_dat = $regempr->fetch_assoc()) {
?>
<script>
    $("#btn_enviar").click(function(){
    var url = "<?=$rutaadmin?>configuraciones/actualizarempresa";
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formulario").serialize(),
           beforeSend: function(objeto){
            $('#btn_enviar').html('Enviando...');
            $('#btn_enviar').attr("disabled", true);
          },
            success: function(data)
           {
            $('#btn_enviar').html('Guardar');
            $("#resultado").html(data);
            var resultado=data.indexOf("Error") > -1;
if(resultado==false){
$('#btn_enviar').attr("disabled", true);
}else{
$('#btn_enviar').attr("disabled", false);
}
           }
         });
    return false;
 });
</script>
<div class="row">
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Datos de la empresa</h4>
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">

                                    <div class="form-group row">
                                        <label for="rsocial" class="col-sm-3 control-label">Razón Social</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="rsocial" class="form-control" id="rsocial" placeholder="Razón Social" value="<?=$regempr_dat["DATO_chRAZSOC"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Slogan" class="col-sm-3 control-label">Slogan</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="Slogan" class="form-control" id="Slogan" placeholder="Slogan" value="<?=$regempr_dat["DATO_chSLOCOM"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="claves" class="col-sm-3 control-label">Palabras claves </label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-map-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="group" class="form-control" id="group" placeholder="Palabras claves" value="<?=$regempr_dat["DATO_chCLAPRI"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="descripcion" class="col-sm-3 control-label">Descripción</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-map-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripción" value="<?=$regempr_dat["DATO_chDESEMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="direccion" class="col-sm-3 control-label">Dirección</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-map-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección" value="<?=$regempr_dat["DATO_chDIREMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Distrito" class="col-sm-3 control-label">Distrito</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-map-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="Distrito" class="form-control" id="Distrito" placeholder="Dirección" value="<?=$regempr_dat["DATO_chCIUEMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="telefono" class="col-sm-3 control-label">Teléfono</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-mobile"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" value="<?=$regempr_dat["DATO_chTELEMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="correo" class="col-sm-3 control-label">Correo Electrónico</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-email"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo Electrónico" value="<?=$regempr_dat["DATO_chCOREMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="facebook" class="col-sm-3 control-label">Facebook</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-mobile"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="facebook" class="form-control" id="facebook" placeholder="URL de facebook" value="<?=$regempr_dat["DATO_chFACEMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="twitter" class="col-sm-3 control-label">Twitter</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-mobile"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="twitter" class="form-control" id="twitter" placeholder="Twitter" value="<?=$regempr_dat["DATO_inTWIEMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="instagram" class="col-sm-3 control-label">Instagram</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-mobile"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Instagram" value="<?=$regempr_dat["DATO_chINSEMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="geolocalizacion" class="col-sm-3 control-label">Geolocalización</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-mobile"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="geolocalizacion" class="form-control" id="geolocalizacion" placeholder="Geolocalización" value="<?=$regempr_dat["DATO_chGEOEMP"]?>">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                                    <div id="resultado"></div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <center><button class="btn btn-info waves-effect waves-light" id="btn_enviar">Guardar</button></center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</div>
<?php }}
//actualizar clientes
if ($_GET["accion"]=="actualizarempresa"){

        $rsocial = textos( $_POST['rsocial'] );
        $Slogan = textos( $_POST['Slogan'] );
        $claves = textos( $_POST['claves'] );
        $descripcion = textos( $_POST['descripcion'] );
        $direccion = textos( $_POST['direccion'] );
        $Distrito = textos( $_POST['Distrito'] );
        $telefono = textos( $_POST['telefono'] );
        $correo = textos( $_POST['correo'] );
        $twitter = textos( $_POST['twitter'] );
        $instagram = textos( $_POST['instagram'] );
        $facebook = textos( $_POST['facebook'] );
        $geolocalizacion = textos( $_POST['geolocalizacion'] );

if ($rsocial != null and $Slogan != null and $direccion != null){
$data = array(
    'DATO_chRAZSOC' => "".$rsocial."",
    'DATO_chSLOCOM' => "".$Slogan."",
    'DATO_chCLAPRI' => "".$claves."",
    'DATO_chDESEMP' => "".$descripcion."",
    'DATO_chDIREMP' => "".$direccion."",
    'DATO_chCIUEMP' => "".$Distrito."",
    'DATO_chTELEMP' => "".$telefono."",
    'DATO_chCOREMP' => "".$correo."",
    'DATO_inTWIEMP' => "".$twitter."",
    'DATO_chINSEMP' => "".$instagram."",
    'DATO_chFACEMP' => "".$facebook."",
    'DATO_chGEOEMP' => "".$geolocalizacion."",
);
if ($db->update('m_dato', $data, 'WHERE DATO_P_inCODDAT="1"')) {
    echo '<center><div class="alert alert-success notificacion" role="alert"><span><strong>Item guardado con éxito</strong></span></div>
</center><script>
               setTimeout(function(){
   $("#ModalSystem").modal("toggle");
}, 1000);
</script>'; 
}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error al grabar item, por favor intente nuevamente</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>'; 
    }}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error: Falta ingresar dato, por favor intente de nuevo.</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>'; 
    }

}?>