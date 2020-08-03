<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="crear" and $_GET["accion"]!="grabar" and $_GET["accion"]!="editar" and $_GET["accion"]!="actualizar" and $_GET["accion"]!="cargar" and $_GET["accion"]!="eliminar" and $_GET["accion"]!="agregarrespuesta" and $_GET["accion"]!="grabarrespuesta" and $_GET["accion"]!="respuestas" and $_GET["accion"]!="eliminarrespuesta" and $_GET["accion"]!="opiniones" and $_GET["accion"]!="descargar_excel" and $_GET["accion"]!="graficos"){
	header("Location: ".$ruta."error/");
}
//listar encuestas
if ($_GET["accion"]=="cargar"){?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
<button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>encuestas/crear');" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i> Agregar nueva encuesta</button>
<button title="Ver grupos" onclick="modal_lg('<?=$rutaadmin?>grupo/cargar');" class="btn btn-danger btn-icon btn-sm"><i class="fas fa-align-justify"></i> Grupos</button>
<button title="Ver sub grupos" onclick="modal_lg('<?=$rutaadmin?>pregunta/cargar');" class="btn btn-success btn-icon btn-sm"><i class="fas fa-align-justify"></i> Preguntas</button>
<button title="Ver Unidades de medida" onclick="modal_lg('<?=$rutaadmin?>respuesta/cargar');" class="btn btn-info btn-icon btn-sm"><i class="fas fa-align-justify"></i> Respuestas</button>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="tbPrincipal" class="display nowrap responsive  table table-hover table-striped table-bordered" cellspacing="0" width="100%">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Grupo</th>
                                                <th>Titulo</th>
                                                <th>Pregunta</th>
                                                <!-- <th>Inicio/Fin</th> -->
                                                <th>Creador</th>
                                                <th>Fecha</th>
                                                <!-- <th>Pag. Prin.</th> -->
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Grupo</th>
                                                <th>Titulo</th>
                                                <th>Pregunta</th>
                                                <!-- <th>Inicio/Fin</th> -->
                                                <th>Creador</th>
                                                <th>Fecha</th>
                                                <!-- <th>Pag. Prin.</th> -->
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
<!-- <script type="text/javascript">
        $('.image-popup-fit-width').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        image: {
            verticalFit: false
        }
    });
</script> -->
<?php
$emp = $db->select('*', 'v_encu ve', "
    INNER JOIN m_grup mg on mg.GRUP_P_inCODGRU=ve.GRUP_F_inCODGRU
    INNER JOIN s_preg sp on sp.PREG_P_inCODPRE=ve.PREG_F_inCODPRE
    INNER JOIN m_usua mu on mu.USUA_P_inCODUSU=ve.USUA_F_inCODUSU
    ORDER BY ve.ENCU_P_inCODRES DESC");
$cont=0;while ($emp_dat = $emp->fetch_assoc()) {$cont++;
?>
<tr>
    <td><?=$emp_dat["ENCU_P_inCODRES"]?></td>
    <td><?=$emp_dat["GRUP_chNOMGRU"]?></td>
    <td><?=$emp_dat["titulo"]?></td>
    <td><?=$emp_dat["PREG_chFORPRE"]?></td>
    <!-- <td><span style="color:#17BD1B"><?=$emp_dat["ENCU_dtHORINI"]?></span><br>   <span style="color:#BD2222"><?=$emp_dat["ENCU_dtHORFIN"]?></span></td> -->
    <td><?=$emp_dat["USUA_chNOMUSU"]?></td>
    <td><?=$emp_dat["ENCU_dtFECENC"]?></td>
    <!-- <td><?=principal($emp_dat["ENCU_inESTENC"])?></td> -->
    <td>
        <?php if ($emp_dat["ENCU_inESTENC"]=='1') { echo '<button title="Activo" style="background-color: #37B33F; color: white" class="btn btn-icon btn-xs">'.estado($emp_dat["ENCU_inESTENC"]).'</button>';
        }else { echo '<button title="Activo" style="background-color: #BD2222; color: white" class="btn btn-icon btn-xs">'.estado($emp_dat["ENCU_inESTENC"]).'</button>';
        } ?>
    </td>
    <td>
    <button title="Agregar respuesta" onclick="modal_lg('<?=$rutaadmin?>encuestas/agregarrespuesta/<?=$emp_dat["ENCU_P_inCODRES"]?>');" class="btn btn-info btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></button>
    <button title="Ver respuestas" onclick="modal_lg('<?=$rutaadmin?>encuestas/respuestas/<?=$emp_dat["ENCU_P_inCODRES"]?>');" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></button>
    <!-- <button title="Ver opiniones" onclick="modal_lg('<?=$rutaadmin?>encuestas/opiniones/<?=$emp_dat["ENCU_P_inCODRES"]?>');" class="btn btn-warning btn-icon btn-circlse btn-sm" style="background-color: #454AD1; color: white"><b>OP</b></button> -->
    <!-- <button title="Ver Graficos" onclick="modal_lg('<?=$rutaadmin?>encuestas/graficos/<?=$emp_dat["ENCU_P_inCODRES"]?>');" class="btn btn-warning btn-icon btn-circle btn-sm" style="background-color: #944A8F; color: white"><i class="fa fa-chart-bar"></i></button> -->
    <!-- <a class=" btn btn-warnings btn-icon btn-circle btn-sm" title="Descargar excel ID: [<?=$emp_dat["ENCU_P_inCODRES"]?>]" href="<?=$rutaadmin?>encuestas/descargar_excel/<?=$emp_dat["ENCU_P_inCODRES"]?>" style="background-color: #37B33F; color: white"> <i class="fa fa-file-excel"></i> </a> -->
    <!-- <a class="image-popup-fit-width btn btn-warnings btn-icon btn-circle btn-sm" href="<?=$ruta?>uploads/<?=$emp_dat["ENCU_chFOTENC"]?>" style="background-color: #1F8594; color: white"> <i class="fa fa-image"></i> </a> -->
    <button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>encuestas/editar/<?=$emp_dat["ENCU_P_inCODRES"]?>');" class="btn btn-success btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></button>
    <button onclick="eliminar('encuestas','<?=$emp_dat["ENCU_chEXTIDE"]?>');" class="btn btn-danger btn-icon btn-circle btn-sm"> <i class="fa fa-trash"></i></button>
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
//editar encuestas 
if ($_GET["accion"]=="editar"){
$regpro = $db->select('*', 'v_encu ve', "
    INNER JOIN m_grup mg on mg.GRUP_P_inCODGRU=ve.GRUP_F_inCODGRU
    INNER JOIN s_preg sp on sp.PREG_P_inCODPRE=ve.PREG_F_inCODPRE
    INNER JOIN m_usua mu on mu.USUA_P_inCODUSU=ve.USUA_F_inCODUSU
    where ve.ENCU_P_inCODRES='".$id."'");
		while ($regpro_dat = $regpro->fetch_assoc()) {
?>
<script>
    select2("grupo");

$("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>encuestas/actualizar/<?=$id?>";
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
            cargar("encuestas");
            }
        });
    });

    $('.datepicker').datetimepicker({locale: 'es'});
</script>
<div class="row">
	<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Editar Encuesta</h4>
                                <form method="post" id="formulario" class="form-horizontal form-borderesd  animated bounceIn" enctype="multipart/form-data" autocomplete="off">
                                    <div class="form-group row">
                                        <label for="grupo" class="col-sm-3 control-label">Grupo</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fas fa-bookmark"></i>
                                                    </span>
                                                </div>
            <select class="form-control selector" name="grupo" id="grupo" data_tipo="grupo" style="width: 92%">
                <option value="<?=$regpro_dat["GRUP_P_inCODGRU"]?>"><?=$regpro_dat["GRUP_chNOMGRU"]?></option>
<?php
$catpro = $db->select('*', 'm_grup', " where GRUP_P_inCODGRU!='".$regpro_dat["GRUP_P_inCODGRU"]."'");
        while ($catpro_dat = $catpro->fetch_assoc()) {
?>
                <option value="<?=$catpro_dat["GRUP_P_inCODGRU"]?>"><?=$catpro_dat["GRUP_chNOMGRU"]?></option>
<?php }?>
            </select>
                                            </div>
                                        </div>
                                    </div>
               
                                    <div class="form-group row">
                                        <label for="titulo" class="col-sm-3 control-label">Titulo</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-align-justify"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo" value="<?=$regpro_dat["titulo"]?>">
                                            </div>
                                        </div>
                                    </div>
               
                                    <div class="form-group row">
                                        <label for="pregunta" class="col-sm-3 control-label">Pregunta</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fas fa-bookmark"></i>
                                                    </span>
                                                </div>
            <select class="form-control selector" name="pregunta" id="pregunta" data_tipo="pregunta" style="width: 92%">
                <option value="<?=$regpro_dat["PREG_P_inCODPRE"]?>"><?=$regpro_dat["PREG_chFORPRE"]?></option>
<?php
$catpro = $db->select('*', 's_preg', " where PREG_P_inCODPRE!='".$regpro_dat["PREG_P_inCODPRE"]."'");
        while ($catpro_dat = $catpro->fetch_assoc()) {
?>
                <option value="<?=$catpro_dat["PREG_P_inCODPRE"]?>"><?=$catpro_dat["PREG_chFORPRE"]?></option>
<?php }?>
            </select>
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

<span class="btn btn-success btn-file" style="width: 90%">Click Aqui para buscar foto<input type="file" style="width: 100%" name="imagen" id="foto" accept="image/jpg, .jpeg, .jpg, image/jpeg"></span>
<input type="hidden" name="fotoactual" value="<?=$regpro_dat["ENCU_chFOTENC"]?>">
<input type="hidden" name="alto" value="200">
<input type="hidden" name="ancho" value="200">
                                            </div>
                                        </div>
                                    </div>
                                   <!--  <div class="form-group row">
                                        <label for="respuesta" class="col-sm-12 control-label">Configuraciones:</label>
                                    </div>  -->  
                                    <!-- <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label"><b>Ver resultados:</b></label>
                                        <div class="col-sm-9">                       
            <label role="radio" tabindex="-1" class="el-radio-button el-radio-button--small"><input type="radio" name="resultados" tabindex="-1" class="el-radio-button__orig-radio" value="1" <?php if ($regpro_dat["ENCU_inVERRES"]=='1') {echo "checked";}?>><span class="el-radio-button__inner">Despues de votar</span></label>
            <label role="radio" tabindex="-1" class="el-radio-button el-radio-button--small"><input type="radio" name="resultados"  tabindex="-1" class="el-radio-button__orig-radio" value="2" <?php if ($regpro_dat["ENCU_inVERRES"]=='2') {echo "checked";}?>><span class="el-radio-button__inner">Al terminar tiempo</span></label>
            <label role="radio" tabindex="-1" class="el-radio-button el-radio-button--small"><input type="radio" name="resultados"  tabindex="-1" class="el-radio-button__orig-radio" value="3" <?php if ($regpro_dat["ENCU_inVERRES"]=='3') {echo "checked";}?>><span class="el-radio-button__inner">Ambos</span></label>
            <label role="radio" tabindex="-1" class="el-radio-button el-radio-button--small"><input type="radio" name="resultados"  tabindex="-1" class="el-radio-button__orig-radio" value="4" <?php if ($regpro_dat["ENCU_inVERRES"]=='4') {echo "checked";}?>><span class="el-radio-button__inner">Ninguno/Privado</span></label>
                                        </div>   
                                    </div><hr> -->
                                    <!-- <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label"><b>Fechas:</b></label>
                                        <div class="col-sm-9 row">  
<div class="col-lg-6">
    <div class="input-group">
        <div class="input-group-prepend">
            <label class="btn btn-success" for="desde" >Desde</label>
        </div>
            <input type="text" name="desde" id="desde" class="form-control datepicker" value="<?=$regpro_dat["ENCU_dtHORINI"]?>" placeholder="Desde...">
    </div>
</div>
<div class="col-lg-6">
    <div class="input-group">
        <input type="text" name="hasta" id="hasta" class="form-control datepicker" value="<?=$regpro_dat["ENCU_dtHORFIN"]?>" placeholder="Hasta...">
    <div class="input-group-append">
        <label class="btn btn-success" for="hasta">Hasta</label>
    </div>
    </div>
</div>

                                        </div>   
                                    </div>
                                    <hr> -->

                                    <!-- <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label"><b>Generales:</b></label>
                                    </div>     -->
                                <!-- <div class="form-group row">
                                    <div class="col-sm-4">                       
                                        <label for="estado" class="col-sm-12 control-label">Estado</label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="switch">
                                                <label>Inactivo<input type="checkbox" name="estado" id="estado" <?php if ($regpro_dat["ENCU_inESTENC"]=='1') {echo "checked";}?>><span class="lever" ></span>Activo</label>
                                        </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div><hr> -->
                                   

                                    <div id="resultado"></div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-12 col-sm-12">
                                            <center><button class="btn btn-info waves-effect waves-light" id="btn_enviar">Guardar</button></center>
                                        </div>
                                    </div>
                             </form>
                            </div>
                        </div>
                    </div>
</div>

<?php }}
//actualizar encuestas
if ($_GET["accion"]=="actualizar"){

        $grupo = onlyNumbers( $_POST['grupo'] );
        $pregunta = onlyNumbers( $_POST['pregunta'] );
        $resultados = onlyNumbers( $_POST['resultados'] );
        $desde = alfanumerico( $_POST['desde'] );
        $hasta = alfanumerico( $_POST['hasta'] );
        $titulo = textos( $_POST['titulo'] );
        $estado1 = alfanumerico( $_POST['estado'] );
        $cobertura = onlyNumbers( $_POST['cobertura'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}


if ($titulo != null){
$data = array(
    'GRUP_F_inCODGRU' => "".$grupo."",
    'titulo' => "".$titulo."",
    'PREG_F_inCODPRE' => "".$pregunta."",
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
    'ENCU_inESTENC' => "".$estado."",
    'ENCU_dtFECENC' => "".date("Y-m-d h:m:s")."",
);


if ($db->update('v_encu', $data, 'WHERE ENCU_P_inCODRES="'.$id.'"')) {


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
            //Configuracoes de redimensionamento paisagem
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
    'ENCU_chFOTENC' => ''.$handle->file_dst_name.'',
);
$db->update('v_encu', $imagen_data, 'WHERE ENCU_P_inCODRES="'.$id.'"');

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
if ($_GET["accion"]=="crear"){?>
<script>
    select2("grupo");
	$("#btn_enviar").click(function(){
	var url = "<?=$rutaadmin?>encuestas/grabar";
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
            cargar("encuestas");
           }
         });
    return false;
 });

// $('.datepicker').datetimepicker({locale: 'es'});
 
    // Datapicker
    $('#desde').datetimepicker({
      sideBySide: true,
      format: 'YYYY-MM-DD HH:mm',
      // date: moment(),
    });
    $('#hasta').datetimepicker({
      sideBySide: true,
      format: 'YYYY-MM-DD HH:mm',
      // minDate: moment(),
    });

</script>
<div class="row">
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Crear Encuesta</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off">

                                    <div class="form-group row">
                                        <label for="grupo" class="col-sm-3 control-label">Grupo</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fas fa-bookmark"></i>
                                                    </span>
                                                </div>
            <select class="form-control selector" name="grupo" id="grupo" data_tipo="grupo" style="width: 92%">
                <option value="">::: Seleccione Grupo :::</option>
<?php
$catpro = $db->select('*', 'm_grup', "");
        while ($catpro_dat = $catpro->fetch_assoc()) {
?>
                <option value="<?=$catpro_dat["GRUP_P_inCODGRU"]?>"><?=$catpro_dat["GRUP_chNOMGRU"]?></option>
<?php }?>
            </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="titulo" class="col-sm-3 control-label">Titulo</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-align-justify"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo">
                                            </div>
                                        </div>
                                    </div>
               
                                    <div class="form-group row">
                                        <label for="pregunta" class="col-sm-3 control-label">Pregunta</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fas fa-bookmark"></i>
                                                    </span>
                                                </div>
            <select class="form-control selector" name="pregunta" id="pregunta" data_tipo="pregunta" style="width: 92%">
                <option value="">::: Seleccione Pregunta :::</option>
<?php
$catpro = $db->select('*', 's_preg', "");
        while ($catpro_dat = $catpro->fetch_assoc()) {
?>
                <option value="<?=$catpro_dat["PREG_P_inCODPRE"]?>"><?=$catpro_dat["PREG_chFORPRE"]?></option>
<?php }?>
            </select>
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

<span class="btn btn-success btn-file" style="width: 90%">Click Aqui para buscar foto<input type="file" style="width: 100%" name="imagen" id="foto" accept="image/jpg, .jpeg, .jpg, image/jpeg"></span>
<input type="hidden" name="fotoactual" value="<?=$regpro_dat["SECC_chFOTSEC"]?>">
<input type="hidden" name="alto" value="200">
<input type="hidden" name="ancho" value="200">
                                            </div>
                                        </div>
                                    </div>

      
                                    <!-- <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label"><b>Fechas:</b></label>
                                        <div class="col-sm-9 row">  
<div class="col-lg-6">
    <div class="input-group">

<div class="input-group date" id="fecha-publicacion" data-target-input="nearest">
    <input type="text" class="form-control datetimepicker-input fechas" data-target="#desde" name="desde" value="<?=$secc_item["SECC_dtFECPUB"]?>" data_tipo="desde" id="desde" />
    <div class="input-group-append" data-target="#fecha-publicacion" data-toggle="datetimepicker">
    <div class="input-group-text"><i class="fa fa-calendar"></i> Desde</div>
    </div>
</div>
    </div>
</div>
<div class="col-lg-6">
    <div class="input-group">
        <input type="text" name="hasta" id="hasta" class="form-control datepicker" placeholder="Hasta...">
    <div class="input-group-append">
        <label class="btn btn-info" for="hasta">Hasta</label>
    </div>
    </div>
                <div class="input-group date" id="fecha-caducidad" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input fechas" data-target="#hasta" name="hasta" value="<?=$secc_item["SECC_dtFECCAD"]?>" data_tipo="hasta" id="hasta" />
                    <div class="input-group-append" data-target="#fecha-caducidad" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i> Hasta</div>
                    </div>
                </div>

</div>

                                        </div>   
                                    </div>
                                    <hr> -->

                                <div class="form-group row">
                                    <div class="col-sm-4">                       
                                        <label for="estado" class="col-sm-12 control-label">Estado</label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="switch">
                                                <label>Inactivo<input type="checkbox" name="estado" id="estado" checked><span class="lever"></span>Activo</label>
                                        </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                    
<hr>

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

	    $grupo = onlyNumbers( $_POST['grupo'] );
        $pregunta = onlyNumbers( $_POST['pregunta'] );
        $desde =  $_POST['desde'] ;
        $titulo = textos( $_POST['titulo'] );
        $hasta =  $_POST['hasta'] ;
        $estado1 = alfanumerico( $_POST['estado'] );
        $cobertura = onlyNumbers( $_POST['cobertura'] );


if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}


if ($titulo != null){
$data = array(
    'GRUP_F_inCODGRU' => "".$grupo."",
    'titulo' => "".$titulo."",
    'PREG_F_inCODPRE' => "".$pregunta."",
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
    'ENCU_inESTENC' => "".$estado."",
    'ENCU_dtFECENC' => "".date("Y-m-d h:m:s")."",
);

if ($db->insert( 'v_encu', $data )) {


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
    'ENCU_chFOTENC' => ''.$handle->file_dst_name.'',
);
$db->update('v_encu', $imagen_data, 'WHERE ENCU_P_inCODRES="'.$ultimo_id.'"');

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
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong> Error al grabar item, por favor intente nuevamente. </strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>'; 
// $pregunta != null and $desde != null and $hasta != null and $estado != null and $titulo != null
    }


}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error: Falta ingresar dato, por favor intente de nuevo. </strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>';	
	}
}

if ($_GET["accion"]=="eliminar"){
   $id_pro_ext= $_POST["id_pro_ext"];
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{
    $id_pro_ext;

$pro = $db->select('*', 'v_encu', "WHERE ENCU_chEXTIDE='".$id_pro_ext."'");

 while ($pro_dat = $pro->fetch_assoc()) {
 $valor_id=$pro_dat["ENCU_P_inCODRES"];

    $db->delete('v_encu', 'WHERE ENCU_chEXTIDE="'.$id_pro_ext.'"');
    $db->delete('v_preg_resp', 'WHERE ENCU_F_inCODRES="'.$valor_id.'"');

 }

}
	}

//editar encuestas 
if ($_GET["accion"]=="agregarrespuesta"){
?>
<script>
    select2("respuesta");

$("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>encuestas/grabarrespuesta/<?=$id?>";
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
            cargar("encuestas");
            }
        });
    });

    $('.datepicker').datetimepicker({locale: 'es'});
</script>
<div class="row">
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Agregar respuesta</h4>
                                <form method="post" id="formulario" class="form-horizontal form-borderesd  animated bounceIn" enctype="multipart/form-data" autocomplete="off">

                                    <div class="form-group row">
                                        <label for="respuesta" class="col-sm-3 control-label">Respuesta</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fas fa-bookmark"></i>
                                                    </span>
                                                </div>
            <select class="form-control selector" name="respuesta" id="respuesta" data_tipo="respuesta" style="width: 92%">
                <option value="">:::Selecciones una respuesta:::</option>
<?php
$catpro = $db->select('*', 's_resp', "");
        while ($catpro_dat = $catpro->fetch_assoc()) {
?>
                <option value="<?=$catpro_dat["RESP_P_inCODRES"]?>"><?=$catpro_dat["RESP_chFORRES"]?></option>
<?php }?>
            </select>
                                            </div>
                                        </div>
                                    </div>
               
                                    <div id="resultado"></div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-12 col-sm-12">
                                            <center><button class="btn btn-info waves-effect waves-light" id="btn_enviar">Guardar</button></center>
                                        </div>
                                    </div>
                             </form>
                            </div>
                        </div>
                    </div>
</div>

<?php }
if ($_GET["accion"]=="grabarrespuesta"){
        $respuesta = onlyNumbers( $_POST['respuesta'] );

if ($respuesta != null){
$data = array(
    'ENCU_F_inCODRES' => "".$id."",
    'RESP_F_inCODRES' => "".$respuesta."",
    'REPR_chEXTIDE' => "".hash_id()."",
    'RESP_inHITRES' => "0",
);

if ($db->insert( 'v_preg_resp', $data )) {
    echo '<center><div class="alert alert-success notificacion" role="alert"><span><strong>Item guardado con éxito</strong></span></div>
</center><script>
               setTimeout(function(){
   $("#myModal").modal("toggle");
}, 1000);
</script>'; 
}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong> Error al grabar item, por favor intente nuevamente</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>'; 
    }


}else{
    echo '<center><div class="alert alert-danger notificacion" role="alert"><span><strong>Error:  '.$respuesta.'Falta ingresar dato, por favor intente de nuevo.</strong></span></div>
</center><script>
$(".notificacion").fadeTo(2000, 500).slideUp(500, function(){
    $(".notificacion").slideUp(500);
});
</script>'; 
    }
}

//ver respuestas
if ($_GET["accion"]=="respuestas"){

?>
<script>
    select2("respuesta");

$("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>encuestas/actualizar/<?=$id?>";
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
            cargar("encuestas");
            }
        });
    });

        $('.datepicker').datetimepicker({locale: 'es'});
            tablasmodal();

    </script>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>encuestas/agregarrespuesta/<?=$id?>');" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i> Agregar nueva respuesta</button><br><br>

                                    <table id="tbModal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pregunta</th>
                                                <th>Votos</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Pregunta</th>
                                                <th>Votos</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
<?php
$regpro = $db->select('*', 'v_preg_resp vpr', "
    INNER JOIN s_resp sr on sr.RESP_P_inCODRES=vpr.RESP_F_inCODRES
    where vpr.ENCU_F_inCODRES='".$id."'");
        while ($regpro_dat = $regpro->fetch_assoc()) {
?>
<tr>
    <td><?=$regpro_dat["PREG_P_inCODRES"]?></td>
    <td><?=$regpro_dat["RESP_chFORRES"]?></td>
    <td><?=$regpro_dat["RESP_inHITRES"]?></td>
    <td>
    <button onclick="eliminarres('encuestas','<?=$regpro_dat["REPR_chEXTIDE"]?>');" class="btn btn-danger btn-icon btn-circle btn-sm"> <i class="fa fa-trash"></i></button>
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


//ver respuestas
if ($_GET["accion"]=="opiniones"){

?>
<script>

$("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>encuestas/actualizar/<?=$id?>";
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
            cargar("encuestas");
            }
        });
    });

        $('.datepicker').datetimepicker({locale: 'es'});
            tablasmodal();

    </script>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tbModal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Edad</th>
                                                <th>Sexo</th>
                                                <th>Opinión</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Edad</th>
                                                <th>Sexo</th>
                                                <th>Opinión</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
<?php
$regpro = $db->select('*', 'opiniones', "where id_enc='".$id."'");
        while ($regpro_dat = $regpro->fetch_assoc()) {
?>
<tr>
    <td><?=$regpro_dat["id_op"]?></td>
    <td><?=$regpro_dat["edad"]?></td>
    <td><?=$regpro_dat["sexo"]?></td>
    <td><?=$regpro_dat["opinion"]?></td>
    <td><?=$regpro_dat["fecha"]?></td>
    <td>
    <button onclick="eliminartotal('encuestas','eliminarrespuesta','<?=$regpro_dat["externalid"]?>');" class="btn btn-danger btn-icon btn-circle btn-sm"> <i class="fa fa-trash"></i></button>
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
if ($_GET["accion"]=="eliminarrespuesta"){
   $id_pro_ext= $_POST["id"];


$db->delete('v_preg_resp', 'WHERE REPR_chEXTIDE="'.$id_pro_ext.'"');


    }

if ($_GET["accion"]=="eliminarrespuesta"){
   $id_pro_ext= $_POST["id"];


$db->delete('opiniones', 'WHERE externalid="'.$id_pro_ext.'"');


    }

//decargar en excel estadisticas
if ($_GET["accion"]=="descargar_excel"){

$id_descarga=onlyNumbers($id);
set_time_limit(0); 
header('Content-Type: application/vnd.ms-excel');
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=informe_encuesta.xls");
header("Content-type: application/octet-stream");

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">.style1 {font-family: Verdana, Arial, Helvetica, sans-serif;font-weight: bold;}.style2 {font-family: Verdana, Arial, Helvetica, sans-serif}</style>
</head>
<body>
    <div class="col-md-12">
        <div class="table-responsive" id="printOs">
    <center> <b>Reporte generado el: <?=fechaletra(date("Y-m-d"))?> a las <?=date("H:i:s")?><br><br></b> </center>
    <table border class="table table-striped table-bordered nowrap display tablesorter contar" width="100%">
        <thead>
            <tr class="info" style="background-color: #f0f0f0">
                <th>Grupo</th>
                <th>Pregunta</th>
                <th>Fecha inicio</th>
                <th>Fecha termino</th>
                <th>Creado</th>
                <th>Total votos</th>
            </tr>
        </thead>
        <tbody>
<?php
$dat_encu = $db->select_one('*', 'v_encu ve', "
    INNER JOIN s_preg sp ON sp.PREG_P_inCODPRE=ve.PREG_F_inCODPRE
    INNER JOIN m_grup mg ON mg.GRUP_P_inCODGRU=ve.GRUP_F_inCODGRU
    where ve.ENCU_P_inCODRES='".$id."'");
?>
            <tr>
                <td style="text-align: center"><?=$dat_encu["GRUP_chNOMGRU"]?></td>
                <td style="text-align: center"><?=$dat_encu["PREG_chFORPRE"]?></td>
                <td style="text-align: center"><?=$dat_encu["ENCU_dtHORINI"]?></td>
                <td style="text-align: center"><?=$dat_encu["ENCU_dtHORFIN"]?></td>
                <td style="text-align: center"><?=$dat_encu["ENCU_dtFECENC"]?></td>
                <td style="text-align: center"><?=$dat_encu["votos"]?></td>
            </tr>
<?php ?>
        </tbody>
    </table>
    </div>
</div> 

<div class="col-md-12">
        <div class="table-responsive" id="printOs"><br>
     <b>Respuestas:<b>
    <table border class="table table-striped table-bordered nowrap display tablesorter contar">
        <thead>
            <tr class="info" style="background-color: #f0f0f0">
                <th>#</th>
                <th>Respuesta</th>
                <th>Votos</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
<?php
$resp_total = $db->select_one('sum(RESP_inHITRES) as votototal', 'v_preg_resp', "WHERE ENCU_F_inCODRES='".$dat_encu["ENCU_P_inCODRES"]."'");

$resp = $db->select('vpr.ENCU_F_inCODRES, vpr.RESP_F_inCODRES, sum(vpr.RESP_inHITRES) as votototal, sr.RESP_P_inCODRES, sr.RESP_chFORRES, sr.RESP_chEXTIDE, sr.PREG_F_inCODPRE', 'v_preg_resp vpr', "
    INNER JOIN s_resp sr ON sr.RESP_P_inCODRES=vpr.RESP_F_inCODRES
    WHERE ENCU_F_inCODRES='".$dat_encu["ENCU_P_inCODRES"]."'
    group by vpr.RESP_F_inCODRES");
$cont=0;
$votototal='';
    while ($resp_dat = $resp->fetch_assoc()) { $cont++;
?>
            <tr>
                <td><?=$cont?></td>
                <td><?=$resp_dat["RESP_chFORRES"]?></td>
                <td><?=$resp_dat["votototal"]?></td>
                <td><?php
    $porcentaje = (100 * $resp_dat["votototal"]) / $resp_total["votototal"];
    $barraPorcentaje = str_pad('', $porcentaje, '+');
    $barra = str_pad($barraPorcentaje, 100, '-');
    // // printf("[%s]\n%.2f%%\n", $barra, $porcentaje);
    echo "".$porcentaje."%";

                ?></td>
            </tr>
<?php 
$votototal+=$resp_dat["votototal"];
} ?>
            <tr>
                <td colspan="3">Total votos</td>
                <td><?=$votototal?></td>
            </tr>
        </tbody>
    </table>
    </div>
</div>  
<div class="col-md-12">
        <div class="table-responsive" id="printOs"><br>
     <b>Opiniones:<b>
    <table border class="table table-striped table-bordered nowrap display tablesorter contar">
        <thead>
            <tr class="info" style="background-color: #f0f0f0">
                <th>#</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Opinion</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
<?php
$opin = $db->select('*', 'opiniones', "WHERE id_enc='".$dat_encu["ENCU_P_inCODRES"]."'");
$cont_opin=0;
    while ($opindat = $opin->fetch_assoc()) { $cont_opin++;
?>
            <tr>
                <td><?=$cont_opin?></td>
                <td><?=$opindat["edad"]?></td>
                <td><?=$opindat["sexo"]?></td>
                <td><?=$opindat["opinion"]?></td>
                <td><?=$opindat["fecha"]?></td>
            </tr>
<?php } ?>
        </tbody>
    </table>
    </div>
</div>  


    <div class="col-md-12">
        <div class="table-responsive" id="printOs"><br>
    <b>Datos geograficos y otros</b> 
    <table border class="table table-striped table-bordered nowrap display tablesorter contar" >
        <thead>
            <tr class="info" style="background-color: #f0f0f0">
                <th>#</th>
                <th>Fecha visita</th>
                <th>Hora visita</th>
                <th>IP visitante</th>
                <th>Llegó desde</th>
                <th>Navegador</th>
                <th>SO</th>
                <th>Ciudad</th>
                <th>Departamento</th>
                <th>Pais</th>
                <th>Continente</th>
                <th>Latitud/Longitud</th>
            </tr>
        </thead>
        <tbody>
<?php
$cont=0;
$ContVisita = $db->select('*', 'ip_votos', "WHERE id_encuesta='".$id_descarga."'");
while ($ContVisita_dat = $ContVisita->fetch_assoc()) {
$cont++;
$data_visita=json_decode($ContVisita_dat["infovisita"], true);
?>
            <tr>
                <td><?=$cont?></td>
                <td><?=$ContVisita_dat["fecha"]?></td>
                <td><?=$ContVisita_dat["hora"]?></td>
                <td><?=$ContVisita_dat["ip"]?></td>
                <td><?=$ContVisita_dat["vienede"]?></td>
                <td><?=$ContVisita_dat["navegador"]?></td>
                <td><?=$ContVisita_dat["so"]?></td>
                <td><?=$data_visita[geoplugin_city]?></td>
                <td><?=$data_visita[geoplugin_regionName]?></td>
                <td><?=$data_visita[geoplugin_countryName]?></td>
                <td><?=$data_visita[geoplugin_continentName]?></td>
                <td><?=$data_visita[geoplugin_continentName]?>,<?=$data_visita[geoplugin_longitude]?></td>
            </tr>
<?php }?>
        </tbody>
    </table>
    </div>
</div>  


</body>
</html>
<?php }

if ($_GET["accion"]=="graficos"){?>

<?php }
//mostrar graficos
if ($_GET["accion"]=="graficos"){?>

 <div id="morris-donut-chart"></div>
 <div id="morris-bar-chart"></div>

 <script type="text/javascript">
    // Dashboard 1 Morris-chart
$(function () {
    "use strict";


 // Morris donut chart
        
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [
<?php
$resp = $db->select('vpr.ENCU_F_inCODRES, vpr.RESP_F_inCODRES, sum(vpr.RESP_inHITRES) as votototal, sr.RESP_P_inCODRES, sr.RESP_chFORRES, sr.RESP_chEXTIDE, sr.PREG_F_inCODPRE', 'v_preg_resp vpr', "
    INNER JOIN s_resp sr ON sr.RESP_P_inCODRES=vpr.RESP_F_inCODRES
    WHERE ENCU_F_inCODRES='".$id."'
    group by vpr.RESP_F_inCODRES");
    while ($resp_dat = $resp->fetch_assoc()) {
?>
        {
            label: "<?=$resp_dat["RESP_chFORRES"]?>",
            value: <?=$resp_dat["votototal"]?>,

        },
<?php }?>
        

        ],
        resize: true,
        colors:[
        <?php
$resp = $db->select('vpr.ENCU_F_inCODRES, vpr.RESP_F_inCODRES, sum(vpr.RESP_inHITRES) as votototal, sr.RESP_P_inCODRES, sr.RESP_chFORRES, sr.RESP_chEXTIDE, sr.PREG_F_inCODPRE', 'v_preg_resp vpr', "
    INNER JOIN s_resp sr ON sr.RESP_P_inCODRES=vpr.RESP_F_inCODRES
    WHERE ENCU_F_inCODRES='".$id."'
    group by vpr.RESP_F_inCODRES");
    while ($resp_dat = $resp->fetch_assoc()) {
?>
        '<?=randomColor()?>',
<?php }?>
 ]
    });

// Morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [
<?php
$resp = $db->select('vpr.ENCU_F_inCODRES, vpr.RESP_F_inCODRES, sum(vpr.RESP_inHITRES) as votototal, sr.RESP_P_inCODRES, sr.RESP_chFORRES, sr.RESP_chEXTIDE, sr.PREG_F_inCODPRE', 'v_preg_resp vpr', "
    INNER JOIN s_resp sr ON sr.RESP_P_inCODRES=vpr.RESP_F_inCODRES
    WHERE ENCU_F_inCODRES='".$id."'
    group by vpr.RESP_F_inCODRES");
    while ($resp_dat = $resp->fetch_assoc()) {
?>
        {
            y: '<?=$resp_dat["RESP_chFORRES"]?>',
            a: <?=$resp_dat["votototal"]?>,
        }, 
<?php }?>
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['A'],
        barColors:[<?php
$resp = $db->select('vpr.ENCU_F_inCODRES, vpr.RESP_F_inCODRES, sum(vpr.RESP_inHITRES) as votototal, sr.RESP_P_inCODRES, sr.RESP_chFORRES, sr.RESP_chEXTIDE, sr.PREG_F_inCODPRE', 'v_preg_resp vpr', "
    INNER JOIN s_resp sr ON sr.RESP_P_inCODRES=vpr.RESP_F_inCODRES
    WHERE ENCU_F_inCODRES='".$id."'
    group by vpr.RESP_F_inCODRES");
    while ($resp_dat = $resp->fetch_assoc()) {
?>
        '<?=randomColor()?>',
<?php }?>],
        hideHover: 'auto',
        gridLineColor: '<?=randomColor()?>',
        resize: true
    });
});
</script>
<?php }?>