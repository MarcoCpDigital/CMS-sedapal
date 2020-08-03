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
<button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>pregunta/crear');" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i> Agregar nuevo pregunta</button><br><br>
                                    <table id="tbModal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Acciones</th>
                                                <th>Pregunta</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Acciones</th>
                                                <th>Pregunta</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
<?php
                $emp = $db->select('*', 's_preg', "");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td><?=$cont?></td>
    <td>
    <button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>pregunta/editar/<?=$emp_dat["PREG_P_inCODPRE"]?>');" class="btn btn-success btn-icon btn-circle btn-sm"> <i class="fa fa-edit"></i> </button>
    <button onclick="eliminarcat('pregunta','<?=$emp_dat["PREG_chEXTIDE"]?>');" class="btn btn-danger btn-icon btn-circle btn-sm"> <i class="fa fa-trash"></i> </button>
    </td>
    <td><?=$emp_dat["PREG_chFORPRE"]?></td>
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
$regusu = $db->select('*', 's_preg', "where PREG_P_inCODPRE='".$id."'");
		while ($regusu_dat = $regusu->fetch_assoc()) {
?>
<script>
	$("#btn_enviar").click(function(){
	var url = "<?=$rutaadmin?>pregunta/actualizar/<?=$id?>";
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
                                <h4 class="card-title">Actualizar Pregunta</h4>
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="pregunta" class="col-sm-3 control-label">Pregunta</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="pregunta" class="form-control" id="pregunta" placeholder="Pregunta" value="<?=$regusu_dat["PREG_chFORPRE"]?>">
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

		$pregunta = textos( $_POST['pregunta'] );

if ($pregunta != null){
$data = array(
    'PREG_chFORPRE' => "".$pregunta."",
    'PREG_chURLPRE' => "".limpiar($pregunta)."",
);


$ver_reg = $db->select('*', 's_preg', "where PREG_chURLPRE='".limpiar($pregunta)."' and PREG_P_inCODPRE!='".$id."'");

if($ver_reg->num_rows=='0'){

if ($db->update('s_preg', $data, 'WHERE PREG_P_inCODPRE="'.$id.'"')) {
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
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error: <b>La pregunta ya existe</b>, por favor intente de nuevo.</strong></span></div>
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
	var url = "<?=$rutaadmin?>pregunta/grabar";
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
                                <h4 class="card-title">Crear Pregunta</h4>
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="pregunta" class="col-sm-3 control-label">Pregunta</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="pregunta" class="form-control" id="pregunta" placeholder="Pregunta">
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

        $pregunta = textos( $_POST['pregunta'] );

if ($pregunta != null){
$data = array(
    'PREG_chFORPRE' => "".$pregunta."",
    'PREG_chURLPRE' => "".limpiar($pregunta)."",
    'PREG_chEXTIDE' => "".hash_id()."",
);

$ver_reg = $db->select('*', 's_preg', "where PREG_chURLPRE='".limpiar($pregunta)."'");

if($ver_reg->num_rows=='0'){

if ($db->insert( 's_preg', $data )) {
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
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error: <b>La pregunta ya existe</b>, por favor intente de nuevo.</strong></span></div>
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

	$db->delete('s_preg', 'WHERE PREG_chEXTIDE="'.alfanumerico($_POST["id"]).'"');
}
	}
?>