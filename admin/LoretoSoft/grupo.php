<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="crear" and $_GET["accion"]!="grabar" and $_GET["accion"]!="editar" and $_GET["accion"]!="actualizar" and $_GET["accion"]!="cargar" and $_GET["accion"]!="eliminar"){
	header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>
    <script type="text/javascript">tablasmodal();</script>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
<button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>grupo/crear');" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i> Agregar nuevo grupo</button><br><br>
                                    <table id="tbModal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Acciones</th>
                                                <th>Grupo</th>
                                                <th>Sector</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Acciones</th>
                                                <th>Grupo</th>
                                                <th>Sector</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
<?php
                $emp = $db->select('*', 'm_grup', "");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td><?=$cont?></td>
    <td>
    <button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>grupo/editar/<?=$emp_dat["GRUP_P_inCODGRU"]?>');" class="btn btn-success btn-icon btn-circle btn-sm"> <i class="fa fa-edit"></i> </button>
    <button onclick="eliminarcat('grupo','<?=$emp_dat["GRUP_chEXTIDE"]?>');" class="btn btn-danger btn-icon btn-circle btn-sm"> <i class="fa fa-trash"></i> </button>
    </td>
    <td><?=$emp_dat["GRUP_chNOMGRU"]?></td>
    <td><?=$emp_dat["GRUP_chDESGRU"]?> </td>
    <td><?=$emp_dat["GRUP_dtFECGRU"]?> </td>
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
$regusu = $db->select('*', 'm_grup', "where GRUP_P_inCODGRU='".$id."'");
		while ($regusu_dat = $regusu->fetch_assoc()) {
?>
<script>
	$("#btn_enviar").click(function(){
	var url = "<?=$rutaadmin?>grupo/actualizar/<?=$id?>";
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formulario").serialize(),
           beforeSend: function(objeto){
			$('#btn_enviar').html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> Enviando...');
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
                                <h4 class="card-title">Actualizar Grupo</h4>
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="grupo" class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="grupo" class="form-control" id="grupo" placeholder="Nombre" value="<?=$regusu_dat["GRUP_chNOMGRU"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="descripcion" class="col-sm-3 control-label">Descripción</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-align-justify"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripción" value="<?=$regusu_dat["GRUP_chDESGRU"]?>">
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

		$grupo = textos( $_POST['grupo'] );
		$descripcion = textos( $_POST['descripcion'] );

if ($grupo != null){
$data = array(
    'GRUP_chNOMGRU' => "".$grupo."",
    'GRUP_chDESGRU' => "".$descripcion."",
    // 'GRUP_dtFECGRU' => "".date("Y-m-d h:m:s")."",
);


if ($db->update('m_grup', $data, 'WHERE GRUP_P_inCODGRU="'.$id.'"')) {
    echo '<center><div class="alert alert-success notificacion" role="alert"><span><strong>Item guardado con éxito</strong></span></div>
</center><script>
               setTimeout(function(){
   $("#myModal").modal("toggle");
}, 1000);
</script>'; 
}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error al grabar item, por favor intente nuevomente</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>'; 
    }


}else{
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
	var url = "<?=$rutaadmin?>grupo/grabar";
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formulario").serialize(),
           beforeSend: function(objeto){
			$('#btn_enviar').html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> Enviando...');
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
                            <div class="card-header">
                                <h4 class="card-title">Crear Grupo</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="grupo" class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="grupo" class="form-control" id="grupo" placeholder="Nombre">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="descripcion" class="col-sm-3 control-label">Descripción</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-align-justify"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripción">
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

        $grupo = textos( $_POST['grupo'] );
        $descripcion = textos( $_POST['descripcion'] );

if ($grupo != null){
$data = array(
    'GRUP_chNOMGRU' => "".$grupo."",
    'GRUP_chDESGRU' => "".$descripcion."",
    'GRUP_dtFECGRU' => "".date("Y-m-d h:m:s")."",
    'GRUP_chEXTIDE' => "".hash_id()."",
);

if ($db->insert( 'm_grup', $data )) {
    echo '<center><div class="alert alert-success notificacion" role="alert"><span><strong>Item guardado con éxito</strong></span></div>
</center><script>
			   setTimeout(function(){
   $("#myModal").modal("toggle");
}, 1000);
</script>';	
}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error al grabar item, por favor intente nuevomente</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>';	
	}


}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error: <b>Falta ingresar dato</b>, por favor intente de nuevo.</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>';	
	}
}

if ($_GET["accion"]=="eliminar"){
if ( !$sid->check() ) 
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{

	$db->delete('m_grup', 'WHERE GRUP_chEXTIDE="'.alfanumerico($_POST["id"]).'"');
}
	}
?>