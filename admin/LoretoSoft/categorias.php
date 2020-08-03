<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="crear" and $_GET["accion"]!="grabar" and $_GET["accion"]!="editar" and $_GET["accion"]!="actualizar" and $_GET["accion"]!="cargar" and $_GET["accion"]!="eliminar" and $_GET["accion"]!="seleccionar" and $_GET["accion"]!="cambiarestado"){
	header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>
<script>
    $("#btn_enviar").click(function(){
    var url = "<?=$rutaadmin?>categorias/grabar";
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
        cargar("categorias");
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
                Agregar Categoría
              </div>
              <div class="card-body">
                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                  <div class="form-group">
                    <label>Nombre de categoría</label>
                    <input type="text" class="form-control" name="titulo">
                  </div>
                  <div class="form-group">
                    <label>Descripción de categoría</label>
                    <textarea class="form-control" rows="3" name="descripcion"></textarea>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                        <div class="switch">
                            <label>Inactivo<input type="checkbox" name="estado" <?php if ($regusu_dat["CATE_inESTCAT"] == '1'){      echo "checked";}?>><span class="lever"></span>Activo</label>
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
                Lista de categorías
              </div> 
              <div class="card-body">
    <div class="table-responsive" id="tableContent">
        <table id="tbPrincipal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Titulo</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Titulo</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </tfoot>
        <tbody>
<?php
                $emp = $db->select('*', 's_cate', "");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$cont?></td>
    <td class="text-center"><?=$emp_dat["CATE_chTITCAT"]?></td>
    <td class="text-center"><?=$emp_dat["CATE_chDESCAT"]?></td>
    <td class="text-center">
      <button class="<?php if ($emp_dat["CATE_inESTCAT"]=='1'):echo"btn-success"; else: echo"btn-danger"; endif ?> btn-xs" onclick="CambiarEstado('categorias','<?=$emp_dat["CATE_P_inCODCAT"]?>', '<?=$emp_dat["CATE_inESTCAT"]?>');"><i class="fa fa-recycle"></i> <?=estado($emp_dat["CATE_inESTCAT"])?></button>
    </td>
    <td class="text-center">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-align-justify"></i>
            </button>
        <div class="dropdown-menu">
            <a class="dropdown-item"  onclick="modal_lg('<?=$rutaadmin?>categorias/editar/<?=$emp_dat["CATE_P_inCODCAT"]?>');">Editar</a>
            <a class="dropdown-item"  onclick="eliminar('categorias','<?=$emp_dat["CATE_P_inCODCAT"]?>');" >Eliminar</a>
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
$regusu = $db->select('*', 's_cate', "
	where CATE_P_inCODCAT='".$id."'");
		while ($regusu_dat = $regusu->fetch_assoc()) {
?>
<script>
	$("#btn_editar").click(function(){
	var url = "<?=$rutaadmin?>categorias/actualizar/<?=$id?>";
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
        cargar("categorias");
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
                                <h4 class="card-title">Editar Usuario</h4><br><hr>
                                <div class="clearfix"></div>
                <form method="post" id="formularioeditar" class="form-horizontal p-t-20" autocomplete="off">
                  <div class="form-group">
                    <label>Nombre de categoría</label>
                    <input type="text" class="form-control" name="titulo" value="<?=$regusu_dat["CATE_chTITCAT"]?>">
                  </div>
                  <div class="form-group">
                    <label>Descripción de categoría</label>
                    <textarea class="form-control" rows="3" name="descripcion"><?=$regusu_dat["CATE_chDESCAT"]?></textarea>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                        <div class="switch">
                            <label>Inactivo<input type="checkbox" name="estado" <?php if ($regusu_dat["CATE_inESTCAT"] == '1'){      echo "checked";}?>><span class="lever"></span>Activo</label>
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
        $descripcion = alfanumerico( $_POST['descripcion'] );
        $estado1 = alfanumerico( $_POST['estado'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if ($titulo != null and $descripcion != null and $estado != null){
$data = array(
    'CATE_chTITCAT' => "".$titulo."",
  'CATE_chURLCAT' => "".limpiar($titulo)."",
    'CATE_chDESCAT' => "".$descripcion."",
    'CATE_inESTCAT' => "".$estado."",
);
if ($db->update('s_cate', $data, 'WHERE CATE_P_inCODCAT="'.$id.'"')) {
    echo '{"success": true, "message": "Categoría guardado con éxito"}';
}else{
    echo '{"success": false, "message": "Error al grabar categoría, por favor intente nuevamente"}';
	}}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
	}

}
if ($_GET["accion"]=="grabar"){

		$titulo = alfanumerico( $_POST['titulo'] );
		$descripcion = alfanumerico( $_POST['descripcion'] );
		$estado1 = alfanumerico( $_POST['estado'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if ($titulo != null and $descripcion != null and $estado != null){
$data = array(
	'CATE_chTITCAT' => "".$titulo."",
  'CATE_chURLCAT' => "".limpiar($titulo)."",
    'CATE_chDESCAT' => "".$descripcion."",
    'CATE_inESTCAT' => "".$estado."",
);

if ($db->insert( 's_cate', $data )) {
    echo '{"success": true, "message": "Categoría guardado con éxito"}';
}else{
    echo '{"success": false, "message": "Error al grabar ategoría, por favor intente nuevamente"}';
	}}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
	}
}

if ($_GET["accion"]=="eliminar"){
    
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{
	$db->delete('s_cate', 'WHERE CATE_P_inCODCAT="'.$id.'"');
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
    'CATE_inESTCAT' => "".$estado."",
);

$db->update('s_cate', $data, 'WHERE CATE_P_inCODCAT="'.$idcambiar.'"');

}

}


//para seleccionar pagina
if ($_GET["accion"]=="seleccionar"){?>
<script type="text/javascript">
  tablasmodal();
</script>
          <div class="table-responsive">
                  <table id="tbModal" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                <th class="text-center">#</th>
                <th class="text-center">Titulo</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                <th class="text-center">#</th>
                <th class="text-center">Titulo</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Acciones</th>
                      </tr>
                    </tfoot>
        <tbody>
<?php
                $emp = $db->select('*', 's_cate', " where CATE_inESTCAT=1");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$cont?></td>
    <td class="text-center"><?=$emp_dat["CATE_chTITCAT"]?></td>
    <td class="text-center"><?=$emp_dat["CATE_chDESCAT"]?></td>
    <td class="text-center">
      <button type="button" class="btn btn-outline-primary urlpag_<?=$emp_dat["CATE_P_inCODCAT"]?>" onclick="seleccionarcategoria('<?=$emp_dat["CATE_P_inCODCAT"]?>', '<?=$emp_dat["CATE_inESTCAT"]?>');" url="<?=$ruta?>categoria/<?=limpiar($emp_dat["CATE_chTITCAT"])?>" id_pag="<?=$emp_dat["CATE_P_inCODCAT"]?>">Elegir</button>
    </td>
</tr>
<?php }?>
        </tbody>
                  </table>
                </div>

<?php } 
?>