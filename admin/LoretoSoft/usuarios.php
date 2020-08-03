<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="crear" and $_GET["accion"]!="grabar" and $_GET["accion"]!="editar" and $_GET["accion"]!="actualizar" and $_GET["accion"]!="cargar" and $_GET["accion"]!="eliminar"){
	header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
              <div class="card-header">
<button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>usuarios/crear');" class="btn btn-primary float-left mb-0"><i class="fa fa-edit"></i> Agregar nuevo Item</button>
              </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tbPrincipal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Usuario</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
        <tfoot>
            <tr>
               <th>#</th>
                                                <th class="text-center">Usuario</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Acciones</th>
            </tr>
        </tfoot>
                                        <tbody>
<?php
                $emp = $db->select('*', 'm_usua', "");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$cont?></td>
    <td class="text-center"><?=$emp_dat["USUA_chLOGUSU"]?></td>
    <td class="text-center"><?=$emp_dat["USUA_chNOMUSU"]?></td>
    <td class="text-center"><?=estado($emp_dat["USUA_inESTUSU"])?> </td>
    <td class="text-center">
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-align-justify"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item"  onclick="modal_lg('<?=$rutaadmin?>usuarios/editar/<?=$emp_dat["USUA_P_inCODUSU"]?>');">Editar</a>
                              <a class="dropdown-item"  onclick="eliminar('usuarios','<?=$emp_dat["USUA_P_inCODUSU"]?>');" >Eliminar</a>
                            </div>
                          </div>

   <!--  <button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>usuarios/editar/<?=$emp_dat["USUA_P_inCODUSU"]?>');" class="btn btn-success btn-icon btn-circle btn-sm"> <i class="fa fa-edit"></i> </button>
    <button onclick="eliminar('usuarios','<?=$emp_dat["USUA_P_inCODUSU"]?>');" class="btn btn-danger btn-icon btn-circle btn-sm"> <i class="fa fa-trash"></i> </button> -->
    </td>
</tr>
<?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>

<?php }
if ($_GET["accion"]=="editar"){
$regusu = $db->select('*', 'm_usua', "
	where USUA_P_inCODUSU='".$id."'");
		while ($regusu_dat = $regusu->fetch_assoc()) {
?>
<script>
	$("#btn_enviar").click(function(){
	var url = "<?=$rutaadmin?>usuarios/actualizar/<?=$id?>";
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
            cargar("usuarios");
           }
         });
    return false;
 });
</script>
<div class="row">
	<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Editar Usuario</h4><br><hr>
                                <div class="clearfix"></div>
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
                                                <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" value="<?=$regusu_dat["USUA_chLOGUSU"]?>" autocomplete="off"/>
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
                                                <input class="form-control" type="hidden" name="passwordold" value="<?=$regcat_dat["USUA_chPASUSU"]?>" autocomplete="off"/>
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
                                        <label for="email" class="col-sm-3 control-label">Estado</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="switch">
                                            	<label>Inactivo<input type="checkbox" name="estado" <?php if ($regusu_dat["USUA_inESTUSU"] == '1'){      echo "checked";}?>><span class="lever"></span>Activo</label>
                                        </div>
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
if ($_GET["accion"]=="actualizar"){

		$usuario = alfanumerico( $_POST['usuario'] );
		$password = hash_password($_POST['password'], $salt);
		$passwordold = textos( $_POST['passwordold'] );
		$nombres = alfanumerico( $_POST['nombre'] );
		$estado1 = alfanumerico( $_POST['estado'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

	if($password==$passwordold){
		$passwordnew=$passwordold;
		}else
			{
				$passwordnew=$password;
				}
if ($usuario != null and $password != null and $estado != null){
$data = array(
	'USUA_chLOGUSU' => "".$usuario."",
    'USUA_chPASUSU' => "".$passwordnew."",
    'USUA_chNOMUSU' => "".$nombres."",
    'USUA_inESTUSU' => "".$estado."",
);
if ($db->update('m_usua', $data, 'WHERE USUA_P_inCODUSU="'.$id.'"')) {
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
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error: <b>Falta ingresar dato</b>, por favor intente de nuevo.</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>';	
	}

}
if ($_GET["accion"]=="crear"){?>
<script>
	$("#btn_enviar").click(function(){
	var url = "<?=$rutaadmin?>usuarios/grabar";
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
            cargar("usuarios");
           }
         });
    return false;
 });
$('document').ready(function(){
   $("#checkTodos").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
});
</script>
<div class="row">
	<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Crear Usuario</h4><br><hr>
                                <div class="clearfix"></div>
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="usuario" class="col-sm-3 control-label">Usuario</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 control-label">Contraseña</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                                </div>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" value="<?=$regusu_dat["USUA_chPASUSU"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label">Estado</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="switch">
                                            	<label>Inactivo<input type="checkbox" name="estado" checked><span class="lever"></span>Activo</label>
                                                </div>
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
<?php }
if ($_GET["accion"]=="grabar"){

		$usuario = alfanumerico( $_POST['usuario'] );
		$password = hash_password($_POST['password'], $salt);
		$nombres = alfanumerico( $_POST['nombre'] );
		$estado1 = alfanumerico( $_POST['estado'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if ($usuario != null and $password != null and $estado != null){
$data = array(
	'USUA_chLOGUSU' => "".$usuario."",
    'USUA_chPASUSU' => "".$password."",
    'USUA_chNOMUSU' => "".$nombres."",
    'USUA_inESTUSU' => "".$estado."",
);

if ($db->insert( 'm_usua', $data )) {
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
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error: <b>Falta ingresar dato</b>, por favor intente de nuevo.</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>';	
	}
}

if ($_GET["accion"]=="eliminar"){
    
// $sid = new Session;

// $sid->start();
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{
	$db->delete('m_usua', 'WHERE USUA_P_inCODUSU="'.$id.'"');
}	

}
?>