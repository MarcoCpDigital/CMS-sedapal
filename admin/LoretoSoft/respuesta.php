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
<button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>respuesta/crear');" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i> Agregar nuevo respuesta</button><br><br>
    <script src="<?=$rutaadmintheme?>plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?=$rutaadmintheme?>plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
    <script type="text/javascript">
        $('.image-popup-fit-width2').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        image: {
            verticalFit: false
        }
    });
</script>
                                    <table id="tbModal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Respuesta</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Respuesta</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
<?php
                $emp = $db->select('*', 's_resp', "");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr> 
    <td><?=$cont?></td>
    <td><?=$emp_dat["RESP_chFORRES"]?></td>
    <td>
<?php if (isset($emp_dat["RESP_chFOTRES"])) {?>
    <a class="image-popup-fit-width2 btn btn-warnings btn-icon btn-circle btn-sm" href="<?=$ruta?>uploads/<?=$emp_dat["RESP_chFOTRES"]?>" style="background-color: #1F8594; color: white"> <i class="fa fa-image"></i> </a>
<?php } ?>
    <button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>respuesta/editar/<?=$emp_dat["RESP_P_inCODRES"]?>');" class="btn btn-success btn-icon btn-circle btn-sm"> <i class="fa fa-edit"></i> </button>
    <button onclick="eliminarcat('respuesta','<?=$emp_dat["RESP_chEXTIDE"]?>');" class="btn btn-danger btn-icon btn-circle btn-sm"> <i class="fa fa-trash"></i> </button>
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
$regusu = $db->select('*', 's_resp', "where RESP_P_inCODRES='".$id."'");
		while ($regusu_dat = $regusu->fetch_assoc()) {
?>
<script>
$("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>respuesta/actualizar/<?=$id?>";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_enviar').html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> Enviando...');
            $('#btn_enviar').attr("disabled", true);
            },
            success: function(msg){
            $('#btn_enviar').html('Guardar');
            $("#resultado").html(msg);
            var resultado=msg.indexOf("Error") > -1;
                if(resultado==false){
                $('#btn_enviar').attr("disabled", true);
                }else{
                $('#btn_enviar').attr("disabled", false);
                }
            // cargar("blog");
            }
        });
            return false;

    });


</script>
<div class="row">
	<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Actualizar Respuesta</h4>
                                <form method="post" id="formulario" class="form-horizontal form-bordereds  animated bounceIn" enctype="multipart/form-data" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label">Respuesta</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="respuesta" class="form-control" id="respuesta" placeholder="Respuesta" value="<?=$regusu_dat["RESP_chFORRES"]?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-3 control-label">Foto</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-image"></i>
                                                    </span>
                                                </div>
<span class="btn btn-success btn-file" style="width: 90%">Click Aqui para buscar foto<input type="file" style="width: 100%" name="imagen" id="foto" accept="image/jpg, .jpeg, .jpg, image/jpeg, .png, image/png"></span>
<input type="hidden" name="fotoactual" value="<?=$regusu_dat["RESP_chFOTRES"]?>">
<input type="hidden" name="alto" value="200">
<input type="hidden" name="ancho" value="200">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label">Ver foto</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="switch">
                                                <label>Inactivo<input type="checkbox" name="estado" id="estado"  <?php if ($regusu_dat["RESP_inVERFOT"] == '1'){echo "checked";}?>><span class="lever"></span>Activo</label>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
									<div id="resultado"></div>
                                    <div class="form-group row m-b-0">
                                        <div class="col-sm-12">
                                            <center><button type="submit" class="btn btn-info waves-effect waves-light" id="btn_enviar">Guardar</button></center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
</div>
<?php }}
if ($_GET["accion"]=="actualizar"){

		$respuesta = textos( $_POST['respuesta'] );
        $estado1 = alfanumerico( $_POST['estado'] );


if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}


if ($respuesta != null){
$data = array(
    'RESP_chFORRES' => "".$respuesta."",
    'RESP_inVERFOT' => "".$estado."",
);


if ($db->update('s_resp', $data, 'WHERE RESP_P_inCODRES="'.$id.'"')) {


//sbir imagen

        if ( $_FILES['imagen'] != null )
    {

        require_once '../../includes/class/Upload.class.php';
        $dir_dest = '../../uploads';
        $foto_actual =  "".$dir_dest."/".$_POST['fotoactual']."";
        $foto_actual2 =  "".$dir_dest."/thumbnails/".$_POST['fotoactual']."";
        $files = array( );
        $file = $_FILES['imagen'];
        $handle = new Upload( $file );
        if ( $handle->uploaded )
        {
            if ( file_exists( $foto_actual ) )
            {
                @unlink( $foto_actual );
                @unlink( $foto_actual2 );
            }
            $handle->file_overwrite = true;
            $handle->image_convert = 'jpg';
            //Configuracoes de redimensionamento 
            $pxMax = 600; //largura maxima permitida
            $pyMax = 600; // altura maxima permitida
            //Configuracoes de redimensionamento retrato
            $rxMax = 600; //largura maxima permitida
            $ryMax = 600; // altura maxima permitida
            //echo "$handle->image_src_x > $handle->image_src_y";exit;
            if ( $handle->image_src_x > $handle->image_src_y ){
                if ( $handle->image_src_x > $pxMax || $handle->image_src_y > $pyMax )
                {
                   $handle->image_x = $pxMax ;
                   $handle->image_y = $pyMax;
                   $handle->image_resize = true;
                   $handle->image_ratio = true;                
                }
            }
            if ( $handle->image_src_y > $handle->image_src_x ){
                if ( $handle->image_src_x > $rxMax || $handle->image_src_y > $ryMax )
                {
                   $handle->image_x = $rxMax ;
                   $handle->image_y = $ryMax;
                   $handle->image_resize = true;
                   $handle->image_ratio = true;                
                }
            }
            
            $handle->file_new_name_body = md5( uniqid( $file['name'] ) );
            $handle->Process( $dir_dest );
            if ( $handle->processed )
            {
                $file_dst_name = $handle->file_dst_name;
                $imagen_data = array(
    'RESP_chFOTRES' => ''.$handle->file_dst_name.'',
);
$db->update('s_resp', $imagen_data, 'WHERE RESP_P_inCODRES="'.$id.'"');

include('../../includes/class/ImageResize.php');
$alto=$_POST["alto"];
$ancho=$_POST["ancho"];
//creamos la minuatura 
$image = new \Gumlet\ImageResize(''.$dir_dest.'/'.$handle->file_dst_name.'');
$image->quality_jpg = 60;
$image->crop($alto, $ancho);
$image->save(''.$dir_dest.'/thumbnails/'.$handle->file_dst_name.'');

            }
        }
        else
        {
            $resultado = $handle->error;
        }

    }
    //termina subida
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

$("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>respuesta/grabar";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_enviar').html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> Enviando...');
            $('#btn_enviar').attr("disabled", true);
            },
            success: function(msg){
            $('#btn_enviar').html('Guardar');
            $("#resultado").html(msg);
            var resultado=msg.indexOf("Error") > -1;
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
                                <h4 class="card-title">Crear Respuesta</h4>
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label">Respuesta</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="respuesta" class="form-control" id="respuesta" placeholder="Respuesta">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-3 control-label">Foto</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-image"></i>
                                                    </span>
                                                </div>
                <span class="btn btn-success btn-file" style="width: 90%">Click Aqui para buscar foto<input type="file" style="width: 100%" name="imagen" id="foto" accept="image/jpg, .jpeg, .jpg, image/jpeg, .png, image/png"></span>
                <input type="hidden" name="alto" value="200">
                <input type="hidden" name="ancho" value="200">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label">Ver foto</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="switch">
                                                <label>Inactivo<input type="checkbox" name="estado" id="estado" checked><span class="lever"></span>Activo</label>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
									<div id="resultado"></div>
                                    <div class="form-group row m-b-0">
                                        <div class="col-sm-12">
                                            <center><button class="btn btn-info waves-effect waves-light" id="btn_enviar">Guardar</button></center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
</div>
<?php }
if ($_GET["accion"]=="grabar"){

        $respuesta = textos( $_POST['respuesta'] );
        $estado1 = alfanumerico( $_POST['estado'] );


if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if ($respuesta != null){
$data = array(
    'RESP_chFORRES' => "".$respuesta."",
    'RESP_chEXTIDE' => "".hash_id()."",
    'RESP_inVERFOT' => "".$estado."",
);

if ($db->insert( 's_resp', $data )) {



$ultimo_id = $db->insert_id;
            //comienza subida de imagen
if ( $_FILES['imagen'] != null ){
    require_once '../../includes/class/Upload.class.php';
    $dir_dest = '../../uploads';
    $files = array( );
    $file = $_FILES['imagen'];
    $handle = new Upload( $file );
    if ( $handle->uploaded )
    {
        $handle->file_overwrite = true;
        $handle->image_convert = 'jpg';
        //Configuracoes de redimensionamento paisagem
        $pxMax = 500; //largura maxima permitida
        $pyMax = 500; // altura maxima permitida
        //Configuracoes de redimensionamento retrato
        $rxMax = 500; //largura maxima permitida
        $ryMax = 500; // altura maxima permitida
        if ( $handle->image_src_x > $handle->image_src_y ){
            if ( $handle->image_src_x > $pxMax || $handle->image_src_y > $pyMax )
            {
               $handle->image_x = $pxMax ;
               $handle->image_y = $pyMax;
               $handle->image_resize = true;
               $handle->image_ratio = true;                
            }
        }
        if ( $handle->image_src_y > $handle->image_src_x ){
            if ( $handle->image_src_x > $rxMax || $handle->image_src_y > $ryMax )
            {
               $handle->image_x = $rxMax ;
               $handle->image_y = $ryMax;
               $handle->image_resize = true;
               $handle->image_ratio = true;                
            }
        }       
        $handle->file_new_name_body = md5( uniqid( $file['name'] ) );
        $handle->Process( $dir_dest );
        if ( $handle->processed )
        {
    $imagen_data = array(
    'RESP_chFOTRES' => ''.$handle->file_dst_name.'',
);
$db->update('s_resp', $imagen_data, 'WHERE RESP_P_inCODRES="'.$ultimo_id.'"');

include('../../includes/class/ImageResize.php');
$alto=$_POST["alto"];
$ancho=$_POST["ancho"];
//creamos la minuatura 
$image = new \Gumlet\ImageResize(''.$dir_dest.'/'.$handle->file_dst_name.'');
$image->quality_jpg = 60;
$image->crop($alto, $ancho);
$image->save(''.$dir_dest.'/thumbnails/'.$handle->file_dst_name.'');


    }}
    else
    {
            $resultado = $handle->error;
    }
}
//termina subida de imagen */

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

	$db->delete('s_resp', 'WHERE RESP_chEXTIDE="'.alfanumerico($_POST["id"]).'"');
}
	}
?>