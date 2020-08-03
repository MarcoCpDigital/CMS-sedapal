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
  $_GET["accion"]!="crearmultimedia"){
	header("Location: ".$rutaadmin."error/");
} 
if ($_GET["accion"]=="cargar"){?>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-2 mb-0">
                      <select class="custom-select">
                        <option value="">Filtrar por categoría</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6 mb-0">
                      <input type="text" class="form-control" placeholder="¿Que formulario buscas?">
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
                </form>
              </div>
            </div>
          </div>

    <div class="col-12">
      <div class="card">
              <div class="card-header">
<a title="Crear formulario" href="<?=$rutaadmin?>formularios/crear" class="btn btn-primary float-left mb-0"><i class="fa fa-edit"></i> Agregar nueva formulario</a>
<!-- <a class="btn btn-outline-primary float-left mb-0 ml-2" id="btn_eliminados" onclick="verEstados('formularios','3');" role="button">Eliminados</a> -->
<!-- <a class="btn btn-outline-primary float-left mb-0 ml-2 d-none" id="btn_publicados" onclick="verEstados('formularios','1');" role="button">Publicados</a> -->
              </div>
              <div class="card-body">
                <div class="table-responsive">
          <table id="tbPrincipal" class="display nowrap responsive table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">descripcion</th>
                        <th class="text-center">Fecha de creación</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                                        </thead>
        <tfoot>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">descripcion</th>
                        <th class="text-center">Fecha de creación</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Acciones</th>
                      </tr>
        </tfoot>
                                        <tbody id="filtro_estado">
<?php
$emp = $db->select('*', 'm_form ms', "
INNER JOIN m_usua mu ON mu.USUA_P_inCODUSU=ms.USUA_F_inCODUSU");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$emp_dat["FORM_P_inCODFOR"]?></td>
    <td class="text-center"><?=$emp_dat["FORM_chTITFOR"]?></td>
    <td class="text-center"><?=$emp_dat["FORM_chDESFOR"]?></td>
    <td class="text-center"><?=$emp_dat["FORM_dtFECCAD"]?></td>
    <td class="text-center"><?=$emp_dat["USUA_chNOMUSU"]?></td>
    <td class="text-center">
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-align-justify"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item"  href="<?=$rutaadmin?>formularios/editar/<?=$emp_dat["SECC_P_inCODSEC"]?>">Editar</a>
                              <a class="dropdown-item"  onclick="papelera('formularios','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a>
                              <!-- <a class="dropdown-item"  onclick="eliminar('formularios','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a> -->
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
            <h1 class="m-0 text-dark">Crear nueva formulario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$ruta?>">Escritorio</a></li>
              <li class="breadcrumb-item active"><a>formularios</a></li>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control form-control-lg" type="text" placeholder="Agregar título" name="titulo" id="titulo">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Agregar extracto" name="extracto" id="extracto">
                </div>

  <div id="fb-editor"></div>

                <!-- <textarea class="textarea" id="editor1" placeholder="Escriba aquí"
  style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="contenido"></textarea> -->

                <div class="form-group">
                  <button type="submit" class="btn btn-primary float-right" id="btn_enviar">Publicar</button>
                </div>

              </div>
            </div>
          </div>
          <!-- <div class="col-md-4">
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
                                <label>Borrador<input type="checkbox" name="estado" <?php if ($secc_item["SECC_inESTSEC"] == '1'){      echo "checked";}?>><span class="lever"></span>Publicado</label>
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
            </div> -->
          </div>
        </form>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
   
    <!-- /.content -->


<?php 
include "includes/footer.php"; ?>
<script>
  jQuery(function($) {
  var fbEditor = document.getElementById('build-wrap');

  var options = {
    disabledActionButtons: ['data','save','clear'],
      i18n: {
        locale: 'es-ES'
      }
    },
    $fbTemplate = $(document.getElementById('fb-editor'));
  $fbTemplate.formBuilder(options);
  
  var formBuilder = $(fbEditor).formBuilder();


  document.getElementById('btn_enviar').addEventListener('click', function() {

    // alert($("#extracto").val());
    // return false;

    var url = "<?=$rutaadmin?>formularios/grabar";
    var titulo =  $("#titulo").val();
    var extracto =  $("#extracto").val();
        // e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: "datajson="+formBuilder.actions.getData('json')+"&titulo="+titulo+"&extracto="+extracto+"",
            // contentType: false,
            // cache: false,
            // processData:false,
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
        cargar("formularios");
    }
  }
})
            }
        });

    // alert();
  });


});


 // $("#formulariocrear").on('submit', function(e){
 //    });
manejoimg();
</script>
  <script>
//   $(document).ready(function() {
//     //Initialize Select2 Elements
//     $('.select2').select2();
//     $('.select2-multiple').select2({
//   tags: true,
//     tokenSeparators: [',']
// });
    // // Summernote
    // $('.textarea').summernote({
    //   height: 350,
    //   placeholder: 'Escribe el contenido aquí',
    // })
// editor();
    // Datapicker
    // $('#fecha-publicacion').datetimepicker({
    //   sideBySide: true,
    //   format: 'YYYY-MM-DD HH:mm',
    //   date: moment(),
    // });
  //   $('#fecha-caducidad').datetimepicker({
  //     sideBySide: true,
  //     format: 'YYYY-MM-DD HH:mm',
  //     minDate: moment(),
  //   });
  //   $('#fecha-publicacion').on('change.datetimepicker', function() {
  //       var new_min_date = $(this).datetimepicker('date');
  //       $("#fecha-caducidad").datetimepicker('minDate', new_min_date);
  //   });
  // });

</script>
<?php } 

//grabamos item

if ($_GET["accion"]=="grabar"){

        $titulo = alfanumerico( $_POST['titulo'] );
        $extracto = alfanumerico( $_POST['extracto'] );
        // $estado1 = alfanumerico( $_POST['estado'] );
        $datajson = textos( $_POST['datajson'] );
        // $publicacion = textos( $_POST['publicacion'] );
        // $caducidad =  $_POST['caducidad'] ;

// if (isset($estado1) && $estado1 == 'on'){
//       $estado="1";}
//    else{
//       $estado="2";}

if ($titulo != null ){


$data = array(
    'FORM_chTITFOR' => "".$titulo."",
    'FORM_chDESFOR' => "".$extracto."",
    'FORM_txJSOFOR' => "".$datajson."",
    'FORM_dtFECCAD' => "".date("Y-m-d h:m:s")."",
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
);


//intentamos ingresar en la bd los datos
if ($db->insert( 'm_form', $data )) {
  //grabamos el ultimo id ingresado a la db para posterior uso

    echo '{"success": true, "message": "Ingresado correctamente"}';

//si falla el grabado de item
}else{
    echo '{"success": false, "message": "Error al grabar formulario, por favor intente nuevamente."}';
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
    $db->delete('m_form', 'WHERE SECC_P_inCODSEC="'.$id.'"');
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

$db->update('m_form', $data, 'WHERE SECC_P_inCODSEC="'.$idcambiar.'"');

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

$db->update('m_form', $data, 'WHERE SECC_P_inCODSEC="'.$idcambiar.'"');

}

}




if ($_GET["accion"]=="editar"){
  include "includes/header.php";
include "includes/lateral.php";
$secc_item = $db->select_one('*', 'm_form', "where SECC_P_inCODSEC='".$id."' ");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar formulario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=$rutaadmin?>">Escritorio</a></li>
              <li class="breadcrumb-item active"><a href="<?=$rutaadmin?>formularios/">formularios</a></li>
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
                    <label for="email" class="col-sm-3 control-label">Estado</label><br>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="switch">
                                <label>Borrador<input type="checkbox" name="estado" <?php if ($secc_item["SECC_inESTSEC"] == '1'){echo "checked";}?>><span class="lever"></span>Publicado</label>
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
    var url = "<?=$rutaadmin?>formularios/actualizar/<?=onlyNumbers($_GET["id"])?>";
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
        cargar("formularios");
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

//comprobamos nombre del item
$ver_reg = $db->select('*', 'm_form', "where SECC_txURLSEC='".limpiar($titulo)."' and SECC_P_inCODSEC!='".onlyNumbers($_GET["id"])."'");
if($ver_reg->num_rows=='0'){

//intentamos ingresar en la bd los datos
if ($db->update('m_form', $data, 'WHERE SECC_P_inCODSEC="'.$id.'"')) {
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
$db->update('m_form', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"');


    echo '{"success": true, "message": "formulario guardado con éxitos."}';
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
$db->update('m_form', $data, 'WHERE SECC_P_inCODSEC="'.$ultimo_id.'"');

    echo '{"success": true, "message": "formulario guardado con éxitos."}';


}


//si falla el grabado de item
}else{
    echo '{"success": false, "message": "Error al grabar formulario, por favor intente nuevamente."}';
    }

//si ya existe el item url
  }else{
    echo '{"success": false, "message": "Error al grabar formulario, el nombre ya existe."}';
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
$emp = $db->select('*', 'm_form ms', "
INNER JOIN s_cate sc ON sc.CATE_P_inCODCAT=ms.CATE_F_inCODCAT
INNER JOIN m_usua mu ON mu.USUA_P_inCODUSU=ms.USUA_F_inCODUSU
where ms.SECC_chSECCAT=2 and ".$buscar."");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <!-- <td class="text-center"><?=$emp_dat["SECC_P_inCODSEC"]?></td> -->
    <td class="text-center"><?=$emp_dat["SECC_chTITSEC"]?></td>
    <td class="text-center"><?=$emp_dat["CATE_chTITCAT"]?></td>
    <td class="text-center">
      <button class="<?php if ($emp_dat["SECC_inESTSEC"]=='1'){echo"btn-success";} else if ($emp_dat["SECC_inESTSEC"]=='2'){echo"btn-danger";} else{echo"bg-secondary";} ?> btn-xs" onclick="CambiarEstado('formularios','<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');"><i class="fa fa-recycle"></i> <?=estado($emp_dat["SECC_inESTSEC"])?></button>
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
                              <a class="dropdown-item"  href="<?=$rutaadmin?>formularios/editar/<?=$emp_dat["SECC_P_inCODSEC"]?>">Editar</a>
<?php 
if ($estado!='3') { ?>
                              <a class="dropdown-item"  onclick="papelera('formularios','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Papelera</a>
                              <a class="dropdown-item"  onclick="eliminar('formularios','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a>
<?php }else{ ?>
                              <a class="dropdown-item"  onclick="recuperar('formularios','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Recuperar</a>
                              <a class="dropdown-item"  onclick="eliminar('formularios','<?=$emp_dat["SECC_P_inCODSEC"]?>');" >Eliminar</a>
<?php }?>

                            </div>
                          </div>
    </td>
</tr>
<?php }
}

//recuperamos formulario
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

$db->update('m_form', $data, 'WHERE SECC_P_inCODSEC="'.$idcambiar.'"');

}   


}


//para seleccionar formulario
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
                        <th class="text-center">Título</th>
                        <th class="text-center">Categoría</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th class="text-center">Título</th>
                        <th class="text-center">Categoría</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </tfoot>
                    <tbody>
<?php
$emp = $db->select('*', 'm_form ms', "
where ms.SECC_chSECCAT=2 and ms.SECC_inESTSEC!=3");
$cont=0;
        while ($emp_dat = $emp->fetch_assoc()) {
$cont++
?>
<tr>
    <td class="text-center"><?=$emp_dat["SECC_P_inCODSEC"]?></td>
    <td class="text-center"><?=$emp_dat["SECC_chTITSEC"]?></td>
    <td class="text-center">
      <button class="<?php if ($emp_dat["SECC_inESTSEC"]=='1'){echo"btn-success";} else if ($emp_dat["SECC_inESTSEC"]=='2'){echo"btn-danger";} else{echo"btn-secondary";} ?> btn-xs" onclick="CambiarEstado('formularios','<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');"><i class="fa fa-recycle"></i> <?=estado($emp_dat["SECC_inESTSEC"])?></button>
    </td>
    <td class="text-center">
      <button type="button" class="btn btn-outline-primary urlpag_<?=$emp_dat["SECC_P_inCODSEC"]?>" onclick="seleccionarformulario('<?=$emp_dat["SECC_P_inCODSEC"]?>', '<?=$emp_dat["SECC_inESTSEC"]?>');" url="<?=$ruta?><?=$emp_dat["SECC_txURLSEC"]?>" id_pag="<?=$emp_dat["SECC_P_inCODSEC"]?>">Elegir</button>
    </td>
</tr>
<?php }?>
                    </tbody>
                  </table>
                </div>

<?php } ?>

