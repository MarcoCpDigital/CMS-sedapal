<?php
require_once 'check.php';
$accion=letras($_GET["accion"]);
$id=onlyNumbers($_GET["id"]);

if ($_GET["accion"]!="crear" and $_GET["accion"]!="grabar" and $_GET["accion"]!="editar" and $_GET["accion"]!="actualizar" and $_GET["accion"]!="cargar" and $_GET["accion"]!="eliminar" and $_GET["accion"]!="multimedia" and $_GET["accion"]!="grabarmultimedia" and $_GET["accion"]!="crearmultimedia"){
    header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>
<script>
 $("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>agregar_noticia/grabar";
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
        cargar("noticias");
        $('#ModalSystem').modal('hide')
    }
  }
})
            }
        });
    });
  esconderimg();
    $("#foto").change(function(){
        readURL(this);
    });
</script>
<form method="post" id="formulario" class="form-horizontal row" autocomplete="off" enctype="multipart/form-data">
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
                <textarea class="textarea" placeholder="Escriba aquí"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="contenido"></textarea>
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
                    <label for="email" class="col-sm-3 control-label">Estado</label><br>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="switch">
                                <label>Borrador<input type="checkbox" name="estado" <?php if ($regusu_dat["USUA_inESTUSU"] == '1'){      echo "checked";}?>><span class="lever"></span>Publicado</label>
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
                    <div class="sedapal-imagen-destacada-elegida mb-1"></div>
                            <span class="btn btn-success btn-file" style="width: 100%">Click aqui para seleccionar archivo<input type="file" style="width: 100%" name="imagen" id="foto"></span>

<a class="btn btn-outline-primary btn-block"  onclick="modal_lg('<?=$rutaadmin?>agregar_noticia/multimedia');">Seleccionar imagen</a>
                    <a class="btn btn-outline-primary btn-block"  onclick="modal_lg('<?=$rutaadmin?>agregar_noticia/crearmultimedia');">Subir Imagen</a>
                  </div>
                </div>
                <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control select2" style="width: 100%; min-height: 100px!important" name="categoria">
<?php
$cat = $db->select('*', 's_cate', "where CATE_inESTCAT='1'");
while ($cat_dat = $cat->fetch_assoc()) {
?>
    <option value="<?=$cat_dat["CATE_P_inCODCAT"]?>"><?=$cat_dat["CATE_chTITCAT"]?></option>
<?php } ?>
                  </select>                  
                </div>
                <div class="form-group">
                  <label>Etiquetas</label>
                  <select class="form-control select2-multiple" style="width: 100%;" name="etiquetas[]" multiple="multiple">
<?php
$eti = $db->select('*', 's_etiq', "where ETIQ_inESTETI='1'");
while ($eti_dat = $eti->fetch_assoc()) {
?>
    <option value="<?=$eti_dat["ETIQ_chTITETI"]?>"><?=$eti_dat["ETIQ_chTITETI"]?></option>
<?php } ?>
                  </select>                  
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
    $('.select2-multiple').select2({
  tags: true,
    tokenSeparators: [',']
});
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
  });
    esconderimg();
    $("#foto").change(function(){
        readURL(this);
    });
</script>
<?php }
if ($_GET["accion"]=="editar"){
$regusu = $db->select('*', 'm_secc', "
    where SECC_P_inCODSEC='".$id."'");
        while ($regusu_dat = $regusu->fetch_assoc()) {
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
            <h1 class="m-0 text-dark"><?=primera(invertir($pagina))?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$ruta?>">Escritorio</a></li>
              <li class="breadcrumb-item active"><a><?=primera(invertir($pagina))?></a></li>
            </ol>
          </div><!-- /.col -->       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

<script>
    $("#btn_enviar").click(function(){
    var url = "<?=$rutaadmin?>agregar_noticia/actualizar/<?=$id?>";
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formulario").serialize(),
           beforeSend: function(objeto){
            $('#btn_enviar').html('Grabando...');
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
            cargar("noticias");
           }
         });
    return false;
 });
</script>

<form method="post" id="formulario" class=" row" autocomplete="off">
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
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="switch">
                                <label>Borrador<input type="checkbox" name="estado" <?php if ($regusu_dat["SECC_inESTSEC"] == '1'){echo "checked";}?>><span class="lever"></span>Publicado</label>
                            </div>
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
                <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control select2" style="width: 100%;" name="categoria">
<?php
$cat = $db->select('*', 's_cate', "where CATE_inESTCAT='1'");
while ($cat_dat = $cat->fetch_assoc()) {
?>
    <option value="<?=$cat_dat["CATE_P_inCODCAT"]?>" <?php if ($cat_dat["CATE_P_inCODCAT"]==$regusu_dat["CATE_F_inCODCAT"]) {echo "selected";} ?>><?=$cat_dat["CATE_chTITCAT"]?></option>
<?php } ?>
                  </select>                  
                </div>
                <div class="form-group">
                  <label>Etiquetas</label>
                  <select class="form-control select2-multiple" style="width: 100%;" name="etiquetas[]" multiple="multiple">
<?php
$eti = $db->select('*', 'v_etiq_noti ven', "
    INNER JOIN m_secc ms ON ms.SECC_P_inCODSEC=ven.SECC_F_inCODSEC
    INNER JOIN s_etiq se ON se.ETIQ_P_inCODETI=ven.ETIQ_F_inCODETI
    where ven.SECC_F_inCODSEC='".$regusu_dat["SECC_P_inCODSEC"]."'");
while ($eti_dat = $eti->fetch_assoc()) {
?>
    <option value="<?=$eti_dat["ETIQ_P_inCODETI"]?>" selected ><?=$eti_dat["ETIQ_chTITETI"]?></option>
<?php } ?>
<?php
$eti2 = $db->select('*', 's_etiq', "");
while ($eti_dat2 = $eti2->fetch_assoc()) {
?>
    <option value="<?=$eti_dat2["ETIQ_P_inCODETI"]?>"><?=$eti_dat2["ETIQ_chTITETI"]?></option>
<?php } ?>
                  </select>                  
                </div>
                <div id="resultado"></div>
                <div class="form-group">
                  <button type="button" class="btn btn-primary float-right" id="btn_enviar">Publicar</button>
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
      // date: moment(),
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

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<?php }}

if ($_GET["accion"]=="grabar"){

        $titulo = alfanumerico( $_POST['titulo'] );
        $extracto = alfanumerico( $_POST['extracto'] );
        $estado1 = alfanumerico( $_POST['estado'] );
        $contenido = textos( $_POST['contenido'] );
        $publicacion = textos( $_POST['publicacion'] );
        $caducidad =  $_POST['caducidad'] ;
        $categoria = onlyNumbers( $_POST['categoria'] );
        $etiquetas = $_POST['etiquetas'];

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if ($titulo != null and $publicacion != null and $categoria != null){

if ($caducidad!="") {
$data = array(
    'SECC_chTITSEC' => "".$titulo."",
    'SECC_txDETSEC' => "".$extracto."",
    'SECC_txCONSEC' => "".$contenido."",
    'SECC_txURLSEC' => "".limpiar($titulo)."",
    'SECC_chEXTID' => "".hash_id()."",
    'SECC_chSECCAT' => "1",
    'CATE_F_inCODCAT' => "".$categoria."",
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
    'SECC_chSECCAT' => "1",
    'CATE_F_inCODCAT' => "".$categoria."",
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

// if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png"))) && ($alto!="") ||  ($ancho!="")) {
// if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png")))) {
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
// }else{
//   $data = array(
//     'SECC_chFOTSEC' => "".$nombrefisico."",
//   );
// $db->update('m_secc', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"');

// }


//revisamos etiquetas

  for ($i=0;$i<count($etiquetas);$i++)    
{

$emp = $db->select('*', 's_etiq', "where ETIQ_chTITETI='".$etiquetas[$i]."'");

//si la etiqueta no existe la grabamos
if ($emp->num_rows=='0') {
$data22 = array(
    'ETIQ_chTITETI' => "".$etiquetas[$i]."",
);
    // si es que se guarda correctamente samos id para transaccional
    if ($db->insert( 's_etiq', $data22 )) {
      $data_eti = array(
          'SECC_F_inCODSEC' => "".$ultimo_id."",
          'ETIQ_F_inCODETI' => "".$db->insert_id."",
          );
      $db->insert( 'v_etiq_noti', $data_eti );

    }
}else{
//si ya se encuentra en la bd, extraemos su id para poder insertar en la transaccional
$veretiq = $db->select('*', 's_etiq', "where ETIQ_chTITETI='".$etiquetas[$i]."'");
        while ($veretiq_dat = $veretiq->fetch_assoc()) {
    $data2 = array(
      'SECC_F_inCODSEC' => "".$ultimo_id."",
      'ETIQ_F_inCODETI' => "".$veretiq_dat["ETIQ_P_inCODETI"]."",
      );
    $db->insert( 'v_etiq_noti', $data2 );
}

}

}
//termina revision de etiquetas

    echo '{"success": true, "message": "Se ha subido correctamente el archivo."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }
    }
}else{

//revisamos etiquetas

  for ($i=0;$i<count($etiquetas);$i++)    
{

$emp = $db->select('*', 's_etiq', "where ETIQ_chTITETI='".$etiquetas[$i]."'");

//si la etiqueta no existe la grabamos
if ($emp->num_rows=='0') {
$data22 = array(
    'ETIQ_chTITETI' => "".$etiquetas[$i]."",
);
    // si es que se guarda correctamente samos id para transaccional
    if ($db->insert( 's_etiq', $data22 )) {
      $data_eti = array(
          'SECC_F_inCODSEC' => "".$ultimo_id."",
          'ETIQ_F_inCODETI' => "".$db->insert_id."",
          );
      $db->insert( 'v_etiq_noti', $data_eti );

    }
}else{
//si ya se encuentra en la bd, extraemos su id para poder insertar en la transaccional
$veretiq = $db->select('*', 's_etiq', "where ETIQ_chTITETI='".$etiquetas[$i]."'");
        while ($veretiq_dat = $veretiq->fetch_assoc()) {
    $data2 = array(
      'SECC_F_inCODSEC' => "".$ultimo_id."",
      'ETIQ_F_inCODETI' => "".$veretiq_dat["ETIQ_P_inCODETI"]."",
      );
    $db->insert( 'v_etiq_noti', $data2 );
}

}

}
//termina revision de etiquetas


    echo '{"success": true, "message": "Noticia guardado con éxitos."}';
}

}else{
    echo '{"success": false, "message": "Error al grabar noticia, por favor intente nuevamente."}';
    }

}else{
    echo '{"success": false, "message": "Error al grabar noticia, el nombre ya existe."}';
}

}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
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

if ($_GET["accion"]=="multimedia"){?>
   
        <div class="row">
          <!-- Filtro -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <select class="custom-select">
                            <option value="">Fecha por Mes</option>
                            <option value="">Junio 2020</option>
                            <option value="">Mayo 2020</option>
                            <option value="">Abril 2020</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <button type="submit" class="btn btn-outline-primary btn-block">Filtrar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6">
                    <form>
                      <div class="form-row sjustify-content-end">
                        <div class="form-group col-md-6">
                          <input type="text" class="form-control" placeholder="Buscar multimedia">
                        </div>
                        <div class="form-group col-md-6">
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
              <!-- <div class="card-header">
                <div class="float-left">
                <button title="Editar Item" onclick="modal_lg('<?=$rutaadmin?>agregar_noticia/crearmultimedia');" class="btn btn-primary float-left mb-0"><i class="fa fa-edit"></i> Agregar nuevo Item</button>
                </div>
              </div> -->
              <div class="card-body">
                <div class="row">


    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-body">
<div role="tabpanel">
 
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="imagenes">
      <div class="row">
<?php
  $imagenes = $db->select('*', 'm_mult', "where MULT_chTIPARC='jpg' or MULT_chTIPARC='jpeg' or MULT_chTIPARC='png' order by MULT_P_inCODNOT desc");
  while ($imagenes_dat = $imagenes->fetch_assoc()) {
?>
      <div class="col-md-2 float-left">
        <div class=" image">
          <a href="#" class="sedapal-multimedia-item archivo2" style="background-image: url(<?=$ruta?>uploads/thumbnails/<?=$imagenes_dat["MULT_chNOMARC"]?>) " onclick="modal_lg('<?=$rutaadmin?>agregar_noticia/editar/<?=$imagenes_dat["MULT_P_inCODNOT"]?>');">
            <span><?=$imagenes_dat["MULT_chTITMUL"]?></span>
          </a>
        </div>
      <div class="hover"><button class="btn-danger btn-xs" onclick="eliminar('multimedia','<?=$imagenes_dat["MULT_P_inCODNOT"]?>');" ><i class="fa fa-trash"></i></button></div>
      </div>
<?php } ?>
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

//form crear multimedia desde noticia
if ($_GET["accion"]=="crearmultimedia"){?>
<script>
$("#formulario").on('submit', function(e){
    var url = "<?=$rutaadmin?>agregar_noticia/grabarmultimedia";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_enviar').html('subiendo...');
            $('#btn_enviar').attr("disabled", true);
            },
            success: function(data){

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
        cargar("noticias");
        $('#ModalSystem').modal('hide')
    }
  }
})
            }
        });
    });
  esconderimg();
    $("#foto").change(function(){
        readURL(this);
    });
</script>
 
<script type="text/javascript">
  
//convertir unidades de byte
function formatSizeUnits(bytes){
  if      (bytes >= 1073741824) { bytes = (bytes / 1073741824).toFixed(2) + " GB"; }
  else if (bytes >= 1048576)    { bytes = (bytes / 1048576).toFixed(2) + " MB"; }
  else if (bytes >= 1024)       { bytes = (bytes / 1024).toFixed(2) + " KB"; }
  else if (bytes > 1)           { bytes = bytes + " bytes"; }
  else if (bytes == 1)          { bytes = bytes + " byte"; }
  else                          { bytes = "0 bytes"; }
  return bytes;
}

//validaciones archivos

    function readURL(input) {

var fileTypes = ['jpg', 'jpeg', 'png', 'doc', 'docx', 'xls', 'xlsx', 'pdf']; 
var fileTypesIMG = ['jpg', 'jpeg', 'png']; 

if (input.files && input.files[0]) {
        var extension = input.files[0].name.split('.').pop().toLowerCase(),  //la xtension del archivo
            isSuccess = fileTypes.indexOf(extension) > -1;  //extensiones permitidas
            isIMG = fileTypesIMG.indexOf(extension) > -1;  //extensiones permitidas
        if (isSuccess ) { //si todo correcto
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagen_src').attr('src', e.target.result);
                $('#tipo').val(extension);
                $('#tipo').css("background-color", "lightgray");
                $('#tipo').css("color", "black");  
                $('#btn_enviar').attr("disabled", false);
                if (isIMG) {
                  $('#imagen_src').show();
                  $('#noimagen').hide();
                    if (input.files[0].size>2097152) {
                      $('#tamanio').css("background-color", "red");
                      $('#tamanio').css("color", "white");  
                      $('#tamanio').val(""+formatSizeUnits(input.files[0].size)+"");
                      $('#btn_enviar').attr("disabled", true);
                      $('#noimagen').hide();
                      $('#imagen_src').val("");
                    }else{
                      $('#tamanio').val(""+formatSizeUnits(input.files[0].size)+"");
                      $('#tamanio').css("background-color", "lightgray");
                      $('#tamanio').css("color", "black");  
                    }

                }else{
                  $('#noimagen').show();
                  $('#noimagen').html("<br><b>Archivo no tiene pre-visualización<br> por no ser una imagen</b><br><br>");
                  $('#imagen_src').hide();
                  $('#alto').attr("readonly", true);
                  $('#ancho').attr("readonly", true);

                    if (input.files[0].size>2097152) {
                      $('#tamanio').css("background-color", "red");
                      $('#tamanio').css("color", "white");  
                      $('#tamanio').val(""+formatSizeUnits(input.files[0].size)+"");
                      $('#btn_enviar').attr("disabled", true);
                      $('#noimagen').hide();
                      $('#imagen_src').val("");
                    }else{
                      $('#tamanio').val(""+formatSizeUnits(input.files[0].size)+"");
                      $('#tamanio').css("background-color", "lightgray");
                      $('#tamanio').css("color", "black");  
                    }

                }
            }
            reader.readAsDataURL(input.files[0]);
        }
        else { //si no es aceptada
            $('#imagen_src').hide();
            $('#tipo').css("background-color", "red");
            $('#tipo').css("color", "white");
            $('#foto').val("");
            $('#btn_enviar').attr("disabled", true);
            $('#tipo').val(""+extension+" - NO permitido");
            $('#noimagen').hide();
            $('#tamanio').val("");
            $('#tamanio').css("background-color", "lightgray");
            $('#tamanio').css("color", "black");  

        }
    }

    }
</script>
<div class="row">
  <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Subir multimedia</h4><br><hr>
                                <div class="clearfix"></div>
<script type="text/javascript">
$(document).ready(function() {
    if ($('#imagen_src').attr('src')=='') {//escondemos cuando no hay imagen
      $('#imagen_src').hide();
alert("sdsd");
    }
    $("#foto").change(function(){
        readURL(this);
    });

});
</script>

<form method="post" id="formulario" class="form-horizontal p-t-20" autocomplete="off" enctype="multipart/form-data">

<div class="form-group row">
  <div class="col-sm-6 imagen_preload">
    <center>
        <span id="noimagen"></span>
          <img id="imagen_src" src="" alt="pre-visualización" class="img-responsive" style="width: 100%" />
        <span class="btn btn-success btn-file" style="width: 100%">Click aqui para seleccionar archivo<input type="file" style="width: 100%" name="imagen" id="foto"></span>
    </center>
  </div>
  <div class="col-sm-6">
    <div class="input-group">
        <input type="text" name="titulo" class="form-control" placeholder="Título">
    </div><br>
    <div class="input-group">
        <input type="text" name="alternativo" class="form-control" placeholder="Texto alternativo">
    </div><br>
    <div class="input-group">
        <input type="text" name="descripcion" class="form-control" placeholder="Descripción">
    </div><br>
    <div class="input-group">
        <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Tipo de archivo" readonly>
        <input type="text" name="tamanio" id="tamanio" class="form-control" placeholder="Tamaño de archivo" readonly>
    </div><br>
    <div class="input-group">
        <input type="number" name="ancho" id="ancho" class="form-control" placeholder="Ancho thumbnails" pattern="([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])">
        <input type="number" name="alto" id="alto" class="form-control" placeholder="Alto thumbnails" pattern="([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])">
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


if ($_GET["accion"]=="grabarmultimedia"){

    $titulo = alfanumerico( $_POST['titulo'] );
    $alternativo = alfanumerico( $_POST['alternativo'] );
    $descripcion = alfanumerico( $_POST['descripcion'] );
    $tipo = alfanumerico( $_POST['tipo'] );
    $tamanio = alfanumerico( $_POST['tamanio'] );
    $ancho = alfanumerico( $_POST['ancho'] );
    $alto = alfanumerico( $_POST['alto'] );

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

if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png"))) && ($alto!="") ||  ($ancho!="")) {
//creamos el thumbnails
include('../../includes/class/ImageResize.php');
$image = new \Gumlet\ImageResize('../../uploads/'.$nombrefisico.'');
$image->quality_jpg = 60;
$image->crop($ancho,$alto);
$image->save('../../uploads/thumbnails/'.$nombrefisico.'');

$data = array(
    'MULT_chNOMARC' => "".$nombrefisico."",
    'MULT_chURLMUL' => "".$ruta."uploads/".$nombrefisico."",
    'MULT_chANCIMA' => "".$ancho."",
    'MULT_chALTIMA' => "".$alto."",
  );
$db->update('m_mult', $data, 'WHERE MULT_P_inCODNOT="'.$ultimo_id.'"');
}else{
  $data = array(
    'MULT_chNOMARC' => "".$nombrefisico."",
    'MULT_chURLMUL' => "".$ruta."uploads/".$nombrefisico."",
  );
$db->update('m_mult', $data, 'WHERE MULT_P_inCODNOT="'.$ultimo_id.'"');

}

    echo '{"success": true, "message": "Se ha subido correctamente el archivo."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }
    }
}else{
    echo '{"success": true, "message": "Noticia guardado con éxito"}';
}


}else{
    echo '{"success": false, "message": "Error al grabar noticia, por favor intente nuevamente"}';
  }}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
  }
}?>