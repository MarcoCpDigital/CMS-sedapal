<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="crear" and 
  $_GET["accion"]!="grabar" and 
  $_GET["accion"]!="editar" and 
  $_GET["accion"]!="actualizar" and 
  $_GET["accion"]!="cargar" and 
  $_GET["accion"]!="papelera" and 
  $_GET["accion"]!="verestados" and 
  $_GET["accion"]!="eliminar" and 
  $_GET["accion"]!="cambiarestado"){
  header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>

        <div class="row">
          <!-- Filtro -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-8 mb-0">
                      <input type="text" class="form-control" placeholder="¿Que página buscas?">
                    </div>
                    <div class="form-group col-md-2 mb-0">
                      <select class="custom-select">
                        <option value="">Estado</option>
                        <option value="1">Publicado</option>
                        <option value="2">Borrador</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2 mb-0">
                      <button type="submit" class="btn btn-outline-primary btn-block">Buscar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

                    <div class="col-12">

                        <div class="card">
              <div class="card-header">
<button title="Crear página" onclick="modal_lg('<?=$rutaadmin?>paginas/crear');" class="btn btn-primary float-left mb-0"><i class="fa fa-edit"></i> Agregar nueva página</button>
<a class="btn btn-outline-primary float-left mb-0 ml-2" id="btn_eliminados" onclick="verEstados('paginas','3');" role="button">Eliminados</a>
<a class="btn btn-outline-primary float-left mb-0 ml-2 d-none" id="btn_publicados" onclick="verEstados('paginas','1');" role="button">Publicados</a>
              </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                      </tr>
        </tfoot>
                                        <tbody id="filtro_estado">
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
      <button class="<?php if ($emp_dat["SECC_inESTSEC"]=='1'){echo"btn-success";} else if ($emp_dat["SECC_inESTSEC"]=='2'){echo"btn-danger";} else{echo"btn-secondary";} ?> btn-xs" onclick="CambiarEstado('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');"><i class="fa fa-recycle"></i> <?=estado($emp_dat["SECC_inESTSEC"])?></button>
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
                              <a class="dropdown-item"  onclick="papelera('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Papelera</a>
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
if ($_GET["accion"]=="crear"){?>
<script>
 $("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>paginas/grabar";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
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
}

Swal.fire({
  title: data["message"],
  type: type,
  showCancelButton: false,
  confirmButtonText: 'ok'
}).then((result) => {
  if (result.value) {
    if(data["success"]==true){
        cargar("paginas");
        $('#ModalSystem').modal('hide')
    }
  }
})
            }
        });
    });
</script>
<form method="post" id="formulario" class="form-horizontal row" autocomplete="off" enctype="multipart/form-data">
          <!-- Contenido -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control form-control-lg" type="text" placeholder="Agregar título" name="titulo" value="<?=$regusu_dat["SECC_chTITSEC"]?>">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Agregar extracto" name="extracto" value="<?=$regusu_dat["SECC_txDETSEC"]?>">
                </div>
                <textarea class="textarea" placeholder="Escriba aquí" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="contenido"><?=$regusu_dat["SECC_txCONSEC"]?></textarea>
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
                    <label for="email" class="col-sm-12 control-label">Estado</label>
                    <div class="col-sm-9"><center>
                        <div class="input-group">
                            <div class="switch">
                                <label>Borrador<input type="checkbox" name="estado" <?php if ($regusu_dat["SECC_inESTSEC"] == '1'){echo "checked";}?>><span class="lever"></span>Publicado</label>
                            </div></center>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                  <label>Fecha de publicación</label>
                  <div class="input-group date" id="fecha-publicacion" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha-publicacion" name="publicacion" value="<?=$regusu_dat["SECC_dtFECPUB"]?>" />
                    <div class="input-group-append" data-target="#fecha-publicacion" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                 <div class="form-group">
                  <label>Fecha de caducidad</label>
                  <div class="input-group date" id="fecha-caducidad" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha-caducidad" name="caducidad" value="<?=$regusu_dat["SECC_dtFECCAD"]?>" />
                    <div class="input-group-append" data-target="#fecha-caducidad" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Imagen destacada</label>
                  <div class="custom-file">
                    <!-- <div class="sedapal-imagen-destacada-elegida mb-1" style="background-image: url(<?=$ruta?>uploads/thumbnails/<?=$regusu_dat["SECC_chFOTSEC"]?>) "></div> -->
                        <span class="btn btn-primary btn-file" style="width: 100%">Cambiar Imagen<input type="file" style="width: 100%" name="imagen" id="foto"></span>
                    <!-- <a href="#" class="btn btn-outline-primary btn-block"  onclick="modal_lg('<?=$rutaadmin?>agregar_noticia/seleccionar');">Cambiar imagen</a> -->
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
   <script>
  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.select2-multiple').select2();
    // Summernote
    $('.textarea').summernote({
      height: 350,
      placeholder: 'Escribe el contenido aquí',
    })

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
  })
</script> 

<?php }

if ($_GET["accion"]=="grabar"){

        $titulo = alfanumerico( $_POST['titulo'] );
        $extracto = alfanumerico( $_POST['extracto'] );
        $estado1 = alfanumerico( $_POST['estado'] );
        $contenido = textos( $_POST['contenido'] );
        $publicacion = textos( $_POST['publicacion'] );
        $caducidad =  $_POST['caducidad'] ;

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

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
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
);
}

$ver_reg = $db->select('*', 'm_secc', "where SECC_txURLSEC='".limpiar($titulo)."'");

if($ver_reg->num_rows=='0'){

if ($db->insert( 'm_secc', $data )) {

$ultimo_id=$db->insert_id;

if ( $_FILES['imagen'] != null ) {
    $archivo = $_FILES['imagen']['name'];
    $nombrefisico = "".md5( uniqid( $_FILES['imagen']['name'] ) ).".".pathinfo($archivo, PATHINFO_EXTENSION)."";
    if (isset($archivo) && $archivo != "") {
        $tipo = $_FILES['imagen']['type'];
        $tamano = $_FILES['imagen']['size'];
        $temp = $_FILES['imagen']['tmp_name'];
        //lñistamos las extensiones por revisar a nivel servidor
        if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png") || strpos($tipo, "doc") || strpos($tipo, "docx") || strpos($tipo, "xls") || strpos($tipo, "xlsx") || strpos($tipo, "pdf")) && ($tamano < 2097152))) {
    echo '{"success": false, "message": "Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo."}';
        }
        else {
            if (move_uploaded_file($temp, '../../uploads/'.$nombrefisico)) {
                chmod('../../uploads/'.$nombrefisico, 0777);

include('../../includes/class/ImageResize.php');
$image = new \Gumlet\ImageResize('../../uploads/'.$nombrefisico.'');
$image->quality_jpg = 60;
$image->crop(100,100);
$image->save('../../uploads/thumbnails/'.$nombrefisico.'');

$data = array(
    'SECC_chFOTSEC' => "".$nombrefisico."",
  );
$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"');

    echo '{"success": true, "message": "Página guardado con éxitos."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }
    }
}else{

    echo '{"success": true, "message": "Página guardado con éxitos."}';
}

}else{
    echo '{"success": false, "message": "Error al grabar página, por favor intente nuevamente."}';
    }

}else{
    echo '{"success": false, "message": "Error al grabar página, <b>el nombre ya existe</b>."}';
}

}else{
    echo '{"success": false, "message": "Error: <b>Falta ingresar dato</b>, por favor intente de nuevo."}';
    }
}

//editar item
if ($_GET["accion"]=="editar"){
  $regusu = $db->select('*', 'm_secc', "
    where SECC_P_inCODSEC='".$id."'");
        while ($regusu_dat = $regusu->fetch_assoc()) {
          ?>
<script>
 $("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>paginas/actualizar/<?=$id?>";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
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
}

Swal.fire({
  title: data["message"],
  type: type,
  showCancelButton: false,
  confirmButtonText: 'ok'
}).then((result) => {
  if (result.value) {
    if(data["success"]==true){
        cargar("paginas");
        $('#ModalSystem').modal('hide')
    }
  }
})
            }
        });
    });
</script>
<form method="post" id="formulario" class="form-horizontal row" autocomplete="off" enctype="multipart/form-data">
          <!-- Contenido -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control form-control-lg" type="text" placeholder="Agregar título" name="titulo" value="<?=$regusu_dat["SECC_chTITSEC"]?>">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Agregar extracto" name="extracto" value="<?=$regusu_dat["SECC_txDETSEC"]?>">
                </div>
                <textarea class="textarea" placeholder="Escriba aquí" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="contenido"><?=$regusu_dat["SECC_txCONSEC"]?></textarea>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header">
                Detalles
              </div>
              <div class="card-body">
                 <div class="form-group row">
                    <label for="email" class="col-sm-12 control-label">Estado</label>
                    <div class="col-sm-9"><center>
                        <div class="input-group">
                            <div class="switch">
                                <label>Borrador<input type="checkbox" name="estado" <?php if ($regusu_dat["SECC_inESTSEC"] == '1'){echo "checked";}?>><span class="lever"></span>Publicado</label>
                            </div></center>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                  <label>Fecha de publicación</label>
                  <div class="input-group date" id="fecha-publicacion" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha-publicacion" name="publicacion" value="<?=$regusu_dat["SECC_dtFECPUB"]?>" />
                    <div class="input-group-append" data-target="#fecha-publicacion" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                 <div class="form-group">
                  <label>Fecha de caducidad</label>
                  <div class="input-group date" id="fecha-caducidad" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha-caducidad" name="caducidad" value="<?=$regusu_dat["SECC_dtFECCAD"]?>" />
                    <div class="input-group-append" data-target="#fecha-caducidad" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Imagen destacada</label>
                  <div class="custom-file">
                    <div class="sedapal-imagen-destacada-elegida mb-1" style="background-image: url(<?=$ruta?>uploads/thumbnails/<?=$regusu_dat["SECC_chFOTSEC"]?>) "></div>
                        <span class="btn btn-primary btn-file" style="width: 100%">Cambiar Imagen<input type="file" style="width: 100%" name="imagen" id="foto"></span>
                    <!-- <a href="#" class="btn btn-outline-primary btn-block"  onclick="modal_lg('<?=$rutaadmin?>agregar_noticia/seleccionar');">Cambiar imagen</a> -->
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
   <script>
  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.select2-multiple').select2();
    // Summernote
    $('.textarea').summernote({
      height: 350,
      placeholder: 'Escribe el contenido aquí',
    })

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
  })
</script> 

<?php }}

if ($_GET["accion"]=="actualizar"){

        $titulo = alfanumerico( $_POST['titulo'] );
        $extracto = alfanumerico( $_POST['extracto'] );
        $estado1 = alfanumerico( $_POST['estado'] );
        $contenido = textos( $_POST['contenido'] );
        $publicacion = textos( $_POST['publicacion'] );
        $caducidad =  $_POST['caducidad'] ;

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

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
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
);
}

$ver_reg = $db->select('*', 'm_secc', "where SECC_txURLSEC='".limpiar($titulo)."'");

if($ver_reg->num_rows=='0'){

if ($db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"')) {

$ultimo_id=$db->insert_id;

if ( $_FILES['imagen'] != null ) {
    $archivo = $_FILES['imagen']['name'];
    $nombrefisico = "".md5( uniqid( $_FILES['imagen']['name'] ) ).".".pathinfo($archivo, PATHINFO_EXTENSION)."";
    if (isset($archivo) && $archivo != "") {
        $tipo = $_FILES['imagen']['type'];
        $tamano = $_FILES['imagen']['size'];
        $temp = $_FILES['imagen']['tmp_name'];
        //lñistamos las extensiones por revisar a nivel servidor
        if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png") || strpos($tipo, "doc") || strpos($tipo, "docx") || strpos($tipo, "xls") || strpos($tipo, "xlsx") || strpos($tipo, "pdf")) && ($tamano < 2097152))) {
    echo '{"success": false, "message": "Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo."}';
        }
        else {
            if (move_uploaded_file($temp, '../../uploads/'.$nombrefisico)) {
                chmod('../../uploads/'.$nombrefisico, 0777);

include('../../includes/class/ImageResize.php');
$image = new \Gumlet\ImageResize('../../uploads/'.$nombrefisico.'');
$image->quality_jpg = 60;
$image->crop(100,100);
$image->save('../../uploads/thumbnails/'.$nombrefisico.'');

$data = array(
    'SECC_chFOTSEC' => "".$nombrefisico."",
  );
$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"');

    echo '{"success": true, "message": "Página guardado con éxitos."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }
    }
}else{

    echo '{"success": true, "message": "Página guardado con éxitos."}';
}

}else{
    echo '{"success": false, "message": "Error al grabar página, por favor intente nuevamente."}';
    }

}else{
    echo '{"success": false, "message": "Error al grabar página, <b>el nombre ya existe</b>."}';
}

}else{
    echo '{"success": false, "message": "Error: <b>Falta ingresar dato</b>, por favor intente de nuevo."}';
    }
}




if ($_GET["accion"]=="eliminar"){
    
// $sid = new Session; 

// $sid->start();
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{

    $db->delete('m_secc', 'WHERE SECC_P_inCODSEC="'.$id.'"');

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

$data = array('SECC_inESTSEC' => "".$estado."",);

$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$idcambiar.'"');

}

}

// /cambiar estado
if ($_GET["accion"]=="verEstados"){

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

$data = array('SECC_inESTSEC' => "".$estado."",);

$db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$idcambiar.'"');

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
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <!-- <td class="text-center"><?=$emp_dat["SECC_P_inCODSEC"]?></td> -->
    <td class="text-center"><?=$emp_dat["SECC_chTITSEC"]?></td>
    <td class="text-center">
      <button class="<?php if ($emp_dat["SECC_inESTSEC"]=='1'){echo"btn-success";} else if ($emp_dat["SECC_inESTSEC"]=='2'){echo"btn-danger";} else{echo"bg-secondary";} ?> btn-xs" onclick="CambiarEstado('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');"><i class="fa fa-recycle"></i> <?=estado($emp_dat["SECC_inESTSEC"])?></button>
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
                              <a class="dropdown-item"  onclick="papelera('paginas','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Papelera</a>
                            </div>
                          </div>
    </td>
</tr>
<?php }
}

//recuperamos noticia
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


?>
