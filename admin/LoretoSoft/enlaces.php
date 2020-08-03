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
  $_GET["accion"]!="seleccionar" and 
  $_GET["accion"]!="cambiarestado"){
	header("Location: ".$ruta."error/");
}
if ($_GET["accion"]=="cargar"){?>
<script>

  $("#formulario").on('submit', function(e){
 var lugar = $("#lugarseleccionado option:selected").val();
 var dataform = new FormData(this);
    dataform.append('lugar',lugar);
    var url = "<?=$rutaadmin?>enlaces/grabar";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: dataform,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_enviar').html('Guardando...');
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
        cargar("enlaces");
        cargar_enlaces();
    }
  }
})
            }
        });

    });


manejoimg();
        //cargar menu dependiendo tipo


</script>
                <div class="row">
          <!-- Filtro -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group row col-md-10 mb-0">
                      <label class="m-0 col-md-4 col-form-label float-left">¿Que menu deseas editar?</label>
                      <div class="col-md-8 float-right">
                        <select class="custom-select" id="lugarseleccionado">
                          <option value="1">Accesos rapidos</option>
                          <option value="2">Nuestros servicios</option>
                          <option value="3">Enlaces externos</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-md-2 mb-0">
                      <a onclick="cargar_enlaces()" class="btn btn-outline-primary btn-block">Cargar</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Contenido -->
          <div class="col-md-4">
            <div class="card" id="editar_enlace">
              <div class="card-header" id="titulo_accion">
                Agregar Item
              </div>
              <div class="card-body">
                <form method="post" id="formulario" class="form-horizontal " autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                  <label>Imagen de item</label><center>
                    <div class="custom-file">
                      <div class="sedapal-imagen-destacada-elegida mb-1"  onclick="modal_lg('<?=$rutaadmin?>multimedia/seleccionar');">
        <img id="imagen_src" src="" alt="pre-visualización" class="img-responsive foto" style="width: 100%" />
                      </div>
                  <div class="custom-file">
                    <input type="hidden" name="nombreimg" class="nombreimg">
<span class="btn btn-outline-primary btn-file" style="width: 100%; margin-bottom: 10px">Subir nueva imagen<input type="file" style="width: 100%" name="imagen" class="foto"></span>
<a class="btn btn-outline-primary btn-block"  onclick="modal_lg('<?=$rutaadmin?>multimedia/seleccionar');">Seleccionar imagen</a>
                  </div>
                    </div>
                  </center>
                  </div>
                  <div class="form-group">
                    <label for="titulo">Título de item</label>
                    <input type="text" class="form-control" name="titulo" id="titulo">
                  </div>
                  <div class="form-group">
                    <label for="href">Enlace de item</label>
                      <input class="form-control" type="text" placeholder="URL" id="href" name="urlp">
                      <input type="hidden" name="id_pag" id="id_pag">
                    <button type="button" class="btn btn-outline-primary mt-1 btn-block"  onclick="modal_lg('<?=$rutaadmin?>paginas/seleccionar');">Elegir página</button>
                  </div>
                 <div class="form-group row">
                    <label for="abrir" class="col-sm-12 control-label">¿Cómo se abrirá?</label><br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="switch">
                                <label>Nueva pestaña<input type="checkbox" name="abrir" <?php if ($regusu_dat["ENLA_chABRENL"] == '1'){echo "checked";}?>><span class="lever"></span>Misma pestaña</label>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="estado" class="col-sm-12 control-label">Estado</label><br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="switch">
                                <label>Inactivo<input type="checkbox" name="estado" <?php if ($regusu_dat["ENLA_intESTENL"] == '1'){echo "checked";}?>><span class="lever"></span>Activo</label>
                            </div>
                        </div>
                    </div>
                </div>

                  <div class="form-group"><center>
                    <button type="submit" class="btn btn-secondary d-none" id="btn_actualizar">Actualizar</button>
                    <button type="submit" class="btn btn-primary" id="btn_agregar">Agregar</button></center>
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
                <div class="table-responsive" id="listaenlaces">
                  <table id="tbPrincipal" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Imagen</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Enlace</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Imagen</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Enlace</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>

<?php }


if ($_GET["accion"]=="grabar"){

        $titulo = textos( $_POST['titulo'] );
        $urlp = textos( $_POST['urlp'] );
        $nombreimg = textos( $_POST['nombreimg'] );
        $lugar = textos( $_POST['lugar'] );

        $abrir1 = alfanumerico( $_POST['abrir'] );
        $estado1 = alfanumerico( $_POST['estado'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if (isset($abrir1) && $abrir1 == 'on'){
      $abrir="1";}
   else{
      $abrir="2";}



if ($titulo != null and $urlp != null ){

$data = array(
    'ENLA_chTITENL' => "".$titulo."",
    'ENLA_chURLENL' => "".$urlp."",
    'ENLA_chABRENL' => "".$abrir."",
    'ENLA_intLUGENL' => "".$lugar."",
    'ENLA_intESTENL' => "".$estado."",
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
);


//intentamos ingresar en la bd los datos
if ($db->insert( 'm_enla', $data )) {
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
        if (!((strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "png")) && ($tamano < 2097152))) {
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
    'ENLA_chFOTENL' => "".$nombrefisico."",
  );
$db->update('m_enla', $data, 'WHERE ENLA_P_inCODENL="'.$ultimo_id.'"');


    echo '{"success": true, "message": "enlace guardado con éxitos."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }


// si es que no se lecciono nada en el navegador
}else{

$data = array(
    'ENLA_chFOTENL' => "".$nombreimg."",
  );
$db->update('m_enla', $data, 'WHERE ENLA_P_inCODENL="'.$ultimo_id.'"');

    echo '{"success": true, "message": "enlace guardado con éxitos."}';


}


//si falla el grabado de item
}else{
    echo '{"success": false, "message": "Error al grabar enlace, por favor intente nuevomente."}';
    }


//si falta un dato
}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
    }
}


if ($_GET["accion"]=="eliminar"){
    
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{
  $db->delete('m_enla', 'WHERE ENLA_P_inCODENL="'.$id.'"');
} 

}

//grabarmos lo que hemos editado

if ($_GET["accion"]=="actualizar"){

        $titulo = textos( $_POST['titulo'] );
        $urlp = textos( $_POST['urlp'] );
        $nombreimg = textos( $_POST['nombreimg'] );
        $lugar = textos( $_POST['lugar'] );

        $abrir1 = alfanumerico( $_POST['abrir'] );
        $estado1 = alfanumerico( $_POST['estado'] );

if (isset($estado1) && $estado1 == 'on'){
      $estado="1";}
   else{
      $estado="2";}

if (isset($abrir1) && $abrir1 == 'on'){
      $abrir="1";}
   else{
      $abrir="2";}



if ($titulo != null and $urlp != null ){

$data = array(
    'ENLA_chTITENL' => "".$titulo."",
    'ENLA_chURLENL' => "".$urlp."",
    'ENLA_chABRENL' => "".$abrir."",
    'ENLA_intLUGENL' => "".$lugar."",
    'ENLA_intESTENL' => "".$estado."",
    'USUA_F_inCODUSU' => "".$_SESSION['node']['id_user']."",
);


//intentamos ingresar en la bd los datos
if ($db->update('m_enla', $data, 'WHERE ENLA_P_inCODENL="'.$id.'"')) {


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
    'ENLA_chFOTENL' => "".$nombrefisico."",
  );
$db->update('m_enla', $data, 'WHERE ENLA_P_inCODENL="'.$id.'"');


    echo '{"success": true, "message": "enlace guardado con éxitos."}';
            }
            else {
    echo '{"success": false, "message": "Ocurrió algún error al subir el fichero. No pudo guardarse."}';
            }
        }


// si es que no se lecciono nada en el navegador
}else{

$data = array(
    'ENLA_chFOTENL' => "".$nombreimg."",
  );
$db->update('m_enla', $data, 'WHERE ENLA_P_inCODENL="'.$id.'"');

    echo '{"success": true, "message": "enlace guardado con éxitos."}';


}


//si falla el grabado de item
}else{
    echo '{"success": false, "message": "Error al grabar enlace, por favor intente nuevomente."}';
    }


//si falta un dato
}else{
    echo '{"success": false, "message": "Error: Falta ingresar dato, por favor intente de nuevo."}';
    }
}


if ($_GET["accion"]=="eliminar"){
    
if ( !$sid->check() )
{
    echo '<meta http-equiv="Refresh" content="0;url='.$rutaadmin.'">';
}else{
  $db->delete('m_enla', 'WHERE ENLA_P_inCODENL="'.$id.'"');
} 

}

//para seleccionar datos de menu
if ($_GET["accion"]=="seleccionar"){?>
<script type="text/javascript">tablas();</script>
                  <table id="tbPrincipal" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Imagen</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Enlace</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Imagen</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Enlace</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </tfoot>
                    <tbody>
<?php
$enlace = $db->select('*', 'm_enla', "where ENLA_intLUGENL=".$id."");
$cont=0;
if ($enlace->num_rows==0) {?>
<td class="align-middle" colspan="5">Aún no se agregó ningun enlace a esta zona.</td>
<?php }else{
        while ($enlace_dat = $enlace->fetch_assoc()) {
$cont++;
?>
                      <tr>
                        <th class="align-middle"><?=$enlace_dat["ENLA_P_inCODENL"]?></th>
                        <td class="align-middle text-center">
                          <span class="sedapal-img-enlaces" style="background-image: url(<?=$ruta?>uploads/<?=$enlace_dat["ENLA_chFOTENL"]?>);">
              <img src="<?=$ruta?>uploads/<?=$enlace_dat["ENLA_chFOTENL"]?>" style="width: 100px">
                          </span>
                        </td>
                        <td class="align-middle text-center"><?=$enlace_dat["ENLA_chTITENL"]?></td>
                        <td class="align-middle text-center"><a href="<?=$enlace_dat["ENLA_chURLENL"]?>" target="_blank"><?=$enlace_dat["ENLA_chURLENL"]?></a></td>
                        <td class="align-middle text-center">
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-align-justify"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" onclick="editar_enlace('<?=$enlace_dat["ENLA_P_inCODENL"]?>')"><i class="fa fa-edit"></i> Editar</a>
                              <a class="dropdown-item"  onclick="eliminar('enlaces','<?=$enlace_dat["ENLA_P_inCODENL"]?>');" ><i class="fa fa-trash text-red"></i> Eliminar</a>
                            </div>
                          </div>
                        </td>
                      </tr>
<?php } }?>
                    </tbody>
                  </table>

<?php 

} 



//editamos
if ($_GET["accion"]=="editar"){

$data_item = $db->select_one('*', 'm_enla', "where ENLA_P_inCODENL='".$id."' ");

if($data_item->num_rows!='0'){?>
<script type="text/javascript">
  manejoimg();


 $("#formularioeditar").on('submit', function(e){
 var lugar = $("#lugarseleccionado option:selected").val();
 var dataform = new FormData(this);
    dataform.append('lugar',lugar);
    var url = "<?=$rutaadmin?>enlaces/actualizar/<?=$id?>";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: url,
            data: dataform,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            $('#btn_enviar').html('Grabando...');
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
        cargar("enlaces");
        setTimeout(function(){cargar_enlaces()},1000);
    }
  }
})
            }
        });
    });

</script>
              <div class="card-header" id="titulo_accion">
                Editar Item
              </div>
              <div class="card-body">
                <form method="post" id="formularioeditar" class="form-horizontal " autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                  <label>Imagen de item</label><center>
                    <div class="custom-file">
                      <div class="sedapal-imagen-destacada-elegida mb-1" style="background-image: url(<?=$ruta?>uploads/<?=$data_item["ENLA_chFOTENL"]?>);" onclick="modal_lg('<?=$rutaadmin?>multimedia/seleccionar');">
        <img id="imagen_src" src="<?=$ruta?>uploads/<?=$data_item["ENLA_chFOTENL"]?>" alt="pre-visualización" class="img-responsive foto" style="width: 100%" />
                      </div>
                  <div class="custom-file">
                    <input type="hidden" name="nombreimg" class="nombreimg" value="<?=$data_item["ENLA_chFOTENL"]?>">
<span class="btn btn-outline-primary btn-file" style="width: 100%; margin-bottom: 10px">Subir nueva imagen<input type="file" style="width: 100%" name="imagen" class="foto"></span>
<a class="btn btn-outline-primary btn-block"  onclick="modal_lg('<?=$rutaadmin?>multimedia/seleccionar');">Seleccionar imagen</a>
                  </div>
                    </div>
                  </center>
                  </div>
                  <div class="form-group">
                    <label for="titulo">Título de item</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" value="<?=$data_item["ENLA_chTITENL"]?>">
                  </div>
                  <div class="form-group">
                    <label for="href">Enlace de item</label>
                      <input class="form-control" type="text" placeholder="URL" id="href" name="urlp" value="<?=$data_item["ENLA_chURLENL"]?>">
                      <input type="hidden" name="id_pag" id="id_pag">
                    <button type="button" class="btn btn-outline-primary mt-1 btn-block"  onclick="modal_lg('<?=$rutaadmin?>paginas/seleccionar');">Elegir página</button>
                  </div>
                 <div class="form-group row">
                    <label for="abrir" class="col-sm-12 control-label">¿Cómo se abrirá?</label><br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="switch">
                                <label>Nueva pestaña<input type="checkbox" name="abrir" <?php if ($data_item["ENLA_chABRENL"] == '1'){echo "checked";}?>><span class="lever"></span>Misma pestaña</label>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="estado" class="col-sm-12 control-label">Estado</label><br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="switch">
                                <label>Inactivo<input type="checkbox" name="estado" <?php if ($data_item["ENLA_intESTENL"] == '1'){echo "checked";}?>><span class="lever"></span>Activo</label>
                            </div>
                        </div>
                    </div>
                </div>

                  <div class="form-group"><center>
                    <button type="submit" class="btn btn-secondary" id="btn_actualizar">Actualizar</button>
                    <!-- <button type="submit" class="btn btn-primary" id="btn_agregar">Agregar</button></center> -->
                  </div>
                </form>
              </div>

<?php }

} 
?>