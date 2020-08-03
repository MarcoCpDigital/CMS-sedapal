<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="crear" and $_GET["accion"]!="grabar" and $_GET["accion"]!="editar" and $_GET["accion"]!="actualizar" and $_GET["accion"]!="cargar" and $_GET["accion"]!="eliminar" and $_GET["accion"]!="cambiarestado"){
	header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>
<script>
    $("#btn_enviar").click(function(){
    var url = "<?=$rutaadmin?>etiquetas/grabar";
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
 data = jQuery.parseJSON(data);
            // console.log(data["success"]);
if(data["success"]==false){
$('#btn_enviar').attr("disabled", false);
var type="error";
}else{
$('#btn_enviar').attr("disabled", true);
}

Swal.fire({
  title: data["message"],
  type: type,
  showCancelButton: false,
  confirmButtonText: 'ok'
}).then((result) => {
  if (result.value) {
    if(data["success"]==true){
        cargar("etiquetas");
    }
  }
})

    }
});
    return false;
 });
</script>
        <div class="row">
          <!-- Contenido -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                Agregar Etiqueta
              </div>
              <div class="card-body">
                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                  <div class="form-group">
                    <label>Nombre de etiqueta</label>
                    <input type="text" class="form-control" name="titulo">
                  </div>
                  <!-- <div class="form-group">
                    <label>Descripción de etiqueta</label>
                    <textarea class="form-control" rows="3" name="descripcion"></textarea>
                  </div> -->
                  <div class="form-group">
                    <div class="input-group">
                        <div class="switch">
                            <label>Inactivo<input type="checkbox" name="estado" <?php if ($regusu_dat["ETIQ_inESTETI"] == '1'){      echo "checked";}?>><span class="lever"></span>Activo</label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary waves-effect waves-light" id="btn_enviar">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                Lista de etiquetas
              </div> 
              <div class="card-body">
    <div class="table-responsive" id="tableContent">
        <table id="tbPrincipal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <!-- <th class="text-center">Descripción</th> -->
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
               <th>#</th>
                <th class="text-center">Nombre</th>
                <!-- <th class="text-center">Descripción</th> -->
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </tfoot>
        <tbody>
<?php
$emp = $db->select('*', 's_etiq', "");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$cont?></td>
    <td class="text-center"><?=$emp_dat["ETIQ_chTITETI"]?></td>
    <!-- <td class="text-center"><?=$emp_dat["ETIQ_chDESETI"]?></td> -->
    <td class="text-center">
      <button class="<?php if ($emp_dat["ETIQ_inESTETI"]=='1'):echo"btn-success"; else: echo"btn-danger"; endif ?> btn-xs" onclick="CambiarEstado('etiquetas','<?=$emp_dat["ETIQ_P_inCODETI"]?>', '<?=$emp_dat["ETIQ_inESTETI"]?>');"><i class="fa fa-recycle"></i> <?=estado($emp_dat["ETIQ_inESTETI"])?></button>
    </td>
    <td class="text-center">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-align-justify"></i>
            </button>
        <div class="dropdown-menu">
            <a class="dropdown-item"  onclick="modal_lg('<?=$rutaadmin?>etiquetas/editar/<?=$emp_dat["ETIQ_P_inCODETI"]?>');">Editar</a>
            <a class="dropdown-item"  onclick="eliminar('etiquetas','<?=$emp_dat["ETIQ_P_inCODETI"]?>');" >Eliminar</a>
        </div>
        </div>
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
$regusu = $db->select('*', 's_etiq', "
	where ETIQ_P_inCODETI='".$id."'");
		while ($regusu_dat = $regusu->fetch_assoc()) {
?>
<script>
	$("#btn_editar").click(function(){
	var url = "<?=$rutaadmin?>etiquetas/actualizar/<?=$id?>";
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formularioeditar").serialize(),
           beforeSend: function(objeto){
			$('#btn_editar').html('Enviando...');
            $('#btn_editar').attr("disabled", true);
		  },
        	success: function(data)
           {
           	$('#btn_editar').html('Guardar');
            $("#resultado").html(data);

data = jQuery.parseJSON(data);
            // console.log(data["success"]);
if(data["success"]==false){
$('#btn_editar').attr("disabled", false);
var type="error";
}else{
$('#btn_editar').attr("disabled", true);
}

Swal.fire({
  title: data["message"],
  type: type,
  showCancelButton: false,
  confirmButtonText: 'ok'
}).then((result) => {
  if (result.value) {
    if(data["success"]==true){
        cargar("etiquetas");
        $('#ModalSystem').modal('hide');
    }
  }
})

           }
         });
    return false;
 });
</script>
<div class="row">
	<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Editar Etiqueta</h4><br><hr>
                                <div class="clearfix"></div>
                <form method="post" id="formularioeditar" class="form-horizontal p-t-20" autocomplete="off">
                  <div class="form-group">
                    <label>Nombre de etiqueta</label>
                    <input type="text" class="form-control" name="titulo" value="<?=$regusu_dat["ETIQ_chTITETI"]?>">
                  </div>
                  <!-- <div class="form-group">
                    <label>Descripción de etiqueta</label>
                    <textarea class="form-control" rows="3" name="descripcion"><?=$regusu_dat["ETIQ_chDESETI"]?></textarea>
                  </div> -->
                  <div class="form-group">
                    <div class="input-group">
                        <div class="switch">
                            <label>Inactivo<input type="checkbox" name="estado" <?php if ($regusu_dat["ETIQ_inESTETI"] == '1'){      echo "checked";}?>><span class="lever"></span>Activo</label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary waves-effect waves-light" id="btn_editar">Guardar</button>
                  </div>
                </form>
                            </div>
                        </div>
                    </div>
</div>
<?php }}
if ($_GET["accion"]=="actualizar"){

        $titulo = alfanumerico( $_POST['titulo'] );
        // $descripcion = alfanumerico( $_POST['descripcion'] );
        $estado1 = alfanumerico( $_POST['estado'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if ($titulo != null and $estado != null){
$data = array(
    'ETIQ_chTITETI' => "".$titulo."",
    // 'ETIQ_chDESETI' => "".$descripcion."",
    'ETIQ_inESTETI' => "".$estado."",
);
if ($db->update('s_etiq', $data, 'WHERE ETIQ_P_inCODETI="'.$id.'"')) {
    echo '{"success": true, "message": "Etiqueta guardado con éxito"}';
}else{
    echo '{"success": false, "message": "Error al grabar etiqueta, por favor intente nuevamente"}';
	}}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
	}

}

if ($_GET["accion"]=="grabar"){

		$titulo = alfanumerico( $_POST['titulo'] );
		// $descripcion = alfanumerico( $_POST['descripcion'] );
		$estado1 = alfanumerico( $_POST['estado'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if ($titulo != null and $estado != null){
$data = array(
	  'ETIQ_chTITETI' => "".$titulo."",
    // 'ETIQ_chDESETI' => "".$descripcion."",
    'ETIQ_inESTETI' => "".$estado."",
);

if ($db->insert( 's_etiq', $data )) {
    echo '{"success": true, "message": "Etiqueta guardado con éxito"}';
}else{
    echo '{"success": false, "message": "Error al grabar tiqueta, por favor intente nuevamente"}';
	}}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
	}
}

if ($_GET["accion"]=="eliminar"){
    
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{
	$db->delete('v_etiq_noti', 'WHERE ETIQ_F_inCODETI="'.$id.'"');
  $db->delete('s_etiq', 'WHERE ETIQ_P_inCODETI="'.$id.'"');
}

}



// /cambiar estado
if ($_GET["accion"]=="cambiarestado"){

    $idcambiar = onlyNumbers($_POST["id_pro_ext"]);
    $estadoact = onlyNumbers($_POST["estado"]);

if ($estadoact=='1') {
    $estado = '2';
  }else{
    $estado = '1';
  }

if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{

$data = array(
    'ETIQ_inESTETI' => "".$estado."",
);

$db->update('s_etiq', $data, 'WHERE ETIQ_P_inCODETI="'.$idcambiar.'"');

}

}
?>