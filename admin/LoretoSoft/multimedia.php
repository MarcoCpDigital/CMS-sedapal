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
  $_GET["accion"]!="paginador" and 
  $_GET["accion"]!="seleccionar"){
  header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>
<script type="text/javascript">
  paginador(1, 1, 1);
  paginador(1, 2, 1);
</script>
        <div class="row">
          <!-- Filtro -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-md-4 mb-0">
                          <select class="custom-select">
                            <option value="">Fecha por Mes</option>
                            <option value="">Junio 2020</option>
                            <option value="">Mayo 2020</option>
                            <option value="">Abril 2020</option>
                          </select>
                        </div>
                        <div class="form-group col-md-2 mb-0">
                          <button type="submit" class="btn btn-outline-primary btn-block">Filtrar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6">
                    <form>
                      <div class="form-row justify-content-end">
                        <div class="form-group col-md-6 mb-0">
                          <input type="text" class="form-control" placeholder="Buscar multimedia">
                        </div>
                        <div class="form-group col-md-2 mb-0">
                          <button type="submit" class="btn btn-outline-primary btn-block">Buscar</button>
                        </div>                    
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Contenido -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="float-left">
                <button title="Editar multimedia" onclick="modal_lg('<?=$rutaadmin?>multimedia/crear');" class="btn btn-primary float-left mb-0"><i class="fa fa-edit"></i> Agregar multimedia</button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">


    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-body">
<div role="tabpanel">
  <!-- Nav tabs -->
  <ul id="Select_archivo" class="nav nav-pills" role="tablist">
    <li class="nav-item" role="presentation" class="active">
      <a class="nav-link active" href="#imagenes" aria-controls="home" role="tab" data-toggle="tab">Imagenes</a></li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" href="#documentos" aria-controls="profile" role="tab" data-toggle="tab">Documentos</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="imagenes">

<div id="loader2" class="text-center"> <img src="<?=$rutaadmintheme?>dist/img/loading.gif"></div>
<!-- <div></d> -->

      <div class="row outer_div_img">

    </div>

    </div>

    <div role="tabpanel" class="tab-pane" id="documentos">
      <div class="row outer_div_doc">

</div> 

    </div>
  </div>


</div>
        </div>
      </div>      
    </div> 


                </div>
              </div>
            </div>
          </div>

        </div>
<?php }
if ($_GET["accion"]=="editar"){
$regusu = $db->select('*', 'm_mult', "
 where MULT_P_inCODNOT='".$id."'");
   while ($regusu_dat = $regusu->fetch_assoc()) {
?>
<script>
$("#formularioeditar").on('submit', function(e){
    var url = "<?=$rutaadmin?>multimedia/actualizar/<?=$id?>";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_enviar').html(' subiendo...');
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
        cargar("multimedia");
        $('#ModalSystem').modal('hide')
    }
  }
})
            }
        });
    });

</script>
<div class="row">
  <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Actualizar datos de multimedia</h4><br><hr>
                                <div class="clearfix"></div>
<script type="text/javascript">
   
</script>

<form method="post" id="formularioeditar" class="form-horizontal p-t-20" autocomplete="off" enctype="multipart/form-data">

<div class="form-group row">
  <div class="col-sm-6 imagen_preload float-left">
    <center>
        <span id="noimagen"></span>
        <?php if ($regusu_dat["MULT_chTIPARC"]=="doc" or $regusu_dat["MULT_chTIPARC"]=="docx" or $regusu_dat["MULT_chTIPARC"]=="xls" or $regusu_dat["MULT_chTIPARC"]=="xlsx" or $regusu_dat["MULT_chTIPARC"]=="pdf"){ ?>
          <br><b>Archivo no tiene pre-visualización<br> por no ser una imagen</b><br><br>
        <?php }else{ ?>
          <img id="imagen_src" src="<?=$regusu_dat["MULT_chURLMUL"]?>" alt="pre-visualización" class="img-responsive" style="width: 100%" />
        <?php } ?>
    </center>
  </div>
  <div class="col-sm-6 float-right">
    <div class="input-group">
      <label for="titulo" class="col-sm-12 ">Título <code>*</code></label>
        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título" value="<?=$regusu_dat["MULT_chTITMUL"]?>">
    </div><br>
    <div class="input-group">
      <label for="alternativo" class="col-sm-12 ">Texto alternativo</label>
        <input type="text" name="alternativo"  id="alternativo" class="form-control" placeholder="Texto alternativo" value="<?=$regusu_dat["MULT_chTXTALT"]?>">
    </div><br>
    <div class="input-group">
      <label for="descripcion" class="col-sm-12 ">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" value="<?=$regusu_dat["MULT_chDESMUL"]?>">
    </div><br>
    <div class="input-group">
      <label  class="col-sm-12 ">Formato/Peso</label>
        <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Tipo de archivo" readonly value="<?=$regusu_dat["MULT_chTIPARC"]?>">
        <input type="text" name="tamanio" id="tamanio" class="form-control" placeholder="Tamaño de archivo" readonly value="<?=$regusu_dat["MULT_chTAMARC"]?>">
    </div><br>
    <div class="input-group">
      <label  class="col-sm-12 ">Tamaño thumbnails (ancho/alto)</label>
        <?php if ($regusu_dat["MULT_chTIPARC"]=="doc" or $regusu_dat["MULT_chTIPARC"]=="docx" or $regusu_dat["MULT_chTIPARC"]=="xls" or $regusu_dat["MULT_chTIPARC"]=="xlsx" or $regusu_dat["MULT_chTIPARC"]=="pdf"){ ?>
        <input type="number" name="ancho" id="ancho" class="form-control" placeholder="Ancho thumbnails" pattern="([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])" value="<?=$regusu_dat["MULT_chANCIMA"]?>" readonly>
        <input type="number" name="alto" id="alto" class="form-control" placeholder="Alto thumbnails" pattern="([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])" value="<?=$regusu_dat["MULT_chALTIMA"]?>" readonly>
        <?php }else{ ?>
        <input type="number" name="ancho" id="ancho" class="form-control" placeholder="Ancho thumbnails" pattern="([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])" value="<?=$regusu_dat["MULT_chANCIMA"]?>">
        <input type="number" name="alto" id="alto" class="form-control" placeholder="Alto thumbnails" pattern="([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])" value="<?=$regusu_dat["MULT_chALTIMA"]?>">
        <?php } ?>

    </div><br>
    <div class="input-group">
      <label for="urlmultimedia" class="col-sm-12 ">URL de multimedia</label>
        <input type="text" id="urlmultimedia" class="form-control" placeholder="URL de multimedia" value="<?=$regusu_dat["MULT_chURLMUL"]?>">
    </div>
  </div>
</div>
    <div id="resultado"></div>
      <center><button type="submit" class="btn btn-info waves-effect waves-light" id="btn_enviar">Actualizar</button></center>
</form>
                                   
    </div>
  </div>

      </div>
    </div>
  </div>
</div>
<?php 
}
}
if ($_GET["accion"]=="actualizar"){


    $titulo = alfanumerico( $_POST['titulo'] );
    $alternativo = alfanumerico( $_POST['alternativo'] );
    $descripcion = alfanumerico( $_POST['descripcion'] );
    $tipo = alfanumerico( $_POST['tipo'] );
    $tamanio = alfanumerico( $_POST['tamanio'] );
if ($_POST['ancho']!=null) {
    $ancho = onlyNumbers( $_POST['ancho'] );
    $alto = onlyNumbers( $_POST['alto'] );
}else{
    $ancho = "200";
    $alto = "200";
}

if ($titulo != null){

$data = array(
    'MULT_chTITMUL' => "".$titulo."",
    'MULT_chTXTALT' => "".$descripcion."",
    'MULT_chDESMUL' => "".$descripcion."",
    'MULT_chTIPARC' => "".$tipo."",
    'MULT_chTAMARC' => "".$tamanio."",
    'MULT_dtFECSUB' => "".date("Y-m-d h:m:s")."",
);

if ($db->update('m_mult', $data, 'WHERE MULT_P_inCODNOT="'.$id.'"')) {


if ( $_FILES['imagen'] != null ) {
    echo $archivo = $_FILES['imagen']['name'];
    echo $nombrefisico = "".md5( uniqid( $_FILES['imagen']['name'] ) ).".".pathinfo($archivo, PATHINFO_EXTENSION)."";
    if (isset($archivo) && $archivo != "") {
        $tipo = $_FILES['imagen']['type'];
        $tamano = $_FILES['imagen']['size'];
        $temp = $_FILES['imagen']['tmp_name'];
        //lñistamos las extensiones por revisar a nivel servidor
if (!((strpos($tipo, "jpg") || 
  strpos($tipo, "jpeg") || 
  strpos($tipo, "png") || 
  strpos($tipo, "doc") || 
  strpos($tipo, "docx") || 
  strpos($tipo, "xls") || 
  strpos($tipo, "xlsx") || 
  strpos($tipo, "pdf")) && 
  ($tamano < 2097152))) {
    echo '{"success": false, "message": "Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo."}';
        }
        else {
            if (move_uploaded_file($temp, '../../uploads/'.$nombrefisico)) {
                chmod('../../uploads/'.$nombrefisico, 0777);

if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png")))) {
//creamos el thumbnails
include('../../includes/class/ImageResize.php');
$image = new \Gumlet\ImageResize('../../uploads/'.$nombrefisico.'');
$image->quality_jpg = 60;
if ($ancho=='') {$ancho=200;}
if ($alto=='') {$alto=200;}
$image->crop($ancho,$alto);
$image->save('../../uploads/thumbnails/'.$nombrefisico.'');

$data = array(
    'MULT_chNOMARC' => "".$nombrefisico."",
    'MULT_chURLMUL' => "".$ruta."uploads/".$nombrefisico."",
    'MULT_chANCIMA' => "".$ancho."",
    'MULT_chALTIMA' => "".$alto."",
  );
$db->update('m_mult', $data, 'WHERE MULT_P_inCODNOT="'.$id.'"');
}else{
  $data_doc = array(
    'MULT_chNOMARC' => "".$nombrefisico."",
    'MULT_chURLMUL' => "".$ruta."uploads/".$nombrefisico."",
  );
$db->update('m_mult', $data_doc, 'WHERE MULT_P_inCODNOT="'.$id.'"');

}

    echo '{"success": true, "message": "Se ha subido correctamente el archivo."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }
    }
}else{
    echo '{"success": true, "message": "Multimedia guardado con éxito"}';
}


}else{
    echo '{"success": false, "message": "Error al grabar multimedia, por favor intente nuevamente"}';
  }}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
  }
}


if ($_GET["accion"]=="crear"){?>
<script>
$("#formulariocrear").on('submit', function(e){
    var url = "<?=$rutaadmin?>multimedia/grabar";
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
console.log(data);
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
        cargar("multimedia");
        $('#ModalSystem').modal('hide')
    }
  }
})
            }
        });
    });
  manejoimg();

</script>
<div class="row">
  <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Subir multimedia</h4><br><hr>
                                <div class="clearfix"></div>
<form method="post" id="formulariocrear" class="form-horizontal p-t-20" autocomplete="off" enctype="multipart/form-data">

<div class="form-group row">
  <div class="col-sm-6 imagen_preload float-left">
    <center>
        <span id="noimagen"></span>
          <img id="imagen_src" src="" alt="pre-visualización" class="img-responsive" style="width: 100%" />
        <span class="btn btn-success btn-file" style="width: 100%">Click aqui para seleccionar archivo<input type="file" style="width: 100%" name="imagen" class="foto"></span>
    </center>
  </div>
  <div class="col-sm-6 float-right">
    <div class="input-group">
      <label for="titulo" class="col-sm-12 ">Título <code>*</code></label>
        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título" value="<?=$regusu_dat["MULT_chTITMUL"]?>">
    </div><br>
    <div class="input-group">
      <label for="alternativo" class="col-sm-12 ">Texto alternativo</label>
        <input type="text" name="alternativo"  id="alternativo" class="form-control" placeholder="Texto alternativo" value="<?=$regusu_dat["MULT_chTXTALT"]?>">
    </div><br>
    <div class="input-group">
      <label for="descripcion" class="col-sm-12 ">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" value="<?=$regusu_dat["MULT_chDESMUL"]?>">
    </div><br>
    <div class="input-group">
      <label  class="col-sm-12 ">Formato/Peso</label>
        <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Tipo de archivo" readonly value="<?=$regusu_dat["MULT_chTIPARC"]?>">
        <input type="text" name="tamanio" id="tamanio" class="form-control" placeholder="Tamaño de archivo" readonly value="<?=$regusu_dat["MULT_chTAMARC"]?>">
    </div><br>
    <div class="input-group">
      <label class="col-sm-12 ">Tamaño thumbnails (ancho/alto)</label>
        <input type="number" name="ancho" id="ancho" class="form-control" placeholder="Ancho thumbnails" pattern="([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])" value="<?=$regusu_dat["MULT_chANCIMA"]?>">
        <input type="number" name="alto" id="alto" class="form-control" placeholder="Alto thumbnails" pattern="([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])" value="<?=$regusu_dat["MULT_chALTIMA"]?>">
    </div>
  </div>
</div>
    <div id="resultado"></div>
      <center><button type="submit" class="btn btn-info waves-effect waves-light" id="btn_enviar">Subir</button></center>
</form>
                                   
    </div>
  </div>

      </div>
    </div>
  </div>
</div>
<?php }


if ($_GET["accion"]=="grabar"){

    $titulo = alfanumerico( $_POST['titulo'] );
    $alternativo = alfanumerico( $_POST['alternativo'] );
    $descripcion = alfanumerico( $_POST['descripcion'] );
    $tipo = alfanumerico( $_POST['tipo'] );
    $tamanio = alfanumerico( $_POST['tamanio'] );
if ($_POST['ancho']!=null) {
    $ancho = onlyNumbers( $_POST['ancho'] );
    $alto = onlyNumbers( $_POST['alto'] );
}else{
    $ancho = "200";
    $alto = "200";
}

if ($titulo != null){

$data = array(
    'MULT_chTITMUL' => "".$titulo."",
    'MULT_chTXTALT' => "".$descripcion."",
    'MULT_chDESMUL' => "".$descripcion."",
    'MULT_chTIPARC' => "".$tipo."",
    'MULT_chTAMARC' => "".$tamanio."",
    'MULT_dtFECSUB' => "".date("Y-m-d h:m:s")."",
);

if ($db->insert( 'm_mult', $data )) {

$ultimo_id=$db->insert_id;

if ( $_FILES['imagen'] != null ) {
    $archivo = $_FILES['imagen']['name'];
    $nombrefisico = "".md5( uniqid( $_FILES['imagen']['name'] ) ).".".pathinfo($archivo, PATHINFO_EXTENSION)."";
    $extarchivo = pathinfo($archivo, PATHINFO_EXTENSION);
    if (isset($archivo) && $archivo != "") {
        $tipo = $_FILES['imagen']['type'];
        $tipo2 = explode('/', $tipo);
        $tamano = $_FILES['imagen']['size'];
        $temp = $_FILES['imagen']['tmp_name'];
        //lñistamos las extensiones por revisar a nivel servidor
        if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png") || strpos($tipo, "doc") || strpos($tipo, "docx") || strpos($tipo, "xls") || strpos($tipo, "xlsx") || strpos($tipo, "pdf")) && ($tamano < 2097152))) {
    echo '{"success": false, "message": "Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo."}';
        }
        else {
            if (move_uploaded_file($temp, '../../uploads/'.$nombrefisico)) {
                chmod('../../uploads/'.$nombrefisico, 0777);

if ($extarchivo=="jpg" or $extarchivo=="jpeg" or $extarchivo=="png") {
//creamos el thumbnails
include('../../includes/class/ImageResize.php');
$image = new \Gumlet\ImageResize('../../uploads/'.$nombrefisico.'');
$image->quality_jpg = 60;
  $image->crop($ancho,$alto);
$image->save('../../uploads/thumbnails/'.$nombrefisico.'');

$data22 = array(
    'MULT_chNOMARC' => "".$nombrefisico."",
    'MULT_chURLMUL' => "".$ruta."uploads/".$nombrefisico."",
    'MULT_chANCIMA' => "".$ancho."",
    'MULT_chALTIMA' => "".$alto."",
  );
$db->update('m_mult', $data22, 'WHERE MULT_P_inCODNOT="'.$ultimo_id.'"');

}else{

$data22 = array(
    'MULT_chNOMARC' => "".$nombrefisico."",
    'MULT_chURLMUL' => "".$ruta."uploads/".$nombrefisico."",
  );
$db->update('m_mult', $data22, 'WHERE MULT_P_inCODNOT="'.$ultimo_id.'"');

}


    echo '{"success": true, "message": "Se ha subido correctamente el archivo."}';

            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }
    }
}else{
    echo '{"success": true, "message": "Multimedia guardado con éxito"}';
}


}else{
    echo '{"success": false, "message": "Error al grabar multimedia, por favor intente nuevamente"}';
  }}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
  }
}

if ($_GET["accion"]=="eliminar"){
   $id_pro_ext= onlyNumbers($_POST["id_pro_ext"]);
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{

$folder_name = '../../uploads/';

$pro = $db->select('*', 'm_mult', "WHERE MULT_P_inCODNOT='".$id_pro_ext."'");

 while ($pro_dat = $pro->fetch_assoc()) {


 $filename = $folder_name.$pro_dat["MULT_chNOMARC"];
 unlink($filename);
 unlink('../../uploads/thumbnails/'.$pro_dat["MULT_chNOMARC"].'');

    $db->delete('m_mult', 'WHERE MULT_P_inCODNOT="'.$id_pro_ext.'"');
 }
}
  }


// /seleccionar imagen desde noticias

if ($_GET["accion"]=="seleccionar"){?>
    <div class="col-sm-12">
      <div class="panel panel-default">
               <!-- <div class="card-header">
                <div class="float-left">
                <button title="Editar multimedia" onclick="modal_lg('<?=$rutaadmin?>multimedia/crear');" class="btn btn-primary float-left mb-0"><i class="fa fa-edit"></i> Agregar nueva imagen multimedia</button>
                </div>
              </div> -->
        <div class="panel-body">

<div role="tabpanel">
  <!-- Nav tabs -->
   <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="imagenes">
      <div class="row">
<?php
  $imagenes = $db->select('*', 'm_mult', "where MULT_chTIPARC='jpg' or MULT_chTIPARC='jpeg' or MULT_chTIPARC='png' order by MULT_P_inCODNOT desc");
  while ($imagenes_dat = $imagenes->fetch_assoc()) {
?>
      <div class="col-md-3 float-left">
        <div class=" image">
          <a class="sedapal-multimedia-item archivo2" style="background-image: url(<?=$ruta?>uploads/thumbnails/<?=$imagenes_dat["MULT_chNOMARC"]?>) " onclick="seleccionar('multimedia','<?=$imagenes_dat["MULT_P_inCODNOT"]?>');">
            <span><?=$imagenes_dat["MULT_chTITMUL"]?></span>
          </a>
        </div>
      <div class="hover">
        <button class="btn-danger btn-xs" onclick="eliminar('multimedia','<?=$imagenes_dat["MULT_P_inCODNOT"]?>');" ><i class="fa fa-trash"></i></button>
        <button class="btn-success btn-xs urlimg_<?=$imagenes_dat["MULT_P_inCODNOT"]?>" title="Seleccionar" onclick="seleccionar('multimedia','<?=$imagenes_dat["MULT_P_inCODNOT"]?>');"  url="<?=$imagenes_dat["MULT_chNOMARC"]?>"><i class="fa fa-check"></i></button>
      </div>
      </div>
<?php } ?>
    </div>
    </div>
  </div>


</div>
        </div>
      </div>      
    </div> 

<?php }

// /seleccionar imagen desde noticias
if ($_GET["accion"]=="paginador"){?>
<div class="col-md-12">
<?php
  $tipodoc = onlyNumbers($_GET['id']);
  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
  if($action == 'ajax'){
    //las variables de paginación
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 18; //la cantidad de registros que desea mostrar
    $adjacents  = 3; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;
    //Cuenta el número total de filas de la tabla*/
    if ($tipodoc==1) {
  $count_query   = $db->select('count(*) AS numrows', 'm_mult', "where MULT_chTIPARC='jpg' or MULT_chTIPARC='jpeg' or MULT_chTIPARC='png' order by MULT_P_inCODNOT desc"); 
    }
    if ($tipodoc==2) {
  $count_query   = $db->select('count(*) AS numrows', 'm_mult', "where MULT_chTIPARC='doc' or MULT_chTIPARC='docx' or MULT_chTIPARC='xls' or MULT_chTIPARC='xlsx' or MULT_chTIPARC='pdf' order by MULT_P_inCODNOT desc"); 
    }
    

    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);
    //consulta principal para recuperar los datos
    if ($tipodoc==1) {
    $query = $db->select('*', 'm_mult', "where MULT_chTIPARC='jpg' or MULT_chTIPARC='jpeg' or MULT_chTIPARC='png' order by MULT_P_inCODNOT desc LIMIT $offset,$per_page");
    }
    if ($tipodoc==2) {
    $query = $db->select('*', 'm_mult', "where MULT_chTIPARC='doc' or MULT_chTIPARC='docx' or MULT_chTIPARC='xls' or MULT_chTIPARC='xlsx' or MULT_chTIPARC='pdf' order by MULT_P_inCODNOT desc LIMIT $offset,$per_page");
    }

    if ($numrows>0){
      while($imagenes_dat = mysqli_fetch_array($query)){
        if ($tipodoc==1) {
?>
      <div class="col-md-2 float-left">
        <div class=" image">
          <a href="#" class="sedapal-multimedia-item archivo2" style="background-image: url(<?=$ruta?>uploads/thumbnails/<?=$imagenes_dat["MULT_chNOMARC"]?>) " onclick="modal_lg('<?=$rutaadmin?>multimedia/editar/<?=$imagenes_dat["MULT_P_inCODNOT"]?>');">
            <span><?=$imagenes_dat["MULT_chTITMUL"]?></span>
          </a>
        </div>
      <div class="hover"><button class="btn-danger btn-xs" onclick="eliminar('multimedia','<?=$imagenes_dat["MULT_P_inCODNOT"]?>');" ><i class="fa fa-trash"></i></button></div>
      </div>
    <?php }
     
        if ($tipodoc==2) {
?>
      <div class="col-md-2 float-left">
        <div class=" image">
          <a href="#" class="sedapal-multimedia-item archivo" onclick="modal_lg('<?=$rutaadmin?>multimedia/editar/<?=$imagenes_dat["MULT_P_inCODNOT"]?>');">
            <span><?=$imagenes_dat["MULT_chTITMUL"]?></span>
          </a>
        </div>
      <div class="hover"><button class="btn-danger btn-xs" onclick="eliminar('multimedia','<?=$imagenes_dat["MULT_P_inCODNOT"]?>');" ><i class="fa fa-trash"></i></button></div>
      </div>
    <?php }
     ?>
        <?php
      }
      ?>
      </div>
    <!-- <div class="table-pagination pull-right">
    </div> -->
    <!-- <div style="clear: both"></div> -->
    <div class="col-sm-12"> 
      <?php echo paginate($reload, $page, $total_pages, $adjacents, $tipodoc);?>
    </div>
      <?php
      
    } else {
      ?>
      <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No existe multimedia todavía.
            </div>
      <?php
    }

 }
 } 
 ?>