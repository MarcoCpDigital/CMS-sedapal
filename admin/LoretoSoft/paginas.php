<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);
 
if ($_GET["accion"]!="crear" and 
  $_GET["accion"]!="grabar" and 
  $_GET["accion"]!="editar" and 
  $_GET["accion"]!="actualizar" and 
  $_GET["accion"]!="cargar" and 
  $_GET["accion"]!="eliminar" and 
  $_GET["accion"]!="papelera" and 
  $_GET["accion"]!="multimedia" and  
  $_GET["accion"]!="seleccionar" and 
  $_GET["accion"]!="verestados" and 
  $_GET["accion"]!="grabarmultimedia" and 
  $_GET["accion"]!="masivo" and 
  $_GET["accion"]!="crearmultimedia" and 
  $_GET["accion"]!="filtros"){
	header("Location: ".$rutaadmin."error/");
}
if ($_GET["accion"]=="cargar"){?>
<script>
 $("#form_filtro").on('submit', function(e){
    var url = "<?=$rutaadmin?>paginas/filtros";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_buscar').html('Buscando...');
            $('#btn_buscar').attr("disabled", true);
            $('#filtro_estado').html('<img src="'+url_web+'theme/system/dist/img/loading.gif" style="width:15px; height:15px"> Buscando...');
            },
            success: function(data){
            $('#btn_buscar').html('Buscar');
            $('#btn_buscar').attr("disabled", false);
            $('#filtro_estado').html(data);

            }
        });

    });
</script>
        <div class="row">

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form method="post" id="form_filtro" class="form-horizontal " autocomplete="off" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-8 mb-0">
                      <input type="text" class="form-control" name="titulo" placeholder="¿Que pagina buscas?">
                    </div>
                    <div class="form-group col-md-2 mb-0">
                      <select class="custom-select" name="estado">
                        <option value="">Filtro de estados</option>
                        <option value="1">Publicado</option>
                        <option value="2">Borrador</option>
                        <option value="3">Eliminados</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2 mb-0">
                      <button type="submit" class="btn btn-outline-primary btn-block" id="btn_buscar">Buscar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

    <div class="col-12">
      <div class="card">
              <div class="card-header">
<a title="Crear pagina" href="<?=$rutaadmin?>paginas/crear" class="btn btn-primary float-left mb-0"><i class="fa fa-edit"></i> Agregar nueva pagina</a>

<button title="Eliminación masiva" id="btn_eliminacion_masiva" onclick="masivo(2,3)" class="btn btn-outline-danger float-left mb-0 ml-2"><i class="fa fa-trash"></i>  <span id="elimacion_masiva"> Eliminacion masiva </span></button>

<button title="Recuperación masiva" id="btn_recuperacion_masiva" onclick="masivo(2,2)" class="btn btn-outline-success float-left mb-0 ml-2 d-none"><i class="fa fa-recycle"></i>  <span id="recuperacion_masiva"> Recuperación masiva </span></button>

<button title="Eliminación masiva definitiva" id="btn_eliminacion_masiva_definitiva" onclick="masivo(2,4)" class="btn btn-outline-danger float-left mb-0 ml-2 d-none"><i class="fa fa-trash"></i>  <span id="elimacion_masiva"> Eliminacion masiva definitiva </span></button>


<a class="btn btn-outline-primary float-left mb-0 ml-2" id="btn_eliminados" onclick="verEstados('paginas','3');" role="button">Eliminados</a>
<a class="btn btn-outline-primary float-left mb-0 ml-2 d-none" id="btn_publicados" onclick="verEstados('paginas','1');" role="button">Publicados</a>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="filtro_estado">
          <table id="tbPrincipal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha de creación</th>
                        <th class="text-center">Fecha de publicación</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Acciones</th>
                      <th class="text-center" style="max-width: 20px"><input type="checkbox" onClick="toggle(this)" class="option-input checkbox" id="selectTodo" /><label for="selectTodo"></label></th>
                      </tr>
                                        </thead>
        <tfoot>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha de creación</th>
                        <th class="text-center">Fecha de publicación</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Acciones</th>
                        <th class="text-center"></th>
                      </tr>
        </tfoot>
                                        <tbody>
<?php
$emp = $db->select('*', 'm_secc ms', "
INNER JOIN m_usua mu ON mu.USUA_P_inCODUSU=ms.USUA_F_inCODUSU
where ms.SECC_chSECCAT=2 and ms.SECC_inESTSEC!=3");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$emp_dat["SECC_P_inCODSEC"]?></td>
    <td class="text-center"><?=$emp_dat["SECC_chTITSEC"]?></td>
    <td class="text-center">
      <button class="<?php if ($emp_dat["SECC_inESTSEC"]=='1'){echo"btn-success";} else if ($emp_dat["SECC_inESTSEC"]=='2'){echo"btn-danger";} else{echo"btn-secondary";} ?> btn-xs" onclick="CambiarEstado('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');"><i class="fa fa-recycle"></i> <?=estadonot($emp_dat["SECC_inESTSEC"])?></button>
    </td>
    <td class="text-center"><?=$emp_dat["SECC_dtFECCRE"]?></td>
    <td class="text-center"><?=$emp_dat["SECC_dtFECPUB"]?></td>
    <td class="text-center"><?=$emp_dat["USUA_chNOMUSU"]?> </td>
    <td class="text-center">
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-align-justify"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" target="_blank"  href="<?=$ruta?><?=$emp_dat["SECC_txURLSEC"]?>"><i class="fas fa-eye"></i> Ver</a>
                              <a class="dropdown-item"  href="<?=$rutaadmin?>paginas/editar/<?=$emp_dat["SECC_P_inCODSEC"]?>"><i class="fas fa-edit"></i> Editar</a>
                              <a class="dropdown-item"  onclick="papelera('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" ><i class="fas fa-trash"></i>  Eliminar</a>
                              <!-- <a class="dropdown-item"  onclick="eliminar('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a> -->
                            </div>
                          </div>
    </td>
    <td class="text-center">
        <input type="checkbox" name="masivo" value="<?=$emp_dat["SECC_P_inCODSEC"]?>" class="filled-in chk-col-light-blue checkbox" id="Selec-<?=$emp_dat["SECC_P_inCODSEC"]?>"/><label for="Selec-<?=$emp_dat["SECC_P_inCODSEC"]?>"></label>
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

if ($_GET["accion"]=="crear"){
  include "includes/header.php";
include "includes/lateral.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear nueva pagina</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$ruta?>">Escritorio</a></li>
              <li class="breadcrumb-item active"><a>paginas</a></li>
            </ol>
          </div><!-- /.col -->       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- <span id="loader"></span> -->
<div class='cargaweb'>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

<form method="post" id="formulariocrear" class="form-horizontal row" autocomplete="off" enctype="multipart/form-data">
          <!-- Contenido -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control form-control-lg" type="text" placeholder="Agregar título" name="titulo">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Agregar extracto" name="extracto">
                </div>
                <textarea class="textarea" id="editor1" placeholder="Escriba aquí"
  style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="contenido"></textarea>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                Detalles
              </div>
              <div class="card-body">
                 <div class="form-group row">
                    <label for="estado" class="col-sm-12 control-label">Estado</label><br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="switch">
                                <label>Borrador<input type="checkbox" name="estado" id="estado" <?php if ($secc_item["SECC_inESTSEC"] == '1'){echo "checked";}?>><span class="lever"></span>Publicado</label>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="slider" class="col-sm-12 control-label">Slide principal</label><br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="switch">
                                <label>No<input type="checkbox" name="slider" id="slider" <?php if ($secc_item["SECC_inSLIPRI"] == '1'){echo "checked";}?>><span class="lever"></span>Si</label>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                  <label>Fecha de publicación</label>
                  <div class="input-group date" id="fecha-publicacion" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha-publicacion" name="publicacion" />
                    <div class="input-group-append" data-target="#fecha-publicacion" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                 <div class="form-group">
                  <label>Fecha de caducidad</label>
                  <div class="input-group date" id="fecha-caducidad" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha-caducidad" name="caducidad" />
                    <div class="input-group-append" data-target="#fecha-caducidad" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Imagen destacada</label>
                  <div class="custom-file">
                    <div class="sedapal-imagen-destacada-elegida mb-1">
                      <img id="imagen_src" src="" alt="pre-visualización" class="img-responsive foto" style="width: 100%" />
                    </div>
                    <input type="hidden" name="nombreimg" class="nombreimg" value="">

<span class="btn btn-outline-primary btn-file" style="width: 100%; margin-bottom: 10px">Subir nueva imagen<input type="file" style="width: 100%" name="imagen" class="foto"></span>
<button type="button" class="btn btn-outline-primary btn-block"  onclick="modal_lg('<?=$rutaadmin?>multimedia/seleccionar');">Seleccionar imagen</button>
                  </div>
                </div>
                <div id="resultado"></div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary float-right" id="btn_enviar">Publicar</button>
                </div>
              </div>
            </div>
          </div>
        </form>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
    </div>
    <!-- /.content -->


<?php 
include "includes/footer.php"; ?>
<script>
 $("#formulariocrear").on('submit', function(e){
 var date_editor = tinyMCE.activeEditor.getContent();
 var dataform = new FormData(this);
    dataform.append('contenido',date_editor);
    var url = "<?=$rutaadmin?>paginas/grabar";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: dataform,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_enviar').html('Subiendo...');
            $('#btn_enviar').attr("disabled", true);
            },
            success: function(data){
            $('#btn_enviar').html('Guardar');
            // console.log(data);
 data = jQuery.parseJSON(data);
if(data["success"]==false){
$('#btn_enviar').attr("disabled", false);
var type="error";
}else{
$('#btn_enviar').attr("disabled", true);
var type="success";
}

Swal.fire({
  title: data["message"],
  icon: type,
  showCancelButton: false,
  confirmButtonText: 'ok'
}).then((result) => {
  if (result.value) {
    if(data["success"]==true){
        cargar("paginas");
    }
  }
})
            }
        });
    });
manejoimg();
</script>
  <script>
  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.select2-multiple').select2({
  tags: true,
    tokenSeparators: [',']
});
    // // Summernote
    // $('.textarea').summernote({
    //   height: 350,
    //   placeholder: 'Escribe el contenido aquí',
    // })
editor();
    // Datapicker
    $('#fecha-publicacion').datetimepicker({
      sideBySide: true,
      format: 'YYYY-MM-DD HH:mm',
      date: moment(),
    });
    $('#fecha-caducidad').datetimepicker({
      sideBySide: true,
      format: 'YYYY-MM-DD HH:mm',
      minDate: moment(),
    });
    $('#fecha-publicacion').on('change.datetimepicker', function() {
        var new_min_date = $(this).datetimepicker('date');
        $("#fecha-caducidad").datetimepicker('minDate', new_min_date);
    });
  });

</script>
<?php } 

//grabamos item

if ($_GET["accion"]=="grabar"){

        $titulo = alfanumerico( $_POST['titulo'] );
        $extracto = alfanumerico( $_POST['extracto'] );
        $estado1 = alfanumerico( $_POST['estado'] );
        $slider1 = alfanumerico( $_POST['slider'] );
        $contenido = textos( $_POST['contenido'] );
        $publicacion = textos( $_POST['publicacion'] );
        $caducidad =  $_POST['caducidad'] ;

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}
if (isset($slider1) && $slider1 == 'on'){
      $slider="1";}
   else{
      $slider="2";}

if ($titulo != null and $publicacion != null ){

if ($caducidad!="") {
$data = array(
    'SECC_chTITSEC' => "".$titulo."",
    'SECC_txDETSEC' => "".$extracto."",
    'SECC_txCONSEC' => "".$contenido."",
    'SECC_txURLSEC' => "".limpiar($titulo)."",
    'SECC_chEXTID' => "".hash_id()."",
    'SECC_chSECCAT' => "2",
    'SECC_dtFECCRE' => "".date("Y-m-d h:m:s")."",
    'SECC_dtFECPUB' => "".$publicacion."",
    'SECC_dtFECCAD' => "".$caducidad."",
    'SECC_inESTSEC' => "".$estado."",
    'SECC_inSLIPRI' => "".$slider."",
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
);
}else{
$data = array(
    'SECC_chTITSEC' => "".$titulo."",
    'SECC_txDETSEC' => "".$extracto."",
    'SECC_txCONSEC' => "".$contenido."",
    'SECC_txURLSEC' => "".limpiar($titulo)."",
    'SECC_chEXTID' => "".hash_id()."",
    'SECC_chSECCAT' => "2",
    'SECC_dtFECCRE' => "".date("Y-m-d h:m:s")."",
    'SECC_dtFECPUB' => "".$publicacion."",
    'SECC_inESTSEC' => "".$estado."",
    'SECC_inSLIPRI' => "".$slider."",
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
);
}


//comprobamos nombre del item
$ver_reg = $db->select('*', 'm_secc', "where SECC_txURLSEC='".limpiar($titulo)."'");
if($ver_reg->num_rows=='0'){

//intentamos ingresar en la bd los datos
if ($db->insert( 'm_secc', $data )) {
  //grabamos el ultimo id ingresado a la db para posterior uso
$ultimo_id=$db->insert_id;


//si es que se selecciono una imagen
    $archivo = $_FILES['imagen']['name'];
if (isset($archivo) && $archivo != "") {
  //creamos el nombre fisico del archivo
    $nombrefisico = "".md5( uniqid( $_FILES['imagen']['name'] ) ).".".pathinfo($archivo, PATHINFO_EXTENSION)."";
        $tipo = $_FILES['imagen']['type'];
        $tamano = $_FILES['imagen']['size'];
        $temp = $_FILES['imagen']['tmp_name'];

//revisamos la extensión
        if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png") || strpos($tipo, "doc") || strpos($tipo, "docx") || strpos($tipo, "xls") || strpos($tipo, "xlsx") || strpos($tipo, "pdf")) && ($tamano < 2097152))) {
    echo '{"success": false, "message": "Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo."}';
        }
        else {
            if (move_uploaded_file($temp, '../../uploads/'.$nombrefisico)) {
                chmod('../../uploads/'.$nombrefisico, 0777);


//creamos el thumbnails
include('../../includes/class/ImageResize.php');
$image = new \Gumlet\ImageResize('../../uploads/'.$nombrefisico.'');
$image->quality_jpg = 60;
$image->crop(200,200);
$image->save('../../uploads/thumbnails/'.$nombrefisico.'');

$data = array(
    'SECC_chFOTSEC' => "".$nombrefisico."",
  );
$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"');


    echo '{"success": true, "message": "pagina guardado con éxitos."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }


// si es que no se lecciono nada en el navegador
}else{

$data = array(
    'SECC_chFOTSEC' => "".$nombreimg."",
  );
$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"');

    echo '{"success": true, "message": "pagina guardado con éxitos."}';


}


//si falla el grabado de item
}else{
    echo '{"success": false, "message": "Error al grabar pagina, por favor intente nuevamente."}';
    }

//si ya existe el item url
  }else{
    echo '{"success": false, "message": "Error al grabar pagina, el nombre ya existe."}';
}

//si falta un dato
}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
    }
}


//eliminar item
if ($_GET["accion"]=="eliminar"){
    
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{

  if ($db->delete('v_etiq_noti', 'WHERE SECC_F_inCODSEC="'.$id.'"')) {
    $db->delete('m_secc', 'WHERE SECC_P_inCODSEC="'.$id.'"');
  }

} 

}


if ($_GET["accion"]=="papelera"){
    
    $idcambiar = onlyNumbers($_POST["id_pro_ext"]);

// $sid->start();
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{

$data = array(
    'SECC_inESTSEC' => "3",
);

$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$idcambiar.'"');

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
    'SECC_inESTSEC' => "".$estado."",
);

$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$idcambiar.'"');

}

}




if ($_GET["accion"]=="editar"){
  include "includes/header.php";
include "includes/lateral.php";
$secc_item = $db->select_one('*', 'm_secc', "where SECC_P_inCODSEC='".$id."' ");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar pagina</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$rutaadmin?>">Escritorio</a></li>
              <li class="breadcrumb-item active"><a href="<?=$rutaadmin?>paginas/">paginas</a></li>
            </ol>
          </div><!-- /.col -->       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- <span id="loader"></span> -->
<div class='cargaweb'>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

<form method="post" id="formularioeditar" class="form-horizontal row" autocomplete="off" enctype="multipart/form-data">
          <!-- Contenido -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control form-control-lg" type="text" placeholder="Agregar título" name="titulo" value="<?=$secc_item["SECC_chTITSEC"]?>">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Agregar extracto" name="extracto" value="<?=$secc_item["SECC_txDETSEC"]?>">
                </div>
                <textarea class="textarea" id="editor1" placeholder="Escriba aquí"
  style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="contenido"><?=$secc_item["SECC_txCONSEC"]?></textarea>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                Detalles
              </div>
              <div class="card-body">
                 <div class="form-group row">
                    <label for="slider" class="col-sm-12 control-label">Estado</label><br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="switch">
                                <label>Borrador<input type="checkbox" name="slider" id="slider" <?php if ($secc_item["SECC_inESTSEC"] == '1'){echo "checked";}?>><span class="lever"></span>Publicado</label>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="email" class="col-sm-12 control-label">Slide principal</label><br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="switch">
                                <label>No<input type="checkbox" name="estado" id="estado" <?php if ($secc_item["SECC_inSLIPRI"] == '1'){echo "checked";}?>><span class="lever"></span>Si</label>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                  <label>Fecha de publicación</label>
                  <div class="input-group date" id="fecha-publicacion" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha-publicacion" name="publicacion" value="<?=$secc_item["SECC_dtFECPUB"]?>" />
                    <div class="input-group-append" data-target="#fecha-publicacion" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                 <div class="form-group">
                  <label>Fecha de caducidad</label>
                  <div class="input-group date" id="fecha-caducidad" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha-caducidad" name="caducidad" value="<?=$secc_item["SECC_dtFECCAD"]?>" />
                    <div class="input-group-append" data-target="#fecha-caducidad" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Imagen destacada</label>
                  <div class="custom-file">
                    <div class="sedapal-imagen-destacada-elegida mb-1">
                      <img id="imagen_src" src="<?=$ruta?>uploads/<?=$secc_item["SECC_chFOTSEC"]?>" alt="pre-visualización" class="img-responsive foto" style="width: 100%" />
                    </div>
                    <input type="hidden" name="nombreimg" class="nombreimg" value="<?=$secc_item["SECC_chFOTSEC"]?>">

<span class="btn btn-outline-primary btn-file" style="width: 100%; margin-bottom: 10px">Subir nueva imagen<input type="file" style="width: 100%" name="imagen" class="foto"></span>
<a class="btn btn-outline-primary btn-block"  onclick="modal_lg('<?=$rutaadmin?>multimedia/seleccionar');">Seleccionar imagen</a>
                  </div>
                </div>
                <div id="resultado"></div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary float-right" id="btn_enviar">Publicar</button>
                </div> 
              </div>
            </div>
          </div>
        </form>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
    </div>
    <!-- /.content -->


<?php 
include "includes/footer.php"; ?>
<script>
 $("#formularioeditar").on('submit', function(e){
 var date_editor = tinyMCE.activeEditor.getContent();
 var dataform = new FormData(this);
    dataform.append('contenido',date_editor);
    var url = "<?=$rutaadmin?>paginas/actualizar/<?=onlyNumbers($_GET["id"])?>";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: dataform,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_enviar').html('Subiendo...');
            $('#btn_enviar').attr("disabled", true);
            },
            success: function(data){
            $('#btn_enviar').html('Guardar');
            console.log(data);
 data = jQuery.parseJSON(data);
if(data["success"]==false){
$('#btn_enviar').attr("disabled", false);
var type="error";
}else{
$('#btn_enviar').attr("disabled", true);
var type="success";
}

Swal.fire({
  title: data["message"],
  icon: type,
  showCancelButton: false,
  confirmButtonText: 'ok'
}).then((result) => {
  if (result.value) {
    if(data["success"]==true){
        cargar("paginas");
        // $('#ModalSystem').modal('hide')
    }
  }
})
            }
        });
    });
manejoimg();
</script>
  <script>
  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.select2-multiple').select2({
  tags: true,
    tokenSeparators: [',']
});
    // // Summernote
    // $('.textarea').summernote({
    //   height: 350,
    //   placeholder: 'Escribe el contenido aquí',
    // })
editor();
    // Datapicker
    $('#fecha-publicacion').datetimepicker({
      sideBySide: true,
      format: 'YYYY-MM-DD HH:mm',
      // date: moment(),
    });
    $('#fecha-caducidad').datetimepicker({
      sideBySide: true,
      format: 'YYYY-MM-DD HH:mm',
      // minDate: moment(),
    });
    $('#fecha-publicacion').on('change.datetimepicker', function() {
        var new_min_date = $(this).datetimepicker('date');
        $("#fecha-caducidad").datetimepicker('minDate', new_min_date);
    });
  });

</script>
<?php } 



//grabamos item
if ($_GET["accion"]=="actualizar"){

        $titulo = alfanumerico( $_POST['titulo'] );
        $extracto = alfanumerico( $_POST['extracto'] );
        $estado1 = alfanumerico( $_POST['estado'] );
        $slider1 = alfanumerico( $_POST['slider'] );
        $contenido = textos( $_POST['contenido'] );
        $publicacion = textos( $_POST['publicacion'] );
        $nombreimg = textos( $_POST['nombreimg'] );
        $caducidad =  $_POST['caducidad'] ;

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}
if (isset($slider1) && $slider1 == 'on'){
      $slider="1";}
   else{
      $slider="2";}

if ($titulo != null and $publicacion != null ){

if ($caducidad!="") {
$data = array(
    'SECC_chTITSEC' => "".$titulo."",
    'SECC_txDETSEC' => "".$extracto."",
    'SECC_txCONSEC' => "".$contenido."",
    'SECC_txURLSEC' => "".limpiar($titulo)."",
    'SECC_chEXTID' => "".hash_id()."",
    'SECC_chSECCAT' => "2",
    'SECC_dtFECCRE' => "".date("Y-m-d h:m:s")."",
    'SECC_dtFECPUB' => "".$publicacion."",
    'SECC_dtFECCAD' => "".$caducidad."",
    'SECC_inSLIPRI' => "".$slider."",
    'SECC_inESTSEC' => "".$estado."",
);
}else{
$data = array(
    'SECC_chTITSEC' => "".$titulo."",
    'SECC_txDETSEC' => "".$extracto."",
    'SECC_txCONSEC' => "".$contenido."",
    'SECC_txURLSEC' => "".limpiar($titulo)."",
    'SECC_chEXTID' => "".hash_id()."",
    'SECC_chSECCAT' => "2",
    'SECC_dtFECCRE' => "".date("Y-m-d h:m:s")."",
    'SECC_dtFECPUB' => "".$publicacion."",
    'SECC_inSLIPRI' => "".$slider."",
    'SECC_inESTSEC' => "".$estado."",
);
}

//comprobamos nombre del item
$ver_reg = $db->select('*', 'm_secc', "where SECC_txURLSEC='".limpiar($titulo)."' and SECC_P_inCODSEC!='".onlyNumbers($_GET["id"])."'");
if($ver_reg->num_rows=='0'){

//intentamos ingresar en la bd los datos
if ($db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$id.'"')) {
  //grabamos el ultimo id ingresado a la db para posterior uso
$ultimo_id=$db->insert_id;



//si es que se selecciono una imagen
    $archivo = $_FILES['imagen']['name'];
if (isset($archivo) && $archivo != "") {
  //creamos el nombre fisico del archivo
    $nombrefisico = "".md5( uniqid( $_FILES['imagen']['name'] ) ).".".pathinfo($archivo, PATHINFO_EXTENSION)."";
        $tipo = $_FILES['imagen']['type'];
        $tamano = $_FILES['imagen']['size'];
        $temp = $_FILES['imagen']['tmp_name'];

//revisamos la extensión
        if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png") || strpos($tipo, "doc") || strpos($tipo, "docx") || strpos($tipo, "xls") || strpos($tipo, "xlsx") || strpos($tipo, "pdf")) && ($tamano < 2097152))) {
    echo '{"success": false, "message": "Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo."}';
        }
        else {
            if (move_uploaded_file($temp, '../../uploads/'.$nombrefisico)) {
                chmod('../../uploads/'.$nombrefisico, 0777);


//creamos el thumbnails
include('../../includes/class/ImageResize.php');
$image = new \Gumlet\ImageResize('../../uploads/'.$nombrefisico.'');
$image->quality_jpg = 60;
$image->crop(200,200);
$image->save('../../uploads/thumbnails/'.$nombrefisico.'');

$data = array(
    'SECC_chFOTSEC' => "".$nombrefisico."",
  );
$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"');


    echo '{"success": true, "message": "pagina guardado con éxitos."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }


// si es que no se lecciono nada en el navegador
}else{

$data2 = array(
    'SECC_chFOTSEC' => "".$nombreimg."",
  );
$db->update('m_secc', $data2, 'WHERE SECC_P_inCODSEC="'.$id.'"');

    echo '{"success": true, "message": "pagina guardado con éxitos."}';


}


//si falla el grabado de item
}else{
    echo '{"success": false, "message": "Error al grabar pagina, por favor intente nuevamente."}';
    }

//si ya existe el item url
  }else{
    echo '{"success": false, "message": "Error al grabar pagina, el nombre ya existe."}';
}

//si falta un dato
}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
    }
}



//cargamos item segun estados
if ($_GET["accion"]=="verestados"){

    $estado = onlyNumbers($_POST["estado"]);
if ($estado=='1') {
  $buscar = 'ms.SECC_inESTSEC!=3';

}else{
  $buscar = 'ms.SECC_inESTSEC=3';
}
$emp = $db->select('*', 'm_secc ms', "
INNER JOIN m_usua mu ON mu.USUA_P_inCODUSU=ms.USUA_F_inCODUSU
where ms.SECC_chSECCAT=2 and ".$buscar."");
$cont=0;?>
<script type="text/javascript">tablas();</script>
          <table id="tbPrincipal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha de creación</th>
                        <th class="text-center">Fecha de publicación</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Acciones</th>
                      <th class="text-center" style="max-width: 20px"><input type="checkbox" onClick="toggle(this)" class="option-input checkbox" id="selectTodo" /><label for="selectTodo"></label></th>
                      </tr>
                                        </thead>
        <tfoot>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha de creación</th>
                        <th class="text-center">Fecha de publicación</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Acciones</th>
                        <th class="text-center"></th>
                      </tr>
        </tfoot>
                                        <tbody>

<?php
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$emp_dat["SECC_P_inCODSEC"]?></td>
    <td class="text-center"><?=$emp_dat["SECC_chTITSEC"]?></td>
    <td class="text-center">
      <button class="<?php if ($emp_dat["SECC_inESTSEC"]=='1'){echo"btn-success";} else if ($emp_dat["SECC_inESTSEC"]=='2'){echo"btn-danger";} else{echo"bg-secondary";} ?> btn-xs" onclick="CambiarEstado('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');"><i class="fa fa-recycle"></i> <?=estadonot($emp_dat["SECC_inESTSEC"])?></button>
    </td>
    <td class="text-center"><?=$emp_dat["SECC_dtFECCRE"]?></td>
    <td class="text-center"><?=$emp_dat["SECC_dtFECPUB"]?></td>
    <td class="text-center"><?=$emp_dat["USUA_chNOMUSU"]?> </td>
    <td class="text-center">
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-align-justify"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item"  href="<?=$rutaadmin?>paginas/editar/<?=$emp_dat["SECC_P_inCODSEC"]?>">Editar</a>
<?php 
if ($estado!='3') { ?>
                              <a class="dropdown-item"  onclick="papelera('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Papelera</a>
                              <a class="dropdown-item"  onclick="eliminar('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a>
<?php }else{ ?>
                              <a class="dropdown-item"  onclick="recuperar('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Recuperar</a>
                              <a class="dropdown-item"  onclick="eliminar('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a>
<?php }?>

                            </div>
                          </div>
    </td>
    <td class="text-center">
        <input type="checkbox" name="masivo" value="<?=$emp_dat["SECC_P_inCODSEC"]?>" class="filled-in chk-col-purple checkbox" id="Selec-<?=$emp_dat["SECC_P_inCODSEC"]?>"/><label for="Selec-<?=$emp_dat["SECC_P_inCODSEC"]?>"></label>
    </td>

</tr>
<?php }?>
                                        </tbody>
</table>
<?php
}

//recuperamos pagina
if ($_GET["accion"]=="recuperar"){

    $idcambiar = onlyNumbers($_POST["id_pro_ext"]);

// $sid->start();
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{

$data = array(
    'SECC_inESTSEC' => "2",
);

$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$idcambiar.'"');

}   


}


//para seleccionar pagina
if ($_GET["accion"]=="seleccionar"){
    $idcambiar = onlyNumbers($_POST["id_pro_ext"]);
 ?>
<script type="text/javascript">
  tablasmodal();
</script>
          <!-- <form>
            <div class="form-row">
              <div class="form-group col-md-2 mb-0">
                <select class="custom-select">
                  <option value="">Filtrar por categoría</option>
                </select>
              </div>
              <div class="form-group col-md-6 mb-0">
                <input type="text" class="form-control" placeholder="¿Que noticia o página buscas?">
              </div>
              <div class="form-group col-md-2 mb-0">
                <select class="custom-select">
                  <option value="">Estado</option>
                </select>
              </div>
              <div class="form-group col-md-2 mb-0">
                <button type="submit" class="btn btn-outline-primary btn-block">Buscar</button>
              </div>
            </div>
          </form><br> -->
          <div class="table-responsive">
                      <!-- <table id="tbPrincipal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%"> -->

                  <table id="tbModal" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <!-- <th class="text-center">Estado</th> -->
                        <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <!-- <th class="text-center">Estado</th> -->
                        <th class="text-center">Acciones</th>
                      </tr>
                    </tfoot>
                    <tbody>
<?php
$emp = $db->select('*', 'm_secc ms', "
where ms.SECC_chSECCAT=2 and ms.SECC_inESTSEC=1");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$emp_dat["SECC_P_inCODSEC"]?></td>
    <td class="text-center"><?=$emp_dat["SECC_chTITSEC"]?></td>
    <!-- <td class="text-center">
      <button class="<?php if ($emp_dat["SECC_inESTSEC"]=='1'){echo"btn-success";} else if ($emp_dat["SECC_inESTSEC"]=='2'){echo"btn-danger";} else{echo"btn-secondary";} ?> btn-xs" onclick="CambiarEstado('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');"><i class="fa fa-recycle"></i> <?=estadonot($emp_dat["SECC_inESTSEC"])?></button>
    </td> -->
    <td class="text-center">
      <button type="button" class="btn btn-outline-primary urlpag_<?=$emp_dat["SECC_P_inCODSEC"]?>" onclick="seleccionarpagina('<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');" url="<?=$ruta?><?=$emp_dat["SECC_txURLSEC"]?>" id_pag="<?=$emp_dat["SECC_P_inCODSEC"]?>">Elegir</button>
    </td>
</tr>
<?php }?>
                    </tbody>
                  </table>
                </div>

<?php } 

//eliminacion masiva
if ($_GET["accion"]=="masivo"){

if ($_POST["id_doc"]){
$id_secc=$_POST["id_doc"];


$id_secc_num = explode("-", $id_secc);
$id_secc_num = str_replace("'","",$id_secc_num);
foreach ($id_secc_num as $id_secc_con) {

//si viene estado 4 eliminados de BD
if ($id=="4") {

$db->delete('m_secc', 'WHERE SECC_P_inCODSEC="'.$id_secc_con.'"');

}
//si viene para papelera o restauracion
else if ($id=="2" or $id=="3"){

$data = array(
    'SECC_inESTSEC' => "".$id."",
);

$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$id_secc_con.'"');

}else{
  
}

}

}else{
  echo 'Acceso prohibido, por favor haga <a href="'.$ruta.'">click aqui</a> para ir a la pagina principal';
}

}





//filtros
if ($_GET["accion"]=="filtros"){

    $titulo = alfanumerico($_POST["titulo"]);
    $estado = onlyNumbers($_POST["estado"]);

if ($estado!='') {
  $buscar_estado = ' and ms.SECC_inESTSEC='.$estado.' ';
}

if ($titulo!='') {
  $buscar_titulo = ' and ms.SECC_chTITSEC like "%'.$titulo.'%" ';
}



$emp = $db->select('*', 'm_secc ms', "
INNER JOIN m_usua mu ON mu.USUA_P_inCODUSU=ms.USUA_F_inCODUSU
where ms.SECC_chSECCAT=2 ".$buscar_estado." ".$buscar_titulo." ".$buscar_categoria."");
$cont=0;?>
<script type="text/javascript">tablas();</script>
          <table id="tbPrincipal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha de creación</th>
                        <th class="text-center">Fecha de publicación</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Acciones</th>
                      <th class="text-center" style="max-width: 20px"><input type="checkbox" onClick="toggle(this)" class="option-input checkbox" id="selectTodo" /><label for="selectTodo"></label></th>
                      </tr>
                                        </thead>
        <tfoot>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha de creación</th>
                        <th class="text-center">Fecha de publicación</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Acciones</th>
                        <th class="text-center"></th>
                      </tr>
        </tfoot>
                                        <tbody>

<?php
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$emp_dat["SECC_P_inCODSEC"]?></td>
    <td class="text-center"><?=$emp_dat["SECC_chTITSEC"]?></td>
    <td class="text-center">
      <button class="<?php if ($emp_dat["SECC_inESTSEC"]=='1'){echo"btn-success";} else if ($emp_dat["SECC_inESTSEC"]=='2'){echo"btn-danger";} else{echo"bg-secondary";} ?> btn-xs" onclick="CambiarEstado('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');"><i class="fa fa-recycle"></i> <?=estadonot($emp_dat["SECC_inESTSEC"])?></button>
    </td>
    <td class="text-center"><?=$emp_dat["SECC_dtFECCRE"]?></td>
    <td class="text-center"><?=$emp_dat["SECC_dtFECPUB"]?></td>
    <td class="text-center"><?=$emp_dat["USUA_chNOMUSU"]?> </td>
    <td class="text-center">
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-align-justify"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item"  href="<?=$rutaadmin?>paginas/editar/<?=$emp_dat["SECC_P_inCODSEC"]?>">Editar</a>
<?php 
if ($estado!='3') { ?>
                              <a class="dropdown-item"  onclick="papelera('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Papelera</a>
                              <a class="dropdown-item"  onclick="eliminar('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a>
<?php }else{ ?>
                              <a class="dropdown-item"  onclick="recuperar('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Recuperar</a>
                              <a class="dropdown-item"  onclick="eliminar('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a>
<?php }?>

                            </div>
                          </div>
    </td>
    <td class="text-center">
        <input type="checkbox" name="masivo" value="<?=$emp_dat["SECC_P_inCODSEC"]?>" class="filled-in chk-col-purple checkbox" id="Selec-<?=$emp_dat["SECC_P_inCODSEC"]?>"/><label for="Selec-<?=$emp_dat["SECC_P_inCODSEC"]?>"></label>
    </td>

</tr>
<?php }?>
                                        </tbody>
</table>
<?php
}?>